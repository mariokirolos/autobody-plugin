$(document).ready(function(){


$("#autobody_search").autocomplete({
    
    source: function(request, response) {
        jQuery.ajax({
            url: Autobody.url,
            dataType: "json",
            type: 'POST',
            data: {
                term : request.term,
                action:'SearchWord',
                nonce: $('#wp_nonce').val()
            },
            success: function(data) {
            	if(jQuery.isEmptyObject(data)){
            		$('#AddButton').prop('disabled', false);
            	}else{
            		response(data);	
            		$('#AddButton').prop('disabled', true);
            	}
            	
            },
            failure: function(data){
                console.log('Error');
            }
        });
    },
    min_length: 1,
    delay: 300
    
});


	$("#AddButton").on('click' , function(){
 		$.ajax({
            url: Autobody.url,
            dataType: "json",
            type: 'POST',
            data: {
                term : $('#autobody_search').val(),
                action:'AddWord',
                nonce: $('#wp_nonce').val()
            },
            success: function(data) {
            	$('#message').hide();
            	
        		$('#message').html(data.message).addClass(data.classesAdded);
            	
            	$('#message').slideDown().delay(3000).slideUp();
            	
            }
        });
	});


});