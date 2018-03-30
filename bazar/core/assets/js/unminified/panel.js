// Theme Options JavaScript Document
(function($){
	
//common functions
var buffer = 10; //scroll bar buffer
function pageY(elem) {
    return elem.offsetParent ? (elem.offsetTop + pageY(elem.offsetParent)) : elem.offsetTop;
}
	
function resizeIframe() {
    var height = window.innerHeight || document.body.clientHeight || document.documentElement.clientHeight;
    height -= pageY(document.getElementById('yit_iframe'))+ buffer ;
    height = (height < 0) ? 0 : height;
    document.getElementById('yit_iframe').style.height = height + 'px';
}

//emulate jquery live to preserve jQuery.live() call
if( typeof jQuery.fn.live == 'undefined' ) {
    jQuery.fn.live = function( types, data, fn ) {
        jQuery( this.context ).on( types, this.selector, data, fn );
        return this;
    };
}
	
$(document).ready(function(){

	$('#configure-forms').change(function(){
		$("#yit_contact_forms").submit();				   
	});
	
	//iframe hack
	if( $('#yit_iframe').length > 0 ) {
		resizeIframe();
	}
	
	//Manage import / export data
	$('#export-file').click(function(){
		$('[name=yit-action]').val('export-file');
	});
	$('#import-file').change(function(){
		$('[name=yit-action]').val('import-file');
	});
	$('#configuration-name').focus(function(){
		$('[name=yit-action]').val('configuration-save');
	});
	$('#configuration-restore, #configuration-restore-save').bind('click change', function(){
		$('[name=yit-action]').val('configuration-restore');
	});
	$('.configuration-remove-item').click(function(e){
		e.preventDefault();
		$('[name=yit-action]').val('configuration-remove');
		$('#configuration-remove').val( $(this).attr('rel') );
		
		$(this).parents('form').submit();
	});
});


$(window).resize(function(e){
	//iframe hack
	if( $('#yit_iframe').length > 0 ) {
		resizeIframe(e);
	}
});


})(jQuery);


(function ($) {

var YIT_Panel = function(){};
YIT_Panel.prototype = (function(){

	openTab = function(elem) {
		if( !$(elem).parent().hasClass('active') ) {
			hideTabs();
			openMenu(elem);

			var tab = $(elem).attr('href');
			$(tab).fadeIn();
			
			//add active class to the element
			$(elem).parent().addClass('active');
			
			//trigger tab opened event
			//$( '#yit-content' ).trigger( 'panelLoaded' );
		}
		
		//if user clicked on rightmenu item
		if( $(elem).parents('.yit-rightmenu').length > 0 ) {
			var href = $(elem).attr('href');
			$(elem).parents('.yit-menu-top').find('a[href=' + href + ']').parent().addClass('active')
		}
	},
		
	hideTabs = function() {
		$('.yit-box').hide();
	};
	
	openMenu = function(elem) {
		$('#yit-adminmenuwrap li.active').removeClass('active');
		
		//if menu already opened do nothing
		if ( $(elem).parents('.yit-menu-top').hasClass( 'open' ) ) { return false; }		
		
		//close other menus
 		$('#yit-adminmenuwrap li.yit-menu-top').removeClass('open').removeClass('current');
		$('#yit-adminmenuwrap .yit-submenu.open').removeClass('open').slideUp().parent().removeClass('current');

 		//open selected menu
		$(elem).parents('.yit-menu-top')
					.addClass( 'open' )
					.addClass( 'current' )
						.find( '.yit-submenu' )
						.slideDown()
						.addClass( 'open' );
	};
		
	createRightMenus = function() {
		$('#yit-adminmenuwrap li.yit-has-submenu').each(function(item){
			$(this).hover(function(){
				//if the right menu has not been created
				if( $(this).find('.yit-rightmenu').length == 0 ) {
					$('<div/>', {'class':'yit-rightmenu'}).html('<ul>' + $(this).find('.yit-submenu').html() + '</ul>')
					  									  .appendTo( $(this) );
				}
			});
		});
	};

	//Handle dependencies.
	dependencies_handler = function( id, deps, values ) {
	    if( typeof( $ ) != 'function' )
	        { var $ = jQuery; }
	    
	    var result = true;
	    
	    //Single dependency
	    if( typeof( deps ) == 'string' ) {
	        if( deps.substr( 0, 6 ) == ':radio' )
	                { deps = deps + ':checked'; }
	                
	        var values = values.split( ',' );
	        
	        for( var i = 0; i < values.length; i++ ) {
	            
	            if( $( deps ).val() != values[i] )
	                { result = false; }
	            else
	                { result = true; break; }
	        }
	    } else { //Multiple dependencies
			//@TODO
	    }
	    
	    if( !result ) {
	        $( id + '-container' ).hide();
	    } else {
	        $( id + '-container' ).show();
	    }
	}


	return {
		init : function() {
			//hide all tabs
			hideTabs();
			
			//create right-menus
			createRightMenus();
			
			$('#yit-adminmenuwrap li.yit-menu-top a').live('click', function(e){
				e.preventDefault();
				
				if( $(this).parent().hasClass('yit-has-submenu') ) {
					if ( !$(this).parent().hasClass( 'open' ) ) {
						$(this).parent().find('li:first a').click();
					}
				} else {
					openTab(this);
				}
        
		        // lazyload
		        var tab = $(this).attr('href');
		        $(tab).find('.upload_img_preview img').each(function(i){
		          var src     = $(this).attr('src');
		          var dataSrc = $(this).attr('data-src');
		          if(src.indexOf('sleep.png')) $(this).attr('src', dataSrc);
		        });
			}).filter(':first').click();
			
			
			//dependencies handler
			$('[data-field]').each(function(){
				var t = $(this);
				
				var field = '#' + t.data('field'),
				    dep = '#' + t.data('dep'),
				    value = t.data('value');
				    
				$(dep).on('change', function(){
					dependencies_handler( field, dep, value.toString() );
				}).change();
			});
		}
	}
}());

$(function(){
	YIT_Panel = new YIT_Panel();
	YIT_Panel.init();
});

})(jQuery);