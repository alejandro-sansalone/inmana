<?php 
session_start();
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

    // Datos para la conexion a la base del hosting
    //$dbc = mysql_connect("localhost", "p7000115_web339", "inMana2011");
    $dbc = mysql_connect("localhost", "web339", "rFv159urB+");
    if (!$dbc) {
        die('No pudo conectarse: ' . mysql_error());
    }
    

    // Datos para la conexion a la base del hosting //
    //$bd_seleccionada = mysql_select_db("p7000115_web339",$dbc);
    $bd_seleccionada = mysql_select_db("usr_web339_1",$dbc);
    if (!$bd_seleccionada) {
        die ('No se puede usar la base de datos seleccionada : ' . mysql_error());
    }

    $sqlUsers = "SELECT * FROM usuarios";

    $rsUsers = mysql_query($sqlUsers, $dbc);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1, maximun-scale=1, user-scalable=no" name="viewport">
	<title>Inmana Admin</title>
	<link type="text/css" rel="stylesheet" href="bootstrap.css">
	<link type="text/css" rel="stylesheet" href="dataTables.bootstrap.css">
	<link type="text/css" rel="stylesheet" href="green.css">
	<link type="text/css" rel="stylesheet" href="bootstrap-select.css">
	<link type="text/css" rel="stylesheet" href="default.css">
	<link type="text/css" rel="stylesheet" href="admin.css">
	<link type="text/css" rel="stylesheet" href="icon-realstate2.css">
	<link type="text/css" rel="stylesheet" href="skins/square/green.css">

	<style>
			.paginate_button{
				padding: 10px;
			}
			
			div.dataTables_info{
				padding: 10px;
				color: #FFF;
				background-color: rgb(119, 119, 119);
				margin-top: -5px;
				padding-top: 20px;
				padding-bottom: 20px;
			}
			
			div.dataTables_paginate {
			    float: right;
			    margin: -40px 0px 0px;
			    padding-right: 25px;
			}

			div.dropdown-menu.profile_links {
				 box-shadow: inset 0px 0px 4px 0px #CCC;
			}

			div.dropdown-menu.profile_links a:hover{
				background-color: #CCC;
			}
			
			.table tbody .odd{
				background-color: #EDEDED;
			}
	</style>


