<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/27
 * Time: 22:11
 */
class UserModel extends Model{
    // 当然，UserModel也可以继承CommonModel，这样实例化生成User实例就可以使用CommonModel的方法了

    public function getinfo(){
        // 添加自己的业务逻辑
        return 'Hello getinfo';
    }
}
