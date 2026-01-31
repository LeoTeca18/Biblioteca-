<?php
/**
 * Sistema de Gestão de Biblioteca - LivraTec
 * 
 * Arquivo de entrada principal do sistema.
 * Responsável por inicializar o autoloader e executar o núcleo da aplicação.
 * 
 * @author Sistema LivraTec
 * @version 2.0
 * @since 2026-02-01
 */

require_once __DIR__ . '/core/core.php';
require_once __DIR__ . '/routes/routes.php';

/**
 * Autoloader personalizado do sistema
 * Carrega automaticamente as classes necessárias de diferentes diretórios
 */
spl_autoload_register(function ($file) {
    if (file_exists(__DIR__ . "/utils/$file.php")) {
        require_once __DIR__ . "/utils/$file.php";
    } else if (file_exists(__DIR__ . "/models/$file.php")) {
        require_once __DIR__ . "/models/$file.php";
    } else if (file_exists(__DIR__ . "/models/DTO/empresta/$file.php")) {
        require_once __DIR__ . "/models/DTO/empresta/$file.php";
    } else if (file_exists(__DIR__ . "/models/DTO/livro/$file.php")) {
        require_once __DIR__ . "/models/DTO/livro/$file.php";
    } else if (file_exists(__DIR__ . "/models/DTO/usuario/$file.php")) {
        require_once __DIR__ . "/models/DTO/usuario/$file.php";
    } else if (file_exists(__DIR__ . "/models/connect/$file.php")) {
        require_once __DIR__ . "/models/connect/$file.php";
    } elseif (file_exists(__DIR__ . "/models/DTO/$file.php")) {
        require_once __DIR__ . "/models/DTO/$file.php";
    } elseif (file_exists(__DIR__ . "/models/DAO/empresta/$file.php")) {
        require_once __DIR__ . "/models/DAO/empresta/$file.php";
    } elseif (file_exists(__DIR__ . "/models/DAO/livro/$file.php")) {
        require_once __DIR__ . "/models/DAO/livro/$file.php";
    } elseif (file_exists(__DIR__ . "/models/DAO/usuario/$file.php")) {
        require_once __DIR__ . "/models/DAO/usuario/$file.php";
    } elseif (file_exists(__DIR__ . "/views/$file.php")) {
        require_once __DIR__ . "/views/$file.php";
    } 
});

$core = new Core();
$core->run($routes);