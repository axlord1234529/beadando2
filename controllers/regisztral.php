<?php

class Regisztral_Controller
{
	public $baseName = 'regisztral';  
	public function main(array $vars) 
	{
		$regisztralModel = new Regisztral_Model;

		$retData = $regisztralModel->get_data($vars);
		if($retData['eredmeny'] == "ERROR")
			$this->baseName = "belepes";
		
		$view = new View_Loader($this->baseName.'_main');

		foreach($retData as $name => $value)
			$view->assign($name, $value);
	}
}

?>