<?php
/**
 * The html of the settings box in the post type unlimited admin pages. 
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */       
                   
?>             
	    <p class="field-row">
	        <a href="" class="button-secondary add-items"><?php _e( 'Add', 'yit' ) ?> <?php echo $args['labels']['item_name_plur'] ?></a>
	        <img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" class="ajax-loading" id="add-items-ajax-loading" alt="" />
	        
	        <span style="color:#444; padding-left:5px;"><?php if( !empty($items) ) _e( 'Click in a image to edit it.', 'yit' ) ?></span>
	    </p>
	    
	    <div id="images-post-type">
	    
    	    <?php do_action( 'settings-items-post-type' ); ?>
    	    
        </div>          