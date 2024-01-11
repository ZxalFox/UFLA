<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Nova Disciplina</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<h2>Incluir Nova Disciplina</h2>

<form action="incluir.php" method="post">
    <label for="codigoDisciplina">Código da Disciplina:</label>
    <input type="text" id="codigoDisciplina" name="codigoDisciplina" required>

    <label for="codigoDepartamento">Código do Departamento:</label>
    <input type="text" id="codigoDepartamento" name="codigoDepartamento" required>

    <label for="SIAPEProfessor">SIAPE do Professor:</label>
    <input type="text" id="SIAPEProfessor" name="SIAPEProfessor" required>

    <label for="nomeDisciplina">Nome da Disciplina:</label>
    <input type="text" id="nomeDisciplina" name="nomeDisciplina" required>

    <button type="submit">Incluir Disciplina</button>
</form>

</body>
</html>
