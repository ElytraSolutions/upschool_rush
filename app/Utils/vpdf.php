<?php

namespace App\Utils\fpdf186;

function generatePDF($user, $course)
{
    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddFont('GoodVibrations', '', 'GoodVibrations-Script-400.php');
    $pdf->AddFont('NunitoSans', 'B', 'NunitoSans_10pt-SemiBold.php');
    $pdf->AddFont('KumbhSans', '', 'KumbhSans-Regular.php');
    $pdf->AddPage();
    $pdf->SetMargins(0, 0, 0);

    $pdf->Image('../resources/Certificate_base.png', 0, 0, 210, 297);

    $pdf->Ln(125);

    $pdf->SetTextColor(3, 1, 76);
    $pdf->SetFont('GoodVibrations', '', '26');
    $pdf->Cell(0, 30, $user, 0, 1, 'C');

    $pdf->Ln(6);
    $pdf->SetFont('NunitoSans', 'B', '10.5');
    $pdf->SetTextColor(29, 14, 76);
    $pdf->Cell(0, 10, "\"$course\" course", 0, 1, 'C');
    return $pdf;
}
