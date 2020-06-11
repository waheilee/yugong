<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$data['title']?> - 在线考试系统</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.timeout.js')}}"></script>
    <script>
        $(function () {
            //关闭页面前提示
            $(window).on("beforeunload", function () {
                return "您尚未交卷！此操作将导致您的回答丢失。";
            });
            timeOver = false; //保存当前是否已经达到交卷时间
            //倒计时功能
            $(".timeout").timeout({
                //考试时间（页面刷新时，时间会重置。）
                "maxTime": <?=$data['timeout']?>,
                //到达时间自动交卷。（如果浏览器禁用JavaScript，此功能不会生效）
                "onTimeOver": function () {
                    timeOver = true;
                    alert("考试时间结束，系统自动交卷。");
                    $("#testForm").submit();//交卷
                }
            });
            // $("#testForm").submit(function (event) {
            //     $(window).off("beforeunload");      //解除绑定页面关闭事件
            //     timeOver || checkMultiple(event);	//检查多选题是否全部作答
            // });
            //多选题至少选择一项
            // function checkMultiple(event) {
            //     $(".jq-multiple .question-each").each(function () {
            //         if ($(this).find(".question-option input[type=checkbox]:checked").length < 1) {
            //             $(this).find(".question-option input[type=checkbox]:first").focus();
            //             event.preventDefault();  //阻止表单提交
            //             alert('您有多选题未作答。');
            //             return false;
            //         }
            //     });
            // }
            ;
        });
    </script>
</head>
<body>
<div class="top">
    <div class="top-title">正在考试 （剩余时间 <span class="timeout"></span>）</div>
</div>
<div class="main">
    <div class="main-wrap">
        <!-- 顶部标题 -->
        <div class="question-top">
            <!-- 试卷标题 -->
            <div class="question-title"><?=$data['title']?></div>
            <!-- 题型导航 -->
            <div class="question-nav">
                <a href="#binary">判断题</a>
                <a href="#single">单选题</a>
                <a href="#multiple">多选题</a>
                <a href="#fill">填空题</a>
            </div>
        </div>
        <!-- 题目内容 -->
        <form action="/api/examPaperOver" method="post" >
            <!-- 判断题 -->
            <div id="binary" class="anchor" ></div>
            <div class="question-wrap">
                <div class="question-type">一、判断题<span>（共<?=$count['binary']?>题，每题<?=$score['binary']?>分）</span></div>
{{--{{$data['data']['binary']['data'][0]}}--}}
                @foreach($data['data']['binary']['data'] as $k=>$v)
                    <div class="question-each">
                        <!-- 标题 -->
                        @if(!empty($v))
                            <div class="question-name">{{$k+1}}.{{$v['question']}}</div>
                            <!-- 选项 -->
                                <div class="question-option">
                                    <label><input type="radio" value="1" name="binary[{{$k+1}}]" >对</label>
                                    <label><input type="radio" value="2" name="binary[{{$k+1}}]" >错</label>
                                </div>
                            @endif
                    </div>
                    @endforeach
            </div>
            <!-- 单选题 -->
            <div id="single" class="anchor" ></div>
            <div class="question-wrap">
                <div class="question-type">二、单选题<span>（共<?=$count['single']?>题，每题<?=$score['single']?>分）</span></div>
                @foreach($data['data']['single']['data'] as $k=>$v)
                    <div class="question-each">
                        <!-- 标题 -->
                        @if(!empty($v))
                            <div class="question-name">{{$k+1}}. {{$v['question']}}</div>
                            <!-- 选项 -->
                            <div class="question-option">
                                @foreach($v['option'] as $item)
                                    <label><input type="radio" value="{{$item['option']}}" name="single[{{$k+1}}]" >{{$item['option']}}. {{$item['answer']}}</label>
                                    @endforeach
                            </div>
                            @endif
                    </div>
                    @endforeach
            </div>
            <!-- 多选题 -->
            <div id="multiple" class="anchor" ></div>
            <div class="question-wrap jq-multiple">
                <div class="question-type">三、多选题<span>（共<?=$count['multiple']?>题，每题<?=$score['multiple']?>分）</span></div>
                @foreach($data['data']['multiple']['data'] as $k=>$v)
                    <div class="question-each">
                        <!-- 标题 -->
                        @if(!empty($v))
                        <div class="question-name">{{$k+1}}. {{$v['question']}}</div>
                        <!-- 选项 -->
                        <div class="question-option">
                            @foreach($v['option'] as $item)
                                <label><input type="checkbox" value="{{$item['option']}}" name="multiple[{{$k+1}}][]">{{$item['option']}}. {{$item['answer']}}</label>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endforeach
            </div>
            <div class="question-act">
                <input type="submit" value="交卷" >
            </div>
        </form>
    </div>
</div>
<div class="footer">
    PHP在线考试系统　本项目仅供学习使用
</div>
</body>
</html>