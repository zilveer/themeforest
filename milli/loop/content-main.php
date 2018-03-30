<?php
	$format = get_post_format();
	if(!( $format )) 
		$format = 'standard';
		
	/**
	 * Determine if we're looking at a single post or a feed, and prepend our theme options accordingly
	 */
	( is_single() ) ? $location = 'single_' : $location = 'index_';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if( !is_search() ) : ?>
		<div class="format-<?php echo $format; ?>-wrapper clearfix">
			<?php 
				get_template_part( 'postformats/format', $format );
			?>
		</div>
	<?php endif; ?>
	
	<?php	
		the_title('<h2 class="article-title entry-title"><a href="'. get_permalink().'">','</a></h2>'); 
		
		if( get_option($location.'meta','1') == '1' )
			echo '<div class="two_thirds">';
			
		the_excerpt();
	?>
	
	<a href="<?php the_permalink(); ?>"><?php echo get_option('blog_continue', 'Continue Reading &rarr;'); ?></a>
	
	<?php if( get_option($location.'meta','1') == '1' ) : ?>	
		</div>
		
		<div class="one_third last">
		
			<?php get_template_part('loop/content','meta'); ?>
			
		</div>
		<div class="clear"></div>
	<?php endif; ?>
	
</article>