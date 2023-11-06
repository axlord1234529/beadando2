<?php

class Admin_Controller
{
	public $baseName = 'admin';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
		$testModel = new Admin_Model;  //az oszt�lyhoz tartoz� modell
		//modellb�l lek�rdezz�k a k�rt adatot
		// if(! isset($vars[0])) $vars[0] = "";
		// $reqData = $testModel->get_data($vars[0]); 
		//bet�ltj�k a n�zetet
		$view = new View_Loader($this->baseName.'_main');
		//�tadjuk a lek�rdezett adatokat a n�zetnek
		$reqData = $testModel->get_data(); 
		$view->assign('telepulesek', $reqData['telepulesek']);
		$view->assign('szerelok', $reqData['szerelok']);
		$view->assign('minDatum', array_shift($reqData['minDatum'][0]));
		$view->assign('maxDatum', array_shift($reqData['maxDatum'][0]));
	}
}

?>