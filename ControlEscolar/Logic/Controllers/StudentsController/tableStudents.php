<?php
    require_once dirname(dirname(dirname(__DIR__)))."\Data\Models\Alumno_Model.php";
    $alumno = new AlumnoModel();
    $res = array();
    $res[]=$alumno->getStudents();
    echo json_encode($res);
?>