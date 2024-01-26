<?php
class EmprestaDAO extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function create($id_livro)
    {
        session_start();
        $emprestado = $this->fetchEmprestimoById($id_livro);
        $livroDAO = new LivroDAO();
        $idLivro = $id_livro;
        
        if (empty($emprestado)) {
            $id_usuario = $_SESSION['usuario_id'];
            $stm = $this->pdo->prepare("INSERT INTO empresta(data_emprestimo, id_livro, id_usuario) VALUES (NOW(), :id_livro, :id_usuario)");
            $stm->bindParam(':id_livro', $id_livro);
            $stm->bindParam(':id_usuario', $id_usuario);
            $stm->execute();

            $livroDAO->emprestarLivro($idLivro);
            header('Location: ./cliente');
            echo json_encode(["msg" => "Created"]);

        } else {
            echo "<script>alert('Livro ja emprestado!');location.href='./cliente';</script>";
        }
    }

    public function fetchAll()
    {
        session_start();
        $id_usuario = $_SESSION['usuario_id'];
        $stm = $this->pdo->query("SELECT * FROM empresta join livro on livro.id=empresta.id_livro where empresta.id_usuario = $id_usuario;");
        return $stm->fetchAll(PDO::FETCH_ASSOC);
        if ($stm->rowCount() > 0) {
        } else {
            return [];
        }
    }

    public function fetchAll2()
    {
        $sql = $this->pdo->query("SELECT * FROM empresta");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchById($id)
    {
        $stm = $this->pdo->prepare("SELECT * FROM empresta WHERE id = ?");
        $stm->execute([$id]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
    public function fetchEmprestimoById($id)
    {
        $stm = $this->pdo->prepare("SELECT * FROM empresta WHERE id_livro = ?");
        $stm->execute([$id]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function update(EmprestaDTO $empresta)
    {
        $stm = $this->pdo->prepare("UPDATE empresta SET data_emprestimo = :data_emprestimo, data_devolucao = :data_devolucao, WHERE id_empresta = :id_empresta ");
        $stm->bindParam(':id', $empresta->id);
        $stm->bindParam(':data_emprestimo', $empresta->data_emprestimo);
        $stm->bindParam(':data_devolucao', $empresta->data_devolucao);
        $stm->execute();

        header('Location: /bibliotec/emprestar/' . $empresta->id);
    }

    public function delete($id)
    {
        $stm = $this->pdo->prepare('DELETE FROM empresta WHERE id = ?');
        $stm->execute([$id]);
        header('Location: /bibliotec/dashboard');
    }

    public static function getCount()
    {
        $table = 'empresta';
        return Database::count($table);
    }
}