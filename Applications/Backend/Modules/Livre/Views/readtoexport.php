<?php
	require('lib/fpdf/fpdf.php');

	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->MultiCell(0, 10, "Liste des livres que vous avez lus", 1, "C", 0);
	$pdf->Ln();
	$pdf->SetFont('Arial','',12);

	foreach($livresList as $livre) 
  {
		$pdf->MultiCell(0, 5, utf8_decode($livre->nom().' ('.$livre->annee().') de '.$livre->auteurNom().' '. $livre->auteurPrenom())); 
		$pdf->Ln();
	}
	
	$pdf->Output();