<?php

namespace App\Admin\Controllers;


use App\Admin\Actions\Policy\ImportAction;
use App\Models\Policy;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class PolicyController
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
            ->header('保单管理')
            ->description('列表')
            ->body($this->grid());
//            ->row($shipForm->render());
    }

    /**
     * 题库列表
     * Make a grid builder.
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Policy());
        $grid->column('user_name','姓名');
        $grid->column('user_phone','电话');
        $grid->column('user_card_id','身份证号码');
        $grid->column('code','激活码');
        $grid->column('is_active','是否激活');
        $grid->column('number','保单号');
        $grid->column('type','保单类型');
        $grid->column('begin_time','有效期起始时间');
        $grid->column('end_time','有效期结束时间');
        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new ImportAction());
        });
        return $grid;
    }
}