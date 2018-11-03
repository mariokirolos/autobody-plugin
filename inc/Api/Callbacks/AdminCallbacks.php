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
 
 	public function cptDashboard(){
 		return require_once("$this->plugin_path/templates/cpt.php");	
 	}
 

 	public function taxDashboard(){
 		return require_once("$this->plugin_path/templates/tax.php");	
 	}
 	
 	public function widgetsDashboard(){
 		return require_once("$this->plugin_path/templates/widgets.php");	
 	}

 	public function AutobodyOptionsGroup($input){
 		return $input;
 	}

 	public function AutobodyAdminSection(){
 		echo 'Please fill in your API that Autobody provided to you in order to make all the magic happen';
 	}

}
