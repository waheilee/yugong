<?php

namespace App\Admin\Forms;


use App\Models\Question;
use App\Models\Tags;
use Encore\Admin\Widgets\Form;
//use Ichynul\RowTable\TableRow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TorFQuestionForm extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '判断题';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
//        dd($request->all());
        $questionModel = new Question();
        $question = $request->input('question');
        $answer = $request->input('answer');
        $analysis = $request->input('analysis');
        $tag = $request->input('tags');

        try {
            DB::beginTransaction();
            $questionModel->type = 3;//判断对错题
            $questionModel->question = $question;
            $questionModel->answer = $answer;
            $questionModel->analysis = $analysis;
            $questionModel->tags = json_encode(array_filter($tag));
            $questionModel->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('danger', $e->getMessage());
        }
        admin_toastr('添加成功','success');

        return redirect('admin/question');
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $this->text('question', '题目')->rules('required');
        $this->radio('answer', '答案')->options([ '1' => '对', '2' => '错'])->rules('required');
        $this->textarea('analysis', '解析')->rules('required');
        $this->multipleSelect('tags','标签')->options(Tags::all()->pluck('tag', 'id'));

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
}