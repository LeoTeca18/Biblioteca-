<?php
class UsuarioDTO
{
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $adm;
    public $estado;

    public function __construct($nome, $email, $senha,$adm, $estado)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->adm = $adm;
        $this->estado = $estado;
    }
}