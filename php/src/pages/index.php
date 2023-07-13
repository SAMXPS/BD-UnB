<?php
require_once dirname(__FILE__)."/../core.php";

if (!requireLogin()) {
    require_once dirname(__FILE__)."/login.php";
    die();
}

if ($logged_user->is_admin) {
    require_once dirname(__FILE__)."/index_admin.php";
} else {
    require_once dirname(__FILE__)."/index_user.php";
}