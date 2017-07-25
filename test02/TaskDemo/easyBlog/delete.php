<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/24
 * Time: 19:03
 */
header("Content-Type: text/plain;charset=utf-8");

session_start();

$ok = false;

if (empty($_SESSION['username']) || $_SESSION['username'] != 'admin') {
    echo '{"msg":"请登录！"}';
    exit;
}

// 获取日志的存储目录(201707)
$path = substr($_GET['entry'],0,6);

// 日志文件名称
$entry = substr($_GET['entry'],7,9);

$file_name = 'contents'.'/'.$path.'/'.$entry.'.txt';

if(unlink($file_name)){
    $ok = true;
    echo '{"msg":"删除成功！"}';
}


















