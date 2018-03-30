<?php while (have_posts()) : the_post();

	echo '<div class="container">' . do_shortcode( '[swift_slider specific_post_id="' . $post->ID . '" max_height="600" continue="no" fullscreen="false"]' ) . '</div>';

endwhile;
