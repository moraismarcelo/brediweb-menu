<?php

namespace Brediweb\Menu\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Brediweb\Menu\Models\Menu;


class MenuController extends Controller
{

    public function detalhe($slug = null)
    {
        $menu = Menu::orderBy('order')->with('paginas')->whereAtivo('1');
        if(isset($slug)){
            $menus = $menu->whereSlug($slug)->first();
        }else{
            $menus = $menu->get();
        }

        if(count($menus)){
            return sendResponse($menus,'Menus cadastrados.');
        }
        return sendError('Nenhum menu encontrado.', 404);
    }

    public function getMenus()
    {
        $menus = Menu::orderBy('order')->whereAtivo('1')->get();
        return $menus;
    }

    public function getDetalheMenu($slug)
    {
        $menu = Menu::orderBy('order')->whereSlug($slug)->whereAtivo('1')->first();
        return $menu;
    }

}

