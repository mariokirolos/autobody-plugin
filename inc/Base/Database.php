<?php 

/**
 *
 *
 *      @Package Autobody
 *
 *
 */

namespace Inc\Base;

use Inc\Base\BaseController;

class Database extends BaseController{

	public function register(){
		
	}

	public function createTable(){
	
	$charset_collate = $this->wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $this->base_table_name (
		id mediumint(3) NOT NULL AUTO_INCREMENT,
		name varchar(55) DEFAULT '' NOT NULL,
		date_created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  		ip_address varchar(20) NOT NULL ,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	}


	public function removeTable(){
     $sql = "DROP TABLE IF EXISTS $this->base_table_name";
     $this->wpdb->query($sql);
     delete_option("my_plugin_db_version");
	}


	public function getList($orderBy =  'date_created'){
		$sql = "SELECT `id`,`name`,`date_created` FROM $this->base_table_name ORDER BY $orderBy DESC";

		return $this->wpdb->get_results($sql);
	}

}