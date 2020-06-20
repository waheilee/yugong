<?php

namespace App\Admin\Controllers;


use App\Models\CertificateModel;
use App\Models\ExamPaperModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController
{

    /**
     * 证书管理
     * Index interface.
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {

        return $content
            ->header('证书管理')
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

    public function store(Request $request)
    {
//        dd($request->all());
        $title = $request->input('title');
        $require = array_filter($request->input('require'));
        $url = $request->file('url');
        $cer = new CertificateModel();
        if (!empty($url)){
            if ($url->isValid()) { //判断文件上传是否有效
                $FileType = $url->getClientOriginalExtension(); //获取文件后缀

                $FilePath = $url->getRealPath(); //获取文件临时存放位置

                $FileName = 'nav/'.date('Y-m-d') . uniqid() . '.' . $FileType; //定义文件名

                Storage::disk('admin')->put($FileName, file_get_contents($FilePath)); //存储文件
                $cer->url = env('APP_URL') .'uploads/'. $FileName;
            }
        }
        $cer->title = $title;
        $cer->require = json_encode($require);
        $cer->save();
        admin_toastr('添加成功','success');
        return redirect('admin/certificate');

    }

    /**
     * 题库列表
     * Make a grid builder.
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CertificateModel());
        $grid->column('title','证书名称');
        $grid->column('url','证书');
        $grid->actions(function (Grid\Displayers\Actions $actions){
            $actions->disableView();
            $actions->disableEdit();
        });
        return $grid;
    }

    public function form()
    {
        $form = new Form(new CertificateModel());
        $form->text('title','轮播图标题');
        $form->image('url', '证书');
        $form->listbox('require','所需通过的测试')->options(ExamPaperModel::all()->pluck('title','id'));
        $form->disableViewCheck();
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        return $form;
    }
}