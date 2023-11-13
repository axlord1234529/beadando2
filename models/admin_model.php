<?php
include_once "services\mypdf.php";
class Admin_Model
{
	private $data = array
	('new' => array('title' => 'New Website', 'content' => 'Welcome to the site!'),
	 'mvc' => array('title' => 'PHP MVC Framework', 'content' => 'works good'),
	 'default' => array('title' => 'Default Title', 'content' => 'default content'));
	
	public function get_data($params = null)
	{
		// if(! array_key_exists($title, $this->data))
		// { $title = "default"; }
		// $retData = $this->data[$title];
		// return $retData;
		$retData = array();
		try {
			$conn = Database::getConnection();
			$sqlTelepulesek = "SELECT `telepules` FROM `hely` GROUP BY `telepules`;";
			$stmt = $conn->query($sqlTelepulesek);
			$telepulesek = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$sqlSzerelok = "SELECT DISTINCT `nev` FROM `szerelo`;";
			$stmt = $conn->query($sqlSzerelok);
			$szerelok = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$sqlMinDatum = "SELECT MIN(javdatum) FROM `munkalap`;";
			$stmt = $conn->query($sqlMinDatum);
			$minDatum = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$sqlMaxDatum = "SELECT MAX(javdatum) FROM `munkalap`;";
			$stmt = $conn->query($sqlMaxDatum);
			$maxDatum = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$retData['telepulesek'] = $telepulesek;
			$retData['szerelok'] = $szerelok;
			$retData['minDatum'] = $minDatum;
			$retData['maxDatum'] = $maxDatum;
		} catch (PDOException $e) {
			$retData['eredmény'] = "ERROR";
			$retData['uzenet'] = "Adatbázis hiba: ".$e->getMessage()."!";
		}
		return $retData;
	}

	public function get_munkalapok($nev,$telepules,$javdatum,$pdf = false)
	{
		try {
			$conn = Database::getConnection();

			$sql = 'SELECT bedatum,javdatum,hely.telepules,hely.utca,szerelo.nev,munkaora,anyagar FROM ((munkalap INNER JOIN hely ON hely.az = munkalap.helyaz) INNER JOIN szerelo ON munkalap.szereloaz = szerelo.az) WHERE hely.telepules = :telepules AND szerelo.nev = :nev AND javdatum = :javdatum;';
			$stmt = $conn->prepare($sql);

			$stmt->bindParam(':telepules', $telepules);
			$stmt->bindParam(':nev', $nev);
			$stmt->bindParam(':javdatum', $javdatum);
			if(!$pdf)
			{
				$stmt->execute();
				$munkalapok = $stmt->fetch(PDO::FETCH_ASSOC);

				return $munkalapok;
			}
			
			$stmt->execute();
			$munkalapok = $stmt->fetchAll(PDO::FETCH_NUM);

			return $munkalapok;
		
		} catch (PDOException $e) {
			return false;
		}
	}

	public function gen_pdf($nev,$telepules,$javdatum){
		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Kalmár Sándor');
		$pdf->SetTitle('MUNKALAP');
		$pdf->SetSubject('Web-programozás II - beadandó - TCPDF');
		$pdf->SetKeywords('TCPDF, PDF, munkalap');

		$pdf->SetHeaderData("", 0, "MUNKALAP", "Web-programozás II\nBeadandó 2\n".date('Y.m.d',time()));

		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		if (@file_exists(dirname(__FILE__).'/lang/hun.php')) {
			require_once(dirname(__FILE__).'/lang/hun.php');
			$pdf->setLanguageArray($l);
		}


		$pdf->SetFont('helvetica', 'B', 10);

		$pdf->AddPage();

		$caption = 'MUNKALAP';

		$header = array('Beadás dátum', 'Javítás Dátum', 'Település', 'Utca', 'Név','Munkaóra','Anyagár');

		$rows = $pdf->LoadData('vizvezetek_szerelok', 'munkalap',$nev,$telepules,$javdatum);
		$pdf->ColoredTable($caption, $header, $rows);

		$pdf->Output('Munkalap.pdf', 'D');
	}

	public function init_data()
	{
		$conn = Database::getConnection();
		$filename = "D:\\xampp\htdocs\beadando2\models\hely.txt";
		$file = fopen($filename, "r");

		if ($file) {
			// Read the header line (column names)
			$header = fgetcsv($file, 0, "\t");
			
			// Loop through the rest of the file and insert data into the database
			while (($data = fgetcsv($file, 0, "\t")) !== false) {
				
				// Perform the SQL INSERT operation
				$sql = "INSERT INTO hely (az,telepules,utca) VALUES ($data[0],'$data[1]', '$data[2]');";
				//echo $sql."<br>";
				$conn->query($sql) === true;
			}
			fclose($file);
		} else {
			echo "Error opening file: $filename";
		}
	}

	
}

?>