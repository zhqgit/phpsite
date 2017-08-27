<?php
/**
 * Created by PhpStorm.
 * User: ZHQ
 * Date: 2017/8/22
 * Time: 10:34
 */

namespace app\admin\controller;

use app\admin\model\Tagsrelation;
use think\Controller;
use think\Request;
use think\Session;
use app\admin\model\Categories as CategoriesModel;
use app\admin\model\Tags as TagsModel;
use app\admin\model\Article as ArticleModel;
use app\admin\model\Tagsrelation as TagsrelationModel;
use app\admin\model\Admin as AdminModel;
// 重定向
use \traits\controller\Jump;

class Index extends Controller
{

    public function index() {
        // 实例化Request对象，用来获取session对象
        $request = Request::instance();

        // 判断是否登录
        $session_name = $request->session('username');
        $session_pwd = $request->session('password');
        if (!empty($session_name) && !empty($session_pwd)) {
            // 获取所有的分类
            $result_cate = CategoriesModel::all();

            // 获取所有的标签
            $result_tags = TagsModel::all();

            $this->assign('categories', $result_cate);
            $this->assign('tags', $result_tags);
            return $this->fetch();


        } else {
            $this->redirect('www.tp5.com/admin/index/login');
        }
    }

    public function append() {
        $request = Request::instance();

        // 获取文章提交的信息
        $result['title'] = $request->post('title');
        $result['brief'] = $request->post('brief');
        $result['keywords'] = $request->post('keywords');
        $result['content'] = $request->post('content');

        // 得到分类的id
        $result['category'] = $request->post('category');

        // 获取标签,得到的是一个id数组
        $result['tags'] = $request->post('tags/a');

        // 生成文章保存的时间
        $result['date'] = date_format(date_create(), "Y/m/d H:i:s");

        // 文章的pv和state
        $result['pv'] = 0;
        $result['state'] = 0;
        dump($result);


        $this->saveArticle($result);
        $res = sendEmail($result['date'].'创建了文章<'.$result['title'].'>', 'zhqgit@163.com', 'zhqgit.top');
        if ($res) {
            $this->assign('msg', '发送成功！');
        } else {
            $this->assign('msg', '发送失败！');
        }
        return $this->fetch("test");
    }

    // 保存文章
    public function saveArticle($data) {

        // 实例化一个文章模型对象
        $article = new ArticleModel;

        // 查询文章表的最大id值
        $data['id'] = $article->max('id') + 1;

        $article->data([
            'id' => $data['id'],
            'date' => $data['date'],
            'brief' => $data['brief'],
            'title' => $data['title'],
            'content' => $data['content'],
            'keywords' => $data['keywords'],
            'pv' => $data['pv'],
            'state' => $data['state'],
            'cid' => $data['category'],
        ]);

        $article->save();

        // 实例化一个标签与文章联系表对象
        $tagsrelation = new TagsrelationModel;

        // 获得标签数组的长度
        $arrlength = count($data['tags']);

        for ($i = 0; $i < $arrlength; $i++) {
            $tagsrelation->data([
                'id' => $tagsrelation->max('id') + 1,
                'aid' => $data['id'],
                'tid' => $data['tags'][$i]
            ]);
        }
        $tagsrelation->save();
    }

    public function login() {
        return $this->fetch();
    }

    public function verify() {
        $request = Request::instance();
        $user['username'] = $request->post('username');
        $user['password'] = md5($request->post('password'));


        $admin = new AdminModel();
        $result = $admin->where($user)->find();

        if ($result) {
            $time = date_format(date_create(), "Y/m/d H:i:s");
            $res = sendEmail($time.'登录了系统后台！如果不是本人操作，请注意！', 'zhqgit@163.com', 'zhqgit.top');
            if ($res) {
                $this->assign('msg', '发送成功！');
            } else {
                $this->assign('msg', '发送失败！');
            }
            Session::set('username', $user['username']);
            Session::set('password', $user['password']);
            $this->redirect('www.tp5.com/admin/index/index');
        } else {
            return $this->fetch('error');
        }
    }
}
