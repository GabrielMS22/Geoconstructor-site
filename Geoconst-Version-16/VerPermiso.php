<?php 
  session_start();
  $acceso = $_SESSION['acceso'];
  $pressed=$_SESSION['pressed']; 
  $numeroS =$_SESSION['NoEmpleadoid'];
  $nombreS= $_SESSION['Nameid'];
  $apellidoS= $_SESSION['Apellidoid'];
  $id=$_SESSION['ID'];
  $FOLO = $_SESSION['folioc'];
  //Varaible para obtener parametros mandado por el header PERMISOSUSER
  $rechaz = $_GET['rec'];
  

  $varr;
  //if($acceso==1) significa que me loguié antes
 
  if($_SESSION['tiene']==1){
 

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
						<a href="PermisosUSER.php" class="logo"><strong>SIPES</strong> <span>Sistema de permisos de salida UABC</span></a>
						<nav>
							<a href="index.php">Salir</a>
						</nav>
					</header>

				<!-- Menu -->
			

				<!-- Banner -->
				<!-- Note: The "styleN" class below should match that of the header element. -->
					<section id="banner" class="style2">
						<div class="inner">
							<span class="image">
								<img src="images/pic07.jpg" alt="" />
							</span>
							<header class="major">
								<h1>SOLICITUD</h1>
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

			             		//Secuencia de agregar a BD cuando tenga el diseÑo
			             		$revisar = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
                      $data = mysqli_query($revisar,"SELECT * FROM Solicitud WHERE idSolicitud='".$FOLO."' ");
                    
                      $col = mysqli_num_rows($data);
                      $datafields = mysqli_fetch_array($data);
                        $datosreals = mysqli_query($revisar, "SELECT * FROM Usuario WHERE idUsuario = '".$datafields['idUsuario']."' ");
                      $datoralas = mysqli_fetch_array($datosreals);
                      mysqli_close($revisar);
                       function ordenaFecha($fecha){
                          //Areglamos string de Fecha para poder usarlo
                        $sub = substr($fecha, 0,4);
                        $sub2= substr($fecha, 5,2);
                        $sub3= substr($fecha, -2);
                        //Agregamos a un nuevo string bien acomodad
                        $fechafinal = $sub3.'/'.$sub2.'/'.$sub;
                        return ($fechafinal);
                        }
                        $fechasalida=ordenaFecha($datafields['FechaSalida']);
                        $fechallegada=ordenaFecha($datafields['FechaLlegada']);
                        //Validación de numeros guardados en DB
                       
                          $act= $datafields['Actividad'];
                       
                        
                        
                          if($datafields['idCarrera']==1){
                            $carrera = 'Computación';
                          }
                            if($datafields['idCarrera']==2){
                              $carrera = 'Civil';
                            }
                              if($datafields['idCarrera']==3){
                                $carrera = 'Electrónica';
                              }
                                if($datafields['idCarrera']==4){
                                  $carrera = 'Industrial';
                              }
                              if($datafields['idCarrera']==5){
                                $carrera = 'Arquitectura';

                              }
                              if($datafields['idCarrera']==6){
                          $carrera = 'Bioingeniería';
                        }
                              if($datafields['idCarrera']==7){
                                $carrera = 'Nanotecnología';

                              }
                            
                          
                        

                      if($col>0){

                  ?>
                                			<section>
									        
							             	</section>

						<!-- Two -->
							<section id="two" class="spotlights">
								<section>
									
								</section>
								<section>
									<a class="image">
										
									</a>
									<div class="content">
										<div class="inner">
											<header class="major">
												<h3>DATOS DE SOLICITUD</h3>
											</header>
                                                <section>
							     	<form method="post" action="PermisosUSER.php">
							     		<div class="field">
										<label for="email">Nombre</label>
										<input type="text" name="apellido" id="Passwrd" value="<?php echo $datoralas['Nombre']?>" disabled="true"/>
									</div>
									<div class="field half first">
										<label for="name">No empleado</label>
										<input type="text" name="numero" id="name" value="<?php echo $datoralas['Nombre']?>" disabled="true"/>
										<label for="email">Fecha de la Salida</label>
                    <input type="text" name="salida" id="name" value="<?php echo $fechasalida ?>" disabled="true"/>
								
                                        
                                    
										<label for="email">Hora de la Salida</label>
									    <input type="text" name="HSalida" id="email"  class="textob" value="<?php echo $datafields['HoraSalida']?>"  disabled="true"/>
										<label for="email">Hora de la llegada</label>
										<input type="text" name="HLlegada" id="email"  class="textob" value="<?php echo $datafields['HoraLlegada']?>"disabled="true"/>
                    <label for="email">Actividad asociada a:</label> 
                  <input type="text" name="Actividad" id="email" value="<?php echo $act ?>"disabled="true"/>
										

									</div>
									<div class="field half">
										<label for="email">Nombre del Evento</label>
										<input type="text" name="NEvento" id="email" value="<?php echo $datafields['Nombre']?>"disabled="true" />
										<label for="email">Fecha de la llegada</label>
									  <input type="text" name="llegada" id="name" value="<?php echo $fechallegada ?>" disabled="true"/>
                                        
                                        
                                   
										
										<label for="email">Lugar del Evento</label>
										<input type="text" name="LEvento" id="email" value="<?php echo $datafields['Lugar'] ?>"disabled="true"/>
										
										<label for="email">Costo de viáticos</label>
										<input type="text" name="Costos" id="email" value="<?php echo $datafields['Costos']?>" disabled="true"/>
                      <label for="email">Numero de alumnos</label>
                    <input type="text" name="Nalumnos" id="email" value="<?php echo $datafields['NumeroAlumnos']?>" disabled="true"/>
									</div>
                        
									<div class="field ">
										
										<label for="email">Carreras en las que afecta la salida.</label> <br/>
									  <input type="text" name="Oficio" id="email" value="<?php echo $carrera; ?>" disabled="true"/>
										<label for="email">Oficio Comisión</label> <br/>
                    <input type="text" name="Oficio" id="email" value="Si" disabled="true"/>
                    
										
										
										
									</div>
									
								
								
									
									<ul class="actions">
										<li><input type="submit" name="Sub" value="Atras" class="button" /></li>
										
									</ul>
								</form>
							</section>
											
                     <?

                     }
                     else{
                     	print($FOLO);
                     
                    ?>
                    <div class="inner">
                      <section>
                      <h3> En este momento no hay ninguna solicitud</h3> 
                    </section>
											</div>
										</div>
									</div>
								</section>
								
							
							</section>

					

					</div>
                   
				<!-- Contact -->
      		

				<!-- Footer -->
					<footer id="footer">
						
						</div>
					</footer>

			</div>

 <?
}
                     
                     }
                     
                    ?>
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