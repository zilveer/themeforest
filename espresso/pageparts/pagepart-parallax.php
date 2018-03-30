<?php

$parallax_text = get_post_meta($post->ID,'_parallax_text',true);
$parallax_font_size = get_post_meta($post->ID,'_parallax_font_size',true);
$parallax_color = get_post_meta($post->ID,'_parallax_color',true);
$parallax_text_color = get_post_meta($post->ID,'_parallax_text_color',true);
$parallax_color_opacity = get_post_meta($post->ID,'_parallax_color_opacity',true);

$parallax_image = get_post_meta($post->ID,'_parallax_image',true);
$image_dir = site_url().'/wp-content/uploads';
if ( strpos($parallax_image, 'http') === false ) {
	$image_url = $image_dir.'/'.$parallax_image;
} else {
	$image_url = $parallax_image;
}

$parallax_color_opacity_lg = ($parallax_color_opacity * 100);

?><section id="parallax_page_section" class="parallax-zone" style="background:url('<?php echo $image_url; ?>') no-repeat fixed center center;">
	<div class="parallax-wrap" style="position:relative;">
		<?php if ($parallax_color): ?><div class="parallax-screen" style="top:0; left:0; zoom:1; -ms-filter:'progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo $parallax_color_opacity_lg; ?>)'; filter: alpha(opacity=<?php echo $parallax_color_opacity_lg; ?>); -moz-opacity:<?php echo $parallax_color_opacity; ?>; -khtml-opacity: <?php echo $parallax_color_opacity; ?>; opacity: <?php echo $parallax_color_opacity; ?>; background:<?php echo $parallax_color; ?>;"></div><?php endif; ?>
		<div style="font-weight:300; text-align:center; padding:100px 10%; font-size:<?php echo $parallax_font_size; ?>px; line-height:<?php echo $parallax_font_size + 15; ?>px;<?php echo ($parallax_text_color ? 'color:'.$parallax_text_color.';' : 'color:#fff;'); ?>"><?php echo $parallax_text; ?></div>
	</div>
</section>