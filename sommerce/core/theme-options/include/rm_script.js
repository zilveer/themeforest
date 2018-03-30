jQuery(document).ready(function(){
		//delete_links = jQuery('.delete-button a');
		//text_button = delete_links.text();
		//jQuery('.delete-button a').after('<div class="button-secondary delete-item">Delete</div>');
		
		jQuery('.section_effect .rm_options:not(.opened)').slideUp();
		
		jQuery('.section_effect .rm_title h3').click(function(){		
			if(jQuery(this).parent().next('.rm_options').css('display')=='none')
				{	jQuery(this).removeClass('inactive');
					jQuery(this).addClass('active');
					jQuery(this).children('img').removeClass('inactive');
					jQuery(this).children('img').addClass('active');
					jQuery(this).parent().parent().append('<input type="hidden" name="section-opened" value="'+jQuery(this).parent().parent().attr('id')+'" />'); 
				}
			else
				{	jQuery(this).removeClass('active');
					jQuery(this).addClass('inactive');		
					jQuery(this).children('img').removeClass('active');			
					jQuery(this).children('img').addClass('inactive');
					jQuery(this).parent().parent().children('input[name="section-opened"]').remove();
				}
				
			jQuery(this).parent().next('.rm_options').slideToggle('slow');	
		});
		
		jQuery('input[type="checkbox"].on_off').iphoneStyle({ checkedLabel: 'Yes', uncheckedLabel: 'No' });  
    });                   	

jQuery(document).ready(function($){
 	$('.rm_upload input[type="button"], input.upload-button').live('click',function() { 
		var upField = $(this).prev();
		var this_button = $(this);
		
		tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');    
	
		window.send_to_editor = function(html) {
			//alert(html);
			
			var imgurl = $('a', '<div>' + html + '</div>').attr('href');
            if( typeof imgurl == 'undefined' ) imgurl =  $($(html)).attr('src');
			upField.val(imgurl);

			if ( ! this_button.hasClass('upload-button') ) {
    			$image_preview = upField.parents('.sortItem').find('.ss-ImageSample');
    			if( $image_preview.length > 0 ) $image_preview.attr('src',imgurl);
    		}
			
			tb_remove();
		}          
		
		return false;
	});
});                     

jQuery(document).ready(function($) {
	$('.rm_color').each(function() {
		var divPicker = $(this).find('.colorpicker');
		var inputPicker = $(this).find('input[type=text]');
		divPicker.farbtastic(inputPicker);
		divPicker.hide();
		
        $('.colorpicker-icon', this).click(function(){
           divPicker.slideToggle('fast'); 
        });
	});
  });       

jQuery(document).ready(function($) {
	$('.radioLink input').live('click',function() {
		value = $(this).val();
		$parent = $(this).parent().parent();
		
		$parent.find('.radioLink').removeClass('checked');
		$(this).parent().addClass('checked');
		
		$parent.find('.ss-Link').hide();
		$parent.find('.'+value).show();	
	});
}); 

jQuery(document).ready(function($) {
	$('#SlideShow').sortable({
		axis: 'y',
		items: 'li.slide-item',
		placeholder: 'ui-sortable-placeholder',
		forcePlaceholderSize: true,
		opacity: 0.5,
		update: function(event,ui) {
			$('.sortItem').each(function(e){
				$('input.item_order_value', this).val(e);
			})	
		}
	});
});


/*homepage*/      	

jQuery(document).ready(function($){
 	$('.add-widget').click(function() { 
		tb_show('', 'add_widget.php');    
	
		window.send_to_editor = function(html) {
			imgurl = $('img', html).attr('src');
			idimg = $('img', html).attr('class').match(/wp-image-(\d+)/);
			upField.val(imgurl);
			upId.val(idimg[1]);
			
			$image_preview = upField.parents('.sortItem').find('.ss-ImageSample');
			if( $image_preview.length > 0 ) $image_preview.attr('src',imgurl);
			
			tb_remove();
		}          
		
		return false;
	});
});                                   	

// contact
jQuery(document).ready(function($){
 	$('.rm_input a.show_tb').click(function() { 
		
		tb_show( '', $(this).attr('href') );    
	
// 		window.send_to_editor = function(datastring) {                      
// 			
// 			$.post( action, datastring, function(response){        
// 				window.location = response;
// 			});      
// 		}          
		
		return false;
	});
});                                  	

// deps
jQuery(document).ready(function($){

	function check_options() {
		$('.yiw-deps').each(function(){
			
			var container_id = $(this).attr('id');
			var container = $(this);
			
			//alert('deps_options['+container+'] = '+deps_options[container]);  
			
			if ( typeof deps_options[container_id] != 'undefined' )
			{
				var input = $('#'+deps_options[container_id]['id_input']);
				var value = input.val();
				var input_type = input.attr('type');
				var dep_container_id = '#' + deps_options[container_id]['id'] + '-option';
				var dep_container = $(dep_container_id);
				
				if ( 
					! dep_container.hasClass('hidden') && 
					( input_type != 'checkbox' && value == deps_options[container_id]['value'] ) || 
					( value == deps_options[container_id]['value'] && input.is(':checked') ) 
				   ) 
				{
					container.slideDown(200).removeClass('hidden');
					//$('.fade_color', this).show().css({opacity:1}).animate({opacity:0}, 1000, function(){ $(this).hide() });
				} else {         
					container.slideUp(200).addClass('hidden');  
				}
			}             
		});
	}     
	
	check_options();
	
	$('.rm_options input, .rm_options select, .rm_options textarea').live('change', function(){   
		check_options();
	});  
 	
});     