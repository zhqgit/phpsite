<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/23
 * Time: 14:50
 */

$file_name = 'contents/201112/02-215307.txt';

// file_exists() 函数检查文件或目录是否存在
if(file_exists($file_name)){

    // fopen()函数前的'@' 来隐藏错误输出。
    $fp = @fopen($file_name,'r');

    if($fp){
        // flock() 函数锁定或释放文件
        //LOCK_SH：共享锁定（读取的程序）。允许其他进程访问该文件
        flock($fp,LOCK_SH);

        // 读出文件的内容，并以字符串形式赋给变量result
        // $fp是打开的文件资源(先通过fopen)，第二个参数是规定要读取的最大字节数。
        $result = fread($fp,1024);
    }

    // LOCK_UN - 释放一个共享锁定或独占锁定
    flock($fp,LOCK_UN);
}

// explode函数把字符串按“|”分割后存入数组$content_array
$content_array = explode('|',$result);

echo "<h1>我的BLOG</h1>";
echo "<b>日志标题</b>".$content_array[0];
echo "<br/><b>发布时间：</b>".date('Y-m-d H:i:s',$content_array[1]);
echo "<hr>";
echo $content_array[2];


