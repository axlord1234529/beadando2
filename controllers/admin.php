<?php

class Admin_Controller
{
	public $baseName = 'admin';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
		$adminModel = new Admin_Model;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if(isset($_POST["szerelo"]) && isset($_POST["telepules"]) && isset($_POST["datum"]))
			{
				$nev = $_POST["szerelo"];
				$telepules = $_POST["telepules"];
				$datum = $_POST["datum"];

				if(isset($_POST['pdf'])){
					$adminModel->gen_pdf($nev,$telepules,$datum);
				}
				else
				{
					$result = $adminModel->get_munkalapok($nev, $telepules, $datum);

					header("HTTP/1.1 200 OK");
					header('Content-Type: application/json');
					echo json_encode($result);
				}
			}
		}
		else
		{
			$view = new View_Loader($this->baseName.'_main');
			
			$reqData = $adminModel->get_data(); 
			
			$view->assign('telepulesek', $reqData['telepulesek']);
			$view->assign('szerelok', $reqData['szerelok']);
			$view->assign('minDatum', array_shift($reqData['minDatum'][0]));
			$view->assign('maxDatum', array_shift($reqData['maxDatum'][0]));
			
		}
	}
}

?>