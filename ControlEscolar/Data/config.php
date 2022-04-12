<?php 
    class ConnectDB{

        function conection(){
                $conn = new PDO("sqlsrv:Server=DESKTOP-FM0IMET\MSSQLSERVER1;Database=ControlEscolar", "sa", "1546921");
                return $conn; 
            }
        }
?>