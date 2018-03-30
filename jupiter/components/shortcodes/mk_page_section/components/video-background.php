<?php

$has_parallax 	= ($view_params['parallax'] == 'true');
$layer_config[] = ( $has_parallax ) ? 'data-mk-component="Parallax"' : '';
$layer_config[] = ( $has_parallax ) ? 'data-parallax-config=\'{"speed" : ' . floatval($view_params['speed_factor']) . ' }\'' : '';

if ($view_params['bg_video'] != 'yes') return false;

if ($view_params['video_source'] == 'self'){

		// Loop false doesn't work as expected and presence of loop attribute by itself determines behaviour
		// We keep true as value for crossbrowser compatibility (? not sure - refactor if needed) and remove attribute completly when false
		$loop = ($view_params['video_loop'] === 'true') ? 'loop="true"' : '';

		if (!empty($view_params['poster_image'])) { ?>
			<div style="background-image:url(<?php echo $view_params['poster_image']; ?>);" class="mk-video-section-touch  js-el" <?php echo implode(' ', $layer_config); ?>></div>
		<?php } ?>

		<div class="mk-section-video mk-center-video   js-el" <?php echo implode(' ', $layer_config); ?>>
			<video poster="<?php echo $view_params['poster_image']; ?>" muted="muted" preload="auto" <?php echo $loop; ?> autoplay="true" style="opacity:0;">

				<?php if (!empty($view_params['mp4'])) { ?>
				    <source type="video/mp4" src="<?php echo $view_params['mp4']; ?>" />
				<?php } ?>

				<?php if (!empty($view_params['webm'])) { ?>
				   	<source type="video/webm" src="<?php echo $view_params['webm']; ?>" />
				<?php } ?>

				<?php if (!empty($view_params['ogv'])) { ?>
				    <source type="video/ogg" src="<?php echo $view_params['ogv']; ?>" />
				<?php } ?>
			</video>
		</div>

	<?php } else { 

		$loop = ($view_params['video_loop'] === 'true') ? '1' : '0';
	?>
		<div class="mk-section-video   js-el" <?php echo implode(' ', $layer_config); ?>>
			<div class="video-social-hosted mk-center-video">

		    	<?php if ($view_params['stream_host_website'] == 'youtube'){ ?>
		    		<?php wp_enqueue_script('api-youtube'); ?>
		        	<iframe src="https://www.youtube.com/embed/<?php echo $view_params['stream_video_id']; ?>?rel=0&amp;wmode=transparent&amp;enablejsapi=1&amp;controls=0&amp;showinfo=0&amp;loop=<?php echo $loop; ?>&amp;playlist=<?php echo $view_params['stream_video_id']; ?>"></iframe>

		    	<?php } else if ($view_params['stream_host_website'] == 'vimeo'){ ?>
			    	<?php wp_enqueue_script('api-vimeo'); ?>
			        <iframe src="//player.vimeo.com/video/<?php echo $view_params['stream_video_id']; ?>?badge=0;api=1;loop=<?php echo $loop; ?>" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			    <?php } ?>
			</div>
		</div>

<?php 
}