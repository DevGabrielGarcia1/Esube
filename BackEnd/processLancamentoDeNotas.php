<?php
// require_once('../BackEnd/conexao.php');
// $db = new Conexao();
// $idTurma = $_GET['id'];
// $idMateria = $_POST['materia'];
// $idAtividade = $_POST['atividade'];
// $result = $db->executar("SELECT id_aluno FROM view_alunos  WHERE id_turma = $idTurma");
// foreach ($result as $aluno) {
//     $idAluno = $aluno['id_aluno'];
//     $nota = $_POST['nota' . $idAluno];
//     $result = $db->executar("INSERT INTO notas(nota, id_aluno, id_materia, id_atividade) VALUES ('$nota','$idAluno', '$idMateria', '$idAtividade')", true);
// }

include_once("sessao.php");
include_once("conexao.php");
$db = new Conexao();
if (isset($_POST["materia"]) && isset($_POST["bimestre"]) && isset($_POST["turma"])) {
    $idMateria = $_POST["materia"];
    $idTurma = $_POST["turma"];
    $idBimestre = $_POST["bimestre"];
    header("location: ../Professores/vincNotas.php?valid&idMateria=$idMateria&idTurma=$idTurma&idBimestre=$idBimestre");
}
if (isset($_POST["idMateriaSelected"]) && isset($_POST["idBimestreSelected"]) && isset($_POST["idTurmaSelected"]) && isset($_POST["tipoNota"])) {
    $idMateriaSelected = $_POST["idMateriaSelected"];
    $idBimestreSelected = $_POST["idBimestreSelected"];
    $idTurmaSelected = $_POST["idTurmaSelected"];
    $idTipoNota = $_POST["tipoNota"];
    $result = $db->executar("SELECT id_aluno FROM view_alunos  WHERE id_turma = $idTurmaSelected");
    foreach ($result as $aluno) {
        $idAluno = $aluno['id_aluno'];
        if (isset($_POST['nota' . $idAluno])) {
            $nota = $_POST['nota' . $idAluno];
            $result = $db->executar("INSERT INTO notas(nota, id_aluno, id_materia, id_atividade, bimestre) VALUES ('$nota','$idAluno', '$idMateriaSelected', '$idTipoNota', '$idBimestreSelected')", true);
        }
    }
    header("location: ../Professores/inicioProfessores.php?cadastroNotasSucess");
}
