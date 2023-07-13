<?php
require_once dirname(__FILE__)."/../core.php";

if (!requireLogin()) {
    require_once dirname(__FILE__)."/login.php";
    die();
}

include_once dirname(__FILE__)."/../resources/head.php";

echo "<div class='container'>";
echo "<h4>Meu Perfil</h4>";

$error = null;
$success = null;

function processFormData() {
    global $error, $success, $logged_user;

    if (!isset($_GET['nome'])) {
        $error = 'nome invalido!';
        return;
    }
    $nome = $_GET['nome'];

    if (!isset($_GET['curso'])) {
        $error = 'curso invalido!';
        return;
    }
    $curso = $_GET['curso'];

    if (!isset($_GET['senha'])) {
        $error = 'senha invalida!';
        return;
    }
    $senha = $_GET['senha'];
    $is_admin = 0;

    if (\usuarios\update($logged_user->matricula, $nome, $curso, $senha)) {
        $success = true;
        $logged_user = null;
        requireLogin();
    } else {
        $error = "Erro ao atualizar usuario no banco de dados.";
    }
}

// Handle da tentativa de login
if (isset($_GET['nome'])) {
    processFormData();
}

?>

<?php
if ($error) {
    ?>
    <div class="alert alert-danger" role="alert">
        <?=$error?>
    </div>
    <?php
}
?>

<?php
if ($success) {
    ?>
    <div class="alert alert-success" role="alert">
        Perfil atualizado com Sucesso!
        <br>
        <a href="index.php" class="btn btn-success"> Voltar </a>
    </div>
    <?php
}
?>

<a href="index.php" class="btn btn-success"> Voltar </a>

<div class="container">

    <div class="row">
        <?php renderUserPicture($logged_user->matricula); ?>
    </div>

    <a href="editar_foto.php" class="btn btn-primary"> Editar foto de perfil </a>

    <form method="get" action="/pages/editar_perfil.php">
        
        <fieldset disabled>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="disabled" class="form-control" value="<?=$logged_user->email?>">
            </div>
            <div class="form-group">
                <label for="matricula">Matricula</label>
                <input type="disabled" class="form-control" value="<?=$logged_user->matricula?>">
            </div>
        </fieldset>
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" value="<?=$logged_user->nome?>">
        </div>
        <div class="form-group">
            <label for="curso">Curso</label>
            <input type="text" class="form-control" id="curso" name="curso" placeholder="Digite seu curso" value="<?=$logged_user->curso?>">
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha"  placeholder="Digite sua senha, se deixar em branco a senha nao sera alterada">
        </div>
        <br>
        <br>
        <input type="submit" class="btn btn-primary" value="Atualizar Cadastro"></input>
    </form>
</div>    
    