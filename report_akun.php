<?php
		include 'lib/Database.php';
		include "fpdf/fpdf.php";


        class PDF extends FPDF
        {
            function Header()
            {
                $this->SetFont('Arial','B',13);
                // Move to the right
                $this->Cell(150);
                // Title
                $this->Cell(80,10,'Daftar Akun',1,0,'C');
                // Line break
                $this->Ln(20);
            }
            
            // Page footer
            function Footer()
            {
                // Position at 1.5 cm from bottom
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial','I',8);
                // Page number
                $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
            }
        }

		$no = 1;
        $link = new Database();
		$sql = "SELECT * FROM tbl_users ORDER BY id  DESC";
        $stmt = $link->pdo->prepare($sql);
        $stmt->execute();

		//cetak
		// Instanciation of inherited class
        $pdf = new PDF('P','mm',array(300,285));
        //header
        $pdf->AddPage();
        //foter page
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial','B',12);
        $pdf->Ln(10);//Ln = pindah baris
        $pdf->Cell(10,10,'NO','1');
        $pdf->Cell(70,10,'Nama Akun','1');
		$pdf->Cell(50,10,'Email','1');
		$pdf->Cell(70,10,'No. Tlp','1');
        $pdf->Cell(65,10,'Alamat','1');
        $pdf->Ln(10);
        while($data = $stmt->fetch()){

			$pdf->Cell(10,10,  $no, 1);
            $pdf->Cell(70,10, $data["name"],1);
			$pdf->Cell(50,10,  $data["email"],1);
			$pdf->Cell(70,10,  $data["mobile"],1);
            $pdf->Cell(65,10,  $data["fld_address"],1);

			$pdf->Ln(10);
			$no++;

		}
        $pdf->Ln();
        $pdf->Output('D','Report-Akun.pdf');
