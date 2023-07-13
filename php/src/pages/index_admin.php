<?php
require_once dirname(__FILE__)."/../core.php";

if (!requireLogin()) {
    require_once dirname(__FILE__)."/login.php";
    die();
}

include dirname(__FILE__)."/../resources/head.php";

if (!$logged_user->is_admin) {
    echo "Voce nao eh admin!!!!";
    die();
}

echo "Voce eh admin";