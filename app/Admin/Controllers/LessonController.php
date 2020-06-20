<?php

namespace App\Admin\Controllers;


use App\Admin\Actions\Video\CreateSectionAction;
use App\Admin\Actions\Video\CreateVideoAction;
use App\Models\Category;
use App\Models\LessonModel;
use App\Models\SectionModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
            ->header('课程管理')
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
        $model->url = $request->input('url');
        $model->intro = $request->input('intro');
        $model->content = $request->input('content');
        $model->degree = $request->input('degree');
        $model->is_free = $request->input('is_free');
        $model->price = $request->input('price');
        $model->discounts = $request->input('discounts');
        $model->save();
    }

    public function update(Request $request)
    {
        $model = LessonModel::whereId($request->input('id'))->first();
        if (!empty($tmp)){
            if ($tmp->isValid()) { //判断文件上传是否有效
                $FileType = $tmp->getClientOriginalExtension(); //获取文件后缀

                $FilePath = $tmp->getRealPath(); //获取文件临时存放位置

                $FileName = 'lesson/'.date('Y-m-d') . uniqid() . '.' . $FileType; //定义文件名

                Storage::disk('admin')->put($FileName, file_get_contents($FilePath)); //存储文件
                $model->url = env('APP_URL') .'uploads/'. $FileName;
            }
        }
        $model->category_id = $request->input('category_id');
        $model->title       = $request->input('title');
        $model->intro       = $request->input('intro');
        $model->content     = $request->input('content');
        $model->degree      = $request->input('degree');
        $model->is_free     = $request->input('is_free');
        $model->price       = $request->input('price');
        $model->discounts   = $request->input('discounts');
        $model->update();
    }

    public function edit($id,Content $content)
    {
        return $content
            ->header('新建')
            ->description('')
            ->body($this->form()->edit($id));
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
        $grid->column('url','缩略图');
        $grid->column('intro','课程简介');
        $grid->column('views', '浏览量');
        //添加章节
        $grid->actions(function (Grid\Displayers\Actions  $actions) {
            $actions->disableEdit();
            $actions->add(new CreateSectionAction($actions->getKey()));
            $actions->add(new CreateVideoAction($actions->getKey()));

        });
        $grid->disableExport();

//        $grid->tools(function (Grid\Tools $tools) {
//            $tools->append(new CreateVideoAction());
//        });

        return $grid;
    }

    protected function form()
    {
        $cateModel = new Category();
        $form = new Form(new LessonModel());
        $form->hidden('id', 'ID');
        $form->select('category_id', '分类')->options($cateModel::selectOptions(null,'顶级分类'));
        $form->text('title', '标题')->rules('required');
        $form->image('url', '缩略图');
        $form->select('degree','难度')->options([1 => '初级', 2 => '中级', 3 => '高级']);
        $form->radio('is_free', '是否免费')->options([ 0 => '免费', 1=> '收费'])->default(0);
        $form->text('price','价格')->placeholder('如果课程免费可不填价格');
        $form->text('discounts','优惠价格')->placeholder('如果课程免费可不填价格');
        $form->text('intro', '课程简介');
        $form->editor('content', '课程大纲');

        return $form;
    }

    protected function detail($id)
    {
        $show = new Show(LessonModel::query()->findOrFail($id));

        $show->field('id');
        $show->field('title', '课程名称');
        $show->field('url', '缩略图')->image();
        $show->field('degree', '难度')->using([1 => '初级', 2 => '中级', 3 => '高级']);
        $show->field('is_free', '是否免费')->using([0 => '免费', 1 => '付费']);
        $show->field('price', '价格');
        $show->field('discounts', '优惠价格');
        $show->field('intro', '课程简介');
//        $show->field('content', '课程详情')->badge('default');
        $show->videos('课件',function (Grid $grid){
            $grid->id();
            $grid->column('title', '课件名称');
            $grid->column('url', '视频')->video(['videoWidth' => 600, 'videoHeight' => 340]);
            $grid->column('lesson_id', '所属课程')->display(function ($lessonId){
                $lessonModel = LessonModel::whereId($lessonId)->first();
                if ($lessonModel){
                    return $lessonModel->title;
                }else{
                    return '';
                }

            });
            $grid->column('section_id', '所属章节')->display(function ($sectionId){
                $sectionModel = SectionModel::whereId($sectionId)->first();
                if ($sectionModel){
                    return $sectionModel->title;
                }else{
                    return '';
                }

            });
            $grid->column('views', '浏览量');
            $grid->column('created_at', '创建时间');

//            $grid->disableActions();
            $grid->actions(function (Grid\Displayers\Actions $actions){
                $actions->disableView();
            });
            $grid->disableCreateButton();
            $grid->disableFilter();
            $grid->disableTools();
            $grid->disableRowSelector();
        });

        $show->divider();

        return $show;
    }

}