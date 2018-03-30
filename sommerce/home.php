<?php        
/**
 * @package WordPress
 * @subpackage Beauty & Clean
 * @since 1.0
 */
 
/*
Template Name: Home
*/               

global $wp_query;      

if ( ( is_home() || is_front_page() ) && get_option( 'show_on_front' ) == 'posts' || $wp_query->is_posts_page ) {
    global $yiw_is_posts_page;
    $yiw_is_posts_page = true;
    get_template_part( 'blog' ); 
    die;
}      

if( ( is_home() || is_front_page() ) && get_option( 'show_on_front' ) == 'posts' || is_home() && get_option( 'page_for_posts' ) != '0' ) {
    $blog_type = yiw_get_option('blog_type');
    get_template_part( 'blog' ); 
    die;
}

get_header() ?>                          
        
        <div class="layout-<?php echo yiw_layout_page() ?>">
        
            <!-- START CONTENT -->
            <div id="content" role="main" class="group wrapper-content">
                <?php 
					if ( is_home() )
						get_template_part( 'loop', 'index' ); 
					else
						get_template_part( 'loop', 'page' ); 
				?> 
            </div>
            <!-- END CONTENT -->
            
            <!-- START SIDEBAR -->
            <?php get_sidebar() ?>
            <!-- END SIDEBAR -->   
        
        </div>                
                              
        <!-- START EXTRA CONTENT -->
		<?php get_template_part( 'extra-content' ) ?>      
        <!-- END EXTRA CONTENT -->    
        
<?php get_footer() ?>
