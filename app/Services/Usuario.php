<?php

namespace App\Services;

class Usuario
{
    private $nome;
    private $email;
    private $senha;

    public function __construct($nome, $email, $senha)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function verificarSenha($senha)
    {
        return $this->senha === $senha;
    }
}

