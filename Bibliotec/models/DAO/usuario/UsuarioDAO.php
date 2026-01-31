<?php
/**
 * Classe UsuarioDAO - Data Access Object para Usuários
 * 
 * Gerencia todas as operações de acesso a dados relacionadas aos usuários,
 * incluindo autenticação, cadastro, ativação/desativação e CRUD.
 * 
 * @package Models\DAO\Usuario
 * @extends Database
 * @author Sistema LivraTec
 * @version 2.0
 */
session_start();

class UsuarioDAO extends Database
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
     * Obtém todos os usuários cadastrados
     * 
     * @return array Array de usuários ou array vazio
     */
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

    /**
     * Cadastra um novo usuário no sistema
     * 
     * @param string $nome Nome do usuário
     * @param string $email Email do usuário
     * @param string $senha Senha do usuário (deve ser hash)
     * @return void
     */
    public function cadastrar($nome, $email, $senha)
    {
        if ($this->pdo == null) {
            echo "Impossível cadastrar, verifique a conexão com o banco de dados";
            return;
        }

        // Supondo que você tenha um campo 'estado' na tabela de usuários
        $estado = 1; // Pode ser 0 (desativado) ou 1 (ativo)

        $stm = $this->pdo->prepare("INSERT INTO usuario(nome, email, senha, estado) VALUES (:nome, :email, :senha, :estado)");
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':email', $email);
        $stm->bindParam(':senha', $senha);
        $stm->bindParam(':estado', $estado);
        $stm->execute();

        header('Location: login');
    }

    public function alterarEstadoUsuario($id, $estado)
    {
        // Atualiza o estado do usuário no banco de dados
        $stm = $this->pdo->prepare("UPDATE usuario SET estado = :estado WHERE id = :id");
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->bindParam(':estado', $estado, PDO::PARAM_INT);

        if ($stm->execute()) {
            echo "Usuário " . ($estado == 1 ? 'ativado' : 'desativado') . " com sucesso.";
        } else {
            echo "Erro ao alterar o estado do usuário.";
        }
    }


    public function ativarUsuario($id)
    {
        $this->alterarEstadoUsuario($id, 1); // 1 representa o estado ativo
    }

    public function desativarUsuario($id)
    {
        $this->alterarEstadoUsuario($id, 0); // 0 representa o estado desativado
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
        header("Location: home");
    }

    public function delete($id)
    {
        $stm = $this->pdo->prepare('DELETE FROM usuario WHERE id = ?');
        $stm->execute([$id]);
        header('Location: /bibliotec/dashboard');
    }

    public function logins($email, $senha)
    {
        // Verifica se ambos os campos estão preenchidos
        if (empty($email) || empty($senha)) {
            echo "Erro ao fazer login: Preencha todos os campos.";
            return;
        }

        $this->pdo = Database::getConnection();

        // Verificar as credenciais do usuário no banco de dados
        $stm = $this->pdo->prepare("SELECT * FROM usuario WHERE email = :email");
        $stm->bindParam(':email', $email);
        $stm->execute();

        $usuario = $stm->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário existe e a senha está correta
        if ($usuario && $senha == $usuario['senha']) {
            // Verifica o estado do usuário
            if ($usuario['estado'] == 0) {
                // Se o usuário estiver desativado, exibe uma mensagem
                echo "Erro ao fazer login: Usuário desativado. Entre em contato com o suporte.";
            } else {
                // Inicia a sessão e redireciona para a página de dashboard
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    session_start();
                }
                $_SESSION['usuario_id'] = $usuario['id'];

                $usuario['adm'] > 0 ? header('Location: dashboard') : header('Location: cliente');
                //exit();
            }
        } else {
            // Se as credenciais não correspondem, exibe uma mensagem de erro
            echo "Erro ao fazer login: Credenciais inválidas.";
        }
    }

    /**
     * Busca usuários com filtros
     * 
     * @return array Lista de usuários
     */
    public function buscar()
    {
        $sql = $this->pdo->query("SELECT * FROM usuario");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Conta usuários ativos no sistema
     * 
     * @return int Total de usuários ativos
     */
    public function countAtivos()
    {
        $stm = $this->pdo->query("SELECT COUNT(*) FROM usuario WHERE estado = 1");
        return $stm->fetchColumn();
    }

    public function buscarA()
    {
        $sql = $this->pdo->query("SELECT * FROM usuario WHERE estado = 1");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    public function buscarD()
    {
        $sql = $this->pdo->query("SELECT * FROM usuario WHERE estado = 0");
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

    public static function getCount(){
        $table = 'usuario';
        return Database::count($table);
    }
}