<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 戦術書チャートコントローラー
class BookChartController extends Controller
{
    // 
    public function index() {
        return view('chart');
    }
}
