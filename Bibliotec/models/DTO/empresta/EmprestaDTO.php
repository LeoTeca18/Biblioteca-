<?php
class EmprestaDTO
{

    public $id;
    public $data_emprestimo;
    public $data_devolucao;
    public $id_livro;
    public $id_usuario;


    public function __construct($id_livro, $id_usuario, $data_emprestimo, $data_devolucao)
    {
        $this->id_livro = $id_livro;
        $this->id_usuario = $id_usuario;
        $this->data_emprestimo = $data_emprestimo;
        $this->data_devolucao = $data_devolucao;
    }
}