<?php
    require_once dirname(__DIR__).'\config.php';
    class SignatureModel{

        public function __construct()
        {
            try{
                $conn = new ConnectDB();
                $this->db = $conn->conection();
            }
            catch(Exception $e){
                echo "No se ha podido conectar a la base";
            }
        }

        public function getAsignatures(){
            $signatures = array();
            $query = "exec getMaterias";
            $res = $this->db->query($query);
            while($row=$res->fetch(PDO::FETCH_ASSOC)){
                $signatures['Asignatures'][] = $row;
            }
            return $signatures;
        }

        public function getStudentsAsignature($idMateria){
            $student = array();
            $cadena = "EXEC alumnosMateria '".$idMateria."'";
            $sentencia = $this->db->prepare($cadena);
            $sentencia->execute();
            while($row=$sentencia->fetch(PDO::FETCH_ASSOC)){
                $student['Name'][] = $row;
            }
            return $student;
        }

    }
?>