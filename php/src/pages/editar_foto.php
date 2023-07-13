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



</div>    
 

<?php

$message = ''; 
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload')
{
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file 
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    // sanitize file-name 
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    // check if file has one of the following extensions 
    $allowedfileExtensions = array('jpg','jpeg','png');
    if (in_array($fileExtension, $allowedfileExtensions))
    {
      renderImageFile($fileTmpPath);
      $message = 'upload success';
      if (!\usuarios\updateImage($logged_user->matricula, file_get_contents($fileTmpPath))) {
        $message = 'erro ao salvar no db';
      }
    }
    else
    {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }
}

echo $message;

?>

<form method="POST" action="editar_foto.php" enctype="multipart/form-data">
<div class="upload-wrapper">
    <span class="file-name">Choose a file...</span>
    <label for="file-upload">Browse<input type="file" id="file-upload" name="uploadedFile"></label>
</div>
<input type="submit" name="uploadBtn" value="Upload" />
</form>