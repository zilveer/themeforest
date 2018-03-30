<?php       
/**
 * @package WordPress
 * @since 1.0
 */
 
/*
Template Name: Blog
*/

global $post;
if ( ! empty( $post->post_password ) )
    $protected = true;
else
    $protected = false;

$paged = (get_query_var('paged')) ? get_query_var('paged') : ( (get_query_var('page')) ? get_query_var('page') : 1 );

get_header() ?>                        
        
		<div class="layout-<?php echo yiw_layout_page() ?> group">
        
            <?php query_posts('cat=' . yiw_get_exclude_categories() . '&posts_per_page=' . get_option('posts_per_page') . '&paged=' . $paged) ?>
            
            <!-- START CONTENT -->
            <div id="content" class="group">
                <?php get_template_part( 'loop', $protected ? 'page' : 'index' ) ?>
            </div>                       
            <!-- END CONTENT -->
            
            <!-- START SIDEBAR -->
            <?php get_sidebar('blog') ?>
            <!-- END SIDEBAR -->    
        
        </div>   
                              
        <!-- START EXTRA CONTENT -->
		<?php get_template_part( 'extra-content' ) ?>      
        <!-- END EXTRA CONTENT -->    
        
<?php get_footer() ?>