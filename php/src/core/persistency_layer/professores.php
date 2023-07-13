<?php
namespace professores;

function create($data) {
    // todo
}

function read($key) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT * FROM professores WHERE matricula = ?");
    $stm->execute([$key]);
    return $stm->fetch(\PDO::FETCH_OBJ);
}

function update($key, $data) {
    // todo
}

function delete($key) {
    // todo
}

function searchByName($search) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT * FROM professores WHERE nome LIKE ? LIMIT 25");
    $stm->execute([$search]);
    return $stm->fetchAll(\PDO::FETCH_OBJ);
}

function searchByDisciplina($cod) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT professores.* FROM professores INNER JOIN disciplina_professor ON professores.matricula=disciplina_professor.cod_professor WHERE disciplina_professor.cod_disciplina = ?;");
    $stm->execute([$cod]);
    return $stm->fetchAll(\PDO::FETCH_OBJ);
}