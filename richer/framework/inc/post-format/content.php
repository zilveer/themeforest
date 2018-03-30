<?php 
	global $thumbnail_size;
?>
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-image">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'richer'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
			<?php the_post_thumbnail($thumbnail_size); ?>
		</a>
	</div>
	<?php }?>
