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
        
			<?php if( $NV_arhpostpostmeta == 'display' && $NV_postmetaalign != 'post_title' )
            { ?>
                <aside class="post-metadata columns two">
                    <?php include(NV_FILES .'/inc/classes/metadata-class.php'); // Style Meta Data  ?>
                </aside><!-- /post-metadata -->
            <?php 
            } ?>

			<section class="entry <?php echo $columns; ?>">
                    
				<?php 

				if( !empty($NV_movieurl) && $NV_displayblogimage == 'display' && !empty( $NV_videotype ) )
				{
					echo do_shortcode('[videoembed type="'.$NV_videotype.'" '.$NV_image_size.' url="'.$NV_movieurl.'" autoplay="'.$NV_videoautoplay.'" shadow="'.$NV_vidshadow.'" id="video'.get_the_ID().'"  align="'.$NV_imgalign.'"  imageurl="'.$NV_previewimgurl.'" ]'); 
				}
				else
				{
					echo do_shortcode('[imageeffect type="'.$NV_imageeffect.'" '.$NV_image_size.' align="'.$NV_imgalign.'" alt="'.get_the_title().'" link="'. ( $NV_is_widget == true ? get_permalink() : '' ) .'" '.$NV_showlightbox.' url="'.$NV_previewimgurl.'" videourl="'. $NV_movieurl .'" ]'); 
		
				}			
                    
				include(NV_FILES .'/inc/classes/post-title-class.php'); // Style Post Titles
						
				if( empty( $NV_imgalign ) || $NV_imgalign == 'aligncenter' && ( $NV_arhpostpostmeta == 'display' && $NV_postmetaalign == 'post_title' ) )
				{
					echo '<div class="post-titles">';
					include(NV_FILES .'/inc/classes/metadata-class.php');    
					echo '</div>';  
				} 				
						
				echo $NV_description; 
						
				// If image is aligned left / right, display post metadata below
				if(  $NV_imgalign == 'alignleft' || $NV_imgalign == 'alignright' && ( $NV_arhpostpostmeta == 'display' && $NV_postmetaalign == 'post_title' ) )
				{
					echo '<div class="post-titles">';
					include(NV_FILES .'/inc/classes/metadata-class.php');    
					echo '</div>';  
				} 					
						
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