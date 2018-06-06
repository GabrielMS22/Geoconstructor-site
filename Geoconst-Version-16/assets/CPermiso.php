<?php 
  session_start();
  $acceso = $_SESSION['acceso'];
  $pressed=$_SESSION['pressed']; 
  $numeroS =$_SESSION['NoEmpleadoid'];
  $nombreS= $_SESSION['Nameid'];
  $apellidoS= $_SESSION['Apellidoid'];
  $varr;
  //if($acceso==1) significa que me loguié antes
  
  if($acceso==2){
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
							<a href="#menu">Menu</a>
						</nav>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<ul class="links">
							<li><a href="index.html">Home</a></li>
							<li><a href="landing.html">Landing</a></li>
							<li><a href="generic.html">Generic</a></li>
							<li><a href="elements.html">Elements</a></li>
						</ul>
						<ul class="actions vertical">
							<li><a href="#" class="button special fit">Get Started</a></li>
							<li><a href="#" class="button fit">Log In</a></li>
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
			             if($_POST['Sub']){
			             	//Este if tendra mas variables despues.
			             	if(trim($Categoria)!="" && trim($Carrera)!="" && trim($Oficio)!="" && trim($Actividad)!=""){
			             		//Secuencia de agregar a BD cuando tenga el diseÑo
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
												<h3>DATOS DE SOLICITUD</h3>
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
										<select name="FechaSD" class="texto" > 
											
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
                                        <option value="12">13</option>
                                        <option value="12">14</option>
                                        <option value="12">15</option>
                                        <option value="12">16</option>
                                        <option value="12">17</option>
                                        <option value="12">18</option>
                                        <option value="12">19</option>
                                        <option value="12">20</option>
                                        <option value="12">21</option>
                                        <option value="12">22</option>
                                        <option value="12">23</option>
                                        <option value="12">24</option>
                                        <option value="12">25</option>
                                        <option value="12">26</option>
                                        <option value="12">27</option>
                                        <option value="12">28</option>
                                        <option value="12">29</option>
                                        <option value="12">30</option>
                                        <option value="12">31</option>
                                        </select>
                                        Mes
                                        <select name="FechaSM" class="texto" > 
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8" selected>8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        </select>
                                        Año
                                      <select name="FechaSA" class="texto" > 
                                        <option value="2018">2018</option>
                                      
                                        </select>
										<label for="email">Hora de la Salida</label>
									    <input type="time" name="HSalida" id="email" placeholder="Formato 00:00" class="textob" />
										<label for="email">Hora de la llegada</label>
										<input type="time" name="HLlegada" id="email" placeholder="Formato 00:00" class="textob" />
										

									</div>
									<div class="field half">
										<label for="email">Nombre del Evento</label>
										<input type="text" name="NEvento" id="email" />
										<label for="email">Fecha de la llegada</label>
										Dia
										<select name="FechaLD" class="texto" > 
											
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
                                        <option value="12">13</option>
                                        <option value="12">14</option>
                                        <option value="12">15</option>
                                        <option value="12">16</option>
                                        <option value="12">17</option>
                                        <option value="12">18</option>
                                        <option value="12">19</option>
                                        <option value="12">20</option>
                                        <option value="12">21</option>
                                        <option value="12">22</option>
                                        <option value="12">23</option>
                                        <option value="12">24</option>
                                        <option value="12">25</option>
                                        <option value="12">26</option>
                                        <option value="12">27</option>
                                        <option value="12">28</option>
                                        <option value="12">29</option>
                                        <option value="12">30</option>
                                        <option value="12">31</option>
                                        </select>
                                        Mes
                                        <select name="FechaLM" class="texto" > 
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8" selected>8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        </select>
                                        Año
                                      <select name="FechaLA" class="texto" > 
                                        <option value="2018">2018</option>
                                      
                                        </select>
										
										<label for="email">Lugar del Evento</label>
										<input type="text" name="LEvento" id="email" />
										
										<label for="email">Costo de viáticos</label>
										<input type="text" name="Costos" id="email" />
									</div>
                        
									<div class="field">
										
										<label for="email">Carreras en las que afecta la salida.</label> <br/>
										<input type="radio" name="Carrera" value="0"> Civil &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" name="Carrera" value="1"> Electrónica <br/>
										<input type="radio" name="Carrera" value="2"> Computación &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" name="Carrera" value="3"> Industrial <br/>
										<input type="radio" name="Carrera" value="4"> Arquitectura &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" name="Carrera" value="5"> Bioingeniería <br/>
										<input type="radio" name="Carrera" value="6"> Nanotecnología <br/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="Oficio" value="1"> Oficio Comisión <br/>
										<label for="email">Actividad asociada a:</label> <br/>
										<input type="radio" name="Actividad" value="0"> Licenciatura&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="Actividad" value="1"> Posgrado <br/>
										<input type="radio" name="Actividad" value="2"> Personal
										
										
									</div>
									
									<label for="email">Numero de alumnos</label>
										<input type="text" name="Nalumnos" id="email" />
								
									
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
					<footer id="footer">
						
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