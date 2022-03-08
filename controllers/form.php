<?php
require 'config.php';
include 'mailer.php';

function conectarBanco($ipAcesso, $loginBanco, $senhaBanco, $base)
{
    $conexao = new mysqli($ipAcesso, $loginBanco, $senhaBanco, $base);

    if ($conexao->connect_errno) {
        echo "Falha ao se conectar com o banco de dados! Erro: ($conexao->connect_errno)";
    }

    return $conexao;
}

function adicionarDados($nome, $email, $conexao)
{
    $query = $conexao->prepare('INSERT INTO usuarios (nome, email) VALUES (?, ?);');
    $query->bind_param('ss', $nome, $email);
    
    $query->execute();
}

$nome = $_POST['nome'];
$email = $_POST['email'];

$conexao = conectarBanco($ipAcesso, $loginBanco, $senhaBanco, $base);
adicionarDados($nome, $email, $conexao);
enviarEmail($email, $nome);
