<?php 

/**
 *
 *
 *		@Package Autobody
 *
 *
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

 class AdminCallbacks extends BaseController{

 	public function adminDashboard(){
 		return require_once("$this->plugin_path/templates/admin.php");
 	}
 
 	public function searchDashboard(){
 		return require_once("$this->plugin_path/templates/search.php");	
 	}

 	public function OCRDashboard(){
 		return require_once("$this->plugin_path/templates/ocr.php");	
 	}

 	public function AutobodyOptionsGroup($input){
 		return $input;
 	}

 	public function AutobodyAdminSection(){
 		echo 'Please fill in your API that Autobody provided to you in order to make all the magic happen';
 	}

}
