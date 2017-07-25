<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/23
 * Time: 14:17
 */

if(!empty($_POST['sub'])){
    $conn = mysqli_connect('localhost:3309','root','nodejs','txt');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "insert into `user` (`username`,`password`,`email`,`phone`) VALUES ('$username','$password','$email','$phone')";

    mysqli_query($conn,$sql);
    echo '注册成功！';
}