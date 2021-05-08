<?PHP 


class DB{


// ADD YOUR DB ACCESS CREDENTIALS
private static $servername = "";  // "localhost" for example
private static $username = "";
private static $password = "";
private static $dbname = "";

protected static $conn;

    public function __construct(){
        
        //create connection
        //Para aceder a uma static variable pode-se fazer self:: ou NomeDaClass:: (DB:: - neste caso)
        self::$conn = new mysqli(self::$servername, DB::$username, self::$password, DB::$dbname);

        if (self::$conn->connect_error) {
            // die("Connection failed: ". $conn->connect_error);
            throw new Exception(self::$conn->connect_error);
        }

    }


    public function listarCurso($cursoNome = NULL, $nif = NULL) {
        
        if ( isset($nif) && !empty($nif) ) {
           
            $sql = "SELECT * FROM Curso WHERE Nif = '".$nif."' LIMIT 1";
            // echo 1;
        }
        elseif ( ( isset($cursoNome) && !empty($cursoNome) ) && (!isset($nif) || empty($nif)) ) {
           
            $sql = "SELECT * FROM Curso WHERE Nome = '".$cursoNome."' ";
            // echo 2;
        }
        elseif ( ( isset($cursoNome) && !empty($cursoNome) ) && isset($nif) && !empty($nif) ) {
           
            $sql = "SELECT * FROM Curso WHERE Nif = '".$nif."' AND Nome = '".$cursoNome."' ";
            // echo 3;
        }
        else {
            $sql = "SELECT * FROM Curso ";
            // echo 4;
        }

            $result = self::$conn->query($sql);
            // echo "\n\$result\n";
            // var_dump($result);
        

            if(isset($result) && $result){
                
                $returnResult = []; // ou array()
                while ($row = $result->fetch_assoc()){
                    $row['Pessoa_Obj'] = @unserialize($row['Pessoa_Obj']);
                    array_push($returnResult, $row);
                }
                $result->close();
            }
            else{
                echo "Error: ". self::$conn->error;
            }

        return $returnResult;

    }//end listarCurso()



    public function adicionarElemento($objectoPessoa, $cursoNome) {
        
        if ( isset($objectoPessoa) && !empty($objectoPessoa) && isset($cursoNome) && !empty($cursoNome) ) {
           
            if ($objectoPessoa instanceof Aluno) $tipoPessoa = "Aluno";
            elseif ($objectoPessoa instanceof Professor) $tipoPessoa = "Professor";
            else $tipoPessoa = NULL;

            $sql = "INSERT INTO Curso (Nif, Tipo, Pessoa_Obj, Nome) VALUES 
           ('".$objectoPessoa->getNif()."', 
            '".$tipoPessoa."',
            '".serialize($objectoPessoa)."',
            '".$cursoNome."')";
        }

            $result = self::$conn->query($sql);

           
            if (self::$conn->query($sql) === TRUE) {
                echo "Pessoa inserida na lista de Cursos";
            } else {
                // echo "Error: " . $sql . "\n" . self::$conn->error;
            }
            //$result->close();

    }//end adicionarElemento()


// AINDA POR FAZER
    public function removerElemento($nif) {
        
        if ( isset($objectoPessoa) && !empty($objectoPessoa) && isset($cursoNome) && !empty($cursoNome) ) {
           
            if ($objectoPessoa instanceof Aluno) $tipoPessoa = "Aluno";
            elseif ($objectoPessoa instanceof Professor) $tipoPessoa = "Professor";
            else $tipoPessoa = NULL;

            $sql = "INSERT INTO Curso (Nif, Tipo, Pessoa_Obj, Nome) VALUES 
           ('".$objectoPessoa->getNif()."', 
            '".$tipoPessoa."',
            '".serialize($objectoPessoa)."',
            '".$cursoNome."')";
        }

            $result = self::$conn->query($sql);

           
            if (self::$conn->query($sql) === TRUE) {
                echo "Pessoa inserida na lista de Cursos";
            } else {
                echo "Error: " . $sql . "\n" . self::$conn->error;
            }
            $result->close();

    }//end removerElemento()





}//end class

