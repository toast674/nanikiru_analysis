<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\QuestionType;
use App\Answer;
use App\Book;
use App\Requests\NanikiruRequest;

//何切るコントローラー
class TestController extends Controller
{
    // 問題画面
    public function index() {
        return view('test');
    }
}
