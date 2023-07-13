<?php
require_once dirname(__FILE__)."/../core.php";

if (!requireLogin()) {
    require_once dirname(__FILE__)."/login.php";
    die();
}

include_once dirname(__FILE__)."/../resources/head.php";

$avaliacao = \avaliacoes\read($_GET['avaliacao']);

if ($avaliacao->usuario != $logged_user->matricula) {
    echo "Voce nao tem permissao para editar essa avaliacao!";
    die();
}

if (isset($_GET['professor_nota'])) {
    $id = $avaliacao->id;
    $professor_nota = $_GET['professor_nota'];
    $professor_text = $_GET['professor_text'];
    $disciplina_nota = $_GET['disciplina_nota'];
    $disciplina_text = $_GET['disciplina_text'];

    if (\avaliacoes\update($id,$professor_nota,$professor_text,$disciplina_nota,$disciplina_text)) {
        echo "AVALIACAO EDITADA COM SUCESSO!!!!<br>";
        echo "<a href='index.php'>pagina inicial</a><br>";
        die();
    }
}

$turma = \turmas\read($avaliacao->id_turma);
$professor = \professores\read($turma->cod_professor);
$disciplina = \disciplinas\read($turma->cod_disciplina);
?>


<body>
    <div class="container">
        <h4> Editar Avaliação</h4>
        <p>
            Editando sua avaliacao para Turma: <br>
            do professor <strong><?=$professor->nome?></strong><br>
            da disciplina <strong><?=$disciplina->nome?></strong><br>
            do semestre <strong><?=$turma->periodo?></strong>
        </p>
        <p>
            Avalie o professor e a disciplina com uma nota de 0 a 5.
            Sendo 0 a pior nota e 5 a melhor nota.
        </p>
        <form method="get" action="/pages/editar_avaliacao.php">
            <h4> Avaliar Professor</h4>
            
            <input type="hidden" name="avaliacao" value="<?=$avaliacao->id?>">
            <div class="form-group">
                <select class="form-select" aria-label="Nota" name="professor_nota">
                    <option value="5" <?=$avaliacao->professor_nota == 5 ? 'selected' : ''?>>5</option>
                    <option value="4" <?=$avaliacao->professor_nota == 4 ? 'selected' : ''?>>4</option>
                    <option value="3" <?=$avaliacao->professor_nota == 3 ? 'selected' : ''?>>3</option>
                    <option value="2" <?=$avaliacao->professor_nota == 2 ? 'selected' : ''?>>2</option>
                    <option value="1" <?=$avaliacao->professor_nota == 1 ? 'selected' : ''?>>1</option>
                    <option value="0" <?=$avaliacao->professor_nota == 0 ? 'selected' : ''?>>0</option>
                </select>
            </div>
            <div class="form-group">
                <label for="professor_text">Por que você deu essa nota?</label>
                <input type="text" class="form-control" id="professor_text" name="professor_text" placeholder="Conte mais..." value="<?=$avaliacao->professor_text?>">
            </div>
            <h4> Avaliar Disciplina</h4>
            <div class="form-group">
                <select class="form-select" aria-label="Nota" name="disciplina_nota">
                    <option value="5" <?=$avaliacao->disciplina_nota == 5 ? 'selected' : ''?>>5</option>
                    <option value="4" <?=$avaliacao->disciplina_nota == 4 ? 'selected' : ''?>>4</option>
                    <option value="3" <?=$avaliacao->disciplina_nota == 3 ? 'selected' : ''?>>3</option>
                    <option value="2" <?=$avaliacao->disciplina_nota == 2 ? 'selected' : ''?>>2</option>
                    <option value="1" <?=$avaliacao->disciplina_nota == 1 ? 'selected' : ''?>>1</option>
                    <option value="0" <?=$avaliacao->disciplina_nota == 0 ? 'selected' : ''?>>0</option>
                </select>
            </div>
            <div class="form-group">
                <label for="disciplina_text">Por que você deu essa nota?</label>
                <input type="text" class="form-control" id="disciplina_text" name="disciplina_text" placeholder="Conte mais..." value="<?=$avaliacao->disciplina_text?>">
            </div>
            <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Editar Avaliação"></input>
            </div>
        </form>

    </div>    
    
</body>
