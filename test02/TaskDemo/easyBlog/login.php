<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/23
 * Time: 16:46
 */

include 'config/auth.php';
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username != $AUTH['username'] || $password != $AUTH['password']){
        echo '用户名或密码错误！';
    }
    else{
        // 验证成功，设置session
        $_SESSION['username'] = $username;
        header("location:show.html");
    }
}