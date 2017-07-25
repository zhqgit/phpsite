<form action="" method="get">
    <input type="text" name="keys">
    <input type="submit" name="subs" value="搜索">
</form>





<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/21
 * Time: 15:15
 */

// 混编的php
$conn = mysqli_connect("localhost:3309","root","nodejs","txt");

if(!empty($_GET['keys'])){
    $keys = $_GET['keys'];
    // 标题模糊搜索
    $w = "`title` like '%$keys%'";
}else{
    $w = 1;
}




// order by id desc按照id值倒序
$sql = "select * from `blog` where $w order by id desc limit 6";
//相当于$sql = "select * from `blog` where 1 order by id desc limit 6";


$query = mysqli_query($conn,$sql);

while($rs = mysqli_fetch_array($query)){

?>
    <h2><a href="view.php?id=<?php echo $rs['id'] ?>">标题==========<?php echo $rs['title']?></a>
    |<a href="edit.php?id=<?php echo $rs['id'] ?>">编辑</a>|<a href="del.php?del=<?php echo $rs['id'] ?>">删除</a>|</h2>
    <li>时间：<?php echo $rs['dates'] ?></li>
    <p>内容：<?php echo iconv_substr($rs['contents'],0,5)?></p>
    <hr>

<?php
}
?>