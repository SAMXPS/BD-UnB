<?php
require_once dirname(__FILE__)."/../core.php";

if (!requireLogin()) {
    require_once dirname(__FILE__)."/login.php";
    die();
}

include dirname(__FILE__)."/../resources/head.php";

$avaliacao = \avaliacoes\read($_GET['avaliacao']);

if (isset($_GET['text'])) {
    $motivo = $_GET['text'];
    \denuncias\create($avaliacao->id, $motivo);
    echo "DENUNCIA FEITA COM SUCESSO<br>";
    echo "<a href='index.php'>VOLTAR</a><br>";
    die();
}

$turma = \turmas\read($avaliacao->id_turma);
$professor = \professores\read($turma->cod_professor);
$disciplina = \disciplinas\read($turma->cod_disciplina);
$aluno = \usuarios\read($avaliacao->usuario);

echo "PAGINA DE DENUNCIA<br>";

echo "---------------------<br>";
echo "O ALUNO $aluno->nome avaliou a DISCIPLINA $disciplina->nome ( $disciplina->cod ) <br>";
echo "semestre: $turma->periodo<br>";
echo "nota: $avaliacao->disciplina_nota<br>";
echo "motivo: $avaliacao->disciplina_text<br>";
echo "Avaliacao para o PROFESSOR $professor->nome<br>";
echo "nota: $avaliacao->professor_nota<br>";
echo "---------------------<br>";
echo "<br><br>";

?>

<form method="get" action="/pages/denunciar.php">
    <input type="hidden" name="avaliacao" value="<?=$avaliacao->id?>">
    <div class="form-group">
        <label for="text">Motivo da Denuncia</label>
        <input type="text" class="form-control" id="text" name="text" placeholder="Escreva detalhes...">
    </div>
    <input type="submit" class="btn btn-danger" value="Enviar Denuncia"></input>
</form>
