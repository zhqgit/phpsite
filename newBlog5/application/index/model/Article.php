<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/8/20
 * Time: 21:48
 */
namespace app\index\model;
use think\Model;

// 数据表 think_article的模型
class Article extends Model
{
    /**
     * @fn $date读取器，在读取文章date属性前先做一个数据的处理
     * @param $date
     * @return false|string
     */
    protected function getDateAttr($date){
        return date_format(date_create($date),"M d, Y");
    }

}

