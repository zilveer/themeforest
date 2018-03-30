jQuery(document).ready(function($){
   
    //init Thickbox
    
    ////stop the flash from happening
	$('#TB_window').css('opacity',0);
	
	function calcTB_Pos() {
		$('#TB_window').css({
	   	   'height': ($('#TB_ajaxContent').outerHeight() + 30) + 'px',
	   	   'top' : (($(window).height() + $(window).scrollTop())/2 - (($('#TB_ajaxContent').outerHeight()-$(window).scrollTop()) + 30)/2) + 'px',
	   	   'opacity' : 1
		});
	}
	
	setTimeout(calcTB_Pos,100);
	
	$(window).resize(calcTB_Pos);
	
	
  //Upload function
  initUpload();
			
	function initUpload(clone){
		var itemToInit = null;
		itemToInit = typeof clone !== 'undefined' ? clone : $('.shortcode-dynamic-item');
		
		itemToInit.find('.redux-opts-upload').on('click',function(e) {
		
		    var activeFileUploadContext = jQuery(this).parent();
		    var relid = jQuery(this).attr('rel-id');
		
		    e.preventDefault();
		
		    // if its not null, its broking custom_file_frame's onselect "activeFileUploadContext"
		    custom_file_frame = null;
		
		    // Create the media frame.
		    custom_file_frame = wp.media.frames.customHeader = wp.media({
		        // Set the title of the modal.
		        title: jQuery(this).data("choose"),
		
		        // Tell the modal to show only images. Ignore if want ALL
		        library: {
		            type: 'image'
		        },
		        // Customize the submit button.
		        button: {
		            // Set the text of the button.
		            text: jQuery(this).data("update")
		        }
		    });
		
		    custom_file_frame.on( "select", function() {
		        // Grab the selected attachment.
		        var attachment = custom_file_frame.state().get("selection").first();
		
		        // Update value of the targetfield input with the attachment url.
		        jQuery('.redux-opts-screenshot',activeFileUploadContext).prop('src', attachment.attributes.url);
		        jQuery('#' + relid ).val(attachment.attributes.url).trigger('change');
		
		        jQuery('.redux-opts-upload',activeFileUploadContext).hide();
		        jQuery('.redux-opts-screenshot',activeFileUploadContext).show();
		        jQuery('.redux-opts-upload-remove',activeFileUploadContext).show();
				});
		
				custom_file_frame.open();
		});
	
	 	itemToInit.find('.redux-opts-upload-remove').on('click', function( event ) {
	      var activeFileUploadContext = jQuery(this).parent();
	      var relid = jQuery(this).attr('rel-id');
	
	      event.preventDefault();
	
	      jQuery('#' + relid).val('');
	      jQuery(this).prev().fadeIn('slow');
	      jQuery('.redux-opts-screenshot',activeFileUploadContext).fadeOut('slow');
	      jQuery(this).fadeOut('slow');
	  });
	}
  


	//The chosen one
	$("select#thb-shortcodes").chosen();
	$(".colorpicker").wpColorPicker({
		palettes: false
	});
    var ed = tinyMCE.activeEditor;
    
    function dynamic_items(){
    	
    	var name = $('#thb-shortcodes').val(),
    			content = '';
	    
	    switch(name) {
	    	//icon-list
	    	case 'icon_list':
	    		if( $('.shortcode-options[data-name='+name+']').is(':visible') ){
	    			var listicon = $('.shortcode-options[data-name='+name+']').find('select[id='+name+'-icon]').val() || 'fa-ok';
	    			$('.shortcode-options[data-name='+name+'] .shortcode-dynamic-item-input').each(function(){
	    			   if( $(this).val() != '' ) {
	    					tabContent = $(this).parents('.shortcode-dynamic-item').find('.shortcode-dynamic-item-input').val();
	    					content += ' [item] '+tabContent+' [/item] '; 
	    				}
	    			});
	    		}
	    		$('#shortcode-storage-thb').html('[icon-list icon="'+listicon+'"]'+content+'[/icon-list]');
	    	break;
	    }
    }
    
    function update_shortcode(){
		
			var name = $('#thb-shortcodes').val(),
					dataType = $('#options-'+name).data('type'),
					content = '';
			
			if(dataType == 'dynamic') {
				dynamic_items();
				return false;
			}
			
			switch(name) {
				
				// Elements
				case 'quote':
					var align = $('input[name='+name+'-align]:checked').val() || '',
							author = $('input[id='+name+'-author]').val(),
							text = $('textarea[id='+name+'-content]').val();
					
					if (align != '') { var alignment = 'pull="'+align+'"'; } else { var alignment = '';}
					
					content = '[blockquote author="'+author+'" '+alignment+']'+text+'[/blockquote]';
				break;
				
				case 'thb_button':
					var size = $('input[name='+name+'-size]:checked').val() || 'small',
							color = $('input[name='+name+'-color]:checked').val() || 'black',
							animation = $('input[name='+name+'-animation]:checked').val() || '',
							icon = $('input[id='+name+'-icon]').val(),
							title = $('input[id='+name+'-title]').val(),
							link = $('input[id='+name+'-link]').val(),
							target_blank = $('input[id='+name+'-target_blank]:checked').length;
							
					if(target_blank) { var target_blank = 'target_blank="true"' } else { var target_blank = '' }
					
					content = '[thb_button link="'+link+'" color="'+color+'" icon="'+icon+'" size="'+size+'" animation="'+animation+'" '+target_blank+' caption="'+title+'"]';
					
				break;
				
				case 'video':
					var id = $('input[id='+name+'-id]').val(),
							type = $('input[name='+name+'-type]:checked').val() || 'youtube',
							format = $('input[name='+name+'-format]:checked').val() || 'widescreen';
					
					content = '[video id="'+id+'" type="'+type+'" format="'+format+'"]';
					
				break;
				
				case 'small_title':
					var title = $('input[id='+name+'-title]').val() || 'title';
					
					content = '[small_title title="'+title+'"]';
					
				break;
				
				case 'large_title':
					var title = $('input[id='+name+'-title]').val() || 'title',
							center = $('input[id='+name+'-center]:checked').length;
					
					if(center) { var center = 'center="true"' } else { var center = '' }
					content = '[large_title title="'+title+'" '+center+']';
					
				break;
				
				case 'tags':
					var color = $('input[name='+name+'-color]:checked').val() || 'black',
							text = $('input[id='+name+'-text]').val();
					
					content = '[tags color="'+color+'"]'+text+'[/tags]';
					
				break;
				
				case 'notifications':
					var type = $('input[name='+name+'-type]:checked').val() || 'success',
							title = $('input[id='+name+'-title]').val(),
							content = $('textarea[id='+name+'-content]').val();
					
					content = '[notification type="'+type+'" title="'+title+'"]'+content+'[/notification]';
					
				break;
				
				case 'seperator':
					var style = $('input[name='+name+'-type]:checked').val() || 'style1',
							title = $('input[id='+name+'-title]').val() || 'Divider';
					
					content = '[seperator style="'+style+'"]'+title+'[/seperator]';
					
				break;
				
				case 'dropcap':
					var boxed = $('input[name='+name+'-boxed]:checked').val() || 'black',
							type = "";
					
					
					content = '[dropcap boxed="'+boxed+'"]A[/dropcap]';
					
				break;
				
				// Interface
				case 'toggle':
					var title = $('input[id='+name+'-title]').val(),
							text = $('textarea[id='+name+'-content]').val();

					content = '[toggle title="'+title+'"]'+text+'[/toggle]';
				break;
				
				// Icons
				case 'single_icon':
					var link = $('input[id='+name+'-icon_link]').val(),
							icon = $('select[id='+name+'-icon]').val() || 'fa-leaf',
							size = $('input[name='+name+'-size]:checked').val() || 'icon-smallsize',
							boxed = $('input[id='+name+'-boxed]:checked').length,
							rounded = $('input[id='+name+'-rounded]:checked').length;
					
					if(boxed) { var box = 'box="true"' } else { var box = '' }
					if(link) { var url = 'url="'+link+'"' } else { var url = '' }
					
					content = '[icon type="'+icon+'" size="'+size+'" '+url+' '+box+']';	
				break;
			}
			
			$('#shortcode-storage-thb').html(content);
	 	}
   
  ///// EVENTS /////
	
		// Main Select Change
    $('#thb-shortcodes').change(function(){
			$('.shortcode-options').hide();
			$('#options-'+$(this).val()).show();
			update_shortcode();
    });
		    
		// Radio Change
    $('#add-shortcode').click(function(){
    	var name = $('#thb-shortcodes').val(),
    			dataType = $('#options-'+name).attr('data-type');
    			
    	update_shortcode();
			ed.selection.setContent($('#shortcode-storage-thb').html());
			
			tb_remove();
		
			return false;
    });
		
		// Radio Change
		$('[id^=shortcode-option]').change(function(){
			update_shortcode();
    });
    
    

 	
 		// Add Item    
 		
 		$('.add-list-item').click(function(){
    	
    	if(!$(this).parent().find('.remove-list-item').is(':visible')) $(this).parent().find('.remove-list-item').show();
    	
    	//clone item 
    	var $clone = $(this).parent().find('.shortcode-dynamic-item:first').clone();
    			
    	$clone.find('input[type=text], textarea').prop('value','');
    	
    	
    	//init new upload button and clear image if it's an upload
    	if( $clone.find('.redux-opts-upload').length > 0 ) {
    		$clone.find('.redux-opts-screenshot').prop('src','');
    		$clone.find('.redux-opts-upload-remove').hide();
    		$clone.find('.redux-opts-upload').css('display','inline-block');
    		setTimeout(function(){ initUpload($clone) },200);
    	}
    	
    	//append clone
			$(this).parent().find('.shortcode-dynamic-items').append($clone);
			return false;
    });
		
		// Remove Item
    $('.remove-list-item').hide().live('click', function(){
    	if($(this).parent().find('.shortcode-dynamic-item').length > 1){
    		$(this).parent().find('#options-item .shortcode-dynamic-item:last').remove();
				dynamic_items();	
    	}
    	if($(this).parent().find('.shortcode-dynamic-item').length == 1) $(this).hide();	
			return false;
    });
    
});