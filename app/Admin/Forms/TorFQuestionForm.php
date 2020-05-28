<?php

namespace App\Admin\Forms;


use Encore\Admin\Widgets\Form;
use Ichynul\RowTable\TableRow;
use Illuminate\Http\Request;

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
        dd($request->all());

        admin_success('Processed successfully.');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $this->text('somerow', '题目')->rules('required');
        $this->radio('gender', '答案')->options([ '1' => '对', '2' => '错'])->rules('required');
        $this->textarea('gender', '解析')->rules('required');
//        $this->show("<h3>************Demo 3 , use div build a user center ************</h3>")->textWidth('100%')->textAlign('center');
//
//        $userRow = new TableRow();
//        $userRow->text('name', '',6);
//        //$userRow->html('<span style="margin-top:10px;" class="label label-warning">没个性也签名~</span>', '个性签名', 6);
//
//        $userRow1 = new TableRow();
//        $userRow1->text('name', '',6);
//
//        $userRow2 = new TableRow();
////        $userRow2->number('age', '年龄', 6)->max(99)->min(18);
//        $userRow2->radio('gender', '答案',6)->options([ '1' => '对', '2' => '错']);
//
//        //$userRow2->date('birthday', '生日', 6)->rules('required');
//
//        $userRow2->textarea('about', '题目解析', 12)->setWidth(10, 2); //独占一行，因为其他行有两列
//
//        $this->rowtable('', '11')
//            ->setRows([$userRow, $userRow1, $userRow2])
//            ->useDiv(true);
//
//        $this->divide();
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