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
 */

class Professor extends Pessoa{

    private $disciplina;
    private $salario;

    public function __construct($nome, $nif){
        parent::__construct($nome, $nif);
    }

    // Getters
    public function getDisciplina(){
        return $this->disciplina;
    }
    public function getSalario(){
        return $this->salario;
    }
   

    // Setters
    public function setDisciplina($disciplina){
        $this->disciplina = $disciplina;
    }
    public function setSalario($salario){
        $this->salario = $salario;
    }
   

}