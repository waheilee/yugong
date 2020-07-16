<?php

namespace App\Admin\Actions\Server;

use App\Models\ServerTempModel;
use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;

class ForceDeleteProductAction extends RowAction
{
    public $name = '删除';


    public function handle(ServerTempModel $product)
    {
        $product->forceDelete();

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
