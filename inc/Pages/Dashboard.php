<?php 

/**
 *
 *
 *		@Package Autobody
 *
 *
 */

namespace Inc\Pages;


use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\AdminCallbacksManager;


 class Dashboard extends BaseController {


 	 public $settings;
 	 public $AdminCallbacks;
 	 public $Callbacks_mngr;
 	 public $admin_pages = array();
 	 public $admin_subPages = array();


 	public function register(){
 		$this->settings = new settingsApi();
 		$this->AdminCallbacks = new AdminCallbacks();
 		$this->Callbacks_mngr = new AdminCallbacksManager();


 		$this->adminPages();

 		$this->setSettings();
 		$this->setSections();
 		$this->setFields();

		$this->settings->addPages($this->admin_pages)->withSubpage('Dashboard')->register();
 	}



 	function adminPages(){
		$this->admin_pages = [
 			[
 				'page_title' 	=> 'Autobody', 
 				'menu_title' 	=> 'Autobody', 
 				'capability' 	=> 'manage_options' , 
 				'menu_slug' 	=> 'Autobody', 
 				'call_back'		=> array($this->AdminCallbacks , 'adminDashboard') ,  
 				'icon_url'		=> 'dashicons-cart' , 
 				'position'		=> 110 
 			]
 		];
 	}

	function admin_index(){
		require_once( $this->plugin_path  . 'templates/admin.php');
	}

	function SetSettings(){
		$args = array();

		foreach($this->managers as $manager){
			$args[] = array(
				'option_group'	=> 'Autobody_group',
				'option_name'	=> $manager['option_name'],
				'callback'		=> array($this->Callbacks_mngr , $manager['type'])
			);
		}

		$this->settings->setSettings($args);
	}


	function SetSections(){
		$args = array(
			array(
				'id'			=> 'Autobody_Admin_section',
				'title'			=> 'Settings',
				'callback'		=> array($this->Callbacks_mngr , 'AutobodyAdminSection'),
				'page'			=> 'Autobody'
			)
		);

		$this->settings->setSections($args);
	}
	
	function SetFields(){

		$args = array();

		foreach($this->managers as $manager){


			$placeholder = (isset($manager['placeholder'])) ? $manager['placeholder'] : '';
			$desc = (isset($manager['desc'])) ? $manager['desc'] : '';

			$args[] = array(
				'id'			=> $manager['name'] , //Same as Option Name
				'title'			=> $manager['title'],
				'page'			=> 'Autobody' , 
				'section'		=> 'Autobody_Admin_section' , 	//Same as Section ID
				'args'			=> array(
									'label_for'		=>		$manager['name'] , 
									'class'			=>		$manager['class'],
									'placeholder'	=>		$placeholder,
									'option_name'	=>		$manager['option_name'],
									'desc'			=>		$desc
				),
				'callback'		=> array($this->Callbacks_mngr , $manager['fieldType']),
				
			);
		}
		
		$this->settings->setFields($args);
	}

 }