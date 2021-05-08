<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Escola</title>
<link rel="stylesheet" href="style.css">
<style>
    .error {color: #FF0000;}
</style>

</head>
<body>
    <h1>Lista de Alunos/Professores: </h1>

    <a href="index.php">Adicionar Alunos e Professores</a>
    
<?php
error_reporting(-1);ini_set('display_errors', 'On');

require_once ( 'main.php' );
$resultadoQuery = $DB->listarCurso();
echo "\n<pre>";
print_r( $resultadoQuery );
echo "</pre>";

?>


</body>
</html>