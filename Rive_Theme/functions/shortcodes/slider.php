<?php
/*
* Show slider
*/

/*
function show_slider ($content) {

	// Found [slider] shortcode
	if (preg_match_all("/(.?)\[(slider)\b(.*?)(?:(\/))?\](?:(.+?)\[\/slider\])?(.?)/s", $content, $matches)) {

	}
}

add_filter('the_content', 'show_slider');
*/

// Slider shordcode
function ch_slider ($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'effect'     => 'random',
		'navigation' => 'false',
		'delay'      => 5000,
		'hoverPause' => 'true',
		'title'      => ''
	), $atts));

	if (!preg_match_all("/(.?)\[(slide)\b(.*?)(?:(\/))?\](?:(.+?)\[\/slide\])?(.?)/s", $content, $matches)) {
		return 'slider error';
	}

	$params = array();
	for($i=0; $i < count($matches[0]); $i++) {
		$params[$i] = shortcode_parse_atts($matches[3][$i]);
	}

	ob_start();
?>
[raw]
	<div class="slideshow">
		<div class="slideshow-inner">
			<?php for($i=0; $i < count($matches[0]); $i++): ?>
				<?php if(!empty($params[$i]['img'])): ?>
					<a class="img-block">
						<img src="<?php echo $params[$i]['img'] ?>" alt="" />
					</a>
					<span class="text-block">
						<?php
							if (!empty($title))
								echo '<h1>' . $title . '</h1>'
						?>
						<?php echo do_shortcode($matches[5][$i]); ?>
					</span>
				<?php else: ?>
					<span class="text-block">
						<?php
							if (!empty($title))
								echo '<h1>' . $title . '</h1>'
						?>
						<?php echo do_shortcode($matches[5][$i]); ?>
					</span>
				<?php endif ?>
			<?php endfor; ?>
		</div><!--end of slideshow-inner-->
		<div class="dog-foot"></div>
	</div><!--end of slideshow-->
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('.slideshow').coinslider({
				width: 960,
				height: 360,
				navigation: <?php echo $navigation; ?>,
				delay: <?php echo $delay; ?>,
				//hoverPause: <?php $hoverPause; ?>,
				effect: '<?php $effect; ?>'
			});
		});
	</script>
[/raw]
<?php
	return ob_get_clean();
}
add_shortcode('slider', 'ch_slider');