<?php

namespace App\Admin\Controllers;


use App\Admin\Forms\QuestionForm;
use App\Admin\Forms\TorFQuestionForm;
use App\Models\Question;
use App\Models\Tags;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Tab;
use Illuminate\Database\Eloquent\Collection;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;
class QuestionController
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
            ->header('用户管理')
            ->description('')
            ->body($this->grid());
//            ->row($shipForm->render());
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        $forms = [
            'basic'    => QuestionForm::class,
            'site'     => TorFQuestionForm::class,
        ];
        return $content
            ->header('新建')
            ->description('')
            ->body(Tab::forms($forms));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
//    public function edit($id, Content $content)
//    {
//        $forms = [
//            'basic'    => QuestionForm::class,
//            'site'     => TorFQuestionForm::class,
//        ];
//        return $content
//            ->header('Edit')
//            ->description('')
//            ->body($forms->edit($id));
//    }

    /**
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('详情')
            ->description('')
            ->body($this->detail($id));
    }

    /**
     * 题库列表
     * Make a grid builder.
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Question());
        $grid->column('id');
        $grid->column('type','类型')->display(function ($type){
            switch ($type){
                case 1: $type = '选择题'; break;
                case 2: $type = '判断题'; break;
            }
            return $type;
        });
        $grid->column('question', '题目');
        $grid->model()->collection(function (Collection $collection) {
            // 1. 可以给每一列加字段，类似上面display回调的作用
            foreach($collection as $item) {
                $item->full_name = $item->first_name . ' ' . $item->last_name;
            }
            // 2. 给表格加一个序号列
            foreach($collection as $index => $item) {
                $item->number = $index;
            }
            // 最后一定要返回集合对象
            return $collection;
        });
        $grid->column('tags', '标签')->display(function ($tags){
            $item = [];
             if(is_array(json_decode($tags,true))){
                 foreach (json_decode($tags,true) as $value=>$k){
                    $tagModel = Tags::whereId($k)->first();
                    $item[] = $tagModel->tag;
                 }
            return $item;
             }else{
                 return 2;
             }
        })->label();

        $grid->column('created_at', '创建时间');
        $grid->disableRowSelector();
//        $grid->disableCreateButton();
        $grid->actions(function (Actions $action){
            $action->disableEdit();
        });
        return $grid;
    }

    /**
     * 显示题目详情
     * Make a show builder
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Question::query()->findOrFail($id));

        $show->field('id');
        $show->field('question', '题目');
        $show->options('题干选项', function (Grid $grid) {

            $grid->id();
            $grid->column('option', '选项');
            $grid->column('answer', '选项内容');
            $grid->column('created_at', '创建时间');

            $grid->disableActions();
            $grid->disableCreateButton();
            $grid->disableFilter();
            $grid->disableTools();
            $grid->disableRowSelector();
        });
        $show->field('answer', '答案');
        $show->field('analysis', '注释');
        $show->divider();
        $show->field('tags', '标签')->as(function ($tags){
            $item = [];
            if(is_array(json_decode($tags,true))){
                foreach (json_decode($tags,true) as $value=>$k){
                    $tagModel = Tags::whereId($k)->first();
                    $item[] = $tagModel->tag;
                }
                return $item;
            }else{
                return 2;
            }
        })->badge();




        return $show;
    }

}