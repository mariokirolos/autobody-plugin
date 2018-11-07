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


 class Network extends BaseController {

 	 public $settings;
 	 public $AdminCallbacks;
 	 public $Callbacks_mngr;
 	 public $admin_pages = array();
 	 public $managers = array();
     public $updated;
    /**
      * This method will be used to register
      * our custom settings admin page
      */
 
    public function register()
    {
    	//Register the admin page
       	add_action('network_admin_menu', array($this , 'networkAdminPages'));
       	//Update the Settings
		
		add_action('network_admin_menu', array($this , 'update'));
    }
 
   
	function networkAdminPages() {
		add_menu_page( "Autobody Plugin", "Autobody Plugin", 'manage_options', 'Autobody_Network', array($this , 'handleAutobody'));	
	}


	function handleAutobody(){

		$autobody_search = $this->getSettings('autobody_search');
		$autobody_ocr = $this->getSettings('autobody_ocr');
		$ocr_key = $this->getSettings('autobody_ocr_api');
		require_once($this->plugin_path .'templates/network.php');
	}
 
    /**
      * Check for POST (form submission)
      * Verifies nonce first then calls
      * updateSettings method to update.
      */
 
    public function update()
    {
        if ( isset($_POST['submit']) ) {
             
            // verify authentication (nonce)
            if ( !isset( $_POST['AutobodyNetwork_nonce'] ) )
                return;
 
            // verify authentication (nonce)
            if ( !wp_verify_nonce($_POST['AutobodyNetwork_nonce'], 'AutobodyNetwork_nonce') )
                return;
 
            return $this->updateSettings();
        }
    }
 
    /**
      * Updates settings
      */
 
    public function updateSettings()
    {
        $settings = array();


        $settings['autobody_search'] = (isset($_POST['autobody_search']) ) ? 1 : 0 ;
        $settings['autobody_ocr'] = (isset($_POST['autobody_ocr']) ) ? 1 : 0 ;
        $settings['autobody_ocr_api'] = (isset($_POST['autobody_ocr_api']) ) ? esc_html($_POST['autobody_ocr_api']) : '' ;
  
 
        if ( $settings ) {
            // update new settings
            update_site_option('Autobody_Network_group', $settings);
        } else {
            // empty settings, revert back to default
            delete_site_option('Autobody_Network_group');
        }
 
        $this->updated = true;
    }
 
    /**
      * Updates settings
      *
      * @param $setting string optional setting name
      */
 
    public function getSettings($setting='')
    {
        global $Autobody_Network_group;
 
        if ( isset($Autobody_Network_group) ) {
            if ( $setting ) {
                return isset($Autobody_Network_group[$setting]) ? $Autobody_Network_group[$setting] : null;
            }
            return $Autobody_Network_group;
        }
 
        $Autobody_Network_group = wp_parse_args(get_site_option('Autobody_Network_group'), array(
            'autobody_search' => 1,
            'autobody_ocr' => 1 , 
            'autobody_ocr_api'	=> null
        ));
 
        if ( $setting ) {
            return isset($Autobody_Network_group[$setting]) ? $Autobody_Network_group[$setting] : null;
        }
        return $Autobody_Network_group;
    }
}