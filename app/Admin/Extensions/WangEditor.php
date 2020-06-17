<?php

namespace App\Admin\Extensions;


use Encore\Admin\Form\Field;

class WangEditor extends Field
{
    protected $view = 'admin.wang-editor';

    protected static $css = [
        '/vendor/wangEditor/release/wangEditor.min.css',
    ];

    protected static $js = [
        '/vendor/wangEditor/release/wangEditor.min.js',
    ];

    public function render()
    {
        $name = $this->formatName($this->column);
        $token = csrf_token();
        $this->script = <<<EOT

var E = window.wangEditor
var editor = new E('#{$this->id}');
editor.customConfig.zIndex = 0
editor.customConfig.debug = true
editor.customConfig.pasteFilterStyle = true
editor.customConfig.uploadImgServer = '/admin/up_image'
editor.customConfig.uploadFileName = "upload_file"
editor.customConfig.uploadImgShowBase64 = true
editor.customConfig.uploadImgParams = {
    _token: '{$token}'  
}
editor.customConfig.onchange = function (html) {
    $('input[name=\'$name\']').val(html);
}
editor.create()

EOT;
        return parent::render();
    }
}