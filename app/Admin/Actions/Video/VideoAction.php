<?php

namespace App\Admin\Actions\Video;


use App\Models\Category;
use App\Models\Tags;
use App\Models\Video;
use Encore\Admin\Actions\Action;
use Encore\Admin\Admin;
use Encore\Admin\Form;
use Illuminate\Http\Request;

class VideoAction extends Action
{

    protected $selector = '.import-action';
    protected $lessonId;



    public function handle(Request $request)
    {
//        dd($request->all());
        // $request ...
        $title = $request->input('title');
//        $categoryId = $request->input('category_id');
        $url = $request->input('url');
        $lessonId = $request->input('lesson');
//        $tags = $request->input('tags');
        $videoModel = new Video();
        $videoModel->title = $title;
        $videoModel->lesson_id = $lessonId;
//        $videoModel->category_id = 1;
        $videoModel->url = $url;
//        $videoModel->tag = 1;
        $videoModel->save();

        return $this->response()->success('添加成功')->refresh();
    }

    public function html()
    {
        return

<<<HTML
        <button class="btn btn-sm btn-default import-action" onclick="lessonId()">添加课件</button>
<script>
        function lessonId(){
        var url = window.location.href;
        var index = url.lastIndexOf("\/");
        str = url.substring(index + 1,url.length);
        $("input[name='lesson']").val(str)
        console.log(str);
        };  
</script>
HTML;


    }

    /**
     * 表单
     */
    public function form()
    {

//        $cateModel = new Category();

        $this->hidden('lesson');
        $this->text('title', '标题');
        $this->text('url', '视频地址');
        $this->image('image','缩略图');
//        $this->multipleSelect('tag','标签')->options(Tags::all()->pluck('tag', 'id'));

    }


    /**
     * 上传等待
     * @return string
     */
//    public function handleActionPromise()
//    {
//        $resolve = <<<SCRIPT
//
//var actionResolverss = function (data) {
//            $('.modal-footer').show()
//            $('.tips').remove()
//            var response = data[0];
//            var target   = data[1];
//
//            if (typeof response !== 'object') {
//                return $.admin.swal({type: 'error', title: 'Oops!'});
//            }
//
//            var then = function (then) {
//                if (then.action == 'refresh') {
//                    $.admin.reload();
//                }
//
//                if (then.action == 'download') {
//                    window.open(then.value, '_blank');
//                }
//
//                if (then.action == 'redirect') {
//                    $.admin.redirect(then.value);
//                }
//            };
//
//            if (typeof response.html === 'string') {
//                target.html(response.html);
//            }
//
//            if (typeof response.swal === 'object') {
//                $.admin.swal(response.swal);
//            }
//
//            if (typeof response.toastr === 'object') {
//                $.admin.toastr[response.toastr.type](response.toastr.content, '', response.toastr.options);
//            }
//
//            if (response.then) {
//              then(response.then);
//            }
//        };
//
//        var actionCatcherss = function (request) {
//            $('.modal-footer').show()
//            $('.tips').remove()
//
//            if (request && typeof request.responseJSON === 'object') {
//                $.admin.toastr.error(request.responseJSON.message, '', {positionClass:"toast-bottom-center", timeOut: 10000}).css("width","500px")
//            }
//        };
//SCRIPT;
//
//        Admin::script($resolve);
//
//        return <<<SCRIPT
//         $('.modal-footer').hide()
//         let html = `<input type="hidden"  name="lesson_id" value='\"+str+\"' class="form-control title action" placeholder="输入 标题">`
//         $('.modal-footer').append(html)
//process.then(actionResolverss).catch(actionCatcherss);
//SCRIPT;
//    }
}