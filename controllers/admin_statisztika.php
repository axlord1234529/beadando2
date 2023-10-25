<?php

class Admin_Statisztika_Controller
{
	public $baseName = 'admin_statisztika';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
		$testModel = new Test_Model;  //az oszt�lyhoz tartoz� modell
		//modellb�l lek�rdezz�k a k�rt adatot
		if(! isset($vars[0])) $vars[0] = "";
		$reqData = $testModel->get_data($vars[0]); 
		//bet�ltj�k a n�zetet
		$view = new View_Loader($this->baseName.'_main');
		//�tadjuk a lek�rdezett adatokat a n�zetnek
		$view->assign('title', $reqData['title']);
		$view->assign('content', $reqData['content']);
	}
}

?>