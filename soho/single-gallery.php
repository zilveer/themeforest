<?php 
if ( !post_password_required() ) {
get_header('fullscreen');
$all_likes = gt3pb_get_option("likes");
the_post();
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$pf = get_post_format();			
wp_enqueue_script('gt3_swipe_js', get_template_directory_uri() . '/js/jquery.event.swipe.js', array(), false, true);

$galleryType = gt3_get_theme_option('default_gallery_style');
if (isset($gt3_theme_pagebuilder['settings']['gallery_style'])) {	
	if ($gt3_theme_pagebuilder['settings']['gallery_style'] == 'fw-gallery-post') { 
		$galleryType = 'fw-gallery-post';
	}
	if ($gt3_theme_pagebuilder['settings']['gallery_style'] == 'ribbon-gallery-post') { 
		$galleryType  = 'ribbon-gallery-post';
	}
	if ($gt3_theme_pagebuilder['settings']['gallery_style'] == 'grid-gallery-post') { 
		$galleryType  = 'grid-gallery-post';
	}
	if ($gt3_theme_pagebuilder['settings']['gallery_style'] == 'masonry-gallery-post') { 
		$galleryType  = 'masonry-gallery-post';
	}
}

	/* ADD 1 view for this post */
	$post_views = (get_post_meta(get_the_ID(), "post_views", true) > 0 ? get_post_meta(get_the_ID(), "post_views", true) : "0");
	update_post_meta(get_the_ID(), "post_views", (int)$post_views + 1);
	
	wp_enqueue_script('gt3_cookie_js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);
	wp_enqueue_script('gt3_swipe_js', get_template_directory_uri() . '/js/jquery.event.swipe.js', array(), false, true);
	$all_likes = gt3pb_get_option("likes");	
	if ($galleryType == 'fw-gallery-post') {
		wp_enqueue_script('gt3_fsGallery_js', get_template_directory_uri() . '/js/fs_gallery.js', array(), false, true);
?>
	<?php 
        $sliderCompile = "";
	if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['slides']) && is_array($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'])) {

		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['fit_style']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['fit_style'] !== 'default') {
			$fit_style = $gt3_theme_pagebuilder['sliders']['fullscreen']['fit_style'];
		} else {
			$fit_style = gt3_get_theme_option("default_fit_style");
		}
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['controls']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['controls'] !== 'default') {
			$controls = $gt3_theme_pagebuilder['sliders']['fullscreen']['controls'];
		} else {
			$controls = gt3_get_theme_option("default_controls");
		}
		if ($controls == 'on' || $controls == 'yes') {
			$controls = 'true';
		} else {
			$controls = 'false';
		}
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['thumbs']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['thumbs'] !== 'no') {
			$thmbs = 1;
		} else {
			$thmbs = 0;
		}
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['autoplay']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['autoplay'] !== 'default') {
			$autoplay = $gt3_theme_pagebuilder['sliders']['fullscreen']['autoplay'];
		} else {
			$autoplay = gt3_get_theme_option("default_autoplay");
		}
		if ($autoplay == 'on' || $autoplay == 'yes') {
			$autoplay = 'true';
		} else {
			$autoplay = 'false';
		}
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['video_cover']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['video_cover'] !== 'yes') {
			$video_cover = 0;
		} else {
			$video_cover = 1;
		}

		$interval = gt3_get_theme_option("gallery_interval");

		$sliderCompile .= '<script>gallery_set = [';
		foreach ($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'] as $imageid => $image) {
			$uniqid = mt_rand(0, 9999);
			if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoTitle = ": " . $image['title']['value'];} else {$photoTitle = "&nbsp;";}
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
					//echo '{type: "vimeo", src: "' . $videoid . '", thmb: "'.aq_resize($thmb, "120", "130", true).'", alt: "' . str_replace('"', "'",  $photoTitle) . '", title: "' . str_replace('"', "'", $photoTitle) . '", description: "' . str_replace('"', "'",  $photoCaption) . '", titleColor: "#'.$titleColor.'", descriptionColor: "#'.$captionColor.'"}<br>';
				}				
			}
		}
		$sliderCompile .= "]		
		jQuery(document).ready(function(){
			header.addClass('fixed_header');
			jQuery('body').fs_gallery({
				fx: 'fade', /*fade, zoom, slide_left, slide_right, slide_top, slide_bottom*/
				fit: '". $fit_style ."',
				slide_time: ". $interval .", /*This time must be < then time in css*/
				autoplay: ".$autoplay.",
				show_controls: ". $controls .",
				video_cover: ". $video_cover .",
				slides: gallery_set
			});	
		});
		</script>";
	
		echo $sliderCompile; ?>
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
            <div class="title_wrapper"><h1 class="fs_title_main"><?php echo the_title(); ?>&nbsp;</h1><h2 class="fs_title"></h2><span class="fs_descr"></span></div>
            <div class="fs_controls_append">
                <a href="<?php echo esc_js("javascript:void(0)");?>" class="close_controls"></a>
                <a href="<?php echo esc_js("javascript:history.back()");?>" class="fs_close"></a>
            </div>
        </div>
        <a href="<?php echo esc_js("javascript:void(0)");?>" class="close_controls show_me_always in_post"></a>
        <div class="fs_likes gallery_likes_add <?php echo (isset($_COOKIE['like_gallery'.get_the_ID()]) ? "already_liked" : ""); ?>" data-attachid="<?php echo get_the_ID(); ?>" data-modify="like_gallery">
            <i class="stand_icon <?php echo (isset($_COOKIE['like_gallery'.get_the_ID()]) ? "icon-heart" : "icon-heart-o"); ?>"></i>
            <span><?php echo ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0); ?></span>
        </div>        
        <script>
            jQuery(document).ready(function($){
				jQuery('.gallery_likes_add').click(function(){
					var gallery_likes_this = jQuery(this);
					if (!jQuery.cookie(gallery_likes_this.attr('data-modify')+gallery_likes_this.attr('data-attachid'))) {
						jQuery.post(gt3_ajaxurl, {
							action:'add_like_attachment',
							attach_id:jQuery(this).attr('data-attachid')
						}, function (response) {
							jQuery.cookie(gallery_likes_this.attr('data-modify')+gallery_likes_this.attr('data-attachid'), 'true', { expires: 7, path: '/' });
							gallery_likes_this.addClass('already_liked');
							gallery_likes_this.find('i').removeClass('icon-heart-o').addClass('icon-heart');
							gallery_likes_this.find('span').text(response);
						});
					}
				});
				
                jQuery('.custom_bg').remove();

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
} else if ($galleryType  == 'ribbon-gallery-post') {
	
	//Ribbon POST
	
	$compile_slides = '';
	if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['slides']) && is_array($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'])) {
			$imgi = 1;			
            foreach ($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'] as $imageid => $image) {
				if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoTitle = ' : '.$image['title']['value'];} else {$photoTitle = " ";}
				if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoAlt = $image['title']['value'];} else {$photoAlt = get_post_meta($image['attach_id'], '_wp_attachment_image_alt', true);}
				if (isset($image['caption']['value']) && strlen($image['caption']['value'])>0) {$photoCaption  = $image['caption']['value'];} else {$photoCaption = " ";}
				$photoCaption = "";
				if ($image['slide_type'] == 'image') {
					$compile_slides .= "<li data-count='".$imgi."' data-title='". $photoTitle ."' data-caption='". $photoCaption ."' class='slide".$imgi."'><div class='slide_wrapper'><img src='" . aq_resize(wp_get_attachment_url($image['attach_id']), null, "910", true, true, true) . "' alt='" . $photoAlt ."'/></div></li>";
				} else {
					#YOUTUBE
					$is_youtube = substr_count($image['src'], "youtu");
					if ($is_youtube > 0) {
						$videoid = substr(strstr($image['src'], "="), 1);
						$compile_slides .= "<li data-count='".$imgi."' data-title='". $photoTitle ."' data-caption='". $photoCaption ."' class='slide".$imgi."'><div class='slide_wrapper'><iframe width='100%' height='100%' src='http://www.youtube.com/embed/" . $videoid . "?controls=1&autoplay=0&showinfo=0&modestbranding=1&wmode=opaque&rel=0&hd=1&disablekb=1' frameborder='0' allowfullscreen></iframe></div></li>";
					}
					#VIMEO
					$is_vimeo = substr_count($image['src'], "vimeo");				
					if ($is_vimeo > 0) {
						$videoid = substr(strstr($image['src'], "m/"), 2);
						$compile_slides .= "<li data-count='".$imgi."' data-title='". $photoTitle ."' data-caption='". $photoCaption ."' class='slide".$imgi."'><div class='slide_wrapper'><iframe src='http://player.vimeo.com/video/". $videoid  ."?autoplay=0&loop=0&api=0' width='100%' height='100%' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></li>";
					}					
				}
				$imgi++;
				?>   
				<?php }
	        }?>
            
            <div class="ribbon_wrapper">                
                <div class="ribbon_list_wrapper">
                    <ul class="ribbon_list ribbon_list_gallery">
                        <?php echo $compile_slides; ?>
                    </ul>
                </div>
            </div>
            <div class="fs_controls slider_info ribbon_controls">
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
                <div class="title_wrapper"><h1 class="fs_title"><?php echo the_title() ?><span class="slide_title"></span></h1><span class="fs_descr"></span></div>
                <div class="fs_controls_append">
	                <a href="<?php echo esc_js("javascript:void(0)");?>" class="btn_prev fs_slider_prev"></a>
                    <a href="<?php echo esc_js("javascript:void(0)");?>" class="btn_next fs_slider_next"></a>
                    <a href="<?php echo esc_js("javascript:history.back()");?>" class="fs_close"></a>
                </div>
            </div>
            <!-- .fullscreen_content_wrapper -->            
    	</div>
    </div>
    <script>
		var demension = 0;
		jQuery(document).ready(function($){
			jQuery('.custom_bg').remove();
			jQuery('.btn_prev').click(function(){
				prev_slide();
			});
			jQuery('.btn_next').click(function(){
				next_slide();
			});

			if (window_w > 760 && window_w < 1025) {
				jQuery('.ribbon_list img').on("swipeleft",function(){
					next_slide();
				});
				jQuery('.ribbon_list img').on("swiperight",function(){
					prev_slide();
				});
				jQuery('#ribbon_swipe').on("swipeleft",function(){
					next_slide();
				});
				jQuery('#ribbon_swipe').on("swiperight",function(){
					prev_slide();
				});
			}
			
			jQuery(document.documentElement).keyup(function (event) {
				if ((event.keyCode == 37) || (event.keyCode == 40)) {
					prev_slide();
				} else if ((event.keyCode == 39) || (event.keyCode == 38)) {
					next_slide();
				}
			});

			jQuery('.share_toggle').click(function(){
				jQuery('.share_block').toggleClass('show_share');
			});			
			
			jQuery('.slide1').addClass('currentStep');
			jQuery('.slide_title').text(jQuery('.currentStep').attr('data-title'));
			ribbon_setup();			
			setTimeout("ribbon_setup()",700);			
		});	
		jQuery(window).resize(function($){
			ribbon_setup();
			setTimeout("ribbon_setup()",500);
			setTimeout("ribbon_setup()",1000);			
		});	
		jQuery(window).load(function($){
			ribbon_setup();
			setTimeout("ribbon_setup()",350);
			setTimeout("ribbon_setup()",700);
		});	
		
		function ribbon_setup() {	
			if (window_w > 760) {
				if (jQuery('#wpadminbar').size() > 0) {
					setHeight = window_h - header.height() - jQuery('#wpadminbar').height() - 15;
					setHeight2 = window_h - header.height() - jQuery('#wpadminbar').height() - jQuery('.slider_info').height() - 30;
					setTop = header.height() + jQuery('#wpadminbar').height();
				} else {
					setHeight = window_h - header.height() - 15;
					setHeight2 = window_h - header.height() - jQuery('.slider_info').height() - 30;				
					setTop = header.height();
				}

				jQuery('.currentStep').removeClass('currentStep');
				jQuery('.slide1').addClass('currentStep');
				jQuery('.num_current').text('1');
				
				jQuery('.num_all').text(jQuery('.ribbon_list li').size());
				jQuery('.ribbon_wrapper').height(setHeight2).css('top', setTop+15);
				jQuery('.ribbon_list .slide_wrapper').height(setHeight2);
				jQuery('.ribbon_list').height(setHeight2).width(15).css({'left' : 0});
				iframe16x9_ribbon(jQuery('.ribbon_list'));				
				jQuery('.slider_caption').text(jQuery('.currentStep').attr('data-title'));
				jQuery('.ribbon_list').find('li').each(function(){
					jQuery('.ribbon_list').width(jQuery('.ribbon_list').width()+jQuery(this).width());
					jQuery(this).attr('data-offset',jQuery(this).offset().left);
					if (jQuery(this).find('iframe').size() > 0) {
						jQuery(this).width(jQuery(this).find('iframe').width()+parseInt(jQuery(this).find('.slide_wrapper').css('margin-left')));
					} else {
						jQuery(this).width(jQuery(this).find('img').width()+parseInt(jQuery(this).find('.slide_wrapper').css('margin-left')));
					}
				});
				max_step = -1*(jQuery('.ribbon_list').width()-window_w);
			} else {
				jQuery('.ribbon_list').css('padding-top', jQuery('.slider_info').height());
			}
		}
		function prev_slide() {
			current_slide = parseInt(jQuery('.currentStep').attr('data-count'));
			current_slide--;
			if (current_slide < 1) {
				current_slide = jQuery('.ribbon_list').find('li').size();
			}
			jQuery('.currentStep').removeClass('currentStep');
			jQuery('.num_current').text(current_slide);
			jQuery('.slide'+current_slide).addClass('currentStep');
			jQuery('.slider_caption').text(jQuery('.currentStep').attr('data-title'));
			if (-1*jQuery('.slide'+current_slide).attr('data-offset') > max_step) {
				jQuery('.ribbon_list').css('left', -1*jQuery('.slide'+current_slide).attr('data-offset')+demension);
			} else {
				jQuery('.ribbon_list').css('left', max_step-demension);
			}
			jQuery('.slide_title').text(jQuery('.currentStep').attr('data-title'));
		}
		function next_slide() {
			current_slide = parseInt(jQuery('.currentStep').attr('data-count'));
			current_slide++;
			if (current_slide > jQuery('.ribbon_list').find('li').size()) {
				current_slide = 1
			}
			jQuery('.currentStep').removeClass('currentStep');
			jQuery('.num_current').text(current_slide);
			jQuery('.slide'+current_slide).addClass('currentStep');
			//jQuery('.slider_caption').text(jQuery('.currentStep').attr('data-title'));
			if (-1*jQuery('.slide'+current_slide).attr('data-offset') > max_step) {
				jQuery('.ribbon_list').css('left', -1*jQuery('.slide'+current_slide).attr('data-offset')+demension);
			} else {
				jQuery('.ribbon_list').css('left', max_step-demension);
			}
			jQuery('.slide_title').text(jQuery('.currentStep').attr('data-title'));
		}
    </script>
	<?php 
} else {
	//Grid GALLERY POST
	wp_enqueue_script('gt3_swipebox_js', get_template_directory_uri() . '/js/jquery.swipebox.js', array(), false, true);
	if ($galleryType == 'masonry-gallery-post') {
		$massonryClass = 'is_masonry';
		$imgHeight = '';
		wp_enqueue_script('gt3_masonry_js', get_template_directory_uri() . '/js/masonry.min.js', array(), false, true);
	} else {
		$massonryClass = '';
		$imgHeight = '440';
	}
	$setPad = 0;
	$hasPad = '';
?>
    <div class="fullscreen_block fullscreen_portfolio <?php echo $hasPad; ?>">
        <div class="fs_blog_module fw_port_module2 <?php echo $massonryClass ?>" style="padding-top:<?php echo $setPad; ?>; margin-left:<?php echo $setPad; ?>;">
        <?php
        if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['slides']) && is_array($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'])) {
            foreach ($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'] as $imageid => $image) {
                $uniqid = mt_rand(0, 9999);
				$photoAlt = get_post_meta($image['attach_id'], '_wp_attachment_image_alt', true);
				if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoTitle = $image['title']['value'];} else {$photoTitle = "";}
                ?>
                    <div <?php post_class("blogpost_preview_fw"); ?>>
                        <div class="fw-portPreview">
                            <div class="img_block wrapped_img fs_port_item gallery_item_wrapper">
                                <?php
									if ($image['slide_type'] == "image") {
										echo '<a class="featured_ico_link swipebox" href="'. wp_get_attachment_url($image['attach_id']) .'" title="'.$photoTitle.'">';
									} else {
										$set_rel = '';
										$is_youtube = substr_count($image['src'], "youtu");	
										if ($is_youtube > 0) {
											$set_rel = 'youtube';
										}
										$is_vimeo = substr_count($image['src'], "vimeo");
										if ($is_vimeo > 0) {
											$set_rel = 'vimeo';
										}
										
										echo '<a href="'. $image['src'] .'" class="featured_ico_link swipebox" rel="'. $set_rel .'" title="'.$photoTitleOutput.'">';
									}
                                ?></a>
                                <img width="540" height="" src="<?php echo aq_resize(wp_get_attachment_url($image['attach_id']), "540", $imgHeight, true, true, true); ?>" alt="<?php echo $photoAlt; ?>" />							
                                <div class="gallery_fadder"></div>
                                <span class="featured_items_ico"></span>
                            </div>
                        </div>
                    </div>
                <?php
            }
        }?>
        <div class="clear"></div>
        </div>
        <?php
		if ($galleryType == 'masonry-gallery-post') { ?>
        	<script>
				jQuery(window).load(function () {
					jQuery('.is_masonry').masonry();
					setTimeout("jQuery('.is_masonry').masonry();",1000);
				});
				jQuery(window).resize(function () {
					jQuery('.is_masonry').masonry();
					setTimeout("jQuery('.is_masonry').masonry();",1000);
				});
				jQuery(document).ready(function($){
					jQuery('.is_masonry').masonry();
					setTimeout("jQuery('.is_masonry').masonry();",1000);
				});
			</script>
		<?php } ?>
    </div>
	
	
<?php }

	?>
<script>
	jQuery(document).ready(function(){
		jQuery('.custom_bg').remove();
	});
</script>
<?php 
	if ($galleryType  == 'ribbon-gallery-post' || $galleryType  == 'fw-gallery-post') {
		get_footer('none');
	} else {
		get_footer('fullscreen');
	}
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