<?php
class LivroDTO
{
    public $id;
    public $titulo;
    public $editora;
    public $autor;
    public $categoria;
    public $descricao;
    public $emprestado;
    
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