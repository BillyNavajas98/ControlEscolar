<?php
    require_once dirname(__DIR__).'\config.php';
    class LoginModel{
        private $db;
        private $user;
        private $password;

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

        public function getHashPaassword($user){
            $studentP = array();
            $cadena = "EXEC userP '".$user."'";
            $sentencia = $this->db->prepare($cadena);
            $sentencia->execute();
            while($row=$sentencia->fetch(PDO::FETCH_ASSOC)){
                $studentP[] = $row;
            }

            return json_encode($studentP);
        }

        public function validateUser($id,$pass){
            $student = array();
            $cadena = "EXEC login '".$id."','".$pass."'";
            $sentencia = $this->db->prepare($cadena);
            $sentencia->execute();
            while($row=$sentencia->fetch(PDO::FETCH_ASSOC)){
                $student[] = $row;
            }

            return json_encode($student);
        }

    }
?>