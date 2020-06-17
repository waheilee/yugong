<?php

namespace App\Admin\Controllers;


use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;

class UploadController
{

    public function upload(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'errno'   => 1,
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->file('upload_file')) {
            // 保存图片到本地
            $result = $uploader->save($request, 'admin', 'editor');
            // 图片保存成功的话
            if ($result) {
                $data['data'][] = $result['path'];
                $data['errno']   = 0;
            }
        }

        return $data;
    }
}