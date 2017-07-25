<?php
function add($n, $total)
{
    if ($n === 1) {
        return $total;
    } else {
        return add($n - 1, $n * $total);
    }
}

//echo add(5, 1);

// 使用递归输出多维数组
// 不管数组嵌套多少层都可以输出
$arr = array(
    array('a'=>1,'b'=>2,'son'=>array(
        'aa'=>11,'bb'=>22,'son'=>array(
            'aaa'=>111,
            'bbb'=>222,
            'ccc'=>333
        )
    )),
    array('e'=>1,'son'=>array(
        'ee' => 11
    )),
    array('f'=>2)
);

function show($arr){
    foreach($arr as $k=>$v){
        if(is_array($v)){
            show($v);
        }else{
            echo $k.'=>'.$v.PHP_EOL;
        }
    }
}

show($arr);

?>