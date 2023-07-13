<?php

$logged_user = null;
session_start();

function passwordEncrypt($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

function passwordVerify($to_check, $saved_password) {
    return password_verify($to_check, $saved_password);
}

function loginTry($login, $password) {
    $user = \usuarios\read($login);
    if (!$user) {
        return false;
    }
    if (passwordVerify($password, $user->senha)) {
        $_SESSION['user'] = $login;
        return true;
    }
    return false;
}

function requireLogin() {
    global $logged_user;

    if (!isset($_SESSION['user'])) {
        return false;
    }

    if (!isset($logged_user)) {
        $logged_user = \usuarios\read($_SESSION['user']);
    }
    
    if (!$logged_user) {
        return false;
    }

    return true;
}