</head>
<body>
	
		<!-- Comienzo de Navegacion -->
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container">
				<div class="row">
					<div class="col-md-12">

						<div class="navbar-header">
							<button class="navbar-toggle" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" type="button">
								<span class="sr-only"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a href="" class="navbar-brand">PORTAL ADMINISTRACION WEB - INMANA.COM</a> <!-- Aca va el logo -->
						</div>

						<div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
							<div class="nav navbar-nav navbar-right">
								<i id="message" class="glyphicon glyphicon-envelope nav-notification-tickets">
									<span id="count_msg">3</span>
								</i>
								<img id="img_drop" class="nav-small-avatar" heigt="40" width="40" data-toggle="dropdown" src="image/fafceed7611111a4b8fb75a57e8b2fba.png">
								<button id="btn_drop" class="btn btn-navigation" data-toggle="dropdown" type="button"><?php echo $_SESSION["session_username"]; ?>
									<b class="caret"></b>
								</button>
								<div class="dropdown-menu profile_links">
									<li>
										<a tabindex="-1" role="menuitem" data-toggle="modal" href="#edit_profile">
											<i class="glyphicon glyphicon-user" style="margin-right:5px"> Perfil </i>
										</a>
									</li>
									<li class="divider" role="presentation"></li>
									<li>	
										<a href="logout.php" tabindex="-1" role="menuitem">
											<i class="glyphicon glyphicon-off" style="margin-right: 5px"></i> Cerrar sesion
										</a>
									</li>
								</div>
							</div>
						</div>
						
						<div class="new_tickets_alert_box" data-flag="true" style="overflow-y: hidden">
							<ul class="list-group">
								<li id="shortcut_msg" clas="listgroup-item text-center" style="font-weight: bold"></li>
								<li id="message_top_box_16"></li>
								<li id="message_top_box_6"></li>
								<li id="message_top_box_10"></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
		
		<!-- Segunda Barra de Navegacion -->	
		<div class="second-navbar">
			<div class="container">
				<div class="row">
					<nav class="navbar navbar-default second-navbar-menu" role="navigation">
						<div class="navbar-header">
							<button class="navbar-toggle" data-taget="#bs-example-navbar-collapse-2" data-toggle="collapse" type="button">
								<span class="sr-only"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div id="bs-example-navbar-collapse-2" class="collapse navbar-collapse">
							<ul class="nav navbar-nav">
									<!--
									<li class="active" style="margin-top: -11px">
										<a href=".">
											<i class="glyphicon glyphicon-comment nav-img" ></i>
											<p>Reclamos</p>
										</a>
									</li>
									-->
									<li class="active">
										<a href=".">
											<i class="glyphicon glyphicon-user nav-img"></i>
											<p>Usuarios</p>
										</a>
									</li>
									<li class="">
										<a href="admin-inmana.php">
											<i class="glyphicon glyphicon-home nav-img" ></i>
											<p>Casas</p>
										</a>
									</li>
									<li class="">
										<a href="" >
											<i style="font-size:30px" class="glyphicon flaticon-key142 nav-img"></i>
											<p>Alquileres</p>
										</a>
									</li>
									<li class="">
										<a href="">
											<i class="glyphicon flaticon-realestate nav-img"></i>
											<p>Ventas</p>
										</a>
									</li>
									<!--
									<li class="">
										<a href="">
											<i class="glyphicon glyphicon-envelope nav-img"></i>
											<p>Mail</p>
										</a>
									</li>
								-->
									<li class="">
										<a href="">
											<i class="glyphicon glyphicon-cog nav-img"></i>
											<p>Config</p>
										</a>
									</li>
								</ul>	
							<ul class="nav navbar-nav navbar-right"></ul>	
						</div>	

					</nav>
				</div>
			</div>
		</div>

		<div id="edit_profile" class="modal fade" aria-hidden="true" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button id="modal-close" class="none" aria-hidden="true" datta-dismiss="modal" type="button">X</button>
						<h2 class="modal-title">Datos Personales</h2>
					</div>
					<div class="modal-body">
						<!-- Comienzo del Formulario -->
						<form class="form-horizontal" method="post" role="form" action="javascript:;">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="fname">Nombre</label>
								<div class="col-sm-10">
									<input id="fname_edit_profile" type="text"  class="form-control" placeholder="Nombre">
								</div>
							</div>
							<div class="form-group">
								<label for="lname" class="col-sm-2 control-label">Apellido</label>
								<div class="col-sm-10">
									<input type="text" id="lname_edit_profile" class="form-control" placeholder="Apellido">
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-2 control-label" >E-Mail</label>
								<div class="col-sm-10">
									<input type="email" id="email_edit_profile" class="form-control" placeholder="ejemplo@mail.com">
								</div>
							</div>
							<div class="form-group">
								<label for="new_pass" class="col-sm-2 control-label" >Contraseña</label>
								<div class="col-sm-10">
									<input type="password" id="new_pass_edit_profile" class="form-control" placeholder="Si quiere una contraseña nueva tipeela">
								</div>
							</div>
							<input type="hidden" id="hidden_update_edit_profile" value="1:{:}administrator">							
						</form>
					</div>
					<div class="modal-footer">
						<button id="btn_close_edit_profile" class="btn my-btn-default" data-dismiss="modal" type="button">Cerrar</button>
						<button id="btn_update_edit_profile" class="btn my-btn-success" data-dismiss="modal" type="button">Actualizar</button>
						<p id="error_update_edit_profile" class="pull-left" style="font-size: 15px"></p>
						<img src="" alt="" id="preloader_update_edit_profile" class="pull-left" style="display:none;">
					</div>
				</div>
			</div>
		</div>

		<section class="admin-body">
		    <div class="container">
		        <div class="row">
		            <div class="col-md-12">
		                <div class="btn-group">
		                    <a href="#modal_add" onclick="$('#send_email').iCheck('check');" role="button" data-toggle="modal" class="btn btn-ticket">AGREGAR NUEVO
		                    </a>
		                </div>
		                <!-- START TABLES -->
		                <br>
		                <img src="../assets/image/preloader.gif" id="preloader_page" style="margin-left: 48%;margin-top: 3%;margin-bottom: 182px;display: none;">
		                <div class="table-responsive" id="box_body_table">

                    <div id="table_users_wrapper" class="dataTables_wrapper form-inline" role="grid">
	                     	<div class="row">
	                     		<div class="col-xs-6">
		                     		<div class="dataTables_length" id="table_users_length">
		                     			<!--
		                     			<label>
		                     				<select aria-controls="table_users" size="1" name="table_users_length">
		                     					<option selected="selected" value="10">10</option>
		                     					<option value="25">25</option><option value="50">50</option>
		                     					<option value="100">100</option>
		                     				</select> Records per page
		                     			</label>
		                     		-->
		                     		</div>
	                     		</div>
		                     	<div class="col-xs-6">
		                     		<!--
		                     		<div id="table_users_filter" class="dataTables_filter">
		                     			<label>Search: <input aria-controls="table_users" type="text">
		                     			</label>
		                     		</div>
		                     	-->
		                     	</div>
	                  		</div>
												<!--
						            <table aria-describedby="table_users_info" id="table_users" class="table table-bordered table-hover dataTable"   data-page-length='10'>
							          -->  
							          <table  id="table_users" class="table table-bordered table-hover dataTable"   >
							            <thead>
							            		<tr role="row">
								            			<th>ID</th>								            			
								            			<th  colspan="1" rowspan="1" aria-controls="table_users" aria-sort="ascending" tabindex="0" role="columnheader" class="sorting">NOMBRE COMPLETO</th>
								            			<th aria-label="EMAIL: activate to sort column ascending" colspan="1" rowspan="1" aria-controls="table_users" aria-sort="ascending" tabindex="0" role="columnheader" class="sorting">EMAIL</th>
								            			<th aria-label="ACTIVE: activate to sort column ascending" colspan="1" rowspan="1" aria-controls="table_users" aria-sort="ascending" tabindex="0" role="columnheader" class="sorting">ADMIN</th>
								            			<th aria-label="REGISTRATION DATE: activate to sort column ascending" aria-sort="descending" colspan="1" rowspan="1" aria-controls="table_users" tabindex="0" role="columnheader" class="sorting_desc">FECHA ALTA</th>
								            			<th aria-label="ACTIONS: activate to sort column ascending" colspan="1" rowspan="1" aria-controls="table_users" tabindex="0" role="columnheader" class="sorting">ACIONES</th>
							            		</tr>
							            </thead>
						            
							            <tbody aria-relevant="all" aria-live="polite" role="alert">
													<?php  
														while ($fila = mysql_fetch_assoc($rsUsers)) { 	
																  echo "<tr class='status-close '>" ;
																  echo 			"<td class=''>" . $fila['id'] . "</td>";
																  echo 			"<td class=''>" . $fila['nombre'] . " " . $fila['apellido'] . "</td>";
																  echo 			"<td class=''>" . $fila['email'] . "</td>"; 
																  if ($fila['admin'] == 1) {
																  		echo "<td class='priority-high'>Si</td>";
																  }
																  else{
																  	echo "<td class='priority-low'>No</td>";			
																  }
																  echo 			"<td> " . $fila['fecha'] . " </td>";
																  echo 			"<td class='actions'>" ;
																  echo 					"<a href='javascript:;' id='edit' role='button' title='Modificar'><i class='glyphicon glyphicon-edit'></i></a>";;
																  //echo 					"<a href='javascript:;' id='edit' role='button' onclick='get_user(" . $fila['id'] . ");' title='Modificar'><i class='glyphicon glyphicon-edit'></i></a>";
																  echo 					"<a href='javascript:;' id='block' role='button' ' title='Bloquear'><i class='glyphicon glyphicon-ban-circle'></i></a>";
																  //echo 					"<a href='javascript:;' id='delete' role='button' onclick='remove_user_modal(". $fila['id'] . ");' title='Eliminar'><i class='glyphicon glyphicon-trash'></i></a>";
																  echo 					"<a href='javascript:;' id='delete' role='button'  title='Eliminar'><i class='glyphicon glyphicon-trash'></i></a>";
																  echo      "</td>";	
																  echo "</tr>" ;
														}
													?>
							            </tbody>
						            </table>
