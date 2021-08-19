<?php

namespace Brediweb\Menu\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Brediweb\Menu\Models\Pagina;


class PaginaController extends Controller
{

    public function detalhe($slug)
    {
        $pagina = Pagina::whereSlug($slug)->whereAtivo('1')->orderBy('order')->first();
        if(!count($pagina)){
            return sendError('Nenhuma página encontrado.', 404);
        }
        return sendResponse($pagina,'Detalhe da pagina');
    }

    public function getDetalhePagina($slug)
    {
        $pagina = Pagina::orderBy('order')->whereSlug($slug)->whereAtivo('1')->first();
        return $pagina;
    }

}

