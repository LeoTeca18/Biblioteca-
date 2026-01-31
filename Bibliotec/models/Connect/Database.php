<?php
/**
 * Classe Database - Gerenciamento de Conexão com Banco de Dados
 * 
 * Responsável por gerenciar a conexão com o banco de dados MySQL
 * utilizando PDO (PHP Data Objects) para maior segurança.
 * 
 * @package Models\Connect
 * @author Sistema LivraTec
 * @version 2.0
 */
class Database
{
    /**
     * Obtém uma conexão PDO com o banco de dados
     * 
     * @return PDO|null Retorna objeto PDO em caso de sucesso ou null em caso de falha
     */
    public static function getConnection()
    {
        // Configurações de conexão
        $hostname = "localhost"; 
        $db_name = "biblioteca";
        $username = "root";
        $password = "";

        try {
            $pdo = new PDO("mysql:dbname=$db_name;host=$hostname;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $pdo;
        } catch (PDOException $err) {
            error_log("Erro de conexão: " . $err->getMessage());
            return null;
        }
    }

    /**
     * Conta o número total de registros em uma tabela
     * 
     * @param string $table Nome da tabela a ser contada
     * @return int Número de registros na tabela
     */
    protected static function count($table)
    {
        $pdo = Database::getConnection();
        $stm = $pdo->prepare("SELECT COUNT(*) FROM " . $pdo->quote($table));
        $stm->execute();
        return $stm->fetchColumn();
    }
}