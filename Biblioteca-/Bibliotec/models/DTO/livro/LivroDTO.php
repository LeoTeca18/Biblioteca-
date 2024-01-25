<?php
class LivroDTO
{
    public $id;
    public $titulo;
    public $editora;
    public $autor;
    public $quantidade;
    public $categoria;
    public $descricao;

    public function __construct($titulo, $editora, $autor, $quantidade, $categoria, $descricao)
    {
        $this->titulo = $titulo;
        $this->editora = $editora;
        $this->autor = $autor;
        $this->quantidade = $quantidade;
        $this->categoria = $categoria;
        $this->descricao = $descricao;
    }
}