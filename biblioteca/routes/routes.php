<?php

$routes = [
    '/' => 'HomeController@index',
    '/home' => 'HomeController@index',
    '/adicionar' => 'LivroController@create',
    '/adicionarLivro' => 'LivroController@bookForm',
    '/cadastrar' => 'UsuarioController@cadastrar',
    '/cadastro' => 'UsuarioController@UserForm',
    '/listaLivro' => 'LivroController@buscar',
    '/listaUsuario' => 'UsuarioController@buscar',
    '/login' => 'UsuarioController@login',
    '/logout' => 'UsuarioController@logout',
    '/apagar/{id}' => 'UsuarioController@delete',
    '/apagado' => 'UsuarioController@apagado',
    //'/cadastrar' => 'UsuarioController@cadastro',
    //'/cadastro' => 'UsuarioController@userForm',
    '/usuario/{id}' => 'UsuarioController@show',
  
    '/dashboard' => 'UsuarioController@dashboard',
    '/usuario' => 'UsuarioController@show',
   
];