<?php
require_once dirname(__FILE__)."/../core.php";

if (!requireLogin()) {
    require_once dirname(__FILE__)."/login.php";
    die();
}

include dirname(__FILE__)."/../resources/head.php";

$avaliacao = \avaliacoes\read($_GET['avaliacao']);

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

