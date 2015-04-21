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

    // Con isset se comprueba si la variable existe, y no es null, entonces, si se hizo click en alguna pagina
    if(isset($_GET['pagina'])){
        $pagina= $_GET['pagina'];
        $pag_detalle = $pagina;  // La variable $pag_detalle se utiliza para enviar el numero de pagina a la pagina de detalle, para asi poder volver a la consulta
    }else{
    //De lo contrario
        $pagina=1;
    }    

    $all_records = "SELECT * FROM CASAS";

    // Ejecutamos la consulta completa
    $total_records = mysql_query($all_records, $dbc);

    // Obtenemos el total de registros de la consulta
    $num_rows = mysql_num_rows($total_records);

    //Definimmos la cantidad de filas por pagina
    $rows_per_page= 10;

    // Calculamos la ultima pagina 
    $lastpage= ceil($num_rows / $rows_per_page);

    // Comprobamos el valor correcto de pagina y si es la ultima
    $pagina=(int)$pagina;
    if($pagina > $lastpage){
        $pagina= $lastpage;
    }
    if($pagina < 1){
        $pagina=1;
    }

    // Construimos la sentencia LIMIT (Esto nos permite filtrar o limitar la consulta SQL)
    $limit = 'LIMIT '. ($pagina -1) * $rows_per_page . ',' .$rows_per_page;

    // Armamos el string final de la consulta que muestra los datos (Anterior mas variable $limit)
		$all_records .=" $limit";

    $rs = mysql_query($all_records, $dbc);


     ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1, maximun-scale=1, user-scalable=no" name="viewport">
	<title>ADS Admin</title>
	<link type="text/css" rel="stylesheet" href="bootstrap.css">
	<link type="text/css" rel="stylesheet" href="dataTables.bootstrap.css">
	<link type="text/css" rel="stylesheet" href="green.css">
	<link type="text/css" rel="stylesheet" href="bootstrap-select.css">
	<link type="text/css" rel="stylesheet" href="default.css">
	<link type="text/css" rel="stylesheet" href="admin.css">
	<style>
		.pagination li a:hover{
	    color: #FFF !important;
	    border: 1px solid #111;
	    background: transparent linear-gradient(to bottom, #585858 0%, #111 100%) repeat scroll 0% 0%;				
		}
		.active > a{
			color: #333 !important;
			border: 1px solid #CACACA;
			background: transparent linear-gradient(to bottom, #FFF 0%, #DCDCDC 100%) repeat scroll 0% 0%;
		}
	</style>
</head>
<body>
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
							<a href="" class="navbar-brand">SOPORTE TECNICO ADS</a> <!-- Aca va el logo -->
						</div>

						<div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
							<div class="nav navbar-nav navbar-right">
								<i id="message" class="glyphicon glyphicon-envelope nav-notification-tickets">
									<span id="count_msg">3</span>
								</i>
								<img id="img_drop" class="nav-small-avatar" heigt="40" width="40" data-toggle="dropdown" src="image/fafceed7611111a4b8fb75a57e8b2fba.png">
								<button id="btn_drop" class="btn btn-navigation" data-toggle="dropdown" type="button">Ale 
									<b class="caret"></b>
								</button>
								<div class="dropdown-menu profile_links">
									<li>
										<a tabindex="-1" role="menuitem" data-toggle="modal" href="#edit_profile">
											<i class="glyphicon glyphicon-user" style="margin-right:5px">Perfil</i>
										</a>
									</li>
									<li class="divider" role="presentation"></li>
									<li>	
										<a href="logout.php" tabindex="-1" role="menuitem">
											<i class="glyphicon glyphicon-off" style="margin-right: 5px"></i>Cerrar sesion
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
		<!-- Comienzo de la segunda barra de navegacion -->
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
									<li class="active" style="margin-top: -11px">
										<a href=".">
											<i class="glyphicon glyphicon-comment nav-img" ></i>
											<p>Reclamos</p>
										</a>
									</li>
									<li class="">
										<a href=".">
											<i class="glyphicon glyphicon-user nav-img"></i>
											<p>Usuarios</p>
										</a>
									</li>
									<li class="">
										<a href="">
											<i class="glyphicon glyphicon-headphones nav-img" ></i>
											<p>Admin</p>
										</a>
									</li>
									<li class="">
										<a href="">
											<i class="glyphicon glyphicon-question-sign nav-img"></i>
											<p>Faq</p>
										</a>
									</li>
									<li class="">
										<a href="">
											<i class="glyphicon glyphicon-th-large nav-img"></i>
											<p>Sectores</p>
										</a>
									</li>
									<li class="">
										<a href="">
											<i class="glyphicon glyphicon-envelope nav-img"></i>
											<p>Mail</p>
										</a>
									</li>
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
						<form action="javascript:;" method="post" role="form" class="form-horizontal">
							<div class="form-group">
								<label for="fname" class="col-sm-2 control-label">Nombre</label>
								<div class="col-sm-10">
									<input type="text" id="fname_edit_profile" class="form-control" placeholder="Nombre">
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

		<div class="demo-setting">
			
		</div>
		<section class="admin-body">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="btn-group">
								<a href="#add_ticket" class="btn btn-ticket active" data-toggle="modal" role="button">NUEVO</a>
								<a href="" class="btn btn-ticket" role="button" style="background-color: rgba(255,255,255,0.4)">TODOS</a>
								<a href="" class="btn btn-ticket" role="button">ABIERTOS</a>
								<a href="" class="btn btn-link" role="button">CERRADOS</a>
								<a href="" class="btn btn-link" role="button">CONTESTADOS</a>
								<a href="" class="btn btn-link" role="button">PENDIENTES</a>								
							</div>
							<!-- Comienzo de las tablas -->	
							 <img id="preloader_page" style="margin-left: 48%; margin-top: 3%, margin-botton:182px; display:none" src="image/preloader.gif"></img>
							 <div id="ticket_table" class="table-responsive">
							 	<div id="table_ticket_wrapper" class="dataTables_wrapper form-inline" role="grid">
							 	    <div class="row">
							 	        <div class="col-xs-6">
							 	            <div id="table_ticket_length" class="dataTables_length">
							 	                <label>
                                                    <select name="table_ticket_length" size="1" aria-controls="table_ticket">
                                                        <option value="10" selected="selected">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>   
                                                    </select>
                                                    Registros por pagina
							 	                </label>
							 	            </div>
							 	        </div>
							 	        <div class="col-xs-6">
							 	            <div id="table_ticket_filter" class="dataTables_filter">
							 	                <label>
                         	                        Busqueda
							 	                    <input type="text" aria-controls="table-ticket">
							 	                </label>
							 	            </div>
							 	        </div>
							 	    </div>
							 	    <table id="table_ticket" class="table table-bordered table-striped datatable" aria-describedby="table_ticket_info">
							 	        <thead>
							 	            <tr role="row">
							 	                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_ticket" rowspan="1" colspan="1" aria-label="ID:activate to sort column ascending">ID</th>
							 	                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_ticket" rowspan="1" colspan="1" aria-label="ASUNTO:activate to sort column ascending">ASUNTO</th>
							 	                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_ticket" rowspan="1" colspan="1" aria-label="MENSAJE:activate to sort column ascending">MENSAJE</th>
							 	                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_ticket" rowspan="1" colspan="1" aria-label="ESTADO:activate to sort column ascending">ESTADO</th>
							 	                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_ticket" rowspan="1" colspan="1" aria-label="PRIORIDAD:activate to sort column ascending">PRIORIDAD</th>
							 	                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_ticket" rowspan="1" colspan="1" aria-label="DEPARTAMENTO:activate to sort column ascending">DEPARTAMENTO</th>
							 	                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_ticket" rowspan="1" colspan="1" aria-label="FECHA:activate to sort column ascending">FECHA</th>
							 	                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table_ticket" rowspan="1" colspan="1" aria-label="ACCIONES:activate to sort column ascending">ACCIONES</th>
							 	            </tr>
							 	        </thead>
							 	        
							 	        
							 	        <tbody role="alert" aria-live="polite" aria-relevant="all">
							 	       
							 	       <?php
							 	        
                                        //$row = mysql_fetch_assoc($resultado);            
                                        
                                        while ($fila = mysql_fetch_assoc($rs)) { 
                                        


                                                echo "<tr class='odd'>" ;
                                                echo "<td class=''>" . $fila['id'] . "</td>";    
                                                echo "<td class='' style='padding:2px'><img src='image/01.jpg' alt='' width='105' height='70'>  </td>";    
                                                echo "<td class=''>" . $fila['mts_terreno'] . "</td>";
                                                echo "<td class=''>" . $fila['mts_edif'] . "</td>";
                                                echo "<td class=''>" . $fila['mts_edif'] . "</td>";
                                                echo "<td class=''>" . $fila['mts_edif'] . "</td>";
                                                echo "<td class=''>" . $fila['mts_edif'] . "</td>";
                                                echo "<td class='actions'>";
                                                echo "<a href='' title='Ver'>";
                                                echo "<i class='glyphicon glyphicon-eye-open'></i> </a>";
                                                echo "<a href='' title='Modificar'  role='button'> <i class='glyphicon glyphicon-pencil'></i></a>";
                                                echo "<a href='' title='Eliminar'><i class='glyphicon glyphicon-trash' role='button'></i>";
                                                echo "</a>";
                                                echo "</td>";                                                    
                                                echo "</tr>";  
                                        }            

							 	       ?>    
							 	        
							 	        
							 	        <!--
							 	        <tbody role="alert" aria-live="polite" aria-relevant="all">
							 	            <tr class="odd">
							 	                <td class=" ">1</td>
							 	                <td class=" ">lala</td>
							 	                <td class=" ">lelele lalalalalalala </td>
							 	                <td class="status-pending">Pendiente</td>
							 	                <td class="priority-high">Alta</td>
							 	                <td class=" "></td>
							 	                <td class="sorting_1">03 Mar 15</td>
							 	                <td class="actions">
							 	                    <a href="" title="Show Ticket">
							 	                        <i class="glyphicon glyphicon-eye-open"></i>
							 	                        <i class="glyphicon glyphicon-paperclip"></i>
							 	                        <i class="glyphicon glyphicon-trash"></i>
							 	                    </a>
							 	                </td>
							 	            </tr>
							 	        -->    
							 	        </tbody>
							 	    </table>
							 	    <?php 
							 	    if($num_rows != 0) {
							 	    		$nextpage = $pagina +1;
				                $prevpage = $pagina -1;

				                $pageItemsLeft = $pagina -3;
				                $pageItemsRight = $pagina +4;
							 	    	
							 	    		?>	
									 	    <div class="row">
									 	    	<div class="col-xs-6">
									 	    		<div id="table-ticket-info" class="dataTables_info">
									 	    			<!--// Mostrando 1 de 10 de 11 paginas //-->
									 	    			Mostrando <?php  echo ( $pagina * $rows_per_page - ( $rows_per_page - 1 )) ?>  de  <?php echo ($pagina * $rows_per_page) ?> de <?php echo $num_rows ?> registros
									 	    		</div>
									 	    	</div>
									 	    	<div class="col-xs-6">
									 	    		<div class="dataTables_paginate paging_bootstrap">
									 	    			<ul class="pagination">

						                  <?php 
						                  if ($pagina == 1) {  ?>
											 	    			<li class="prev disabled">
											 	    				<a href="#"><i class="glyphicon glyphicon-chevron-left"></i>Anterior</a> 
											 	    			</li>
											 	    			<li class="active">
											 	    				<a href="admin.php?pagina=<?php echo $i; ?>">1</a>
											 	    			</li>
                            
																	<?php 
																	for($i= $pagina+1; $i<= $lastpage ; $i++) { 	
																				
																			if($i == 1 ||  ($i >= $pageItemsLeft && $i <= $pageItemsRight ) )
																				{ ?>
													 	    					<li class=""><a href="admin.php?pagina=<?php echo $i; ?>"> <?php echo $i; ?> </a></li> <?php
											 	    						} 
											 	    			} 
									 	    				
						                    	// Y si la ultima pagina es mayor que la actual, muestro el boton SIGUIENTE o lo deshabilito
						                    	if($lastpage > $pagina ){ ?> 									 	    															 	    				
											 	    				<li class="next">
											 	    					<a href="admin.php?pagina=<?php echo $nextpage; ?>">Siguiente<i class="glyphicon glyphicon-chevron-right"></i></a>
											 	    				</li>  <?php 
											 	   				}
											 	   				else{

											 	   				} 											 	   	 				
											 	  		} 
											 	  		else{ ?>
											 	    			<li class="prev">
											 	    				<a href="admin.php?pagina=<?php echo $prevpage;?>"><i class="glyphicon glyphicon-chevron-left"></i>Anterior</a> 
											 	    			</li>
																	<?php
							                    for($i= $pagina; $i<= $lastpage ; $i++) {          

							                        if(  $i >= ($pagina - 3) && $i <= ($pagina + 4)  ) {

							                            if($pagina == $i) { ?>
							                              <li class="active"><a> <?php echo $i; ?> </a></li> <?php
							                            }
							                            else{ ?>  
							                                <li><a href="admin.php?pagina=<?php echo $i; ?>" ><?php echo $i; ?> </a></li> <?php
							                            }
							                        }
							                    }
																	?>
											 	    			<li class="next">
											 	    				<a href="admin.php?pagina=<?php echo $nextpage; ?>">Siguiente<i class="glyphicon glyphicon-chevron-right"></i></a>
											 	    			</li> 											 	    			
											 	    		<?php	

											 	  		}		
										}	?> 	  
							 	    			</ul>
							 	    		</div>
							 	    	</div>
							 	    </div>
							 	</div>
							 </div>
							 <!-- Fin de las tablas -->
					</div>
				</div>
			</div>
			<input type="hidden" id="ststus" value="">

			<div id="myModal" class="modal fade" aria-hidden="true" role="dialog">
				
			</div>
			<div id="modal_remove" class="modal fade" aria-hidden="true" role="dialog">
				
			</div>
			<div class="modal fade" id="add_ticket" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button id="modal-close" class="close" aria-hidden="true" data-dismiss="modal" type="button">x</button>
							<h2 class="modal-title">Nuevo Reclamo</h2>
						</div>
						<div class="modal-body">
							<form action="ajax.php" id="form_add_ticket" class="form-horizontal" enctype="multipart/form-data" method="post" onsubmit="return check_ticket();">
								<div class="form-group">
									<label for="" class="col-sm-2"></label>
									<div class="col-sm-10">
										<select name="" id="department" class="form-control selector" data-size="5" data-live-search="true" style="display:none;"></select>
										<div class="btn-group bootstrap-select form-control selector">
											<button class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" type="button" data-id="" title=""></button>
											<div class="dropdown-menu open">
												<div class="bootstrap-select-searchbox"><input type="text" class="input-block-level form-control"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2"></label>
									<div class="col-sm-10">
										<select name="" id="department" class="form-control selector" data-size="5" data-live-search="true" style="display:none;"></select>
										<div class="btn-group bootstrap-select form-control selector">
											<button class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" type="button" data-id="" title=""></button>
											<div class="dropdown-menu open">
												<div class="bootstrap-select-searchbox"><input type="text" class="input-block-level form-control"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2"></label>
									<div class="col-sm-10">
										<select name="" id="department" class="form-control selector" data-size="5" data-live-search="true" style="display:none;"></select>
										<div class="btn-group bootstrap-select form-control selector">
											<button class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" type="button" data-id="" title=""></button>
											<div class="dropdown-menu open">
												<div class="bootstrap-select-searchbox"><input type="text" class="input-block-level form-control"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2"></label>
									<div class="col-sm-10">
										<select name="" id="department" class="form-control selector" data-size="5" data-live-search="true" style="display:none;"></select>
										<div class="btn-group bootstrap-select form-control selector">
											<button class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" type="button" data-id="" title=""></button>
											<div class="dropdown-menu open">
												<div class="bootstrap-select-searchbox"><input type="text" class="input-block-level form-control"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2"></label>
									<div class="col-sm-10">
										<select name="" id="department" class="form-control selector" data-size="5" data-live-search="true" style="display:none;"></select>
										<div class="btn-group bootstrap-select form-control selector">
											<button class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" type="button" data-id="" title=""></button>
											<div class="dropdown-menu open">
												<div class="bootstrap-select-searchbox"><input type="text" class="input-block-level form-control"></div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer"></div>
					</div>
				</div>
			</div>
		</section>   
		<footer class="admin-footer">
			<div id="triangle-up">
				<i class="glyphicon glyphicon-arrow-up"></i>
			</div>
			<div class="bottom-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p>Copyright  2015 - ADSSOFTWARE.COM.AR - CENTRO DE SOPORTE</p>
						</div>
					</div>
				</div>
			</div>			
		</footer>


		<script src="jquery1.11.0.js" type="text/javascript" ></script>
		<script src="jquery-ui-1.10.4.js" type="text/javascript" ></script>
		<script src="bootstrap.js" type="text/javascript" ></script>
		<script src="skrolls.js" type="text/javascript" ></script>
		<script src="default.js" type="text/javascript" ></script>
		<script src="icheck.js" type="text/javascript" ></script>

		<script src="admin.js" type="text/javascript" ></script>
		<script src="jquery.form.js" type="text/javascript" ></script>
		<script src="bootstrap-select.js" type="text/javascript" ></script>

</body>
</html>