<?php
    require_once dirname(dirname(dirname(__DIR__)))."\Data\Models\Alumno_Model.php";
    $datos = json_decode(file_get_contents('php://input'),true);
    $student = new AlumnoModel();
    $pass = md5($datos["pass"]);
    $res =  $student->addStudent($datos["nombre"],$datos["lastName1"],$datos["lastName2"],$datos["user"],$pass);
    echo json_encode($res);
?>