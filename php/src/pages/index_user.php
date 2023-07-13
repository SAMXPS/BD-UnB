<?php
require_once dirname(__FILE__)."/../core.php";

if (!requireLogin()) {
    require_once dirname(__FILE__)."/login.php";
    die();
}

$avaliacoes = \avaliacoes\readRange(0, 10);
var_dump($avaliacoes);

?>

<div class="container">

</div>