<!--
						            <div class="row">
						            	<div class="col-xs-6">
						            		
						            		/// =============================================================================
						            		/// Revisar como agregar una clase para poder modificaf el id="table_users_info"
						            		/// que es el div con id que agrega automaticamante el dataTables.js
						            		/// ============================================================================= 

						            		<div id="table_users_info" class="dataTables_info">Showing 1 to 10 of 17 entries
						            		</div>
						            	
						            	</div>
							            <div class="col-xs-6">
							            	<!--
							            	<div class="dataTables_paginate paging_bootstrap">
							            		<ul class="pagination">
							            			<li class="prev disabled"><a href="#">← Previous</a></li>
							            			<li class="active"><a href="#">1</a></li>
							            			<li><a href="#">2</a></li>
							            			<li class="next"><a href="#">Next → </a></li>
							            		</ul>
							            	</div>
							            
				            			</div>
			          				</div>
-->
	        					</div>
		       					</div>
		                <!-- END TABLES -->
		            </div>
		        </div>
		    </div>

		    <!-- Remove or Block User -->
		    <div class="modal fade" id="myModal">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <button type="button" class="close" id="modal-close" data-dismiss="modal" aria-hidden="true">X</button>
		                    <h2 class="modal-title" id="modal_title"></h2>
		                </div>
		                <div class="modal-body">
		                    <p id="modal_body"></p>
		                </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn my-btn-default" id="btn_close" data-dismiss="modal">Cerrar</button>
		                    <button type="button" class="btn" id="btn_remove_block"></button>
		                    <img src="../assets/image/preloader.gif" id="preloader_modal" class="pull-left" style="display: none;">
		                    <p id="error_modal" class="text-red pull-left"></p>
		                </div>
		            </div><!-- /.modal-content -->
		        </div><!-- /.modal-dialog -->
		    </div><!-- /.modal -->

		    <!-- Show Success -->
		    <div class="modal fade" id="ShowSuccess">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <button type="button" class="close" id="modal-close" data-dismiss="modal" aria-hidden="true">X</button>
		                    <h2 class="modal-title" id="modal_title_success"></h2>
		                </div>
		                <div class="modal-body">
		                    <p id="modal_body_success"></p>
		                </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn my-btn-default" id="btn_close" data-dismiss="modal">Cerrar</button>
		                    <!--<button type="button" class="btn" id="btn_remove_block">ok</button>-->
		                    <img src="../assets/image/preloader.gif" id="preloader_modal" class="pull-left" style="display: none;">
		                    <p id="error_modal" class="text-red pull-left"></p>
		                </div>
		            </div><!-- /.modal-content -->
		        </div><!-- /.modal-dialog -->
		    </div><!-- /.modal -->

		    <!-- Show Aditional Info -->
		    <div class="modal fade" id="ShowInfo">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <button type="button" class="close" id="modal-close" data-dismiss="modal" aria-hidden="true">X</button>
		                    <h2 class="modal-title" id="modal_title_info">Informacion Adicional</h2>
		                </div>
		                <div class="modal-body">
		                		<form action="javascript:;" class="form-horizontal" role="form" method="post">
				                    <p id="modal_body_info"></p>
		                        <div class="form-group">
		                            <label for="fname-info" class="col-sm-3 control-label">Nombre</label>
		                            <div class="col-sm-9">
		                                <input class="form-control" id="fname-info" type="text" disabled>
		                            </div>
		                        </div>												
		                        <div class="form-group">
		                            <label for="lname-info" class="col-sm-3 control-label">Apellido</label>
		                            <div class="col-sm-9">
		                                <input class="form-control " id="lname-info" type="text" disabled>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label for="password-info" class="col-sm-3 control-label">Contraseña</label>
		                            <div class="col-sm-9">
		                                <input class="form-control " id="password-info" type="text" disabled>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label for="email-info" class="col-sm-3 control-label">E-Mail</label>
		                            <div class="col-sm-9">
		                                <input class="form-control " id="email-info" type="text" disabled>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label for="admin_info" class="col-sm-3 control-label">Administrador</label>
		                            <div class="col-sm-9">
		                                <input class="form-control " id="admin_info" type="text" disabled>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <div class="col-sm-9" style="margin-top: 5px;">
		                                <div style="position: relative;" class="icheckbox_flat-green checked">
		                                	<input checked="checked" type="checkbox">		                        
		                                </div>
		                            </div>
		                        </div>

												</form>	
		                </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn my-btn-default" id="btn_close" data-dismiss="modal">Cerrar</button>
		                    <!--<button type="button" class="btn" id="btn_remove_block">ok</button>-->
		                    <img src="../assets/image/preloader.gif" id="preloader_modal" class="pull-left" style="display: none;">
		                    <p id="error_modal" class="text-red pull-left"></p>
		                </div>
		            </div><!-- /.modal-content -->
		        </div><!-- /.modal-dialog -->
		    </div><!-- /.modal -->

		    <!-- Add User -->
		    <div class="modal fade" role="dialog" aria-hidden="true" id="modal_add">
		        <div class="modal-dialog modal-lg">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <button type="button" class="close" id="modal-close" data-dismiss="modal" aria-hidden="true">X</button>
		                    <h2 class="modal-title" id="modal_title_add">NUEVO USUARIO</h2>
		                </div>
		                <div class="modal-body" id="modal_body_add">

		                    <!-- form start -->
		                    <form action="javascript:;" class="form-horizontal" role="form" method="post">
		                        <div class="form-group">
		                            <label for="fname" class="col-sm-3 control-label">Nombre</label>
		                            <div class="col-sm-9">
		                                <input class="form-control" id="fname" placeholder="Nombre" type="text">
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label for="lname" class="col-sm-3 control-label">Apellido</label>
		                            <div class="col-sm-9">
		                                <input class="form-control" id="lname" placeholder="Apellido" type="text">
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label for="email" class="col-sm-3 control-label">E-Mail</label>
		                            <div class="col-sm-9">
		                                <input class="form-control" id="email" placeholder="Email" type="email">
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label for="password" class="col-sm-3 control-label">Contraseña</label>
		                            <div class="col-sm-9">
		                                <input class="form-control" id="password" placeholder="Contraseña" type="password">
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="col-sm-3 control-label">Enviar Password?</label>
		                            <div class="col-sm-9" style="margin-top: 5px;">
		                                <div class="icheckbox_flat-green checked">
		                                	<input  checked="checked" type="checkbox">
		                                </div>
		                                Enviar esta contraseña para el nuevo usuario por correo electrónico.
		                            </div>
		                        </div>
		              		  </form>
		              	</div>
		                <div class="modal-footer">
		                    <button type="button" class="btn my-btn-default" id="btn_close_add" data-dismiss="modal">Cerrar</button>
		                    <button type="button" class="btn my-btn-success" id="btn_add_user" data-dismiss="modal">Agregar</button>
		                    <img src="../assets/image/preloader.gif" id="preloader_add_user" class="pull-left" style="display: none;">
		                    <p id="error_add_user" class="text-red pull-left"></p>
		                </div>

		            </div><!-- /.modal-content -->
		        </div><!-- /.modal-dialog -->
		    </div><!-- /.modal -->

		    <!-- Edit User -->
		    <div class="modal fade" role="dialog" aria-hidden="true" id="modal_edit">
		        <div class="modal-dialog modal-lg">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <button type="button" class="close" id="modal-close" data-dismiss="modal" aria-hidden="true">X</button>
		                    <h2 class="modal-title" id="modal_title_edit">Edicion de Usuarios</h2>		                    
		                </div>
		                <div class="modal-body" id="modal_body_edit">

		                    <!-- form start -->
		                    <form action="javascript:;" class="form-horizontal" role="form" method="post">
		                        <div class="form-group">
		                            <label for="fname" class="col-sm-3 control-label">Nombre</label>
		                            <div class="col-sm-9">
		                                <input class="form-control" value="" id="fname_edit" placeholder="Nombre" type="text">
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label for="lname" class="col-sm-3 control-label">Apellido</label>
		                            <div class="col-sm-9">
		                                <input class="form-control" value="" id="lname_edit" placeholder="Apellido" type="text">
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label for="email" class="col-sm-3 control-label">Email</label>
		                            <div class="col-sm-9">
		                                <input class="form-control" value="" id="email_edit" placeholder="Email" type="email">
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label for="password" class="col-sm-3 control-label">Contraseña</label>
		                            <div class="col-sm-9">
		                                <input class="form-control" id="new_pass" placeholder="Si id. quiere cambiar la contraseña por favor tipee una" type="password">
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="col-sm-3 control-label">Enviar Contraseña?</label>
		                            <div class="col-sm-9" style="margin-top: 5px;">
		                                <div style="position: relative;" class="icheckbox_flat-green checked"><input style="position: absolute; opacity: 0;" id="send_email_edit" checked="checked" value="send_pass" type="checkbox">
		                                	<ins style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;" class="iCheck-helper"></ins>
		                                </div> Send this password to the user by email.</div>
		                        </div>
		                </form></div>
		                <div class="modal-footer">
		                    <button type="button" class="btn my-btn-default" id="btn_close_edit" data-dismiss="modal">Cerrar</button>
		                    <button type="button" class="btn my-btn-success" id="btn_edit_user">Actualizar</button>
		                    <p style="font-size: 15px;" class="pull-left" id="error_edit_user"></p>
		                    <img src="../assets/image/preloader.gif" class="pull-left" style="display: none;" id="preloader_edit_user">
		                    <!-- End form -->
		                </div>

		            </div><!-- /.modal-content -->
		        </div><!-- /.modal-dialog -->
		    </div><!-- /.modal -->
		</section>		

		<footer class="admin-footer">
		    <div id="triangle-up"><i class="glyphicon glyphicon-arrow-up"></i></div>
		    <div class="bottom-footer">
		        <div class="container">
		            <div class="row" >
		                <div class="col-md-12">
											<div class="col-md-6">
												<p style="font-size:12px;">Copyright 2015 - www.Inmana.com - Todos los derechos reservados - info@Inmana.com</p>
											</div>
											<div class="col-md-6">
												<p style="float:right; font-size:12px; padding:0; margin:0">Developed by - www.Adssoftware.com.ar</p>
											</div>
		                </div>
		            </div>
		        </div>
		    </div>
		</footer>


