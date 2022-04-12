<?php
    if(isset($_SESSION['user'])){
?>
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
    <title>Materias</title>

    
    <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            fetchSignaturesTable();
        });
        function fetchSignaturesTable(){
            fetch('Logic/Controllers/SignaturesController/getAsignatures.php')
            .then(datos=>datos.json()) 
            .then(function(datos){
                let u = datos[0]["Asignatures"];
                u.forEach(element => {
                    console.log(element);
                    //Create tr
                    let tr = document.createElement("tr");
                    tr.id = "trMateria"+element.idMateria;

                    //Create td
                    let tdName = document.createElement("td");
                    let tdPrice = document.createElement("td");
                    let tdButtons = document.createElement("td");
                    tdButtons.classList.add("alignRow7");

                    //Create buttons
                    let buttonInfo = document.createElement("button");
                    buttonInfo.classList.add("btn","btn-warning");
                    buttonInfo.innerHTML = "<i class='fas fa-info'></i>";
                    buttonInfo.addEventListener('click',function(){
                        showModalA(element.idMateria);
                    });

                    //Data
                    tdName.innerHTML = element.nombre;
                    tdPrice.innerHTML = "$ "+element.costo;
                    tdButtons.appendChild(buttonInfo);

                    //AppendChild
                    tr.appendChild(tdName);
                    tr.appendChild(tdPrice);
                    tr.appendChild(tdButtons);

                    //Insertar
                    _i('bodyTableAsignature').appendChild(tr);
                });
            });
        }
        function showModalA(idMateria){
            //Create
            if (window.XMLHttpRequest) {
                xhhtp=new XMLHttpRequest();
            }
            else {
                xhhtp=new ActiveXObject(Microsoft.XMLHTTP);
            }
            xhhtp.open('GET','resources/Views/Response/Signatures/modalSignatures.html');
            xhhtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            //Ready
            xhhtp.onreadystatechange = function () {
                if (xhhtp.readyState == 4) {
                    if(xhhtp.status == 200){
                        _i('modalInfoAsignature').innerHTML = xhhtp.responseText;
                        refreshCardModalAsignature(idMateria);
                    }else{
                        alert('Ha ocurrido un error, favor de volver a intentarlo, si el problema persiste intenta recargando la página!');
                    }
                }
            };
            xhhtp.send();
            
            $('#modalAsignature').modal('show')
        }
    </script>
</head>
<header>
    <!--Nav-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <div class="alignRowN">
                <div><img src="https://images.vexels.com/media/users/3/166344/isolated/preview/bd941567ab86ea04dbcb1f8c1e1f42e8-silueta-de-gorro-de-graduacion.png" alt="" class="img-fluid imageResponsive"></div>
                <div class="h3 leyenda">Sistema de Control Escolar</div>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link h5 leyenda" href="Logic/Controllers/StudentsController/callStudent.php"> Estudiantes <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link h5 leyenda" href="#"> Materias <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link h5 leyenda" href="Logic/Controllers/Login/cerrarSesion.php"> Cerrar Sesión <span class="sr-only"></span></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<body>
<div class="container-fluid">
        <!--Menu-->
        <div class="row headC">
            <!--Head-->
            <div class="col-lg-12 head alignRowMenu" style="gap:7px;">
                <div id="titleMenu">
                    <i class="fas fa-chalkboard-teacher fa-2x"></i>
                    <span class="leyenda h4" style="margin-top: 5px;">
                        Materias
                    </span>
                </div>
                <div id="buttonsMenu">
                    <button type="button" id="btnAddStudent" class="btn btn-outline-info" style="gap:4px;" title="Información de Materias" disabled>
                        <i class="fas fa-eye fa-lg"></i>
                    </button>
                </div>
            </div>
            <!--Content-->
            <div class="col-lg-12 contentAdd" id="insertElementSignature">
                <div class="form-group contentTableDeleteS">
    
                    <!--Response-->
                    <div class="alert response" id="responseDeleteStudent" role="alert" style="display: none;">
                        
                    </div>

                    <!--Title-->
                    <div class="titleAddStudent">
                        <i class="btn btn-default fas fa-info-circle fa-lg"></i>
                        <span class="h4 leyenda">Materias</span>
                    </div>

                    <!--Table-->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="leyenda">Nombre</th>
                                    <th class="leyenda">Costo</th>
                                    <th class="leyenda">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="bodyTableAsignature">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal fade" id="modalAsignature" tabindex="-1" role="dialog" aria-labelledby="modalAsignatureLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content" id="modalInfoAsignature">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
    }
    else{
        header("Location: ../../../../index.php");
    }
?>
