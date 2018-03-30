<?php
/**
 * The template for displaying posts in the Image Post Format on index and archive pages
 *
 * @package WordPress
 */
 
/* :: Get Custom Field Data
--------------------------------------------- */

include(NV_FILES .'/inc/classes/blog-class.php');
include(NV_FILES .'/inc/classes/post-fields-class.php');

/* :: / ------------------------------------- */ ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    	<div class="article-row row">
        
			<?php if( $NV_arhpostpostmeta == 'display' && $NV_postmetaalign != 'post_title' ) { ?>   
            <aside class="post-metadata columns two">
                <?php include(NV_FILES .'/inc/classes/metadata-class.php'); // Style Meta Data  ?>
            </aside><!-- /post-metadata -->
            <?php } ?>
            
            <section class="entry <?php echo $columns; ?>">

				<?php if($NV_movieurl) {
                    echo do_shortcode('[audioembed type="'.$NV_videotype.'"  '.$NV_image_size.' url="'.$NV_movieurl.'" autoplay="'.$NV_videoautoplay.'" shadow="'.$NV_vidshadow.'" id="video'.get_the_ID().'"  imageurl="'.$NV_previewimgurl.'" ]'); 
                } ?>
            
				<header>
                    <div class="post-titles">
                        <?php 
						include(NV_FILES .'/inc/classes/post-title-class.php'); // Style Post Titles
						
						if( $NV_arhpostpostmeta == 'display' && $NV_postmetaalign == 'post_title' )
						{
							include(NV_FILES .'/inc/classes/metadata-class.php');
							
						} ?>
                    </div><!-- / .post-titles -->            
				</header>      
            
				<?php echo $NV_description; 

				wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'themeva' ) . '</span>', 'after' => '</div>' ) ); ?>
                
            </section><!-- / .entry -->  
        
        </div>
    
		<?php 
    	// Check if placed within a widget
        if( $NV_is_widget != true )
		{ 
			include(NV_FILES .'/inc/classes/post-footer-class.php');	 
		} ?>
    
	</article><!-- #post-<?php the_ID(); ?> -->