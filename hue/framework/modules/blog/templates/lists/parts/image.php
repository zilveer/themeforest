<?php
if(!isset($image_size)){
	$image_size = 'full';
}
if ( has_post_thumbnail() ) { ?>
	<div class="mkd-post-image">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail($image_size); ?>
		</a>
	</div>
<?php } ?>