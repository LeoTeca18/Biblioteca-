<?php
/**
 * Classe LivroDTO - Data Transfer Object para Livros
 * 
 * Representa a estrutura de dados de um livro no sistema.
 * Utilizada para transferência de dados entre camadas.
 * 
 * @package Models\DTO\Livro
 * @author Sistema LivraTec
 * @version 2.0
 */
class LivroDTO
{
    /** @var int ID do livro */
    public $id;
    
    /** @var string Título do livro */
    public $titulo;
    
    /** @var string Editora do livro */
    public $editora;
    
    /** @var string Autor do livro */
    public $autor;
    
    /** @var string Categoria do livro */
    public $categoria;
    
    /** @var string Descrição do livro */
    public $descricao;
    
    /** @var int Status de empréstimo (0 = disponível, 1 = emprestado) */
    public $emprestado;
    
    /**
     * Construtor do LivroDTO
     * 
     * @param string $titulo Título do livro
     * @param string $editora Editora do livro
     * @param string $autor Autor do livro
     * @param string $categoria Categoria do livro
     * @param string $descricao Descrição do livro
     * @param int $emprestado Status de empréstimo
     */
    public function __construct($titulo, $editora, $autor, $categoria, $descricao, $emprestado)
    {
        $this->titulo = $titulo;
        $this->editora = $editora;
        $this->autor = $autor;
        $this->categoria = $categoria;
        $this->descricao = $descricao;
        $this->emprestado = $emprestado;
    }
}