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

echo "<h4>Opções de ADMIN</h4>";

$denuncias = \denuncias\readLatestRange(0, 10);

foreach ($denuncias as $denuncia) {
    $avaliacao = \avaliacoes\read($denuncia->id_avaliacao);
    $turma = \turmas\read($avaliacao->id_turma);
    $professor = \professores\read($turma->cod_professor);
    $disciplina = \disciplinas\read($turma->cod_disciplina);
    $aluno = \usuarios\read($avaliacao->usuario);

    echo "---------------------<br>";
    echo "Existe uma denuncia pra avaliacao abaixo. <br>";
    echo "Motivo da denuncia: $denuncia->motivo <br>";
    echo "<br>";
    echo "O ALUNO $aluno->nome avaliou a DISCIPLINA $disciplina->nome ( $disciplina->cod ) <br>";
    echo "semestre: $turma->periodo<br>";
    echo "nota: $avaliacao->disciplina_nota<br>";
    echo "motivo: $avaliacao->disciplina_text<br>";
    echo "Avaliacao para o PROFESSOR $professor->nome<br>";
    echo "nota: $avaliacao->professor_nota<br>";
    echo "motivo: $avaliacao->professor_text<br>";
    echo "<a href='remover_avaliacao.php?avaliacao=$avaliacao->id'>REMOVER AVALIACAO</a><br>";
    echo "<a href='remover_usuario.php?matricula=$aluno->matricula'>REMOVER USUARIO</a><br>";
    echo "<a href='ignorar_denuncia.php?denuncia=$denuncia->id'>IGNORAR DENUNCIA</a><br>";
    echo "---------------------<br>";
    echo "<br><br>";
}

require_once "index_user.php";