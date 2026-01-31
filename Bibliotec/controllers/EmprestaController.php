<?php
/**
 * Classe EmprestaController - Controlador de Empréstimos
 * 
 * Gerencia todas as operações relacionadas aos empréstimos de livros,
 * incluindo registro de empréstimo, devolução e listagem.
 * 
 * @package Controllers
 * @extends RenderViews
 * @author Sistema LivraTec
 * @version 2.0
 */
class EmprestaController extends RenderViews
{
    /**
     * @var EmprestaDAO Instância do objeto de acesso a dados de empréstimos
     */
    private $emprestaDAO;

    /**
     * Construtor - Inicializa o DAO de empréstimos
     */
    public function __construct()
    {
        $this->emprestaDAO = new EmprestaDAO;
    }

    public function emprestimo()
    {
        $this->loadView('emprestimo', ['livros' => $this->emprestaDAO->fetchAll()]);
    }

    public function emprestimoA()
    {
        $this->loadView('emprestimoA', ['emprestimos' => $this->emprestaDAO->fetchAll2()]);
    }

    /**
     * Registra um empréstimo de livro
     * 
     * Cria um novo registro de empréstimo e marca o livro como emprestado.
     * 
     * @return void
     */
    public function emprestar()
    {
        // Validação do ID do livro
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: emprestimo?erro=id_invalido');
            return;
        }
        
        $id_livro = (int)$_GET['id'];
        $this->emprestaDAO->create($id_livro);
        
        $livroDAO = new LivroDAO();
        $livroDAO->emprestarLivro($id_livro);
        
        header('Location: emprestimo?sucesso=livro_emprestado');
    }

    public function delete($id)
    {
        $idUser = $id[0];
        $this->emprestaDAO->delete($idUser);
    }
}