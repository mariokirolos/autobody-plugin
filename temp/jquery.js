jQuery(document).ready(function($) 
{
    $('#wpse').click(function(e) 
    {
        e.preventDefault();
        var data = {
            action: 'process_reservation',
            nonce: myAjax.nonce
        };

        $.post( myAjax.url, data, function( response ) 
        {
            $('#wpse').html( response.data );
        });
    });
});