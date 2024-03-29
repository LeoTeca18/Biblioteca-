<?php
if(session_status() !== PHP_SESSION_ACTIVE)session_start();

class LivroDAO extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }
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

    public function buscar()
    {
        $sql = $this->pdo->query("SELECT * FROM livro");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

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

    public function search($titulo)
    {
        $stm = $this->pdo->query("SELECT * FROM livro WHERE titulo LIKE '$titulo%'");
        if ($stm->rowCount() > 0) {
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function getlivro()
    {
        $livroId = $_SESSION['id'];
        $stm = $this->pdo->prepare('SELECT * FROM livro WHERE id = :id');
        $stm->bindParam(':id', $livroId);
        $stm->execute();

        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public static function getCount(){
        $table = 'livro';
        return Database::count($table);
    }
}