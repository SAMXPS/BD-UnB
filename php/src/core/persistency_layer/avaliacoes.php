<?php
namespace avaliacoes;

function create($data) {
    // todo
}

function read($key) {
    // todo
}

function readRange($start, $end) {
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT * FROM avaliacoes LIMIT $start, $end");
    $stm->execute();
    return $stm->fetchAll(\PDO::FETCH_OBJ);
}

function update($key, $data) {
    // todo
}

function delete($key) {
    // todo
}