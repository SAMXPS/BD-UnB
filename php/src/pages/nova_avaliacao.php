<?php
require_once dirname(__FILE__)."/../core.php";

if (!requireLogin()) {
    require_once dirname(__FILE__)."/login.php";
    die();
}

include dirname(__FILE__)."/../resources/head.php";

if (isset($_GET['turma'])) {
    $turma = \turmas\read($_GET['turma']);
    $professor = \professores\read($turma->cod_professor);
    $disciplina = \disciplinas\read($turma->cod_disciplina);

    if (isset($_GET['professor_nota'])) {
        $id_turma = $turma->id;
        $professor_nota = $_GET['professor_nota'];
        $professor_text = $_GET['professor_text'];
        $disciplina_nota = $_GET['disciplina_nota'];
        $disciplina_text = $_GET['disciplina_text'];
        $usuario = $logged_user->matricula;

        if (\avaliacoes\create($usuario,$id_turma,$professor_nota,$professor_text,$disciplina_nota,$disciplina_text)) {
            echo "AVALIACAO ENVIADA COM SUCESSO!!!!<br>";
            echo "<a href='index.php'>pagina inicial</a><br>";
            die();
        }
    }
?>

<body>
    <div class="container">
        <h4> Escrever Avaliação</h4>
        <p>
            Muito bem, você selecionou a Turma: <br>
            do professor <strong><?=$professor->nome?></strong><br>
            da disciplina <strong><?=$disciplina->nome?></strong><br>
            do semestre <strong><?=$turma->periodo?></strong>
        </p>
        <p>
            Avalie o professor e a disciplina com uma nota de 0 a 5.
            Sendo 0 a pior nota e 5 a melhor nota.
        </p>
        <form method="get" action="/pages/nova_avaliacao.php">
            <h4> Avaliar Professor</h4>
            
            <input type="hidden" name="turma" value="<?=$turma->id?>">
            <div class="form-group">
                <select class="form-select" aria-label="Nota" name="professor_nota">
                    <option value="5" selected>5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                    <option value="0">0</option>
                </select>
            </div>
            <div class="form-group">
                <label for="professor_text">Por que você deu essa nota?</label>
                <input type="text" class="form-control" id="professor_text" name="professor_text" placeholder="Conte mais...">
            </div>
            <h4> Avaliar Disciplina</h4>
            <div class="form-group">
                <select class="form-select" aria-label="Nota" name="disciplina_nota">
                    <option value="5" selected>5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                    <option value="0">0</option>
                </select>
            </div>
            <div class="form-group">
                <label for="disciplina_text">Por que você deu essa nota?</label>
                <input type="text" class="form-control" id="disciplina_text" name="disciplina_text" placeholder="Conte mais...">
            </div>
            <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Enviar Avaliação"></input>
            </div>
        </form>

    </div>    
    
</body>

<?php

} else if (isset($_GET['professor']) && isset($_GET['disciplina'])) {
    $professor = \professores\read($_GET['professor']);
    $disciplina = \disciplinas\read($_GET['disciplina']);
    $turmas = \turmas\searchByProfessorAndDisciplina($professor->matricula, $disciplina->cod);

    echo "Turmas encontradas para o professor $professor->nome e disciplina $disciplina->nome ( $disciplina->cod ) : <br><br>";

    foreach ($turmas as $turma) {
        echo "Semestre: " . $turma->periodo;
        echo " Horario: " . $turma->horario;
        echo " Turma: "   . $turma->turma;
        echo "<a href='/pages/nova_avaliacao.php?turma=$turma->id'> SELECIONAR </a>";
        echo "<br>";
    }

} else if (isset($_GET['professor']) && !isset($_GET['disciplina'])) {
    $professor = \professores\read($_GET['professor']);

    if (!$professor) {
        die("BUG PROFESSOR, voltar");
    }

    echo "Disciplinas Encontradas para o professor $professor->nome: <br><br>";

    $disciplinas = \disciplinas\searchByProfessor($professor->matricula);

    foreach ($disciplinas as $disciplina) {
        echo "Disciplina: " . $disciplina->nome;
        echo " Codigo: " . $disciplina->cod;
        echo "<a href='/pages/nova_avaliacao.php?professor=$professor->matricula&disciplina=$disciplina->cod'> SELECIONAR </a>";
        echo "<br>";
    }
} else if (!isset($_GET['professor']) && isset($_GET['disciplina'])) {
    $disciplina = \disciplinas\read($_GET['disciplina']);

    if (!$disciplina) {
        die("BUG DISCILPINA, voltar");
    }

    echo "Professores encontrados para disciplina $disciplina->nome: <br><br>";

    $professores = \professores\searchByDisciplina($disciplina->cod);

    foreach ($professores as $professor) {
        echo "Professor: " . $professor->nome;
        echo " Matricula: " . $professor->matricula;
        echo "<a href='/pages/nova_avaliacao.php?professor=$professor->matricula&disciplina=$disciplina->cod'> SELECIONAR </a>";
        echo "<br>";
    }
} else if (isset($_GET['search_professor']) && isset($_GET['search_disciplina'])) {
    $search_professor = $_GET['search_professor'];
    $search_disciplina = $_GET['search_disciplina'];


    echo "Professores Encontrados: <br><br>";

    if ($search_professor) {
        $professores = \professores\searchByName('%' . $search_professor . '%');

        foreach ($professores as $professor) {
            echo "Professor: " . $professor->nome;
            echo " Matricula: " . $professor->matricula;
            echo "<a href='/pages/nova_avaliacao.php?professor=$professor->matricula'> SELECIONAR </a>";
            echo "<br>";
        }
    }

    echo "<br>";

    echo "Disciplinas Encontradas: <br><br>";

    if ($search_disciplina) {
        $disciplinas = \disciplinas\searchByName('%' . $search_disciplina . '%');

        foreach ($disciplinas as $disciplina) {
            echo "Disciplina: " . $disciplina->nome;
            echo " Codigo: " . $disciplina->cod;
            echo "<a href='/pages/nova_avaliacao.php?disciplina=$disciplina->cod'> SELECIONAR </a>";
            echo "<br>";
        }
    }

    echo "<br>";

    echo '<a href="/pages/nova_avaliacao.php">nova pesquisa</a>';

} else if (!isset($_GET['turma'])) {
?>

<body>
    <div class="container">
        <h4> Nova Avaliação </h4>
        <p>
            Para fazer uma nova avaliação, você precisa primeiramente escolher uma turma.
            Vamos lá? 
        </p>
        <form method="get" action="/pages/nova_avaliacao.php">
            <div class="form-group">
                <label for="professor">Filtrar por professor</label>
                <input type="text" class="form-control" id="professor" name="search_professor" placeholder="Digite o nome do professor">
            </div>
            ou
            <div class="form-group">
                <label for="disciplina">Filtrar por disciplina</label>
                <input type="text" class="form-control" id="disciplina" name="search_disciplina" placeholder="Digite o nome da disciplina">
            </div>
            <input type="submit" class="btn btn-primary" value="Pesquisar"></input>
        </form>

    </div>    
    
</body>

<?php
}

?>

<div class="container">

</div>