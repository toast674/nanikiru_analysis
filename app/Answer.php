<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Answer extends Model
{
    protected $table = 'answers';

    public function question() {
        return $this->belongsTo('App\Question');
    }
}
