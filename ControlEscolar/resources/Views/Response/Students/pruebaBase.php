<?php
    require_once dirname(dirname(dirname(dirname(__DIR__))))."\Data\Models\Alumno_Model.php";
    $alumno = new AlumnoModel();
    $alumno->addStudent('jk','M','h','K.12','KLJLJLK');
?>