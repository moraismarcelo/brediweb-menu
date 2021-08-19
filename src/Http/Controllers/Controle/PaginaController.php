<?php

namespace Brediweb\Menu\Http\Controllers\Controle;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Brediweb\Menu\Models\Pagina;
use Brediweb\Menu\Models\Menu;
use Brediweb\ImagemUpload\ImagemUpload;

class PaginaController extends Controller
{
    public function __construct()
    {
        $this->config = config('menu.configPagina');

    }

    public function index()
    {
        $paginas = Pagina::orderBy('order')->get();

        return view('menu::controle.pagina.index', compact('paginas'));
    }


    public function create()
    {
        $data = ['menus', 'paginas'];
        $menus = Menu::orderBy('order')->pluck('titulo', 'id')->toArray();
        $paginas = Pagina::orderBy('order')->pluck('titulo', 'id')->toArray();
        return view('menu::controle.pagina.form', compact($data));
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

            $pagina = Pagina::create($input);

            return redirect()->route('menu::controle.pagina.index')->with('msg', 'Página cadastrado com sucesso!');

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
        $data = ['menus', 'pagina', 'paginas'];
        $pagina = Pagina::find($id);
        $menus = Menu::orderBy('order')->pluck('titulo', 'id')->toArray();
        $paginas = Pagina::orderBy('order')->pluck('titulo', 'id')->toArray();
        return view('menu::controle.pagina.form', compact($data));
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

            $pagina = Pagina::find($id)->update($input);

            return redirect()->route('menu::controle.pagina.index')->with('msg', 'Registro atualizado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'Não foi possível alterar o registro')->with('error', true)->with('exception', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $pagina = Pagina::find($id);

            $imagem = $pagina->imagem;

            $this->config['imagem'] = $imagem;

            $pagina->delete();
            if (!empty($imagem)) {
                ImagemUpload::deleta($this->config);
            }

            return redirect()->route('menu::controle.pagina.index')->with('msg', 'registro excluido com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('menu::controle.pagina.index')->with('msg', 'não foi possível excluir o registro!')->with('exception', $e->getMessage());
        }
    }


}

