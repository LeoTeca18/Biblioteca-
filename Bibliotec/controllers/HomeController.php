<?php
/**
 * Classe HomeController - Controlador da Página Inicial
 * 
 * Gerencia a exibição da página home do sistema.
 * 
 * @package Controllers
 * @extends RenderViews
 * @author Sistema LivraTec
 * @version 2.0
 */
class HomeController extends RenderViews
{
    /**
     * Exibe a página inicial do sistema
     * 
     * @return void
     */
    public function index()
    {
        $usuario = new UsuarioDAO();

        $this->loadView('home', [
            'title' => 'Home Page',
            'usuario' => $usuario->fetch()
        ]);
    }
}