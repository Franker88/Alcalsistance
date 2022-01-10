<?php
require './fpdf/fpdf.php.';
require 'partials/database.php';

if(!isset($_POST['fecha1']) && !isset($_POST['fecha2']) && !isset($_REQUEST['cedula'])){
    echo '
            <script>
                window.location = "index.php";
            </script>
        ';
        exit;
}

$cedularep = $_REQUEST['cedula'];
$fecha1 = $_POST['fecha1'];
$fecha2 = $_POST['fecha2'];
$verdatos = mysqli_query($conn,"SELECT * FROM trabajadores WHERE cedula = '$cedularep'");
$arraydatos = mysqli_fetch_array($verdatos);
$nombre = $arraydatos['Nombre'];
$apellido = $arraydatos['Apellido'];
$trabajo = $arraydatos['Puesto_trabajo'];
$verreporte = mysqli_query($conn,"SELECT * FROM asistencia WHERE cedula = '$cedularep' AND Fecha BETWEEN CAST('$fecha1' AS DATE) AND CAST('$fecha2' AS DATE)");
$arrayrep = mysqli_fetch_array($verreporte);

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(65);
    // Título
    $this->Cell(60,10,'Reporte de Asistencia',1,0,'L');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Alcalsistance'),0,0,'C');
}
}

$pdf=new PDF();

$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

$pdf->Cell(190,10,utf8_decode("Nombre: $nombre $apellido"),1,0,'L');
$pdf->Ln(10);
$pdf->Cell(190,10,utf8_decode("Cedula: $cedularep"),1,0,'L');
$pdf->Ln(10);
$pdf->Cell(190,10,utf8_decode("Area de Trabajo: $trabajo"),1,0,'L');
$pdf->Ln(20);
$pdf->SetFont('Arial','I',12);
$pdf->MultiCell(190,5,utf8_decode("Reporte generado de consulta del horario del trabajador: $nombre $apellido, indicado desde el día: $fecha1 al día $fecha2"));
$pdf->Ln(10);
$pdf->SetFont('Arial','I',8);
$pdf->Cell(30,10,utf8_decode("Fecha"),1,0,'C');
$pdf->Cell(30,10,utf8_decode("Estado"),1,0,'C');
$pdf->Cell(30,10,utf8_decode("Hora de Entrada"),1,0,'C');
$pdf->Cell(30,10,utf8_decode("Hora de Salida"),1,0,'C');
$pdf->Cell(70,10,utf8_decode("Justificacion"),1,0,'C');
$pdf->Ln(10);
foreach($verreporte as $rowr){
    $pdf->Cell(30,10,utf8_decode($rowr["Fecha"]),1,0,'C');
    $pdf->Cell(30,10,utf8_decode($rowr["Estado_asistencia"]),1,0,'C');
    $pdf->Cell(30,10,utf8_decode($rowr["Hora_entrada"]),1,0,'C');
    $pdf->Cell(30,10,utf8_decode($rowr["Hora_salida"]),1,0,'C');
    $pdf->Cell(70,10,utf8_decode($rowr["Justificacion"]),1,0,'C');
    $pdf->Ln(10);
}
$pdf->Ln(10);
$pdf->Cell(190,10,utf8_decode("___________________________________"),0,0,'R');
$pdf->Ln(5);
$pdf->Cell(190,10,utf8_decode("Firma coordinacion de Recursos Humanos"),10,0,'R');
$pdf->Output();
?>