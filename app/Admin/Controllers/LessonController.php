<?php

namespace App\Admin\Controllers;


use App\Models\Category;
use App\Models\LessonModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Tree;
use Illuminate\Http\Request;


class LessonController
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
            ->header('保单管理')
            ->description('列表')
            ->body($this->grid());
//            ->row($shipForm->render());
    }

    public function create(Content $content)
    {
        return $content
            ->header('新建')
            ->description('')
            ->body($this->treeView());
    }

    /**
     * 课程列表
     * Make a grid builder.
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LessonModel());
//        $grid->column('user_name','姓名');
//        $grid->column('user_phone','电话');
//        $grid->column('user_card_id','身份证号码');
//        $grid->column('code','激活码');
//        $grid->column('is_active','是否激活');
//        $grid->column('number','保单号');
//        $grid->column('type','保单类型');
//        $grid->column('begin_time','有效期起始时间');
//        $grid->column('end_time','有效期结束时间');
//        $grid->tools(function (Grid\Tools $tools) {
//            $tools->append(new ImportAction());
//        });
        return $grid;
    }

    protected function form()
    {
        $cateModel = new Category();
        $form = new Form(new LessonModel());
//        $form->hidden('id', 'ID');
        $form->select('category_id', '分类')->options($cateModel::selectOptions(null,'顶级分类'));
        $form->text('title', '标题')->rules('required');
        $form->image('image', '缩略图');
        $form->text('intro', '课程简介');
        $form->editor('content', '课程大纲');
//        $form->edit('content', '课程大纲');
//        $form->text('category_id', '分类')->rules('required');

//        $form->text('url', '视频地址')->rules('required');
//        $form->text('tags','标签');
//        $form->multipleSelect('tag','标签')->options(Tags::all()->pluck('tag', 'id'));
        return $form;
    }

    /**
     * @return \Encore\Admin\Tree
     */
    protected function treeView()
    {
        $menuModel = new Category();

        $tree = new Tree(new $menuModel());

        dd(json_encode($tree->getItems(),JSON_UNESCAPED_UNICODE) );
        $tree->disableCreate();

        $tree->branch(function ($branch) {
            $payload = "<strong>{$branch['title']}</strong>";

//            if (!isset($branch['children'])) {
//                if (url()->isValidUrl($branch['uri'])) {
//                    $uri = $branch['uri'];
//                } else {
//                    $uri = admin_url($branch['uri']);
//                }
//
//                $payload .= "&nbsp;&nbsp;&nbsp;<a href=\"$uri\" class=\"dd-nodrag\">$uri</a>";
//            }

            return $payload;
        });

        return $tree;
    }
}