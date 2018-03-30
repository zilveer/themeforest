<li class="cbp-item">
	<div class="cbp-caption-defaultWrap">
		<?php 
			the_post_thumbnail('team');
			the_title('<h4 class="text-center">','</h4>'); 
		?>
		<div class="cbp-l-grid-team-position"><?php echo get_post_meta( $post->ID, '_ebor_the_job_title', true ); ?></div>
	</div>
</li>