<?php
namespace usuarios;

function create($data) {
    
    $pdo = $GLOBALS['_PDO'];
    $stm = $pdo->prepare("SELECT * FROM test");
    $stm->execute();
    return $stm->fetchAll(\PDO::FETCH_OBJ);
}

function read($key) {
    // todo
}

function update($key, $data) {
    // todo
}

function delete($key) {
    // todo
}