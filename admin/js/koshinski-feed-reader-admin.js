(function( $ ) {
	'use strict';
	
	$( window ).load(function() {
		if( $('#dashboard-reader .koshinski-feed-reader').hasClass('koshinski-invisible') ){
			/*$('#dashboard-reader').hide();*/
		}
        
        $(document).on('change', '#koshinski_feed_reader', function(e){
            $.ajax({
                url: koshinski_feed_reader.ajax_url,
                data: {
                    action: 'koshinski_feed_reader_action',
                    selection: this.options[this.selectedIndex].value,
                    nonce: koshinski_feed_reader.nonce
                },
                success: function(response){
                    $('#dashboard-reader-content').html(response);
                },
                error: function(response){
                  console.log('error'); 
                },
                type: 'post'
            });
        });
        
	});
		
})( jQuery );