<script type="text/javascript">



    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+d.toGMTString();
        document.cookie = cname + "=" + cvalue + "; " + expires+ "; path=*";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
        }
        return "";
    }

    $("[name='skin']").on('ifChecked', function(event)
    {
        var skin = $(this).val();
        if( getCookie( "skin" ) != "" ) {
            setCookie( "skin", "", -1 );
        }
        setCookie( "skin", skin, 1 );
        setTimeout(function(){
            location.reload();
        }, 100);
    });

    $.fn.modal.Constructor.prototype.enforceFocus = function () {
        modal_this = this;
        $(document).on('focusin.modal', function (e) {
            if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length
                    // add whatever conditions you need here:
                    &&
                    !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
                modal_this.$element.focus()
            }
        })
    };

    var skin_checkbox = 'icheckbox_flat-' + 'green';
    var skin_radio    = 'iradio_flat-' + 'green';

    $('input').iCheck({
        checkboxClass: skin_checkbox,
        radioClass: skin_radio
    });

    function in_array(value, array)
    {
        return array.indexOf(value) > -1;
    }

    function validateForm(email)
    {
        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");
        if(atpos < 1 || dotpos<atpos+2 || dotpos+2>=email.length)
        {
            return false;
        }
        return true;
    }

    $("#btn_update_edit_profile").click(function()
    {
        var fname = $("#fname_edit_profile").val();
        var lname = $("#lname_edit_profile").val();
        var email = $("#email_edit_profile").val();
        var new_pass = $("#new_pass_edit_profile").val();
        var info = $("#hidden_update_edit_profile").val();

        if($.trim(fname) == "")
        {
            $("#error_update_edit_profile").addClass("text-red");
            $("#error_update_edit_profile").removeClass("text-green");
            $("#error_update_edit_profile").html("Por favor ingrese un Nombre");
            $("#error_update_edit_profile").fadeIn(500).delay(2000).fadeOut(1000);
            return false;
        }
        if($.trim(lname) == "")
        {
            $("#error_update_edit_profile").addClass("text-red");
            $("#error_update_edit_profile").removeClass("text-green");
            $("#error_update_edit_profile").html("Por favor ingrese un Apellido");
            $("#error_update_edit_profile").fadeIn(500).delay(2000).fadeOut(1000);
            return false;
        }
        if(!validateForm(email))
        {
            $("#error_update_edit_profile").addClass("text-red");
            $("#error_update_edit_profile").removeClass("text-green");
            $("#error_update_edit_profile").html("Por favor ingrese una Contraseña");
            $("#error_update_edit_profile").fadeIn(500).delay(2000).fadeOut(1000);
            return false;
        }

        $("#btn_close_edit_profile").prop('disabled', true);
        $("#btn_update_edit_profile").prop('disabled', true);
        $("#error_update_edit_profile").addClass("text-red");
        $("#error_update_edit_profile").removeClass("text-green");
        $("#error_update_edit_profile").html("This is a demo version!");
        $("#error_update_edit_profile").fadeIn(500).delay(2000).fadeOut(500, function(){
            $("#btn_close_edit_profile").prop('disabled', false);
            $("#btn_update_edit_profile").prop('disabled', false);
        });
        return false;

    });
