<div class="four columns">
	<div class="blog-sidebar">
		<?php
		
		$sidebar = get_post_meta($post->ID, "incr_sidebar_set", $single = true);
		if ($sidebar) {
			if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar)) : ?>
			<?php endif;
		}?>

		<?php
		if (!$sidebar) {
			if (!dynamic_sidebar('sidebar')) : endif;
	    } // end primary widget area   
	    ?>
	</div>
</div>

