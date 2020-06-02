<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Category;
use Encore\Admin\Tree;

class CategoryController extends Controller
{

    /**
     * 获取分类菜单
     * @return \Encore\Admin\Tree
     */
    public function treeView()
    {
        $menuModel = new Category();

        $tree = new Tree(new $menuModel());
        $data = $tree->getItems();
        return $this->wrapSuccessReturn(compact('data'));

    }




}