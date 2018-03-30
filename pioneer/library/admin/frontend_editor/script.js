var $ = jQuery.noConflict();

jQuery(document).ready(function($){



	jQuery('.epic_admin_imagelist a').click(function(){
		
			jQuery(this).parent().parent().find('a').removeClass('active');
		
			var link = jQuery(this).attr('rel');
			var image = jQuery(this).attr('title');
			
			jQuery('#'+ link).val(image) ;
			jQuery(this).addClass('active');
			
			return false;
		
		});
		
		
    	jQuery('.clearimage').click(function(){
		
			jQuery(this).parent().find('a').removeClass('active');		
			
			jQuery('#epic_background_texture').val('');
			
			return false;
		
		});

	
	//$("#content #sortable_2  .fee-handle").hide();
	
	function gab(){
	
		
	
	
	jQuery( "#sortable_2 .bulb" ).hover(function() {

			jQuery(this).parent().find('.handle-icons').show();
					
		});
		
	jQuery( "#sortable_2 .handle-icons" ).hover(function() {

			jQuery(this).show();
			},function(){
			jQuery(this).hide();
			
		});
	
	}
	
	gab();
		
	jQuery("ul.editor-panels > li > a").tooltip({ 
    	track: true, 
   	 	top: -15, 
    	left: 15,
    	showURL: false
		}); 
		
		
	jQuery(".handle-icons a").tooltip({ 
    	track: true, 
   	 	top: -15, 
    	left:15,
    	showURL: false,
    	
		}); 

	
		
	/* ADMIN PANEL
	======================================================================================*/
		
	/* Scroll the admin panel with the page */
		
	var $scrollingDiv = $("#moduleselector").parent();
 	$(window).scroll(function(){			
	$scrollingDiv
	.stop()
	.animate({"marginTop": ($(window).scrollTop() + 50) + "px"}, "slow" );			
	});
	

 	var $editorDiv = $("#epic_fee_editor");
	$(window).scroll(function(){			
	$editorDiv
	.stop()
	.animate({"marginTop": ($(window).scrollTop() + 50) + "px"}, "slow" );			
	});


/* Header module scripts */

		jQuery(function($) {
			jQuery( "#header_options" ).dialog({
				autoOpen: false,
				title:"Header settings",
				show: "fade",
				hide: "fade",
				modal: false,
				width: 580,
				}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
				});

			jQuery( "#header_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#header_options" ).dialog( "open" );
				move_headerelements();
				return false;
			});
		
		
		
		function move_headerelements(){
			
		
		if (jQuery("#header_options").dialog( "isOpen" )===true) {
		
		
			jQuery( "#header" ).resizable({
			handles: 's',
			containment: "#wrapper",
						
			start: function (event, ui){
				jQuery(this).prepend('<div class="shadower"><div class="datavisual"></div></div>');
			},
			stop: function(event, ui) {
				jQuery(this).find('.shadower').remove();
				var height = $(this).height();
				jQuery('#header-height').val(height);
			},
			resize: function(event, ui){
				jQuery('.datavisual').html($(this).height() + 'px');

			},
			create: function (event, ui){
				jQuery(this).prepend('<div class="image-resize"><div class="image-resize-handle-bottom"></div></div>');
			}
		});

		
		
		
			//* Do the stuff */
			
			jQuery( "#header-textbox" ).resizable({
				containment: "#wrapper",
				ghost: false,
				minWidth: 100,
				minHeight: 40,
				start: function (event, ui){
					jQuery(this).prepend('<div class="shadower"></div>');
					jQuery("#header").resizable("disable");
					},
				stop: function(event, ui) {
					jQuery(this).find('.shadower').remove();
					jQuery("#header").resizable("enable");
					var height = $(this).height();
					var width = $(this).width();
					jQuery('#epic_header_textbox_width').val(width);
        			jQuery('#epic_header_textbox_height').val(height);	
				
				}
			});
			
		
		jQuery( "#header-textbox" ).draggable({
				cursor: 'move',
				stop: function (event, ui){
					var position = $(this).position();
        			var xPos = position.left;
        			var yPos = position.top;
        			jQuery('#epic_header_textbox_x_pos').val(xPos);
        			jQuery('#epic_header_textbox_y_pos').val(yPos);
				}
			});
			
			
		jQuery( "#header .epic_searchform" ).draggable({
				cursor: 'move',
				stop: function (event, ui){
					var position = $(this).position();
        			var xPos = position.left;
        			var yPos = position.top;
        			jQuery('#epic_searchform_x_pos').val(xPos);
        			jQuery('#epic_searchform_y_pos').val(yPos);
				}
			});
			
		
		jQuery( "#epic_wpml_lang_selector" ).draggable({
				cursor: 'move',
				stop: function (event, ui){
					var position = $(this).position();
        			var xPos = position.left;
        			var yPos = position.top;
        			jQuery('#epic_wpml_x_pos').val(xPos);
        			jQuery('#epic_wpml_y_pos').val(yPos);
				}
			});
			
			
		jQuery( "#primary" ).draggable({
			containment: ".module-header",
			drag: function(event, ui) {
				
        		var position = $(this).position();
        		var xPos = position.left;
        		var yPos = position.top;
        		jQuery('#epic_primary_x_pos').val(xPos);
        		jQuery('#epic_primary_y_pos').val(yPos);

    		} 
		
		});
		
		
		jQuery( "#secondary" ).draggable({
			//containment: "#wrapper",
			drag: function(event, ui) {
        		var position = $(this).position();
        		var xPos = position.left;
        		var yPos = position.top;
        		jQuery('#secondary-x-pos').val(xPos);
        		jQuery('#secondary-y-pos').val(yPos);

    		} 
		
		});
		
		
		/* Drag and drop logo position */
		jQuery( "#logo" ).draggable({ 
			containment: "body",
			drag: function(event, ui) {
        		var position = $(this).position();
        		var xPos = position.left;
        		var yPos = position.top;
        		jQuery('#logo-x-pos').val(xPos);
        		jQuery('#logo-y-pos').val(yPos);

    		} 
		});
		
		
				
		
		/* Drag and drop social media position */
		
		jQuery( "ul.epic_socialmedia" ).draggable({ 
			containment: "parent",
			drag: function(event, ui) {
        		var position = $(this).position();
        		var xPos = position.left;
        		var yPos = position.top;
        		jQuery('#socialmedia-x-pos').val(xPos);
        		jQuery('#socialmedia-y-pos').val(yPos);
    		},
    		start: function(event, ui){
    			ui.helper.append('<div class="noclickoverlay"></div>'); // To prevent click
    		},
    		stop: function(event, ui){
    			ui.helper.find('.noclickoverlay').remove(); // Remove "clickpreventer"
    		}
    		    		        	
      	});

			}
		
		}

		
	});



