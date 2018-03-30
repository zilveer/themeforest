<?php
/**
 * The template for displaying posts title in the Link post format
 *
 * Used for single and index/archive/blog/search.
 *
 * @package WordPress
 * @subpackage Mango
 * @since Mango 1.0
 */
?>

<?php 
		global $post, $mango_settings,$blog_settings;
		$post_format = get_post_format( $post->ID );
		$ext_link = get_post_meta( $post->ID, 'mango_post_external_link', true ) ? get_post_meta( $post->ID, 'mango_post_external_link', true ) : '';
 
		if($post_format!="aside"):
			if( is_single() || ! $blog_settings['hide_blog_post_title'] || is_search() ):
				if ( 'link' == $post_format  ) : ?>
           <h2 class="entry-title"><a target="_blank" href="<?php echo esc_url( $ext_link ); ?>"><?php the_title();?></a></h2>
        <?php else: ?>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
        <?php endif; ?>
    <?php endif; ?>
 <?php endif; ?>