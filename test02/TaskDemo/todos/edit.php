<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/21
 * Time: 15:44
 */

$conn = mysqli_connect("localhost:3309","root","nodejs","txt");

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $sql = "select * from `blog` WHERE `id`='$id'";
    echo 'haha';
    $query = mysqli_query($conn,$sql);
    $rs = mysqli_fetch_array($query);
}


if(!empty($_POST['sub'])){
    $title = $_POST['title'];
    $contents = $_POST['content'];
    $hid = $_POST['hid'];
    $sql = "update `blog` set `title`='$title',`contents`='$contents' WHERE `id`='$hid'";
    $query = mysqli_query($conn,$sql);
    echo "<script>alert('更新成功！');location.href='while.php'</script>";
}
?>
<form action="edit.php" method="post">
    <input type="hidden" name="hid" value="<?php echo $rs['id']?>">
    标题<input type="text" name="title" value="<?php echo $rs['title']?>"><br>
内容<textarea name="content" id="" cols="30" rows="10"><?php echo $rs['contents']?></textarea><br>
    <input type="submit" value="提交" name="sub">
</form>
