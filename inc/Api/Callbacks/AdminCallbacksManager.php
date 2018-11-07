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

			print_r($manager);

			switch ($manager['fieldType']){
				case 'TextField':
					$output[$manager['name']] =  $this->checkTextBox($input[$manager['name']]);
				break;
				case 'CheckBoxField':
					$output[$manager['name']] =  $this->checkboxSanitize($input[$manager['name']]);
				break;
				case 'mediaUpload':
					$output[$manager['name']] =  $this->mediaSanitize($input[$manager['name']]);
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

 	public function mediaSanitize($input){
 		// Will do all the work here
 		return $input;
 	}



 	public function AutobodyNetworkAdminSection(){
 		echo 'Manage All the websites from single action here, Please note that if you disable the feature from here it will be disabled from all the websites';
 	}


 	public function AutobodyAdminSection(){
 		echo 'Manage the sections you need to be activated for your awesome web application.';
 	}



 	public function AutobodyUploadSection(){
 		echo 'Upload your image to be converted into text from here';
 	}

 	public function TextField( $args ){

 		$multisiteValue = '';
 		$name = $args['label_for'];

		//Check if the option name is the api to check the super admin api key
 		if($name == 'autobody_ocr_api' && is_multisite()){
 			$multisiteOption = get_site_option('Autobody_Network_group');
			$multisiteValue = $multisiteOption['autobody_ocr_api'];
 		}



 		$option_name = $args['option_name'];
 		$class = $args['class'];
 		$placeholder = $args['placeholder'];
 		$value = get_option( $option_name );
		// Check if the textbox is there in the database. to remove the conflict of the first time install.
 		$textValue = (!empty($value[$name])) ? $value[$name] : $multisiteValue;


 		echo '<input type="text" name="'. $option_name .'['. $name .']" id="'. $name .'" value="'. $textValue  .'" placeholder="'. $placeholder .'" /><p class="description">'. $args['desc'] .'</p>';
 	}

 	public function CheckBoxField( $args ){

 		$option_name = $args['option_name'];
 		$name = $args['label_for'];
 		$class = $args['class'];
 		$value = get_option( $option_name );

 		// Check if the checkbox is there in the database. to remove the conflict of the first time install.
 		$checkBoxAv = (isset($value[$name])) ? ($value[$name] ? 'checked' : false ) : false;

 		echo '<div class="'. $class . ' ' .$args['disabled'] . '"><input type="checkbox" id="'. $name .'" name="'. $option_name .'['. $name .']" value="1" '. $args['disabled'] . $checkBoxAv .'  /><label for="'. $name .'"><div></div></label></div><p class="description">'. $args['desc'] ;

 			if($args['disabled'] == 'disabled') {
 				echo '<br /><span style="color:red;font-style:italic">This feature is deactivated from the Super Admin.</span>' ;
 			}

 		echo '</p>';
 	}

 	public function mediaUpload(){
 		echo "God is Love";
 	}


}
