<?php 
/**
 *
 *
 *		@Package Autobody
 *
 *
 */
/**
 *
 *	Plugin Name: Autobody Search Plugin
 *	Version: 1.0
 *	Description: This plugin will hold the main features that is required to run the custom functionalities requested to Autobody
 *	Author: Autobody
 *	Author URI: https://Autobody.com
 *	Plugin URI: https://Autobody.com/plugins/Autobody-plugin
 *	License: GPL2


 *	Autobody Plugin is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License as published by
 *	the Free Software Foundation, either version 2 of the License, or
 *	any later version.
 *	 
 *	Autobody Plugin is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *	GNU General Public License for more details.
 *	 
 *	You should have received a copy of the GNU General Public License
 *	along with Autobody Plugin. If not, see {License URI}.
 */


if(! defined ('ABSPATH')){
	die();
}


if(file_exists( dirname( __FILE__ ) . '/vendor/autoload.php')){
	require_once( dirname( __FILE__ ) . '/vendor/autoload.php');
}


//Register the Activate and deactivate 

function AutobodyActivate(){
	Inc\Base\Activate::activate();
}

function AutobodyDeactivate(){
	Inc\Base\Deactivate::deactivate();
}

//Register the activate Hook
register_activation_hook( __FILE__, 'AutobodyActivate' );

//Register the Deactivate Hook
register_deactivation_hook( __FILE__, 'AutobodyDeactivate' );


if( class_exists('Inc\\Init') ){
	Inc\Init::register_services();
}