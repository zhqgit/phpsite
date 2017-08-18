<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/27
 * Time: 22:28
 */
class CommonModel extends Model{
    // 常用业务处理逻辑
    public function strmake($str){
        return md5(sha1(md5($str)));
    }
}
