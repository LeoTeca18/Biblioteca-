<?php

class UsuarioController extends RenderViews
{
    private $usuario;
    public function __construct()
    {
        $this->usuario = new UsuarioDAO();
    }
    public function index()
    {
        
    }

    public function show($id)
    {
        $idUser = $id[0];
        $this->loadView('A_listaUsuario', ['usuario' => $this->usuario->fetchById($idUser)]);
    }
    
    public function cadastrar()
    {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $admin = $_POST['admin'];
        
        $this->usuario->cadastrar($nome, $email, $senha, $admin);
    }

    public function UserForm()
    {
        $this->loadView('cadastro', []);
    }

    public function delete($id)
    {
        $idUser = $id[0];
        $this->usuario->delete($idUser);
    }

    public function apagado(){
        $this->loadView('listaUsuario', []);
    }

    public function logout()
    {
        $this->usuario->logout();
    }


    public function login()
    {
        if(isset($_POST['email']) && isset($_POST['senha']))
        {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $this->usuario->logins($email, $senha);
        }
        else
        {
            $this->loadView('login', []);
        } 
    }


    public function dashboard()
    {   
        $this->loadView('dashboard', []);
    }

    public function buscar()
    {
        $this->loadView("listaUsuario", ['usuarios' => $this->usuario->buscar()]);
    }
}