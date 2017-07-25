<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/23
 * Time: 15:19
 */
header("Content-Type: text/plain;charset=utf-8");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(!isset($_GET['entry'])){
        echo '请求参数错误！';
        exit;
    }

// 截取日志存取目录
    $path = substr($_GET['entry'],0,6);

//文件日志名称
    $entry = substr($_GET['entry'],7,9);


    $file_name = 'contents/'.$path.'/'.$entry.'.txt';

    if(file_exists($file_name)){
        $fp = @fopen($file_name,'r');
        if($fp){
            flock($fp,LOCK_SH);
            $result = fread($fp,1024);
        }

        flock($fp,LOCK_UN);
        fclose($fp);
    }

    $content_array = explode('|',$result);

    // 切记一定要返回json格式的数据
    echo json_encode($content_array);

//    echo "<h1>我的BLOG</h1>";
//    echo "<b>日志标题</b>".$content_array[0];
//    echo "<br/><b>发布时间：</b>".date('Y-m-d H:i:s',$content_array[1]);
//    echo "<hr>";
//    echo $content_array[2];
}
