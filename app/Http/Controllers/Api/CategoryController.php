<?php

namespace App\Http\Controllers\Api;


use App\Models\Category;
use Encore\Admin\Tree;

class CategoryController
{

    /**
     * 获取分类菜单
     * @return \Encore\Admin\Tree
     */
    public function treeView()
    {
        $menuModel = new Category();

        $tree = new Tree(new $menuModel());

        return response()->json($tree->getItems());

    }




}