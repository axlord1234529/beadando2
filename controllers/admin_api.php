<?php

class Admin_Api_Controller
{
	public $baseName = 'admin_api';  
	public function main(array $vars) 
	{
		
		//bet�ltj�k a n�zetet
		$view = new View_Loader($this->baseName.'_main');
	}
}

?>