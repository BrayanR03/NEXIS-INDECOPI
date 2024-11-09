<?php
require('../../Librerias/PDF/fpdf/fpdf.php');

session_start();
require_once "../../config/database.php";
require_once "../../models/Movimiento.php";
$idCasilla = $_POST['idCasilla'];
$idMovimiento = $_POST['idMovimiento'];
$movimientoModel = new Movimiento();
$informacionUsuario = $movimientoModel->informacionReporteNotificacionUsuarioNormal($idCasilla, $idMovimiento);
$response = $movimientoModel->reporteNotificacionUsuarioNormal($idCasilla, $idMovimiento);

date_default_timezone_set('America/Lima');
class PDF extends FPDF
{

    private $fechaActual;
    private $horaActual;

    function __construct($fecha, $hora)
    {
        parent::__construct();
        $this->fechaActual = $fecha;
        $this->horaActual = $hora;
    }

    function Header()
    {
        $this->SetFont('Arial', '', 10);
        //        $this->SetXY(1, 2);
        //        $this->Cell(35, 5,'Sistema de Seguimiento de Documentos Internos y Externos', 0, 1, 'L', 0);

        $this->SetXY(260, 2);
        $this->Cell(35, 5, 'Fecha: ' . $this->fechaActual, 0, 1, 'L', 0);
        $this->SetX(260);
        $this->Cell(35, 5, 'Hora  :  ' . $this->horaActual, 0, 0, 'L', 0);

        $this->SetFont('Arial', 'B', 20);
        $this->Image('../../assets/logo-sinoe.png', 5, 2, 35);
        $this->SetXY(80, 12);

        $this->Cell(150, 15, mb_convert_encoding('REPORTE DE NOTIFICACIÓN', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C', 0);
        $this->Ln(10);

        $this->SetFont('Arial', '', 12);
        $this->SetX(10);

        // if ($_POST['usuario'] != '' && $_POST['idCasilla'] != '' && $_POST['idMovimiento'] != '') {
        //     $this->SetX(50);
        //     $this->Cell(130, 8, mb_convert_encoding('Usuario: ' . $_POST['usuario'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);
        //     $this->Cell(180, 8, mb_convert_encoding('Número de Casilla: ' . $_POST['idCasilla'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
        //     $this->Cell(100, 8, mb_convert_encoding('Movimiento: 000' . $_POST['idMovimiento'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
        // }
        $this->Ln(5);
    }
    function GetMultiCellHeight($width, $height, $text) {
        // Crear una instancia temporal para calcular la altura de la MultiCell
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 10);
    
        // Capturar la posición inicial
        $startY = $pdf->GetY();
        // Calcular el espacio que ocuparía la MultiCell
        $pdf->MultiCell($width, $height, $text);
        // Calcular la altura final
        $endY = $pdf->GetY();
        
        return $endY - $startY;
    }
    

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0, 10, mb_convert_encoding('Página ', 'ISO-8859-1', 'UTF-8') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    // Cuerpo del reporte
    function ReportBody($informacionUsuario, $response)
    {
        // Datos del Area y Sede del Notificador
        $this->SetFont('Arial', 'B', 10);
        $this->Ln(5);
        $this->Cell(0, 10, 'Datos del Area y Sede del Notificador', 0, 1);

        $this->SetFont('Arial', '', 10);
        $this->Cell(35, 6, 'Usuario Notificador: ' . " ", 0, 0);
        foreach ($response['data'] as $informacion) {
            $this->Cell(50, 6, mb_convert_encoding($informacion['Persona'], 'ISO-8859-1', 'UTF-8'), 0, 1);
            // $pdf->Cell(45, 8, $informacion['NumDocumentoIdentidad'], 1, 0, 'C');
            break; // Si sólo necesitas un registro de cada tabla
        }
        // $this->Cell(50, 6, $response['Persona'], 0, 1);
        $this->Ln(5);
        $this->Cell(12, 6, 'Area:', 0, 0);
        foreach ($response['data'] as $movimiento) {
            $this->Cell(80, 6, $movimiento['Area'], 0, 1);
        }
        $this->Ln(5);
        $this->Cell(12, 6, 'Sede:', 0, 0);
        $this->Cell(80, 6, 'Sede Principal', 0, 0);
        // foreach ($response['data'] as $movimiento) {
        //     $this->Cell(80, 6, $movimiento['Sede'], 0, 0);
        // }
        //  $this->Ln(5);

        // Datos del Usuario Notificado
        $this->SetFont('Arial', 'B', 10);
        $this->Ln(-33);
        $this->SetX(180);
        $this->Cell(0, 10, 'Datos del Usuario Notificado', 0, 5);

        $this->SetFont('Arial', '', 10);
        $this->Cell(35, 6, 'Usuario Notificado:', 0, 0);
        // foreach)
        $this->Cell(80, 6, mb_convert_encoding($_POST['persona'], 'ISO-8859-1', 'UTF-8'), 0, 0);
        $this->Ln(11);
        $this->SetX(180);
        $this->Cell(50, 6, 'Nro Casilla:', 0, 0);
        $this->Cell(50, 6, $_POST['idCasilla'], 0, 1);
        $this->Ln(5);
        $this->SetX(180);
        //  $this->SetY(10);
        $this->Cell(30, 6, 'Tipo Casilla:', 0, -9);
        foreach ($informacionUsuario['data'] as $informacion) {
            $this->Cell(30, 6, $informacion['TipoCasilla'], 0, 1);
        }
        $this->Ln(20);

// Tabla de Documentos
$this->SetFillColor(0, 0, 0);
$this->SetTextColor(255, 255, 255);
$this->SetFont('Arial', 'B', 10);
$this->Cell(35, 7, 'Tipo Documento', 1, 0, 'C', true);
$this->Cell(35, 7, 'Nro Documento', 1, 0, 'C', true);
$this->Cell(45, 7, 'Nombre Documento', 1, 0, 'C', true);
$this->Cell(40, 7, "Fecha\nNotificacion", 1, 0, 'C', true);
$this->Cell(30, 7, "Fecha\nDocumento", 1, 0, 'C', true);
$this->Cell(45, 7, 'Sumilla', 1, 0, 'C', true);
$this->Cell(50, 7, 'Estado Documento', 1, 1, 'C', true);

// Datos del Documento
$this->SetFont('Arial', '', 10);
$this->SetTextColor(0, 0, 0);
// Máxima altura permitida para cada celda (en unidades de FPDF)
// $maxCellHeight = 21; // Ajusta según prefieras

// foreach ($response['data'] as $movimiento) {
//     $x = $this->GetX();
//     $y = $this->GetY();

//     // Calcular la altura de cada celda, con límite máximo
//     $heights = [
//         min($this->GetMultiCellHeight(35, 7, $movimiento['TipoDocumento']), $maxCellHeight),
//         min($this->GetMultiCellHeight(35, 7, $movimiento['NroDocumento']), $maxCellHeight),
//         min($this->GetMultiCellHeight(45, 7, $movimiento['NombreDocumento']), $maxCellHeight),
//         min($this->GetMultiCellHeight(40, 7, $movimiento['FechaNotificacion']), $maxCellHeight),
//         min($this->GetMultiCellHeight(30, 7, $movimiento['FechaDocumento']), $maxCellHeight),
//         min($this->GetMultiCellHeight(45, 7, $movimiento['Sumilla']), $maxCellHeight),
//         min($this->GetMultiCellHeight(50, 7, $movimiento['EstadoDocumento']), $maxCellHeight),
//     ];
//     $rowHeight = max($heights);

//     // Dibujar celdas de la fila con altura ajustada
//     $this->MultiCell(35, $rowHeight, $movimiento['TipoDocumento'], 1);
//     $this->SetXY($x + 35, $y);

//     $this->MultiCell(35, $rowHeight, $movimiento['NroDocumento'], 1);
//     $this->SetXY($x + 70, $y);

//     $this->MultiCell(45, $rowHeight, $movimiento['NombreDocumento'], 1);
//     $this->SetXY($x + 115, $y);

//     $this->MultiCell(40, $rowHeight, $movimiento['FechaNotificacion'], 1);
//     $this->SetXY($x + 155, $y);

//     $this->MultiCell(30, $rowHeight, $movimiento['FechaDocumento'], 1);
//     $this->SetXY($x + 185, $y);

//     $this->MultiCell(45, $rowHeight, $movimiento['Sumilla'], 1);
//     $this->SetXY($x + 230, $y);

//     $this->MultiCell(50, $rowHeight, $movimiento['EstadoDocumento'], 1);

//     $this->Ln($rowHeight);
// }

foreach ($response['data'] as $movimiento) {
    $x = $this->GetX();
    $y = $this->GetY();

    // Calcular altura máxima de la fila
    $heights = [
        $this->GetMultiCellHeight(35, 7, $movimiento['TipoDocumento']),
        $this->GetMultiCellHeight(35, 7, $movimiento['NroDocumento']),
        $this->GetMultiCellHeight(45, 7, $movimiento['NombreDocumento']),
        $this->GetMultiCellHeight(40, 7, $movimiento['FechaNotificacion']),
        $this->GetMultiCellHeight(30, 7, $movimiento['FechaDocumento']),
        $this->GetMultiCellHeight(45, 7, $movimiento['Sumilla']),
        $this->GetMultiCellHeight(50, 7, $movimiento['EstadoDocumento']),
    ];
    $maxHeight = max($heights);

    // Dibujar las celdas de la fila con la misma altura
    $this->MultiCell(35, $maxHeight, $movimiento['TipoDocumento'], 1);
    $this->SetXY($x + 35, $y);

    $this->MultiCell(35, $maxHeight, $movimiento['NroDocumento'], 1);
    $this->SetXY($x + 70, $y);

    $this->MultiCell(45, 7, $movimiento['NombreDocumento'], 1);
    $this->SetXY($x + 115, $y);

    $this->MultiCell(40, $maxHeight, $movimiento['FechaNotificacion'], 1);
    $this->SetXY($x + 155, $y);

    $this->MultiCell(30, $maxHeight, $movimiento['FechaDocumento'], 1);
    $this->SetXY($x + 185, $y);

    $this->MultiCell(45, $maxHeight, $movimiento['Sumilla'], 1);
    $this->SetXY($x + 230, $y);

    $this->MultiCell(50, $maxHeight, $movimiento['EstadoDocumento'], 1);

    // Mover a la siguiente fila
    $this->Ln($maxHeight);
}


/**===================================================================== */
        // // Tabla de Documentos
        // $this->SetFillColor(0, 0, 0);
        // $this->SetTextColor(255, 255, 255);
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(35, 7, 'Tipo Documento', 1, 0, 'C', true);
        // $this->Cell(35, 7, 'Nro Documento', 1, 0, 'C', true);
        // $this->Cell(45, 7, 'Nombre Documento', 1, 0, 'C', true);
        // $this->Cell(40, 7, "Fecha\nNotificacion", 1, 0, 'C', true);
        // $this->Cell(30, 7, "Fecha\nDocumento", 1, 0, 'C', true);
        // $this->Cell(45, 7, 'Sumilla', 1, 0, 'C', true);
        // $this->Cell(50, 7, 'Estado Documento', 1, 1, 'C', true);

        // // Datos del Documento
        // $this->SetFont('Arial', '', 10);
        // $this->SetTextColor(0, 0, 0);
        // foreach ($response['data'] as $movimiento) {
        //     // Guardar posición inicial de la fila
        //     $x = $this->GetX();
        //     $y = $this->GetY();
            
        //     // Celdas con contenido ajustable en altura
        //     $this->MultiCell(35, 7, $movimiento['TipoDocumento'], 1);
        //     $this->SetXY($x + 35, $y); // Ajustar posición de la siguiente celda
            
        //     $this->MultiCell(35, 7, $movimiento['NroDocumento'], 1);
        //     $this->SetXY($x + 70, $y); // Ajustar posición de la siguiente celda
            
        //     $this->MultiCell(45, 7, $movimiento['NombreDocumento'], 1);
        //     $this->SetXY($x + 115, $y); // Ajustar posición de la siguiente celda
            
        //     $this->MultiCell(40, 7, $movimiento['FechaNotificacion'], 1);
        //     $this->SetXY($x + 155, $y); // Ajustar posición de la siguiente celda
            
        //     $this->MultiCell(30, 7, $movimiento['FechaDocumento'], 1);
        //     $this->SetXY($x + 185, $y); // Ajustar posición de la siguiente celda
            
        //     $this->MultiCell(45, 7, $movimiento['Sumilla'], 1);
        //     $this->SetXY($x + 230, $y); // Ajustar posición de la siguiente celda
            
        //     $this->MultiCell(50, 7, $movimiento['EstadoDocumento'], 1);
            
        //     // Mover a la siguiente fila
        //     $this->Ln();
        // }
        
        /*============================================================================== */
        // $this->Cell(30, 7, $response['TipoDocumento'], 1);
        // $this->Cell(30, 7, $response['NroDocumento'], 1);
        // $this->Cell(40, 7, $response['NombreDocumento'], 1);
        // $this->Cell(30, 7, $response['FechaNotificacion'], 1);
        // $this->Cell(30, 7, $response['FechaDocumento'], 1);
        // $this->Cell(30, 7, $response['Sumilla'], 1);
        // $this->Cell(30, 7, $response['EstadoDocumento'], 1, 1);
    }

    // protected $widths;
    // protected $aligns;

    // function SetWidths($w)
    // {
    //     // Set the array of column widths
    //     $this->widths = $w;
    // }

    // function SetAligns($a)
    // {
    //     // Set the array of column alignments
    //     $this->aligns = $a;
    // }

    // function Row($data, $setX)
    // {
    //     // Calculate the height of the row
    //     $nb = 0;
    //     for ($i = 0; $i < count($data); $i++)
    //         $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
    //     $h = 5 * $nb;
    //     // Issue a page break first if needed
    //     $this->CheckPageBreak($h, $setX);
    //     // Draw the cells of the row
    //     for ($i = 0; $i < count($data); $i++) {
    //         $w = $this->widths[$i];
    //         $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
    //         // Save the current position
    //         $x = $this->GetX();
    //         $y = $this->GetY();
    //         // Draw the border
    //         $this->Rect($x, $y, $w, $h, 'DF');
    //         // Print the text
    //         $this->MultiCell($w, 5, $data[$i], 0, $a);
    //         // Put the position to the right of the cell
    //         $this->SetXY($x + $w, $y);
    //     }
    //     // Go to the next line
    //     $this->Ln($h);
    // }

    // function CheckPageBreak($h, $setX)
    // {
    //     // If the height h would cause an overflow, add a new page immediately
    //     if ($this->GetY() + $h > $this->PageBreakTrigger) {
    //         $this->AddPage($this->CurOrientation);
    //         $this->SetX($setX);
    //         $this->SetFont('Arial', 'B', 10);

    //         if ($_POST['usuario'] != 'Seleccionar') {
    //             $this->Cell(30, 8, 'Tipo Documento', 1, 0, 'C', 0);
    //             $this->Cell(30, 8, 'Nro Documento', 1, 0, 'C', 0);
    //             $this->Cell(50, 8, 'Nombre Documento', 1, 0, 'C', 0);
    //             $this->Cell(15, 8, 'Fecha Notificacion', 1, 0, 'C', 0);
    //             $this->Cell(15, 8, 'Fecha Documento', 1, 0, 'C', 0);
    //             $this->Cell(15, 8, 'Sumilla', 1, 0, 'C', 0);
    //             $this->Cell(40, 8, 'Usuario', 1, 0, 'C', 0);
    //             $this->Cell(40, 8, mb_convert_encoding('Área', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    //             $this->Cell(40, 8, mb_convert_encoding('Sede', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    //             $this->Cell(35, 8, mb_convert_encoding('Estado Documento', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);
    //         }



    //         $this->SetFont('Arial', '', 9);
    //     }

    //     if ($setX == 100) {
    //         $this->SetX(100);
    //     } else {
    //         $this->SetX($setX);
    //     }
    // }

    // function NbLines($w, $txt)
    // {
    //     // Compute the number of lines a MultiCell of width w will take
    //     if (!isset($this->CurrentFont))
    //         $this->Error('No font has been set');
    //     $cw = $this->CurrentFont['cw'];
    //     if ($w == 0)
    //         $w = $this->w - $this->rMargin - $this->x;
    //     $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
    //     $s = str_replace("\r", '', (string)$txt);
    //     $nb = strlen($s);
    //     if ($nb > 0 && $s[$nb - 1] == "\n")
    //         $nb--;
    //     $sep = -1;
    //     $i = 0;
    //     $j = 0;
    //     $l = 0;
    //     $nl = 1;
    //     while ($i < $nb) {
    //         $c = $s[$i];
    //         if ($c == "\n") {
    //             $i++;
    //             $sep = -1;
    //             $j = $i;
    //             $l = 0;
    //             $nl++;
    //             continue;
    //         }
    //         if ($c == ' ')
    //             $sep = $i;
    //         $l += $cw[$c];
    //         if ($l > $wmax) {
    //             if ($sep == -1) {
    //                 if ($i == $j)
    //                     $i++;
    //             } else
    //                 $i = $sep + 1;
    //             $sep = -1;
    //             $j = $i;
    //             $l = 0;
    //             $nl++;
    //         } else
    //             $i++;
    //     }
    //     return $nl;
    // }
}
// Crear instancia del PDF
$fecha = date('d/m/Y');
$horaActual = date('H:i');
$pdf = new PDF($fecha, $horaActual);
$pdf->AliasNbPages();
$pdf->AddPage('L');

// Datos de prueba
$notificador = [
    'area' => 'SUBGERENCIA DE INFORMATICA Y SISTEMAS',
    'sede' => 'PALACIO MUNICIPAL',
    'usuario' => 'NECIOSUP BOLAÑOS BRAYAN'
];

$notificado = [
    'nombre' => 'PEPITO PEREZ',
    'nro_casilla' => '3',
    'tipo_casilla' => 'Normal'
];

$documento = [
    'tipo' => 'INFORME',
    'nro_documento' => '005-MDE-2024',
    'nombre_documento' => 'Acto Administrativo',
    'fecha_notificacion' => '31/11/2024',
    'fecha_documento' => '31/11/2024',
    'sumilla' => 'Lorem',
    'estado' => 'LEIDO'
];

// Generar el cuerpo del reporte
$pdf->ReportBody($informacionUsuario, $response);

// Salida del PDF
$pdf->Output();

// // Obtener la fecha y hora actual
// $fecha = date('d/m/Y');
// $horaActual = date('H:i');
// $pdf = new PDF($fecha, $horaActual);
// $pdf->AliasNbPages();
// $pdf->AddPage('L');
// $pdf->SetAutoPageBreak(true, 20);
// $pdf->SetFont('Arial', 'B', 10);

// $pdf->Ln(10);

// // Encabezados de las tablas alineados en la primera fila
// $pdf->SetX(10);
// $pdf->Cell(90, 8, 'Datos del Usuario', 1, 0, 'C');
// $pdf->SetX(110);
// $pdf->Cell(90, 8, 'Datos de la Casilla del Usuario', 1, 0, 'C');
// $pdf->SetX(210);
// $pdf->Cell(75, 8, 'Datos del Area - Sede del Notificador', 1, 1, 'C'); 

// // Primera fila de datos
// $pdf->SetFont('Arial', '', 10);
// $pdf->SetX(10); // Posición inicial de la primera tabla
// $pdf->Cell(45, 8, 'Usuario', 1, 0, 'C');
// $pdf->Cell(45, 8, $_POST['usuario'], 1, 0, 'C');

// $pdf->SetX(110); // Posición inicial de la segunda tabla
// $pdf->Cell(45, 8, 'ID Casilla', 1, 0, 'C');
// $pdf->Cell(45, 8, $_POST['idCasilla'], 1, 0, 'C');

// $pdf->SetX(210); // Posición inicial de la tercera tabla
// $pdf->Cell(45, 8, 'Area', 1, 0, 'C');
// $pdf->Cell(30, 8, 'Sede', 1, 1, 'C'); // Cierre de línea

// // Segunda fila de datos (llenando cada tabla con foreach en paralelo)
// $pdf->SetX(10);
// foreach ($informacionUsuario['data'] as $informacion) {
//     $pdf->Cell(45, 8, $informacion['TipoDocumentoIdentidad'], 1, 0, 'C');
//     $pdf->Cell(45, 8, $informacion['NumDocumentoIdentidad'], 1, 0, 'C');
//     break; // Si sólo necesitas un registro de cada tabla
// }

// $pdf->SetX(110);
// foreach ($informacionUsuario['data'] as $informacion) {
//     $pdf->Cell(45, 8, $informacion['TipoCasilla'], 1, 0, 'C');
//     $pdf->Cell(45, 8, $informacion['FechaApertura'], 1, 0, 'C');
//     break;
// }

// $pdf->SetX(210);
// foreach ($response['data'] as $movimiento) {
//     $pdf->Cell(45, 8, $movimiento['Area'], 1, 0, 'C');
//     $pdf->Cell(30, 8, $movimiento['Sede'], 1, 1, 'C'); // Cierre de línea
//     break;
// }

// // Fila de "Tipo Persona" en Datos del Usuario
// $pdf->SetX(10);
// $pdf->Cell(45, 8, 'Tipo Persona', 1, 0, 'C');
// $pdf->Cell(45, 8, $_POST['tipoPersona'], 1, 1, 'C');
// $pdf->SetX(10);
// $pdf->Cell(45, 8, 'Persona', 1, 0, 'C');
// $pdf->Cell(45, 8, $_POST['persona'], 1, 1, 'C');
// // Segunda tabla principal de documentos
// $pdf->Ln(15);
// $pdf->SetFont('Arial', 'B', 10);
// if ($_POST['usuario'] != 'Seleccionar' && $_POST['idMovimiento'] != '' && $_POST['idCasilla'] != '') {
//     $pdf->Cell(30, 8, "Tipo\nDocumento", 1, 0, 'C', 0);
//     $pdf->Cell(30, 8, "Nro\nDocumento", 1, 0, 'C', 0);
//     $pdf->Cell(35, 8, "Nombre\nDocumento", 1, 0, 'C', 0);
//     $pdf->Cell(33, 8, "Fecha\nNotificacion", 1, 0, 'C', 0);
//     $pdf->Cell(33, 8, "Fecha\nDocumento", 1, 0, 'C', 0);
//     $pdf->Cell(20, 8, 'Sumilla', 1, 0, 'C', 0);
//     $pdf->Cell(35, 8, mb_convert_encoding("Estado\nDocumento", 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);
// } else {
//     $pdf->Cell(30, 8, 'Tipo Documento', 1, 0, 'C', 0);
//     $pdf->Cell(30, 8, 'Nro Documento', 1, 0, 'C', 0);
//     $pdf->Cell(30, 8, 'Nombre Documento', 1, 0, 'C', 0);
//     $pdf->Cell(30, 8, 'Fecha Notificacion', 1, 0, 'C', 0);
//     $pdf->Cell(30, 8, 'Fecha Documento', 1, 0, 'C', 0);
//     $pdf->Cell(30, 8, 'Sumilla', 1, 0, 'C', 0);
//     $pdf->Cell(18, 8, mb_convert_encoding('Estado Documento', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);
// }

// $pdf->SetFillColor(233, 229, 235);
// $pdf->SetFont('Arial', '', 10);

// // Recorrer los datos y agregarlos al PDF
// foreach ($response['data'] as $movimiento) {
//     $pdf->Cell(30, 8, $movimiento['TipoDocumento'], 1, 0, 'C');
//     $pdf->Cell(40, 8, $movimiento['NroDocumento'], 1, 0, 'C');
//     $pdf->Cell(60, 8, $movimiento['NombreDocumento'], 1, 0, 'C');
//     $pdf->Cell(30, 8, $movimiento['FechaNotificacion'], 1, 0, 'C');
//     $pdf->Cell(30, 8, $movimiento['FechaDocumento'], 1, 0, 'C');
//     $pdf->Cell(30, 8, $movimiento['Sumilla'], 1, 0, 'C');
//     $pdf->Cell(30, 8, $movimiento['EstadoDocumento'], 1, 1, 'C');
// }

// // Configurar encabezados para la salida de PDF
// header('Content-Type: application/pdf');
// header('Content-Disposition: inline; filename="archivo.pdf"');
// header('Cache-Control: private, max-age=0, must-revalidate');
// header('Pragma: public');
$pdf->Output();

// // Obtener la fecha y hora actual
// $fecha = date('d/m/Y');
// $horaActual = date('H:i');
// $pdf = new PDF($fecha, $horaActual);
// // $response = [];


// // var_dump($response);
// // die();
// $pdf->AliasNbPages();
// $pdf->AddPage('L');
// $pdf->SetAutoPageBreak(true, 20);
// $pdf->SetX(10);
// $pdf->SetFont('Arial', 'B', 10);

// $pdf->Ln(10);
// // Establece la posición inicial en Y para todas las tablas
// $pdf->SetY($pdf->GetY()); // Posición Y actual
// $pdf->SetX(10); // Coloca la primera tabla en la posición inicial

// // Tabla 1: Información de Usuario
// $pdf->SetFont('Arial', 'B', 10);
// $pdf->Cell(90, 8, 'Datos del Usuario', 1, 0, 'C');

// // Posición de la segunda tabla
// $pdf->SetX(110); // Coloca la segunda tabla al lado derecho de la primera
// $pdf->Cell(90, 8, 'Datos de la Casilla del Usuario', 1, 0, 'C');

// // Posición de la tercera tabla
// $pdf->SetX(210); // Coloca la tercera tabla al lado derecho de la segunda
// $pdf->Cell(75, 8, 'Datos del Area - Sede del Notificador', 1, 1, 'C'); // 1,1 para ir a la siguiente línea tras esta celda

// // Relleno de la primera tabla en la siguiente fila
// $pdf->SetFont('Arial', '', 10);
// $pdf->SetX(10); // Vuelve a la posición inicial de la primera tabla
// $pdf->Cell(45, 8, 'Usuario', 1, 0, 'C');
// $pdf->Cell(45, 8, $_POST['usuario'], 1, 0, 'C');
// // $pdf->Cell(5, 10, '', 0);  // Espacio entre celdas
// $pdf->Ln(8); // Salto de línea
// $pdf->Cell(45, 8, 'Persona', 1, 0, 'C');
// $pdf->Cell(45, 8, $_POST['persona'], 1, 0, 'C');
// $pdf->Ln(8); // Salto de línea
// foreach ($informacionUsuario['data'] as $informacion) {
//     $pdf->Cell(45, 8, $informacion['TipoDocumentoIdentidad'], 1, 0, 'C');
// }
// foreach ($informacionUsuario['data'] as $informacion) {
//     $pdf->Cell(45, 8, $informacion['NumDocumentoIdentidad'], 1, 0, 'C');
//     $pdf->Ln(8);
// }
// $pdf->Cell(45, 8, 'Tipo Persona', 1, 0, 'C');
// $pdf->Cell(45, 8, $_POST['tipoPersona'], 1, 0, 'C');
// // Relleno de la segunda tabla en la misma fila
// $pdf->SetX(110); // Ajusta X para la segunda tabla

// $pdf->Cell(45, 8, 'ID Casilla', 1, 0, 'C');
// $pdf->Cell(45, 8, $_POST['idCasilla'], 1, 0, 'C');
// foreach ($informacionUsuario['data'] as $informacion) {
//     $pdf->Cell(45, 8, $informacion['TipoCasilla'], 1, 0, 'C');
//     // $pdf->Ln(8);
// }
// $pdf->Cell(45, 8, 'Fecha de Apertura', 1, 0, 'C');
// foreach ($informacionUsuario['data'] as $informacion) {
//     $pdf->Cell(45, 8, $informacion['FechaApertura'], 1, 0, 'C');
//     // $pdf->Ln(8);
// }
// // Relleno de la tercera tabla en la misma fila
// $pdf->SetX(210); // Ajusta X para la tercera tabla
// $pdf->Cell(45, 8, 'AREA - SEDE', 1, 0, 'C');
//  // Ajusta X para la tercera tabla
//  $pdf->Cell(45, 8, 'AREA', 1, 0, 'C');
// foreach ($response['data'] as $movimiento) {
//     $pdf->Cell(45, 8, $movimiento['Area'], 1, 0, 'C');
//     // $pdf->Ln(8);
// }
// $pdf->Cell(45, 8, 'SEDE', 1, 0, 'C');
// foreach ($response['data'] as $movimiento) {
//     $pdf->Cell(45, 8, $movimiento['Sede'], 1, 0, 'C');
//     // $pdf->Ln(8);
// }
// // $pdf->Cell(30, 8, $_POST['Area'], 1, 1, 'C'); // Mueve a la siguiente línea

// $pdf->Ln(15);

// // Fila 2: Tabla principal

// $pdf->SetFont('Arial', 'B', 10);
// if ($_POST['usuario'] != 'Seleccionar' && $_POST['idMovimiento'] != '' && $_POST['idCasilla'] != '') {
//     $pdf->Cell(30, 8, "Tipo\nDocumento", 1, 0, 'C', 0);
//     $pdf->Cell(30, 8, "Nro\nDocumento", 1, 0, 'C', 0);
//     $pdf->Cell(35, 8, "Nombre\nDocumento", 1, 0, 'C', 0);
//     $pdf->Cell(33, 8, "Fecha\nNotificacion", 1, 0, 'C', 0);
//     $pdf->Cell(33, 8, "Fecha\nDocumento", 1, 0, 'C', 0);
//     $pdf->Cell(20, 8, 'Sumilla', 1, 0, 'C', 0);
//     $pdf->Cell(35, 8, mb_convert_encoding("Estado\nDocumento", 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);
// } else {
//     $pdf->Cell(30, 8, 'Tipo Documento', 1, 0, 'C', 0);
//     $pdf->Cell(30, 8, 'Nro Documento', 1, 0, 'C', 0);
//     $pdf->Cell(30, 8, 'Nombre Documento', 1, 0, 'C', 0);
//     $pdf->Cell(30, 8, 'Fecha Notificacion', 1, 0, 'C', 0);
//     $pdf->Cell(30, 8, 'Fecha Documento', 1, 0, 'C', 0);
//     $pdf->Cell(30, 8, 'Sumilla', 1, 0, 'C', 0);
//     $pdf->Cell(18, 8, mb_convert_encoding('Estado Documento', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);
// }

// $pdf->SetFillColor(233, 229, 235);
// $pdf->SetFont('Arial', '', 10);


// // Recorrer los datos y agregarlos al PDF
// foreach ($response['data'] as $movimiento) {
//     $pdf->Cell(30, 8, $movimiento['TipoDocumento']);
//     $pdf->Cell(40, 8, $movimiento['NroDocumento']);
//     $pdf->Cell(60, 8, $movimiento['NombreDocumento']);
//     $pdf->Cell(30, 8, $movimiento['FechaNotificacion']);
//     $pdf->Cell(30, 8, $movimiento['FechaDocumento']);
//     $pdf->Cell(30, 8, $movimiento['Sumilla']);
//     $pdf->Cell(30, 8, $movimiento['EstadoDocumento']);
//     $pdf->Ln(); // Salto de línea para la siguiente fila
// }

// // Configurar encabezados para la salida de PDF
// header('Content-Type: application/pdf');
// header('Content-Disposition: inline; filename="archivo.pdf"');
// header('Cache-Control: private, max-age=0, must-revalidate');
// header('Pragma: public');
// $pdf->Output();
