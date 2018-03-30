<!-- Start Previous / Next Post -->
<section id="post-prevnext" class=" hide-on-print">
	<div class="row">
		<?php 
			$prev_post = get_adjacent_post(false, '', true);
			
			if(!empty($prev_post)) {
				$excerpt = $prev_post->post_content;
				$previd = $prev_post->ID;
				
				echo '<div class="small-12 medium-6 columns"><div class="post-navi prev"><a href="' . get_permalink($previd) . '" title="' . $prev_post->post_title . '"><span>' . __("Previous", 'north') . '</span>' . $prev_post->post_title . '</a></div></div>'; 
			}
		?>
		<?php
			$next_post = get_adjacent_post(false, '', false);
			
			if(!empty($next_post)) {
				$excerptnext = $next_post->post_content;
				$nextid = $next_post->ID;
				
				echo '<div class="small-12 medium-6 columns"><div class="post-navi next"><a href="' . get_permalink($nextid) . '" title="' . $next_post->post_title . '"><span>' . __("Next", 'north') . '</span>' . $next_post->post_title . '</a></div></div>'; 
			}
		?>
	</div>
</section>
<?php wp_reset_query(); ?>
<!-- End Previous / Next Post -->