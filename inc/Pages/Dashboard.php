<?php 

/**
 *
 *
 *		@Package Autobody
 *
 *
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\AdminCallbacksManager;


 class Dashboard extends BaseController {


 	 public $settings;
 	 public $AdminCallbacks;
 	 public $Callbacks_mngr;
 	 public $admin_pages = array();
 	 //public $admin_subPages = array();

 	public function register(){
 		$this->settings = new settingsApi();
 		$this->AdminCallbacks = new AdminCallbacks();
 		$this->Callbacks_mngr = new AdminCallbacksManager();

 		$this->adminPages();
 		//$this->adminSubPages();
 		

 		$this->setSettings();
 		$this->setSections();
 		$this->setFields();

		$this->settings->addPages($this->admin_pages)->withSubpage('Dashboard')->register();
		//->addSubPages($this->admin_subPages)
 	}



 	function adminPages(){
		$this->admin_pages = [
 			[
 				'page_title' 	=> 'Autobody Search', 
 				'menu_title' 	=> 'Autobody Search', 
 				'capability' 	=> 'manage_options' , 
 				'menu_slug' 	=> 'Autobody', 
 				'call_back'		=> array($this->AdminCallbacks , 'adminDashboard') ,  
 				'icon_url'		=> $this->plugin_url .  'assets/images/AutobodyIcon.png' , 
 				'position'		=> 110 
 			]
 		];
 	}


 	// function adminSubPages(){
 	// 	$this->admin_subPages = [
 	// 		[
 	// 			'parent_slug'	=> 'Autobody',
 	// 			'page_title' 	=> 'CPT manager', 
 	// 			'menu_title' 	=> 'CPT', 
 	// 			'capability' 	=> 'manage_options' , 
 	// 			'menu_slug' 	=> 'Autobody_cpt', 
 	// 			'call_back'		=> array($this->AdminCallbacks , 'cptDashboard') ,  
 	// 		],[
 	// 			'parent_slug'	=> 'Autobody',
 	// 			'page_title' 	=> 'Tax manager', 
 	// 			'menu_title' 	=> 'TAX', 
 	// 			'capability' 	=> 'manage_options' , 
 	// 			'menu_slug' 	=> 'Autobody_tax', 
 	// 			'call_back'		=> array($this->AdminCallbacks , 'taxDashboard') ,  
 	// 		],[
 	// 			'parent_slug'	=> 'Autobody',
 	// 			'page_title' 	=> 'Custom Widgets', 
 	// 			'menu_title' 	=> 'Custom Widgets', 
 	// 			'capability' 	=> 'manage_options' , 
 	// 			'menu_slug' 	=> 'Autobody_widgets', 
 	// 			'call_back'		=> array($this->AdminCallbacks , 'widgetsDashboard') ,  
 	// 		],
 	// 	];

 	// }


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
			$args[] = array(
				'id'			=> $manager['name'] , //Same as Option Name
				'title'			=> $manager['title'],
				'callback'		=> array($this->Callbacks_mngr , $manager['fieldType']),
				'page'			=> 'Autobody' , 
				'section'		=> 'Autobody_Admin_section' , 	//Same as Section ID
				'args'			=> array(
									'label_for'		=>		$manager['name'] , 
									'class'			=>		$manager['class'],
									'placeholder'	=>		'Place your API here',
									'option_name'	=>		$manager['option_name']
				)
			);
		}
		$this->settings->setFields($args);
	}

 }