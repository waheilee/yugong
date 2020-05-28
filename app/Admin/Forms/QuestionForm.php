<?php

namespace App\Admin\Forms;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Tags;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionForm extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '选择题';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $questionModel = new Question();
        $question = $request->input('question');
        $option = $request->input('option');
        $answer = $request->input('answer');
        $analysis = $request->input('analysis');
        $tag = $request->input('tags');
        try {
            DB::beginTransaction();
            $questionModel->type = 1;//选择题
            $questionModel->question = $question;
            $questionModel->answer = json_encode($answer);
            $questionModel->analysis = $analysis;
            $questionModel->tags = json_encode(array_filter($tag));
            $questionModel->save();

            foreach ($option as $item=>$k){
                $optionAnswerModel = new Answer();
                $optionAnswerModel->question_id = $questionModel->id;
                $optionAnswerModel->option = $this->getKey($item);
                $optionAnswerModel->answer = $k['value'];
                $optionAnswerModel->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('danger', $e->getMessage());
        }
        admin_success('添加成功');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {


        $this->text('question', '题目')->rules('required');
        $this->table('option', '',function ($table) {
            $table->text('value','问题选项');
        });
        $this->text('answer', '答案')->rules('required')->placeholder('单选题输入一个答案，多选题输入多个并以英文逗号相隔。举例：A,B,C,D');
        $this->text('analysis', '解析')->rules('required')->placeholder('题目解析');
        $this->multipleSelect('tags','标签')->options(Tags::all()->pluck('tag', 'id'));

        $this->divide();
        return $this;
//        Admin::css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css');
//        Admin::js('/vendor/js/appendGrid.js');
//        Admin::js('/vendor/js/question.js');
//
//        $form = new Form();
////        $this->hidden('test1','测试1');
////        $this->hidden('test2','测试2');
////        $this->hidden('test3','测试3');
////        $this->hidden('test4','测试4');
//        $this->select('project_id', '类型')->options( [1=>'测试1',2=>'测试2',3=>'测试3',4=>'测试4'])->attribute(['id'=>'project_id']);
//        $this->html(view('admin.question.form'));
//
//
//        return $form;
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
            'name'       => 'John Doe',
            'email'      => 'John.Doe@gmail.com',
            'created_at' => now(),
        ];
    }

    public function getKey($key)
    {
        switch ($key){
            case 'new_1': $key = 'A';break;
            case 'new_2': $key = 'B';break;
            case 'new_3': $key = 'C';break;
            case 'new_4': $key = 'D';break;
            case 'new_5': $key = 'E';break;
            case 'new_6': $key = 'F';break;
            case 'new_7': $key = 'G';break;
            case 'new_8': $key = 'H';break;
            case 'new_9': $key = 'I';break;
        }
        return $key;
    }

}
