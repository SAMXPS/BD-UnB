<?php
namespace denuncias;

// id	id_avaliacao	motivo	tratada	data	

function create($id_avaliacao, $motivo) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("INSERT INTO denuncias(id_avaliacao,motivo) VALUES(?,?)");
    return $stm->execute([$id_avaliacao, $motivo ]);
}

function read($key) {
    // todo
}

function readLatestRange($start, $end) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT * FROM denuncias WHERE tratada = 0 ORDER BY id DESC LIMIT $start, $end");
    $stm->execute();
    return $stm->fetchAll(\PDO::FETCH_OBJ);
}

function update($key, $data) {
    // todo
}

function delete($key) {
    // todo
}