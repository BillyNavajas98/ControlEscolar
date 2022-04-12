<?php
    session_start();
    
    if(isset($_SESSION['user'])){
        if(isset($_GET['opc'])){
            require_once __DIR__.'\resources\Views\Response\Signatures\indexSignatures.php';
        }
        else{
            require_once __DIR__.'\resources\Views\Response\Students\indexStudents.php';
        }
    }
    else{
        require_once __DIR__.'\resources\Views\Response\Login\login.php';
    }
?>