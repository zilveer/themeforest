<?php
/**
 * The default template for displaying standard post format
 */
	global $gdlr_post_settings; 
	if( $gdlr_post_settings['excerpt'] < 0 ){ global $more; $more = 0; }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="gdlr-standard-style">
		<?php get_template_part('single/thumbnail', get_post_format()); ?>

		<header class="post-header">
			<?php if( is_single() ){ ?>
				<h1 class="gdlr-blog-title"><?php the_title(); ?></h1>
			<?php }else{ ?>
				<h3 class="gdlr-blog-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php } ?>
			
			<?php echo gdlr_get_blog_info(array('date', 'tag', 'author')); ?>	
			<div class="clear"></div>
		</header><!-- entry-header -->

		<?php 
			if( $gdlr_post_settings['excerpt'] < 0 ){
				echo '<div class="gdlr-blog-content">';
				echo gdlr_content_filter($gdlr_post_settings['content'], true);
				wp_link_pages( array(
					'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'gdlr_translate' ) . '</span>', 
					'after' => '</div>', 
					'link_before' => '<span>', 
					'link_after' => '</span>' )
				);
				echo '</div>';
			}else if( $gdlr_post_settings['excerpt'] != 0 ){
				echo '<div class="gdlr-blog-content">';
				echo get_the_excerpt();
				
				echo '<div class="blog-info blog-comment"><i class="icon-comments"></i>';
				echo '<a href="' . get_permalink() . '#respond" >' . get_comments_number() . '</a>';						
				echo '</div>';	
				echo '</div>';
			}
		?>
	</div>
</article><!-- #post -->