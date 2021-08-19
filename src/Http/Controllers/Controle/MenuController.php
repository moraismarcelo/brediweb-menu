<?php

namespace Brediweb\Menu\Http\Controllers\Controle;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Brediweb\Menu\Models\Menu;
use Brediweb\ImagemUpload\ImagemUpload;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->config = config('menu.config');

    }

    public function index()
    {
        $menus = Menu::orderBy('order')->get();

        return view('menu::controle.menu.index', compact('menus'));
    }


    public function create()
    {
        return view('menu::controle.menu.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|min:2'
        ]);

        try {

            $input = $request->all();
            $input['ativo'] = (isset($input['ativo'])) ? '1' : '0';

            $imagens = ImagemUpload::salva($this->config);



            if ($imagens) {
                $input['imagem'] = $imagens;
            }

            $menu = Menu::create($input);

            return redirect()->route('menu::controle.menu.index')->with('msg', 'Menu cadastrado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'Não foi possível salvar os dados')->with('error', true)->withInput();
        }
    }


    public function show($id)
    {
        return view('menu::show');
    }


    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('menu::controle.menu.form', compact('menu'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|min:2'
        ]);

        $input = $request->except('_token');
        $input['ativo'] = (isset($input['ativo'])) ? '1' : '0';

        $imagens = ImagemUpload::salva($this->config);

        if ($imagens) {
            $input['imagem'] = $imagens;
        }

        try {

            $menu = Menu::find($id)->update($input);

            return redirect()->route('menu::controle.menu.index')->with('msg', 'Registro atualizado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'Não foi possível alterar o registro')->with('error', true)->with('exception', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $menu = Menu::find($id);

            $imagem = $menu->imagem;

            $this->config['imagem'] = $imagem;

            $menu->delete();
            if (!empty($imagem)) {
                ImagemUpload::deleta($this->config);
            }

            return redirect()->route('menu::controle.menu.index')->with('msg', 'registro excluido com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('menu::controle.menu.index')->with('msg', 'não foi possível excluir o registro!')->with('exception', $e->getMessage());
        }
    }


}

