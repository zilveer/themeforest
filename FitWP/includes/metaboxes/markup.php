<script src="<?php echo get_template_directory_uri(); ?>/includes/metaboxes/js/ajaxupload.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">

	jQuery(document).ready(function() {
		
		jQuery('.ddListWidget').each(function() { jQuery(this).children('li').each(function() { jQuery(this).ddMetaCheckLength(); }) });
		
		//intiiate our content in the lis
		if(jQuery('#<?php echo $idList; ?>_content').val() != '') { jQuery('#<?php echo $idList; ?>').ddMetaInit(); }
		
		//sprtable content
		jQuery('#<?php echo $idList; ?>_ul').sortable({
			
			update: function(event, ui) { jQuery('#<?php echo $idList; ?>').ddMetaReSort(); },
			placeholder: 'ddListPlaceHolder',
			items: 'li:not(.ddListEmpty)'
						
		});
		jQuery("#<?php echo $idList; ?>_ul").disableSelection();
		
		jQuery(document).keydown(function(e) {
			
			if(e.keyCode == 13) {
				
				<?php
				
					foreach($fields as $field) {
						
						echo "if(jQuery('*:focus').attr('id') == '".$idList."_".$field['name']."') { jQuery('#".$idList."').ddMetaAdd(); return false; }";
						if($field['type'] == 'img') { echo "if(jQuery('*:focus').attr('id') == '".$idList."_".$field['name']."_upload') { jQuery('#".$idList."').ddMetaAdd(); return false; }"; }
						
					}
				
				?>
				
				if(jQuery('*:focus').attr('id') == '<?php echo $idList; ?>_title') { jQuery('#<?php echo $idList; ?>').ddMetaAdd(); return false; }
				
			}
			
		});
		
		

		<?php foreach($fields as $field) : ?>
				
			<?php if($field['type'] == 'img') : //IF ITS AN IMAGE ?>
			
			jQuery('#<?php echo $idList; ?>_upload_<?php echo $field['name'] ?>').each(function(){
				
				var the_button = jQuery(this);
				var image_input = jQuery('#<?php echo $idList; ?>_<?php echo $field['name'] ?>');
				var image_id = jQuery(this).attr('id');
				
				new AjaxUpload(image_id, {
					
					  action: ajaxurl,
					  name: image_id,
					  
					  // Additional data
					  data: {
						action: 'ddpanel_ajax_upload',
						data: image_id
					  },
					  
					  autoSubmit: true,
					  responseType: false,
					  onChange: function(file, extension){},
					  onSubmit: function(file, extension) {
						  
							the_button.addClass('disabledButton').attr('disabled', 'disabled');	
										  
					  },
					  
					  onComplete: function(file, response) {
							
							the_button.removeAttr('disabled').removeClass('disabledButton');
							
							if(response.search("Error") > -1){
								
								alert("There was an error uploading:\n"+response);
								
							}
							
							else{		
												
								image_input.val(response);
									
							}
							
						}
						
				});
				});
			
			<?php endif; ?>
				
		<?php endforeach; ?>
		
	});

</script>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/includes/metaboxes/css/style.css" media="screen" />

<input type="text" name="<?php echo $idList; ?>_content" id="<?php echo $idList; ?>_content" class="ddListWidgetContent" value="<?php echo get_post_meta($post->ID, $idList, true); ?>" />

<span class="hidden" id="<?php echo $idList; ?>_fields">itemId|title<?php

	if($fields[0]['type'] != '') { echo '|'; }

	$i = 1; foreach($fields as $field) { echo $field['name']; if($i < count($fields)) { echo '|'; } $i++; }
	
?></span>

<ul id="<?php echo $idList; ?>_ul" class="ddListWidget">

<?php if(get_post_meta($post->ID, $idList, true) == '') { echo '<li class="ddListEmpty">Hey, You don\'t any content here!</li>'; } //if theres no initial items ?>

</ul>

<p>

	<input type="text" name="<?php echo $idList; ?>_title" id="<?php echo $idList; ?>_title" value="Item Title" class="widefat ddListTitle" onfocus="if(jQuery(this).val() == 'Item Title') { jQuery(this).val(''); }" style="margin-top: 5px;" />

</p>

<?php foreach($fields as $field) : ?>
		
	<?php if($field['type'] == 'img') : //IF ITS AN IMAGE ?>
    
        <p style="position: relative;">
        
            <div style="float: left; width: 100%; position: relative;">
            
                <input type="text" name="<?php echo $idList; ?>_<?php echo $field['name'] ?>" id="<?php echo $idList; ?>_<?php echo $field['name'] ?>" value="<?php echo $field['title'] ?>" class="widefat ddListImage" onfocus="if(jQuery(this).val() == '<?php echo $field['title'] ?>') { jQuery(this).val(''); }" />
                <input name="<?php echo $idList; ?>_upload" class="ddListUpload" value="" type="button" id="<?php echo $idList; ?>_upload_<?php echo $field['name'] ?>" />
                
            </div>
            <div style="clear: both;"></div>
            
        </p>
        
    <?php elseif($field['type'] == 'text') : ?>
    
    	<p>

            <input type="text" name="<?php echo $idList; ?>_<?php echo $field['name'] ?>" id="<?php echo $idList; ?>_<?php echo $field['name'] ?>" value="<?php echo $field['title'] ?>" class="widefat ddListTitle" onfocus="if(jQuery(this).val() == '<?php echo $field['title'] ?>') { jQuery(this).val(''); }" />
        
        </p>
        
    <?php elseif($field['type'] == 'textarea') : ?>
    
    	<p>

            <textarea name="<?php echo $idList; ?>_<?php echo $field['name'] ?>" id="<?php echo $idList; ?>_<?php echo $field['name'] ?>" class="widefat ddListTextArea" onfocus="if(jQuery(this).val() == '<?php echo $field['title'] ?>') { jQuery(this).val(''); }" rows="4"><?php echo $field['title'] ?></textarea>
        
        </p>
    
    <?php endif; ?>
		
<?php endforeach; ?>

<p style="text-align:right;">

	<!-- <input type="button" name="<?php echo $idList; ?>_reset" class="button autowidth" id="<?php echo $idList; ?>_reset" value="Reset Fields" style="margin: 4px 3px 4px 0;" onchange="" /> -->
	<input type="button" name="<?php echo $idList; ?>_add" class="button-primary autowidth" id="<?php echo $idList; ?>_add" value="Add Item" style="margin: 4px 7px 4px 0;" onclick="jQuery('#<?php echo $idList; ?>').ddMetaAdd();" />

</p>