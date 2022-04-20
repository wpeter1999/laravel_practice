<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MvimController extends Controller
{
    public function index()
    {
        return view('backend.module',['header' => '動畫管理','module' => 'mvim']);
    }
}
