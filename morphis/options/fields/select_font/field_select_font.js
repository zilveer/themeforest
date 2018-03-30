jQuery(document).ready(function($) {

	var google_font_select = {
			
		font_previewer: function( el ) {
			
			var _self = this;
			font_face = el.val();
			font_face_kit = false;
			previewer = el.next('.google-font-previewer');
			loading_graphic = previewer.find('.loading');
			preview_font = previewer.find('h1');
	
			// check if this is a font face kit
			if( font_face.indexOf('fontface') != -1 ) {
			
				font_face_family = font_face.split('-')[1];
				font_face_weight = '400';
				font_face_style = 'normal';
				font_face_kit = true;
				fontFile = google_api_key_localize.path + font_face_family + "/" + font_face_family + "-webfont";
				
				fontFace = [
						"@font-face {",
							"\tfont-family: \"" + font_face_family + "\";",
							"\tsrc: url('" + fontFile + ".eot');",
							"\tsrc: local('?'), url('" + fontFile + ".woff') format('woff'), url('" + fontFile + ".ttf') format('truetype'), url('" + fontFile + ".svg#" + font_face_family + "') format('svg');",							
						"}"
					].join("\n");
					
				$("head").prepend($("<style type=\"text/css\" id=\"jQueryFontFace\"/>"));
				$("#jQueryFontFace").text($("#jQueryFontFace").text() + fontFace)
				
				loading_graphic.removeClass('ajax-loader');
				
			} else {
			
				// google web font specific				
				font_face_family = font_face.split(":")[0];
				font_face_styles = font_face.split(":")[1];
				font_face_style = '';
				
				if( font_face_styles == 'regular' ) {
					font_face_weight = '400';
					font_face_style = 'normal';
				} else {
					if( font_face_styles.indexOf('italic') != -1 ) {
						font_face_style = 'italic';
						if( font_face_styles.length > 6 ) {
							font_face_weight = font_face_styles.substring( 0, 3 );
						} else {
							font_face_weight = '400';
						}
					} else {
						font_face_weight = font_face_styles;
						font_face_style = 'normal';
					}
				}
				// end google web font specific
			}
			
			preview_font.css({
				'font-family': font_face_family,
				'font-weight': font_face_weight,
				'font-style' : font_face_style
			});
			
			if ( el.val().indexOf("fontface") === -1 ) {
				WebFontConfig = {
					google: { 
						families: [ el.val() ]
					},
					fontloading: function(fontFamily, fontDescription) {
						// hide text, show loading
						loading_graphic.addClass('ajax-loader');
					 },
					active: function() {					
						// show text, hide loading					
						loading_graphic.removeClass('ajax-loader');
					},
				};		
			}
			
			return font_face_kit;
			
		},
	}
		
	// all the drop-down font selector
	select_font_elements = $('.font-preview');
	
	$(select_font_elements).each(function(){

		el = $(this);		
		isThisFontFace = false;
		
		// drop-down select change	
		el.live( 'change', function(){			
			google_font_select.font_previewer( $(this) );			
			$.getScript(('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.0.31/webfont.js');
		});		
			
	});
	
	// initiate web fonts on page load
	(function load_webfont_views(elem){
		
		google_font_select.font_previewer( elem );
		
		$.getScript(('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.0.31/webfont.js', function() {
			next = elem.closest('tr').next('tr').find('.font-preview');
			next.length && load_webfont_views(next); 			
		});
		
	})( $(".font-preview:first") );
	
	
});