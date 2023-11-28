<?php
class EmprestaDTO
{

    public $id;
    public $data_emprestimo;
    public $data_devolucao;


    public function __construct($id, $data_emprestimo, $data_devolucao)
    {
        $this->id = $id;
        $this->data_emprestimo = $data_emprestimo;
        $this->data_devolucao = $data_devolucao;
    }
}