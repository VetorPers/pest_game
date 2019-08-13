<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'type', 'desc', 'img', 'level'];

    public function getImgAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
