<?php
include_once("conexao.php");

function deletarDisciplina($codigoDisciplina) {
    global $conexao;

    // Verificar se a disciplina existe
    $verificarSql = "SELECT * FROM disciplina WHERE codigoDisciplina = ?";
    $verificarStmt = $conexao->prepare($verificarSql);
    $verificarStmt->bind_param("i", $codigoDisciplina);
    $verificarStmt->execute();
    $verificarResult = $verificarStmt->get_result();

    if ($verificarResult->num_rows == 0) {
        echo "Disciplina não encontrada.";
        return;
    }

    // Deletar referências nas tabelas
    $deleteSql = "DELETE FROM turma WHERE codigoDisciplina = ?";
    deletarReferencia($deleteSql, $codigoDisciplina);

    $deleteSql = "DELETE FROM local WHERE codigoDisciplina = ?";
    deletarReferencia($deleteSql, $codigoDisciplina);

    $deleteSql = "DELETE FROM horarioDeAula WHERE codigoDisciplina = ?";
    deletarReferencia($deleteSql, $codigoDisciplina);

    $deleteSql = "DELETE FROM turmaDiscente WHERE codigoDisciplina = ?";
    deletarReferencia($deleteSql, $codigoDisciplina);

    $deleteSql = "DELETE FROM monitoria WHERE codigoDisciplina = ?";
    deletarReferencia($deleteSql, $codigoDisciplina);

    // Deletar a disciplina
    $deleteDisciplinaSql = "DELETE FROM disciplina WHERE codigoDisciplina = ?";
    $deleteDisciplinaStmt = $conexao->prepare($deleteDisciplinaSql);
    $deleteDisciplinaStmt->bind_param("i", $codigoDisciplina);

    if ($deleteDisciplinaStmt->execute()) {
        echo "Disciplina deletada com sucesso!";
    } else {
        echo "Erro ao deletar disciplina: " . $deleteDisciplinaStmt->error;
    }

    $deleteDisciplinaStmt->close();
}

function deletarReferencia($sql, $codigoDisciplina) {
    global $conexao;

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $codigoDisciplina);
    
    // Executar a operação apenas se a tabela tiver registros (evitar o erro de foreign key)
    if ($stmt->execute()) {
        $stmt->close();
    }
}

// Verificar se o código da disciplina foi enviado
if (isset($_GET["codigoDisciplina"])) {
    $codigoDisciplina = $_GET["codigoDisciplina"];
    
    // Deletar a disciplina
    deletarDisciplina($codigoDisciplina);
    
    // Redirecionar para index.php após a deleção
    header("Location: index.php");
    exit();
} else {
    echo "Código da disciplina não fornecido.";
}

mysqli_close($conexao);
?>
