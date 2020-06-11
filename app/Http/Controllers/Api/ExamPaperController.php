<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\ExamPaperModel;
use Illuminate\Http\Request;


class ExamPaperController extends Controller
{

    public function paper(Request $request)
    {

        try {
            $validatorRules = [
                'paper_id' => 'required', //用户名
            ];

            $validatorMessages = [
                'paper_id.required' => "试卷id不能为空!",
            ];
            $this->requestValidator($request, $validatorRules, $validatorMessages);
            $id = $request->input('paper_id');
            $examPaperModel = ExamPaperModel::whereId($id)->first();
            $data = [
                'title' =>$examPaperModel->title,
                'timeout'=>$examPaperModel->timeout,
                'pass'=>$examPaperModel->pass,
                'data'=>json_decode($examPaperModel->question)
            ];

            return $this->wrapSuccessReturn(compact('data'));
        } catch (\Exception $exception) {
            return $this->wrapErrorReturn($exception);
        }

    }

    public function total(Request $request)
    {
//        $arr = $request->input('multiple.1');
//        dd($request->all());
//        dd(implode(',',$arr) );
        dd($request->all());
        try{
            $paper_id = $request->input('paper_id');
            $examPaperModel = ExamPaperModel::whereId($paper_id)->first();
            $data = [
                'title' =>$examPaperModel->title,
                'timeout'=>$examPaperModel->timeout,
                'pass'=>$examPaperModel->pass,
                'data'=>json_decode($examPaperModel->question,true)
            ];
            list($count,$score)=getDataInfo($data['data']);
            //开始阅卷操作
            $sum = 0;               //保存总得分
            $total=[];              //记录考试结果
            foreach ($data['data'] as $type=>$each){
                foreach ($each['data'] as $k=>$v){
                    //取出提交的答案
                    $check = $request->input("$type.$k");
                    $answer=isset($check)?$check : '';
                    //判断答案是否正确
                    if($v['answer'] === $answer){
                        $total[$type][$k] = true;
                        $sum+=$score[$type];
                    }else{
                        $total[$type][$k]=false;
                    }

                }
            }
            $arr = [
                'score' => $sum,
                'total' =>$total
            ];
            return $this->wrapSuccessReturn(compact('arr'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }


    }

    public function test(Request $request)
    {
        $paperId = $request->input('paper_id');
        $examPaperModel = ExamPaperModel::whereId($paperId)->first();
        $data = [
            'title' =>$examPaperModel->title,
            'timeout'=>$examPaperModel->timeout,
            'pass'=>$examPaperModel->pass,
            'data'=>json_decode($examPaperModel->question,true)
        ];
        list($count,$score)=getDataInfo($data['data']);
//        dd($data);
        return view('admin.test',compact('data','count','score'));
    }
}