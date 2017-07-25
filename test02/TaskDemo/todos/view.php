<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/22
 * Time: 9:53
 */

$conn = mysqli_connect("localhost:3309","root","nodejs","txt");

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * from `blog` WHERE `id`='$id'";
    $query = mysqli_query($conn,$sql);

    $rs = mysqli_fetch_array($query);

    $sqluphits = "update `blog` set  hits = hits+1 WHERE `id`= '$id'";
    mysqli_query($conn,$sqluphits);

}

?>

<h1><?php echo $rs['title']?></h1>
<h2><?php echo $rs['dates']?></h2>
<h3>点击量：<?php echo $rs['hits']?></h3>
<hr>
<p>
    <?php echo $rs['contents']?>
</p>












