<?php
require_once dirname(__FILE__)."/../core.php";

if (!requireLogin()) {
    require_once dirname(__FILE__)."/login.php";
    die();
}

include_once dirname(__FILE__)."/../resources/head.php";

$avaliacoes = \avaliacoes\readFromUsuario($logged_user->matricula);

echo "<div class='container'>";
echo "<h4>Minhas Avaliacoes</h4>";

echo "<a href='/pages/index.php'>VOLTAR</a><br>";

echo "Minhas avaliacoes: <br><br>";

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
    if ($avaliacao->usuario == $logged_user->matricula) {
        echo "<a href='remover_avaliacao.php?avaliacao=$avaliacao->id'>REMOVER MINHA AVALIACAO</a><br>";
        echo "<a href='editar_avaliacao.php?avaliacao=$avaliacao->id'>EDITAR MINHA AVALIACAO</a><br>";
    } else {
        echo "<a href='denunciar.php?avaliacao=$avaliacao->id'>DENUNCIAR</a><br>";
        if ($logged_user->is_admin) {
            echo "<a href='remover_avaliacao.php?avaliacao=$avaliacao->id'>REMOVER (ADMIN)</a><br>";
        }
    }
    echo "---------------------<br>";
    echo "<br><br>";
}

echo "</div>"
?>