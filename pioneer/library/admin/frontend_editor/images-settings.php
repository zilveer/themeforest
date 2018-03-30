<div id="imagesselector">
	<form action="" method="post">
		<h5>Resize images</h5>
		<p>You can change the image-heights by pulling the handle at the bottom of the images. This can only be performed while this window is open.</p>
		<p>Click "Save image settings" after setting the image-heights.</p>
		
		
		
		
		
<input type="hidden" id="epic_slider_image_height" name="epic_slider_image_height" value="<?php echo get_option('epic_slider_fullwidth_image_height'); ?>"/>
<input type="hidden" id="epic_thumbnail_featured_image_height" name="epic_thumbnail_featured_image_height" value="<?php echo get_option('epic_thumbnail_featured_image_height'); ?>"/>
<input type="hidden" id="epic_thumbnail_210_image_height"  name="epic_thumbnail_210_image_height"  value="<?php echo get_option('epic_thumbnail_210_image_height'); ?>"/>
<input type="hidden" id="epic_thumbnail_280_image_height"  name="epic_thumbnail_280_image_height"  value="<?php echo get_option('epic_thumbnail_280_image_height'); ?>"/>
<input type="hidden" id="epic_thumbnail_430_image_height"  name="epic_thumbnail_430_image_height"  value="<?php echo get_option('epic_thumbnail_430_image_height'); ?>"/>
<input type="hidden" id="epic_thumbnail_590_image_height"  name="epic_thumbnail_590_image_height"  value="<?php echo get_option('epic_thumbnail_590_image_height'); ?>"/>
<input type="hidden" id="epic_thumbnail_900_image_height"  name="epic_thumbnail_900_image_height"  value="<?php echo get_option('epic_thumbnail_900_image_height'); ?>"/>
<input type="hidden" id="epic_thumbnail_slideshowfullwidth_image_height"  name="epic_thumbnail_slideshowfullwidth_image_height"  value="<?php echo get_option('epic_thumbnail_slideshowfullwidth_image_height'); ?>"/>
<input type="hidden" id="epic_thumbnail_slideshowregular_image_height"  name="epic_thumbnail_slideshowregular_image_height"  value="<?php echo get_option('epic_thumbnail_slideshowregular_image_height'); ?>"/>
<input type="hidden" id="epic_thumbnail_galleryfullwidth_image_height"  name="epic_thumbnail_galleryfullwidth_image_height"  value="<?php echo get_option('epic_thumbnail_galleryfullwidth_image_height'); ?>"/>
<input type="hidden" id="epic_thumbnail_galleryregular_image_height"  name="epic_thumbnail_galleryregular_image_height"  value="<?php echo get_option('epic_thumbnail_galleryregular_image_height'); ?>"/>

<script>
	jQuery(function($) {
		
		$( "#imagesselector" ).dialog({
			autoOpen: false,
			title:"Image settings",
			show: "fade",
			hide: "fade",
			modal: false,
			width: 320,
			position: [20,100]
			});

		$( "#openImagesSelector" ).click(function() {
			$( "#imagesselector" ).dialog( "open" );
			resize_images();
			return false;
		});
		
function resize_images(){


if (jQuery("#imagesselector").dialog( "isOpen" )===true) {
    
    /* Remove overflow hidden on containers */
    
    jQuery('.slide').css({'overflow':'visible'});
				
var sizes = { 
	'900': '',
	'590': '',
	'430': '',
	'280': '',
	'210': '',
	'featured': '',
	'slideshowfullwidth': '',
	'slideshowregular': '',
	'galleryfullwidth': '',
	'galleryregular': '' 
}; 

jQuery.each(sizes, function(key, value) { 


		jQuery( 'figure.Thumbnail-' + key ).resizable({
	
			handles: 's',		
			containment: "#content",
			minWidth: key,
			maxWidth: key,
			
			create: function(event, ui){
				jQuery(this).prepend('<div class="image-resize"><div class="image-resize-handle-bottom"></div></div>');

			},
			start: function (event, ui){
				jQuery(this).prepend('<div class="shadower"><div class="datavisual"></div></div>');
				jQuery(this).css({'background':'#999'});
			},
			resize: function(event, ui){
				jQuery('.datavisual').html($(this).height() + 'px');
			},
			stop: function(event, ui) {
				jQuery(this).find('.shadower').remove();
				var imageheight = $(this).height();
				jQuery('#epic_thumbnail_' + key + '_image_height').val(imageheight);
				
			}
			
			
		});
 }); // End each		
}		
}
	
		
});
	

</script>

	
	
	<?php wp_nonce_field('fee_save_nonce_imagessettings','fee_nonce_field'); ?>
	<input type="submit" value="Save image settings"/>
	<input type="hidden" name="action" value="saved" />
	</form>
	<p>Almost all images can be scaled on the fly. You can also change height values in Epic > Images in the admin.</p>
	
</div>		