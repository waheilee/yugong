<?php

namespace App\Admin\Controllers;


use App\Models\ExamPaperModel;
use App\Models\ExamRoomModel;
use App\Models\LessonModel;
use App\Models\Question;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

class ExamPaperController
{
    /**
     * Index interface.
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

    public function create(Content $content)
    {
        return $content
            ->header('新建考场')
            ->description('考场添加')
            ->body($this->form());
    }

    public function store(Request $request)
    {
        $title = $request->input('title');
        $timeOut = $request->input('timeout')*600;
        $lessonId = $request->input('lesson_id');
        $pass = $request->input('pass');
        $singlePoint = $request->input('single_point');
        $multiplePoint = $request->input('multiple_point');
        $binaryPoint = $request->input('binary_point');
        $single = $this->choice(array_filter($request->input('single'))) ;
        $multiple = $this->choice(array_filter($request->input('multiple')));
        $binary = $this->binary(array_filter($request->input('binary')));
        $examPaperModel = new ExamPaperModel();
        $examPaperModel->title = $title;
        $examPaperModel->lesson_id = $lessonId;
        $examPaperModel->timeout = $timeOut;
        $examPaperModel->pass = $pass;
        $examPaperModel->question = json_encode([
            'single'=>[
                'name' =>'单选题',
                'score'=>$singlePoint,
                'data' =>$single
            ],
            'multiple'=>[
                'name' => '多选题',
                'score'=>$multiplePoint,
                'data'=>$multiple
            ],
            'binary'=> [
                'name'=>'判断题',
                'score' =>$binaryPoint,
                'data'=>$binary
            ]
        ]);
        $examPaperModel->save();
        admin_toastr('试卷添加成功','success');
    }

    /**
     * 考场列表
     * Make a grid builder.
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ExamPaperModel());
        $grid->column('title','试卷名称');
        $grid->column('lesson_id','试卷所属课程');
        $grid->column('timeout','考试时间')->display(function ($timeout){
            $time = $timeout/60;
            return $time.'分钟';
        });
        $grid->column('pass','及格分数线');

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

        $form = new Form(new ExamPaperModel());
        $form->text('title','试卷标题');
        $form->select('lesson_id','所属课程')->options(LessonModel::all()->pluck('title','id'));
        $form->select('timeout','考试时间')->setWidth(2)->options([1=>'10分钟',2=>'20分钟',3=>'30分钟',4=>'40分钟',5=>'50分钟',6=>'60分钟']);
        $form->text('pass','及格线')->setWidth(2);
        $form->text('single_point','选择题分数')->placeholder('请对应题数填写单选题总分')->setWidth(2);
        $form->listbox('single','选择题')->options(Question::whereType(1)->get()->pluck('question','id'));
        $form->text('multiple_point','多选题分数')->placeholder('请对应题数填写多选题总分')->setWidth(2);
        $form->listbox('multiple','多选题')->options(Question::whereType(2)->get()->pluck('question','id'));
        $form->text('binary_point','判断题分数')->placeholder('请对应题数填写判断题总分')->setWidth(2);
        $form->listbox('binary','判断题')->options(Question::whereType(3)->get()->pluck('question','id'));

        $form->disableViewCheck();
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        return $form;
    }

    //选择题
    public function choice($arr)
    {
        $data = [];
        foreach ($arr  as $item)
        {
            $temp = [];
            $questionModel = Question::whereId($item)->first();
            if ($questionModel){
                $temp['question'] = $questionModel->question;
                $temp['option'] = $questionModel->options()->get(['option','answer'])->toArray();
                $temp['answer'] = $questionModel->answer;
            }
            $data[] = $temp;

        }
        return $data;
    }

    //对错题
    public function binary($arr)
    {
        $data = [];
        foreach ($arr  as $item)
        {
            $temp = [];
            $questionModel = Question::whereId($item)->first();
            if ($questionModel){
                $temp['question'] = $questionModel->question;
                $temp['answer'] = $questionModel->answer;
            }
            $data[] = $temp;
        }
        return $data;
    }


}