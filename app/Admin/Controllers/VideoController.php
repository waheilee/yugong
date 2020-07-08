<?php

namespace App\Admin\Controllers;


use App\Models\Category;
use App\Models\SectionModel;
use App\Models\Tags;
use App\Models\Video;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
    public function create(Request $request, Content $content)
    {
        $id = $request->input('lesson_id');
        return $content
            ->header('添加课件')
            ->description('课件')
            ->body($this->form($id));
    }

    /**
     * 编辑页
     * Edit interface.
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
//    public function edit($id, Content $content)
//    {
//        return $content
//            ->header('编辑')
//            ->description('')
//            ->body($this->form()->edit($id));
//    }

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
//        dd($request->all());
        $title = $request->input('title');
        $url = $request->file('url');
        $categoryId = $request->input('section_id');
        $lessonId = $request->input('lesson_id');
        $videoModel = new Video();
        if (!empty($url)){
            if ($url->isValid()) { //判断文件上传是否有效
                $FileType = $url->getClientOriginalExtension(); //获取文件后缀

                $FilePath = $url->getRealPath(); //获取文件临时存放位置
//                dd($FilePath);
                $FileName = 'video/'.date('Y-m-d') . uniqid() . '.' . $FileType; //定义文件名

                $disk = Storage::disk('qiniu'); //存储文件
                $disk->put($FileName, $url);
                $returnUrl = $disk->getDriver()->lastReturn();
                $videoModel->url =env('QINIU_URL'). $returnUrl['key'];
            }
        }
        $videoModel->title = $title;
        $videoModel->section_id = $categoryId;
        $videoModel->lesson_id = $lessonId;
//        $videoModel->url = $url;
        $videoModel->save();
        admin_toastr('添加课件成功','success');
        return redirect('admin/lesson');
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
//        $videoModel->url = $url;
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
        $grid->column('url', '视频')->video(['videoWidth' => 600, 'videoHeight' => 340]);
//        $grid->column('tag', '标签')->display(function ($tags){
//            $item = [];
//            foreach ($tags as $value=>$k){
//                $tagModel = Tags::whereId($k)->first();
//                $item[] = $tagModel->tag;
//            }
//            return $item;
//        })->label();
        $grid->column('views', '浏览量');
        $grid->disableRowSelector();

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
     * 视频新增编辑表单
     * @param $id
     * @return Form
     */
    protected function form($id)
    {
        $secModel = SectionModel::whereLessonId($id)->get();
        $data = [];
        foreach ($secModel as $item){
            $data[$item->id] = $item->title;
        }
        $form = new Form(new Video());
        $form->hidden('id', 'ID');
        $form->hidden('lesson_id')->value($id);
        $form->text('title', '标题')->rules('required');
//        $form->text('category_id', '分类')->rules('required');
        $form->select('section_id', '所属章节')->options($data);
//        $form->text('url', '视频地址')->rules('required');
        $form->file('url', '视频地址');
//        $form->text('tags','标签');
//        $form->multipleSelect('tag','标签')->options(Tags::all()->pluck('tag', 'id'));
        return $form;
    }


}