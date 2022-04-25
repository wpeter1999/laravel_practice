<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\Image;
use App\Models\Ad;
use App\Models\Mvim;
use App\Models\News;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->sidebar();
        $mvims=Mvim::where('sh',1)->get();
        $news=News::where('sh',1)->get()->filter(function($value,$index){
            if($index>4){
                $this->view['more']="/news";
            }else{
                return $value;
            }
        });
        $this->view['mvims']=$mvims;
        $this->view['news']=$news;

        return view('main',$this->view);
    }

    //主選單與圖片區
    protected function sidebar(){  
        $menus=Menu::where('sh',1)->get();
        $images=Image::where('sh',1)->get();
        $ads=\implode("　",AD::where('sh',1)->get()->pluck('text')->all());
        foreach($menus as $key =>$menu){
            $submenu=$menu->subs;
            $menu->submenu=$submenu;
            $menus[$key]=$menu;
        }
        $this->view['ads']=$ads;
        $this->view['menus']=$menus;
        $this->view['images']=$images;
    }

}
