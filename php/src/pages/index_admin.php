<?php
require_once dirname(__FILE__)."/../core.php";

if (!requireLogin() || !$logged_user->is_admin) {
    require_once dirname(__FILE__)."/login.php";
    die();
}

echo "Voce eh admin";