<?php

namespace App\Admin\Controllers;


use App\Models\LessonModel;
use App\Models\PlanLessonModel;
use App\Models\SectionModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlanController
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
            ->header('创建新计划')
            ->description('')
            ->body($this->form());
    }

    public function edit($id,Content $content)
    {
        return $content
            ->header('创建新计划')
            ->description('')
            ->body($this->form()->edit($id));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $title = $request->input('title');
        $student = $request->input('student');
        $time = $request->input('time');
        $lesson = $request->input('lesson');
        $content = $request->input('content');
        $status = $request->input('status');
        $tmp = $request->file('url');
//        dd($request->all());
        $planLesson = new PlanLessonModel();
        if (!empty($tmp)){
            if ($tmp->isValid()) { //判断文件上传是否有效
                $FileType = $tmp->getClientOriginalExtension(); //获取文件后缀

                $FilePath = $tmp->getRealPath(); //获取文件临时存放位置

                $FileName = 'plan/'.date('Y-m-d') . uniqid() . '.' . $FileType; //定义文件名

                Storage::disk('qiniu')->put($FileName, file_get_contents($FilePath)); //存储文件
                $path =  env('QINIU_URL'). $FileName;
                $planLesson->url = $path;

            }
        }
        $planLesson->title = $title;
        $planLesson->student = $student;
        $planLesson->time = $time;
        $planLesson->lesson = $lesson;
        $planLesson->content = $content;
        $planLesson->status = $status=='on'?1:0;;
        $planLesson->save();
//        dd($request->all());
    }

    public function update($id,Request $request)
    {
        $title = $request->input('title');
        $student = $request->input('student');
        $time = $request->input('time');
        $lesson = $request->input('lesson');
        $content = $request->input('content');
        $status = $request->input('status');
        $tmp = $request->file('url');
        $planLesson =  PlanLessonModel::whereId($id)->first();
        if (!empty($tmp)){
            if ($tmp->isValid()) { //判断文件上传是否有效
                $FileType = $tmp->getClientOriginalExtension(); //获取文件后缀

                $FilePath = $tmp->getRealPath(); //获取文件临时存放位置

                $FileName = 'banner/'.date('Y-m-d') . uniqid() . '.' . $FileType; //定义文件名

                Storage::disk('qiniu')->put($FileName, file_get_contents($FilePath)); //存储文件
                $path =  env('QINIU_URL'). $FileName;
                $planLesson->url = $path;
            }
        }
        $planLesson->title = $title;
        $planLesson->student = $student;
        $planLesson->time = $time;
        $planLesson->lesson = $lesson;
        $planLesson->content = $content;
        $planLesson->status = $status=='on'?1:0;
        $planLesson->update();
//        dd($request->all());
        admin_toastr('修改成功','success');
       return redirect('admin/plan_lesson');
    }

    protected function grid()
    {

        $grid = new Grid(new PlanLessonModel());
        $grid->column('title','章节名称');

//        $grid->disableCreateButton();
        $grid->actions(function (Grid\Displayers\Actions $actions){
//            $actions->disableEdit();
            $actions->disableView();
        });
        return $grid;
    }



    public function form()
    {
        $form = new Form(new PlanLessonModel());
        $form->text('title','计划课程标题');
        $form->image('url','计划封面');
        $form->text('student','计划人群')->placeholder('保洁、家政、空气治理、铁路计划');
        $form->text('time','计划课程总课时')->placeholder('');
        $states = [
            'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
        ];
        $form->switch('status','是否开启')->states($states);
        $form->table('lesson','添加计划课程', function ($table) {
            $table->text('stage','阶段');
            $table->select('lesson_id','选择课程')->options(LessonModel::all()->pluck('title', 'id'));
        });
        $form->editor('content','计划详情介绍');
        return $form;
    }
}