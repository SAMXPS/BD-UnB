<?php
require_once dirname(__FILE__)."/../core.php";

if (!requireLogin()) {
    require_once dirname(__FILE__)."/login.php";
    die();
}

include_once dirname(__FILE__)."/../resources/head.php";

$avaliacao = \avaliacoes\read($_GET['avaliacao']);

if (!$logged_user->is_admin && $avaliacao->usuario != $logged_user->matricula) {
    echo "Voce nao eh admin!!!!";
    die();
}

// marca como tratada = 1 ...
$success = \avaliacoes\delete($_GET['avaliacao']);
?>

<div class="alert alert-success" role="alert">
Avaliacao removida com sucesso!
<br>
Redirecionando para pagina inicial...
</div>
<script>
window.setTimeout(function(){
    window.location.href = "/pages/index.php";
}, 1000);
</script>