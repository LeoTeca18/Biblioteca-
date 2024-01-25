<?php

class HomeController extends RenderViews
{
    public function index()
    {
        $usuario = new UsuarioDAO();

        $this->loadView('home', [
            'title' => 'Home Page',
            'usuario' => $usuario->fetch()
        ]);
    }
}