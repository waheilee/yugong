<?php


namespace App\Http\Controllers\Api;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\ExamPaperModel;
use Illuminate\Http\Request;


class ExamPaperController extends Controller
{
    /**
     * 获取试卷
     * @param Request $request
     * @return array
     */
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
                'data'=>$this->answerNull(json_decode($examPaperModel->question,true))
            ];
            list($count,$score)=getDataInfo($data['data']);

            $arr = [
                'data'=>$data,
                'count' =>$count,
                'score' =>$score
            ];
            return $this->wrapSuccessReturn(compact('arr'));
        } catch (\Exception $exception) {
            return $this->wrapErrorReturn($exception);
        }

    }

    /**
     * 提交试卷并返回成绩
     * @param Request $request
     * @return array
     */
    public function total(Request $request)
    {
        try{
            $paper_id = $request->input('paper_id');
            $examPaperModel = ExamPaperModel::whereId($paper_id)->first();
            if (!$examPaperModel){
                throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "没有此试卷");
            }
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
                        $arr = json_decode($request->input("$type"));
                        $check = $arr[$k] ;
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
            $pass = $sum>=$data['pass']?true:false;
            $arr = [
                'score' => $sum,//考试成绩
                'total' =>$total,//答题对错情况
                'count' =>$count,//每大题题数
                'pass' => $pass//是否通过
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

    //将试卷答案设置为空返回给前端
    protected function answerNull($data)
    {
        foreach ($data as $type=>$each){
            foreach ($each['data'] as $k=>$v){
                $data[$type]['data'][$k]['answer'] = '';
            }
        }
        return $data;
    }
}