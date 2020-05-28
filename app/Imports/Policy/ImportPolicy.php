<?php

namespace App\Imports\Policy;

use App\Jobs\SendPolicyCode;
use App\Models\Policy;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportPolicy implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // 0代表的是第一列 以此类推
        // $row 是每一行的数据
//        $model = new Policy([
//            'user_name' => $row[0],
//            'user_phone' => $row[1],
//            'user_card_id' => $row[2],
//            'code' => $this->CreateCode(),
//            'type' => $row[3],
//        ]);
//        dispatch(new SendPolicyCode($model->user_name,$model->user_phone,$model->code));
//        return $model;
//        dd($model->user_name);
        return new Policy([
            'user_name' => $row[0],
            'user_phone' => $row[1],
            'user_card_id' => $row[2],
            'code' => $this->CreateCode(),
            'type' => $row[3],
        ]);
    }

    /**
     * 从第几行开始处理数据 就是不处理标题
     * @return int
     */
    public function startRow():int
    {
        return 2;
    }

    /**
     * 生成激活码 并返回
     * @return string
     */
    public function CreateCode() {
        $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand = $code[rand(0,25)]
            .strtoupper(dechex(date('m')))
            .date('d').substr(time(),-5)
            .substr(microtime(),2,5)
            .sprintf('%02d',rand(0,99));
        for(
            $a = md5( $rand, true ),
            $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',
            $d = '',
            $f = 0;
            $f < 8;
            $g = ord( $a[ $f ] ),
            $d .= $s[ ( $g ^ ord( $a[ $f + 8 ] ) ) - $g & 0x1F ],
            $f++
        );
        return $d;
    }
}
