<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/21
 * Time: 15:31
 */

$conn = mysqli_connect("localhost:3309","root","nodejs","txt");
if(!empty($_GET['del'])){
    $d = $_GET['del'];
    $sql = "delete from `blog` WHERE `id` = '$d'";
    mysqli_query($conn,$sql);

    echo "<script>alert('删除成功！');window.location.href='while.php'</script>";
}






