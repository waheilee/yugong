<?php

namespace App\Admin\Actions\Server;

use App\Models\ServerTempModel;
use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;

class ProductStatusAction extends RowAction
{
    public $name = '';

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function handle(ServerTempModel $product)
    {
        // $model ...
        // 如果商品已经下架
        if ($product->trashed()) {

            // 重新上架
            $product->restore();
        } else {

            $product->delete();
        }


        return $this->response()->success('操作成功.')->refresh();
    }


    public function retrieveModel(Request $request)
    {
        if (!$key = $request->get('_key')) {
            return false;
        }

        return ServerTempModel::query()->withTrashed()->findOrFail($key);
    }
}
