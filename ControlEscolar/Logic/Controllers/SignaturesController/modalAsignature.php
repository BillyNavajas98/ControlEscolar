<?php
    require_once dirname(dirname(dirname(__DIR__)))."\Data\Models\Signatures_Model.php";
    $datos = json_decode(file_get_contents('php://input'),true);
    $materia= new SignatureModel();
    $res = array();
    $res[] = $materia->getStudentsAsignature($datos['idMateria']);
    echo json_encode($res);
?>