<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\QuestionType;
use App\Answer;

//何切るコントローラー
class NanikiruController extends Controller
{
    public function test() {
        return view('test');
    }

    public function index() {
        //全ての問牌姿
        $paishi_image_array = [];
        //全ての問題選択肢
        $answer_choice_array = [];
        //全ての問題ポイント
        $answer_point_array = [];
        //全ての問題タイプ
        $question_type_array = [];

        $questions = Question::with('answer')->get();
        foreach($questions as $question) {
            //問題牌姿
            $paishi_image_array[] = $this->convertPaishi($question->question);
            //問題ドラ
            $dora_array[] = $this->convertPai($question->dora);
        }

        $answers = Answer::with('question')->get();
        foreach($answers as $answer) {
            //問題選択肢
            $answer_choice_array[$answer->question_id][] = $this->convertPai($answer->choice);
            //問題ポイント
            $answer_point_array[$answer->question_id][] = $answer->point;
            //問題タイプID
            $answer_question_type_array[$answer->question_id][] = $answer->question->question_type_id;
        }

        $question_types = QuestionType::all();
        foreach($question_types as $type) {
            $question_type_array[$type->id] = $type->description;
        }
        return view('nanikiru', compact('questions', 'answers', 'paishi_image_array', 'answer_choice_array', 'answer_point_array', 'question_type_array', 'answer_question_type_array', 'dora_array'));
    }

    public function result(Request $request) {
        $all_request = $request->all();
        unset($all_request['_token']);
        //結果の配列
        $result_array = [];

        foreach($all_request as $key => $request) {
            $question_type = $key[-1];
            //問題タイプごとの累計得点と満点を計算
            if(array_key_exists($question_type, $result_array)) {
                $result_array[$question_type]['get_score'] += $request;
                $result_array[$question_type]['perfect_score'] += 5;
            } else {
                $result_array[$question_type]['get_score'] = $request;
                $result_array[$question_type]['perfect_score'] = 5;
            }
        }
        return view('result', compact('result_array'));
    }

    /**
     * 牌姿(14枚)の文字列をimage名の配列に変換
     * @return 画像名の配列
     */
    private function convertPaishi($paishi) : Array {
        $paishi_image_array = [];

        //萬子を抜き出す
        $m = 0;
        $is_aka5man = false;
        $manzu = strpos($paishi, 'm');
        if($manzu) {
            for($i = 0; $i < $manzu; $i++) {
                //萬子が存在する
                $m = 1;
                //赤チェック
                if($is_aka5man) {
                    $paishi_image_array[] = 'aka5man.png';
                    $is_aka5man = false;
                    continue;
                }
                if($paishi[$i] === 'r') {
                    $is_aka5man = true;
                    continue;
                }
                //png画像の配列作成
                $paishi_image_array[] = 'man'. $paishi[$i] .'.png';
            }
        }
        //次回筒子用
        $pinzu_start = $i+$m;

        //筒子を抜き出す
        $p = 0;
        $is_aka5pin = false;
        $pinzu = strpos($paishi, 'p');
        if($pinzu) {
            for($i = $pinzu_start; $i < $pinzu; $i++) {
                //筒子が存在する
                $p = 1;
                //赤チェック
                if($is_aka5pin) {
                    $paishi_image_array[] = 'aka5pin.png';
                    $is_aka5pin = false;
                    continue;
                }
                if($paishi[$i] === 'r') {
                    $is_aka5pin = true;
                    continue;
                }
                //png画像の配列作成
                $paishi_image_array[] = 'pin'. $paishi[$i] .'.png';
            }
        }

        //次回索子用
        $souzu_start = $i+$p;
        //索子を抜き出す
        $s = 0;
        $is_aka5sou = false;
        $souzu = strpos($paishi, 's');
        if($souzu) {
            for($i = $souzu_start; $i < $souzu; $i++) {
                $s = 1;
                //赤チェック
                if($is_aka5sou) {
                    $paishi_image_array[] = 'aka5sou.png';
                    $is_aka5sou = false;
                    continue;
                }
                if($paishi[$i] === 'r') {
                    $is_aka5sou = true;
                    continue;
                }
                //png画像の配列作成
                $paishi_image_array[] = 'sou'. $paishi[$i] .'.png';
            }
        }

        //次回字牌用
        $jihai_start = $i+$s;

        //字牌を抜き出す
        $jihai = strpos($paishi, 'z');
        for($i = $jihai_start; $i < $jihai; $i++) {
            if($paishi[$i] == "p"){
                continue;
            }
            //png画像の配列作成
            $paishi_image_array[] = 'ji'. $paishi[$i] .'.png';
        }
        return $paishi_image_array;
    }

    /**
     * 牌の文字列(ex,3s,r5s,j1)を牌の画像名に変換
     * return 牌画名の文字列
     */
    private function convertPai($pai) {
        //赤の場合
        if($pai[0] === "r") {
            switch($pai[-1]) {
                case "m":
                    return 'aka5man.png';
                    break;
                case "p":
                    return 'aka5pin.png';
                    break;
                case "s":
                    return 'aka5sou.png';
                    break;
            }
        }

        switch($pai[-1]) {
            case "z":
                return 'ji'. $pai[-2] .'.png';
                break;
            case "m":
                return 'man'. $pai[-2] .'.png';
                break;
            case "p":
                return 'pin'. $pai[-2] .'.png';
                break;
            case "s":
                return 'sou'. $pai[-2] .'.png';
                break;
        }
        return false;
    }
}
