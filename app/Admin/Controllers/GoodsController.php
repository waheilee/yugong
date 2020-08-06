<?php

namespace App\Admin\Controllers;


use App\Admin\Actions\Server\DividerAction;
use App\Admin\Actions\Server\ForceDeleteProductAction;
use App\Admin\Actions\Server\ProductStatusAction;
use App\Models\GoodsModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class GoodsController
{
//    use HasResourceActions;
    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('商品')
            ->description('')
            ->body($this->grid());
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('添加商品')
            ->description('添加一个商品')
            ->body($this->form());
    }
    /**
     * Edit interface.
     *
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
     * @param Request $request
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $serverTempModel = new GoodsModel();
        $thumb = $request->file('thumb');
        if ($thumb->isValid()) { //判断文件上传是否有效
            $FileType = $thumb->getClientOriginalExtension(); //获取文件后缀

            $FilePath = $thumb->getRealPath(); //获取文件临时存放位置

            $FileName = 'servers/'.date('Y-m-d') . uniqid() . '.' . $FileType; //定义文件名

            Storage::disk('qiniu')->put($FileName, file_get_contents($FilePath)); //存储文件
            $path = env('QINIU_URL'). $FileName;
            $serverTempModel->thumb =$path;
        }
        $serverTempModel->uuid             = generateNewUuid();
        $serverTempModel->name             = $request->input('name');
        $serverTempModel->title            = $request->input('title');
        $serverTempModel->price            = $request->input('price');
        $serverTempModel->original_price   = $request->input('original_price');
        $serverTempModel->count            = $request->input('count');
        $serverTempModel->content          = $request->input('content');
        $serverTempModel->save();

    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    public function update(Request $request)
    {
        $serverTempModel = GoodsModel::whereId($request->input('id'))->first();
        $thumb = $request->file('thumb');
        if ($thumb->isValid()) { //判断文件上传是否有效
            $FileType = $thumb->getClientOriginalExtension(); //获取文件后缀

            $FilePath = $thumb->getRealPath(); //获取文件临时存放位置

            $FileName = 'servers/'.date('Y-m-d') . uniqid() . '.' . $FileType; //定义文件名

            Storage::disk('qiniu')->put($FileName, file_get_contents($FilePath)); //存储文件
            $path = env('QINIU_URL'). $FileName;
            $serverTempModel->thumb =$path;
        }
        $serverTempModel->uuid             = generateNewUuid();
        $serverTempModel->name             = $request->input('name');
        $serverTempModel->price            = $request->input('price');
        $serverTempModel->original_price   = $request->input('original_price');
        $serverTempModel->count            = $request->input('count');
        $serverTempModel->content          = $request->input('content');
        $serverTempModel->update();

    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GoodsModel());
        $grid->column('id');
        $grid->column('name', '商品名')->display(function ($name) {
            return Str::limit($name, 30);
        });
        $grid->column('thumb', '首图')->image('', 50, 50);
        $grid->column('price', '价格')->display(function ($price) {
            return $price . '/' . $this->original_price;
        });
        $grid->column('deleted_at', '是否上架')->display(function ($isAlive) {

            return is_null($isAlive)
                ? "<i style='color: green;' class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>"
                : "<i style='color: red;' class=\"fa fa-times\" aria-hidden=\"true\"></i>";
        });
        $grid->column('created_at', '创建时间');
        $grid->column('updated_at', '修改时间');

        // 增加一个上架，下架功能
        $grid->actions(function (Grid\Displayers\DropdownActions $actions) {
            $actions->disableDelete();
            $actions->add(new ForceDeleteProductAction());
            $actions->add(new DividerAction());
            $name = is_null($actions->row->deleted_at) ?
                "下架":
                "上架";

            $statusAction = new ProductStatusAction();
            $statusAction->setName($name);
            $actions->add($statusAction);
        });
        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new GoodsModel());

        $form->hidden('id','');
        $form->text('name', '商品名字')->rules('required|max:50');
        $form->currency('price', '销售价')->symbol('$')->rules('required|numeric');
        $form->currency('original_price', '原价')->symbol('$')->rules('required|numeric');
        $form->number('count', '库存量')->rules('required|integer|min:0');
        $form->image('thumb', '缩略图')->uniqueName()->move('products/thumb')->rules('required');
        $form->editor('content', '详情')->rules('required');

        return $form;
    }
}