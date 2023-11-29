<?php

// namespace App\Utils\fpdf186;

require_once __DIR__ . '/fpdf186/FPDF.php';
require_once __DIR__ . '/FPDI/src/autoload.php';

function generatePDF($user, $course)
{

    $pdf = new \setasign\Fpdi\Fpdi();

    $pageCount = $pdf->setSourceFile(__DIR__ . '/../../resources/CertificateBase.pdf');
    $pageId = $pdf->importPage(1, \setasign\Fpdi\PdfReader\PageBoundaries::MEDIA_BOX);
    $pdf->AddFont('GoodVibrations', '', 'GoodVibrations-Script-400.php');
    $pdf->AddFont('GreatVibes', '', 'GreatVibes-Regular.php');
    $pdf->AddFont('NunitoSans', 'B', 'NunitoSans_10pt-SemiBold.php');
    $pdf->AddFont('KumbhSans', '', 'KumbhSans-Regular.php');
    $pdf->AddPage();
    $pdf->useImportedPage($pageId);
    $pdf->SetMargins(0, 0, 0);

    // $pdf->Image(__DIR__ . '../resources/Certificate_base.png', 0, 0, 210, 297);

    $pdf->Ln(107);

    $pdf->SetTextColor(3, 1, 76);
    $pdf->SetFont('GreatVibes', '', '32');
    $pdf->Cell(0, 30, $user, 0, 1, 'C');

    $pdf->Ln(2);
    $pdf->SetFont('NunitoSans', 'B', '10.5');
    $pdf->SetTextColor(29, 14, 76);
    $pdf->Cell(0, 5, 'for submitting a work task to Upschool indicating completion of the', 0, 1, 'C');
    $pdf->Cell(0, 10, "\"$course\" course", 0, 1, 'C');
    return $pdf;
}
