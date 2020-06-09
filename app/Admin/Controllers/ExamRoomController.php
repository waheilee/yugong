<?php

namespace App\Admin\Controllers;


use App\Models\Category;
use App\Models\ExamRoomModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class ExamRoomController
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
            ->header('题库管理')
            ->description('')
            ->body($this->grid());
//            ->row($shipForm->render());
    }

    /**
     * 新建
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('新建考场')
            ->description('考场添加')
            ->body($this->form());
    }

    /**
     * 编辑
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function edit($id,Content $content)
    {
        return $content
            ->header('新建考场')
            ->description('考场添加')
            ->body($this->form()->edit($id));
    }

    public function store(Request $request)
    {
        $title = $request->input('title');
        $categoryId = $request->input('category_id');
        $examStatus = $request->input('exam_status');
        $intro = $request->input('intro');
        $examBook = $request->input('exam_book');
        $examRoomModel = new ExamRoomModel();
        $examRoomModel->title = $title;
        $examRoomModel->category_id = $categoryId;
        $examRoomModel->exam_status = $examStatus=='on'?1:0;
        $examRoomModel->intro = $intro;
        $examRoomModel->exam_book = $examBook;
        $examRoomModel->save();
        admin_toastr('添加考场成功','success');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $title = $request->input('title');
        $categoryId = $request->input('category_id');
        $examStatus = $request->input('exam_status');
        $intro = $request->input('intro');
        $examBook = $request->input('exam_book');
        $examRoomModel = ExamRoomModel::whereId($id)->first();
        $examRoomModel->title = $title;
        $examRoomModel->category_id = $categoryId;
        $examRoomModel->exam_status = $examStatus=='on'?1:0;
        $examRoomModel->intro = $intro;
        $examRoomModel->exam_book = $examBook;
        $examRoomModel->update();
        admin_toastr('编辑考场成功','success');
        return redirect('admin/exam_room');
    }

    /**
     * 考场列表
     * Make a grid builder.
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ExamRoomModel());
        $grid->column('title','考场名称');
        $grid->column('category_id','考场所属类别');
        $grid->column('intro','考场简介');
        $grid->column('exam_status','考场状态')->display(function ($status){
            switch ($status){
                case 0: $status = '关闭'; break;
                case 1: $status = '开启'; break;
            }
            return $status;
        });
        $grid->actions(function (Grid\Displayers\Actions $action){
            $action->disableView();
        });
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->disableRowSelector();
        return $grid;
    }

    public function form()
    {
        $cateModel = new Category();
        $form = new Form(new ExamRoomModel());
        $form->hidden('id','');
        $form->text('title','考场标题');
        $form->select('category_id', '考场所属分类')->options($cateModel::selectOptions(null,'顶级分类'));
//        $form->text('category_id','考场所属分类');
        $states = [
            'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
        ];
        $form->switch('exam_status','考场状态')->states($states);
        $form->text('intro','考场简介');
        $form->editor('exam_book', '课程大纲');
        $form->disableViewCheck();
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        return $form;
    }
}