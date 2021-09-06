<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],
    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],
    '/usuarios/?' => [
        'GET' => '\Controlador\UsuarioControlador#mostrar',
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
    '/receitas' => [
        'GET' => '\Controlador\ReceitaControlador#index',
        'POST' => '\Controlador\ReceitaControlador#armazenar',
    ],
    '/receitas/?' => [
        'GET' => '\Controlador\ReceitaControlador#mostrar',
        'PATCH' => '\Controlador\ReceitaControlador#atualizar',
        'DELETE' => '\Controlador\ReceitaControlador#destruir',
    ],
    '/receitas/?/editar' => [
        'GET' => '\Controlador\ReceitaControlador#editar',
    ],
    '/receitas/criar' => [
        'GET' => '\Controlador\ReceitaControlador#criar',
    ],
    '/receitas/listar' => [
        'GET' => '\Controlador\ReceitaControlador#listar',
    ],
    '/receitas/relatorio' => [
        'GET' => '\Controlador\ReceitaControlador#relatorio',
    ],
    '/receitas/visualizar' => [
        'GET' => '\Controlador\ReceitaControlador#visualizar',
    ],
    '/comentarios' => [
        'POST' => '\Controlador\ComentarioControlador#armazenar',
    ],
    '/comentarios/?' => [
        'DELETE' => '\Controlador\ComentarioControlador#destruir',
    ],
];
