<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 */
 

/* :: Get Custom Field Data
--------------------------------------------- */

include(NV_FILES .'/inc/classes/blog-class.php');
include(NV_FILES .'/inc/classes/post-fields-class.php');

if( get_post_type( $post ) == 'portfolio' ) 
{
	$NV_arhpostpostmeta = 'disable';
	$columns = 'twelve columns';
}

/* :: / ------------------------------------- */ ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    	<div class="row"> 
        
		<?php if( $NV_arhpostpostmeta == 'display' && $NV_postmetaalign != 'post_title' )
		{ ?>
            
        <aside class="post-metadata columns two">
        <?php include(NV_FILES .'/inc/classes/metadata-class.php'); ?>
        </aside><!-- /post-metadata -->
            
        <?php
		
		} ?>
        
        <header class="post-titles <?php echo $columns; ?>">

			<?php 
			if( !empty($NV_previewimgurl) && $NV_displayblogimage == 'display' ) 
			{
				if( is_single() && empty( $NV_showlightbox ) )
				{
					$NV_permalink = '';
				}				
				echo do_shortcode('[imageeffect type="'.$NV_imageeffect.'" align="'.$NV_imgalign.'" '.$NV_image_size.' alt="'.get_the_title().'" link="'.$NV_permalink.'" '.$NV_showlightbox.' url="'.$NV_previewimgurl.'" ]'); 
            }
			
			include(NV_FILES .'/inc/classes/post-title-class.php'); // Style Post Titles
			
			if( $NV_arhpostpostmeta == 'display' && $NV_postmetaalign == 'post_title' )
			{
				include(NV_FILES .'/inc/classes/metadata-class.php');
                
            } ?>
            
        </header><!-- / .post-titles -->
        
        <section class="entry <?php echo $columns; ?>">
        
            <?php echo $NV_description; 
			
			if( empty( $NV_disablereadmore ) ) $NV_disablereadmore='';
			
            if( $NV_disablegallink != 'yes' && $NV_disablereadmore != 'yes' && $NV_nolink != 'yes' ) 
			{ 
				echo themeva_readmore( $post_link );
			}
			
			wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'NorthVantage' ) . '</span>', 'after' => '</div>', 'link_before' => '<span class="pagination">', 'link_after' => '</span>' ) ); ?>
  
        </section><!-- / .entry -->
        
        </div>
    
		<?php 
    
        if( $NV_is_widget != true ) { // Check if placed within a widget ?>
        
        <footer class="row">
        	<section class="twelve columns">
				<?php // if single 
				if( is_single() )
				{ 
					include(NV_FILES .'/inc/classes/single-class.php');
                } ?>
            </section>
        </footer>
        
        <?php  }  ?>
    
	</article><!-- #post-<?php the_ID(); ?> -->