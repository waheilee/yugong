<?php

namespace App\Admin\Forms;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Tags;
use Encore\Admin\Form\NestedForm;
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
        $option = $request->input('option.values');
        $answer = $request->input('answer');
        $analysis = $request->input('analysis');
        $tag = $request->input('tags');

        try {
            DB::beginTransaction();
            $questionModel->type = 1;//选择题
            $questionModel->question = $question;
            $questionModel->answer = $answer;
            $questionModel->analysis = $analysis;
            $questionModel->tags = json_encode(array_filter($tag));
            $questionModel->save();

            foreach ($option as $item=>$k){
                $optionAnswerModel = new Answer();
                $optionAnswerModel->question_id = $questionModel->id;
                $optionAnswerModel->option = $this->getKey($item);
                $optionAnswerModel->answer = $k;
                $optionAnswerModel->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('danger', $e->getMessage());
        }
        admin_toastr('添加成功','success');

        return redirect('admin/question');
    }


    /**
     * @return $this
     */
    public function form()
    {

        $this->text('question', '题目')->rules('required');
//        $this->table('option', '标题',function ($table) {
//            $table->text('value','问题选项');
//        });
        $this->list('option','选项')->placeholder('A，B，C，D选项。可添加多个选项');
        $this->text('answer', '答案')->rules('required')->placeholder('单选题输入一个答案，多选题输入多个并以英文逗号相隔。举例：A,B,C,D');
        $this->text('analysis', '解析')->rules('required')->placeholder('题目解析');
        $this->multipleSelect('tags','标签')->options(Tags::all()->pluck('tag', 'id'));

        return $this;
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
            case 0: $key = 'A';break;
            case 1: $key = 'B';break;
            case 2: $key = 'C';break;
            case 3: $key = 'D';break;
            case 4: $key = 'E';break;
            case 5: $key = 'F';break;
            case 6: $key = 'G';break;
            case 7: $key = 'H';break;
            case 8: $key = 'I';break;
        }
        return $key;
    }

}