</script>

<script type="text/javascript">
				/*
		    if($("#table_users").length != 0)
		    {
		        $("#table_users").dataTable({
		            "bPaginate": true,
		            "bLengthChange": true,
		            "bFilter": true,
		            "bSort": true,
		            "bInfo": true,
		            "bAutoWidth": false,
		            "aaSorting": [[ 3, "asc" ]],
		            "bStateSave": true
		        });
		    }
				*/
		    function block_user_modal(id, block)
		    {
		        if(block == 0)
		        {
		            $("#btn_remove_block").removeClass('my-btn-danger my-btn-success');
		            $("#btn_remove_block").addClass('my-btn-warning');
		            $("#btn_remove_block").html("Bloquear");
		            $("#modal_title").html("Bloquear Usuarios");
		            $("#modal_body").html("Desea Ud. bloquear este usuario?");
		        }
		        else
		        {
		            $("#btn_remove_block").removeClass('my-btn-danger my-btn-warning');
		            $("#btn_remove_block").addClass('my-btn-success');
		            $("#btn_remove_block").html("Desbloquear");
		            $("#modal_title").html("Desbloquear Usuarios");
		            $("#modal_body").html("Desea Ud. Desbloquear el Usuario?");
		        }
		        $('#myModal').modal('show');
		        $("#btn_remove_block").attr('onclick', 'block_unblock_user("'+id+'","'+block+'")');
		    }

		    function block_unblock_user(id, block)
		    {
		        $("#btn_remove_block").prop('disabled', true);
		        $("#btn_close").prop('disabled', true);
		        $("#error_modal").addClass('text-red');
		        $("#error_modal").removeClass('text-green');
		        $("#error_modal").html("This is a demo version!");
		        $("#error_modal").fadeIn(500).delay(1000).fadeOut(500,function(){
		            $("#btn_remove_block").prop('disabled', false);
		            $("#btn_close").prop('disabled', false);
		            $('#myModal').modal('hide');
		            show_success_modal(id, block);
		        });
		    }

		    function remove_user_modal(id)
		    {
		        $("#btn_remove_block").removeClass('my-btn-warning my-btn-success');
		        $("#btn_remove_block").addClass('my-btn-danger');
		        $("#btn_remove_block").html("Elimimar");
		        $("#modal_title").html("Eliminar Usuario ");
		        $("#modal_body").html("Desea Ud Eliminar este Usuario? <br> User ID: " + id);
		        $('#myModal').modal('show');
		        $("#btn_remove_block").attr('onclick', 'remove_user("'+id+'")');
		    }
		    
		    function remove_user(id)
		    {
		        $("#btn_remove_block").prop('disabled', true);
		        $("#btn_close").prop('disabled', true);
		        $("#error_modal").addClass('text-red');
		        $("#error_modal").removeClass('text-green');
		        //$("#error_modal").html("This is a demo version!");

						$.getJSON('delete_user.php', {userID: id}, 
							function(data) {
								alert(data);
								if(data == 'success') {
									alert("Deleted");
								}	
						});

		        
		        $("#error_modal").fadeIn(500).delay(500).fadeOut(500,function(){
		            $("#btn_remove_block").prop('disabled', false);
		            $("#btn_close").prop('disabled', false);
		            $('#myModal').modal('hide');
									var tableUsr = $('#table_users').DataTable();	
									var myRowID = tableUsr.row( id ).index();	
									tableUsr.row( myRowID ).remove().draw();		            
		        });
		    }

		    function show_success_modal (id, action) {
		        if(action == 0)
		        {
		            $("#btn_remove_block").removeClass('my-btn-danger my-btn-success');
		            $("#btn_remove_block").addClass('my-btn-warning');
		            $("#btn_remove_block").html("Bloquear");
		            $("#modal_title_success").html("Bloquear Usuarios");
		            $("#modal_body_success").html("Usuario bloqueado exitsamente!!");
		        }
		        else
		        {
		            $("#btn_remove_block").removeClass('my-btn-danger my-btn-warning');
		            $("#btn_remove_block").addClass('my-btn-success');
		            $("#btn_remove_block").html("Desbloquear");
		            $("#modal_title_success").html("Desbloquear Usuarios");
		            $("#modal_body_success").html("Usuario Desbloqueado exitsamente!!");
		        }	    	
		    	$('#ShowSuccess').modal('show')	
		    }

		    $("#btn_add_user").click(function()
		    {
		        var send_email = $("#send_email").is(':checked');
		        var fname = $("#fname").val();
		        var lname = $("#lname").val();
		        var email = $("#email").val();
		        var password = $("#password").val();

		        if($.trim(fname) == "")
		        {
		            $("#error_add_user").addClass("text-red");
		            $("#error_add_user").removeClass("text-green text-blue");
		            $("#error_add_user").html("Por favor ingrese el nombre");
		            $("#error_add_user").fadeIn(500).delay(2000).fadeOut(1000);
		            return false;
		        }
		        if($.trim(lname) == "")
		        {
		            $("#error_add_user").addClass("text-red");
		            $("#error_add_user").removeClass("text-green text-blue");
		            $("#error_add_user").html("Por favor ingrese el Apellido");
		            $("#error_add_user").fadeIn(500).delay(2000).fadeOut(1000);
		            return false;
		        }
		        if(!validateForm(email))
		        {
		            $("#error_add_user").addClass("text-red");
		            $("#error_add_user").removeClass("text-green text-blue");
		            $("#error_add_user").html("Por favor ingrese un direccion de correo valida");
		            $("#error_add_user").fadeIn(500).delay(2000).fadeOut(1000);
		            return false;
		        }
		        if($.trim(password) == "")
		        {
		            $("#error_add_user").addClass("text-red");
		            $("#error_add_user").removeClass("text-green text-blue");
		            $("#error_add_user").html("Por favor ingrese una contraseña");
		            $("#error_add_user").fadeIn(500).delay(2000).fadeOut(1000);
		            return false;
		        }

		        $("#btn_add_user").prop('disabled', true);
		        $("#btn_close_add").prop('disabled', true);
		        $("#error_add_user").addClass("text-red");
		        $("#error_add_user").removeClass("text-green text-blue");
		        $("#error_add_user").html("This is a demo version!");
		        $("#error_add_user").fadeIn(500).delay(2000).fadeOut(500, function(){
		            $("#fname").val("");
		            $("#lname").val("");
		            $("#email").val("");
		            $("#password").val("");
		            $("#btn_add_user").prop('disabled', false);
		            $("#btn_close_add").prop('disabled', false);
		        });

		    });


		    function get_users_table()
		    {
		        $("#box_body_table").html("");
		        $("#preloader_page").show();
		        $.post(
		            'ajax.php',
		            {
		                method:"get_users_table"
		            },
		            function(data, status)
		            {
		                if(status == 'success')
		                {
		                    if(data != 'error')
		                    {
		                        $("#preloader_page").hide();
		                        $("#box_body_table").html(data);
		                        $("#table_users").dataTable({
		                            "bPaginate": true,
		                            "bLengthChange": true,
		                            "bFilter": true,
		                            "bSort": true,
		                            "bInfo": true,
		                            "bAutoWidth": false,
		                            "aaSorting": [[ 3, "desc" ]],
		                            "bStateSave": true
		                        });
		                    }
		                }
		            }
		        );
		    }

				// --------------------------------
				//  Name: get_user()
				//	Params: userID
				//  Autor: ADS - 06.04.15-19:37
				//  Descrip: Obtener los datos del usuario 
				//  				 por medio de una consulta ajax
				//---------------------------------		
				function get_user (userID,RowID) 
				{		
						$.getJSON('get_user.php', {userID: userID}, 
							function(data) {
								modal_edit_user(data.userID, data.nombre, data.apellido, data.email, RowID);	
						});
				}


				// Es llamada por get_user y pasa los datos al formulario en pantalla
		    function modal_edit_user(id, fname, lname, email, RowID)
		    {
		        $("#modal_edit").modal('show');
		        $("#fname_edit").val(fname);
		        $("#lname_edit").val(lname);
		        $("#email_edit").val(email);
		        //$("#btn_edit_user").attr('onclick', 'edit_user("'+ id , RowID +'")' );

		        $("#btn_edit_user").click( function(){
		        		edit_user( id , RowID );
		        });

		        $("#send_email_edit").iCheck('check');
		    }


		    // Hace la validacion de formulario y pasa los datos a la base
		    function edit_user(id, RowID)
		    {
		        var fname = $("#fname_edit").val();
		        var lname = $("#lname_edit").val();
		        var email = $("#email_edit").val();
		        var new_pass = $("#new_pass").val();
		        var id = id;
		        var send_email = $("#send_email_edit").is(':checked');

		        if($.trim(fname) == "")
		        {
		            $("#error_edit_user").addClass("text-red");
		            $("#error_edit_user").removeClass("text-green text-blue");
		            $("#error_edit_user").html("Por favor ingrese un Nombre");
		            $("#error_edit_user").fadeIn(500).delay(2000).fadeOut(1000);
		            return false;
		        }
		        if($.trim(lname) == "")
		        {
		            $("#error_edit_user").addClass("text-red");
		            $("#error_edit_user").removeClass("text-green text-blue");
		            $("#error_edit_user").html("Por favor ingrese un Apellido");
		            $("#error_edit_user").fadeIn(500).delay(2000).fadeOut(1000);
		            return false;
		        }
		        if(!validateForm(email))
		        {
		            $("#error_edit_user").addClass("text-red");
		            $("#error_edit_user").removeClass("text-green text-blue");
		            $("#error_edit_user").html("Por favor ingrese un direccion de correo valida");
		            $("#error_edit_user").fadeIn(500).delay(2000).fadeOut(1000);
		            return false;
		        }
	
						$.getJSON('update_user.php', {userID: id, nombre: fname, apellido: lname, email: email},
							function(info) {								
									$("#btn_edit_user").prop('disabled', true);
					        $("#btn_close_edit").prop('disabled', true);
					        $("#error_edit_user").addClass("text-red");
					        $("#error_edit_user").removeClass("text-green text-blue");
					        $("#error_edit_user").html("Actualizando.. espere por favor...");
					        $("#error_edit_user").fadeIn(500).delay(1000).fadeOut(500, function(){
					            $("#btn_edit_user").prop('disabled', false);
					            $("#btn_close_edit").prop('disabled', false);		            
											$("#error_edit_user").addClass("text-green");
											$("#error_edit_user").html("Se ha actualizado exitosamente");
					        });
					        $("#error_edit_user").fadeIn(500).delay(500).fadeOut(500, function()
					        {
					        		$("#modal_edit").modal('hide');
					        		
											var tableUsr = $('#table_users').DataTable();
    									tableUsr.cell( RowID,1 ).data( fname+" "+lname  ).draw();    									
    									tableUsr.cell( RowID,2 ).data( email ).draw();

					        });	

						});
				}

		</script>

		<script>
		    function manage_top_menu(box_id)
		    {
		        box_id = "#message_top_box_"+box_id;
		        if($(box_id).length != 0)
		        {
		            var count = Number($("#count_msg").html());
		            var head = $("#shortcut_msg").html();
		            head = head.replace(count, --count);
		            $("#shortcut_msg").html(head);
		            $("#count_msg").html(count);
		            $(box_id).remove();
		        }
		    }
		</script>

		<script src="jquery1.11.0.js" type="text/javascript" ></script>
		<script src="jquery-ui-1.10.4.js" type="text/javascript" ></script>
		<script src="bootstrap.js" type="text/javascript" ></script>
		<script src="icheck.js" type="text/javascript" ></script>
		<script src="jquery.dataTables.js" type="text/javascript" ></script>
		<script src="datatables.bootstrap.js" type="text/javascript" ></script>
		<script src="jquery.js" type="text/javascript" ></script>
		<script src="ckeditor.js" type="text/javascript" ></script>
		<script src="skrolls.js" type="text/javascript" ></script>
		<script src="default.js" type="text/javascript" ></script>
		<script src="jquery.form.js" type="text/javascript" ></script>
		<script src="bootstrap-select.js" type="text/javascript" ></script>
		<script src="admin.js" type="text/javascript" ></script>
	
		<script>
	
			$(document).ready(function() {

				  $('input').iCheck({
				    checkboxClass: 'icheckbox_square',
				    radioClass: 'iradio_square',
				    increaseArea: '20%' // optional
				  });


					$('#table_users tbody').on( 'click', 'tr td a#edit',  function () {		
							
							var tableUsr = $('#table_users').DataTable();		//Obtengo una referencia a la tabla
							var r = $(this).parent().parent();							//Obtengo una referencia al TR ( row ) 
							var myRowID = tableUsr.row( r ).index();				//Obtengo el ID (index) de la fila
							var myCellID = $(this).parent().index();				//Obtengo el ID (index) de la Celda	
							
							get_user(tableUsr.cell( myRowID,0 ).data(), myRowID );	

					});

					$('#table_users tbody').on( 'click', 'tr a#delete',  function () {		
							// Obtengo una referencia al TR ( row ) 
							var a = $(this).parent().parent();
							//Obtengo una referencia a la tabla 
							var tableUsr = $('#table_users').DataTable();
							//Obtengo el ID (index) de la fila
							var myRowID = tableUsr.row( a ).index();								
							remove_user_modal(myRowID);	
					});

	/*
					$('#table_users tbody').on( 'click', 'tr a#delete',  function () {	
							var tableUsr = $('#table_users').DataTable();
							var myRowID = tableUsr.row( this ).index();	
							tableUsr.row( this ).remove().draw(false);
							remove_user_modal(myRowID);	
							//alert("Delete?");	
					});
	*/				
					$('#table_users tbody').on( 'click', 'tr td a#block', function () {
							var tblInfo = $('#table_users').DataTable();
							var r = $(this).parent().parent();							//Obtengo una referencia al TR ( row ) 
							var RowIDinfo = tblInfo.row( r ).index();				//Obtengo el ID (index) de la fila
							var UserID =tblInfo.cell( RowIDinfo,0 ).data();
							get_user_info(UserID);
					});		

				function get_user_info(RowID) 
				{		
						$.getJSON('get_user.php', {userID: RowID}, 
							function(data) {					
								//modal_edit_user(data.userID, data.nombre, data.apellido, data.email, RowID);	
								$("#fname-info").val(data.nombre);
								$("#lname-info").val(data.apellido);
								$("#password-info").val(data.contrasenia);
								$("#email-info").val(data.email);
								$('#ShowInfo').modal('show')
						});
						
				}

			});

		</script>

</body>
</html>