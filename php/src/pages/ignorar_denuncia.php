<?php
require_once dirname(__FILE__)."/../core.php";

if (!requireLogin()) {
    require_once dirname(__FILE__)."/login.php";
    die();
}

include_once dirname(__FILE__)."/../resources/head.php";

if (!$logged_user->is_admin) {
    echo "Voce nao eh admin!!!!";
    die();
}

// marca como tratada = 1 ...
$denuncia = \denuncias\update($_GET['denuncia'], 1);
?>

<div class="alert alert-success" role="alert">
Denuncia ignorada com sucesso!
<br>
Redirecionando para pagina inicial...
</div>
<script>
window.setTimeout(function(){
    window.location.href = "/pages/index.php";
}, 1000);
</script>