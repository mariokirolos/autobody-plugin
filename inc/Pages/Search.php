<?php 

/**
 *
 *
 *		@Package Autobody
 *
 *
 */

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Base\BaseController;



class Search extends BaseController {

	public $settings;
	public $admin_subpages;
	public $AdminCallbacks;

	public function register(){

		//Check if multisite is on and this feature is allowed
		if(is_multisite()){
			$multisiteOption = get_site_option('Autobody_Network_group');
			if(!($multisiteOption['autobody_search'] == 1))
				return;
		}


		$option = get_option('Autobody_group');

		$activated = (isset($option['autobody_search'])) ? $option['autobody_search']  : false ;

		if(!$activated)
			return false;

		$this->settings = new SettingsApi();
		$this->AdminCallbacks = new AdminCallbacks();
		
		$this->adminSubpages();

		$this->settings->addSubPages($this->admin_subpages)->register();


		add_shortcode( 'autobody_searchbox', array($this , 'autobody_searchbox' ) );
	}

	function autobody_searchbox(){
		return '<div id="searchForm"><div class="input-group mb-3">'.
	  					'<input type="text"  class="form-control" placeholder="Search for Fruits" aria-label="Username" aria-describedby="basic-addon1" name="autobody_search" id="autobody_search" />'.
	  					'<input type="hidden" name="wp_nonce" id="wp_nonce" value="'. wp_create_nonce('search_autobody') .'" />'.
	  					'<div class="input-group-append">'.
	    					'<button class="btn btn-primary" id="AddButton" type="button" disabled="disabled">Add</button>'.
	  					'</div>'.
					'</div>'.
					'<div id="message"></div></div>';
	}


	function adminSubpages(){
		$this->admin_subpages = array(
			array(
				'parent_slug'	=> 'Autobody',
				'page_title'	=> 'Search' ,
				'menu_title'	=> 'Search',
				'capability'	=> 'manage_options' ,
				'menu_slug'		=> 'autobody_search',
				'call_back'		=> array( $this->AdminCallbacks , 'searchDashboard')

			)
		);
	}

}