<?php
//require_once 'autoloadmagic.php';
require_once '../../lib/SmartPDF.php';

class SmartPDFTest extends PHPUnit_Framework_TestCase {

//  public function testFoo() {
//    $f = new Foo();
//    $f->helloworld();  
//  }
  
  public function testBasicConcept() {
    echo "testBasicConcept called";
    
    // initiate FPDI
    $pdf = new SmartPDF();
    // add a page
    $pdf->AddPage();
    // set the sourcefile
    $pdf->setSourceFile('order_history.pdf');
    // import page 1
    $tplIdx = $pdf->importPage(1);
    // use the imported page and place it at point 10,10 with a width of 100 mm
    $pdf->useTemplate($tplIdx, 10, 10, 100);
    
    // now write some text above the imported page
    $pdf->SetFont('Arial');
    $pdf->SetTextColor(255,0,0);
    $pdf->SetXY(25, 25);
    $pdf->Write(0, "This is just a simple text");
    
    // write some opac text
    $pdf->SetAlpha(0.2);
    $pdf->SetFont('Arial');
    $pdf->SetTextColor(255,0,0);
    $pdf->SetXY(25, 50);
    $pdf->Write(0, "This is just a simple text. It should be semi-transparent.");
    $pdf->SetAlpha(1);
    
    // write vertical text
    $strText = 'Vertical TAKEOFF!';
    $w = 1;
    $h = 100;
    $align='L';
    $valign = 'T';
    $border = 0;
    $pdf->setXY(10, 10);
    $pdf->drawTextBox($strText, $w, $h, $align, $valign, $border);
    
    $pdf->Output('newpdf.pdf', 'F');
    
    echo "***\nDONE!\n";
  }
}
?>
