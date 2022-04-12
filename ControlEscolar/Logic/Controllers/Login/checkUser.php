<?php
    require_once dirname(dirname(dirname(__DIR__))).'\Data\Models\Login_Model.php';
    $uss = $_POST["user"];
    $pass = $_POST["password"];

    $student = new LoginModel();

    $userP = $student->getHashPaassword($_POST["user"]);

    if(count(json_decode($userP)) > 0){
        foreach(json_decode($userP) as $userPassword){
            $password = $userPassword->contrasenia;
        }
        $name = "";
        foreach(json_decode($userP) as $student){
            $name = $student->nombre." ";
            $name = $name.$student->apellidoPaterno." ";
            $name = $name.$student->apellidoMaterno." ";
        }
        $passLogin = md5('k9qwp0jbW971C0');
        if(md5($_POST["password"]) == $password){
            session_start();
            $_SESSION['user'] = $name;
            header("Location: ../../../index.php");
        }
        else{
            echo md5($_POST["password"]);
            echo '<br>';
            echo $password;
            echo '<br>';
            var_dump(password_verify($passLogin, $password));
        }
    }
    else{
        header("Location: ../../../index.php?error=1");
    }

    
    
    
?>