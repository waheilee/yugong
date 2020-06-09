<?php

namespace App\Admin\Controllers;


use App\Models\LessonModel;
use App\Models\SectionModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

class SectionController
{
    /**
     * @param Request $request
     * @param Content $content
     * @return Content
     */
    public function index(Request $request, Content $content)
    {
        $id = $request->input('lesson_id');
        return $content
            ->header('课程章节管理')
            ->description('列表')
            ->body($this->grid($id));
//            ->row($shipForm->render());
    }

    public function create(Request $request, Content $content)
    {
        $id = $request->input('lesson_id');
        return $content
            ->header('添加章节')
            ->description('章节')
            ->body($this->form($id));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $lessonId = $request->input('lesson_id');
        $title = $request->input('title');
        try{
            $model = new SectionModel();
            $model->lesson_id = $lessonId;
            $model->title = $title;
            $model->save();
            admin_toastr('课程章节添加成功', 'success');
        }catch (\Exception $exception){
            admin_toastr('课程章节添加失败', 'error');
        }

        return redirect('admin/lesson');
//        dd($request->all());
    }

    protected function grid($id)
    {
        if ($id){
            $grid = new Grid(new SectionModel);
            $grid->model()->where('lesson_id',$id)->select();
//            dd();
        }else{
            $grid = new Grid(new SectionModel());
        }

        $grid->column('lesson_id','章节所属课程')->display(function ($lessonId){
            $lessonModel = LessonModel::whereId($lessonId)->first();
            return $lessonModel->title;
        });
        $grid->column('title','章节名称');

        $grid->disableCreateButton();
        $grid->actions(function (Grid\Displayers\Actions $actions){
            $actions->disableEdit();
            $actions->disableView();
        });
        return $grid;
    }

    protected function form($id)
    {
        $model = LessonModel::whereId($id)->first();

        $form = new Form(new SectionModel());
        $form->hidden('lesson_id')->value($id);
        $form->text('', '所属课程')->default($model->title)->disable();
        $form->text('title','章节名称');
        return $form;
    }
}