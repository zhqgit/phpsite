<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/23
 * Time: 16:56
 */
$login = false;
session_start();

if (!empty($_SESSION['username']) && $_SESSION['username'] == 'admin') {
    $login = true;
}

$file_array = array();

// 日期文件目录数组
$folder_array = array();

$dir = 'contents';

// 打开保存日志的目录，返回的是日期文件目录
$dh = opendir($dir);

if ($dh) {
    // 读取目录下文件(日期目录)
    $filename = readdir($dh);
}

// 循环处理按年月日归档的日志文章
while ($filename) {
    if ($filename != '.' && $filename != '..') {
        $folder_name = $filename;
        array_push($folder_array, $folder_name);
    }
    $filename = readdir($dh);
}

// 对日期文件目录进行排序
rsort($folder_array);

$post_data = array();

// $folder 日期文件目录数组
foreach ($folder_array as $folder) {

    // $dir = contents $folder是每个日期文件目录
    // 打开每个日期文件目录
    $dh = opendir($dir . '/' . $folder);

    // 当每个日期文件目录中还有.txt文件时
    while (($filename = readdir($dh)) !== FALSE) {

        // is_file() 函数检查指定的文件是否是常规的文件
        if (is_file($dir . '/' . $folder . '/' . $filename)) {
            $file = $filename;
            $file_name = $dir . '/' . $folder . '/' . $file;

            // 检查文件或目录是否存在
            if (file_exists($file_name)) {
                $fp = @fopen($file_name, 'r');

                if ($fp) {
                    flock($fp, LOCK_SH);

                    // 读取文件内容
                    $result = fread($fp, filesize($file_name));
                }
                flock($fp, LOCK_UN);
                fclose($fp);
            }

            $temp_data = array();
            $content_array = explode('|', $result);

            // 文章标题
            $temp_data['SUBJECT'] = $content_array[0];

            //发表时间
            $temp_data['DATE'] = $content_array[1];

            //文章内容
            $temp_data['CONTENT'] = $content_array[2];

            // 日志文章所在文件名
            $file = substr($file, 0, 9);

            $temp_data['FILENAME'] = $folder . '-' . $file;

            array_push($post_data, $temp_data);

        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <script src="public/js/jquery-3.1.1.min.js"></script>
</head>
<body>
<?php
foreach ($post_data as $post) {
    ?>

    <h1><?php echo $post['SUBJECT']; ?></h1>
    <h2><?php echo $post['DATE']; ?></h2>
    <p><?php echo $post['CONTENT']; ?></p>
    <hr>
    <?php
}
?>
</body>
</html>

