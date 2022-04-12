<?php
    require_once dirname(dirname(dirname(__DIR__)))."\Data\Models\Alumno_Model.php";
    $datos = json_decode(file_get_contents('php://input'),true);
    $alumno = new AlumnoModel();
    $res = array();
    $res[] = $alumno->getAsignatures($datos['idAlumno']);
    echo json_encode($res);
    
?>