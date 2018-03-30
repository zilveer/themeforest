<?php while($metabox->have_fields('webnus_page_options',1)): ?>
<p>
    <?php $selected = ' selected="selected"'; ?>
   
    <table class="w-metabox" width="100%">
	
	
	<tr>
	    <td>
	    	<b>OnePage Menu:</b>
	    </td>
	    <td>
	    	<?php $mb->the_field('webnus_onepage_menu'); ?>
	    	<div class="wrap-selector">
		    	<input type="checkbox" id="w-selector-onepage" name="<?php $mb->the_name(); ?>" value="yes" <?php echo $mb->is_value('yes')?' checked="checked"':''; ?> class="widefat"/>
		    	<label for="w-selector-onepage"></label>
		    </div>
	    </td>
	</tr>   
	
	
 <tr>
	    <td>
	    	<b>Transparent header:</b>
	    </td>
	    <td>
<?php $mb->the_field('webnus_transparent_header'); ?>


	    <select name="<?php $mb->the_name(); ?>">
		    <option value="none"<?php if ($metabox->get_the_value() == 'none') echo esc_attr($selected); ?>>None</option>
			<option value="light"<?php if ($metabox->get_the_value() == 'light') echo esc_attr($selected); ?>>Light</option>
			<option value="dark"<?php if ($metabox->get_the_value() == 'dark') echo esc_attr($selected); ?>>Dark</option>

		</select>
		
		
		</td>
	</tr> 

	<tr>
	    <td>
	    	<b>Hide header at start:</b>
	    </td>
	    <td>
	    	<?php $mb->the_field('maxone_hideheader'); ?>
	    	<div class="wrap-selector">
		    	<input type="checkbox" id="w-selector" name="<?php $mb->the_name(); ?>" value="yes" <?php echo $mb->is_value('yes')?' checked="checked"':''; ?> class="widefat"/>
				<label for="w-selector"></label>
			</div>
	    </td>
	</tr>   
	 <?php $metabox->the_field('show_page_title_bar'); ?>       
    <tr>
	    <td>
	    	<b>Page Title Bar:</b>
	    </td>
	    <td>
	    <select name="<?php $metabox->the_name(); ?>">
		    <option value="show"<?php if ($metabox->get_the_value() == 'show') echo esc_attr($selected); ?>>Show</option>
		    <option value="hide"<?php if ($metabox->get_the_value() == 'hide') echo esc_attr($selected); ?>>Hide</option>
		</select>
		</td>
	</tr>
	 <tr>
   		<td><b>Title Bar Background Color:</b></td>
	    <td>
	   		 <input type="text" name="<?php $metabox->the_name('title_background_color'); ?>" value="<?php $metabox->the_value('title_background_color'); ?>"/>
	   		 (Hex Code)
	 	</td>
 	</tr>
 	 <tr>
   		<td><b>Title Bar Text Color:</b></td>
	    <td>
	   		 <input type="text" name="<?php $metabox->the_name('title_text_color'); ?>" value="<?php $metabox->the_value('title_text_color'); ?>"/>
	   		 (Hex Code)
	 	</td>
 	</tr>
 	 <tr>
   		<td><b>Title Bar Font Size:</b></td>
	    <td>
	   		 <input type="text" name="<?php $metabox->the_name('title_font_size'); ?>" value="<?php $metabox->the_value('title_font_size'); ?>"/>
	   		 (in px format)
	 	</td>
 	</tr> 	
    <tr>
	    <td>
	  		 <b>Sidebar Position:</b>
	    </td>
	    <td>
	    <?php $metabox->the_field('sidebar_position'); ?>
	    <select name="<?php $metabox->the_name(); ?>">
		    <option value="none"<?php if ($metabox->get_the_value() == 'none') echo esc_attr($selected); ?>>None</option>
			<option value="right"<?php if ($metabox->get_the_value() == 'right') echo esc_attr($selected); ?>>Right</option>
		    <option value="left"<?php if ($metabox->get_the_value() == 'left') echo esc_attr($selected); ?>>Left</option>
			<option value="both"<?php if ($metabox->get_the_value() == 'both') echo esc_attr($selected); ?>>Both</option>
		</select>
	  </td>
 	</tr>
    <tr>
   		<td><b>Background Color:</b></td>
	    <td>
	   		 <input type="text" name="<?php $metabox->the_name('background_color'); ?>" value="<?php $metabox->the_value('background_color'); ?>"/>
	   		 (Hex Code)
	 	</td>
 	</tr>
 	<tr>
 		<td><b>Background Image:</b></td>
 		<td>
	 		<?php $mb->the_field('the_page_bg'); ?>
			<input  type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" id="Image"/>
			<!--<button name="upload-img" id="upload-img" onclick='return false;'>Browse</button> -->
			<script type="text/javascript">
			jQuery(document).ready(function(){
	
				var formfield;
				
				jQuery('#upload-img').click(function() {
					jQuery('html').addClass('Image');
					formfield = jQuery('#Image').attr('name');
					tb_show('', 'media-upload.php?type=image&TB_iframe=true');
					return false;
				});
				
				// user inserts file into post. only run custom if user started process using the above process
				// window.send_to_editor(html) is how wp would normally handle the received data
	
				window.original_send_to_editor = window.send_to_editor2;
				window.send_to_editor2 = function(html){
	
					if (formfield) {
						fileurl = jQuery('img',html).attr('src');
						
						jQuery('#Image').val(fileurl);
	
						tb_remove();
						
						jQuery('html').removeClass('Image');
						
					} else {
						window.original_send_to_editor(html);
					}
				};
	
				});
			</script>
	 			
 		</td>
 	</tr>
 	
 	
 	 <tr>
	    <td>
	  		 <b>100% Background Image:</b>
	    </td>
	    <td>
	    <?php $metabox->the_field('bg_image_100'); ?>
	    <select name="<?php $metabox->the_name(); ?>">
		    <option value="no"<?php if ($metabox->get_the_value() == 'no') echo esc_attr($selected); ?>>No</option>
		    <option value="yes"<?php if ($metabox->get_the_value() == 'yes') echo esc_attr($selected); ?>>Yes</option>
		</select>
	  </td>
 	</tr>
 	
 	
 	
 	<tr>
	    <td>
	  		 <b>Background Repeat:</b>
	    </td>
	    <td>
	    <?php $metabox->the_field('bg_image_repeat'); ?>
	    <select name="<?php $metabox->the_name(); ?>">
		    <option value="1"<?php if ($metabox->get_the_value() == '1') echo esc_attr($selected); ?>>Tile</option>
		    <option value="2"<?php if ($metabox->get_the_value() == '2') echo esc_attr($selected); ?>>Tile Horizontally</option>
		    <option value="3"<?php if ($metabox->get_the_value() == '3') echo esc_attr($selected); ?>>Tile Vertically</option>
		    <option value="0"<?php if ($metabox->get_the_value() == '0') echo esc_attr($selected); ?>>No Repeat</option>
		</select>
	  </td>
 	</tr>
 	
	 	<tr>
	    <td>
	  		 <b>Footer:</b>
	    </td>
	    <td>
	    <?php $mb->the_field('webnus_footer_show'); ?>
	    <select name="<?php $metabox->the_name(); ?>">
		    <option value="true"<?php if ($metabox->get_the_value() == 'true') echo esc_attr($selected); ?>>Show</option>
		    <option value="false"<?php if ($metabox->get_the_value() == 'false') echo esc_attr($selected); ?>>Hide</option>
		</select>
	  </td>
 	</tr>
 	
   </table>
 
   
</p>
<?php endwhile; ?>