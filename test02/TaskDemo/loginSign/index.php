<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/22
 * Time: 20:18
 */

if(!empty($_POST['sub'])){
    $conn = mysqli_connect('localhost:3309','root','nodejs','txt');
    if (mysqli_connect_errno($conn))
    {
        echo "连接 MySQL 失败: " . mysqli_connect_error();
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "select * from `user` WHERE `username`='$username'";
    $query = mysqli_query($conn,$sql);
//    var_dump($query);


    $rs = mysqli_fetch_assoc($query);
    if($rs['username'] == $_POST['username'] && $rs['password'] == $_POST['password']){
        echo '登录成功！';
    }else{
        echo '登录失败！';
    }
}
