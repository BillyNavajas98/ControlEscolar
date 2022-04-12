<?php
    require_once dirname(__DIR__).'\config.php';
    class AlumnoModel{
        private $db;
        private $name;
        private $lastName1;
        private $lastName2;
        private $user;
        private $pass;

        public function __construct()
        {
            try{
                $jk = new ConnectDB();

                $this->db = $jk->conection();
            }
            catch(Exception $e){
                echo "No se ha podido conectar a la base";
            }
        }


        public function getStudents(){
            $alumnos = array();
            $query = "exec getStudents";
            $res = $this->db->query($query);
            while($row=$res->fetch(PDO::FETCH_ASSOC)){
                $alumnos['Students'][] = $row;
            }
            return $alumnos;
        }

        public function addStudent($nombre,$lN1,$lN2,$uss,$passw){
            $res = array();
            try{
                $cadena = "EXEC addStudent '".$nombre."','".$lN1."','".$lN2."','".$uss."','".$passw."'";
                $sentencia = $this->db->prepare($cadena);
                $sentencia->execute();
                $res[] = true;
            }catch(Exception $e){
                $res[] = false;
            }
            return $res;
        }

        public function deleteStudent($idAlumno){
            try{
                $cadena = "EXEC deleteStudent '".$idAlumno."'";
                $sentencia = $this->db->prepare($cadena);
                $sentencia->execute();
            }catch(Exception $e){

            }
            
        }

        public function getAsignatures($idAlumno){
            try{
                $student = array();
                //Nombre
                $cadena = "EXEC nombreAlumno '".$idAlumno."'";
                $sentencia = $this->db->prepare($cadena);
                $sentencia->execute();
                while($row=$sentencia->fetch(PDO::FETCH_ASSOC)){
                    $student['Name'][] = $row;
                }

                //NMaterias
                $cadena = "EXEC materiasNoRegistradas '".$idAlumno."'";
                $sentencia = $this->db->prepare($cadena);
                $sentencia->execute();
                while($row=$sentencia->fetch(PDO::FETCH_ASSOC)){
                    $student['nAsignatures'][] = $row;
                }

                //Materias
                $cadena = "EXEC materiasInscritasAlumno '".$idAlumno."'";
                $sentencia = $this->db->prepare($cadena);
                $sentencia->execute();
                while($row=$sentencia->fetch(PDO::FETCH_ASSOC)){
                    $student['Asignatures'][] = $row;
                }

                //Costo
                $cadena = "EXEC precioTotal '".$idAlumno."'";
                $sentencia = $this->db->prepare($cadena);
                $sentencia->execute();
                while($row=$sentencia->fetch(PDO::FETCH_ASSOC)){
                    $student['Price'][] = $row;
                }

                return $student;
                
            }catch(Exception $e){

            }
        }

        public function removeAssignature($idAlumno,$idMateria){
            try{
                $cadena = "EXEC eliminarMateriaAlumno '".$idAlumno."','".$idMateria."'";
                $sentencia = $this->db->prepare($cadena);
                $sentencia->execute();
            }catch(Exception $e){

            }
        }

        public function addAsignatureStudent($idAlumno, $idMateria){
            try{
                $cadena = "EXEC agregarAlumnoMateria '".$idAlumno."','".$idMateria."'";
                $sentencia = $this->db->prepare($cadena);
                $sentencia->execute();
            }catch(Exception $e){

            }
        }

    }
?>