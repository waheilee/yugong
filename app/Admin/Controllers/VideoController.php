<?php

namespace App\Admin\Controllers;


use App\Models\Category;
use App\Models\Tags;
use App\Models\Video;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;
use Illuminate\Http\Request;


class VideoController
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
            ->header('视频管理')
            ->description('')
            ->body($this->grid());
//            ->row($shipForm->render());
    }

    /**
     * Create interface.
     *新增页
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('新建')
            ->description('')
            ->body($this->form());
    }

    /**
     * 编辑页
     * Edit interface.
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑')
            ->description('')
            ->body($this->form()->edit($id));
    }

    /**
     * 显示详情页
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

    public function store(Request $request)
    {
        $title = $request->input('title');
        $categoryId = $request->input('category_id');
        $url = $request->input('url');
        $tags = $request->input('tags');
            $videoModel = new Video();
            $videoModel->title = $title;
            $videoModel->category_id = $categoryId;
            $videoModel->url = $url;
            $videoModel->tags = json_encode(array_filter($tags));
            $videoModel->save();
//        dd($request->all());
    }

    public function update(Request $request)
    {
//        dd($request->all());
        $id = $request->input('id');
        $title = $request->input('title');
        $categoryId = $request->input('category_id');
        $url = $request->input('url');
        $tags = $request->input('tags');
        $videoModel = Video::whereId($id)->first();
        $videoModel->title = $title;
        $videoModel->category_id = $categoryId;
        $videoModel->url = $url;
        $videoModel->tags = json_encode(array_filter($tags));
        $videoModel->update();
    }
    /**
     * 题库列表
     * Make a grid builder.
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Video());
        $grid->column('id');
        $grid->column('title', '视频标题');
        $grid->column('category_id', '类别');
        $grid->column('url', '视频')->video(['videoWidth' => 600, 'videoHeight' => 340]);
        $grid->column('tag', '标签')->display(function ($tags){
            $item = [];
            foreach ($tags as $value=>$k){
                $tagModel = Tags::whereId($k)->first();
                $item[] = $tagModel->tag;
            }
            return $item;
        })->label();
        $grid->column('views', '浏览量');
        $grid->disableRowSelector();
//        $grid->disableCreateButton();
//        $grid->actions(function (Actions $action){
//            $action->disableEdit();
//        });
        return $grid;
    }
    /**
     * 显示视频详情
     * Make a show builder
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Video::query()->findOrFail($id));
        $show->field('title', '视频标题');
        $show->field('category_id', '类别')->as(function ($category){
            $cateModel = Category::whereId($category)->first();
            return $cateModel->title;
        });
        $show->field('url', '视频')->video();
        $show->divider();
        $show->field('views', '浏览量');
        $show->field('tag', '标签')->as(function ($tags){
            $item = [];
                foreach ($tags as $value=>$k){
                    $tagModel = Tags::whereId($k)->first();
                    $item[] = $tagModel->tag;
                }
                return $item;
        })->badge();
        return $show;
    }
    /**
     * Make a form builder.
     *视频新增编辑表单
     * @return Form
     */
    protected function form()
    {
        $cateModel = new Category();
        $form = new Form(new Video());
        $form->hidden('id', 'ID');
        $form->text('title', '标题')->rules('required');
//        $form->text('category_id', '分类')->rules('required');
        $form->select('category_id', '分类')->options($cateModel::selectOptions(null,'顶级分类'));
        $form->text('url', '视频地址')->rules('required');
//        $form->text('tags','标签');
        $form->multipleSelect('tag','标签')->options(Tags::all()->pluck('tag', 'id'));
        return $form;
    }


}