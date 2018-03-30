<?php
/**
 * Template Name: Simple Builder Blog Grid with sidebar
 *
 * @package WordPress
 * @subpackage simple builder
 * @since 1.0
 */


?>
		<article <?php post_class( 'uou-block-7c'); ?> id="post-<?php the_ID(); ?>" >
		          <?php 
		          if ( has_post_thumbnail() ) {
		            $image_id 		= get_post_thumbnail_id( get_the_ID() );
		            $large_image 	= wp_get_attachment_url( $image_id ,'full');  
		            $resize 		= sb_aq_resize( $large_image, 262, 148, true );
		           ?>
		        <img class="thumb" src= "<?php echo esc_url($resize); ?>" alt="">
			    <span class="date"> <?php echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?></span>
			    <h1><a href= "<?php the_permalink(); ?>" > <?php echo esc_attr(ShortenText(get_the_title())); ?></a></h1>
				<p> <?php the_excerpt();  ?> </p>

			<?php  } else { ?>

			    <span class="date"><?php echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?></span>
			    <h1><a href= "<?php the_permalink(); ?>" > <?php echo esc_attr(ShortenText(get_the_title())); ?></a></h1>
				<p> <?php the_excerpt(); ?> </p>
			<?php } ?>
		

		</article>

