<?php

function getPDO() {
    return new PDO('mysql:host=db;dbname=db_unb', 'root', 'root@pass', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$_PDO = getPDO();