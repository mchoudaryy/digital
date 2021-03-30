<?php
        session_start();
        //echo $_SESSION['html'];
      require('./converter/WriteHTML.php');
        $month = $_POST['month'];
        $year = $_POST['year'];
        $groupby = $_POST['groupby'];
        $pdf=new PDF_HTML();
        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->AddPage();
        $pdf->Image('logo.jpg',18,13,33);
        $pdf->SetFont('Arial','B',14);
        $pdf->WriteHTML("<br><br><br><br><table align='center'><tr><td align='center'><b>Impressions Monthly Report</b></td></tr></table><br><br><br>");
        $pdf->WriteHTML3("<table><tr><td>Month:</td><td>$month</td><td>       </td><td>Year: </td><td>$year</td><td>       </td><td>Group by: </td><td>$groupby</td></tr></table><br><br>");
        $pdf->SetFont('Arial','B',14);
        $pdf->SetFont('Arial','B',7);
        $pdf->WriteHTML2($_SESSION['html']."<br><table align='center'><tr><td align='center'><b>© All rights reserved | Digital Ad Media Limited |</b></td></tr></table>");
        $pdf->SetFont('Arial','B',6);
        $pdf->Output(); 
?>