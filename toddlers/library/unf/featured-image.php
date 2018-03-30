<?php
if ( has_post_thumbnail() ) {?>
<div class="post-featured-image">
	<?php
	  the_post_thumbnail('post-featured');

	if (is_page() || is_single()) {?>
	<div class="overlay"></div>
	<?php } else { ?>
	<a class="overlay" href="<?php the_permalink() ?>"></a>
	<?php } ?>
</div>
<?php } ?>