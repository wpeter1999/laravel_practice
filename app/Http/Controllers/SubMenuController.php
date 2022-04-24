<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubMenu;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($menu_id)
    {
        $all=SubMenu::where('menu_id', $menu_id)->get();
        $cols=['次主選單名稱','次選單連結網址','編輯','刪除'];
        $rows=[];

        foreach($all as $a){
            $tmp=[
                [
                    'tag' =>'',
                    'text' =>$a->text,
                ],
                [
                    'tag' =>'',
                    'text' =>$a->href,
                ],
                [
                    'tag' =>'button',
                    'type' =>'button',
                    'btn_color' =>'btn-info',
                    'action' =>'edit',
                    'id' =>$a->id,
                    'text'=>'編輯',
                ],
                [
                    'tag' =>'button',
                    'type' =>'button',
                    'btn_color' =>'btn-danger',
                    'action' =>'delete',
                    'id' =>$a->id,
                    'text'=>'刪除',
                ],
            ];
            $rows[]=$tmp;
        }

        //dd($rows);
        $this->view['header']= '次選單管理';
        $this->view['module']='submenu';
        $this->view['cols']=$cols;
        $this->view['rows']=$rows;
        $this->view['menu_id']=$menu_id;


        return view('backend.module',$this->view);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($menu_id)
    {
        $view=[
            'action'=>'/admin/submenu/'.$menu_id,
            'modal_header' => '新增次選單',
            'modal_body' =>[
                [
                    'label' => '次選單名稱',
                    'tag'=>'input',
                    'type' => 'text',
                    'name' => 'text'
                ],
                [
                    'label' => '次選單網址',
                    'tag'=>'input',
                    'type' => 'text',
                    'name' => 'href'
                ],
            ],
        ];
        return view('modals.base_modal',$view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$menu_id)
    {
        //無檔案處理需求
        $submenu=new SubMenu;
        $submenu->text=$request->input('text');
        $submenu->href=$request->input('href');
        $submenu->menu_id=$menu_id;
        $submenu->save();
        
        //
        return redirect('/admin/submenu/'.$menu_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $submenu=SubMenu::find($id);
        $view=[
            'action'=>'/admin/submenu/'.$id,
            'method'=>'patch',
            'modal_header' => '編輯網站標題資料',
            'modal_body' =>[
                [
                    'label' => '次選單名稱',
                    'tag'=>'input',
                    'type' => 'text',
                    'name' => 'text',
                    'value' =>$submenu->text
                ],
                [
                    'label' => '次選單網址',
                    'tag'=>'input',
                    'type' => 'text',
                    'name' => 'href',
                    'value' => $submenu->href
                ],
            ],
        ];
        return view('modals.base_modal',$view);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $submenu=SubMenu::find($id);

        if($submenu->text!=$request->input('text')){
            $submenu->text=$request->input('text');
        }
        if($submenu->href!=$request->input('href')){
            $submenu->href=$request->input('href');
        }
        
        $submenu->save();
        return redirect('/admin/submenu/'.$submenu->menu_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        SubMenu::destroy($id);
    }
}
