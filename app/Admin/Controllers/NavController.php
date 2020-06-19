<?php

namespace App\Admin\Controllers;


use App\Models\NavModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NavController
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
            ->header('导航栏图标管理')
            ->description('列表')
            ->body($this->grid());
//            ->row($shipForm->render());
    }

    public function create(Content $content)
    {
        return $content
            ->header('新建导航图')
            ->description('')
            ->body($this->form());
    }

    public function edit($id,Content $content)
    {
        return $content
            ->header('编辑导航图')
            ->description('编辑导航图')
            ->body($this->form()->edit($id));
    }

    public function store(Request $request)
    {
        $tmp = $request->file('url');

        $bannerModel = new NavModel();
        if (!empty($tmp)){
            if ($tmp->isValid()) { //判断文件上传是否有效
                $FileType = $tmp->getClientOriginalExtension(); //获取文件后缀

                $FilePath = $tmp->getRealPath(); //获取文件临时存放位置

                $FileName = 'nav/'.date('Y-m-d') . uniqid() . '.' . $FileType; //定义文件名

                Storage::disk('qiniu')->put($FileName, file_get_contents($FilePath)); //存储文件
                $bannerModel->img_url =env('QINIU_URL') . $FileName;
            }
        }
        $title = $request->input('title');
        $status = $request->input('status');
        $content = $request->input('content');
        $bannerModel->title = $title;
        $bannerModel->status = $status=='on'?1:0;
        $bannerModel->content = $content;
        $bannerModel->save();
        admin_toastr('添加成功','success');
        return redirect('admin/nav');
    }

    public function update($id,Request $request)
    {

        $title = $request->input('title');
        $status = $request->input('status');
        $content = $request->input('content');
        $tmp = $request->file('url');
        $bannerModel =  NavModel::whereId($id)->first();
        if (!empty($title)){
            if (!empty($tmp)){
                if ($tmp->isValid()) { //判断文件上传是否有效
                    $FileType = $tmp->getClientOriginalExtension(); //获取文件后缀

                    $FilePath = $tmp->getRealPath(); //获取文件临时存放位置

                    $FileName = 'nav/'.date('Y-m-d') . uniqid() . '.' . $FileType; //定义文件名

                    Storage::disk('qiniu')->put($FileName, file_get_contents($FilePath)); //存储文件
                    $bannerModel->img_url = env('QINIU_URL') . $FileName;
                }
            }
            $bannerModel->title = $title;
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
        return redirect('admin/nav');
    }

    /**
     * 题库列表
     * Make a grid builder.
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new NavModel());
        $grid->column('title','轮播图标题');
        $grid->column('url','图片')->image(50,50);
        $state = [
            'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
        ];
        $grid->column('status','是否开启')->switch($state);
        $grid->actions(function (Grid\Displayers\Actions $action){
            $action->disableView();
        });
        return $grid;
    }

    public function form()
    {
        $form = new Form(new NavModel());
        $form->text('title','标题');
        $form->image('url', '图标');
        $states = [
            'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
        ];
        $form->switch('status','是否开启')->states($states);
        $form->editor('content','内容');
        $form->disableViewCheck();
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        return $form;
    }
}