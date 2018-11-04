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
 	public $base_OCR_table;
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
		$this->base_OCR_table = 'autobody_ocr';


		$this->managers = array(
				array('option_name' => 'Autobody_group' , 'name' => 'autobody_search' , 'type'=>'handleInput' , 'fieldType' => 'CheckBoxField' , 'title' => 'Search' , 'class' => 'ui-toggle'),
				array('option_name' => 'Autobody_group' , 'name' => 'autobody_ocr' , 'type'=>'handleInput' , 'fieldType' => 'CheckBoxField' , 'title' => 'OCR' , 'class' => 'ui-toggle','desc'=> 'In order to activate the OCR you will need to specify the API Key'),
				array('option_name' => 'Autobody_group' , 'name' => 'autobody_ocr_api' , 'type'=>'handleInput' , 'fieldType' => 'TextField' , 'title' => 'OCR API Key' , 'class' => '','desc'=> 'Kindly put your API Key here for the OCR to work properly' , 'placeholder'=> 'Place your API here'),

		);

	}

 }