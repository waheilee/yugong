<?php

namespace App\Admin\Actions\Video;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class CreateSectionAction extends RowAction
{
    public $name = '添加章节';
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(Model $model,Request $request)
    {

    }

    /**
     * @return string
     */
    public function href()
    {

        return "/admin/section/create?lesson_id=".$this->id;
    }
    // 创建弹出模态框
//    public function form()
//    {

//    }

}