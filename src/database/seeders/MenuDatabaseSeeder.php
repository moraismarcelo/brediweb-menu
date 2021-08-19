<?php

namespace Brediweb\Menu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Brediweb\BrediDashboard\Models\CategoriaTransacao;
use Brediweb\BrediDashboard\Models\Transacao;

class MenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        $categoriaTransacaos = [

            'Menu' => [
                [
                    'permissao' => 'controle.menu.index',
                    'descricao' => 'Listar Menu',
                ],
                [
                    'permissao' => 'controle.menu.create',
                    'descricao' => 'Cadastrar novo Menu',
                ],
                [
                    'permissao' => 'controle.menu.store',
                    'descricao' => 'Salvar novo Menu',
                ],
                [
                    'permissao' => 'controle.menu.edit',
                    'descricao' => 'Editar Menu',
                ],
                [
                    'permissao' => 'controle.menu.update',
                    'descricao' => 'Atualizar Menu',
                ],
                [
                    'permissao' => 'controle.menu.destroy',
                    'descricao' => 'Excluir Menu',
                ],
            ],

            'Paginas' => [
                [
                    'permissao' => 'controle.pagina.index',
                    'descricao' => 'Listar Menu',
                ],
                [
                    'permissao' => 'controle.pagina.create',
                    'descricao' => 'Cadastrar novo Menu',
                ],
                [
                    'permissao' => 'controle.pagina.store',
                    'descricao' => 'Salvar novo Menu',
                ],
                [
                    'permissao' => 'controle.pagina.edit',
                    'descricao' => 'Editar Menu',
                ],
                [
                    'permissao' => 'controle.pagina.update',
                    'descricao' => 'Atualizar Menu',
                ],
                [
                    'permissao' => 'controle.pagina.destroy',
                    'descricao' => 'Excluir Menu',
                ],
            ]

        ];

        foreach ($categoriaTransacaos as $nome => $categoriaTransacao)
        {
            $categoria = CategoriaTransacao::updateOrCreate([
                'nome' => $nome
            ], [
                'nome' => $nome
            ]);

            if (isset($categoria->id)) {
                $this->command->info($categoria->nome . ' Adicionado com sucesso!');

                foreach ($categoriaTransacao as $transacao) {
                    $transacao['categoria_transacao_id'] = $categoria->id;

                    $novaTransacao = Transacao::updateOrCreate([
                        'permissao' => $transacao['permissao'],
                    ], $transacao);

                    if (isset($novaTransacao->id)) {
                        $this->command->info($novaTransacao->permissao . ' Adicionado com sucesso!');
                    }
                }
            }

        }



    }
}
