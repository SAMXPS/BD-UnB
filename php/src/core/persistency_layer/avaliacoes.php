<?php
namespace avaliacoes;

// usuario	id_turma	professor_nota	professor_text	disciplina_nota	disciplina_text

function create($usuario,$id_turma,$professor_nota,$professor_text,$disciplina_nota,$disciplina_text) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("INSERT INTO avaliacoes(usuario,id_turma,professor_nota,professor_text,disciplina_nota,disciplina_text) VALUES(?,?,?,?,?,?)");
    return $stm->execute([$usuario, $id_turma, $professor_nota, $professor_text, $disciplina_nota, $disciplina_text]);
}

function read($key) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT * FROM avaliacoes WHERE id = ?");
    $stm->execute([$key]);
    return $stm->fetch(\PDO::FETCH_OBJ);
}

function readRange($start, $end) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT * FROM avaliacoes LIMIT $start, $end");
    $stm->execute();
    return $stm->fetchAll(\PDO::FETCH_OBJ);
}

function readLatestRange($start, $end) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT * FROM avaliacoes ORDER BY id DESC LIMIT $start, $end");
    $stm->execute();
    return $stm->fetchAll(\PDO::FETCH_OBJ);
}

function readFromUsuario($usuario) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT * FROM avaliacoes WHERE usuario = ?");
    $stm->execute([$usuario]);
    return $stm->fetchAll(\PDO::FETCH_OBJ);

}

function update($id,$professor_nota,$professor_text,$disciplina_nota,$disciplina_text) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("UPDATE avaliacoes SET professor_nota = ?, professor_text = ?, disciplina_nota = ?, disciplina_text = ? WHERE id = ?");
    return $stm->execute([$professor_nota,$professor_text,$disciplina_nota,$disciplina_text,$id]);
}

function delete($key) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("DELETE FROM avaliacoes WHERE id = ?");
    return $stm->execute([$key]);
}