<?php
include_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $codigoDisciplina = $_POST['codigoDisciplina'];
    $codigoDepartamento = $_POST['codigoDepartamento'];
    $SIAPEProfessor = $_POST['SIAPEProfessor'];
    $nomeDisciplina = $_POST['nomeDisciplina'];

    // Atualiza os dados na tabela disciplina
    $atualizarSql = "UPDATE disciplina SET codigoDepartamento=?, SIAPEProfessor=?, nomeDisciplina=? WHERE codigoDisciplina=?";
    $atualizarStmt = $conexao->prepare($atualizarSql);
    $atualizarStmt->bind_param("iisi", $codigoDepartamento, $SIAPEProfessor, $nomeDisciplina, $codigoDisciplina);

    if ($atualizarStmt->execute()) {
        echo "Disciplina atualizada com sucesso!";
    } else {
        echo "Erro ao atualizar disciplina: " . $atualizarStmt->error;
    }

    $atualizarStmt->close();

    header("Location: index.php");
    exit();
}

// Recupera o código da disciplina a ser editada
if (isset($_GET['codigoDisciplina'])) {
    $codigoDisciplina = $_GET['codigoDisciplina'];

    // Consulta SQL para obter os dados da disciplina
    $consultaSql = "SELECT * FROM disciplina WHERE codigoDisciplina=?";
    $consultaStmt = $conexao->prepare($consultaSql);
    $consultaStmt->bind_param("i", $codigoDisciplina);
    $consultaStmt->execute();
    $consultaResult = $consultaStmt->get_result();

    if ($consultaResult->num_rows == 1) {
        $dadosDisciplina = $consultaResult->fetch_assoc();
    } else {
        echo "Disciplina não encontrada.";
        exit();
    }

    $consultaStmt->close();
} else {
    echo "Código da disciplina não fornecido.";
    exit();
}

    
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Disciplina</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<h2>Atualizar Disciplina</h2>

<form action="" method="post">
    <label for="codigoDisciplina">Código da Disciplina:</label>
    <input type="text" id="codigoDisciplina" name="codigoDisciplina" value="<?php echo $dadosDisciplina['codigoDisciplina']; ?>" readonly>

    <label for="codigoDepartamento">Código do Departamento:</label>
    <input type="text" id="codigoDepartamento" name="codigoDepartamento" value="<?php echo $dadosDisciplina['codigoDepartamento']; ?>" required>

    <label for="SIAPEProfessor">SIAPE do Professor:</label>
    <input type="text" id="SIAPEProfessor" name="SIAPEProfessor" value="<?php echo $dadosDisciplina['SIAPEProfessor']; ?>" required>

    <label for="nomeDisciplina">Nome da Disciplina:</label>
    <input type="text" id="nomeDisciplina" name="nomeDisciplina" value="<?php echo $dadosDisciplina['nomeDisciplina']; ?>" required>

    <button type="submit">Atualizar Disciplina</button>
</form>

</body>
</html>
