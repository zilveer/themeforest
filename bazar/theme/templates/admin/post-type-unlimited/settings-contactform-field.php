<?php
$types = array(
    'text'     => __( 'Text Input', 'yit' ),
    'checkbox' => __( 'Checkbox', 'yit' ),
    'select'   => __( 'Select', 'yit' ),
    'textarea' => __( 'Textarea', 'yit' ),
    'radio'    => __( 'Radio Input', 'yit' ),
    'password' => __( 'Password Field', 'yit' ),
    'file'     => __( 'File Upload', 'yit' ),
);
?>
	
	<div class="contactform_item closed">
		<h3>
			<button type="button" class="remove_item button" rel=""><?php _e('Remove', 'yit') ?></button>
			<div class="handlediv" title="<?php _e('Click to toggle', 'yit') ?>"></div>
			<strong><?php echo $value['title'] ?> <?php yit_string( '(', $types[ $value['type'] ], ')' ) ?></strong>
			<input type="hidden" class="contactform_menu_order" name="<?php echo $name ?>[order]" value="<?php echo $index ?>" />
		</h3>
		<div class="inside">
			
			<div class="the-metabox text clearfix">
				<label for="<?php echo $id ?>_title"><?php _e('Title Field', 'yit') ?></label>
				<p>
				    <input type="text" value="<?php echo $value['title'] ?>" id="<?php echo $id ?>_title" name="<?php echo $name ?>[title]" />
				    <span class="desc inline"><?php _e('Insert the title of field.', 'yit') ?></span>
				</p>        
			</div>
			
			<div class="the-metabox text clearfix">
				<label for="<?php echo $id ?>_data_name"><?php _e('Data Name', 'yit') ?></label>
				<p>
				    <input type="text" value="<?php echo $value['data_name'] ?>" id="<?php echo $id ?>_data_name" name="<?php echo $name ?>[data_name]" />
				    <span class="desc inline"><?php _e('REQUIRED: The identification name of this field, that you can insert into body email configuration. <strong>Note:</strong>Use only lowercase characters and underscores.', 'yit') ?></span>
				</p>        
			</div>
			
			<div class="the-metabox select clearfix text-field-type">
				<label for="<?php echo $id ?>_type"><?php _e('Type field', 'yit') ?></label>
				<p>
				    <select id="<?php echo $id ?>_type" name="<?php echo $name ?>[type]">
				        <?php foreach ( $types as $type => $name_type ) : ?>
				    	<option value="<?php echo $type ?>"<?php selected( $type, $value['type'] ) ?>><?php echo $name_type ?></option>   
				        <?php endforeach; ?>
				    </select>      
				    <span class="desc inline"><?php _e('Select the type of this field.', 'yit') ?></span>
				</p>       
			</div>
			
			<div class="the-metabox checkbox clearfix deps_checkbox deps">
				<label for="<?php echo $id ?>_already_checked"><?php _e('Checked', 'yit') ?></label>
				<p>
				    <input type="checkbox" id="<?php echo $id ?>_already_checked" name="<?php echo $name ?>[already_checked]" value="1"<?php checked( $value['already_checked'] ) ?> />
				    <span class="desc inline"><?php _e('Select this if you want this field already checked.', 'yit') ?></span>
				</p>     
			</div>       
			
			<div id="<?php echo $id ?>_addoptions" class="the-metabox addoptions clearfix deps_radio deps_select deps">
				<label for=""><?php _e('Add options ', 'yit') ?></label>
				<a href="#" class="add-field-option button-secondary"><?php _e( 'Add option', 'yit' ) ?></a><br /><br />
				 
				<?php foreach ( $value['options'] as $key => $option ) : ?>
				<p class="option">      
					<label><input type="radio" name="<?php echo $name ?>[option_selected]" value="<?php echo $key ?>"<?php checked( $value['option_selected'], $key ) ?> /> <?php _e( 'Selected', 'yit' ) ?></label>
					<input type="text" name="<?php echo $name ?>[options][]" value="<?php echo $option ?>" style="width:200px" />  
					<a href="#" class="del-field-option button-secondary"><?php _e( 'Delete option', 'yit' ) ?></a>
				</p>              
				<?php endforeach; ?>
			</div>                           
            
            <script>
            jQuery(document).ready(function($){
            	
            	//
            	$('#<?php echo $id ?>_addoptions .add-field-option').live('click', function(){
            		var option = "<p class='option'><label><input type='radio' name='<?php echo $name ?>[option_selected]' value='' /> <?php _e( 'Selected', 'yit' ) ?></label><input type='text' name='<?php echo $name ?>[options][]' style='width:200px' /> <a href='#' class='del-field-option button-secondary'><?php _e( 'Delete option', 'yit' ) ?></a></p>";
            				
            		$(option).appendTo( $('#<?php echo $id ?>_addoptions') );
            		return false;
            	});
            	
            });
            </script>

			<div class="the-metabox text clearfix">
				<label for="<?php echo $id ?>_error"><?php _e('Message Error', 'yit') ?></label>
				<p>
				    <input type="text" value="<?php echo $value['error'] ?>" id="<?php echo $id ?>_error" name="<?php echo $name ?>[error]" /> 
				    <span class="desc inline"><?php _e('Insert the error message for validation.', 'yit') ?></span>
				</p>        
			</div>
			
			<div class="the-metabox checkbox clearfix">
				<label for="<?php echo $id ?>_required"><?php _e('Required', 'yit') ?></label>
				<p>
				    <input type="checkbox" id="<?php echo $id ?>_required" name="<?php echo $name ?>[required]" value="1"<?php checked( $value['required'] ) ?> />
				    <span class="desc inline"><?php _e('Select this if it must be required.', 'yit') ?></span>
				</p>     
			</div>
			
			<div class="the-metabox checkbox clearfix">
				<label for="<?php echo $id ?>_is_email"><?php _e('Email', 'yit') ?></label>
				<p>
				    <input type="checkbox" id="<?php echo $id ?>_is_email" name="<?php echo $name ?>[is_email]" value="1"<?php checked( $value['is_email'] ) ?> />
				    <span class="desc inline"><?php _e('Select this if it must be a valid email.', 'yit') ?></span>
				</p>     
			</div>
			
			<div class="the-metabox checkbox clearfix">
				<label for="<?php echo $id ?>_reply_to"><?php _e('Reply To', 'yit') ?></label>
				<p>
				    <input type="checkbox" id="<?php echo $id ?>_reply_to" name="<?php echo $name ?>[reply_to]" value="1"<?php checked( $value['reply_to'] ) ?> />
				    <span class="desc inline"><?php _e('Select this if it\'s the email where you can reply.', 'yit') ?></span>
				</p>     
			</div>
			
			<div class="the-metabox text clearfix">
				<label for="<?php echo $id ?>_class"><?php _e('Class', 'yit') ?></label>
				<p>
				    <input type="text" value="<?php echo $value['class'] ?>" id="<?php echo $id ?>_class" name="<?php echo $name ?>[class]" />
				    <span class="desc inline"><?php _e('Insert an additional class(es) (separateb by comma) for more personalization.', 'yit') ?></span>
				</p>        
			</div>

			<div class="the-metabox text clearfix">
				<label for="<?php echo $id ?>_icon"><?php _e('Icon', 'yit') ?></label>
				<p>
				    <input type="text" value="<?php echo $value['icon'] ?>" id="<?php echo $id ?>_icon" name="<?php echo $name ?>[icon]" />
				    <span class="desc inline"><?php _e('Insert an icon for more personalization.', 'yit') ?></span>
				</p>        
			</div>
            
            <div class="the-metabox text clearfix">
				<label for="<?php echo $id ?>_width"><?php _e('Width', 'yit') ?></label>
				<p>
				    <select id="<?php echo $id ?>_width" name="<?php echo $name ?>[width]">
                        <?php
                        for( $i = 1; $i < 13; $i++ ) {
                            ?>
                            <option value="span<?php echo $i ?>"
                            <?php
                            if( isset( $value['width'] ) )
                                { selected( 'span' . $i, $value['width'] ); }
                            else {
                                if( $value['type'] == 'textarea' )
                                    { selected( 'span' . $i, 'span9' ); }
                                else
                                    { selected( 'span' . $i, 'span3' ); }
                            }
                            ?>><?php echo $i ?></option>
                            <?php
                        }
                        ?>
                    </select>
				    <span class="desc inline"><?php _e('Choose how much long will be the field.', 'yit') ?></span>
				</p>        
			</div>
		</div>
	</div>