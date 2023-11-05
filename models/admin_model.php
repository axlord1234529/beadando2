<?php

class Admin_Model
{
	private $data = array
	('new' => array('title' => 'New Website', 'content' => 'Welcome to the site!'),
	 'mvc' => array('title' => 'PHP MVC Framework', 'content' => 'works good'),
	 'default' => array('title' => 'Default Title', 'content' => 'default content'));
	
	public function get_data($title)
	{
		if(! array_key_exists($title, $this->data))
		{ $title = "default"; }
		$retData = $this->data[$title];
		return $retData;
	}

	public function init_data()
	{
		$conn = Database::getConnection();
		$filename = "D:\\xampp\htdocs\beadando2\models\szerelo.txt";
		$file = fopen($filename, "r");

		if ($file) {
			// Read the header line (column names)
			$header = fgetcsv($file, 0, "\t");
			
			// Loop through the rest of the file and insert data into the database
			while (($data = fgetcsv($file, 0, "\t")) !== false) {
				
				// Perform the SQL INSERT operation
				$sql = "INSERT INTO szerelo (az,nev,kezdev) VALUES ('','$data[1]', '$data[2]');";
				echo $sql."<br>";
				$conn->query($sql) === true;
			}
			fclose($file);
		} else {
			echo "Error opening file: $filename";
		}
	}
}

?>