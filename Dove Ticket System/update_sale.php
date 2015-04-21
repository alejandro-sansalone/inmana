<?php	

    // Datos para la conexion a la base del hosting
    //$dbc = mysql_connect("localhost", "p7000115_web339", "inMana2011");
    $dbc = mysql_connect("localhost", "web339", "rFv159urB+");
    if (!$dbc) {
        die('No pudo conectarse: ' . mysql_error());
    }
    
    // ----- / Solo a fines de depuracion /--------- //
    //echo 'Conectado satisfactoriamente' . "<br>";

    // Datos para la conexion a la base del hosting //
    //$bd_seleccionada = mysql_select_db("p7000115_web339",$dbc);
    $bd_seleccionada = mysql_select_db("usr_web339_1",$dbc);
    if (!$bd_seleccionada) {
        die ('No se puede usar la base de datos seleccionada : ' . mysql_error());
        
    }

    $id = $_POST['ticket_id'];

    $sqlString = "UPDATE casas SET estado = 'En Venta' WHERE id = '" . $id . "'";

    $recordset = mysql_query($sqlString, $dbc);

    printf("Registros actualizados: %d\n", mysql_affected_rows());

    if ($recordset) {
    	echo "salio por echo " . 1;
    }
    else{
    	echo 0;
    }


?>