<?php
require_once dirname(__FILE__)."/../core.php";

if (!requireLogin()) {
    require_once dirname(__FILE__)."/login.php";
    die();
}

include_once dirname(__FILE__)."/../resources/head.php";

$avaliacoes = \avaliacoes\readLatestRange(0, 10);

echo "<h4>Opções de USUARIO</h4>";

echo "<a href='nova_avaliacao.php'>NOVA AVALIACAO</a><br>";
echo "<a href='minhas_avaliacoes.php'>MINHAS AVALIACOES</a><br>";

echo "Ultimas avaliacoes: <br><br>";

foreach ($avaliacoes as $avaliacao) {
    $turma = \turmas\read($avaliacao->id_turma);
    $professor = \professores\read($turma->cod_professor);
    $disciplina = \disciplinas\read($turma->cod_disciplina);
    $aluno = \usuarios\read($avaliacao->usuario);

    echo "---------------------<br>";
    echo "O ALUNO $aluno->nome avaliou a DISCIPLINA $disciplina->nome ( $disciplina->cod ) <br>";
    echo "semestre: $turma->periodo<br>";
    echo "nota: $avaliacao->disciplina_nota<br>";
    echo "motivo: $avaliacao->disciplina_text<br>";
    echo "Avaliacao para o PROFESSOR $professor->nome<br>";
    echo "nota: $avaliacao->professor_nota<br>";
    echo "motivo: $avaliacao->professor_text<br>";
    echo "<a href='denunciar.php?avaliacao=$avaliacao->id'>DENUNCIAR</a><br>";
    if ($logged_user->is_admin) {
        echo "<a href='remover_avaliacao.php?avaliacao=$avaliacao->id'>REMOVER</a><br>";
    }
    echo "---------------------<br>";
    echo "<br><br>";
}

?>