<?php
	$shortcodes = get_shortcode_options();
	$shortcodes =  apply_filters('arr_shortcode_options', $shortcodes);
?>
<div class="sc_container">
	<div class="sc_selector_area">
		<select name="sc_selector" class="sc_selector">
			<option value=""><?php _e('Choose One','wpdance'); ?></option>
		<?php foreach($shortcodes as $sc){?>
			<option value="<?php echo esc_html($sc['value']); ?>"><?php echo esc_html($sc['name']); ?></option>
		<?php }?>
		</select>
	</div><!-- .sc_selector_area -->
	<div class="sc_options">
		<?php foreach($shortcodes as $sc){?>
		<div id="<?php echo esc_html($sc['value']);?>_options" class="sc_option" style="display:none">
			<?php if(count($sc['options']) > 0){?>
			<ul class="option_list">
				<?php foreach($sc['options'] as $option){?>
				<li>
				   <span class="sc_option_label"><?php echo $label = sprintf( __( '%s','wpdance' ), esc_html($option['label']) ); ?></span>
				   <p>
					   <?php if($option['type'] == 'text'){?>
					   <input id="<?php echo esc_html($option['id']); ?>" name="<?php echo esc_html($option['name']); ?>" <?php if( isset($option['class']) ) echo 'class="'.$option['class'].'"';?> type="text" value="<?php echo isset($option['default']) ? $option['default'] : ''; ?>"/>
					 
						<?php }elseif( esc_html($option['type']) == 'insert_slide' ){?>
							<div class="uploader">
								<input type="hidden" name="_sliders_slider" value="0">
								<a href="javascript:void(0)" class="button stag-metabox-table" name="_unique_name_button" id="_unique_name_button">Insert</a>
								<a href="javascript:void(0)" class="button clear-all-slides" name="clear-all-slides" id="clear-all-slides" style="display: none;">Clear</a>
							</div>					 
					   <?php }elseif($option['type'] == 'checkbox') {?>
					   <input id="<?php echo esc_html($option['id']); ?>" name="<?php echo esc_html($option['name']);?>" type="checkbox" <?php echo (isset($option['default']) && $option['default']== '1') ? 'checked': ''; ?>/>
					   <?php }elseif($option['type'] == 'textarea'){?>
					   <textarea id="<?php echo $option['id']; ?>" name="<?php echo esc_textarea($option['name']);?>"></textarea>
					   <?php }elseif($option['type'] == 'select'){?>
					   <select name="<?php echo esc_html($option['name']);?>" id="<?php echo esc_html($option['id']);?>">
							<?php foreach($option['values'] as $value){?>
							<option value="<?php echo $value['value'];?>" <?php if(isset($option['default']) && $option['default'] == $value['value']):?>selected<?php endif;?>><?php echo ($value['label']);?></option>	
							<?php }?>
					   </select>
					   <?php }elseif($option['type'] == 'radio'){?>
							<?php foreach($option['values'] as $value){?>
							<label><input name="<?php echo $option['name']?>" type="radio" <?php if($option['class']) echo 'class="'.$option['class'].'"';?> value="<?php echo $value['value'];?>" <?php if(isset($option['default']) && $option['default'] == $value['value']):?>checked="checked"<?php endif;?>><?php echo ($value['label']);?></label>
							<?php }?>
					   <?php }?>					   
					   <?php if( isset($option['after_text']) ){?>
					   <span class="after_text"><?php echo $option['after_text'];?></span>
					   <?php }?>
					   <?php if(isset($option['illustrations'])){?>
							<?php foreach($option['illustrations'] as $image){?>
								<p><img src="<?php echo THEME_ADMIN_IMAGES.'/shortcodes_generator/'.$image['src'] ?>" class="<?php echo $image['class'] ?>"/></p>
							<?php }?>
					   <?php }?>
				   </p>
				</li>
				<?php }?>
			</ul>
			<?php }?>
		</div><!-- .sc_option -->
		<?php }?>
	</div><!-- .sc_options -->
	<?php include_once('icon-list.php');?>
	<input type="button" href="#" id="sc_send_editor" value="Send"/>
</div><!-- .sc_container -->
<script type="text/javascript">
//<![CDATA[
function toggle_icons_block(){
	if(jQuery('select.sc_selector option:selected').val() == 'icon'){
		jQuery('#icons-block').show();
	}else{
		jQuery('#icons-block').hide();
	}
}


