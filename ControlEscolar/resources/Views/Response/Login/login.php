<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <!--Icon-->
    <link rel="icon" href="https://images.vexels.com/media/users/3/166344/isolated/preview/bd941567ab86ea04dbcb1f8c1e1f42e8-silueta-de-gorro-de-graduacion.png" />

    <!--CDN Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!--CSS-->
    <link rel="stylesheet" href="resources/styles/Styles.css" type="text/css" />

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css" integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous"/>

    <!--Script-->
    <script type="text/javascript" src="resources/js/JavaScript.js"></script>

    <!--Script Bootstrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
    *{ 
        margin: 0;
    }
    .contain{
        background: rgba(128, 128, 128, 0.211);
        height: 100vh;
        display: flex;
        justify-content: center; 
        align-items: center;      
    }
    .content{
        position: absolute;
    }
    </style>
</head>
<body>
    
    <div class="contain">
        <div class="container content">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row form-group">
                                <?php
                                    if(isset($_GET["error"])){
                                        echo
                                        '<div class="col-lg-12 alert alert-danger alignRow" role="alert">'.
                                            '<p class="leyenda h5" style="text-align: center;padding-top:6px;"> Usuario y/o contraseña incorrectos.</p>'.
                                        '</div>';
                                    }
                                ?>
                                <div class="col-lg-12 alignRow">
                                    <img src="https://siems.iea.edu.mx/imgs/iea_gif.gif" style="max-width: 55px; height: auto;">
                                    <p class="leyenda h4" style="text-align: center;padding-top:6px;"> Ingreso Sistema de Control Escolar</p>
                                </div>
                                <div class="col-lg-12" style="display: flex;justify-content: center;">
                                    <hr style="border:1px solid rgba(0, 0, 0, 0.103);margin:0; padding:0; width:85%; border-radius:10px; padding:0px;">
                                </div>
                                <div class="col-lg-4 alignRow ">
                                    <img src="https://edocs.controlescolar.uaemex.mx/etitulos/img/certificate2.png" style="max-width: 200px;">
                                </div>
                                <div class="col-lg-8" style="margin-top:15px;">
                                    <form method="post" action="Logic/Controllers/Login/checkUser.php">
                                        <div class="row form-group alignRow">
                                            <div class="col-lg-8">
                                                <label for="email" class="col-form-label text-md-right leyenda">Usuario:</label>
                                                <input id="user" type="text" class="form-control" name="user" value="" required>
                                            </div>
                                        </div>
                                        <div class="row form-group alignRow">
                                            <div class="col-lg-8">
                                                <label for="password" class="col-form-label text-md-right leyenda"> Contraseña: </label>
                                                <input id="password" type="password" class="form-control" name="password" required>
                                            </div>
                                        </div>
    
                                        
                                        <div class="row form-group">
                                            <div class="col-lg-12 alignRow" style="justify-content: flex-end">
                                                <button type="submit" class="btn btn-info alignRow" id="btnSubmit">Login</button>
                                            </div>
                                        </div>
    
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>