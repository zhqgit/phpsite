<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/23
 * Time: 15:39
 */
header("Content-Type: text/plain;charset=utf-8");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $ok = true;
    if(isset($_POST['title'])&& isset($_POST['content'])){
        $ok = true;

        // 获取标题
        $title = trim($_POST['title']);

        // 获取内容
        $content = trim($_POST['content']);

        // 读取日志时间
        $date = time();

        // 将标题，内容，日志时间合并成字符串
        $blog_str = $title.'|'.$date.'|'.$content;

        // 读取日期中的年和月
        $ym = date('Ym',time());

        // 读取日期中的日
        $d = date('d',time());

        // 读取日期中的时间
        $time = date('His',time());

        // 根据年和月设置目录名
        $folder = 'contents/'.$ym;
        // 时间和日设置文件名
        $file = $d.'-'.$time.'.txt';

        // 目录名加文件名
        $filename = $folder.'/'.$file;

        // 时间戳
        $entry = $ym.'-'.$d.'-'.$time;

        if(file_exists($folder) == false){
            if(!mkdir($folder)){

            }
        }

        // 打开文件
        $fp = @fopen($filename,'w');


        if($fp){
            // - 独占锁定（写入的程序）。防止其他进程访问该文件
            flock($fp,LOCK_EX);

            // fwrite() 函数将内容写入一个打开的文件中，第二个参数是要写入的字符串
            $result = fwrite($fp,$blog_str);

            // 释放一个共享锁定或独占锁定
            $lock = flock($fp,LOCK_UN);

            // 关闭打开的文件
            fclose($fp);
        }

        if(strlen($result)>0){
            // $ok = false;
            $msg = '日志添加成功，<a href="post2.php?entry='.$entry.'">查看该日志文章</a>';
//            echo $msg;
            echo '{"success":true,"msg":"保存成功！"}';
        }


    }
}