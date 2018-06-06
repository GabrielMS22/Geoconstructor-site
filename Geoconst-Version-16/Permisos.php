<?php 
  session_start();
  $acceso = $_SESSION['acceso'];
  $pressed=$_SESSION['pressed']; 
  
  $varr;
  //if($acceso==1) significa que me loguié antes
  if($acceso==1){
  	$eliminar = @$_POST['Eliminar'];
						if(isset($eliminar)){
							if(isset($_POST['Usuarioc']) || isset($_POST['Administradorc']) || isset($_POST['Todosc'])){
								
								$borrar= $_SESSION['dato'];
								$conel = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
								$borrar = mysqli_query($conel,"DELETE FROM Usuario WHERE Nombre='".$borrar."' ");
								print '<script language="JavaScript">';
                                print 'alert("Usuario Eliminado correctamente!");';
                                print '</script>';
								mysqli_close($conel);

							}
						}
  
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>UABC</title>
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
				<!-- Note: The "styleN" class below should match that of the banner element. -->
					<header id="header" class="alt style2">
						<a href="Permisos.php" class="logo"><strong>SIPES</strong> <span>Sistema de permisos de salida UABC</span></a>
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
				<!-- Note: The "styleN" class below should match that of the header element. -->
					<section id="banner" class="style2">
						<div class="inner">
							<span class="image">
								<img src="images/im100.jpg" alt="" />
							</span>
							<header class="major">
								<h1>BIENVENIDO</h1>
							</header>
							<div class="content">
								<p></p>
							</div>
						</div>
					</section>

				<!-- Main -->
					<div id="main">

						<!-- One -->
					<?php
					//Parametros para guardar en BD
					   $numero=@$_POST['numero'];
					   $nombre=@$_POST['nombre'];
					   $apellido = @$_POST['apellido'];
					   $Rol=@$_POST['Rol'];
					   $correo=@$_POST['correo'];
					   $passwrd=@$_POST['passwrd'];
					   $Sub=@$_POST['Sub'];
					   $Carrera=@$_POST['Carrera'];

					   if(isset($Sub)){
					   	if(trim($numero)=="" || trim($nombre)==""  || trim($Rol)=="" || trim($passwrd)=="" || trim($correo)=="" || trim($Carrera)==""){
					   		print '<script language="JavaScript">';
                            print 'alert("No puedes dejar campos vacios!");';
                            print '</script>';

					   	}
					   	else{
					   		//Agregamos usuarios
					   		$conexion = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
					   		$validacion = mysqli_query($conexion,"SELECT Nombre, Correo FROM Usuario WHERE Nombre='$nombre' OR Correo='$correo'");
					   		$darows = mysqli_num_rows($validacion);
                            //Si ya existe el nombre u correo en otro registro
                            if($darows>0){
                            	mysqli_close($conexion);
                            	print '<script language="JavaScript">';
                            print 'alert("El nombre u correo escritos ya pertenecen a un usuario de la base de datos.");';
                            print '</script>';

                            }
                            else{
                            //Insercion en BD
                            $Rel = $_POST['Rol'];
                            //Sal para la contraseña
                            $nombre.=" ".$apellido;
                            $newPass = password_hash($passwrd, PASSWORD_DEFAULT);
                             
                           $query = mysqli_query($conexion,"INSERT INTO Usuario (idCarrera, Nombre, Contrasena, Correo, NumeroEmpleado, RolUsuario, Status) VALUES ($Carrera,'$nombre', '$newPass', '$correo', '$numero', '$Rel', 1 )");
                            
					   		
					   		mysqli_close($conexion);
					   		print '<script language="JavaScript">';
                            print 'alert("Usuario agregado!");';
                            print '</script>';
                        }
					   	}
					   }
				    ?>

						<!-- Two -->
							<section id="two" class="spotlights">
								<section>
									
								</section>
								<section>
									<a href="generic.html" class="image">
										<img src="images/img8.jpg" alt="" data-position="top center" />
									</a>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>AGREGAR USUARIO</h3>
											</header>
                                                <section>
							     	<form method="post" action="Permisos.php">
									<div class="field half first">
										<label for="name">No. empleado</label>
										<input type="text" name="numero" id="name" />
									</div>
									<div class="field half">
										<label for="email">Nombre</label>
										<input type="text" name="nombre" id="email" />
									</div>
									<div class="field">
										<label for="email">Apellidos</label>
										<input type="text" name="apellido" id="Passwrd" />
										Roles: <br/>
										<input type="radio" name="Rol" value="1"> Usuario
										<input type="radio" name="Rol" value="3"> Administrador
										<input type="radio" name="Rol" value="2"> Supervisor
										<label for="email">Correo</label>
										<input type="text" name="correo" id="passwrd" />
										<label for="email">Contraseña</label>
										<input type="text" name="passwrd" id="passwrd" />
										<label for="email">Carrera</label> 
										<input type="radio" name="Carrera" value="2"> Civil &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" name="Carrera" value="3"> Electrónica <br/>
										<input type="radio" name="Carrera" value="1"> Computación &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" name="Carrera" value="4"> Industrial <br/>
										<input type="radio" name="Carrera" value="5"> Arquitectura &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" name="Carrera" value="6"> Bioingeniería <br/>
										<input type="radio" name="Carrera" value="7"> Nanotecnología <br/>
										
										
										
									</div>

									
									
								
									
									<ul class="actions">
										<li><input type="submit" name="Sub" value="Agregar" class="button" /></li>
										
									</ul>
								</form>
							</section>
											
											
										</div>
									</div>
								</section>
								<section>
									<a href="generic.html" class="image">
										<img src="images/img4.jpg" alt="" data-position="25% 25%" />
									</a>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>ELIMINAR USUARIO</h3>
											</header>
											<form method="post" action="Permisos.php">
											<ul class="actions">
												<div class="centrado">
													<div class="field">
										
										<input type="text" name="NoNa" id="NoNa" placeholder="Nombre o Correo Electronico" /> 
										<div class="botoncito">
										<input type="submit" name="Buscar" value="Buscar" class="botoncito">
										<br/><br/>
										
									</div>
						<?php
						//Busqueda en la BD
						 $nona = @$_POST['NoNa'];
						 if(isset($_POST['Buscar'])){
						 if(trim($nona)==""){
						 	print '<script language="JavaScript">';
                            print 'alert("No dejes campos vacios!");';
                            print '</script>';
						
						}
						else{
					     $conex = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
						 $busqueda = mysqli_query($conex,"SELECT * FROM Usuario WHERE Nombre= '".$nona."' OR Correo= '".$nona."' ");
						 $resultado = mysqli_fetch_array($busqueda);
						 
						 if(mysqli_num_rows($busqueda)==0){
						 	print '<script language="JavaScript">';
                            print 'alert("No se encuentra el Usuario escrito en la base de datos");';
                            print '</script>';
						 
						}
						else{
							//Tabla para eliminar
							echo "<table border='1'>
							<tr>
							<th>No. Empleado</th>
							<th>Nombre</th>
						
							<th>Usuario</th>
							<th>Administrador</th>
							<th>Supervisor</th>
							<th>Todos</th>
							</tr>";
							echo"<tr>";
							echo"<td>" . $resultado['NumeroEmpleado'] . "</td>";
							echo"<td>" . $resultado['Nombre'] . "</td>";
					
							echo "<td>" . "<input type='checkbox' name='Usuarioc'>";
							echo "<td>" . "<input type='checkbox' name='Administradorc'>";
							echo "<td>" . "<input type='checkbox' name='Administradorc'>";
							echo "<td>" . "<input type='checkbox' name='Todosc'>";
							echo"</tr>";
                            
                       
							echo "</table>";
							$_SESSION['dato']=$resultado['Nombre'];
							$_SESSION['pressed']=1;
							$_SESSION['NoEmpleado']=$resultado['NumeroEmpleado'];
							$_SESSION['Email']=$resultado['Correo'];
							$_SESSION['UserPassword']=$resultado['Contrasena'];
							$_SESSION['Status']=$resultado['Status'];
							$_SESSION['Rol']=$resultado['RolUsuario'];
							$_SESSION['Carrera']=$resultado['idCarrera'];
							


							

							
						}
						
						}
						}
						?>

									</div><br/><br/><br/><br/>
												<div class="botoncito">
										<input type="submit" name="Eliminar" value="Eliminar" class="botoncito">
									</div>
											</div>
											</ul>
										</form>
										</div>
									</div>
								</section>
								<section id="two" class="spotlights">
								<section>
									
								</section>

								<?php
								 if(isset($_POST['modif']) && $_SESSION['pressed']==1){
								 	//Variables de sesion para update en caso de que no se modifiquen
								 	//Variables de sesion donde guardamos los datos de la busqueda
								 	$nombreUP = $_SESSION['dato'];
						          	$numeroemUP = $_SESSION['NoEmpleado'];
							        $correoUP= $_SESSION['Email'];
							        $contrasenaUP = $_SESSION['UserPassword'];
							        $statusUP = $_SESSION['Status'];
						         	$rolUP = $_SESSION['Rol'];
						         	$carreraUP = $_SESSION['Carrera'];

						         	//Variables auxiliares
						         	$numeroM = $_POST['numeroM'];
						         	$nombreM = $_POST['nombreM'];
						         	$RolM = $_POST['RolM'];
						         	$passwrdM = $_POST['passwrdM'];
						         	$carreraM = $_POST['CarreraM'];
						         	//Si los campos llevan datos, actualizamos variables para hacer los updates
						         	if(trim($numeroM)!=""){
						         		$numeroemUP = $numeroM;
						         	}
						         	if(trim($nombreM)!=""){
						         		$nombreUP = $nombreM;
						         	}
						         	if(trim($RolM)!="" ){
						         		$rolUP = $rolM;
						         	}
						         	if(trim($passwrdM)!=""){
						         		//agregamos la sal
						         		$auxSAL = password_hash($passwrdM, PASSWORD_DEFAULT);
						         		$contrasenaUP = $auxSAL;
						    
						         	}
						         	if(trim($carreraM)!=""){
						         		$carreraUP = $carreraM;
						         	}

								 	
                                    //Modificando en bd
                                      $conexionmodif = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
			                           mysqli_query($conexionmodif,"UPDATE Usuario SET Nombre = '$nombreUP', NumeroEmpleado = '$numeroemUP', Contrasena = '$contrasenaUP', idCarrera = '$carreraUP' WHERE Correo='".$correoUP."' ");
			                            mysqli_close($conexionmodif);
			                            
			                            $Menschange = "Sus datos han sido actualizados! \n ";

			                           // mail($elmail, "Cambio de datos", $Menschange);
                                      
                                	

								 }

								?>
								<section>
									<a href="generic.html" class="image">
										<img src="images/im100.jpg" alt="" data-position="top center" />
									</a>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>MODIFICAR USUARIO</h3>
											</header>
                                                <section>
							     	<form method="post" action="Permisos.php">
									<div class="field half first">
										<label for="name">No. empleado</label>
										<input type="text" name="numeroM" id="name" />
									</div>
									<div class="field half">
										<label for="email">Nombre</label>
										<input type="text" name="nombreM" id="email" />
									</div>
									<div class="field">
										
										Roles: <br/>
										<input type="radio" name="RolM" value="1"> Usuario
										<input type="radio" name="RolM" value="3"> Administrador
										<input type="radio" name="RolM" value="2"> Supervisor
										<label for="email">Correo</label>
										<input type="text" name="correoM" id="passwrd" disabled="true" />
										<label for="email">Contraseña</label>
										<input type="text" name="passwrdM" id="passwrd" />
										<label for="email">Carrera</label> 
										<input type="radio" name="CarreraM" value="2"> Civil &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" name="CarreraM" value="3"> Electrónica <br/>
										<input type="radio" name="CarreraM" value="1"> Computación &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" name="CarreraM" value="4"> Industrial <br/>
										<input type="radio" name="CarreraM" value="5"> Arquitectura &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" name="CarreraM" value="6"> Bioingeniería <br/>
										<input type="radio" name="CarreraM" value="7"> Nanotecnología <br/>
										
									</div>
									
									
								
									
									<ul class="actions">
										<li><input type="submit" name="modif" value="Modificar" class="button" /></li>
										
									</ul>
								</form>
                                

							</section>
											
											
										</div>
									</div>
								</section>
                                
                               


							</section>
 
					

					</div>
                   

               
				<!-- Contact -->
			   <div class="inner">
							<div class="centrado">
						<h3>Solicitudes en Proceso</h3>
					</div>
					<?php
												//Conexiones, instrucciones de tomar solicitudes si estas existen, etc.
												$revisar = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
												$existe = mysqli_query($revisar,"SELECT * FROM Solicitud ");
												$columnas = mysqli_num_rows($existe);
												 echo"<table border='1'>
                                                <tr> 
                                                <th>Folio</th>
                                                <th>Fecha</th> 
                                                <th>Evento</th> 
                                                <th>Solicitante</th>
                                                </tr>";
												for($i=0;$columnas>$i;$i++){
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
                                                echo "<tr>";
                                                echo "<td>" .  $folionumber    ."</td>";
                                                echo "<td>" .    $fechafinal  ."</td>";
                                                echo "<td>" .    $Evento  ."</td>";
                                                echo "<td>" .    $extract['idUsuario']  ."</td>";
                                                echo "</tr>";
                                                
                                            
                                                }
                                                echo"</table>";
                                              

											?>
						</div>
					</footer>

			</div>

				<!-- Footer -->

					<footer id="footer">
						<div class="inner">
							<div class="centrado">
						<h3>REGISTROS USUARIOS</h3>
						
					</div>
						</div>
					</footer>

			</div>
			<?php
			//Tabla para mostrar usuarios de sistema ACTUALIZADA
			$conexionshow = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
			$datos = mysqli_query($conexionshow,"SELECT * FROM Usuario");
			$aux = mysqli_num_rows($datos);
			echo "<table border='1'>
							<tr>
							<th>No. Empleado</th>
							<th>Nombre</th>
					
							<th>Usuario</th>
							<th>Administrador</th>
							<th>Supervisor</th>
							<th>ALTA</th>
							</tr>";
			//Ciclo para mostrar los registros del sistema
			for($i=0; $i<$aux; $i++){
				            $resultadot = mysqli_fetch_array($datos);

						
							echo"<tr>";
							echo"<td>" . $resultadot['NumeroEmpleado'] . "</td>";
							echo"<td>" . $resultadot['Nombre'] . "</td>";
							//Si se es un admin
                            if($resultadot['RolUsuario']==3){
							echo "<td>" . "<input type='checkbox' name='Usuarioc' >";
                            echo "<td>" . "<input type='checkbox' name='Administradorc' checked>";
                            echo "<td>" . "<input type='checkbox' name='Administradorc' >";
							}
							//Si se es un supervisor
                            if($resultadot['RolUsuario']==2){
							echo "<td>" . "<input type='checkbox' name='Usuarioc' checked>";
                            echo "<td>" . "<input type='checkbox' name='Administradorc' >";
                            echo "<td>" . "<input type='checkbox' name='Administradorc' checked>";
							}
							//Si se es un Maestro
                            if($resultadot['RolUsuario']==1){
							echo "<td>" . "<input type='checkbox' name='Usuarioc' checked>";
                            echo "<td>" . "<input type='checkbox' name='Administradorc' >";
                            echo "<td>" . "<input type='checkbox' name='Administradorc' >";
							}
							if($resultadot['Status']==1){
							echo "<td>" . "<input type='checkbox' name='Todosc' checked>";
						    }
						    if($resultadot['Status']==0){
						    	echo "<td>" . "<input type='checkbox' name='Todosc' >";
						    }
							echo"</tr>";
						
					
                            
                       
							
						}
							echo "</table>";



		}
		if($acceso!=1){
			//header('Location: index.php');
		}
		
		?>
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