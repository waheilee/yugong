<?php

namespace App\Admin\Controllers;


use App\Admin\Actions\Video\EditVideosAction;
use App\Admin\Actions\Video\VideoAction;
use App\Models\Category;
use App\Models\LessonModel;
use App\Models\Tags;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
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
            ->body($this->form());
    }

    public function store(Request $request)
    {
        $model = new LessonModel();
        $model->category_id = $request->input('category_id');
        $model->title = $request->input('title');
        $model->image = $request->input('image');
        $model->intro = $request->input('intro');
        $model->content = $request->input('content');
        $model->save();
    }

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
     * 课程列表
     * Make a grid builder.
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LessonModel());
        $grid->column('category_id','所属分类');
        $grid->column('title','课程名称');
        $grid->column('image','缩略图');
        $grid->column('intro','课程简介');
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

        return $form;
    }

    protected function detail($id)
    {
        $show = new Show(LessonModel::query()->findOrFail($id));

        $show->field('id');
        $show->field('title', '课程名称');
        $show->field('image', '缩略图')->image();
        $show->field('intro', '课程简介');
        $show->field('content', '课程大纲');
        $show->divider();
        $show->videos('课件', function (Grid $grid) {

//            $grid->id();
            $grid->column('id');
            $grid->column('sort', '排序')->editable();
            $grid->column('title', '视频标题')->editable();
            $grid->column('url', '视频')->video(['videoWidth' => 600, 'videoHeight' => 340]);
//            $grid->column('tag', '标签')->display(function ($tags){
//                $item = [];
//                foreach ($tags as $value=>$k){
//                    $tagModel = Tags::whereId($k)->first();
//                    $item[] = $tagModel->tag;
//                }
//                return $item;
//            })->label();
            $grid->column('views', '浏览量');
            //编辑
            $grid->actions(function (Grid\Displayers\Actions  $actions) {
                $actions->disableEdit();
                $actions->add(new EditVideosAction($actions->getKey()));
//                $actions->append("<a class='btn btn-xs action-btn btn-success grid-row-pass' data-id='{$actions->getKey()}'><i class='fa fa-check' title='同意退款'>同意</i></a>");
            });

            $grid->tools(function (Grid\Tools $tools) {
                $tools->append(new VideoAction());
            });
            $grid->disableCreateButton();
            $grid->disableFilter();
//            $grid->disableTools();
            $grid->disableRowSelector();
        });
        return $show;
    }
}