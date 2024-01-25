<?php

class EmprestaController extends RenderViews
{

    private $emprestaDAO;

    public function __construct()
    {
        $this->emprestaDAO = new EmprestaDAO;
    }

    public function emprestimo()
    {
        $this->loadView('emprestimo', ['livros' => $this->emprestaDAO->fetchAll()]);
    }

    public function emprestimoA()
    {
        $this->loadView('emprestimoA', ['emprestimos' => $this->emprestaDAO->fetchAll2()]);
    }
    
    public function emprestar()
    {
        $id_livro = $_GET['id'];
        $this->emprestaDAO->create($id_livro);
    }

    public function delete($id)
    {
        $idUser = $id[0];
        $this->emprestaDAO->delete($idUser);
    }
}