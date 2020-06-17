<?php

namespace App\Admin\Controllers;


use App\Models\Tags;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;


class TagsController
{

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {

        return $content
            ->header('标签管理')
            ->description('')
            ->body($this->grid());
//            ->row($shipForm->render());
    }

    public function create(Content $content)
    {
        return $content
            ->header('添加标签')
            ->description('')
            ->body($this->form());
    }

    public function store(Request $request)
    {
        $tagModel = new Tags();
        $tagModel->tag = $request->input('tag');
        $tagModel->save();
        admin_toastr('添加成功','success');
        return redirect('admin/tags');
    }

    /**
     * 题库列表
     * Make a grid builder.
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Tags());
        $grid->column('id');
        $grid->column('tag','名称');
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->actions(function (Grid\Displayers\Actions $actions){
            $actions->disableView();
            $actions->disableEdit();
        });
        return $grid;
    }

    public function form()
    {
        $form = new Form(new Tags());
        $form->text('tag','标签名称');
        return $form;
    }
}