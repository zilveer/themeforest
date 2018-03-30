<?php
if ( ! has_post_thumbnail() )
	return;
?>

<figure class="featured standard">

	<?php the_post_thumbnail( is_retro_post_type() ? 'retro-big' : null ); ?>

</figure>