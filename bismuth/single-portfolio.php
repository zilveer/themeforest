<?php
the_post();
$title = get_the_title();
$image1 = get_post_meta($post->ID, '_portfolio_image1', true);
$image2 = get_post_meta($post->ID, '_portfolio_image2', true);
$image3 = get_post_meta($post->ID, '_portfolio_image3', true);
$image4 = get_post_meta($post->ID, '_portfolio_image4', true);
$image5 = get_post_meta($post->ID, '_portfolio_image5', true);
$image6 = get_post_meta($post->ID, '_portfolio_image6', true);
$video1 = get_post_meta($post->ID, '_portfolio_video1', true);
$video2 = get_post_meta($post->ID, '_portfolio_video2', true);
$video3 = get_post_meta($post->ID, '_portfolio_video3', true);
$video4 = get_post_meta($post->ID, '_portfolio_video4', true);
$video5 = get_post_meta($post->ID, '_portfolio_video5', true);
$video6 = get_post_meta($post->ID, '_portfolio_video6', true);

$type = get_post_meta($post->ID, '_portfolio_type', true);
$description = get_post_meta($post->ID, '_portfolio_description', true);
$buttontext = get_post_meta($post->ID, '_portfolio_buttontext', true);
$buttonurl = get_post_meta($post->ID, '_portfolio_buttonurl', true);

global $wp_embed;
if($image1 != '' || $video1 != '') {
?>
	<div class="two-thirds column">
		<div class="portfolio-item">
			<div class="flexslider flex-viewport flexslider2">
				<ul class="slides">
					<?php 
					if($image1 != '')
						echo '<li><img src="' . $image1 . '" alt="" /></li>';
					elseif($video1 != '')
						echo '<li>' . $wp_embed->run_shortcode('[embed]' . $video1 . '[/embed]') . '</li>';

					if($image2 != '')
						echo '<li><img src="' . $image2 . '" alt="" /></li>';
					elseif($video2 != '')
						echo '<li>' . $wp_embed->run_shortcode('[embed]' . $video2 . '[/embed]') . '</li>';

					if($image3 != '')
						echo '<li><img src="' . $image3 . '" alt="" /></li>';
					elseif($video3 != '')
						echo '<li>' . $wp_embed->run_shortcode('[embed]' . $video3 . '[/embed]') . '</li>';

					if($image4 != '')
						echo '<li><img src="' . $image4 . '" alt="" /></li>';
					elseif($video4 != '')
						echo '<li>' . $wp_embed->run_shortcode('[embed]' . $video4 . '[/embed]') . '</li>';

					if($image5 != '')
						echo '<li><img src="' . $image5 . '" alt="" /></li>';
					elseif($video5 != '')
						echo '<li>' . $wp_embed->run_shortcode('[embed]' . $video5 . '[/embed]') . '</li>';

					if($image6 != '')
						echo '<li><img src="' . $image6 . '" alt="" /></li>';
					elseif($video6 != '')
						echo '<li>' . $wp_embed->run_shortcode('[embed]' . $video6 . '[/embed]') . '</li>';

					?>
				</ul>
			</div><!-- end flexslider -->
		</div> <!-- end portfolio-item -->	
	</div> <!-- end two-thirds columns -->
				
	<div class="sixteen columns">
		<p class="single-portfolio-title"><?php echo $title;?></p>
		<p><?php echo htmlspecialchars_decode($description);?></p>
		<?php if($buttontext != '') { ?>
			<a target="_blank" href="<?php if($buttonurl != '') echo $buttonurl; else echo '#';?>">
				<div class="button1"><?php echo $buttontext;?></div>
			</a>
		<?php } ?>
		<div class="button1 close"><?php _e('Close', 'LB');?></div>
	</div> <!-- end one-third column -->
	<div class="clear"></div>
	<script type="text/javascript">
		jQuery('.flexslider2').flexslider();
		jQuery(".portfolio_details .close, .filter-categories a").on("click", function(e) {
			e.preventDefault();
			jQuery(".portfolio_details").hide(600).html("");
		});
	</script>
<?php } ?>