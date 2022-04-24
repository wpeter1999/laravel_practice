<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $all=Menu::all();
        $cols=['主選單名稱','連結網址','次選單數','顯示','編輯','刪除',''];
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
                    'tag' =>'',
                    'text' =>$a->subs->count(),
                ],
                [
                    'tag' =>'button',
                    'type' =>'button',
                    'btn_color' =>'btn-success',
                    'action' =>'show',
                    'id' =>$a->id,
                    'text'=>($a->sh==1)?'顯示':'隱藏',
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
                [
                    'tag' =>'button',
                    'type' =>'button',
                    'btn_color' =>'btn-warning',
                    'action' =>'sub',
                    'id' =>$a->id,
                    'text'=>'次選單',
                ],
            ];
            $rows[]=$tmp;
        }

        //dd($rows);
        $this->view['header']= '選單管理';
        $this->view['module']='menu';
        $this->view['cols']=$cols;
        $this->view['rows']=$rows;

        return view('backend.module',$this->view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view=[
            'action'=>'/admin/menu',
            'modal_header' => '新增主選單',
            'modal_body' =>[
                [
                    'label' => '主選單名稱',
                    'tag'=>'input',
                    'type' => 'text',
                    'name' => 'text'
                ],
                [
                    'label' => '主選單網址',
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
    public function store(Request $request)
    {
        //無檔案處理需求
        $menu=new Menu;
        $menu->text=$request->input('text');
        $menu->href=$request->input('href');
        $menu->save();
        
        //
        return redirect('/admin/menu');
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
        $menu=Menu::find($id);
        $view=[
            'action'=>'/admin/menu/'.$id,
            'method'=>'patch',
            'modal_header' => '編輯主選單資料',
            'modal_body' =>[
                [
                    'label' => '主選單名稱',
                    'tag'=>'input',
                    'type' => 'text',
                    'name' => 'text',
                    'value' =>$menu->text
                ],
                [
                    'label' => '主選單網址',
                    'tag'=>'input',
                    'type' => 'text',
                    'name' => 'href',
                    'value' => $menu->href
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
        $menu=Menu::find($id);

        if($menu->text!=$request->input('text')){
            $menu->text=$request->input('text');
        }
        if($menu->href!=$request->input('href')){
            $menu->href=$request->input('href');
        }

        $menu->save();
        return redirect('/admin/menu');
    }

    /**
     * 改變資料顯示狀態
     */
    public function display($id) {
        $menu=Menu::find($id);
        $menu->sh=($menu->sh+1)%2;
        $menu->save();
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
        Menu::destroy($id);
    }
}
