<?php

return [
    'name' => 'Menu',

    /*
    * Carrega automaticamente no menu principal.
    */
    'autoload_menu' => true,

    'config' => [
        'input_file' => 'imagem',
        'destino' => 'menu/',
        'resolucao' => ['p' => ['h' => 300, 'w' => 300], 'g' => ['h' => 900, 'w' => 900]]
    ],
    'configPagina' => [
        'input_file' => 'imagem',
        'destino' => 'pagina/',
        'resolucao' => ['p' => ['h' => 300, 'w' => 300], 'g' => ['h' => 900, 'w' => 900]]
    ]

];
