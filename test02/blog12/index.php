<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/7/27
 * Time: 9:50
 *
 * @file
 * @common   存放当前项目的公共函数
 * @conf     存放当前项目的配置文件
 * @Lang     存放当前项目的语言包
 * @Lib      存放当前项目的控制器和模型
 * @Runtime  存放当前项目运行时文件(运行时编译的文件)
 * @Tpl      存放当前项目的模版文件
 *
 * @MVC      Lib存放MC   Tpl存放V
 */

/*
 * 运行时：
 * 1. 加载ThinkPHP.php-----------require('./ThinkPHP/ThinkPHP.php');
 *
 * 2. 加载核心文件---------------require('./ThinkPHP/Lib/Core');
 *
 * 3. 加载项目的文件；分析URL；调用相关控制器
 *
 *
 * */

// 访问 http://test02.com/blog12/index.php == http://test02.com/blog12/index.php?m=index&a=index
// 这里的 m 即 module 模型，控制器，
//        a 即 action  方法  页面
// 如果在App/Lib/Action/IndexAction.class.php 文件中存在函数add
// 那么访问 http://test02.com/blog12/index.php?m=index&a=add 会在页面显示该函数的返回值

// 欢迎页面 存放在App/Lib/Action/IndexAction.class.php


// 如果没有显示欢迎页面，那么一定要加上下面这行
// 设置这个的原因是 ThinkPHP会生成编译文件(App/Runtime)
// 如果define('APP_DEBUG',FALSE); 那么对于这个编译文件，它生成一次之后，就不会在编译它了
// 如果在项目开发过程中，最好把define('APP_DEBUG',TRUE);
define('APP_DEBUG',TRUE);
define('APP_NAME','App');
define('APP_PATH','./App/');

//
define("SITE_URL","http://127.0.0.1/");
define("CSS_URL",SITE_URL."test02/blog12/Public/css/");
define("JS_URL",SITE_URL."test02/blog12/Public/js/");
define("FONT_URL",SITE_URL."test02/blog12/Public/font/");
define("IMAGES_URL",SITE_URL."test02/blog12/Public/images/");

require('./ThinkPHP/ThinkPHP.php');
//echo "hahah";












