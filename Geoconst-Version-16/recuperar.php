<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<html>
	<head>
		<title>Recuperación de Contraseña</title>
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
						<a href="index.php" class="logo"><strong>UABC</strong> <span></span></a>
						<nav>
							<a href="index.php">Volver</a>
						</nav>
					</header>

				<!-- Menu -->
			

				<!-- Banner -->
					<section id="banner" class="major">
						<div class="inner">
							<header class="major">
								<h1>Recuperación de Contraseña</h1>
							</header>
							
						</div>
					</section>

				<!-- Main -->
				<?php
                 //Guardamos en pass el correo
                 $pass= @$_POST['Pass'];
                 $sub= @$_POST['enviar'];
                  function generatePassword($length = 8) {
                    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                    $count = mb_strlen($chars);

                    for ($i = 0, $result = ''; $i < $length; $i++) {
                         $index = rand(0, $count - 1);
                         $result .= mb_substr($chars, $index, 1);
                        }

                    return $result;
                   }
                 if($sub){


                    if(trim($pass)==""){
                 	echo '<div class="centrado"> No puedes dejar el espacio en blanco! </div> ';
                    }

                    else{
                    	$quer = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
                    	//Funcion SQL para buscar el dato en BD
                    	$dato=mysqli_query($quer, "SELECT * FROM Usuario WHERE Correo = '".$pass."'" );
                    	//Verificamos si hay una tabla en la base de datos
                    	$algo=mysqli_num_rows($dato);
                    	//Si existe registro, sera mayor que 0
                    	if($algo==0)
                    	{
                    		echo '<div class="centrado"> Correo inexistente, intenta de nuevo </div> ';
                    	}
                    	else{
                    		//echo '<div class="centrado"> Estas en mi base de datos</div> ';
                    		//Asociamos arrays a una variable
                    		$password = mysqli_fetch_array($dato);
                    		if($password['Status']==1){
                    		//Creamos password aleatorio
                    		$ranPassword = generatePassword();
                    		//Agregamos la sal para guardar en BD
                    		$passSALT = password_hash($ranPassword, PASSWORD_DEFAULT);
                    		//Update en base de datos con dicho password
                            mysqli_query($quer,"UPDATE Usuario SET Contrasena='$passSALT' WHERE Correo='$pass' ");
                    		//Asignamos a variable con cuerpo
                    		$Newmess = "Tu contraseña es :".$ranPassword;
                            //Enviamos a destinatario, pass es el correo, el cuerpo del mensaje y el password
                    		mail($pass, "Recuperación de contraseña", $Newmess);
                    		echo '<div class="centrado"> Se ha enviado tu contraseña al correo proporcionado</div> ' ;
                    	}
                    	if($password['Status']==0){
                    		echo '<div class="centrado">El correo no está dado de alta en el sistema permisos UABC</div> ' ;
                    		echo '<div class="centrado">Pongase en contaco con el Administrador del sistema</div> ' ;
                    	}

                    		
                    	}

                    	mysqli_close($quer);

                    }

                 }

                 
                 ?> 

				<!-- Contact -->
					<section id="contact">
						<div class="inner">
							<section>
								<form method="post" action="recuperar.php">
									<div class="field">
										<label for="name">Ingresa tu correo electronico para restablecer tu cuenta</label>
										<input type="text" name="Pass"  >
									</div>


									
									
									
									
									<ul class="actions">
										<li><input type="submit" value="Enviar"  name="enviar" class="special" /></li>
										
									</ul>
								</form>
							</section>

						
						</div>
					</section>

				<!-- Footer -->
				

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