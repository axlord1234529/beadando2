<?php

class Elerhetoseg_Alapinfok_Model
{
	private $data = array
	('new' => array('title' => 'New Website', 'content' => 'Welcome to the site!'),
	 'mvc' => array('title' => 'PHP MVC Framework', 'content' => 'works good'),
	 'default' => array('title' => 'Default Title', 'content' => 'default content'));
	
	public function get_data()
	{
		// if(! array_key_exists($title, $this->data))
		// { $title = "default"; }
		// $retData = $this->data[$title];
		$retData = array();
		$anyagarak = $this->get_avarage_anyagar();
		if(count($anyagarak))
		{
			
			$retData["labels"] = $anyagarak['months'];
			$retData["data"] = $anyagarak['average_anyagarak'];
		}
		else
		{
			$retData['error'] = true;
			$retData['message'] = "Hiba a lekérdezéskor!";
		}
		return $retData;
	}

	private function get_avarage_anyagar()
	{
		try {
			$conn = Database::getConnection();
			$sql = "SELECT
			DATE_FORMAT(javdatum, '%Y-%m') AS month,
				AVG(anyagar) AS average_anyagar
			FROM
				munkalap
			GROUP BY
				month
			ORDER BY
				month;";
			
			$stmt = $conn->query($sql);
			$db_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$months = [];
			$average_anyagarak = [];

			foreach ($db_results as $item) {
				$months[] = $item["month"];
				$average_anyagarak[] = $item["average_anyagar"];
			}

			$result = ["months" => $months, "average_anyagarak" => $average_anyagarak];
			return $result;
		} catch (PDOException $eh) {
			return [];
		}
	}
}

?>