<?php
require('pdf/fpdf.php');
  session_start();
  $acceso = $_SESSION['acceso'];
  $pressed=$_SESSION['pressed']; 
  $numeroS =$_SESSION['NoEmpleadoid'];
  $nombreS= $_SESSION['Nameid'];
  $apellidoS= $_SESSION['Apellidoid'];
  $id=$_SESSION['ID'];
  $FOLO = $_SESSION['folioc'];
  //Varaible para obtener parametros mandado por el header PERMISOSUSER
  $fol = $_GET['f'];
  

  $varr;



 




class PDF extends FPDF
{
	
// Cabecera de página
function Header()
{
    // Logo
    //$this->Image('logo_pb.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(70);
    // Título
    $this->Cell(40,10,'Permiso de salida UABC');

    $this->Ln(20);
    $this->Image('pdf/uabc.jpg',10,8,33);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'UNIVERSIDAD AUTONOMA DE BAJA CALIFORNIA',0,0,'C');
}

}
//Acceso a base de datos apra conseguir LOS DATOOS
$revisarr = mysqli_connect("www.geoconstructor.com","geoconst_admin","permisosuabc1584","geoconst_PermisosUABC");
$datosSol = mysqli_query($revisarr,"SELECT * FROM Solicitud WHERE idSolicitud = '$fol' ");
$DATAsalida = mysqli_fetch_array($datosSol);
$id = $DATAsalida['idUsuario'];
$datosMae = mysqli_query($revisarr,"SELECT * FROM Usuario WHERE idUsuario='$id' ");
$DATAmaestro = mysqli_fetch_array($datosMae);

    function ordenaFecha($fecha){
                          //Areglamos string de Fecha para poder usarlo
                        $sub = substr($fecha, 0,4);
                        $sub2= substr($fecha, 5,2);
                        $sub3= substr($fecha, -2);
                        //Agregamos a un nuevo string bien acomodad
                        $fechafinal = $sub3.'/'.$sub2.'/'.$sub;
                        return ($fechafinal);
                        }
// Creación del objeto de la clase heredada
$pdf = new PDF();
//Creacion del pdf
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Cell(75);
$pdf->Cell(40,10,'CAMPUS ENSENADA ');
$pdf->ln(4);
$pdf->Cell(25);
$pdf->Cell(40,10,'SUBDIRECCION DE LA FACULTAD DE INGENIERIA, ARQUITECTURA Y DISENIO ');
$pdf->ln(4);
$pdf->Cell(72);
$pdf->Cell(40,10,'DOCUMENTO No.'. $fol.'/2018-1');

$pdf->SetFont('Arial','B',10);
$pdf->Ln(30);
$pdf->Cell(40,10,'A QUIEN CORRESPONDA: ');
$pdf->SetFont('Arial','',10);
$pdf->Ln(18);
$pdf->Cell(40);
$pdf->Cell(30,10,"El(La) suscrito(a), Subdirector(a) de la Facultad de Ingenieria, Arquitectura y Disenio, Campus");
$pdf->Ln(4);
$pdf->Cell(30,10,"Ensenada de la Universidad Autonoma de Baja California, Clave A06-10517-10-2 hace CONSTAR que el profesor:");
$pdf->Ln(15);
$pdf->Cell(70);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,10,$DATAmaestro['Nombre'] );
$pdf->SetFont('Arial','',10);
$pdf->Ln(15);
$pdf->Cell(40);
$pdf->Cell(30,10,"Se encuentra autorizado(a) para efectuar su viaje al evento denominado ".$DATAsalida['Nombre'] ." que" );
$salida = ordenaFecha($DATAsalida['FechaSalida']);
$llegada = ordenaFecha($DATAsalida['FechaSalida']);
$pdf->Ln(4);
$pdf->Cell(30,10,"tomara lugar en ".$DATAsalida['Lugar'] . "durante las fechas " . $salida . " y " .$llegada.", acompaniado de " .$DATAsalida['NumeroAlumnos']." alumnos ");
$pdf->Ln(4);
$pdf->Cell(30,10,"pertenecientes al plan de estudios." );
$pdf->Ln(15);
$pdf->Cell(40);
$pdf->Cell(30,10,"Se extiende el presente oficio de comision a solicitud de el(la) interesado(a), y para los fines " );
$pdf->Ln(4);
$pdf->Cell(30,10,"de constancia que este estime convenientes, en la Ciudad de Ensenada, Baja California. " );
$pdf->Ln(48);
$pdf->Cell(60);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,10,"POR LA REALIZACION PLENA DEL HOMBRE " );
$pdf->Ln(4);
$pdf->Cell(65);
$pdf->Cell(30,10,"SUBDIRECTOR DE LA FACULTAD" );
$pdf->SetFont('Arial','',10);
$pdf->Ln(4);
$pdf->Cell(70);
$pdf->Cell(30,10,"FIRMA DEL DIRECTOR AQUI" );
$pdf->Ln(25);
$pdf->Cell(62);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,10,"DR. HUMBERTO CERVANTES DE AVILA" );








$pdf->Output();



?>