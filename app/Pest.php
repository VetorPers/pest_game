<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pest extends Model
{
    protected $fillable = ['name', 'tree_sign'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
