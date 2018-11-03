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
	}

	function autobody_searchbox(){
		return '<div id="searchForm"><div class="input-group mb-3">'.
	  					'<input type="text"  class="form-control" placeholder="Search for Fruits" aria-label="Username" aria-describedby="basic-addon1" name="autobody_search" id="autobody_search" />'.
	  					'<input type="hidden" name="wp_nonce" id="wp_nonce" value="'. wp_create_nonce('search_autobody') .'" />'.
	  					'<div class="input-group-append">'.
	    					'<button class="btn btn-primary" id="AddButton" type="button" disabled="disabled">Add</button>'.
	  					'</div>'.
					'</div>'.
					'<div id="message"></div></div>';
	}

}