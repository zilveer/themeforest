<?php
/**
 * The html of the settings box in the post type unlimited admin pages. 
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */       

global $post, $pagenow;
 
$post_id = isset( $post->ID ) ? $post->ID : 0;

$first_tab = sanitize_key( $args['labels']['singular_name'] ) . '-configuration';
$active_tab = isset( $_COOKIE['active_metabox_tab'] ) ? $_COOKIE['active_metabox_tab'] : $first_tab;     
    
ob_start();
do_action( 'typography-post-type-unlimited' );
$tab_typography = ob_get_clean();                

// get the main field value
if ( $post->post_type == 'portfolios' ) {
    $field = 'portfolio_type';
} elseif ( $post->post_type == 'sliders' ) {
    $field = 'slider_type';
} else {
    $field = '';
}
$main_field = yit_get_model('cpt_unlimited')->get_setting( $field );        
?>

<div class="settings-tab metaboxes-tab<?php if ( ! empty( $main_field ) ) echo ' ' . $field . '-' . $main_field; ?>">
    <?php wp_nonce_field( 'post-type-unilimited-settings', 'settings_post_type_nonce' ); ?>
    
	<ul class="metaboxes-tabs settings-tabs clearfix">
		<li<?php if ( $active_tab == $first_tab ) : ?> class="tabs"<?php endif; ?>><a href="#<?php echo $first_tab ?>"><?php echo $args['labels']['singular_name'] ?> <?php _e( 'Configuration', 'yit' ) ?></a></li>
		<?php if ( $pagenow == 'post.php' && $args['use_typography'] && ! empty( $tab_typography ) ) : ?><li<?php if ( $active_tab == 'item-typography' ) : ?> class="tabs"<?php endif; ?>><a href="#item-typography"><?php _e( 'Typography', 'yit' ) ?></a></li><?php endif; ?>
        <?php if ( $pagenow == 'post.php' ) : ?><li<?php if ( $active_tab == 'item-edit' ) : ?> class="tabs"<?php endif; ?>><a href="#item-edit"><?php _e( 'Add/Edit', 'yit' ) ?> <?php echo $args['labels']['item_name_sing'] ?></a></li><?php endif; ?>
	</ul>

    <!-- CONFIGURATION -->
	<div class="tabs-panel" id="<?php echo sanitize_key( $args['labels']['singular_name'] ) ?>-configuration"<?php if ( $active_tab != $first_tab ) : ?> style="display: none;"<?php endif; ?>>
	   
	    <?php do_action( 'settings-post-type-unlimited' ) ?>
        
	</div>              
    <!-- END CONFIGURATION -->
                                    
    <?php if ( $pagenow == 'post.php' && $args['use_typography'] && ! empty( $tab_typography ) ) : ?>    
    <!-- TYPOGRAPHY -->
	<div class="tabs-panel" id="item-typography"<?php if ( $active_tab != 'item-typography' ) : ?> style="display: none;"<?php endif; ?>>
	   
	    <?php do_action( 'typography-post-type-unlimited' ); ?>
        
	</div>              
    <!-- END TYPOGRAPHY -->   
    <?php endif; ?>
          
    <?php if ( $pagenow == 'post.php' ) : ?>                    
    <!-- ADD/EDIT -->     
	<div class="tabs-panel" id="item-edit"<?php if ( $active_tab != 'item-edit' ) : ?> style="display: none;"<?php endif; ?>>  
	
	    <?php include $args['settings_items_file']; ?>
	    
	</div>                  
	<script type="text/javascript">
	   var post_id = <?php echo $post->ID; ?>,
	       cpt_metabox_name = '<?php echo $this_obj->metabox_name ?>';
	</script>
    <!-- END ADD/EDIT -->
    <?php endif; ?>

</div>