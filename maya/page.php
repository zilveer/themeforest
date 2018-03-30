<?php        
/**
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */                        

get_header() ?>                        
        
		<div id="primary" class="layout-<?php echo yiw_layout_page() ?>">    
		    <div class="inner group">
                <?php get_template_part('slogan') ?>
    			
    			<?php get_template_part( 'accordion-slider' ) ?>  

				<?php do_action( 'yiw_before_content_page' ); ?>

                <!-- START CONTENT -->
                <div id="content" class="group">
                    <?php
                    $post_id = yiw_post_id();
                    if( get_post_meta( $post_id, '_show_breadcrumbs_page', true ) == 'yes' ) yiw_breadcrumb();
                    ?>

                    <?php get_template_part( 'loop', 'page' ) ?>

                    <?php comments_template() ?>
                </div>
                <!-- END CONTENT -->

				<?php do_action( 'yiw_after_content_page' ); ?>
                
                <!-- START SIDEBAR -->
                <?php get_sidebar() ?>
                <!-- END SIDEBAR -->    
                                  
                <!-- START EXTRA CONTENT -->
        		<?php get_template_part( 'extra-content' ) ?>      
                <!-- END EXTRA CONTENT -->
            </div>
        </div>       
        
<?php get_footer() ?>