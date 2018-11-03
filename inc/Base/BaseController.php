<?php 

/**
 *
 *
 *		@Package Autobody
 *
 *
 */

namespace Inc\Base;

 class BaseController{


 	public $plugin_path;
 	public $plugin_url;
 	public $plugin;
 	public $managers = array();
 	public $base_table_name;
 	public $wpdb;

// define('PLUGIN_PATH' , );
// define('PLUGIN_URL' , plugin_dir_url(__FILE__));
// define('PLUGIN' ,plugin_basename( __FILE__ ));

	function __construct(){
		global $wpdb;

		$this->plugin_path = plugin_dir_path( dirname(__FILE__ , 2) );
		$this->plugin_url = plugin_dir_url( dirname(__FILE__ , 2) );
		$this->plugin = plugin_basename(  dirname(__FILE__ , 3 ) ) . '/'  . plugin_basename(  dirname(__FILE__ , 3 ) ) . '.php' ;
		$this->wpdb = $wpdb;
		$this->base_table_name = 'autobody_search_terms';
	}

 }