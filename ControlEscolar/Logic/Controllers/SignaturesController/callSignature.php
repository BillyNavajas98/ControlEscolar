<?php
    session_start();
    
    if(isset($_SESSION['user'])){
        header("Location: ../../../index.php?opc=1");
    }
    else{
        header("Location: ../../../index.php");
    }
?>