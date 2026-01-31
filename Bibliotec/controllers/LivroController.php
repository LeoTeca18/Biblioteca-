<?php
/**
 * Classe LivroController - Controlador de Livros
 * 
 * Gerencia todas as operações relacionadas aos livros do sistema,
 * incluindo cadastro, edição, exclusão e listagem.
 * 
 * @package Controllers
 * @extends RenderViews
 * @author Sistema LivraTec
 * @version 2.0
 */
class LivroController extends RenderViews
{
    /**
     * @var LivroDAO Instância do objeto de acesso a dados de livros
     */
    private $livro;
    
    /**
     * Construtor - Inicializa o DAO de livros
     */
    public function __construct()
    {
        $this->livro = new LivroDAO;
    }

    /**
     * Método index principal
     * 
     * @return void
     */
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

    /**
     * Cria um novo livro no sistema
     * 
     * Valida e sanitiza os dados recebidos do formulário antes de inserir no banco.
     * 
     * @return void
     */
    public function create()
    {
        // Validação de dados
        if (!isset($_POST['titulo']) || !isset($_POST['autor'])) {
            header('Location: adicionarLivro?erro=campos_obrigatorios');
            return;
        }
        
        // Sanitização dos dados
        $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_STRING);
        $autor = filter_var($_POST['autor'], FILTER_SANITIZE_STRING);
        $categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_STRING);
        $descricao = filter_var($_POST['descricao'], FILTER_SANITIZE_STRING);
        $editora = filter_var($_POST['editora'], FILTER_SANITIZE_STRING);
        
        $this->livro->create($titulo, $autor, $categoria, $descricao, $editora);
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

    /**
     * Exibe o formulário de busca avançada
     * 
     * @return void
     */
    public function buscaAvancada()
    {
        $livros = [];
        
        // Se houver filtros na requisição
        if (!empty($_GET)) {
            $filtros = [
                'titulo' => $_GET['titulo'] ?? '',
                'autor' => $_GET['autor'] ?? '',
                'categoria' => $_GET['categoria'] ?? '',
                'editora' => $_GET['editora'] ?? '',
                'status' => $_GET['status'] ?? ''
            ];
            
            $livros = $this->livro->advancedSearch($filtros);
        }
        
        $this->loadView('buscaAvancada', ['livros' => $livros]);
    }

    /**
     * Exibe a tela do cliente com livros disponíveis
     * 
     * @return void
     */
    public function cliente()
    {
        $this->loadView('cliente', ['livros' => $this->livro->buscar()]);
    }
}