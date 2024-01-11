<?php
include_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $codigoDisciplina = $_POST["codigoDisciplina"];
    $codigoDepartamento = $_POST["codigoDepartamento"];
    $SIAPEProfessor = $_POST["SIAPEProfessor"];
    $nomeDisciplina = $_POST["nomeDisciplina"];

    // Inserir os dados na tabela disciplina
    $sql = "INSERT INTO disciplina (codigoDisciplina, codigoDepartamento, SIAPEProfessor, nomeDisciplina) VALUES (?, ?, ?, ?)";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("iiis", $codigoDisciplina, $codigoDepartamento, $SIAPEProfessor, $nomeDisciplina);

    if ($stmt->execute()) {
        echo "Disciplina incluída com sucesso!";
    } else {
        echo "Erro ao incluir disciplina: " . $stmt->error;
    }

    $stmt->close();

    // Redirecionar para o index.html
    header("Location: index.php");
    exit();
}

mysqli_close($conexao);
?>
