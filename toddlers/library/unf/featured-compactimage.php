<a href="<?php the_permalink() ?>" class='compact-post-thumbnail'>
	<?php
	if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
		 the_post_thumbnail('post-featured-compact');
	} else {?>
	<img src="<?php echo get_template_directory_uri(); ?>/library/img/searchstar.svg" data-no-retina="">
	<?php } ?>

</a>