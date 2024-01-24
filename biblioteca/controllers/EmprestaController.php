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

    public function emprestar()
    {
        $this->emprestaDAO->create(6);
    }

}