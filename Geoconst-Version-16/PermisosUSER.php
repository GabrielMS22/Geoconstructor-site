<?php
  session_start();
  $acceso = $_SESSION['acceso'];
  //Variables que guardaron datos de la sesion para mostrar al entrar
  $numeroS =$_SESSION['NoEmpleadoid'];
  $nombreS= $_SESSION['Nameid'];
  $apellidoS= $_SESSION['Apellidoid'];
  $id=$_SESSION['ID'];
 //Funciñon de obtener fecha actual
  function Obtenerdate()
 {
                         date_default_timezone_set('America/Los_Angeles');
                         $dates = date('y/m/d ', time());
                         return $dates;
}
 function ordenaFecha($fecha){
                          //Areglamos string de Fecha para poder usarlo
                        $sub = substr($fecha, 0,4);
                        $sub2= substr($fecha, 5,2);
                        $sub3= substr($fecha, -2);
                        //Agregamos a un nuevo string bien acomodad
                        $fechafinal = $sub3.'/'.$sub2.'/'.$sub;
                        return ($fechafinal);
}
			

  //if($acceso==2)

  if($acceso==2 || $acceso==1){
  	//Condicion de borrar
  	 
  	if(isset($_POST['Borrar'])){
  	$revisarr = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
	$existee = mysqli_query($revisarr,"SELECT * FROM Solicitud WHERE Numero='".$id."'");
	$rows = mysqli_num_rows($existee);
	if($rows==1){
	$extractt = mysqli_fetch_array($existee);

	$eliminar = $extract['Nombre'];	
     mysqli_query($revisarr,"DELETE FROM Solicitud WHERE Nombre='$eliminar' ");
     print '<script language="JavaScript">';
     print 'alert("Solicitud eliminada");';
      print '</script>';
													
   }
   else{
   	 print '<script language="JavaScript">';
     print 'alert("No hay solicitudes que puedas cancelar!");';
      print '</script>';
   }
}
//Ver Solicitud
  if(isset($_POST['Ver']) && $_POST['folo']){
  	$_SESSION['folioc'] = $_POST['folo'];
  	$_SESSION['tiene'] = 1;
  	Header('Location: VerPermiso.php');
  }
  //Ver Solicitud siendo Supervisor
    if(isset($_POST['VinfoSS']) && $_POST['foloSS']){
  	$_SESSION['folioc'] = $_POST['foloSS'];
  	$_SESSION['tiene'] = 1;
  	Header('Location: VerPermiso.php');
  }
     //Metodo de Cancelacion Por usuario
    if(isset($_POST['CancelarP']) && $_POST['folo']){
  	 //Sentencia para obtener datos
  	 $folioBR = $_POST['folo'];
  	 //Sentencias SQL
  	 $revisarD = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
  	  mysqli_query($revisarD,"DELETE FROM Solicitud WHERE idSolicitud = '$folioBR' ");
  	  mysqli_query($revisarD,"DELETE FROM Revision WHERE idSolicitud = '$folioBR' ");
  	  mysqli_close($revisarD);
  	}
  	//Método de rechazo por supervisor
  	if(isset($_POST['RechazarSS']) && $_POST['foloSS']){
  		$_SESSION['folioc'] = $_POST['foloSS'];
  		$valuerej = 1;
         //Enviamos datos en el header
  		Header("Location: CancelarPermiso.php?rec=$valuerej");
  	}
  	//Método para ver info de rechazado
  	if(isset($_POST['foloVF']) && $_POST['VinfoCC']){
  		$_SESSION['folioc'] = $_POST['foloVF'];
  		$valuerej = 1;
         //Enviamos datos en el header
  		Header("Location: VerPermisoC.php?rec=$valuerej");
  	}
 
   //Metodo para aprobar como supervisor
  	if(isset($_POST['AprobarSS']) && $_POST['foloSS']){
  		$aprobar = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
  		$idaprob = $_SESSION['myid'];
  		$folioAPR = $_POST['foloSS'];
  		mysqli_query($aprobar,"UPDATE Revision set EstadoRevision=2 WHERE idSuperv='$idaprob' AND idSolicitud = '$folioAPR' ");
  		//método para saber si todos los supervisores aceptaron
  		$counteraprobed = mysqli_query($aprobar, "SELECT * FROM Revision WHERE idSolicitud='$folioAPR' AND EstadoRevision=1");
  		$rowAPR = mysqli_num_rows($counteraprobed);
  		if($rowAPR==0){
  			mysqli_query($aprobar,"UPDATE Solicitud SET Estado = 2 WHERE idSolicitud='$folioAPR' ");
  		}
  	}

  	//Metoo para ver el oficio comision
  	if(isset($_POST['foloFINAL']) && isset($_POST['VerComis'])){
  		$valuecomis= $_POST['foloFINAL'];
  		Header("Location: FolioComision.php?f=$valuecomis");
  	}
  	//Metodo para enviar reporte
  	if(isset($_POST['foloFINAL']) && isset($_POST['ReporteSal'])){
  		$valuecomis= $_POST['foloFINAL'];
  		Header("Location: Reporte.php");
  	}


?>

<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>SIPES Sistema de permisos UABC</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<a href="PermisosUSER.php" class="logo"><strong>SIPES</strong> <span>Sistema de permisos de salida UABC</span></a>
						<nav>
							<a href="index.php">Salir</a>
						</nav>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<ul class="links">
						
						</ul>
						<ul class="actions vertical">
						
						</ul>
					</nav>


				<!-- Banner -->
					<section id="banner" class="major">
						<div class="inner">
							<span class="image">
								<img src="images/img5.jpg" alt="" />
							</span>
							<header class="major">
								<h1>BIENVENIDO</h1>
							</header>
							<div class="content">
								
								<ul class="actions">
									<?php
                                  //<p>TABLA CON NOMBRE</p>

								   echo "<table border='1'>
								   <tr>
								   <th>No. Empleado </th>
								   <th>Nombre </th>
								 
								   </tr>";
								   	echo"<tr>";
							        echo"<td>" . $numeroS. "</td>";
							        echo"<td>" . $nombreS. "</td>";
							     
							     	echo"</tr>";
 

								   echo "</table>";
								   //Para para supervisor
								   //$superQ = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
								   //$sup = mysqli_query($superQ,"SELECT * FROM Usuarios WHERE Name='".$nombreS."'");
					
								   //$extractsup = mysqli_fetch_array($sup);
								  

								?>

								</ul>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<div class="derecha">
									<a href="CPermiso.php" class="button next scrolly">Nuevo Permiso</a>
								</div>
							</div>

						</div>
					</section>

					<?php
					$revisar = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
					$existe = mysqli_query($revisar,"SELECT * FROM Usuario WHERE NumeroEmpleado='$numeroS'");
					$columnas = mysqli_num_rows($existe);
					$extract = mysqli_fetch_array($existe);
			        $idpce = $extract['idUsuario'];
			        $_SESSION['myid'] = $idpce;
					if($extract['RolUsuario']==2){

					//Si el usuario es Supervisor

					
					?>

					<section id="two" class="spotlights">
								<section>
									<a href="generic.html" class="image">
										<img src="images/img2.jpg" alt="" data-position="center center" />
									</a>
									<div class="content">
										<div class="inner">
											<header class="major">
												<form action="PermisosUSER.php" method="post">

												<h3>SOLICITUDES EN PROCESO</h3>
											</header>

											   <?php
												//Sentencias para extraer las solicitudes conforme a las carreras
												$fechaAct= Obtenerdate();
                                                $Quecarreras = $extract['idCarrera'];
                                                $idpce = $extract['idUsuario'];
                                                $dataSolicitudes = mysqli_query($revisar,"SELECT * FROM Solicitud WHERE idCarrera = '$Quecarreras' AND Estado = 1 OR Estado=2 OR Estado=3 OR Estado=4");
                                                $colS = mysqli_num_rows($dataSolicitudes);
												
											
												echo"<table border='1'>
                                                <tr> 
                                                <th>Folio</th>
                                                <th>Fecha</th> 
                                                <th>Evento</th> 
                                                </tr>";
												//Solicitudes que tiene el usuario
												

                                              for($i=0;$i<$colS; $i++){
                                              	$extractSS = mysqli_fetch_array($dataSolicitudes);
                                              	$idsole = $extractSS['idSolicitud'];
                                              	$queryrREV = mysqli_query($revisar,"SELECT * FROM Revision WHERE idSolicitud='$idsole' AND EstadoRevision=1 AND idSuperv='$idpce' ");
                                                
                                                $limit = mysqli_num_rows($queryrREV);
                                                //Si encuentra algo en la consulta de estad orevision
												if($limit>0){
												//Datos para mostrar
												$folionumber = $extractSS['idSolicitud'];
												$fecha = $extractSS['FechaCreacion'];
												$Evento = $extractSS['Nombre'];
												//Areglamos string de Fecha para poder usarlo
												$sub = substr($fecha, 0,4);
												$sub2= substr($fecha, 5,2);
												$sub3= substr($fecha, -2);
												//Agregamos a un nuevo string bien acomodad
												$fechafinal = $sub3.'/'.$sub2.'/'.$sub;
                                              


										      
											    $_SESSION['Folios']=$folionumber;
                                                echo "<tr>";
                                                echo "<td>" .  $folionumber    ."</td>";
                                                echo "<td>" .    $fechafinal  ."</td>";
                                                echo "<td>" .    $Evento  ."</td>";
                                                echo "<td>" . "<input type='radio' name='foloSS' value = '$folionumber' >";
                                                echo "</tr>";
                                            }

                                                
                                            }
                                            
                                              echo"</table>";
	
                                              mysqli_close($revisar);
                                              ?>

																						<ul class="actions">
												<li><input type="submit" name="AprobarSS" value="Aprobar" class="button" /></li>
												<li><input type="submit" name="RechazarSS" value="Rechazar" class="button" /></li>
												<li><input type="submit" name="VinfoSS" value="Ver información" class="button" /></li>
											</ul>
										</form>
                                                
										</div>
									</div>
								</section>
							</section>

								<?php
							}
							//Espacios entre la vista
								?>

								<br/><br/><br/><br/>
					              
				<!-- Main -->
					<div id="main">
                    	<section id="two" class="spotlights">
								<section>
									<a href="generic.html" class="image">
										<img src="images/img8.jpg" alt="" data-position="center center" />
									</a>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>SOLICITUDES PENDIENTES</h3>
											</header>

											    <form action="PermisosUSER.php" method="post">
												<?php

												//Conexiones, instrucciones de tomar solicitudes si estas existen, etc.
												$revisar = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
												$idUSER = mysqli_query($revisar,"SELECT idUsuario from Usuario WHERE Nombre = '$nombreS'");
												$theid = mysqli_fetch_array($idUSER);
												$existe = mysqli_query($revisar,"SELECT * FROM Solicitud WHERE idUsuario='".$theid['idUsuario']."' AND Estado=1");
												$columnas = mysqli_num_rows($existe);
												echo"<table border='1'>
                                                <tr> 
                                                <th>Folio</th>
                                                <th>Fecha</th> 
                                                <th>Evento</th> 
                                                </tr>";
												//Solicitudes que tiene el usuario
                                              for($i=0;$i<$columnas; $i++){
                                                $extract = mysqli_fetch_array($existe);

												
												//Datos para mostrar
												$folionumber = $extract['idSolicitud'];
												$fecha = $extract['FechaCreacion'];
												$Evento = $extract['Nombre'];
												//Areglamos string de Fecha para poder usarlo
												$sub = substr($fecha, 0,4);
												$sub2= substr($fecha, 5,2);
												$sub3= substr($fecha, -2);
												//Agregamos a un nuevo string bien acomodad
												$fechafinal = $sub3.'/'.$sub2.'/'.$sub;
                                                if($columnas==1){
                                                	$_SESSION['gotone']=1;
                                                }



										      
											    $_SESSION['Folios']=$folionumber;
                                                echo "<tr>";
                                                echo "<td>" .  $folionumber    ."</td>";
                                                echo "<td>" .    $fechafinal  ."</td>";
                                                echo "<td>" .    $Evento  ."</td>";
                                                echo "<td>" . "<input type='radio' name='folo' value = '$folionumber' >";
                                                echo "</tr>";

                                                
                                            }
                                            
                                              echo"</table>";

                                              
  	                                       mysqli_close($revisar);
                                              


											?>
											
											<ul class="actions">
												<li><input type="submit" name="Ver" value="Ver informacion de solicitud" class="button" /></li>
												<li><input type="submit" name="CancelarP" value="Cancelar Solicitud" class="button" /></li>
											</ul>
										</form>
                                                
										</div>
									</div>
								</section>
								<section>
									<a href="generic.html" class="image">
										<img src="images/img7.jpg" alt="" data-position="top center" />
									</a>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>SOLICITUDES APROBADAS</h3>
											</header>
											 <form action="PermisosUSER.php" method="post">
                                           <?php

												//Conexiones, instrucciones de tomar solicitudes si estas existen, etc.
												$revisar = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
												$idUSER = mysqli_query($revisar,"SELECT idUsuario from Usuario WHERE Nombre = '$nombreS'");
												$theid = mysqli_fetch_array($idUSER);
												$existe = mysqli_query($revisar,"SELECT * FROM Solicitud WHERE idUsuario='".$theid['idUsuario']."' AND Estado=2");
												$columnas = mysqli_num_rows($existe);
												echo"<table border='1'>
                                                <tr> 
                                                <th>Folio</th>
                                                <th>Fecha</th> 
                                                <th>Evento</th> 
                                                </tr>";
												//Solicitudes que tiene el usuario
                                              for($i=0;$i<$columnas; $i++){
                                                $extract = mysqli_fetch_array($existe);

												
												//Datos para mostrar
												$folionumber = $extract['idSolicitud'];
												$fecha = $extract['FechaCreacion'];
												$Evento = $extract['Nombre'];
												//Areglamos string de Fecha para poder usarlo
												$sub = substr($fecha, 0,4);
												$sub2= substr($fecha, 5,2);
												$sub3= substr($fecha, -2);
												//Agregamos a un nuevo string bien acomodad
												$fechafinal = $sub3.'/'.$sub2.'/'.$sub;
                                                if($columnas==1){
                                                	$_SESSION['gotone']=1;
                                                }



										      
											    $_SESSION['Folios']=$folionumber;
                                                echo "<tr>";
                                                echo "<td>" .  $folionumber    ."</td>";
                                                echo "<td>" .    $fechafinal  ."</td>";
                                                echo "<td>" .    $Evento  ."</td>";
                                                echo "<td>" . "<input type='radio' name='foloFINAL' value = '$folionumber' >";
                                                echo "</tr>";

                                                
                                            }
                                            
                                              echo"</table>";

                                              
  	                                       mysqli_close($revisar);
  	                                       ?>
  	                                      
											<ul class="actions">
												<li><input type="submit" name="VerComis" value="Ver Oficio Comision" class="button" /></li>
												<li><input type="submit" name="ReporteSal" value="Enviar Reporte" class="button" /></li>
											</ul>
										</form>
										</div>
									</div>
								</section>
								<section>
									<a href="generic.html" class="image">
										<img src="images/img6.jpg" alt="" data-position="25% 25%" />
									</a>
									<div class="content">
										<div class="inner">
											<header class="major">
												<form action="PermisosUSER.php" method="post">
												<h3>SOLICITUDES RECHAZADAS</h3>
												<?php

												//Conexiones, instrucciones de tomar solicitudes si estas existen, etc.
												$revisar = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
												$idUSER = mysqli_query($revisar,"SELECT idUsuario from Usuario WHERE Nombre = '$nombreS'");
												$theid = mysqli_fetch_array($idUSER);
												$existe = mysqli_query($revisar,"SELECT * FROM Solicitud WHERE idUsuario='".$theid['idUsuario']."' AND Estado=0");
												$columnas = mysqli_num_rows($existe);
												echo"<table border='1'>
                                                <tr> 
                                                <th>Folio</th>
                                                <th>Fecha</th> 
                                                <th>Evento</th> 
                                                </tr>";
												//Solicitudes que tiene el usuario
                                              for($i=0;$i<$columnas; $i++){
                                                $extract = mysqli_fetch_array($existe);

												
												//Datos para mostrar
												$folionumber = $extract['idSolicitud'];
												$fecha = $extract['FechaCreacion'];
												$Evento = $extract['Nombre'];
												//Areglamos string de Fecha para poder usarlo
												$sub = substr($fecha, 0,4);
												$sub2= substr($fecha, 5,2);
												$sub3= substr($fecha, -2);
												//Agregamos a un nuevo string bien acomodad
												$fechafinal = $sub3.'/'.$sub2.'/'.$sub;
                                                if($columnas==1){
                                                	$_SESSION['gotone']=1;
                                                }



										      
											    $_SESSION['Folios']=$folionumber;
                                                echo "<tr>";
                                                echo "<td>" .  $folionumber    ."</td>";
                                                echo "<td>" .    $fechafinal  ."</td>";
                                                echo "<td>" .    $Evento  ."</td>";
                                                echo "<td>" . "<input type='radio' name='foloVF' value = '$folionumber' >";
                                                echo "</tr>";

                                                
                                            }
                                            
                                              echo"</table>";

                                              
  	                                       mysqli_close($revisar);
  	                                       ?>
											</header>
											<p></p>
											<ul class="actions">
												<div class="centrado">
												<li><input type="submit" name="VinfoCC" value="Ver Informacion" class="button" /></li>
											</div>
											</ul>
										</form>
										</div>
									</div>
								</section>
							</section>
						

				<!-- Contact -->
					

				<!-- Footer -->
					<footer id="footer">
						<div class="inner">
							
							<ul class="copyright">
								<div class="centrado">
								<li>&copy; @SIPES</li><li> Universidad Autónoma de Baja California. Todos los derechos reservados</li>
							</div>
							</ul>
						</div>
					</footer>

			</div>
			<?php

		}
		
		
		
			
		

			?>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>