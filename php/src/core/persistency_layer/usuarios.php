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

function getImage($usuario) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT * FROM usuarios_pictures WHERE usuario = ?");
    $stm->execute([$usuario]);
    return $stm->fetch(\PDO::FETCH_OBJ);
}

function updateImage($usuario, $blob) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("INSERT INTO usuarios_pictures(picture,usuario) VALUES(?,?);");
    return $stm->execute([$blob, $usuario]);
}

function updatePassword($key, $senha) {
    $pdo = $GLOBALS['_PDO'];
    $senha = passwordEncrypt($senha);
    $stm = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE email = ? OR matricula = ?");
    return $stm->execute([$senha, $key,$key]);
}

function update($key, $nome, $curso, $senha) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("UPDATE usuarios SET nome = ?, curso = ? WHERE email = ? OR matricula = ?");
    if ($senha) {
        if (!updatePassword($key, $senha)) {
            return false;
        }
    }
    return ($stm->execute([$nome, $curso, $key,$key]));
}

function delete($key) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("DELETE FROM usuarios WHERE email = ? OR matricula = ?");
    return $stm->execute([$key,$key]);
}