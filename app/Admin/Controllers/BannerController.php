<?php

namespace App\Admin\Controllers;


use App\Models\BannerModel;
use App\Models\Question;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController
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
            ->header('轮播图管理')
            ->description('列表')
            ->body($this->grid());
//            ->row($shipForm->render());
    }

    public function create(Content $content)
    {
        return $content
            ->header('新建轮播图')
            ->description('轮播图添加')
            ->body($this->form());
    }

    public function edit($id,Content $content)
    {
        return $content
            ->header('编辑轮播图')
            ->description('编辑轮播图')
            ->body($this->form()->edit($id));
    }

    public function store(Request $request)
    {
        $tmp = $request->file('url');
        $bannerModel = new BannerModel();
        if ($tmp->isValid()) { //判断文件上传是否有效
            $FileType = $tmp->getClientOriginalExtension(); //获取文件后缀

            $FilePath = $tmp->getRealPath(); //获取文件临时存放位置

            $FileName = 'banner/'.date('Y-m-d') . uniqid() . '.' . $FileType; //定义文件名

            Storage::disk('admin')->put($FileName, file_get_contents($FilePath)); //存储文件
            $path = env('APP_URL').'uploads/'. $FileName;
            $bannerModel->url =$path;
        }
        $title = $request->input('title');
        $type = $request->input('type');
        $status = $request->input('status');
        $content = $request->input('content');
        $bannerModel->title = $title;
        $bannerModel->type = $type;
        $bannerModel->status = $status=='on'?1:0;
        $bannerModel->content = $content;
        $bannerModel->save();
        admin_toastr('添加成功','success');
        return redirect('admin/banner');
    }

    public function update($id,Request $request)
    {

        $title = $request->input('title');
        $type = $request->input('type');
        $status = $request->input('status');
        $content = $request->input('content');
        $tmp = $request->file('url');
        $bannerModel =  BannerModel::whereId($id)->first();
        if (!empty($title) && !empty($type) && !empty($tmp)){
            if ($tmp->isValid()) { //判断文件上传是否有效
                $FileType = $tmp->getClientOriginalExtension(); //获取文件后缀

                $FilePath = $tmp->getRealPath(); //获取文件临时存放位置

                $FileName = 'banner/'.date('Y-m-d') . uniqid() . '.' . $FileType; //定义文件名

                Storage::disk('admin')->put($FileName, file_get_contents($FilePath)); //存储文件
                $path = env('APP_URL').'uploads/'. $FileName;
                $bannerModel->url =$path;
            }
            $bannerModel->title = $title;
            $bannerModel->type = $type;
            $bannerModel->status = $status=='on'?1:0;
            $bannerModel->content = $content;
            $bannerModel->update();
        }else{
            $bannerModel->status = $status=='on'?1:0;
            $bannerModel->update();
            return response()->json(['message'=>'修改成功','status'=>'success'],200);
//            admin_toastr('状态修改成功','success');
        }
        admin_toastr('修改成功','success');
        return redirect('admin/banner');
    }

    /**
     * 题库列表
     * Make a grid builder.
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BannerModel());
        $grid->column('title','轮播图标题');
        $grid->column('url','图片')->image(50,50);
        $state = [
            'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
        ];
        $grid->column('status','是否开启')->switch($state);
        $grid->column('type','类型')->display(function ($type){
            switch ($type){
                case 1:
                    $type = '文章';
                    break;
                case 2:
                    $type = '课程';
                    break;
                case 3:
                    $type = '链接';
                    break;
            }
            return $type;
        });
        return $grid;
    }

    public function form()
    {
        $form = new Form(new BannerModel());
        $form->text('title','轮播图标题');
        $form->image('url', '轮播图');
        $states = [
            'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
        ];
        $form->switch('status','是否开启')->states($states);
        $form->select('type','轮播图类型')->options([1=>'文章',2=>'课程',3=>'链接']);
        $form->text('content','内容')->placeholder('文章货课程直接填写文章、课程id，外链直接复制链接');
        $form->disableViewCheck();
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        return $form;
    }
}