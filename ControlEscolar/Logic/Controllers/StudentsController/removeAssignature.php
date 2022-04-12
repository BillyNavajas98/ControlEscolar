<?php
    require_once dirname(dirname(dirname(__DIR__)))."\Data\Models\Alumno_Model.php";
    $datos = json_decode(file_get_contents('php://input'),true);
    $student = new AlumnoModel();
    $res =  $student->removeAssignature($datos["idAlumno"],$datos["idMateria"]);
    echo json_encode($res);
?>