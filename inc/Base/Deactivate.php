<?php 

/**
 *
 *
 *		@Package Autobody
 *
 *
 */

namespace Inc\Base;

 class Deactivate{

 	public static function deactivate(){
 		flush_rewrite_rules();
 	}

 	//Remove the database tables data.
 }