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

class Pessoa implements PessoaInterface{

    private $nome;
    private $nif;
    private $morada;
    private $telefone;

    public function __construct($nome, $nif){
        $this->nome = $nome;
        $this->nif = $nif;
    }

    // Getters
    public function getNome(){
        return $this->nome;
    }
    public function getNif(){
        return $this->nif;
    }
    public function getMorada(){
        return $this->morada;
    }
    public function getTelefone(){
        return $this->telefone;
    }


    // Setters
    public function setMorada($morada){
        $this->morada = $morada;
    }
    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }
    public function setNif($nif){
        $this->nif = $nif;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }

    
}