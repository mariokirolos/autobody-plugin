<?php 

class MyTheme
{
    public function __construct()
    {
        add_action( 'wp_footer', array( $this, 'aux_function' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'init_plugin' ) );
        add_action( 'wp_ajax_process_reservation', array( $this, 'process_reservation' ) ); 
        add_action( 'wp_ajax_nopriv_process_reservation', array( $this, 'process_reservation' ) );
    }

    public function aux_function()
    {
        echo '<h4><a href="#" id="wpse">TEST AJAX</a></h4>';
    }

    public function init_plugin()
    {
        wp_enqueue_script( 
            'ajax_script', 
            plugins_url( '/test.js',__FILE__ ), 
            array('jquery'), 
            TRUE 
        );
        wp_localize_script( 
            'ajax_script', 
            'myAjax', 
            array(
                'url'   => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce( "process_reservation_nonce" ),
            )
        );
    }

    public function process_reservation()
    {
        check_ajax_referer( 'process_reservation_nonce', 'nonce' );

        if( true )
            wp_send_json_success( 'Ajax here!' );
        else
            wp_send_json_error( array( 'error' => $custom_error ) );
    }
}
new MyTheme();