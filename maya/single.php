<?php       
/**
 * @package WordPress
 * @since 1.0
 */
 
wp_enqueue_style( 'Oswald', 'http://fonts.googleapis.com/css?family=Oswald&v2' );

$post_type = get_post_type();   

if ( yiw_is_portfolio_post_type( $post_type ) ) {
     get_template_part('single', 'portfolio'); 
     die;  
} 
 
get_header() ?>           
        


        <div id="primary" class="layout-<?php echo yiw_layout_page() ?>">  
    		<div class="inner group">
                <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>
                <div id="slogan">
                    <h1><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h1>
                    <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
                </div>
                <?php endif ?>
            
    
                <!-- START CONTENT -->
                <div id="content" class="group">
                    <?php if( yiw_get_option( 'show_breadcrumb_single_blog' ) ) yiw_breadcrumb(); ?>
                    <?php $blog_type = yiw_get_option('blog_type'); ?>
                    
                    <?php 
                          switch( $post_type ) {
                              case TYPE_GALLERY : get_template_part('loop', 'internal'); break;
                              default           : get_template_part('loop', 'index');
                          }
                    ?>
    
                </div>                       
                <!-- END CONTENT -->
                
                <!-- START LATEST NEWS -->
                <?php 
                    if( $post_type == 'bl_testimonials' ) {
                        get_sidebar('testimonials');
                    } else {
                        get_sidebar('blog');
                    }
                ?>
                <!-- END LATEST NEWS -->   
            
            </div>     
         </div> 
        
<?php get_footer() ?>
