<?php 

/**
 *
 *
 *		@Package Autobody
 *
 *
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

 class AdminCallbacksManager extends BaseController{


 	public function handleInputs($input){
 		$ouput = array();
		foreach($this->managers as $manager){
			switch ($manager['fieldType']){
				case 'TextField':
					$output[$manager['name']] =  $this->checkTextBox($input[$manager['name']]);
				break;
				case 'CheckBoxField':
					$output[$manager['name']] =  $this->checkboxSanitize($input[$manager['name']]);
				break;
			}



 		}

 		return $output;
 	}

 	public function checkTextBox($input){
 		return $input;
 	}
 	
 	public function checkboxSanitize( $input ){
 		return (isset($input) ? true : false);
 	}

 	public function AutobodyAdminSection(){
 		echo 'Manage the sections you need to be activated for your awesome web application.';
 	}

 	public function TextField( $args ){

 		$option_name = $args['option_name'];
 		$name = $args['label_for'];
 		$class = $args['class'];
 		$placeholder = $args['placeholder'];
 		$value = get_option( $option_name );
		// Check if the textbox is there in the database. to remove the conflict of the first time install.
 		$textValue = (isset($value[$name])) ? $value[$name] : false;

 		echo '<input type="text" name="'. $option_name .'['. $name .']" id="'. $name .'" value="'. $textValue  .'" placeholder="'. $placeholder .'" />';
 	}

 	public function CheckBoxField( $args ){
 		
 		$option_name = $args['option_name'];
 		$name = $args['label_for'];
 		$class = $args['class'];
 		$value = get_option( $option_name );

 		// Check if the checkbox is there in the database. to remove the conflict of the first time install.
 		$checkBoxAv = (isset($value[$name])) ? ($value[$name] ? 'checked' : false ) : false;

 		echo '<div class="'. $class .'"><input type="checkbox" id="'. $name .'" name="'. $option_name .'['. $name .']" value="1" '. $checkBoxAv .'  /><label for="'. $name .'"><div></div></label></div>';
 	}
}
