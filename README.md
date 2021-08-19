1 - no arquivo composer.json do Laravel, coloque:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://gitlab.com/pacotes-bredi/bredi-menu"
    }
]
```

2 - na linha de comando digite
`composer require brediweb/menu`

se o git exigir, coloque seu login e senha do gitlab para poder baixar o pacote.

3 - na linha de comando: `php artisan migrate`

4 - na linha de comando: `php artisan db:seed --class='Brediweb\Menu\Database\Seeders\MenuDatabaseSeeder'`

5 -  Funçoes disponiveis no pacote:

```
//Menus ativos
$menus = (new \Brediweb\Menu\Http\Controllers\Api\MenuController)->getMenus();

//Detalhe menu (Passe o slug do menu)
$menu = (new \Brediweb\Menu\Http\Controllers\Api\MenuController)->getDetalheMenu($slug);

//Detalhe pagina (Passe o slug da pagina)
$pagina = (new \Brediweb\Menu\Http\Controllers\Api\PaginaController)->getDetalhePagina($slug);
```
