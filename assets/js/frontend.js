$(document).ready(function(){


$("#autobody_search").autocomplete({
    source: function(request, response) {
        jQuery.ajax({
            url: Autobody.url,
            dataType: "json",
            type: 'POST',
            data: {
                term : request.term,
                search_fruits : 1,
                action:'SearchWord'
            },
            success: function(data) {
            	if(!data){
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
            url: url,
            dataType: "json",
            data: {
                term : $('#autobody_search').val(),
                add_fruits : 1
            },
            success: function(data) {
            	$('#message').hide();
            	
        		$('#message').text( $('#autobody_search').val()  + data.message).addClass(data.classesAdded);
            	
            	$('#message').slideDown().delay(3000).slideUp();
            	
            }
        });
	});


});