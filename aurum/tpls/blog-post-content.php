<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if($more):
?>
	<div class="post-formatting">
	<?php the_content(); ?>
	</div>

	<?php
	wp_link_pages(array(
		'before'   => '<div class="pagination post-pagination">',// . __( 'Pages:', 'aurum'),
		'after'    => '</div>',
		'pagelink' => '<span class="active">%</span>'
	));
	?>
	<?php else: ?>
	<?php the_excerpt(); ?>
	<a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Continue reading', 'aurum'); ?></a>
<?php
endif;
