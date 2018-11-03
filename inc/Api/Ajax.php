<?php 

/**
 *
 *
 *      @Package Autobody
 *
 *
 */

namespace Inc\Api;

use Inc\Base\BaseController;
use Inc\Base\Database;


class Ajax extends BaseController{
    public $database;
    public function register(){
        $this->database = new Database();

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'wp_ajax_addWord', array( $this, 'addWord' ) ); 
        add_action( 'wp_ajax_nopriv_addWord', array( $this, 'addWord' ) );
        add_action( 'wp_ajax_SearchWord', array( $this, 'SearchWord' ) ); 
        add_action( 'wp_ajax_nopriv_SearchWord', array( $this, 'SearchWord' ) );
    }


    public function addWord(){
        check_ajax_referer( 'addWord_nonce', 'nonce' );
        if( true )
            wp_send_json_success( 'Ajax here!' );
        else
            wp_send_json_error( array( 'error' => $custom_error ) );
    }

    public function SearchWord(){

        check_ajax_referer( 'SearchWord_nonce', 'nonce' );
        if( true )
            wp_send_json_success( 'Ajax here!' );
        else
            wp_send_json_error( array( 'error' => $custom_error ) );

        check_ajax_referer( 'check_nonce', 'nonce' );
        if( true )
            wp_send_json_success( 'Ajax here!' );
        else
            wp_send_json_error( array( 'error' => $custom_error ) );


    //     if(!isset($_GET['term']))
    //         return;
    // $term=$_GET["term"];

    // $fruits = $this->wpdb->get_results('SELECT * FROM '. $this->base_table_name .' WHERE `name` LIKE "' . $term .'%"'  );

    //     foreach($fruits as $fruit){
    //         $json[]=array( 'value'=> $fruit->name );
    //     }

    // echo json_encode($json);
    // die();
    }


    public function enqueue_scripts(){
        wp_enqueue_script('AutobodyJs' , $this->plugin_url . 'assets/js/frontend.js' , __FILE__ );

        wp_localize_script('AutobodyJs', 'Autobody', array(
            'nonce' => wp_create_nonce ( 'check_nonce' ) ,
            'url'   => admin_url( 'admin-ajax.php' ),
        ));
    }

}