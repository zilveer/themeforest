<?php
/**
 * The html of the settings box in the post type unlimited admin pages. 
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */       

 $first = true;    
 global $post;
?>                        
            <?php if ( !empty( $items ) ) : ?>
    	    <ul class="slides-wrapper ui-sortable clearfix"<?php if ( count( $items ) <= 1 ) : ?> style="display:none;"<?php endif ?>>
    	        <?php foreach ( $items as $item_id => $the_ ) : if ( $item_id == 0 ) continue; ?>
                <li><a href="#item-<?php echo $item_id ?>"<?php if ( $first ) : ?> class="selected"<?php endif; ?> title="<?php _e( 'Click here to edit this item', 'yit' ) ?>">
                    <?php 
                        $image = yit_image( "id=$item_id&size=admin-post-type-thumbnails", false );//wp_get_attachment_image( $item_id, 'admin-post-type-thumbnails', false, array( 'alt' => '', 'title' => '' ) ); 
                        echo empty( $image ) ? '<img src="' . YIT_CORE_ASSETS_URL . '/images/no-featured-cptu.jpg" alt="no image" />' : $image;
                    ?>
                </a></li>   
                <?php $first= false; endforeach; ?>
            </ul>        
    	    
    	    <?php $i = 0; foreach ( $items as $item_id => $the_ ) : ?>
    	    <div class="slide-settings" id="item-<?php echo $item_id ?>">
    	    
    	       <input type="hidden" value="<?php echo $i ?>" name="<?php echo $this_obj->metabox_name ?>[items][<?php echo $item_id ?>][order]" class="order" />
    	       <?php do_action( 'settings-item-post-type', $item_id ) ?>
    	       
    	       <p class="field-row">
    	           <a href="#" class="button-secondary delete-item" rel="<?php echo $item_id ?>"><?php _e( 'Delete', 'yit' ) ?> <?php echo $args['labels']['item_name_sing'] ?></a>
    	           <img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" class="ajax-loading" id="delete-item-ajax-loading-<?php echo $item_id ?>" alt="" />
               </p>
                
        	</div> 
            <?php $i++; endforeach; ?>  
            <?php endif; ?>  
               
            <script type="text/javascript">   
               var items_id = <?php echo json_encode( array_keys( $items ) ); ?>; 
            </script>                     