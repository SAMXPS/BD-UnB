<?php

require_once dirname(__FILE__)."/../core.php";

include dirname(__FILE__)."/../resources/head.php";

$error = null;
$success = null;

function processRegister() {
    global $error, $success;

    if (!isset($_GET['email'])) {
        $error = 'matricula invalida!';
        return;
    }
    $email = $_GET['email'];

    if (!isset($_GET['matricula'])) {
        $error = 'matricula invalida!';
        return;
    }
    $matricula = $_GET['matricula'];

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

    if (\usuarios\create($email, $matricula, $nome, $curso, $senha, $is_admin)) {
        $success = true;
    } else {
        $error = "Erro ao inserir usuario no banco de dados.";
    }
}

// Handle da tentativa de login
if (isset($_GET['email'])) {
    processRegister();
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
        Cadastro realizado com Sucesso!
        <br>
        <a href="login.php" class="btn btn-success"> Fazer Login </a>
    </div>
    <?php
}
?>

<body>
    <div class="container">
        <form method="get" action="/pages/register.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Digite seu email">
            </div>
            <div class="form-group">
                <label for="matricula">Matricula</label>
                <input type="text" class="form-control" id="matricula" name="matricula" placeholder="Digite sua matricula">
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome">
            </div>
            <div class="form-group">
                <label for="curso">Curso</label>
                <input type="text" class="form-control" id="curso" name="curso" placeholder="Digite seu curso">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha"  placeholder="Digite sua senha">
            </div>
            <input type="submit" class="btn btn-primary" value="Fazer Cadastro"></input>
        </form>
        <div class="row">
            <a href="register.php" class="btn btn-primary">Novo Cadastro</a>
        </div>
    </div>    
    
</body>