$(function() {
		
		var panelstatus = readCookie('panelstatus');
		
		
		
				
		$( ".btnOverlay" ).button({
            icons: {
                primary: "ui-icon-notice"
            },
            text: true
        });


		/* The save button */
		
		$( "#fee-saveall" ).button({
            icons: {
                primary: "ui-icon-disk"
            },
            text: true
        });
        
        $( "#fee_hide_markers, #fee_show_markers" ).button({
            icons: {
                primary: "ui-icon-refresh"
            },
            text: true
        });
	
			
		
		
		
		jQuery('.fee-deletehandle').bind("click",function(){
				
				var element = jQuery(this).parent().parent().parent();
				jQuery(element).remove();
				jQuery(element).appendTo('#sortable_1');
				
				$('#sortable_2').trigger('sortupdate');
				
		
		});
		
				
		
		
		$('#sortable_1').sortable({
			connectWith: $('#sortable_2'),
			placeholder: "ui-state-highlight placeholder",
						handle: '.fee-draghandle'			
			}).disableSelection();
		
		$('#sortable_2').sortable({
			connectWith: $('#sortable_1'),
			greedy: true,
			handle: '.fee-draghandle',
			cursor: 'pointer',
			opacity: 0.6,
			placeholder: "ui-state-highlight placeholder",
			cursorAt: {top:25, left:200},
			
			
  			
  	
		}).disableSelection();

});	


jQuery('#sortable_2').bind("sortupdate", function(event,ui){

		var newOrdering = $('#sortable_2').sortable('toArray');
    			var newOrderIds = new Array(newOrdering.length);
    			var ctr = 0;
    			// Loop over each value in the array and get the ID
    			$.each(
     			 newOrdering,
      			function(intIndex, objValue) {
      			  //Get the ID of the reordered items 
       			 //- this is sent back to server to save
        			newOrderIds[ctr] = objValue.substring('',objValue.length);
        			ctr = ctr + 1;
      			}
    			);
    			$('#pageorder').val(newOrderIds);
    			
    			var pageorder = $('#pageorder').val();
    			var pageid = $('#pageid').val();
    							 
				$('#info').html('');    			
      			
      			jQuery.post(feeajaxurl, {action:"ajax_save", 'cookie': encodeURIComponent(document.cookie), order:pageorder, id:pageid},
      
      			function(res){
         			var message_result = eval('(' + res + ')');
         			if (!message_result.success) {
             			jQuery('#info').html('Something went wrong');
           			}
                
         			$('#info').html(message_result.message /* + ' ' + message_result.setting */).fadeIn('slow',function(){
         				$(this).delay(2000).fadeOut('slow');
         			});
        		});	

				
				gab();
});

});

/*jslint browser: true */ /*global jQuery: true */

/**
 * jQuery Cookie plugin
 *
 * Copyright (c) 2010 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

jQuery.cookie = function (key, value, options) {

    // key and value given, set cookie...
    if (arguments.length > 1 && (value === null || typeof value !== "object")) {
        options = jQuery.extend({}, options);

        if (value === null) {
            options.expires = -1;
        }

        if (typeof options.expires === 'number') {
            var days = options.expires, t = options.expires = new Date();
            t.setDate(t.getDate() + days);
        }

        return (document.cookie = [
            encodeURIComponent(key), '=',
            options.raw ? String(value) : encodeURIComponent(String(value)),
            options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
            options.path ? '; path=' + options.path : '',
            options.domain ? '; domain=' + options.domain : '',
            options.secure ? '; secure' : ''
        ].join(''));
    }

    // key and possibly options given, get cookie...
    options = value || {};
    var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
    return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};
