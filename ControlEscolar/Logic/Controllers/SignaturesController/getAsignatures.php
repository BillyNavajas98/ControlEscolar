<?php
    require_once dirname(dirname(dirname(__DIR__)))."\Data\Models\Signatures_Model.php";
    $materia = new SignatureModel();
    $res = array();
    $res[]=$materia->getAsignatures();
    echo json_encode($res);
?>