<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/4/18
 * Time: 下午11:13
 */

namespace App\Http\Controllers;


class TestController extends Controller
{

    public function getSide()
    {
        return json_encode([['name'=>'用户管理','url'=>'/yonghu','second'=>[['name'=>'一级导航菜单','url'=>'navigation'],['name'=>'二级导航菜单','url'=>'/erji']]],['name'=>'权限管理','url'=>'/quanxiang'],['name'=>'数据管理','url'=>'/shuju']]);
    }

    public function getTopNavigation()
    {
        return json_encode(['name'=>'阅读王','url'=>'yueduwang'],['name'=>'梧桐阅读','url'=>'wutong'],['name'=>'影视大全','url'=>'影视']);
    }

}