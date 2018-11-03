<?php 

/**
 *
 *
 *		@Package Autobody
 *
 *
 */

namespace Inc\Base;
use Inc\Base\Database;


 class Activate{

 	public static function activate(){
 		flush_rewrite_rules();


 		if(get_option('Autobody_settings')){
 			return;
 		}

 		$default = array();
 		update_option('Autobody_settings' , $default );

 		self::createDatabase();
 	}


 	public static function createDatabase(){
 		$database = new Database();
 		$database->createTable();
 	}
 }