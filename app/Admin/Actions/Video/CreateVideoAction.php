<?php

namespace App\Admin\Actions\Video;


use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;

class CreateVideoAction extends RowAction
{

    public $name = '添加视频课件';
    protected $id;

    /**
     * CreateVideoAction constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(Request $request)
    {

    }

    /**
     * @return string
     */
    public function href()
    {

        return "/admin/video/create?lesson_id=".$this->id;
    }





}