jQuery(document).ready(function($){
	function icon_to_editor(icon_string){
		
		window.send_to_editor(icon_string);
		//send_to_editor(icon_string);
	}
		var _custom_media = true,_orig_send_attachment = wp.media.editor.send.attachment;
		$('.stag-metabox-table').click(function(e) {
			var send_attachment_bkp = wp.media.editor.send.attachment;
			var button = $(this);
			_custom_media = true;
			wp.media.editor.send.attachment = function(props, attachment){
				console.log(attachment);
				console.log(props);
				var thumb_url = '';
				if( typeof(attachment.sizes.thumbnail) !== 'undefined' ){
					thumb_url = attachment.sizes.thumbnail.url;
				}else{
					thumb_url = attachment.sizes[props.size].url;
				}
				//var insert_url = attachment.sizes[props.size].url;
				var insert_url = attachment.sizes['full'].url;
				var link_url = props.linkUrl;
				if( props.link == 'file' ){
					link_url = attachment.url;
				}
				if( props.link == 'post' ){
					link_url = attachment.link;
				}	
				if( props.link == 'none' ){
					link_url = '#';
				}					
				var image_title = attachment.title;
				var slide_description = attachment.description; 
				var image_alt = attachment.alt;		
				var current_html = jQuery('#slideshow_content').val();
				build_html = current_html;
				if( current_html.length > 0 ){
					current_html += "\n";
				}				
				if ( _custom_media ) {
					
					build_html = '[slide';
					if( image_title.length > 0 ){
						build_html += ' image_title="'+ image_title +'"'
					}
					if( image_alt.length > 0 ){
						build_html += ' image_alt="'+ image_alt +'"'
					}
					if( insert_url.length > 0 ){
						build_html += ' image="'+ insert_url +'"'
					}
					if( link_url.length > 0 ){
						build_html += ' slide_link="'+ link_url +'"'
					}
					if( image_title.length > 0 ){
						build_html += ' title="'+ image_title +'"'
					}else{
						build_html += ' title="Slide Title Goes Here"'
					}
					if( slide_description.length > 0 ){
						build_html += ' description="'+ slide_description +'"'
					}else{
						build_html += ' description="Slide Description Goes Here"'
					}
					build_html += ' ]';	
					
					jQuery('#slideshow_content').val(current_html+build_html);
				} else {
					return _orig_send_attachment.apply( this, [props, attachment] );
				};
			}
			wp.media.editor.open(button);
			
			return false;
		});
		
		//bind editor upload image
		$('.add_media').on('click', function(){
			_custom_media = false;
		});
		toggle_icons_block();
		jQuery('select.sc_selector').change(function(){
			toggle_icons_block();
		});

		// jQuery('#icons-block').find('ul > li').click(function(event){
			// var shortcode_string = '';
			// shortcode_string = jQuery(this).children('i').attr('class');
			// if( typeof shortcode_string !== 'undefined' && shortcode_string.length > 0 ){
				// // if( jQuery('input:radio[name=icon_animation]:checked').val().length > 0 ){
					// // shortcode_string += " " + jQuery('input:radio[name=icon_animation]:checked').val();
				// // }
				// // if( jQuery('input:radio[name=icon_size]:checked').val().length > 0 ){
					// // shortcode_string += " " + jQuery('input:radio[name=icon_size]:checked').val();
				// // }	
				// // if( jQuery('input:radio[name=icon_mute]:checked').val().length > 0 ){
					// // shortcode_string += " " + jQuery('input:radio[name=icon_mute]:checked').val();
				// // }
				// // if( jQuery('input:radio[name=icon_border]:checked').val().length > 0 ){
					// // shortcode_string += " " + jQuery('input:radio[name=icon_border]:checked').val();
				// // }		
				// shortcode_string = "[icon icon=\""+shortcode_string+"\"]";
				// shortcode.sendToEditor(shortcode_string);
			// }
			// event.preventDefault();
		// });
		
		
	
	jQuery('.colorpicker_control').each(function(index,element){
		jQuery(element).colorpicker({
			// onChange: function (hsb, hex, rgb) {
				// jQuery(element).val('#' + hex);
			// }
		});
	});
	
	jQuery('.colorpicker_control_rgba').each(function(index,element){
		jQuery(element).colorpicker({ 'format':"rgba" });
	});	
	
	
});
//]]>
</script>