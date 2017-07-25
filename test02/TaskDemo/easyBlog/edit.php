<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/24
 * Time: 19:03
 */

// session_start — 启动新会话或者重用现有会话
session_start();

$ok = false;

// 判断是否设置了entry
if (!isset($_GET['entry'])) {
    echo '请求参数错误！';
    exit;
}

if (empty($_SESSION['username']) || $_SESSION['username'] != 'admin') {
    echo '请登录！';
    exit;
}

// 获取日志的存储目录(201707)
$path = substr($_GET['entry'],0,6);

// 日志文件名称
$entry = substr($_GET['entry'],7,9);

$file_name = 'contents'.'/'.$path.'/'.$entry.'.txt';

if(file_exists($file_name)){
    // 打开文件，只读方式
    $fp = @fopen($file_name,'r');

    // 打开文件返回真
    if($fp){

        //锁定文件，LOCK_SH 用于文件读取
        flock($fp,LOCK_SH);

        // 读取打开的文件
        $result = fread($fp,filesize($file_name));
    }

    // 释放文件，LOCK_UN 用于释放一个锁定
    flock($fp,LOCK_UN);

    // 关闭打开的文件
    fclose($fp);

    // 存入文件的内容是以  “|” 连接的，所以读取出来的文件可以以“|”分割
    $content_array = explode('|',$result);
}



// 修改
if(isset($_POST['title'])&& isset($_POST['content'])){
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if(file_exists($file_name)){
        // 根据用户修改后的内容，修改已有的内容


        // 用$title替换$result字符串中的$content_array[0]
        // 如：把字符串 "Hello world!" 中的字符 "world" 替换成 "Peter"：
        // str_replace("world","Peter","Hello world!")

        // 修改标题
        $blog_temp = str_replace($content_array[0],$title,$result);

        // 修改内容
        $blog_str = str_replace($content_array[2],$content,$blog_temp);

        $fp = @fopen($file_name,'w');

        if($fp){

            // 锁定文件，LOCK_EX用于写入文件
            flock($fp,LOCK_EX);

            $result = fwrite($fp,$blog_str);

            $lock = flock($fp,LOCK_UN);

            fclose($fp);
        }
    }

    // 判断是否修改成功
    if(strlen($result)>0){
        $ok = true;
        $msg = '日志修改成功！';
    }
}
