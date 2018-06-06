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

if(isset($_POST['ficherosub']) ){
				  Header('Location: PermisosUSER.php');
}


				

  if(TRUE){
 

?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>UABC</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main2.css" />
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
								<img src="images/img5.jpg" alt="" />
							</span>
							<header class="major">
								<h1>Enviar Reporte</h1>
							</header>
							<div class="content">
								<p></p>
							</div>
						</div>
					</section>

				<!-- Main -->
				
				<div class="centrado">
				<form enctype="multipart/form-data" action="Reporte.php" method="POST">
    <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                Subir Reporte: <input name="Reporte" type="file" /> </br></br></br></br></br>
                 <input type="submit" name="ficherosub" value="Enviar fichero" />
                </form>
            </div>
              
      		    <!-- Contact -->
					<section id="contact">
						<div class="inner">
							<section>
								
									
							</section>
						
						</div>
					</section>

				<!-- Footer -->
					<footer id="footer">
						
						</div>
					</footer>

			</div>

 <?php
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