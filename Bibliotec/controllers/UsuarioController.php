<?php
/**
 * Classe UsuarioController - Controlador de Usuários
 * 
 * Gerencia todas as operações relacionadas aos usuários do sistema,
 * incluindo cadastro, autenticação, ativação/desativação e exclusão.
 * 
 * @package Controllers
 * @extends RenderViews
 * @author Sistema LivraTec
 * @version 2.0
 */
class UsuarioController extends RenderViews
{
    /**
     * @var UsuarioDAO Instância do objeto de acesso a dados de usuários
     */
    private $usuario;
    
    /**
     * Construtor - Inicializa o DAO de usuários
     */
    public function __construct()
    {
        $this->usuario = new UsuarioDAO();
    }
    public function index()
    {
        if (!isset($SESSION["usuario"])) {
            # code...
            exit("Precisa iniciar sessão");
        }
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
        
        $this->usuario->cadastrar($nome, $email, $senha);
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

    public function ativarUsuario($id)
    {
        $idUser = $id[0];
        $this->usuario->ativarUsuario($idUser);
    }

    public function desativarUsuario($id)
    {
        $idUser = $id[0];
        $this->usuario->desativarUsuario($idUser);
    }

    public function ativado()
    {
        $this->loadView('desativarUsuario', []);
    }

    public function desativado()
    {
        $this->loadView('ativarUsuario', []);
    }

    public function logout()
    {
        $this->usuario->logout();
    }


    /**
     * Processa o login do usuário
     * 
     * Valida as credenciais e inicia a sessão em caso de sucesso.
     * 
     * @return void
     */
    public function login()
    {
        if(isset($_POST['email']) && isset($_POST['senha']))
        {
            // Validação de campos
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'];
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->loadView('login', ['erro' => 'Email inválido']);
                return;
            }

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

    public function buscarA()
    {
        $this->loadView("ativarUsuario", ['usuarios' => $this->usuario->buscarA()]);
    }

    /**
     * Exibe a página de relatórios e estatísticas
     * 
     * @return void
     */
    public function relatorios()
    {
        $livroDAO = new LivroDAO();
        $emprestaDAO = new EmprestaDAO();
        
        // Estatísticas gerais
        $stats = [
            'total_livros' => $livroDAO->count('livro'),
            'livros_disponiveis' => $livroDAO->countDisponiveis(),
            'emprestimos_ativos' => $emprestaDAO->countAtivos(),
            'usuarios_ativos' => $this->usuario->countAtivos()
        ];
        
        // Livros por categoria
        $categorias = $livroDAO->countByCategoria();
        
        // Top 5 livros mais emprestados
        $top_livros = $emprestaDAO->getTopLivros(5);
        
        // Empréstimos recentes
        $emprestimos_recentes = $emprestaDAO->getRecentes(10);
        
        $this->loadView('relatorios', [
            'stats' => $stats,
            'categorias' => $categorias,
            'top_livros' => $top_livros,
            'emprestimos_recentes' => $emprestimos_recentes
        ]);
    }

    public function buscarD()
    {
        $this->loadView("desativarUsuario", ['usuarios' => $this->usuario->buscarD()]);
    }
}