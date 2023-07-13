<?php
namespace disciplinas;

function create($data) {
    // todo
}

function read($key) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT * FROM disciplinas WHERE cod = ?");
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
    $stm = $pdo->prepare("SELECT * FROM disciplinas WHERE nome LIKE ? LIMIT 25");
    $stm->execute([$search]);
    return $stm->fetchAll(\PDO::FETCH_OBJ);
}

function searchByProfessor($matricula) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT disciplinas.* FROM disciplinas INNER JOIN disciplina_professor ON disciplinas.cod=disciplina_professor.cod_disciplina WHERE disciplina_professor.cod_professor = ?;");
    $stm->execute([$matricula]);
    return $stm->fetchAll(\PDO::FETCH_OBJ);
}