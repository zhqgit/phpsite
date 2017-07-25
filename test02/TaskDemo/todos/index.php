<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/21
 * Time: 10:45
 */
$conn = mysqli_connect("localhost:3309","root","nodejs","txt");

if(!empty($_POST['sub'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sql = "insert into `blog` (`id`,`title`,`dates`,`contents`,`hits`) values (null,'$title',now(),'$content',0)";
    mysqli_query($conn,$sql);
    echo '插入成功';
}

