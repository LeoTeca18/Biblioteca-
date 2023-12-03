<?php
session_start();

class UsuarioDAO extends Database
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function fetch()
    {
        if($this->pdo == null){
            echo "Error fectching, pdo is null";
            return;
        }

        $stm = $this->pdo->query("SELECT * FROM usuario");
        if ($stm->rowCount() > 0) {
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function cadastrar($nome, $email, $senha, $admin)
    {
        $stm = $this->pdo->prepare("INSERT INTO usuario(id,nome, email, senha, admin) VALUES (uuid(), :nome, :email, :senha, :admin)");
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':email', $email);
        $stm->bindParam(':senha', $senha);
        $stm->bindParam(':admin', $admin);
        $stm->execute();

        if ($admin == 1) {
            header('Location: dashboard');
          
        } else {
            header('Location: home');
        }
    }


    public function getUsuario()
    {
        $usuarioId = $_SESSION['usuario_id'];
        $stm = $this->pdo->prepare('SELECT * FROM usuario WHERE id = :id');
        $stm->bindParam(':id', $usuarioId);
        $stm->execute();

        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function update(UsuarioDTO $usuario)
    {
        $usuariorioId = $_SESSION['usuario_id'];
        $stm = $this->pdo->prepare('UPDATE usuario SET nome = :nome, senha = :senha, email = :email WHERE id = :id');
        $stm->bindParam(':nome', $usuario->nome);
        $stm->bindParam(':email', $usuario->email);
        $stm->bindParam(':senha', $usuario->senha);
        $stm->bindParam(':id', $usuario->id);

        $stm->execute();
    }

    public function fetchById($id)
    {
        $stm = $this->pdo->prepare("SELECT * FROM usuario WHERE id = ?");
        $stm->execute([$id]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function logout()
    {
        session_destroy();
        header("Location: biblioteca");
    }

    public function delete($id)
    {
        $stm = $this->pdo->prepare('DELETE FROM usuario WHERE id = ?');
        $stm->execute([$id]);
        header('Location: biblioteca');
    }

    public function logins($email, $senha)
    {
        // Verifica se ambos os campos estão preenchidos
        if (empty($email) || empty($senha)) {
            echo "Erro ao fazer login: Preencha todos os campos.";
            return;
        }

        // Verificar as credenciais do usuário no banco de dados
        $stm = $this->pdo->prepare("SELECT * FROM usuario WHERE email = :email");
        $stm->bindParam(':email', $email);
        $stm->execute();

        $usuario = $stm->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário existe e a senha está correta
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Inicia a sessão e redireciona para a página de dashboard
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            header('Location: dashboard');
            exit();
        } else {
            // Se as credenciais não correspondem, exibe uma mensagem de erro
            echo "Erro ao fazer login: Credenciais inválidas.";
        }
    }

    public function buscar()
    {
        $sql = $this->pdo->query("SELECT * FROM usuario");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getByEmail($email)
    {
        $stm = $this->pdo->prepare("SELECT * FROM usuarios WHERE :email = ?");
        $stm->bindParam(':email', $email);
        $stm->execute();

        return $stm->fetch(PDO::FETCH_ASSOC);
        }
    }