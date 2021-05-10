<?PHP 

if ( (!empty($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) )
{

?>


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
    <h1>Adicione um Aluno ou Professor: </h1>

    <a href="listaPessoas.php">Lista de Alunos e Professores</a>

<?php

require_once ( 'main.php' );


// Faz override a configuração do php.ini para mostrar todos os warnings.
error_reporting(-1);
ini_set('display_errors', 'On');

// define variables and set to empty values
$cursoErr = $nifErr = $nomeErr = $moradaErr = $telefoneErr = $bolsaErr = $disciplinaErr = $salarioErr = $tipoErr = $ficheiroErr = "";
$curso = $nif = $nome = $morada = $telefone = $bolsa = $disciplina = $salario = $tipo = $ficheiro = "";
$goodToGo = 0;



if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_GET['logout']) && $_GET['logout'] == 'go') {
   unset($_SESSION["logged_in"]);
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   session_destroy();
   echo '<div class="modal"><p>Logout efetuado</p></div>';
   header('Refresh: 2; URL = index.php');
}
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST['username']) ) {
  
  if (empty($_POST["nome"])) {
    $nomeErr = "É necessário um nome";
  } else {
    $nome = sanitize_input( $_POST["nome"] );
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z\u00C0-\u017F\s]+/",$nome)) {
      $nomeErr = "Apenas são permitidas letras e espaços";
    }
    else $goodToGo++;
  }


  if (empty($_POST["curso"])) {
    $cursoErr = "É necessário especificar um curso";
  } else {
    $curso = sanitize_input( $_POST["curso"] );
  
    if (!preg_match("/^[a-zA-Z\u00C0-\u017F\s]+/",$curso)) {
      $cursoErr = "Apenas são permitidas letras, pontos e espaços";
    }
    else $goodToGo++;
  }
  

  if (empty($_POST["nif"])) {
    $nifErr = "É necessário um número de identificação fiscal";
  } 
  else {
    $nif = sanitize_input( $_POST["nif"]);
    if ( strlen($nif) < 5 ) {
      $nifErr = "NIF tem um mínimo de 5 algarismos, por favor tente novamente.";
    }
    else $goodToGo++;
  }

  if (!empty($_POST["morada"])) $morada = sanitize_input( $_POST["morada"]);
  if (!empty($_POST["telefone"]))  $telefone = sanitize_input( $_POST["telefone"]);
  if (!empty($_POST["bolsa"]))  $bolsa = sanitize_input( $_POST["bolsa"]);
  if (!empty($_POST["disciplina"]))  $disciplina = sanitize_input( $_POST["disciplina"]);
  if (!empty($_POST["salario"]))  $salario = sanitize_input( $_POST["salario"]);
  if (!empty($_POST["tipo"])) $tipo = sanitize_input( $_POST["tipo"]);



  if ($goodToGo >=3 && !empty($tipo) && ($tipo == "professor" || $tipo == "aluno") ){
    
    if ($tipo =="professor") {
      $novaPessoa = new Professor($nome, $nif);

      if (!empty($disciplina)) $novaPessoa->setDisciplina($disciplina);
      if (!empty($salario)) $novaPessoa->setSalario($salario);
    }
    elseif ($tipo =="aluno"){
      $novaPessoa = new Aluno($nome, $nif);

      if (!empty($bolsa) && $bolsa == 1) $novaPessoa->setBolsa(true);
    }
    
    if (!empty($morada)) $novaPessoa->setMorada($morada);
    if (!empty($telefone)) $novaPessoa->setTelefone($telefone);

    // echo "<pre> Dump da variável \$novaPessoa: ";
    // var_dump($novaPessoa);
    // echo "</pre>";
    echo "<p>Nova pessoa adicionada</p>";
    $DB->adicionarElemento($novaPessoa, $curso);


    // Para ver a estrutura de $_FILES["ficheiro"], ela muda para um multilevel array se o input "name" tiver "[]" para multiplos ficheiros
    // var_dump($_FILES["ficheiro"]);

    // Se algum ficheiro foi uploaded, então movêmo-lo para o directório correto
    if( strtolower( $_SERVER[ 'REQUEST_METHOD' ] ) == 'post' && !empty( $_FILES ) ){
        foreach ($_FILES["ficheiro"]["error"] as $key => $error) {
          if ($error == UPLOAD_ERR_OK) {
              $tmp_name = $_FILES["ficheiro"]["tmp_name"][$key];
              // basename() may prevent filesystem traversal attacks;
              // further validation/sanitation of the filename may be appropriate
              $name = basename($_FILES["ficheiro"]["name"][$key]);
              $ext = pathinfo($_FILES['ficheiro']["name"][$key], PATHINFO_EXTENSION);
              
              if ($ext=="jpg" OR $ext=="jpeg" OR $ext=="gif" OR $ext=="png" OR $ext=="pdf" OR $ext=="doc" OR $ext=="docx") {
                move_uploaded_file($tmp_name, "data/".$nif.".".$ext);
              }
        }
      }

  }
   



}




