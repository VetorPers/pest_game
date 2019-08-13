<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordDetail extends Model
{
    protected $fillable = ['record_id', 'question_id', 'answer_ids'];
}
