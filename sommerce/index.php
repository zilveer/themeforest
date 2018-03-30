<?php        
/**
 * @package WordPress
 * @subpackage Beauty & Clean
 * @since 1.0
 */
 
get_header() ?>                        
        
		<div class="layout-<?php echo yiw_layout_page() ?> group">
        
            <!-- START CONTENT -->
            <div id="content" role="main" class="group">
                <?php get_template_part( 'loop', 'index' ) ?> 
                
                <?php //comments_template() ?>
            </div>
            <!-- END CONTENT -->
            
            <!-- START SIDEBAR -->
            <?php get_sidebar('blog') ?>
            <!-- END SIDEBAR -->    
        
        </div>   
        
<?php get_footer() ?>