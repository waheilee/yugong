<?php

namespace App\Jobs;


use App\Models\ExamRecordModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExamRecordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    private $userId;
    private $paperId;
    private $total;
    private $score;
    private $pass;
    private $logger;
    public function __construct($serUserId,$paperId,$total,$score,$pass)
    {
        $this->userId  = $serUserId;
        $this->paperId = $paperId;
        $this->total   = $total;
        $this->score   = $score;
        $this->pass    = $pass;
        $this->logger  = customerLoggerHandle("ExamPaperRecord");
    }

    public function handle()
    {
        $record = new ExamRecordModel();
        $record->ser_user_id = $this->userId;
        $record->paper_id = $this->paperId;
        $record->total = json_encode($this->total) ;
        $record->score = $this->score;
        $record->pass = $this->pass;
        $record->save();
    }
    
}