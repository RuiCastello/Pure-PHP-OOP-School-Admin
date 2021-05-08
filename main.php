<?php
/**
 * Uma escola tem Pessoas (Alunos e Professores)
 * 
 * As pessoas têm nome, nif, morada e telefone
 * Os professores para além do que as Pessoas têm, também têm disciplina que lecionam e o salário
 * Os alunos para além do que as Pessoas têm, também têm bolsa ou não.
 * 
 * 
 * Existem Cursos que tem nome e uma lista de alunos inscritos e outra de professores que lecionam nesse curso.
 * 
 * As Pessoas têm que seguir por base a interface dada.
 * 
 * qd formos retirar um aluno ou professor, 
 * queremos poder selecionar qual o aluno especifico que queremos retirar.
 */

 require_once ( 'DB.php' );
 require_once ( 'PessoaInterface.php' );
 require_once ( 'Pessoa.php' );
 require_once ( 'Professor.php' );
 require_once ( 'Aluno.php' );
 require_once ( 'Curso.php' );


 $DB = new DB();








 // query teste à class DB com listarCurso()
 //  $DB = new DB();

 // $resultadoQuery = $DB->listarCurso('Matematica');
 /*
  $resultadoQuery = $DB->listarCurso();
 print_r( $resultadoQuery );

 $alunoX = $resultadoQuery[6];
 var_dump($alunoX);

// Criação de um novo objecto Pessoa
 $pessoa1 = new Pessoa("Jose Manuel", '123456789');

*/


// Criação de novos objectos Professor
/*
 $professor1 = new Professor("Prof. Dr. Chumba Tudo", '944444444');
 $professor2 = new Professor("Prof. Dr. Chumba Todos", '955555555');
 $professor3 = new Professor("Prof. Dr. Chumba-vos", '966666666');
 $professor4 = new Professor("Prof. Dr. Chumba-nos", '977777777');
 $professor5 = new Professor("Prof. Dr. Chumba Dentes", '988888888');
*/

 //Adição de novo elemento à DB:
//  $DB->adicionarElemento($professor1, 'Quimica');
//  $DB->adicionarElemento($professor2, 'Fisica');
//  $DB->adicionarElemento($professor3, 'Portugues');
//  $DB->adicionarElemento($professor4, 'Matematica');
//  $DB->adicionarElemento($professor5, 'Geografia');

// Criação de novos objectos Aluno
/*
 $aluno1 = new Aluno("Joaozinho das Panquecas", '800000000');
 $aluno2 = new Aluno("Mariazinha das Bolachas", '700000000');
 $aluno3 = new Aluno("Joaninha dos Biscoitos", '600000000');
 $aluno4 = new Aluno("Andreia do Pudim", '500000000');
 $aluno5 = new Aluno("Zézinho das Pipocas", '400000000');
*/
// Criação de um novo objecto Curso

/*
$curso1 = new Curso('Matemática');
*/

// Adiciona-se os Professores e os Alunos criados ao Curso criado.
/*
$curso1 -> addAluno ($aluno1) ;
$curso1 -> addAluno ($aluno2) ;
$curso1 -> addAluno ($aluno3) ;
$curso1 -> addAluno ($aluno4) ;
$curso1 -> addAluno ($aluno5) ;
$curso1 -> addProfessor ($professor1) ;
$curso1 -> addProfessor ($professor2) ;
$curso1 -> addProfessor ($professor3) ;
$curso1 -> addProfessor ($professor4) ;
$curso1 -> addProfessor ($professor5) ;
*/
// echo "\n Lista dos Alunos do Curso de Matemática: \n";
// print_r($curso1->getListaAlunos());


//  remoção do Aluno "Mariazinha das Bolachas"
// $curso1 -> removeAluno ('700000000');

// Mostra Lista de Alunos após remoção do Aluno "Mariazinha das Bolachas"
// print_r($curso1 -> getListaAlunos());


// Remove Professor "Prof. Dr. Chumba Dentes"
// $curso1 -> removeProfessor ('988888888');




// Mostra Lista de Alunos após remoção do Aluno "Mariazinha das Bolachas"
// print_r($curso1 -> getListaProfessores());

// Mostra Lista de Alunos cujo nome contém 'joa' 
// echo "\nLista de Alunos cujo nome contém 'joa':\n";
// print_r($curso1->filtraLista('joa'));

// Mostra Lista de Professores cujo nome contém 'do' 
// echo "\nLista de Professores cujo nome contém 'do':\n";
// print_r($curso1->filtraLista('do', 'professores'));

?>
