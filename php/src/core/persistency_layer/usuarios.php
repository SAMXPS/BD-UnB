<?php
namespace usuarios;

// Estrutura da tabela:
// email
// matricula
// nome
// curso
// senha
// is_admin

function create($email, $matricula, $nome, $curso, $senha, $is_admin = false) {
    $senha = passwordEncrypt($senha);

    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("INSERT INTO usuarios(email,matricula,nome,curso,senha,is_admin) VALUES(?,?,?,?,?,?)");
    return $stm->execute([$email, $matricula, $nome, $curso, $senha, $is_admin]);
}

// Pesquisa usuario por email ou por matricula
function read($key) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? OR matricula = ?");
    $stm->execute([$key,$key]);
    return $stm->fetch(\PDO::FETCH_OBJ);
}

function update($key, $data) {
    // todo
}

function delete($key) {
    // todo
}