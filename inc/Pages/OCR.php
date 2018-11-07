<?php 

/**
 *
 *
 *		@Package Autobody
 *
 *
 */

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\AdminCallbacksManager;


class OCR extends BaseController {

	public $settings;
	public $admin_subpages;
	public $AdminCallbacks;
	public $Callbacks_mngr;

	public function register(){

		//Check if multisite is on and this feature is allowed
		if(is_multisite()){
			$multisiteOption = get_site_option('Autobody_Network_group');
			if(!($multisiteOption['autobody_ocr'] == 1))
				return;
		}



		$option = get_option('Autobody_group');

		$activated = (isset($option['autobody_ocr'])) ? $option['autobody_ocr']  : false ;

		if(!$activated)
			return false;

		$this->settings = new SettingsApi();
		$this->AdminCallbacks = new AdminCallbacks();
		$this->Callbacks_mngr = new AdminCallbacksManager();


		$this->adminSubpages();

		$this->settings->addSubPages($this->admin_subpages)->register();


		add_action('admin_init' , array($this , 'handleUpload' ) );

	}

	function adminSubpages(){
		$this->admin_subpages = array(
			array(
				'parent_slug'	=> 'Autobody',
				'page_title'	=> 'OCR' ,
				'menu_title'	=> 'OCR',
				'capability'	=> 'manage_options' ,
				'menu_slug'		=> 'autobody_ocr',
				'call_back'		=> array( $this->AdminCallbacks , 'OCRDashboard')

			)
		);
	}

	public function handleUpload(){
		if(!isset($_FILES['uploadOCR'])){
			return;
		}

		// Do security check
		if ( 
		isset( $_POST['ocr_upload_nonce']) 
		&& wp_verify_nonce( $_POST['ocr_upload_nonce'], 'ocr_upload' )
		):



		$file = $_FILES['uploadOCR'];

		$check = $this->checkupload($file);

		if($check['status'] === false){
			print'<div id="message" class="error">'. $check['message'] .'</div>';
			exit();
		}


		$upload = media_handle_upload('uploadOCR' , 0 );

		if(is_wp_error( $upload )){
			echo "Error uploading file: " . $upload->get_error_message();
		}else{
			if($convertedText = $this->APIData($upload)){

				$insertToDB = $this->Insert( $upload , $convertedText);
				if($insertToDB === true){
					//Will Redirect to the Table
				}
			}else{
				die('Error Parsing the file, Please try again later');
			}

		}

		endif;//Check the nonce

	}


	public function Insert($file_id , $text ){
			$id = get_current_blog_id();

			$thumb = wp_get_attachment_image_src($file_id , 'thumbnail');
			$org = wp_get_attachment_image_src($file_id , 'original');

			$this->wpdb->insert( $this->base_OCR_table, array(
										'file_id' => $file_id , 
										'blog_id' => $id , 
										'thumb_image_src' =>  $thumb[0] ,
										'full_image_src' =>	$org[0] ,
	    								'convertedText' => $text , 
	    								'ip_address' => $_SERVER['REMOTE_ADDR']
			));

	}

	public function checkupload($file){
		$return['status'] = true;
		$return['message'] = '';
	    $FileType = strtolower(pathinfo($file["name"],PATHINFO_EXTENSION));
	    // Check file size
	    if ($file["size"] > 5000000) {
	    	$return['status'] = false;
	        $return['message'] = 'Sorry, your file is too large.';
	    }
	    //Check Allowed Extensions
	    if($FileType != "pdf" && $FileType != "png" && $FileType != "jpg") {
	    	$return['status'] = false;
	        $return['message'] = 'Sorry, please upload a supported file';
	        
	    }

	    return  $return;

	}


	public function APIData($id){
		ob_start();
		//Check if there is an API saved

		$option = get_option('Autobody_group');

		$api = (isset($option['autobody_ocr_api'])) ? $option['autobody_ocr_api']  : false ;

		if(!$api)
			return false;

		//Get the URL of the uploaded file
		$url = wp_get_attachment_image_src($id , 'original');


		//Convert here the image into text 
		if(file_exists( dirname( __FILE__ , 3  ) . '/assets/vendor/autoload.php')){
			require_once( dirname( __FILE__  , 3) . '/assets/vendor/autoload.php');
		}

	    $fileData = fopen($url[0], 'r');

	    $client = new \GuzzleHttp\Client();
	    try {
		    $r = $client->request('POST', 'https://api.ocr.space/parse/image',[
		        'headers' => ['apiKey' => esc_attr( $api ) ],
		        'multipart' => [
		            [
		                'name' => 'file',
		                'contents' => $fileData
		            ]
		        ]
		    ], ['file' => $fileData]);
		    $response =  json_decode($r->getBody(),true);
		    if($response['ErrorMessage'] == "") {
		    	 foreach($response['ParsedResults'] as $pareValue) {
		                    $returnTxt .= $pareValue['ParsedText'];
		                }
		    } else {
		        header('HTTP/1.0 400 Forbidden');
		        die($response['ErrorMessage']);
		    }
	    } catch(Exception $err) {
	        header('HTTP/1.0 403 Forbidden');
	        die($err->getMessage());
	    }
		//Return Text
		return $returnTxt;
	}

}