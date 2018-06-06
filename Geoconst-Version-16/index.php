<?php

session_start();
$_SESSION['acceso']=0;

if(($_POST['submitmaestro'])){
	$_SESSION['acceso']=2;
	Header('Location: PermisosUSER.php');
}
if($_POST['submitadministrador']){
	$_SESSION['acceso']=1;
	Header('Location: Permisos.php');
}
	if($_POST['recordar']==1){
				       	 setcookie("id_usuario",$_POST['Correo'],(time()+15000));
				       	 setcookie("contraseña",$_POST['Passwrd'],(time()+15000));
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
		<title>Sistema de Permisos UABC</title>
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
						<a href="index.php" class="logo"><strong>SIPES</strong>Sistema de permisos de salida UABC<span></span></a>
					
					</header>

				<!-- Menu -->
				

				<!-- Banner -->
					<section id="banner" class="style2">
						<div class="inner">
							<span class="image">
								<img src="images/img5.jpg" alt="" />
							</span>
							<header class="major">
								
							</header>
							<div class="content">
								<p></p>
							</div>
						</div>
					</section>

				<!-- Main -->
				
                <?php
                 
                 $Correo = @$_POST['Correo'];
                 $Password = @$_POST['Passwrd'];
                 //Le quitamos los espacios al password introducido
                 $newPass = trim($Password);
                 $Sub = @$_POST['Sub'];
                 
                
                 if(!$Correo || !$Password){
                 	 if(isset($Sub) && ((trim($Correo)=="") || (trim($Passwrd)==""))){
				       echo '<div class="centrado"> No puedes dejar espacios en blanco! </div> ';
				       }

                 

                ?>
				<!-- Contact -->
					<section id="contact">
						<div class="inner">
							<section>
								<div class="centrado">
								<form method="post" action="index.php">
									<div class="field">
										
										
										<img src="images/img1.png"  style="width:200px;height:200px;"/>
									</div>
									
									</div>
										<label for="name">Correo</label>
										<input type="text" name="Correo" id="Correo" value="<?php $a=@$_COOKIE['id_usuario']; if($a!=""){ echo "$a";}  ?> " />
									
									<div class="field">
										<label for="email">Contraseña</label>
										<input type="password" name="Passwrd" id="Passwrd" value="<?php $a=@$_COOKIE['contraseña']; if($a!=""){ echo "$a";}  ?> "/>
									</div>
									
									<input type="checkbox" name="recordar" value="1"> Recordar contraseña 



									<label> <a href='recuperar.php'>Recuperar contraseña </a> </label>
									
									<ul class="actions">
										<div class="centrado">
										<li><input type="submit" name="Sub" value="Ingresar" class="special" /></li>
									</div>
										
									</ul>
								</form>
							</section>

						
						</div>
					</section>
					<?php
				       }
				       
				       	
				       else{
				       
				       


				       //Meodo para revisar si el usuario es Administrador y Usuario a la vez

				       $revisar = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
				       //Seleccionamos la sal almacenada en el password
				       $varaux = mysqli_query($revisar,"SELECT Contrasena FROM Usuario WHERE Correo= '".$Correo."' ");
				       $auxvar = mysqli_fetch_array($varaux);
				       $quer = mysqli_query($revisar,"SELECT * FROM Usuario WHERE Correo= '".$Correo."' ");
				       $array = mysqli_fetch_array($quer);
				       //Verificamos el ROL y datos de usuario
                       $dato =$array['RolUsuario'];
                       $Status=$array['Status'];
                       $_SESSION['NoEmpleadoid']=$array['NumeroEmpleado'];
                       $_SESSION['Nameid']=$array['Nombre'];
                       $_SESSION['Apellidoid']=$array['Nombre'];
                       $_SESSION['ID']=$array['idUsuario'];
                     
                        
                      
                       $col = mysqli_num_rows($quer);
                       //Comparamos hash con el de la base de datos, si convert es 1
                       $convert = password_verify($newPass, $auxvar['Contrasena']);
				       if($col==0 || $convert==0){
				       	
				       	
				       	echo '<div class="centrado"> Datos incorrectos </div> ';
				       	
				       	
    				     ?>
    				     	<section id="contact">
						<div class="inner">
							<section>
								<div class="centrado">
								<form method="post" action="index.php">
									<div class="field">
										
										
										<img src="images/img1.png"  style="width:200px;height:200px;"/>
									</div>
									
									</div>

										<label for="name">Correo</label>
										<input type="text" name="Correo" id="Correo" />
								
									<div class="field">
										<label for="email">Contraseña</label>
										<input type="password" name="Passwrd" id="Passwrd" />
									</div>
									
									<input type="checkbox" name="recordar" value="1"> Recordar contraseña 



									<label> <a href='recuperar.php'>Recuperar contraseña </a> </label>
									<div class="centrado">
									<ul class="actions">
										<li><input type="submit" name="Sub" value="Ingresar" class="special" /></li>
										
									</ul>
								</div>
								</form>
							</section>

						
						</div>
					</section>
                     <?php 
                     }

				       else{
				       
                        //Se loguea dependiendo de el tipo de Usuario
                        if($dato==3 && $Status==1){
                        	$_SESSION['acceso']=1;

					?>
					<section id="contact">
						<div class="inner">
							<section>
								<form method="post" action="index.php">

									<div class="Centrado">
										<img src="images/img1.png"  style="width:200px;height:200px;"/>
										
					                <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Profesor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Administrador<h2>					         
					                </div>
									<ul class="actions">
                                         
										<li><input type="submit" value="Aceptar" name="submitmaestro" class="special" /></li>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<li><input type="submit" value="Aceptar" name="submitadministrador" class="special" /></li>
										
									</ul>
								</form>
							</section>

						
						</div>
					</section>

					<?php
				      }
				      else{
				      	$_SESSION['acceso']=2;
                          if(($dato==1 && $Status==0 ) || ($Status==0) ){
				       	     	echo '<div class="centrado">El correo no está dado de alta en el sistema permisos UABC</div> ' ;
                    		echo '<div class="centrado">Pongase en contaco con el Administrador del sistema</div> ' ;
                    		}
                    		else
                    		{
				      	?>
				      	 	<section id="contact">
						<div class="inner">
							<section>

								<form method="post" action="index.php">

									<div class="Centrado">
                                     <img src="images/img1.png"  style="width:200px;height:200px;"/> 
					                <h2>Profesor&nbsp;<h2>					         
					                </div>
									<ul class="actions">

										<li><input type="submit" value="Aceptar" name="submitmaestro" class="special" /></li>
										&nbsp;
										
								</form>
							</section>


						
						</div>
					</section>


                    <?php
                }
                }
				      }
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