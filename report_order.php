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
                $this->Cell(80,10,'Daftar Order',1,0,'C');
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
		$sql = "SELECT * FROM tbl_order ORDER BY order_id  DESC";
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
        $pdf->Cell(70,10,'Nama Produk','1');
        $pdf->Cell(50,10,'Nama Penjual','1');
		$pdf->Cell(20,10,'Jumlah','1');
		$pdf->Cell(50,10,'Nama Pembeli','1');
        $pdf->Cell(65,10,'Status','1');
        $pdf->Ln(10);
        while($data = $stmt->fetch()){

			$pdf->Cell(10,10,  $no, 1);
            $pdf->Cell(70,10, $data["nproduk"],1);
            $pdf->Cell(50,10, $data["penjual"],1);
			$pdf->Cell(20,10,  $data["jumlah"],1);
			$pdf->Cell(50,10,  $data["npembeli"],1);
            $pdf->Cell(65,10,  $data["status"],1);

			$pdf->Ln(10);
			$no++;

		}
        $pdf->Ln();
        $pdf->Output('D','Report-Order.pdf');
