<?php

$routes = [
    '/' => 'HomeController@index',
    '/home' => 'HomeController@index',
    '/login' => 'UsuarioController@login',
    '/logout' => 'UsuarioController@logout',
    '/cadastrar' => 'UsuarioController@cadastrar',
    '/cadastro' => 'UsuarioController@UserForm',
    '/apagar/{id}' => 'UsuarioController@delete',
    '/usuario/{id}' => 'UsuarioController@show',
    '/listaUsuario' => 'UsuarioController@buscar',
    '/ativarUsuario' => 'UsuarioController@buscarA',
    '/desativarUsuario' => 'UsuarioController@buscarD',
    '/listaUsuario' => 'UsuarioController@buscar',
    '/ativar/{id}' => 'UsuarioController@ativarUsuario',
    '/desativar/{id}' => 'UsuarioController@desativarUsuario',
    '/dashboard' => 'UsuarioController@dashboard',
    '/usuario' => 'UsuarioController@show',

    '/adicionar' => 'LivroController@create',
    '/adicionarLivro' => 'LivroController@bookForm',
    '/listaLivro' => 'LivroController@buscar',
    '/apagarLivro/{id}' => 'LivroController@delete',
    '/editarLivro/{id}' => 'LivroController@update',
    '/cliente' => 'LivroController@cliente',

    '/emprestimo' => 'EmprestaController@emprestimo',
    '/emprestimoA' => 'EmprestaController@emprestimoA',
    '/emprestar' => 'EmprestaController@emprestar',

];