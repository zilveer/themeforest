<div id="headerselector">
	<form action="" method="post">
		<p>While this window is open, all the elements in the header-section of your site can be dragged and dropped in the position you wantTo save the positions, click "Save and close window".
		</p>
		<!-- Add logo -->
		<h5>Logo</h5>
		<p>
		<input type="text" class="upload-input" name="upload_logo"  id="epic_add_logo" value="<?php echo get_option('epic_logo_url') ?>"/>
		<small>Enter path to logo image, or use the image-uploader in the theme options panel</small>
		</p>
				
		<p><input type="checkbox" name="epic_header_textbox" id="epic_header_textbox" <?php if(get_option('epic_header_textbox') == true) {echo 'checked="checked"';}?>/>
		<label for="epic_header_textbox">Add textbox to header</label>
		<br><small>Enter text for the text box in the theme options panel</small></p>
				
<script>
	// increase the default animation speed to exaggerate the effect

	jQuery(function($) {
	
	
		jQuery( "#headerselector" ).dialog({
			autoOpen: false,
			title:"Header settings",
			show: "fade",
			hide: "fade",
			modal: false,
			width: 580
		});

		jQuery( "#openHeaderSelector" ).click(function() {
			jQuery( "#headerselector" ).dialog( "open" );
			move_headerelements();
			return false;
		});
	
function move_headerelements(){
			
		
		if (jQuery("#headerselector").dialog( "isOpen" )===true) {
		
		
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
				minWidth: 200,
				minHeight: 20,
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
			//containment: "#wrapper",
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
	
jQuery(document).ready(function() { 

	jQuery( "#slider-range-logo-margin-top" ).slider({
			range: "min",
			value: <?php echo $bottommargin;?>,
			min: 0,
			max: 100,
			slide: function( event, ui ) {
				jQuery( "#bottommargin" ).val( ui.value);
				jQuery('#wrapper').css({'marginBottom': ui.value });
			}
		});
		jQuery( "#bottommargin" ).val(<?php echo $bottommargin;?>); 
		});
</script>
		<?php
		
		/* Logo position */
	$epic_logo_x_pos = get_option('epic_logo_x_pos');
	$epic_logo_y_pos = get_option('epic_logo_y_pos');
	
	/* WPML language selector position */
	$epic_wpml_x_pos = get_option('epic_wpml_x_pos');
	$epic_wpml_y_pos = get_option('epic_wpml_y_pos');
	
	/* WPML language selector position */
	$epic_bp_menu_x_pos = get_option('epic_bp_menu_x_pos');
	$epic_bp_menu_y_pos = get_option('epic_bp_menu_y_pos');
	
	/* Searchform position */
	$epic_searchform_x_pos = get_option('epic_searchform_x_pos');
	$epic_searchform_y_pos = get_option('epic_searchform_y_pos');
	
	/* Social media position */
	$epic_socialmedia_x_pos = get_option('epic_socialmedia_x_pos');
	$epic_socialmedia_y_pos = get_option('epic_socialmedia_y_pos');
	
	/* Header textbox */
	$epic_header_textbox_x_pos = get_option('epic_header_textbox_x_pos');
	$epic_header_textbox_y_pos = get_option('epic_header_textbox_y_pos');
	$epic_header_textbox_height = get_option('epic_header_textbox_height');
	$epic_header_textbox_width = get_option('epic_header_textbox_width');
	
	
	/* Secondary menu position */
	$epic_primary_x_pos = get_option('epic_primary_x_pos');
	$epic_primary_y_pos = get_option('epic_primary_y_pos');
	
	/* Secondary menu position */
	$epic_secondary_x_pos = get_option('epic_secondary_x_pos');
	$epic_secondary_y_pos = get_option('epic_secondary_y_pos');
	
	/* Header height */	
	$epic_header_height = get_option('epic_header_height');
	?>
	
		<input type="hidden" id="epic_wpml_x_pos" name="epic_wpml_x_pos" value="<?php echo $epic_wpml_x_pos; ?>"/>
		<input type="hidden" id="epic_wpml_y_pos" name="epic_wpml_y_pos" value="<?php echo $epic_wpml_y_pos; ?>"/>
		<input type="hidden" id="socialmedia-x-pos" name="socialmedia-x-pos" value="<?php echo $epic_socialmedia_x_pos; ?>"/>
		<input type="hidden" id="socialmedia-y-pos" name="socialmedia-y-pos" value="<?php echo $epic_socialmedia_y_pos; ?>"/>
		<input type="hidden" id="epic_searchform_x_pos" name="epic_searchform_x_pos" value="<?php echo $epic_searchform_x_pos; ?>"/>
		<input type="hidden" id="epic_searchform_y_pos" name="epic_searchform_y_pos" value="<?php echo $epic_searchform_y_pos; ?>"/>
		<input type="hidden" id="epic_primary_x_pos" name="epic_primary_x_pos" value="<?php echo $epic_primary_x_pos; ?>"/>
		<input type="hidden" id="epic_primary_y_pos" name="epic_primary_y_pos" value="<?php echo $epic_primary_y_pos; ?>"/>
		<input type="hidden" id="secondary-x-pos" name="secondary-x-pos" value="<?php echo $epic_secondary_x_pos; ?>"/>
		<input type="hidden" id="secondary-y-pos" name="secondary-y-pos" value="<?php echo $epic_secondary_y_pos; ?>"/>
		<input type="hidden" id="logo-x-pos" name="logo-x-pos" value="<?php echo $epic_logo_x_pos; ?>"/>
		<input type="hidden" id="logo-y-pos" name="logo-y-pos" value="<?php echo $epic_logo_y_pos; ?>"/>
		<input type="hidden" id="header-height" name="header-height" value="<?php echo $epic_header_height; ?>"/>
		
		<input type="hidden" id="epic_header_textbox_x_pos" name="epic_header_textbox_x_pos" 	value="<?php echo $epic_header_textbox_x_pos; ?>"/>
		<input type="hidden" id="epic_header_textbox_y_pos" name="epic_header_textbox_y_pos" 	value="<?php echo $epic_header_textbox_y_pos; ?>"/>
		<input type="hidden" id="epic_header_textbox_width" name="epic_header_textbox_width" 	value="<?php echo $epic_header_textbox_width; ?>"/>
		<input type="hidden" id="epic_header_textbox_height" name="epic_header_textbox_height"  value="<?php echo $epic_header_textbox_height; ?>"/>
	<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_headersettings'); ?>
	<input type="submit" value="Save & close window"/>
	<input type="hidden" name="action" value="saved" />
	</form>
	
</div>		