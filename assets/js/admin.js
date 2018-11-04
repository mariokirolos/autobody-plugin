window.addEventListener("load" , function(){

	//Store tabs variables
	var tabs = document.querySelectorAll('ul.nav-tabs > li');


	for(i = 0 ; i < tabs.length; i++){
		tabs[i].addEventListener("click" , switchTab);
	}


	function switchTab(event){
		document.querySelector('ul.nav-tabs li.active').classList.remove('active');
		document.querySelector('.tab-pane.active').classList.remove('active');
	
		var clickedTab = event.currentTarget;
		var anchor = event.target;
		var activePaneID = anchor.getAttribute('href');

		event.preventDefault();
		clickedTab.classList.add('active');
		document.querySelector(activePaneID).classList.add("active");
	}

});


$ = jQuery;

$(document).ready(function(){
	$('#uploadOCRBTN').attr('disabled' , true);
	$(document).on('change' , '#uploadOCR' , function(){
		//Always keep the button disabled
		$('#uploadOCRBTN').attr('disabled' , true);
		$('#message').html('').removeClass('error');

		var errors = [];
		
		$file = $('#uploadOCR').val();
		$extension = $file.replace(/^.*\./, '');

 		if ($extension == $file) {
            extension = '';
        } else {
            // if there is an extension, we convert to lower case
            // (N.B. this conversion will not effect the value of the extension
            // on the file upload.)
            $extension = $extension.toLowerCase();
        }

        switch ($extension) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'pdf':
            	//Accepted Extention;
          	break;

            default:
            //Always keep the button disabled
               errors.push('Please Upload file in these extensions <i>jpg, jpeg, png, pdf</i>');
        }



        if(this.files[0].size > 5000000) {
	       errors.push('File size should be less than 5MB');
	       $(this).val('');
	     }





		if (errors.length > 0) {
		    $('#message').addClass('error');

		    $.each( errors , function(index , value) {
			    $('#message').append('<li>' + value + '</li>');
			});

		}
		else {
			//All set, ready to submit
		 	$('#uploadOCRBTN').attr('disabled' , false);
		}
	});

});