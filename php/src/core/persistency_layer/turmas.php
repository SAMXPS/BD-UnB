<?php
namespace turmas;

function create($data) {
    // todo
}

function read($key) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT * FROM turmas WHERE id = ?");
    $stm->execute([$key]);
    return $stm->fetch(\PDO::FETCH_OBJ);
}

function update($key, $data) {
    // todo
}

function delete($key) {
    // todo
}

function searchByProfessorAndDisciplina($matricula, $cod) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT * FROM turmas WHERE cod_professor = ? AND cod_disciplina = ?");
    $stm->execute([$matricula, $cod]);
    return $stm->fetchAll(\PDO::FETCH_OBJ);
}