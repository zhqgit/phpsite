<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/22
 * Time: 22:18
 */
header("Content-Type: text/plain;charset=utf-8");


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    search();
}

function search(){
    if (!isset($_GET["username"]) || empty($_GET["username"])) {
        echo "参数错误";
        return;
    }

    $conn = mysqli_connect('localhost:3309','root','nodejs','txt');

    if (mysqli_connect_errno($conn))
    {
        echo "连接 MySQL 失败: " . mysqli_connect_error();
    }
    $username = $_GET['username'];

    $sql = "select * from `user` WHERE `username`='$username'";
    $query = mysqli_query($conn,$sql);


    $rs = mysqli_fetch_assoc($query);
//    $str = implode(",", $rs);
    if(empty($rs['username'])){
//        echo $result = $str.$rs['username']."没有找到用户";
        echo $result = 'true';
    }else{
//        echo $result = $str.$rs['username']."找到该用户！";
        echo $result = 'false';
    }

}