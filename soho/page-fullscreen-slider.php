<?php 
/*
Template Name: Fullscreen Slider
*/
if ( !post_password_required() ) {
get_header('fullscreen');
the_post();

$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$pf = get_post_format();			
	wp_enqueue_script('gt3_fsGallery_js', get_template_directory_uri() . '/js/fs_gallery.js', array(), false, true);
	wp_enqueue_script('gt3_swipe_js', get_template_directory_uri() . '/js/jquery.event.swipe.js', array(), false, true);
	
?>
	<?php 
        $sliderCompile = "";
	if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['slides']) && is_array($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'])) {
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['thumbnails']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['thumbnails'] == "off") {
			$thumbs_state = $gt3_theme_pagebuilder['sliders']['fullscreen']['thumbnails'];
			$thmb_class = 'pag-hided';
			$pag_class = 'show-pag';
		} else {
			$thumbs_state = "on";
			$thmb_class = '';
			$pag_class = '';
		}
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['video_cover']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['video_cover'] == 'on') {
			$video_cover = 1;
		} else {
			$video_cover = 0;
		}

		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['controls']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['controls'] !== 'on') {
			$controls = 0;
		} else {
			$controls = 1;
		}
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['thumbs']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['thumbs'] !== 'off') {
			$thmbs = 1;
		} else {
			$thmbs = 0;
		}		
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['autoplay']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['autoplay'] == "off") {
			$autoplay = 0;
		} else {
			$autoplay = 1;
		}
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['interval']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['interval'] > 0) {
			$interval = $gt3_theme_pagebuilder['sliders']['fullscreen']['interval'];
		} else {
			$interval = 3300;
		}
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['fit_style'])) {
			$fit_style = $gt3_theme_pagebuilder['sliders']['fullscreen']['fit_style'];
		} else {
			$fit_style = "no_fit";
		}
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['video_cover']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['video_cover'] !== 'on') {
			$video_cover = 0;
		} else {
			$video_cover = 1;
		}
		
		$sliderCompile .= '<script>gallery_set = [';
		foreach ($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'] as $imageid => $image) {
			$uniqid = mt_rand(0, 9999);
			if (!isset($gt3_theme_pagebuilder['settings']['show_title']) || $gt3_theme_pagebuilder['settings']['show_title'] !== "no") {
				if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoTitle = ": " . $image['title']['value'];} else {$photoTitle = "&nbsp;";}
			} else {
				if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoTitle = $image['title']['value'];} else {$photoTitle = "";}
			}
			if (isset($image['caption']['value']) && strlen($image['caption']['value'])>0) {$photoCaption  = $image['caption']['value'];} else {$photoCaption = "";}
			$titleColor = "a8abad";
			$captionColor = "a8abad";
			
			if ($image['slide_type'] == 'image') {
				$sliderCompile .= '{type: "image", image: "' . wp_get_attachment_url($image['attach_id']) . '", thmb: "'.aq_resize(wp_get_attachment_url($image['attach_id']), "130", "130", true, true, true).'", alt: "' . str_replace('"', "'",  $photoTitle) . '", title: "' . str_replace('"', "'", $photoTitle) . '", description: "' . str_replace('"', "'",  $photoCaption) . '", titleColor: "#'.$titleColor.'", descriptionColor: "#'.$captionColor.'"},';
			} else if ($image['slide_type'] == 'video') {
				#YOUTUBE
				$is_youtube = substr_count($image['src'], "youtu");				
				if ($is_youtube > 0) {
					$videoid = substr(strstr($image['src'], "="), 1);					
					$thmb = "http://img.youtube.com/vi/".$videoid."/0.jpg";
					$sliderCompile .= '{type: "youtube", uniqid: "' . $uniqid . '", src: "' . $videoid . '", thmb: "'.$thmb.'", alt: "' . str_replace('"', "'",  $photoTitle) . '", title: "' . str_replace('"', "'", $photoTitle) . '", description: "' . str_replace('"', "'",  $photoCaption) . '", titleColor: "#'.$titleColor.'", descriptionColor: "#'.$captionColor.'"},';
				}
				#VIMEO
				$is_vimeo = substr_count($image['src'], "vimeo");				
				if ($is_vimeo > 0) {
					$videoid = substr(strstr($image['src'], "m/"), 2);
					$thmbArray = json_decode(file_get_contents("http://vimeo.com/api/v2/video/".$videoid.".json"));
					if (!empty($thmbArray))
					$thmb = $thmbArray[0]->thumbnail_large;
					$sliderCompile .= '{type: "vimeo", uniqid: "' . $uniqid . '", src: "' . $videoid . '", thmb: "'.$thmb.'", alt: "' . str_replace('"', "'",  $photoTitle) . '", title: "' . str_replace('"', "'", $photoTitle) . '", description: "' . str_replace('"', "'",  $photoCaption) . '", titleColor: "#'.$titleColor.'", descriptionColor: "#'.$captionColor.'"},';
				}				
			}
		}
	$sliderCompile .= "]
	jQuery(document).ready(function(){
		header.addClass('fixed_header');
		jQuery('.custom_bg').remove();
		jQuery('body').fs_gallery({
			fx: 'fade', /*fade, zoom, slide_left, slide_right, slide_top, slide_bottom*/
			fit: '". $fit_style ."',
			slide_time: ". $interval .", /*This time must be < then time in css*/
			autoplay: ".$autoplay.",
			show_controls: ". $controls .",
			video_cover: ". $video_cover .",
			slides: gallery_set
		});
		jQuery('.fs_share').click(function(){
			jQuery('.fs_fadder').removeClass('hided');
			jQuery('.fs_sharing_wrapper').removeClass('hided');
			jQuery('.fs_share_close').removeClass('hided');
		});
		jQuery('.fs_share_close').click(function(){
			jQuery('.fs_fadder').addClass('hided');
			jQuery('.fs_sharing_wrapper').addClass('hided');
			jQuery('.fs_share_close').addClass('hided');
		});
	});
	</script>";
	echo $sliderCompile;?>
	<style>
		.custom_bg,
		.fixed_bg {
			display:none;
		}
	</style>
	<div class="fs_controls">
    	<div class="share_block">
        	<a href="<?php echo esc_js("javascript:void(0)");?>" class="share_toggle"><?php echo __('Share', 'theme_localization'); ?></a>
            <div class="share_box">
                <a target="_blank"
                   href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>"
                   class="share_facebook"><i
                        class="stand_icon icon-facebook-square"></i></a>
                <a target="_blank"
                   href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen($featured_image[0])>0) ? $featured_image[0] : gt3_get_theme_option("logo"); ?>"
                   class="share_pinterest"><i class="stand_icon icon-pinterest"></i></a>                                                            
                <a target="_blank"
                   href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>"
                   class="share_tweet"><i class="stand_icon icon-twitter"></i></a>
                <a target="_blank"
                   href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"
                   class="share_gplus"><i class="icon-google-plus-square"></i></a>
            </div> 
        </div>
        <div class="title_wrapper">
        	<?php if (!isset($gt3_theme_pagebuilder['settings']['show_title']) || $gt3_theme_pagebuilder['settings']['show_title'] !== "no") { ?>
        	<h1 class="fs_title_main"><?php echo the_title(); ?>&nbsp;</h1>
            <?php } ?>
            <h2 class="fs_title"></h2><span class="fs_descr"></span>
		</div>
        <div class="fs_controls_append">
	        <a href="<?php echo esc_js("javascript:void(0)");?>" class="close_controls"></a>
        </div>
    </div>
    <a href="<?php echo esc_js("javascript:void(0)");?>" class="close_controls show_me_always"></a>
    <script>
		jQuery(document).ready(function(){
			jQuery('.main_header').removeClass('hided');
			jQuery('html').addClass('single-gallery');
			<?php if ($controls == 'false') {
				echo "jQuery('html').addClass('hide_controls');";				
			} ?>
			<?php if ($thmbs == 0) {
				echo "jQuery('html').addClass('without_thmb');";
			} ?>
			jQuery('.share_toggle').click(function(){
				jQuery('.share_block').toggleClass('show_share');
			});
		});	
	</script>

	<?php } else { ?>

    <script>
		var wrapper404 = jQuery('.wrapper404');
		jQuery(document).ready(function(){
			centerWindow();
			html.addClass('error404');
		});
		jQuery(window).resize(function(){
			setTimeout('centerWindow()',500);
			setTimeout('centerWindow()',1000);			
		});
		function centerWindow() {
			setTop = (window_h - wrapper404.height())/2;
			wrapper404.css('top', setTop +'px');
			wrapper404.removeClass('fixed');
		}
	</script>
			
	<?php 
	}
	?>
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