<?php
/**
 * @package Wish
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(get_post_format()): ?>
						
						<?php get_template_part( 'post-formats/content', get_post_format() ); ?>
						
						<?php else : ?>
						
						<?php get_template_part( 'post-formats/content', 'image' ); ?>
						
	<?php endif; ?>
</article><!-- #post-## -->