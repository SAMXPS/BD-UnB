<?php
require_once dirname(__FILE__)."/../core.php";
include dirname(__FILE__)."/../resources/head.php";

$success = 0;
$error = null;

// Handle da tentativa de login
if (isset($_POST['login']) && isset($_POST['senha'])) {

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    if (loginTry($login, $senha)) {
        $success = true;
    } else {
        $error = "Usuario ou senha invalidos!";
    }
}

?>

<body>
    <div class="container">

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
                Login realizado com Sucesso!
                <br>
                Redirecionando para pagina inicial...
            </div>
            <script>
                window.setTimeout(function(){
                    window.location.href = "/pages/index.php";
                }, 1000);
            </script>
            <?php
        }
        ?>

        <form method="post" action="/pages/login.php">
            <div class="form-group">
                <label for="login">Email ou Matricula</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Digite seu login">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha"  placeholder="Digite sua senha">
            </div>
            <input type="submit" class="btn btn-primary" value="Fazer Login"></input>
        </form>
        <div class="row">
            <a href="register.php" class="btn btn-primary">Novo Cadastro</a>
        </div>
    </div>    
    
</body>