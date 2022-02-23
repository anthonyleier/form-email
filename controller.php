<?php
include 'config.php';

$conexao = conectarBanco($ipAcesso, $loginBanco, $senhaBanco, $base);
adicionarDados($conexao);

function conectarBanco($ipAcesso, $loginBanco, $senhaBanco, $base)
{
    $conexao = new mysqli($ipAcesso, $loginBanco, $senhaBanco, $base);

    if ($conexao->connect_errno) {
        echo "Falha ao se conectar com o banco de dados! Erro: ($conexao->connect_errno)";
    }

    return $conexao;
}

function tratarDados($info)
{
    $info = preg_replace('/[^[:alnum:]_]/', '', $info);
    return $info;
}

function adicionarDados($conexao)
{
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $nome = tratarDados($nome);
    $email = tratarDados($email);

    $query = $conexao->prepare('INSERT INTO usuarios(nome, email) VALUES (?, ?);');
    $query->bind_param('ss', $nome, $email);

    $query->execute();
}
