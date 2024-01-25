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
        $id_usuario = $_SESSION['usuario_id'];
        $stm = $this->pdo->prepare("INSERT INTO empresta(data_emprestimo, id_livro, id_usuario) VALUES (NOW(), :id_livro, :id_usuario)");
        $stm->bindParam(':id_livro', $id_livro);
        $stm->bindParam(':id_usuario', $id_usuario);
        $stm->execute();

        header('Location: /biblioteca/listaLivro');
        echo json_encode(["msg" => "Created"]);
    }

    public function fetchAll()
    {
        $id_usuario = $_SESSION['usuario_id'];
        $stm = $this->pdo->query("SELECT * FROM `livro` INNER JOIN empresta WHERE empresta.id_usuario = $id_usuario");
        if ($stm->rowCount() > 0) {
            return $stm->fetchAll(PDO::FETCH_ASSOC);
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
        $stm = $this->pdo->prepare("SELECT * FROM emprestimo WHERE id = ?");
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

        header('Location: /biblioteca/emprestar/' . $empresta->id);
    }

    public function delete($id)
    {
        $stm = $this->pdo->prepare('DELETE FROM empresta WHERE id = ?');
        $stm->execute([$id]);
        header('Location: listaLivro');
    }

    public static function getCount()
    {
        $table = 'empresta';
        return Database::count($table);
    }
}    