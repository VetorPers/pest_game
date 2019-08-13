<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'type', 'right_answers', 'desc', 'img', 'level'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function answer1()
    {
        return $this->hasOne(Answer::class);
    }

    public function answer2()
    {
        return $this->hasOne(Answer::class)->offset(1)->limit(1);
    }

    public function answer3()
    {
        return $this->hasOne(Answer::class)->offset(2)->limit(1);
    }

    public function answer4()
    {
        return $this->hasOne(Answer::class)->offset(3)->limit(1);
    }
}
