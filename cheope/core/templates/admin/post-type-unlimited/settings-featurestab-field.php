<?php
$types = array(
    'text'     => __( 'Text Input', 'yit' ),
    'checkbox' => __( 'Checkbox', 'yit' ),
    'textarea' => __( 'Textarea', 'yit' ),
    'textarea-editor' => __( 'Editor', 'yit' )
);
?>
	
	<div class="featurestab_item closed">
		<h3>
			<button type="button" class="remove_item button" rel=""><?php _e('Remove', 'yit') ?></button>
			<div class="handlediv" title="<?php _e('Click to toggle', 'yit') ?>"></div>
			<strong><?php echo ( $value['title'] != '' ) ? $value['title'] : __( 'Tab #', 'yit' ) . $index ?></strong>
			<input type="hidden" class="featurestab_menu_order" name="<?php echo $name ?>[order]" value="<?php echo $index ?>" />
		</h3>
		<div class="inside">
			
			<div class="the-metabox text clearfix">
				<label for="<?php echo $id ?>_title"><?php _e('Title', 'yit') ?></label>
				<p>
				    <input type="text" value="<?php echo $value['title'] ?>" id="<?php echo $id ?>_title" name="<?php echo $name ?>[title]" />
				    <span class="desc inline"><?php _e('Insert the title of the tab.', 'yit') ?></span>
				</p>        
			</div>
            
            <div class="the-metabox text clearfix">
				<label for="<?php echo $id ?>_content"><?php _e('Content', 'yit') ?></label>
				<p>
                    <?php
                    $editor_args = array(
                        'wpautop' => false, // use wpautop?
                    	'media_buttons' => true, // show insert/upload button(s)
                    	'textarea_name' => $name . '[content]', // set the textarea name to something different, square brackets [] can be used here
                    	'textarea_rows' => 10, // rows="..."
                    	'tabindex' => '',
                    	'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
                    	'editor_class' => '', // add extra class(es) to the editor textarea
                    	'teeny' => false, // output the minimal editor config used in Press This
                    	'dfw' => false, // replace the default fullscreen with DFW (needs specific DOM elements and css)
                    	'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                    	'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                    );
                    ?>
				    <div class="editor"><?php wp_editor( $value['content'], $id . '_content', $editor_args ); ?></div>
				    <span class="desc inline"><?php _e('Insert the content of the tab.', 'yit') ?></span>
				</p>        
			</div>

			<div class="the-metabox text clearfix">
				<label for="<?php echo $id ?>_icon"><?php _e('Icon', 'yit') ?></label>
				<p>
                    <input type="text" id="<?php echo $id ?>" name="<?php echo $name ?>[icon]" value="<?php echo $value['icon'] ?>" />  
				    <input type="button" class="button-secondary upload_button" value="<?php _e( 'Upload', 'yit' ) ?>" />   
				    <span class="desc inline"><?php _e('Insert an icon for more personalization.', 'yit') ?></span>
				</p>        
			</div>
		</div>
	</div>