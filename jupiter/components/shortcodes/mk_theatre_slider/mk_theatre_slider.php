<?php
$path = pathinfo(__FILE__) ['dirname'];
include ($path . '/config.php');

$id = Mk_Static_Files::shortcode_id();

$max_width = !empty($max_width) ? ('max-width:'.$max_width.'px !important;') : '';
$margin_bottom = !empty($margin_bottom) ? ('margin-bottom:'.$margin_bottom.'px;') : '';
$background_style = str_replace('_style', '', $background_style);

?>

<div id="theatre-slider-<?php echo $id; ?>" class="theatre-slider <?php echo $align; ?>-align <?php echo $el_class; ?>">
	<div class="<?php echo $background_style; ?>-theatre-slider">
		<img src="<?php echo THEME_IMAGES; ?>/<?php echo $background_style; ?>-theatre-slideshow.png" />
		<div class="player-container">
			<div class="player">

			<?php if($host == 'self_hosted'){ ?>

				<video poster="<?php echo $poster_image; ?>" controls>

					<?php if ( !empty( $mp4 ) ) { ?>

						<source type="video/mp4" src="<?php echo $mp4; ?>" />

					<?php } if ( !empty( $webm ) ) { ?>

						<source type="video/webm" src="<?php echo $webm; ?>" />

					<?php } if ( !empty( $ogv ) ) { ?>

						<source type="video/ogg" src="<?php echo $ogv; ?>" />

					<?php } ?>
				</video>

			<?php } else{

				if($stream_host_website == 'youtube'){ ?>

						<iframe width="560" height="315" src="//www.youtube.com/embed/<?php echo $stream_video_id; ?>?rel=0&amp;controls=<?php echo ($video_controls == 'true' ? 1 : 0); ?>&amp;showinfo=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

				        <?php
				        wp_enqueue_script('api-youtube');

				}else if($stream_host_website == 'vimeo'){ ?>

						<iframe src="//player.vimeo.com/video/<?php echo $stream_video_id; ?>?badge=0&amp;autoplay=0&amp;loop=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

				        <?php
				        wp_enqueue_script('api-vimeo');
				}
			}
			?>

			</div>
		</div>
	</div>
</div>


<?php

Mk_Static_Files::addCSS("

	#theatre-slider-{$id}{
		{$margin_bottom}
	}
	#theatre-slider-{$id} > div{
		{$max_width}
	}
 "
	, $id);
