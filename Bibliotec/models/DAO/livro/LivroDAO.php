<?php
/**
 * Classe LivroDAO - Data Access Object para Livros
 * 
 * Gerencia todas as operações de acesso a dados relacionadas aos livros,
 * incluindo CRUD (Create, Read, Update, Delete) e operações especializadas.
 * 
 * @package Models\DAO\Livro
 * @extends Database
 * @author Sistema LivraTec
 * @version 2.0
 */
if(session_status() !== PHP_SESSION_ACTIVE)session_start();

class LivroDAO extends Database
{
    /** @var PDO Conexão com o banco de dados */
    private $pdo;

    /**
     * Construtor - Inicializa a conexão com o banco de dados
     */
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }
    /**
     * Cria um novo livro no banco de dados
     * 
     * @param string $titulo Título do livro
     * @param string $autor Autor do livro
     * @param string $categoria Categoria do livro
     * @param string $descricao Descrição do livro
     * @param string $editora Editora do livro
     * @return void
     */
    public function create($titulo, $autor, $categoria, $descricao, $editora)
    {
        $stm = $this->pdo->prepare("INSERT INTO livro (titulo,editora,autor,categoria,descricao) VALUES (:titulo, :editora, :autor, :categoria, :descricao)");
        $stm->bindParam(':autor', $autor);
        $stm->bindParam(':editora', $editora);
        $stm->bindParam(':titulo', $titulo);
        $stm->bindParam(':categoria', $categoria);
        $stm->bindParam(':descricao', $descricao);
        $stm->execute();
        
        header('Location: adicionarLivro');
        echo json_encode(["msg" => "Created"]);
    }

    /**
     * Busca todos os livros do sistema
     * 
     * @return array Array associativo com todos os livros
     */
    public function buscar()
    {
        $sql = $this->pdo->query("SELECT * FROM livro");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtém todos os livros cadastrados
     * 
     * @return array Array de livros ou array vazio se não houver registros
     */
    public function fetch()
    {
        $stm = $this->pdo->query("SELECT * FROM livro");
        if ($stm->rowCount() > 0) {
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }


    public function emprestarLivro($idLivro)
    {
        $stmt = $this->pdo->prepare("UPDATE livro SET emprestado = 1 WHERE id = :id");
        $stmt->bindParam(':id', $idLivro);
        $stmt->execute();
    }

    public function fetchById($id)
    {
        $stm = $this->pdo->prepare("SELECT * FROM livro WHERE id = ?");
        $stm->execute([$id]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function update(LivroDTO $livro)
    {
        $stm = $this->pdo->prepare("UPDATE livro SET titulo = :titulo, descricao = :descricao, categoria = :categoria, editora = :editora, autor = :autor, WHERE id = :id ");
        $stm->bindParam(':titulo', $livro->titulo);
        $stm->bindParam(':editora', $livro->editora);
        $stm->bindParam(':id', $livro->id);
        $stm->bindParam(':autor', $livro->autor);
        $stm->bindParam(':categoria', $livro->categoria);
        $stm->bindParam(':descricao', $livro->descricao);
        $stm->execute();

        header('Location: /biblioteca/livro/' . $livro->id);
    }

    public function delete($id)
    {
        $stm = $this->pdo->prepare('DELETE FROM livro WHERE id = ?');
        $stm->execute([$id]);
        header('Location: /bibliotec/dashboard');
    }

    /**
     * Busca simples por título
     * 
     * @param string $titulo Título a ser buscado
     * @return array Livros encontrados
     */
    public function search($titulo)
    {
        $stm = $this->pdo->prepare("SELECT * FROM livro WHERE titulo LIKE :titulo");
        $stm->execute(['titulo' => $titulo . '%']);
        if ($stm->rowCount() > 0) {
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    /**
     * Busca avançada com múltiplos filtros
     * 
     * @param array $filtros Array com os filtros de busca
     * @return array Livros encontrados
     */
    public function advancedSearch($filtros)
    {
        $sql = "SELECT * FROM livro WHERE 1=1";
        $params = [];
        
        if (!empty($filtros['titulo'])) {
            $sql .= " AND titulo LIKE :titulo";
            $params['titulo'] = '%' . $filtros['titulo'] . '%';
        }
        
        if (!empty($filtros['autor'])) {
            $sql .= " AND autor LIKE :autor";
            $params['autor'] = '%' . $filtros['autor'] . '%';
        }
        
        if (!empty($filtros['categoria'])) {
            $sql .= " AND categoria = :categoria";
            $params['categoria'] = $filtros['categoria'];
        }
        
        if (!empty($filtros['editora'])) {
            $sql .= " AND editora LIKE :editora";
            $params['editora'] = '%' . $filtros['editora'] . '%';
        }
        
        if (isset($filtros['status']) && $filtros['status'] !== '') {
            $sql .= " AND emprestado = :emprestado";
            $params['emprestado'] = $filtros['status'];
        }
        
        $sql .= " ORDER BY titulo ASC";
        
        $stm = $this->pdo->prepare($sql);
        $stm->execute($params);
        
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getlivro()
    {
        $livroId = $_SESSION['id'];
        $stm = $this->pdo->prepare('SELECT * FROM livro WHERE id = :id');
        $stm->bindParam(':id', $livroId);
        $stm->execute();

        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Conta total de livros no sistema
     * 
     * @param string $table Nome da tabela
     * @return int Total de livros
     */
    public static function count($table){
        return Database::count($table);
    }

    /**
     * Conta livros disponíveis (não emprestados)
     * 
     * @return int Total de livros disponíveis
     */
    public function countDisponiveis()
    {
        $stm = $this->pdo->query("SELECT COUNT(*) FROM livro WHERE emprestado = 0");
        return $stm->fetchColumn();
    }

    /**
     * Conta livros por categoria
     * 
     * @return array Array com categorias e quantidades
     */
    public function countByCategoria()
    {
        $stm = $this->pdo->query("SELECT categoria, COUNT(*) as total FROM livro GROUP BY categoria ORDER BY total DESC");
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}