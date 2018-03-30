<?php
/**
 * Blog Template Part: Adjacent Links
 * @version 1.0
 */
?>

<!-- Start Previous / Next Post -->
<section id="post-adj-nav">
	<div class="row">
		<?php 
			$prev_post = get_adjacent_post(false, '', true);
			
			if(!empty($prev_post)) {
				$excerpt = $prev_post->post_content;
				$previd = $prev_post->ID;
				
				echo '<div class="col-md-6 columns"><div class="post-navi prev"><a href="' . get_permalink($previd) . '" title="' . $prev_post->post_title . '"><i class="icon-left-open"></i>' . __("Previous Article", 'smartfood') . '</a></div></div>'; 
			}
		?>
		<?php
			$next_post = get_adjacent_post(false, '', false);
			
			if(!empty($next_post)) {
				$excerptnext = $next_post->post_content;
				$nextid = $next_post->ID;
				
				echo '<div class="col-md-6 columns"><div class="post-navi next"><a href="' . get_permalink($nextid) . '" title="' . $next_post->post_title . '"><i class="icon-right-open"></i>' . __("Next Article", 'smartfood') . '</a></div></div>'; 
			}
		?>
	</div>
</section>