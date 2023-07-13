<?php

function renderImageFile($path) {
    return renderImage(file_get_contents($path));
}

function renderImage($blob) {
    echo '<img src="data:image/jpeg;base64,'.base64_encode($blob).'" style="max-height: 200px; width: auto"/>';
}

function renderUserPicture($usuario) {
    $user_picture = \usuarios\getImage($usuario);

    if (!$user_picture) {
        renderImageFile(dirname(__FILE__)."/../resources/user.jpg");
    } else {
        renderImage($user_picture->picture);
    }
}