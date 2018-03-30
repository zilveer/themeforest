jQuery(document).ready(function ($) {
	jQuery('#templates-container').isotope();
	jQuery('.lp_select_template').click(function() {
		jQuery(".mceIframeContainer iframe#content_ifr").css("height", "100%");
		jQuery("#wp-content-editor-container .mceStatusbar").css("display", "none");
	});

	jQuery("#template-box a").live('click', function () {
		setTimeout(function() {
			jQuery('#TB_window iframe').contents().find("#customize-controls").hide();
			jQuery('#TB_window iframe').contents().find(".wp-full-overlay.expanded").css("margin-left", "0px");
		}, 1200);
	});

	// Fix Thickbox width
	jQuery(function($) {
	    tb_position = function() {
	        var tbWindow = $('#TB_window');
	        var width = $(window).width();
	        var H = $(window).height();
	        var W = ( 1720 < width ) ? 1720 : width;

	        if ( tbWindow.size() ) {
	            tbWindow.width( W - 50 ).height( H - 45 );
	            $('#TB_iframeContent').width( W - 50 ).height( H - 75 );
	            tbWindow.css({'margin-left': '-' + parseInt((( W - 50 ) / 2),10) + 'px'});
	            if ( typeof document.body.style.maxWidth != 'undefined' )
	                tbWindow.css({'top':'40px','margin-top':'0'});
	            //$('#TB_title').css({'background-color':'#fff','color':'#cfcfcf'});
	        };

	        return $('a.thickbox').each( function() {
	            var href = $(this).attr('href');
	            if ( ! href ) return;
	            href = href.replace(/&width=[0-9]+/g, '');
	            href = href.replace(/&height=[0-9]+/g, '');
	            $(this).attr( 'href', href + '&width=' + ( W - 80 ) + '&height=' + ( H - 85 ) );
	        });
	    };

	    jQuery('a.thickbox').click(function(){
	        if ( typeof tinyMCE != 'undefined' &&  tinyMCE.activeEditor ) {
	            tinyMCE.get('content').focus();
	            tinyMCE.activeEditor.windowManager.bookmark = tinyMCE.activeEditor.selection.getBookmark('simple');
	        }

	    });

	    $(window).resize( function() { tb_position() } );
	});
});