<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/20
 * Time: 23:52
 */

// 多维数组排序
$arr = array(
    array("key1" => 940, "key2" => 'blah'),
    array("key1" => 4, "key2" => 'this'),
    array("key1" => 230, "key2" => 'that')
);

// 自定义排序函数
// PHP调用usort(),uasort(),uksort()的时候使用自定义排序函数
// u代表的是user的意思
// usort函数是用户自定义数组升序排序
// 负数或者false，则第一个应该排在第二前
function asc_number_sort($x, $y)
{
    if ($x['key1'] > $y['key1']) {
        return true;
    } elseif ($x['key1'] < $y['key1']) {
        return false;
    } else {
        return 0;
    }
}

// 使用usort()函数排序后会改变原数组，成功时返回 TRUE， 或者在失败时返回 FALSE
var_dump(usort($arr, 'asc_number_sort'));   // bool(true)

// 将内层数组作为学生的ID
$students = array(
    256 => array('name' => 'Jon', 'grade' => 98.5),
    106 => array('name' => 'Vance', 'grade' => 88.5),
    36 => array('name' => 'Stephen', 'grade' => 78.5),
    6 => array('name' => 'Rob', 'grade' => 68.5),
    2 => array('name' => 'Jack', 'grade' => 63.5)
);

// 定义姓名排序函数
function name_sort($x,$y){
    // strcasecmp函数会返回负数，0或正数，表示两个字符的相似程度
    // 负数：$x,$y    正数：$y,$x
    return strcasecmp($x['name'],$y['name']);
}

// 定义成绩排序函数
function grade_sort($x,$y){
    // $y > $x 返回真时，则$y会排在$x前，所以是降序排序
    return $x['grade'] < $y['grade'];
}


