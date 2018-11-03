<?php 

/**
 *
 *
 *		@Package Autobody
 *
 *
 */

namespace Inc\Functions;

use Inc\Base\BaseController;

class searchAPI extends BaseController {

	public function register(){
		add_shortcode( 'autobody_searchbox', array($this , 'autobody_searchbox' ) );
		add_filter( 'template_include', array( $this , 'autobody_template_chooser'));
	}

	function autobody_searchbox(){
		return '<div class="input-group mb-3">'.
	  					'<input type="text"  class="form-control" placeholder="Search for Fruits" aria-label="Username" aria-describedby="basic-addon1" name="autobody_search" id="autobody_search" />'.
	  					'<div class="input-group-append">'.
	    					'<button class="btn btn-primary" id="AddButton" type="button" disabled="disabled">Add</button>'.
	  					'</div>'.
					'</div>'.
					'<div id="message"></div>';
	}

	/**
	 * Returns template file
	 *
	 * @since 1.0
	 */
	function autobody_template_chooser( $template ) {
	    
	    // For all other CPT
	    if ( basename(get_permalink()) != 'search-page' ) {
	        return $template;
	    }
	 
	    // Else use custom template
	    if ( is_singular() ) {
	        return self::autobody_get_template_hierarchy( 'front-end' );
	    }
	}


	/**
	 * Get the custom template if is set
	 *
	 * @since 1.0
	 */
	function autobody_get_template_hierarchy( $template ) {
	 
	    // Get the template slug
	    $template_slug = rtrim( $template, '.php' );
	    $template = $template_slug . '.php';
	 
	    // Check if a custom template exists in the theme folder, if not, load the plugin template file
	    if ( $theme_file = locate_template( array( 'plugin_template/' . $template ) ) ) {
	        $file = $theme_file;
	    }
	    else {
	        $file = $this->plugin_path . '/templates/' . $template;
	    }

	 	return $file;
	}
}