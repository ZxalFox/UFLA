<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Disciplinas</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<?php
include_once("conexao.php");

// Consulta SQL para listar as disciplinas
$sql = "SELECT * FROM disciplina";
$result = mysqli_query($conexao, $sql);
?>

<h2 style="margin-left: 43%">Lista de Disciplinas</h2>

<table>
    <thead>
        <tr>
            <th>Código Disciplina</th>
            <th>Código Departamento</th>
            <th>SIAPE do Professor</th>
            <th>Nome da Disciplina</th>
            <th>Editar</th>
            <th>Deletar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['codigoDisciplina']}</td>";
            echo "<td>{$row['codigoDepartamento']}</td>";
            echo "<td>{$row['SIAPEProfessor']}</td>";
            echo "<td>{$row['nomeDisciplina']}</td>";
            echo "<td><a href='atualizar.php?codigoDisciplina={$row['codigoDisciplina']}'>Editar</a></td>";
            echo "<td><a href='delete.php?codigoDisciplina={$row['codigoDisciplina']}'>Deletar</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<div style="display: block; align-items: center; justify-items: center; width: 100%;">
<button style="margin-left: 45%">
    <a  style="color: white" href="incluir_formulario.php">Incluir Nova Disciplina</a>
    </button>
</div>


<?php
mysqli_close($conexao);
?>
</body>
</html>
