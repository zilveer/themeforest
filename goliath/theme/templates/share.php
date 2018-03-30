<?php global $post; ?>

<div class="post-image-sharrre">
	<?php
	$thumb = plsh_get_thumbnail('gallery-large', true, false);
	if(!$thumb)
	{
		$thumb = '';
	}
	?>
  <div class="shareme" data-image="<?php echo esc_url($thumb); ?>" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>"></div>
</div>