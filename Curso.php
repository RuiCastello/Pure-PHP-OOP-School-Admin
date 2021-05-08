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

class Curso {

    private string $nome;
    private $listaAlunos = array();
    private $listaProfessores = [];


    public function __construct($nome){
       $this->nome = $nome;
    }
    
    // Getters
    public function getNome(){
        return $this->nome;
    }
    public function getListaAlunos(){
        return $this->listaAlunos;
    }
    public function getListaProfessores(){
        return $this->listaProfessores;
    }
  
    // Setters
    public function setNome(string $nome){
        $this->nome = $nome;
    }
   

    public function addAluno($aluno){
  
        $returnResult = false;
        if($aluno instanceof Aluno)
        {
            $result = array_push($this->listaAlunos, $aluno);
        
            if(!$result) {
                throw new Exception("Erro, não foi possível adicionar o Aluno, por favor tente novamente.");
            }
            $returnResult = true;
        }
        else{
            throw new Exception("O objecto aluno não é válido, por favor tente adicionar um objecto Aluno válido.");
        }
     
        return $returnResult;
    }

    public function removeAluno($nif){
  
        $returnResult = false;
        if(isset($nif) && $nif != false)
        {
            $indexToRemove = -1;

            foreach ($this->listaAlunos as $key => $value) {
                
                // Compara duas strings sem ser case-sensitive e se for zero é porque são iguais
                if ( !empty($value->getNif()) && strcasecmp($value->getNif(), $nif) == 0 ){
                    $indexToRemove = $key;
                }
            
                // echo "{$key} => {".$value->getNif()."} ";
            }

            // echo "\n Antes de remover: \n";
            // var_dump($this->listaAlunos);

            // Remove caso tenha havido um match entre o nif de Input e um nif na DB
            if($indexToRemove >=0){
                array_splice($this->listaAlunos, $indexToRemove, 1);
                $result = true;
            }

            // echo "\n Depois de remover: \n";
            //  var_dump($this->listaAlunos);

            if(!$result) {
                throw new Exception("Erro #1, não foi possível remover o Aluno, por favor tente novamente.");
            }
            $returnResult = true;
        }
        else{
            throw new Exception("Erro #2, não foi possível remover o Aluno, por favor tente novamente.");
        }
     
        return $returnResult;
    }

    public function addProfessor($professor){
  
        $returnResult = false;
        if($professor instanceof Professor)
        {
            $result = array_push($this->listaProfessores, $professor);
        
            if(!$result) {
                throw new Exception("Erro, não foi possível adicionar o professor, por favor tente novamente.");
            }
            $returnResult = true;
        }
        else{
            throw new Exception("O objecto professor não é válido, por favor tente adicionar um objecto professor válido.");
        }
     
        return $returnResult;
    }

    public function removeProfessor($nif){
  
        $returnResult = false;
        if(isset($nif) && $nif != false)
        {
            $indexToRemove = -1;

            foreach ($this->listaProfessores as $key => $value) {
                
                // Compara duas strings sem ser case-sensitive e se for zero é porque são iguais
                if ( !empty($value->getNif()) && strcasecmp($value->getNif(), $nif) == 0 ){
                    $indexToRemove = $key;
                }
            }

            // Remove caso tenha havido um match entre o nif de Input e um nif na DB
            if($indexToRemove >=0){
                array_splice($this->listaProfessores, $indexToRemove, 1);
                $result = true;
            }

            if(!$result) {
                throw new Exception("Erro #1, não foi possível remover o professor, por favor tente novamente.");
            }
            $returnResult = true;
        }
        else{
            throw new Exception("Erro #2, não foi possível remover o professor, por favor tente novamente.");
        }
     
        return $returnResult;
    }



    //mostra todos os alunos cujo valor de input faz parte do seu nome
    public function filtraLista($nome, $tipo = 'alunos'){
        
        // Define o tipo de lista (Se alunos ou Professores)
        switch($tipo){

            case 'alunos':
                $lista = $this->listaAlunos;
                break;

            case 'professores':
                $lista = $this->listaProfessores;
                break;

            default: 
                $lista = $this->listaAlunos;
                break;
        }

        if (!empty($nome)){

            $filteredArray = array_filter($lista, 

            function($element, $index) use (&$nome){
                if( stripos($element->getNome(), $nome) !== false ){
                    return true;
                }else{
                    return false;
                }
            }, 

            ARRAY_FILTER_USE_BOTH); // End array_filter()
    
            echo "\n";
            return $filteredArray;

        }
        return [];
    }

    
}