<?php

class LivroController extends RenderViews
{

    private $livro;
    public function __construct()
    {
        $this->livro = new LivroDAO;
    }

    public function index()
    {
    }

    public function buscar()
    {
        $this->loadView("listaLivro", ['livros' => $this->livro->buscar()]);
    }

    public function show($id)
    {
        $idUser = $id[0];
        $this->loadView('A_listaUsuario', ['usuario' => $this->livro->fetchById($idUser)]);
    }

    public function create()
    {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $categoria = $_POST['categoria'];
        $descricao = $_POST['descricao'];
        $quantidade = $_POST['quantidade'];
        $editora = $_POST['editora'];
        $this->livro->create($titulo, $autor, $categoria, $descricao, $quantidade, $editora);
    }

    public function bookForm()
    {
        $this->loadView('adicionarLivro', []);
    }

    public function update()
    {
        $oldUser = $this->livro->getlivro();
        $titulo = $_POST['titulo'];
        $editora = $_POST['editora'];
        $autor = $_POST['autor'];
        $quantidade = $_POST['quantidade'];
        $categoria = $_POST['categoria'];
        $descricao = $_POST['descricao'];

        if (empty($nome = $_POST['nome'])) {
            $nome = $oldUser['nome'];
        }
        if (empty($email = $_POST['email'])) {
            $email = $oldUser['email'];
        }
        if (empty($senha = $_POST['senha'])) {
            $senha = $oldUser['senha'];
        }
        if (empty($nome = $_POST['nome'])) {
            $nome = $oldUser['nome'];
        }
        if (empty($email = $_POST['email'])) {
            $email = $oldUser['email'];
        }
        if (empty($senha = $_POST['senha'])) {
            $senha = $oldUser['senha'];
        }
        if (empty($senha = $_POST['senha'])) {
            $senha = $oldUser['senha'];
        }

        $livroDTO = new livroDTO($titulo, $editora, $autor, $quantidade, $categoria, $descricao);
        $this->livro->update($livroDTO);
        header('Location: /app/profile');
    }

    public function delete($id)
    {
        $idUser = $id[0];
        $this->livro->delete($idUser);
    }

    public function cliente()
    {
        $this->loadView('cliente', ['livros' => $this->livro->buscar()]);
    }
}