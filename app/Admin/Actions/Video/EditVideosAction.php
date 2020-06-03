<?php

namespace App\Admin\Actions\Video;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class EditVideosAction extends RowAction
{
    public $name = '编辑';
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(Model $model,Request $request)
    {
        dd($model->id);
        // 判断下面的 form 表单的 name 传值
        if($request->get('name') == 1) {
            // 处理错误
            try {
                // 处理逻辑...
                return $this->response()->success('充币成功')->refresh();
            } catch (\Exception $e) {
                return $this->response()->error('产生错误：'.$e->getMessage());
            }
        } else {
            // 同上
            try {
                // 处理逻辑...
                return $this->response()->success('充币成功')->refresh();
            } catch (\Exception $e) {
                return $this->response()->error('产生错误：'.$e->getMessage());
            }
        }
    }

    /**
     * @return string
     */
    public function href()
    {

        return "/admin/video/".$this->id."/edit";
    }
    // 创建弹出模态框
//    public function form()
//    {

//    }

}