?>



<p class="error">* campo necessário</p>
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

<div class="row">
  
    <label for="nome">Nome:</label> <input id="nome" type="text" name="nome" required value="<?php echo $nome;?>">
    <span class="error">* <?php echo $nomeErr;?></span>
    <br><br>
</div>

  <div class="row">
  <label for="nif"> NIF: </label> <input id="nif" type="text" name="nif" required value="<?php echo $nif;?>">
    <span class="error">* <?php echo $nifErr;?></span>
    <br><br>
  </div>

  <div class="row">
  <label for="morada"> Morada: </label> <input id="morada" type="text" name="morada" value="<?php echo $morada;?>">
    <span class="error"><?php echo $moradaErr;?></span>
    <br><br>
  </div>
  
  <div class="row">
  <label for="telefone"> Telefone: </label> <input id="telefone" type="text" name="telefone" value="<?php echo $telefone;?>">
    <span class="error"><?php echo $telefoneErr;?></span>
    <br><br>
  </div>
  
  <div class="row">
  <label for="bolsa"> Bolsa: </label> 
  <div class="second-column">
  <input id="bolsa" type="checkbox" name="bolsa" value="1" <?PHP if (!empty($bolsa) && $bolsa == 1) echo "checked"; ?> >Sim
    <span class="error"><?php echo $bolsaErr;?></span>
    <br><br>
    </div>
  </div>





  <div class="row">
  <label for="curso"> Curso: </label> <input id="curso" type="text" name="curso" value="<?php echo $curso;?>">
    <span class="error"><?php echo $cursoErr;?></span>
    <br><br>
  </div>

  <div class="row">
  <label for="disciplina"> Disciplina: </label> <input id="disciplina" type="text" name="disciplina" value="<?php echo $disciplina;?>">
    <span class="error"><?php echo $disciplinaErr;?></span>
    <br><br>
  </div>

  <div class="row">
  <label for="salario"> Salário: </label> <input type="text" id="salario" name="salario" value="<?php echo $salario;?>">
    <span class="error"><?php echo $salarioErr;?></span>
    <br><br>
  </div>
  
  <div class="row">
  <label for="tipo"> Tipo:</label>
    <div class="second-column">
    <input type="radio" name="tipo" id="tipo" required <?php if (isset($tipo) && $tipo =="aluno") echo "checked";?> value="aluno">Aluno
    <input type="radio" name="tipo" <?php if (isset($tipo) && $tipo =="professor") echo "checked";?> value="professor">Professor
    <span class="error">* <?php echo $tipoErr;?></span>
    <br><br>
    </div>
  </div>


<!-- Para enviar ficheiros é preciso acrescentar isto ao <form> enctype="multipart/form-data"  -->
  <div class="row">
  <label for="ficheiro"> Ficheiro:</label>
    <div class="second-column">
    <!-- O attributo "name" tem de ter brackets "[]" no fim se quisermos ter multiplos ficheiros -->
    <input type="file" id="ficheiro" name="ficheiro[]" >
    <span class="error"> <?php echo $ficheiroErr;?></span>
    <br><br>
    </div>
  </div>




  <input type="submit" name="submit" value="Adicionar">  
</form>


<!-- Logout -->
<div class="logout">
  <form method="POST" action="<?php echo (htmlspecialchars($_SERVER["PHP_SELF"])."?logout=go"); ?>">  

      <input id="logout" type="submit" name="logout_btn" value="Logout">
     </form>
</div>


</body>
</html>


<?PHP 


}
else{
 
  ?>

<a href="index.php">Por favor faça login.</a>

  <?PHP 

}
?>