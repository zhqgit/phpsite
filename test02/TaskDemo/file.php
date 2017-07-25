<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/20
 * Time: 22:34
 */

//echo filetype('imgTest');
//
//echo "<br>";
//
//echo filetype('a.txt');
//
//echo "<br>";
//
//print_r(stat('a.txt'));
//
//echo "<br>";
//
//print_r(scandir('imgTest'));
//
//echo "<br>";

//function showFile($file){
//    $arr = scandir($file);
//    foreach ($arr as $value){
//        if(is_dir($file.$value)){
//            echo $value."<br>";
//        }
//    }
//}
//
////print_r(showFile('imgTest'));
//showFile('imgTest');

//$arr = scandir("imgTest");
//    foreach ($arr as $v){
//        if(is_dir("imgTest".$v)){
//            echo $v."<br>";
//        }
//    }

if(!@$f = fopen("a.txt","r")){
    echo '文件不存在！';
}else{
    // 得到10位字符
    $str =  fgets($f,11);
    fclose($f);

    $ff = fopen("b.txt","w");
    fwrite($ff,$str);
    fclose($ff);
}
