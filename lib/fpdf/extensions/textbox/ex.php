<?php
define('FPDF_FONTPATH','font/');
require('textbox.php');

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',15);
$pdf->SetX(70);
$pdf->drawTextBox('This sentence is centered in the middle of the box.', 50, 50, 'C', 'M');
$pdf->Output();
?>
