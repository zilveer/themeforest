<?php
include_once('archive-settings.php');	
?>

<?php

	if ( have_posts() ) :
		while ( have_posts() ) : the_post();

			get_template_part('items/' . $item_template);

		endwhile;
	else:
		echo __('Nothing Found!', IRON_TEXT_DOMAIN);	
	endif;

?>


<?php 
	$next_link = get_next_posts_link(__('More', IRON_TEXT_DOMAIN),''); 
	$next_link = str_replace('<a ', '<a data-rel="post-list" '.implode(' ', $attr).' class="button-more" ', $next_link);
	
	echo $next_link;
?>


	
