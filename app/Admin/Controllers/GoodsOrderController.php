<?php

namespace App\Admin\Controllers;

use App\Models\GoodsOrderModel;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
class GoodsOrderController
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
            ->header('商品订单列表')
            ->description('')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GoodsOrderModel());

        return $grid;
    }
}