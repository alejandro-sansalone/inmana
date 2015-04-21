<?php 

    $userID = $_GET['userID'];

    // Datos para la conexion a la base del hosting
    //$dbc = mysql_connect("localhost", "p7000115_web339", "inMana2011");
    $conexion = new mysqli("localhost","web339","rFv159urB+","usr_web339_1");
    
    // Si ocurre un error de conexion lo informa
    if ($conexion->connect_error)  
        die('Error de Conexion ('.$conexion->connect_errno.')'.$conexion->connect_error);

    //$recordset = $conexion->query("DELETE FROM usuarios WHERE id = '" .$userID. "'" );
 
    echo "success";

 ?>