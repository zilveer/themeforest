jQuery( document ).ready( function( $ ) {
    $('.metaboxes-tab').each(function(){
        $('.tabs-panel', this).hide();
        
        var active_tab = wpCookies.get( 'active_metabox_tab' );
        if ( active_tab == null ) {
            active_tab = $('ul.metaboxes-tabs li:first-child a', this).attr('href');
        } else {
            active_tab = '#' + active_tab;
        }
        
    	$( active_tab ).show();
        
    	$('.metaboxes-tabs a, this').click(function(e){
    	    if( $(this).parent().hasClass( 'tabs' ) ) {
                e.preventDefault();
    	        return;
    	    }
            
    		var t = $(this).attr('href');
    		$(this).parent().addClass('tabs').siblings('li').removeClass('tabs');
    		$('.tabs-panel').slideUp( 'fast' );
    		$(t).delay(350).slideDown( 'fast' );
    		
    		return false;
    	});
    });
} );