<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;

class AdController extends Controller
{
    public function index()
    {
        return view('backend.module',['header' => '動態廣告文字管理','module' => 'ad']);
        
    }
    
    public function create()
    {
        $view=[
            'modal_header' => '新增動態廣告文字',
            'modal_body' =>[
                [
                    'label' => '動態廣告文字',
                    'tag'=>'input',
                    'type' => 'text',
                    'name' => 'text'
                ],
            ],
        ];
        return view('modals.base_modal',$view);
    }
}
