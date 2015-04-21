<?php 
/*session_start();
ob_start();
?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php include ("C:\Users\dv7\Documents\wamp\www\inmana\admin\advsecu.php") ?>
<?php include ("C:\Users\dv7\Documents\wamp\www\inmana\admin\ewconfig.php") ?>
<?php include ("C:\Users\dv7\Documents\wamp\www\inmana\admin\db.php") ?>
<?php

if (!IsLoggedIn()) {
	ob_end_clean();
	header("Location: http://localhost/inmana/admin/login.php");
	exit();
}
  */  // Almacena el id pasado en una variable local
    $userID = $_GET['userID'];
    

    // Datos para la conexion a la base del hosting
    //$dbc = mysql_connect("localhost", "p7000115_web339", "inMana2011");
    $conexion = new mysqli("localhost","web339","rFv159urB+","usr_web339_1");
    
    // Si ocurre un error de conexion lo informa
    if ($conexion->connect_error)  
        die('Error de Conexion ('.$conexion->connect_errno.')'.$conexion->connect_error);

    
    $recordset = $conexion->query("SELECT * FROM usuarios WHERE id= '" .$userID. "'" );

    while ($fila = $recordset->fetch_assoc()) { 
            $arrayName = array("userID" => $fila['id'] , "nombre" => $fila['nombre'] , "apellido" => $fila['apellido'], "contrasenia" => $fila['contrasenia'], "email" => $fila['email'], "fecha" => $fila['fecha'] );        
    }
    

    echo json_encode($arrayName);

?>