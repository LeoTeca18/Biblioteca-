<?php
session_start();


class EmprestaDAO extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }
    public function create($data_emprestimo)
    {
        $stm = $this->pdo->prepare("INSERT INTO empresta (id_empresta, data_emprestimo, data_devolucao) VALUES (uuid(),?,NULL)");
        $stm->execute([$data_emprestimo]);

        header('Location: /biblioteca/listaLivro');
        echo json_encode(["msg" => "Created"]);
    }

    public function fetchAll()
    {
        $stm = $this->pdo->query("SELECT * FROM emprestimo");
        if ($stm->rowCount() > 0) {
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
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
        $stm = $this->pdo->prepare('DELETE FROM emprestimo WHERE id = ?');
        $stm->execute([$id]);
        header('Location: /biblioteca/listaLivro');
    }
}