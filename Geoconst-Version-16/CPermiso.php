<?php 
  session_start();
  $acceso = $_SESSION['acceso'];
  $pressed=$_SESSION['pressed']; 
  $numeroS =$_SESSION['NoEmpleadoid'];
  $nombreS= $_SESSION['Nameid'];
  $apellidoS= $_SESSION['Apellidoid'];
  $id=$_SESSION['ID'];
  $gotone=$_SESSION['gotone'];
  $varr;
  //if($acceso==1) significa que me loguié antes
 
  if($_SESSION['acceso']){
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
								<img src="images/pic07.jpg" alt="" />
							</span>
							<header class="major">
								<h1>SOLICITUD DE PERMISO</h1>
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
			           function validateDate($date, $format = 'Y-m-d H:i:s')
                      {
                          $d = DateTime::createFromFormat($format, $date);
                          return $d && $d->format($format) == $date;

                          //Examples
                          //var_dump(validateDate('2012-02-28 12:12:12')); # true
                          //var_dump(validateDate('2012-02-30 12:12:12')); # false
                          //var_dump(validateDate('2012-02-28', 'Y-m-d')); # true
                          //var_dump(validateDate('28/02/2012', 'd/m/Y')); # true
                          //var_dump(validateDate('30/02/2012', 'd/m/Y')); # false
                          //var_dump(validateDate('14:50', 'H:i')); # true
                          //var_dump(validateDate('14:77', 'H:i')); # false
                          //var_dump(validateDate(14, 'H')); # true
                          //var_dump(validateDate('14', 'H')); # true
                         }
                         //Funcion para obtener la fecha actual
                        function Obtenerdate()
                        {
                         date_default_timezone_set('America/Los_Angeles');
                         $dates = date('y/m/d ', time());
                         return $dates;
                        }
                        function ordenaFecha(){
                          //Areglamos string de Fecha para poder usarlo
                        $sub = substr($fecha, 0,4);
                        $sub2= substr($fecha, 5,2);
                        $sub3= substr($fecha, -2);
                        //Agregamos a un nuevo string bien acomodad
                        $fechafinal = $sub3.'/'.$sub2.'/'.$sub;
                        return ($fechafinal);
                        }
                        
                          print($date);   
			             if($_POST['Sub']){
			             	//Este if tendra mas variables despues.
			             	if(isset($_POST['Carrera']) && isset($_POST['Oficio']) && isset($_POST['Actividad'])){
			             		//Secuencia de agregar a BD cuando tenga el diseÑo
			             		$revisar = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
			             		//Referiancia para Nombre = $nombreS
			             		//Referiancia para Numero = $numeroS
			             		$NE= $_POST['NEvento']; //Nombre del Evento
			             		$THS = $_POST['HSalida']; //Hora de la salida
			             		$HL = $_POST['HLlegada']; //Hora de Llegada
			             		$LE= $_POST['LEvento']; //Lugar Evento
			             		$Costos= $_POST['Costos']; //Costos
			             		$Carrera = $_POST['Carrera'];//Carrera
			             		$OficioComision= $_POST['Oficio'];
			             		$ActAsociada = $_POST['Actividad'];
			             		$NoAlumnos = $_POST['Nalumnos'];
			             		if(!isset($OficioComision)){
			             			$OficioComision=0;
			             		}
			             		//Fechas de salida y llegada
			             		$diaS=$_POST['FechaSD'];
			             		$mesS=$_POST['FechaSM'];
			             		$diaL=$_POST['FechaLD'];
			             		$mesL=$_POST['FechaLM'];

			             		//Si los dias solo tienen 1 digito, agregamos un 0, igual a los meses
			             		if(strlen((string)$diaS)==1){
			             			$diaS='0'.$diaS;
			             			
			             		}
			             		if(strlen((string)$mesS)==1){
			             			$mesS='0'.$mesS;
			             			
			             		}
			             		if(strlen((string)$diaL)==1){
			             			$diaL='0'.$diaL;
			             			
			             		}
			             		if(strlen((string)$mesL)==1){
			             			$mesL='0'.$mesL;
			             			
			             		}

			                   //Concatenamos los datos a una variable para poder insertar en tabla mysql

			                   $dateS ='2018-'.$mesS.'-'.$diaS;
			                   $dateL ='2018-'.$mesL.'-'.$diaL;
                                //Si las fechas son correctas, se introducen en la base de datos
                                if(validateDate($dateS, 'Y-m-d')){
                                	if(validateDate($dateL,'Y-m-d')){
                                        $Fech = Obtenerdate();
                                        $dataID = mysqli_query($revisar,"SELECT idUsuario from Usuario WHERE Nombre='$nombreS' ");
                                        $trueID = mysqli_fetch_array($dataID);
                                        $theid = $trueID['idUsuario'];
                                        //Insertamos en BD
                                        $quer = mysqli_query($revisar,"INSERT INTO Solicitud (idUsuario, Estado, Nombre, Lugar, FechaSalida, HoraSalida, FechaLlegada, HoraLlegada, Costos, NumeroAlumnos, FechaCreacion, idCarrera, Actividad) VALUES('$theid', 1, '$NE', '$LE', '$dateS', '$THS', '$dateL', '$HL', '$Costos', '$NoAlumnos', '$Fech', '$Carrera', '$ActAsociada' )  ");
                                        //Extraemos idSolicitud de la base de datos
                                        $idUSERTIME = mysqli_query($revisar,"SELECT idSolicitud FROM Solicitud WHERE Nombre='$NE' ");
                                        $idsol = mysqli_fetch_array($idUSERTIME);
                                        $idfinal = $idsol['idSolicitud'];
                                        //Insertamos la solicitud conforme la cantidad de supervisores del sistema
                                        $superv = mysqli_query($revisar,"SELECT * FROM Usuario WHERE RolUsuario=2 AND idCarrera='$Carrera' ");
                                
                                        $cont = mysqli_num_rows($superv);
                                        //Ciclo para agregar cantidad de revisiones por tantos supervisores existan!
                                        for($i=0;$i<$cont;$i++){
                                          $NoSp = mysqli_fetch_array($superv);
                                          $idSp = $NoSp['idUsuario'];
                                          $email = $NoSp['Correo'];
                                         mysqli_query($revisar,"INSERT INTO Revision(idSolicitud, idUsuario, EstadoRevision, FechaRevision, idSuperv) VALUES('$idfinal', '$theid', 1,'$Fech', '$idSp')" );
                                         mail($email, "Tiene una nueva solicitud", "Porfavor, ingrese a http://www.geoconstructor.com/Proyecto/, usted tiene solicitudes pentiendes");
                                      }
                                        print '<script language="JavaScript">';
                                        print 'alert("Solicitud creada con exito!");';
                                        print '</script>';
                                 
                                		mysqli_close($revisar);

                                		?>
                                			<section>
									         <meta http-equiv="Refresh" content="1;url=PermisosUSER.php">
							             	</section>

                                		<?php



                                	}
                                   
                                }
                                else{
                                	//Fecha invalida, cerramos conexion.
                                      print '<script language="JavaScript">';
                                      print 'alert("Fechas invalidas");';
                                      print '</script>';
                                	 print("Fecha invalida!");
                                	 
                                }
                               

				                
                                //print($THS);
				               
			             	}
			             	else
			             	{
			             	print '<script language="JavaScript">';
                            print 'alert("No puedes dejar campos vacios");';
                            print '</script>';
                        }
                    }
                    
			             	
			             
			           ?>

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
												<h3>SOLICITUD DE PERMISO</h3>
											</header>
                                                <section>
							     	<form method="post" action="CPermiso.php">
							     		<div class="field">
										<label for="email">Nombre</label>
										<input type="text" name="apellido" id="Passwrd" value="<?php echo $nombreS?>" disabled="true"/>
									</div>
									<div class="field half first">
										<label for="name">No empleado</label>
										<input type="text" name="numero" id="name" value="<?php echo $numeroS?>" disabled="true"/>
										<label for="email">Fecha de la Salida</label>
										Dia
										<select name="FechaSD" class="texto" required="true"> 
											
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                        </select>
                                        Mes
                                        <select name="FechaSM" class="texto" required="true"> 
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8" >8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        </select>
                                        
                                    
										<label for="email">Hora de la Salida</label>
									    <input type="time" name="HSalida" id="email"  class="textob" required="true"/>
										<label for="email">Hora de la llegada</label>
										<input type="time" name="HLlegada" id="email"  class="textob" required="true"/>
										

									</div>
									<div class="field half">
										<label for="email">Nombre del Evento</label>
										<input type="text" name="NEvento" id="email" required="true" />
										<label for="email">Fecha de la llegada</label>
										Dia
										<select name="FechaLD" class="texto" required="true"> 
											
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                        </select>
                                        Mes
                                        <select name="FechaLM" class="texto" required="true"> 
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8" >8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        </select>
                                        
                                   
										
										<label for="email">Lugar del Evento</label>
										<input type="text" name="LEvento" id="email" required="true"/>
										
										<label for="email">Costo de viáticos</label>
										<input type="text" name="Costos" id="email" required="true"/>
									</div>
                        
									<div class="field">
										
										<label for="email">Carreras en las que afecta la salida.</label> <br/>
										<input type="radio" name="Carrera" value="2"> Civil &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" name="Carrera" value="3"> Electrónica <br/>
										<input type="radio" name="Carrera" value="1"> Computación &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" name="Carrera" value="4"> Industrial <br/>
										<input type="radio" name="Carrera" value="5"> Arquitectura &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" name="Carrera" value="6"> Bioingeniería <br/>
										<input type="radio" name="Carrera" value="7"> Nanotecnología <br/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="Oficio" value="1"> Oficio Comisión <br/>
										<label for="email">Actividad asociada a:</label> <br/>
										<input type="radio" name="Actividad" value="Licenciatura"> Licenciatura&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="Actividad" value="Posgrado"> Posgrado <br/>
										<input type="radio" name="Actividad" value="Personal"> Personal
										
										
									</div>
									
									<label for="email">Numero de alumnos</label>
										<input type="text" name="Nalumnos" id="email" required="true"/>
								
									
									<ul class="actions">
										<li><input type="submit" name="Sub" value="Enviar" class="button" /></li>
										
									</ul>
								</form>
							</section>
											
											
										</div>
									</div>
								</section>
								
							
							</section>

					

					</div>
                   
				<!-- Contact -->
			

				<!-- Footer -->
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


<?

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