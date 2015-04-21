<?php 

    $userID = $_GET['userID'];
		$name_user = $_GET['nombre'];
		$lastname_user = $_GET['apellido'];


    // Datos para la conexion a la base del hosting
    //$dbc = mysql_connect("localhost", "p7000115_web339", "inMana2011");
    $conexion = new mysqli("localhost","web339","rFv159urB+","usr_web339_1");
    
    // Si ocurre un error de conexion lo informa
    if ($conexion->connect_error)  
        die('Error de Conexion ('.$conexion->connect_errno.')'.$conexion->connect_error);

    $recordset = $conexion->query("UPDATE usuarios SET nombre='" . $name_user . "', apellido='" . $lastname_user . "'  WHERE id = '" .$userID. "'" );
 

    $arrayName = array("userID" => $userID , "nombre" => $name_user , "apellido" => $lastname_user , "email" => $email );

    echo json_encode($arrayName);

 ?>