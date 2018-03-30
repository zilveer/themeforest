<?php 
/*
Template Name: Gallery - Kenburns
*/
if ( !post_password_required() ) {
get_header('fullscreen');
the_post();

$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$pf = get_post_format();			
	wp_enqueue_script('gt3_kenburns_js', get_template_directory_uri() . '/js/kenburns.js', array(), false, true);
?>
	<?php 
        $sliderCompile = "";
    ?>
	<?php 
	if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['slides']) && is_array($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'])) {
		$sliderCompile .= '<script>gallery_set = [';
		foreach ($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'] as $imageid => $image) {
			$sliderCompile .= "'" . wp_get_attachment_url($image['attach_id']) . "',";			
		}

		$sliderCompile .= "]
		jQuery(document).ready(function(){
			jQuery('.custom_bg').remove();
			jQuery('#kenburns').attr('width', window_w);
			jQuery('#kenburns').attr('height', window_h);
			jQuery('#kenburns').css('top', header.height()+'px');
			jQuery('#kenburns').remove();
			setTimeout('kenburns_resize()',150);
		});
	
		function kenburns_resize() {
			jQuery('.gallery_kenburns').append('<canvas id=\"kenburns\"><p>Your browser does not support canvas!</p></canvas>');
			jQuery('#kenburns').attr('width', window_w);
			jQuery('#kenburns').attr('height', window_h);
				jQuery('#kenburns').kenburns({
					images: gallery_set,
					frames_per_second: 30,
					display_time: 5000,
					fade_time: 1000,
					zoom: 1.2,
					background_color:'#000000'
				});				
				jQuery('#kenburns').css('top', '0px');
		}
		jQuery(window).resize(function(){ 
			jQuery('#kenburns').remove();
			setTimeout('kenburns_resize()',300);
		});							
		</script>";	
		echo $sliderCompile;
		echo "
		<div class='gallery_kenburns'>
			<canvas id='kenburns'>
				<p>Your browser doesn't support canvas!</p>
			</canvas>
		</div>	
		";
	}?>
<?php get_footer('none'); 
} else {
	get_header('fullscreen');
?>
    <div class="pp_block">
        <h1 class="pp_title"><?php  _e('THIS CONTENT IS', 'theme_localization') ?> <span><?php  _e('PASSWORD PROTECTED', 'theme_localization') ?></span></h1>
        <div class="pp_wrapper">
            <?php the_content(); ?>
        </div>
    </div>
    <div class="global_center_trigger"></div>	
    <script>
		jQuery(document).ready(function(){
			jQuery('.post-password-form').find('label').find('input').attr('placeholder', 'Enter The Password...');
		});
	</script>
<?php 
	get_footer('fullscreen');
} ?>