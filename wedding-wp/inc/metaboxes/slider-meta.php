<div class="my_meta_control">
 
<script type="text/javascript">
jQuery(document).ready(function(){

	var formfield;
	var selected_slide;
	var select_img;
		
	jQuery('.upload-img').live('click',function() {
		jQuery('html').addClass('Image');
		formfield = jQuery(this).siblings(":hidden").attr("name");
		selected_slide = jQuery(this).siblings(":hidden");
		select_img = jQuery(this).siblings("img");
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		return false;
	});
		
	// user inserts file into post. only run custom if user started process using the above process
	// window.send_to_editor(html) is how wp would normally handle the received data

	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){

		if (formfield) {
			fileurl = jQuery('img',html).attr('src');
				
			jQuery(selected_slide).val(fileurl);

			jQuery(select_img).attr('src',fileurl);

			
			tb_remove();
				
			jQuery('html').removeClass('Image');
				
		} else {
			window.original_send_to_editor(html);
		}
	};

});
</script>
	<?php while($mb->have_fields_and_multi('docs')): ?>
	<?php $mb->the_group_open(); ?>
 
		<?php $mb->the_field('slide_image'); ?>
		<label>Slider Images</label>
			<input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" id="Image"/>
			<img class="portslider-img" style="width:150px; height:100px;" src="<?php $mb->the_value(); ?>"/>
		   <button name="upload-img" class="upload-img" id="upload-img" onclick='return false;'>Browse</button>
		
		
			<a href="#" class="dodelete button">Remove Slide</a>
		
 
	<?php $mb->the_group_close(); ?>
	<?php endwhile; ?>
 
	<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-docs button">Add Slide</a></p>

</div>