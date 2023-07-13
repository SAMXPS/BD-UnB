<?php
// Camada de persistencia do programa

require_once "core.php";

// Diz que a resposta sera em JSON
header('Content-Type: application/json; charset=utf-8');

// Funcao que envia resposta em JSON
function send_response($success = false, $data = null, $error = null) {
    $response = new stdClass();
    $response->success = $success;
    if (isset($data)) {
        $response->data = $data;
    }
    if (isset($error)) {
        $response->error = $error;
    }
    echo json_encode($response);
    die();
}

function send_data($data) {
    send_response($success = true, $data = $data, $error = null);
}

function send_error($error) {
    send_response($success = false, $data = null, $error = $error);
}

// verifica a acao requisistada
if (!isset($_GET['action'])) {
    send_error("nenhuma acao especificada. action: CRUD (create, read, update, delete)");
}

// verifica a entidade
if (!isset($_GET['entity'])) {
    send_error("nenhuma entidade especificada.");
}

$action = $_GET['action'];
$entity = $_GET['entity'];

switch($action) {
    case 'create':
    case 'read':
    case 'update':
    case 'delete':
        break;
    default:
        send_error("acao invalida. action: CRUD (create, read, update, delete)");
        break;
}

switch($entity) {
    case 'usuario':
        break;
    case 'usuario':
        break;
    default:
        send_error("entidade invalida");
        break;
}

send_data("opa! deu bom");

