<?php

class Elerhetoseg_alapinfok_Controller
{
	public $baseName = 'elerhetoseg_alapinfok';  
	public function main(array $vars) 
	{
		$view = new View_Loader($this->baseName."_main");
		$model = new Elerhetoseg_Alapinfok_Model;
		$reqData = $model->get_data();
		$view->assign('labels',$reqData['labels']);
		$view->assign('data',$reqData['data']);
	}
}

?>