<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Total;

class TotalController extends Controller
{
    public function index()
    {
        $total=Total::first();
        $cols=['進站總人數'];
        $rows=[
            
                [
                    'text' =>$total->total,
                ],
                [
                    'tag' =>'button',
                    'type' =>'button',
                    'btn_color' =>'btn-info',
                    'action' =>'edit',
                    'id' =>$total->id,
                    'text'=>'編輯',
                ],

        ];

        $this->view['header']= '進站總人數管理';
        $this->view['module']='total';
        $this->view['cols']=$cols;
        $this->view['rows']=$rows;

        return view('backend.module',$this->view);
    }

    public function edit($id)
    {
        //
        $total=Total::first();
        $view=[
            'action'=>'/admin/total/'.$id,
            'method'=>'patch',
            'modal_header' => '編輯進站總人數',
            'modal_body' =>[
                [
                    'label' => '進站總人數',
                    'tag'=>'input',
                    'type' => 'number',
                    'name' => 'total',
                    'value' => $total->total
                ],
            ],
        ];
        return view('modals.base_modal',$view);

    }

    public function update(Request $request, $id)
    {
        //
        $total=Total::first();

        if($total->total!=$request->input('total')){
            $total->total=$request->input('total');
            $total->save();
        }
        

        return redirect('/admin/total');
    }


}
