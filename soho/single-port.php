<?php 
if ( !post_password_required() ) {
/* LOAD PAGE BUILDER ARRAY */
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
$pf = get_post_format();
$gt3_current_page_sidebar = $gt3_theme_pagebuilder['settings']['layout-sidebars'];

/* ADD 1 view for this post */
$post_views = (get_post_meta(get_the_ID(), "post_views", true) > 0 ? get_post_meta(get_the_ID(), "post_views", true) : "0");
update_post_meta(get_the_ID(), "post_views", (int)$post_views + 1);
wp_enqueue_script('gt3_cookie_js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);
wp_enqueue_script('gt3_swipe_js', get_template_directory_uri() . '/js/jquery.event.swipe.js', array(), false, true);

$portfolioType = gt3_get_theme_option('default_portfolio_style');
if (isset($gt3_theme_pagebuilder['settings']['portfolio_style'])) {	
	if ($gt3_theme_pagebuilder['settings']['portfolio_style'] == 'simple-portfolio-post') { 
		$portfolioType = 'simple-portfolio-post';
	}
	if ($gt3_theme_pagebuilder['settings']['portfolio_style'] == 'fw-portfolio-post') { 
		$portfolioType = 'fw-portfolio-post';
	}
	if ($gt3_theme_pagebuilder['settings']['portfolio_style'] == 'ribbon-portfolio-post') { 
		$portfolioType = 'ribbon-portfolio-post';
	}
	if ($gt3_theme_pagebuilder['settings']['portfolio_style'] == 'flow-portfolio-post') { 
		$portfolioType = 'flow-portfolio-post';
	}
}
if ($portfolioType == 'simple-portfolio-post' || $portfolioType == 'flow-portfolio-post') {
	get_header();
} else {
	get_header('fullscreen');
}
$all_likes = gt3pb_get_option("likes");
the_post();

$pft = get_post_format();
if ($pft !== "image" && $pft !== "video") {
	$pft = "standart";
}
if (get_the_content() !== '' || (isset($gt3_theme_pagebuilder['modules']) && is_array($gt3_theme_pagebuilder['modules']) && count($gt3_theme_pagebuilder['modules'])>0)) {
	$info_class = "hasContent";
	$hasContent = true;
} else {
	$info_class = "noContent";
	$hasContent = false;
}
?>
    <script>
		jQuery(document).ready(function() {
			html.addClass('port_post');
		});
	</script>

<?php if ($portfolioType == 'simple-portfolio-post') { ?>
    <div class="content_wrapper">
        <div class="container simple-post-container">
            <div class="content_block <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?> row">
                <div
                    class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                    <div class="row">						
                        <div class="posts-block simple-post <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                            <div class="contentarea">
                                <div class="row">
                                    <div class="span12 module_cont module_blog module_none_padding module_blog_page">
                                        <div class="blog_post_page blog_post_preview">

                                            <div class="preview_top">
                                                <div class="preview_title">
                                                        <?php if (!isset($gt3_theme_pagebuilder['settings']['show_title']) || $gt3_theme_pagebuilder['settings']['show_title'] !== "no") { ?>
                                                            <h1 class="blogpost_title"><?php the_title(); ?></h1>
                                                        <?php } ?>  
                                                    <div class="listing_meta">
                                                        <span><?php the_time("F d, Y") ?></span>
                                                        <span class="middot">&middot;</span>
                                                        <span>
															<?php 
                                                                $terms = get_the_terms( get_the_ID(), 'portcat' );
                                                                if ( $terms && ! is_wp_error( $terms ) ) {
                                                                    $draught_links = array();
																	$tmp_categ = "";
                                                                    foreach ( $terms as $term ) {
																		$tmp_categ .= $term -> term_id .",";
                                                                        $draught_links[] = '<a href="'.get_term_link($term->slug, "portcat").'">'.$term->name.'</a>';
                                                                    }
																	$tmp_categ = mb_substr($tmp_categ, 0, -1);
																	
                                                                    $on_draught = join( ", ", $draught_links );
                                                                    $show_cat = true;
                                                                }
                                                                if ($terms !== false) {
                                                                    echo $on_draught;
																	$tmp_categ = $tmp_categ;
                                                                } else {
                                                                    echo "Uncategorized";
																	$tmp_categ = "";
                                                                }
                                                            ?>
                                                        </span>
													<?php 
                                                        if (isset($gt3_theme_pagebuilder['page_settings']['portfolio']['skills']) && is_array($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'])) {
                                                            foreach ($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'] as $skillkey => $skillvalue) {
                                                                echo "<span class='middot'>&middot;</span>&nbsp;&nbsp;";
																echo "<span class='preview_skills'>".esc_attr($skillvalue['name'])." ".esc_attr($skillvalue['value'])."</span>";
                                                            }
                                                        }
                                                    ?>                                                    
                                                    </div>
                                                </div><!-- .preview_title -->
                                                <?php echo'
												<div class="preview_likes gallery_likes_add '.(isset($_COOKIE['like_port'.get_the_ID()]) ? "already_liked" : "").'" data-attachid="'.get_the_ID().'" data-modify="like_port">
													<i class="stand_icon '.(isset($_COOKIE['like_port'.get_the_ID()]) ? "icon-heart" : "icon-heart-o").'"></i>
													<span>'.((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0).'</span>
												</div>'; ?>
                                            </div>
                                            <?php 
											if (isset($gt3_theme_pagebuilder['settings']['sp-style']) && $gt3_theme_pagebuilder['settings']['sp-style'] == 'def-simple') {
												if ( $pft == "image" || $pft == "video") {
													echo get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder, "width" => "1170", "height" => "563", "isPort" => true));
												} else {
													echo get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder, "width" => "1170", "height" => "", "isPort" => true)); 
												}											
											}?>
                                            <div class="clear"></div>
                                            <div class="blog_post_content">
                                                <article class="contentarea">
                                                    <?php
                                                    global $contentAlreadyPrinted;
                                                    if ($contentAlreadyPrinted !== true) {
                                                        the_content(__('Read more!', 'theme_localization'));
                                                    }
                                                    wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages', 'theme_localization') . ': </span>', 'after' => '</div>'));
                                                    ?>
                                                </article>
                                            </div>
                                            <div class="blogpost_footer">
                                            	<div class="blogpost_share">
                                                    <a target="_blank"
                                                       href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>"
                                                       class="top_socials share_facebook"><i
                                                            class="stand_icon icon-facebook-square"></i>&nbsp;&nbsp;<?php _e('Facebook', 'theme_localization'); ?></a>
                                                    <a target="_blank"
                                                       href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen($featured_image[0])>0) ? $featured_image[0] : gt3_get_theme_option("logo"); ?>"
                                                       class="top_socials share_pinterest"><i class="stand_icon icon-pinterest"></i>&nbsp;&nbsp;<?php _e('Pinterest', 'theme_localization'); ?></a>
                                                    <a target="_blank"
                                                       href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>"
                                                       class="top_socials share_tweet"><i class="stand_icon icon-twitter"></i>&nbsp;&nbsp;<?php _e('Twitter', 'theme_localization'); ?></a>
                                                    <a target="_blank"
                                                       href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"
                                                       class="top_socials share_gplus"><i class="icon-google-plus-square"></i>&nbsp;&nbsp;<?php _e('Google+', 'theme_localization'); ?></a>
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="blogpost_author_name">
                                                    <span><?php the_author(); ?></span>
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--.blog_post_page -->
                                    </div>
                                </div>
                                <?php
									$showRelated = gt3_get_theme_option("related_posts");
									if (isset($gt3_theme_pagebuilder['settings']['pf-related']) && $gt3_theme_pagebuilder['settings']['pf-related'] !== 'def') {
										$showRelated = $gt3_theme_pagebuilder['settings']['pf-related'];
									}
									if ($showRelated == "on") {
                                        if ($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "no-sidebar") {
                                            $posts_per_line = 4;
                                        } else {
                                            $posts_per_line = 3;
                                        }

                                        if (is_gt3_builder_active()) {
                                            echo '<div class="row"><div class="span12 single_post_module module_cont module_small_padding featured_items single_feature featured_posts">';
                                            echo do_shortcode("[feature_portfolio
									heading_color=''
									heading_size='h4'
									heading_text=''
									number_of_posts=" . $posts_per_line . "
									posts_per_line=" . $posts_per_line . "
									selected_categories='" . $tmp_categ . "'
									sorting_type='random'
									related='yes'
									post_type='post'][/feature_portfolio]");
                                            echo '</div></div>';
                                        }
                                    }
                                	if ( comments_open() && gt3_get_theme_option("portfolio_comments") == "enabled" ) { ?>
 											<div class="row">
                                                <div class="span12">
                                                    <?php comments_template(); ?>
                                                </div>
											</div>										
									<?php } ?>
                            </div>
                            <!-- .contentarea -->
                        </div>
                        <?php get_sidebar('left'); ?>
                    </div>
                    <div class="clear"><!-- ClearFix --></div>
                </div>
                <!-- .fl-container -->
                <?php get_sidebar('right'); ?>
                <div class="clear"><!-- ClearFix --></div>
            </div>
        </div>
        <!-- .container -->
    </div><!-- .content_wrapper -->
    <script>
		jQuery(document).ready(function(){
			jQuery('.pf_output_container').each(function(){
				if (jQuery(this).html() == '') {
					jQuery(this).parents('.blog_post_page').addClass('no_pf');
				} else {
					jQuery(this).parents('.blog_post_page').addClass('has_pf');
				}
			});		
		});
	</script>
<?php 	
	get_footer();
} else if ($portfolioType == 'fw-portfolio-post') {
	
// FULLSCREEN TYPE //	

?>
<?php	
	if ($pft == "video") {
		// Video Post Type //
		$video_url = $gt3_theme_pagebuilder['post-formats']['videourl'];
		echo "<div class='fullscreen_block fw_background bg_video'>";

		#YOUTUBE
		$is_youtube = substr_count($video_url, "youtu");
		if ($is_youtube > 0) {
			$videoid = substr(strstr($video_url, "="), 1);
			echo "<iframe width=\"100%\" height=\"100%\" src=\"http://www.youtube.com/embed/" . $videoid . "?controls=0&autoplay=1&showinfo=0&modestbranding=1&wmode=opaque&rel=0\" frameborder=\"0\" allowfullscreen></iframe></div>";
		}
	
		#VIMEO
		$is_vimeo = substr_count($video_url, "vimeo");
		if ($is_vimeo > 0) {
			$videoid = substr(strstr($video_url, "m/"), 2);
			echo "<iframe src=\"http://player.vimeo.com/video/" . $videoid . "?autoplay=1&loop=0\" width=\"100%\" height=\"100%\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>";
		}
	?>
		<script>
            jQuery(document).ready(function() {
				header.addClass('fixed_header');
				jQuery('.close_controls').click(function(){
					html.toggleClass('hide_controls');
				});
				
                jQuery('.custom_bg').css({'background-color':'#000000','background-image':'none'});
				jQuery('.fixed_bg').remove();
                jQuery('.fw_background').height(jQuery(window).height());
                jQuery('.main_header').removeClass('hided');
                jQuery('.fullscreen_block').addClass('loaded');
                if (jQuery(window).width() > 1024) {
                    if (jQuery('.bg_video').size() > 0) {
                        if (((jQuery(window).height()+150)/9)*16 > jQuery(window).width()) {				
                            jQuery('iframe').height(jQuery(window).height()+150).width(((jQuery(window).height()+150)/9)*16);
                            jQuery('iframe').css({'margin-left' : (-1*jQuery('iframe').width()/2)+'px', 'top' : "-75px", 'margin-top' : '0px'});
                        } else {
                            jQuery('iframe').width(jQuery(window).width()).height(((jQuery(window).width())/16)*9);
                            jQuery('iframe').css({'margin-left' : (-1*jQuery('iframe').width()/2)+'px', 'margin-top' : (-1*jQuery('iframe').height()/2)+'px', 'top' : '50%'});
                        }
                    }
                } else if (jQuery(window).width() < 760) {
                    jQuery('.bg_video').height(window_h-header.height()).width(window_w).css({
                        'top': '0px',
                        'left': '0px',
                        'margin-left': '0px',
                        'margin-top': '0px'
                    });
                    jQuery('iframe').height(window_h-header.height()).width(window_w).css({
                        'top': '0px',
                        'left': '0px',
                        'margin-left': '0px',
                        'margin-top': '0px'
                    });
                } else {
                    jQuery('.bg_video').height(window_h).width(window_w).css({
                        'top': '0px',
                        'margin-left' : '0px',
                        'left' : '0px',
                        'margin-top': '0px'
                    });				
                    jQuery('iframe').height(window_h).width(window_w).css({
                        'top': '0px',
                        'margin-left' : '0px',
                        'left' : '0px',
                        'margin-top': '0px'
                    });			
                }			
            });
            jQuery(window).resize(function() {
                jQuery('.fw_background').height(jQuery(window).height());
                if (jQuery(window).width() > 1024	) {
                    if (jQuery('.bg_video').size() > 0) {
                        if (((jQuery(window).height()+150)/9)*16 > jQuery(window).width()) {
                            jQuery('iframe').height(jQuery(window).height()+150).width(((jQuery(window).height()+150)/9)*16);
                            jQuery('iframe').css({'margin-left' : (-1*jQuery('iframe').width()/2)+'px', 'top' : "-75px", 'margin-top' : '0px'});
                        } else {
                            jQuery('iframe').width(jQuery(window).width()).height(((jQuery(window).width())/16)*9);
                            jQuery('iframe').css({'margin-left' : (-1*jQuery('iframe').width()/2)+'px', 'margin-top' : (-1*jQuery('iframe').height()/2)+'px', 'top' : '50%'});
                        }
                    }
                } else if (jQuery(window).width() < 760) {
                    jQuery('.bg_video').height(window_h-header.height()).width(window_w).css({
                        'top': '0px',
                        'left': '0px',
                        'margin-left': '0px',
                        'margin-top': '0px'
                    });
                    jQuery('iframe').height(window_h-header.height()).width(window_w).css({
                        'top': '0px',
                        'left': '0px',
                        'margin-left': '0px',
                        'margin-top': '0px'
                    });
                } else {
                    jQuery('.bg_video').height(window_h).width(window_w).css({
                        'top': '0px',
                        'margin-left' : '0px',
                        'left' : '0px',
                        'margin-top': '0px'
                    });				
                    jQuery('iframe').height(window_h).width(window_w).css({
                        'top': '0px',
                        'margin-left' : '0px',
                        'left' : '0px',
                        'margin-top': '0px'
                    });			
                }			
            });
        </script>
    
        <div class="fs_controls fs_controls-port fs-port-standart">
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
            </div>
            <div class="fs_controls_append">				           
            	<?php if ($hasContent == true) { ?>
                	<a href="<?php echo esc_js("javascript:void(0)");?>" class="post_info <?php echo $info_class; ?>"></a>
                <?php } ?>
                <a href="<?php echo esc_js("javascript:void(0)");?>" class="close_controls"></a> 
                <a href="<?php echo esc_js("javascript:history.back()");?>" class="fs_close"></a>
            </div>
        </div>
		<?php if ($hasContent == true) { ?>
        	<a href="<?php echo esc_js("javascript:void(0)");?>" class="close_controls show_me_always in_post has_content"></a>
        <?php } else { ?>
        	<a href="<?php echo esc_js("javascript:void(0)");?>" class="close_controls show_me_always in_post no_content"></a>
		<?php } ?>
        
        <?php if ($hasContent !== true) { ?>
        <div class="fs_likes gallery_likes_add <?php echo (isset($_COOKIE['lkie_port'.get_the_ID()]) ? "already_liked" : ""); ?>" data-attachid="<?php echo get_the_ID(); ?>" data-modify="lkie_port">
            <i class="stand_icon <?php echo (isset($_COOKIE['lkie_port'.get_the_ID()]) ? "icon-heart" : "icon-heart-o"); ?>"></i>
            <span><?php echo ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0); ?></span>
        </div>
        <?php } ?>
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

				jQuery('.main_header').removeClass('hided');
				jQuery('html').addClass('single-gallery');
				jQuery('.share_toggle').click(function(){
					jQuery('.share_block').toggleClass('show_share');
				});
			});	
		</script>
	<?php 
	} else if ($pft == "image") {
	// Image Post Type //
	wp_enqueue_script('gt3_fsGallery_js', get_template_directory_uri() . '/js/fs_gallery.js', array(), false, true);

	$sliderCompile = "";
	if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['slides']) && is_array($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'])) {
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['controls']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['controls'] !== 'yes') {
			$controls = 0;
		} else {
			$controls = 1;
		}
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['thumbs']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['thumbs'] !== 'no') {
			$thmbs = 1;
		} else {
			$thmbs = 0;
		}		
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['autoplay']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['autoplay'] == "no") {
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
		if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['video_cover']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['video_cover'] !== 'yes') {
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
	}
	echo $sliderCompile;	
	?>
    	
        <div class="fs_controls fs_controls-port fs-port-standart">
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
            </div>
            <div class="fs_controls_append">
              <a href="<?php echo esc_js("javascript:void(0)");?>" class="close_controls"></a>
                <a href="<?php echo esc_js("javascript:history.back()");?>" class="fs_close"></a>
            </div>
            <div class="fs_close_unbinder"></div>
        </div>
		<?php if ($hasContent == true) { ?>
        	<a href="<?php echo esc_js("javascript:void(0)");?>" class="close_controls show_me_always in_post in_port has_content"></a>
        <?php } else { ?>
        	<a href="<?php echo esc_js("javascript:void(0)");?>" class="close_controls show_me_always in_post in_port no_content"></a>
		<?php } ?>
        <?php if ($hasContent !== true) { ?>
        <div class="fs_likes gallery_likes_add <?php echo (isset($_COOKIE['lkie_port'.get_the_ID()]) ? "already_liked" : ""); ?>" data-attachid="<?php echo get_the_ID(); ?>" data-modify="lkie_port">
            <i class="stand_icon <?php echo (isset($_COOKIE['lkie_port'.get_the_ID()]) ? "icon-heart" : "icon-heart-o"); ?>"></i>
            <span><?php echo ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0); ?></span>
        </div>
        <?php } ?>
        <script>
            jQuery(document).ready(function($){
            	<?php if ($hasContent == true) { ?>
				jQuery('.fs_controls_append').prepend('<a href="<?php echo esc_js("javascript:void(0)");?>" class="post_info <?php echo $info_class; ?>"></a>');
                <?php } ?>
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
	<?php
	} else {
	// Standart Post Type //
		$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
		
	?>
        <div class="fs_controls fs_controls-port fs-port-standart">
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
            </div>
            <div class="fs_controls_append">
            	<?php if ($hasContent == true) { ?>
                	<a href="<?php echo esc_js("javascript:void(0)");?>" class="post_info <?php echo $info_class; ?>"></a>
                <?php } ?>
                <a href="<?php echo esc_js("javascript:history.back()");?>" class="fs_close"></a>
            </div>
        </div>
        <?php if ($hasContent !== true) { ?>
        <div class="fs_likes gallery_likes_add <?php echo (isset($_COOKIE['lkie_port'.get_the_ID()]) ? "already_liked" : ""); ?>" data-attachid="<?php echo get_the_ID(); ?>" data-modify="lkie_port">
            <i class="stand_icon <?php echo (isset($_COOKIE['lkie_port'.get_the_ID()]) ? "icon-heart" : "icon-heart-o"); ?>"></i>
            <span><?php echo ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0); ?></span>
        </div>
        <?php } ?>
        <div class="fs-port-bg" style="background-image:url(<?php echo $featured_image[0] ?>);"></div>
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
	<?php 
	}
	?>
<?php
	// Content //
?>
<?php if ($hasContent == true) { ?>
<div class="port_content fw-post">
	<div class="contnt_block">
        <div class="content_wrapper">
            <div class="container simple-post-container">
                <div class="content_block <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?> row">
                    <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                        <div class="row">						
                            <div class="posts-block simple-post <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                                <div class="contentarea">
                                    <div class="row">
                                        <div class="span12 module_cont module_blog module_none_padding module_blog_page">
                                            <div class="blog_post_page blog_post_preview">
    
                                                <div class="preview_top">
                                                    <div class="preview_title">
                                                            <?php if (!isset($gt3_theme_pagebuilder['settings']['show_title']) || $gt3_theme_pagebuilder['settings']['show_title'] !== "no") { ?>
                                                                <h1 class="blogpost_title"><?php the_title(); ?></h1>
                                                            <?php } ?>  
                                                        <div class="listing_meta">
                                                            <span><?php the_time("F d, Y") ?></span>
                                                            <span class="middot">&middot;</span>
                                                            <span>
															<?php 
                                                                $terms = get_the_terms( get_the_ID(), 'portcat' );
                                                                if ( $terms && ! is_wp_error( $terms ) ) {
                                                                    $draught_links = array();
																	$tmp_categ = "";
                                                                    foreach ( $terms as $term ) {
																		$tmp_categ .= $term -> term_id .",";
                                                                        $draught_links[] = '<a href="'.get_term_link($term->slug, "portcat").'">'.$term->name.'</a>';
                                                                    }
																	$tmp_categ = mb_substr($tmp_categ, 0, -1);
																	
                                                                    $on_draught = join( ", ", $draught_links );
                                                                    $show_cat = true;
                                                                }
                                                                if ($terms !== false) {
                                                                    echo $on_draught;
																	$tmp_categ = $tmp_categ;
                                                                } else {
                                                                    echo "Uncategorized";
																	$tmp_categ = "";
                                                                }
                                                            ?>
                                                            </span>
                                                        <?php 
                                                            if (isset($gt3_theme_pagebuilder['page_settings']['portfolio']['skills']) && is_array($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'])) {
                                                                foreach ($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'] as $skillkey => $skillvalue) {
                                                                    echo "<span class='middot'>&middot;</span>&nbsp;&nbsp;";
                                                                    echo "<span class='preview_skills'>".esc_attr($skillvalue['name'])." ".esc_attr($skillvalue['value'])."</span>";
                                                                }
                                                            }
                                                        ?>                                                    
                                                        </div>
                                                    </div><!-- .preview_title -->
                                                    <?php 
														echo'
														<div class="preview_likes gallery_likes_add '.(isset($_COOKIE['like_port'.get_the_ID()]) ? "already_liked" : "").'" data-attachid="'.get_the_ID().'" data-modify="like_port">
															<i class="stand_icon '.(isset($_COOKIE['like_port'.get_the_ID()]) ? "icon-heart" : "icon-heart-o").'"></i>
															<span>'.((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0).'</span>
														</div>';
													?>
                                                </div>
                                                <div class="clear"></div>
                                                <div class="blog_post_content">
                                                    <article class="contentarea">
                                                        <?php
                                                        global $contentAlreadyPrinted;
                                                        if ($contentAlreadyPrinted !== true) {
                                                            the_content(__('Read more!', 'theme_localization'));
                                                        }
                                                        wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages', 'theme_localization') . ': </span>', 'after' => '</div>'));
                                                        ?>
                                                    </article>
                                                </div>
                                                <div class="blogpost_footer">
                                                    <div class="blogpost_share">
                                                        <a target="_blank"
                                                           href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>"
                                                           class="top_socials share_facebook"><i
                                                                class="stand_icon icon-facebook-square"></i>&nbsp;&nbsp;<?php _e('Facebook', 'theme_localization'); ?></a>
                                                        <a target="_blank"
                                                           href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen($featured_image[0])>0) ? $featured_image[0] : gt3_get_theme_option("logo"); ?>"
                                                           class="top_socials share_pinterest"><i class="stand_icon icon-pinterest"></i>&nbsp;&nbsp;<?php _e('Pinterest', 'theme_localization'); ?></a>
                                                        <a target="_blank"
                                                           href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>"
                                                           class="top_socials share_tweet"><i class="stand_icon icon-twitter"></i>&nbsp;&nbsp;<?php _e('Twitter', 'theme_localization'); ?></a>
                                                        <a target="_blank"
                                                           href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"
                                                           class="top_socials share_gplus"><i class="icon-google-plus-square"></i>&nbsp;&nbsp;<?php _e('Google+', 'theme_localization'); ?></a>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div class="blogpost_author_name">
                                                        <span><?php the_author(); ?></span>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--.blog_post_page -->
                                        </div>
                                    </div>
                                    <?php
                                        $showRelated = gt3_get_theme_option("related_posts");
                                        if (isset($gt3_theme_pagebuilder['settings']['pf-related']) && $gt3_theme_pagebuilder['settings']['pf-related'] !== 'def') {
                                            $showRelated = $gt3_theme_pagebuilder['settings']['pf-related'];
                                        }
                                        if ($showRelated == "on") {
                                            if ($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "no-sidebar") {
                                                $posts_per_line = 4;
                                            } else {
                                                $posts_per_line = 3;
                                            }

                                            if (is_gt3_builder_active()) {
                                                echo '<div class="row"><div class="span12 single_post_module module_cont module_small_padding featured_items single_feature featured_posts">';
                                                echo do_shortcode("[feature_portfolio
                                                heading_color=''
                                                heading_size='h4'
                                                heading_text=''
                                                number_of_posts=" . $posts_per_line . "
                                                posts_per_line=" . $posts_per_line . "
                                                selected_categories='".$tmp_categ."'
                                                sorting_type='random'
                                                related='yes'
                                                post_type='post'][/feature_portfolio]");
                                                echo '</div></div>';
                                            }
                                        }
                                        if ( comments_open() && gt3_get_theme_option("portfolio_comments") == "enabled" ) { ?>
                                                <div class="row">
                                                    <div class="span12">
                                                        <?php comments_template(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                </div>
                                <!-- .contentarea -->
                            </div>
                            <?php get_sidebar('left'); ?>
                        </div>
                        <div class="clear"><!-- ClearFix --></div>
                    </div>
                    <!-- .fl-container -->
                    <?php get_sidebar('right'); ?>
                    <div class="clear"><!-- ClearFix --></div>
                </div>
            </div>
            <!-- .container -->
        </div><!-- .content_wrapper -->
    </div><!-- .contnt_block -->
</div><!-- .port_content -->
<?php } ?>
<script>
	jQuery(document).ready(function(){
		jQuery('.post_info').click(function(){
			if (!jQuery(this).hasClass('noContent')) {
				html.toggleClass('show_content');
			}
		});
	});
</script>
    <?php	
	// Footer //
	get_footer('none');	
} else if ($portfolioType == 'ribbon-portfolio-post') {
	
// RIBBON TYPE //

	if ($pft == "video") {
		// Video Post Type //
		$video_url = $gt3_theme_pagebuilder['post-formats']['videourl'];
		echo "<div class='fullscreen_block fw_background bg_video'>";

		#YOUTUBE
		$is_youtube = substr_count($video_url, "youtu");
		if ($is_youtube > 0) {
			$videoid = substr(strstr($video_url, "="), 1);
			echo "<iframe width=\"100%\" height=\"100%\" src=\"http://www.youtube.com/embed/" . $videoid . "?controls=0&autoplay=1&showinfo=0&modestbranding=1&wmode=opaque&rel=0\" frameborder=\"0\" allowfullscreen></iframe></div>";
		}
	
		#VIMEO
		$is_vimeo = substr_count($video_url, "vimeo");
		if ($is_vimeo > 0) {
			$videoid = substr(strstr($video_url, "m/"), 2);
			echo "<iframe src=\"http://player.vimeo.com/video/" . $videoid . "?autoplay=1&loop=0\" width=\"100%\" height=\"100%\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>";
		}
	?>
		<script>
            jQuery(document).ready(function() {
				jQuery('.close_controls').click(function(){
					html.toggleClass('hide_controls');
				});
				header.addClass('fixed_header');
                jQuery('.custom_bg').css({'background-color':'#000000','background-image':'none'});
				jQuery('.fixed_bg').remove();
                jQuery('.fw_background').height(jQuery(window).height());
                jQuery('.main_header').removeClass('hided');
                jQuery('.fullscreen_block').addClass('loaded');
                if (jQuery(window).width() > 1024) {
                    if (jQuery('.bg_video').size() > 0) {
                        if (((jQuery(window).height()+150)/9)*16 > jQuery(window).width()) {				
                            jQuery('iframe').height(jQuery(window).height()+150).width(((jQuery(window).height()+150)/9)*16);
                            jQuery('iframe').css({'margin-left' : (-1*jQuery('iframe').width()/2)+'px', 'top' : "-75px", 'margin-top' : '0px'});
                        } else {
                            jQuery('iframe').width(jQuery(window).width()).height(((jQuery(window).width())/16)*9);
                            jQuery('iframe').css({'margin-left' : (-1*jQuery('iframe').width()/2)+'px', 'margin-top' : (-1*jQuery('iframe').height()/2)+'px', 'top' : '50%'});
                        }
                    }
                } else if (jQuery(window).width() < 760) {
                    jQuery('.bg_video').height(window_h-header.height()).width(window_w).css({
                        'top': '0px',
                        'left': '0px',
                        'margin-left': '0px',
                        'margin-top': '0px'
                    });
                    jQuery('iframe').height(window_h-header.height()).width(window_w).css({
                        'top': '0px',
                        'left': '0px',
                        'margin-left': '0px',
                        'margin-top': '0px'
                    });
                } else {
                    jQuery('.bg_video').height(window_h).width(window_w).css({
                        'top': '0px',
                        'margin-left' : '0px',
                        'left' : '0px',
                        'margin-top': '0px'
                    });				
                    jQuery('iframe').height(window_h).width(window_w).css({
                        'top': '0px',
                        'margin-left' : '0px',
                        'left' : '0px',
                        'margin-top': '0px'
                    });			
                }			
            });
            jQuery(window).resize(function() {
                jQuery('.fw_background').height(jQuery(window).height());
                if (jQuery(window).width() > 1024	) {
                    if (jQuery('.bg_video').size() > 0) {
                        if (((jQuery(window).height()+150)/9)*16 > jQuery(window).width()) {
                            jQuery('iframe').height(jQuery(window).height()+150).width(((jQuery(window).height()+150)/9)*16);
                            jQuery('iframe').css({'margin-left' : (-1*jQuery('iframe').width()/2)+'px', 'top' : "-75px", 'margin-top' : '0px'});
                        } else {
                            jQuery('iframe').width(jQuery(window).width()).height(((jQuery(window).width())/16)*9);
                            jQuery('iframe').css({'margin-left' : (-1*jQuery('iframe').width()/2)+'px', 'margin-top' : (-1*jQuery('iframe').height()/2)+'px', 'top' : '50%'});
                        }
                    }
                } else if (jQuery(window).width() < 760) {
                    jQuery('.bg_video').height(window_h-header.height()).width(window_w).css({
                        'top': '0px',
                        'left': '0px',
                        'margin-left': '0px',
                        'margin-top': '0px'
                    });
                    jQuery('iframe').height(window_h-header.height()).width(window_w).css({
                        'top': '0px',
                        'left': '0px',
                        'margin-left': '0px',
                        'margin-top': '0px'
                    });
                } else {
                    jQuery('.bg_video').height(window_h).width(window_w).css({
                        'top': '0px',
                        'margin-left' : '0px',
                        'left' : '0px',
                        'margin-top': '0px'
                    });				
                    jQuery('iframe').height(window_h).width(window_w).css({
                        'top': '0px',
                        'margin-left' : '0px',
                        'left' : '0px',
                        'margin-top': '0px'
                    });			
                }			
            });
        </script>
    
        <div class="fs_controls fs_controls-port fs-port-standart">
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
            </div>
            <div class="fs_controls_append">            	
            	<?php if ($hasContent == true) { ?>
                	<a href="<?php echo esc_js("javascript:void(0)");?>" class="post_info <?php echo $info_class; ?>"></a>
                <?php } ?>
                <a href="<?php echo esc_js("javascript:void(0)");?>" class="close_controls"></a>
                <a href="<?php echo esc_js("javascript:history.back()");?>" class="fs_close"></a>
            </div>
        </div>
		<?php if ($hasContent == true) { ?>
        	<a href="<?php echo esc_js("javascript:void(0)");?>" class="close_controls show_me_always in_post has_content"></a>
        <?php } else { ?>
        	<a href="<?php echo esc_js("javascript:void(0)");?>" class="close_controls show_me_always in_post no_content"></a>
		<?php } ?>
        
        <?php if ($hasContent !== true) { ?>
        <div class="fs_likes gallery_likes_add <?php echo (isset($_COOKIE['lkie_port'.get_the_ID()]) ? "already_liked" : ""); ?>" data-attachid="<?php echo get_the_ID(); ?>" data-modify="lkie_port">
            <i class="stand_icon <?php echo (isset($_COOKIE['lkie_port'.get_the_ID()]) ? "icon-heart" : "icon-heart-o"); ?>"></i>
            <span><?php echo ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0); ?></span>
        </div>
        <?php } ?>
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
	<?php 

	} else if ($pft == "image") {
	// Image Post Type //
	?>    
    <div class="fullscreen-gallery hided">
		<?php 
            $compile_slides = "";
        ?>
        <?php
        if (isset($gt3_theme_pagebuilder['post-formats']['images']) && is_array($gt3_theme_pagebuilder['post-formats']['images'])) {        
			$imgi = 1;
            foreach ($gt3_theme_pagebuilder['post-formats']['images'] as $imageid => $image) {
				if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoTitle = '';} else {$photoTitle = " ";}
				if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoAlt = $image['title']['value'];} else {$photoAlt = " ";}
				if (isset($image['caption']['value']) && strlen($image['caption']['value'])>0) {$photoCaption  = $image['caption']['value'];} else {$photoCaption = " ";}				
				$photoCaption = "";
				$photoTitle = "";	
				$photoAlt = get_post_meta($image['attach_id'], '_wp_attachment_image_alt', true);
				$compile_slides .= "<li data-count='".$imgi."' data-title='". $photoTitle ."' data-caption='". $photoCaption ."' class='slide".$imgi."'><div class='slide_wrapper'><img src='" . aq_resize(wp_get_attachment_url($image['attach_id']), null, "910", true, true, true) . "' alt='" . $photoAlt ."'/></div></li>";
				$imgi++;
				?>   
				<?php }
	        }?>
            
            <div class="ribbon_wrapper">                
                <div class="ribbon_list_wrapper">
                    <ul class="ribbon_list">
                        <?php echo $compile_slides; ?>
                    </ul>
                </div>
            </div>
            <div class="fs_controls slider_info ribbon_panel">
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
                <div class="title_wrapper"><h1 class="fs_title"><?php echo the_title() ?></h1><span class="fs_descr"></span></div>
                <div class="fs_controls_append">
            	<?php if ($hasContent == true) { ?>
                	<a href="<?php echo esc_js("javascript:void(0)");?>" class="post_info <?php echo $info_class; ?>"></a>
                <?php } ?>
	                <a href="<?php echo esc_js("javascript:void(0)");?>" class="btn_prev fs_slider_prev"></a>
                    <a href="<?php echo esc_js("javascript:void(0)");?>" class="btn_next fs_slider_next"></a>
                    <a href="<?php echo esc_js("javascript:history.back()");?>" class="fs_close"></a>
                </div>
            </div>
            <!-- .fullscreen_content_wrapper -->            
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
			jQuery(document.documentElement).keyup(function (event) {
				if ((event.keyCode == 37) || (event.keyCode == 40)) {
					prev_slide();
				} else if ((event.keyCode == 39) || (event.keyCode == 38)) {
					next_slide();
				}
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

			jQuery('.share_toggle').click(function(){
				jQuery('.share_block').toggleClass('show_share');
			});			
			
			jQuery('.slide1').addClass('currentStep');
			jQuery('.slider_caption').text(jQuery('.currentStep').attr('data-title'));			
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
				jQuery('.slider_caption').text(jQuery('.currentStep').attr('data-title'));
				jQuery('.ribbon_list').find('li').each(function(){
					jQuery('.ribbon_list').width(jQuery('.ribbon_list').width()+jQuery(this).width());
					jQuery(this).attr('data-offset',jQuery(this).offset().left);
					jQuery(this).width(jQuery(this).find('img').width()+parseInt(jQuery(this).find('.slide_wrapper').css('margin-left')));
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
		}
    </script>
    <?php	
	} else {
	// Standart Post Type //
		$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
		
	?>
        <div class="fs_controls fs_controls-port fs-port-standart">
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
            </div>
            <div class="fs_controls_append">
            	<?php if ($hasContent == true) { ?>
                	<a href="<?php echo esc_js("javascript:void(0)");?>" class="post_info <?php echo $info_class; ?>"></a>
                <?php } ?>
                <a href="<?php echo esc_js("javascript:history.back()");?>" class="fs_close"></a>
            </div>
        </div>
        <?php if ($hasContent !== true) { ?>
        <div class="fs_likes gallery_likes_add <?php echo (isset($_COOKIE['lkie_port'.get_the_ID()]) ? "already_liked" : ""); ?>" data-attachid="<?php echo get_the_ID(); ?>" data-modify="lkie_port">
            <i class="stand_icon <?php echo (isset($_COOKIE['lkie_port'.get_the_ID()]) ? "icon-heart" : "icon-heart-o"); ?>"></i>
            <span><?php echo ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0); ?></span>
        </div>
        <?php } ?>
        <div class="fs-port-bg" style="background-image:url(<?php echo $featured_image[0] ?>);"></div>
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
	<?php 
	}
	?>
<?php
	// Content //
?>
<?php if ($hasContent == true) { ?>
<div class="port_content fw-post">
	<div class="contnt_block">
        <div class="content_wrapper">
            <div class="container simple-post-container">
                <div class="content_block <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?> row">
                    <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                        <div class="row">						
                            <div class="posts-block simple-post <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                                <div class="contentarea">
                                    <div class="row">
                                        <div class="span12 module_cont module_blog module_none_padding module_blog_page">
                                            <div class="blog_post_page blog_post_preview">
    
                                                <div class="preview_top">
                                                    <div class="preview_title">
                                                            <?php if (!isset($gt3_theme_pagebuilder['settings']['show_title']) || $gt3_theme_pagebuilder['settings']['show_title'] !== "no") { ?>
                                                                <h1 class="blogpost_title"><?php the_title(); ?></h1>
                                                            <?php } ?>  
                                                        <div class="listing_meta">
                                                            <span><?php the_time("F d, Y") ?></span>
                                                            <span class="middot">&middot;</span>
                                                            <span>
															<?php 
                                                                $terms = get_the_terms( get_the_ID(), 'portcat' );
                                                                if ( $terms && ! is_wp_error( $terms ) ) {
                                                                    $draught_links = array();
																	$tmp_categ = "";
                                                                    foreach ( $terms as $term ) {
																		$tmp_categ .= $term -> term_id .",";
                                                                        $draught_links[] = '<a href="'.get_term_link($term->slug, "portcat").'">'.$term->name.'</a>';
                                                                    }
																	$tmp_categ = mb_substr($tmp_categ, 0, -1);
																	
                                                                    $on_draught = join( ", ", $draught_links );
                                                                    $show_cat = true;
                                                                }
                                                                if ($terms !== false) {
                                                                    echo $on_draught;
																	$tmp_categ = $tmp_categ;
                                                                } else {
                                                                    echo "Uncategorized";
																	$tmp_categ = "";
                                                                }
                                                            ?>
                                                            </span>
                                                        <?php 
                                                            if (isset($gt3_theme_pagebuilder['page_settings']['portfolio']['skills']) && is_array($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'])) {
                                                                foreach ($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'] as $skillkey => $skillvalue) {
                                                                    echo "<span class='middot'>&middot;</span>&nbsp;&nbsp;";
                                                                    echo "<span class='preview_skills'>".esc_attr($skillvalue['name'])." ".esc_attr($skillvalue['value'])."</span>";
                                                                }
                                                            }
                                                        ?>                                                    
                                                        </div>
                                                    </div><!-- .preview_title -->
                                                    <?php 
														echo'
														<div class="preview_likes gallery_likes_add '.(isset($_COOKIE['like_port'.get_the_ID()]) ? "already_liked" : "").'" data-attachid="'.get_the_ID().'" data-modify="like_port">
															<i class="stand_icon '.(isset($_COOKIE['like_port'.get_the_ID()]) ? "icon-heart" : "icon-heart-o").'"></i>
															<span>'.((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0).'</span>
														</div>';
													?>
                                                </div>
                                                <div class="clear"></div>
                                                <div class="blog_post_content">
                                                    <article class="contentarea">
                                                        <?php
                                                        global $contentAlreadyPrinted;
                                                        if ($contentAlreadyPrinted !== true) {
                                                            the_content(__('Read more!', 'theme_localization'));
                                                        }
                                                        wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages', 'theme_localization') . ': </span>', 'after' => '</div>'));
                                                        ?>
                                                    </article>
                                                </div>
                                                <div class="blogpost_footer">
                                                    <div class="blogpost_share">
                                                        <a target="_blank"
                                                           href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>"
                                                           class="top_socials share_facebook"><i
                                                                class="stand_icon icon-facebook-square"></i>&nbsp;&nbsp;<?php _e('Facebook', 'theme_localization'); ?></a>
                                                        <a target="_blank"
                                                           href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen($featured_image[0])>0) ? $featured_image[0] : gt3_get_theme_option("logo"); ?>"
                                                           class="top_socials share_pinterest"><i class="stand_icon icon-pinterest"></i>&nbsp;&nbsp;<?php _e('Pinterest', 'theme_localization'); ?></a>
                                                        <a target="_blank"
                                                           href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>"
                                                           class="top_socials share_tweet"><i class="stand_icon icon-twitter"></i>&nbsp;&nbsp;<?php _e('Twitter', 'theme_localization'); ?></a>
                                                        <a target="_blank"
                                                           href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"
                                                           class="top_socials share_gplus"><i class="icon-google-plus-square"></i>&nbsp;&nbsp;<?php _e('Google+', 'theme_localization'); ?></a>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div class="blogpost_author_name">
                                                        <span><?php the_author(); ?></span>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--.blog_post_page -->
                                        </div>
                                    </div>
                                    <?php
                                        $showRelated = gt3_get_theme_option("related_posts");
                                        if (isset($gt3_theme_pagebuilder['settings']['pf-related']) && $gt3_theme_pagebuilder['settings']['pf-related'] !== 'def') {
                                            $showRelated = $gt3_theme_pagebuilder['settings']['pf-related'];
                                        }
                                        if ($showRelated == "on") {
                                            if ($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "no-sidebar") {
                                                $posts_per_line = 4;
                                            } else {
                                                $posts_per_line = 3;
                                            }

                                            if (is_gt3_builder_active()) {
                                                echo '<div class="row"><div class="span12 single_post_module module_cont module_small_padding featured_items single_feature featured_posts">';
                                                echo do_shortcode("[feature_portfolio
                                                heading_color=''
                                                heading_size='h4'
                                                heading_text=''
                                                number_of_posts=" . $posts_per_line . "
                                                posts_per_line=" . $posts_per_line . "
                                                selected_categories='".$tmp_categ."'
                                                sorting_type='random'
                                                related='yes'
                                                post_type='post'][/feature_portfolio]");
                                                echo '</div></div>';
                                            }
                                        }
                                        if ( comments_open() && gt3_get_theme_option("portfolio_comments") == "enabled" ) { ?>
                                                <div class="row">
                                                    <div class="span12">
                                                        <?php comments_template(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                </div>
                                <!-- .contentarea -->
                            </div>
                            <?php get_sidebar('left'); ?>
                        </div>
                        <div class="clear"><!-- ClearFix --></div>
                    </div>
                    <!-- .fl-container -->
                    <?php get_sidebar('right'); ?>
                    <div class="clear"><!-- ClearFix --></div>
                </div>
            </div>
            <!-- .container -->
        </div><!-- .content_wrapper -->
    </div><!-- .contnt_block -->
</div><!-- .port_content -->
<?php } ?>
<script>
	jQuery(document).ready(function(){
		jQuery('.post_info').click(function(){
			if (!jQuery(this).hasClass('noContent')) {
				html.toggleClass('show_content');
			}
		});
	});
</script>
    <?php	
	// Footer //
	get_footer('none');
} else if ($portfolioType == 'flow-portfolio-post') {
// FLOW TYPE //
?>
<div class="content_wrapper fw-post">
    <div class="container simple-post-container">
        <div class="content_block <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?> row">
            <div
                class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <div class="row">						
                    <div class="posts-block simple-post <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                        <div class="contentarea">
                            <div class="row">
                                <div class="span12 module_cont module_blog module_none_padding module_blog_page">
                                    <div class="blog_post_page blog_post_preview">

                                        <div class="preview_top">
                                            <div class="preview_title">
                                                    <?php if (!isset($gt3_theme_pagebuilder['settings']['show_title']) || $gt3_theme_pagebuilder['settings']['show_title'] !== "no") { ?>
                                                        <h1 class="blogpost_title"><?php the_title(); ?></h1>
                                                    <?php } ?>  
                                                <div class="listing_meta">
                                                    <span><?php the_time("F d, Y") ?></span>
                                                    <span class="middot">&middot;</span>
                                                    <span>
															<?php 
                                                                $terms = get_the_terms( get_the_ID(), 'portcat' );
                                                                if ( $terms && ! is_wp_error( $terms ) ) {
                                                                    $draught_links = array();
																	$tmp_categ = "";
                                                                    foreach ( $terms as $term ) {
																		$tmp_categ .= $term -> term_id .",";
                                                                        $draught_links[] = '<a href="'.get_term_link($term->slug, "portcat").'">'.$term->name.'</a>';
                                                                    }
																	$tmp_categ = mb_substr($tmp_categ, 0, -1);
																	
                                                                    $on_draught = join( ", ", $draught_links );
                                                                    $show_cat = true;
                                                                }
                                                                if ($terms !== false) {
                                                                    echo $on_draught;
																	$tmp_categ = $tmp_categ;
                                                                } else {
                                                                    echo "Uncategorized";
																	$tmp_categ = "";
                                                                }
                                                            ?>
                                                    </span>
                                                <?php 
                                                    if (isset($gt3_theme_pagebuilder['page_settings']['portfolio']['skills']) && is_array($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'])) {
                                                        foreach ($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'] as $skillkey => $skillvalue) {
                                                            echo "<span class='middot'>&middot;</span>&nbsp;&nbsp;";
                                                            echo "<span class='preview_skills'>".esc_attr($skillvalue['name'])." ".esc_attr($skillvalue['value'])."</span>";
                                                        }
                                                    }
                                                ?>                                                    
                                                </div>
                                            </div><!-- .preview_title -->
                                            <?php echo'
                                            <div class="preview_likes gallery_likes_add '.(isset($_COOKIE['like_port'.get_the_ID()]) ? "already_liked" : "").'" data-attachid="'.get_the_ID().'" data-modify="like_port">
                                                <i class="stand_icon '.(isset($_COOKIE['like_port'.get_the_ID()]) ? "icon-heart" : "icon-heart-o").'"></i>
                                                <span>'.((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0).'</span>
                                            </div>'; ?>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="blog_post_content">
                                            <article class="contentarea">
                                                <?php
                                                global $contentAlreadyPrinted;
                                                if ($contentAlreadyPrinted !== true) {
                                                    the_content(__('Read more!', 'theme_localization'));
                                                }
                                                wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages', 'theme_localization') . ': </span>', 'after' => '</div>'));
                                                ?>
                                            </article>
                                        </div>
                                        <div class="blogpost_footer">
                                            <div class="blogpost_share">
                                                <a target="_blank"
                                                   href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>"
                                                   class="top_socials share_facebook"><i
                                                        class="stand_icon icon-facebook-square"></i>&nbsp;&nbsp;<?php _e('Facebook', 'theme_localization'); ?></a>
                                                <a target="_blank"
                                                   href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen($featured_image[0])>0) ? $featured_image[0] : gt3_get_theme_option("logo"); ?>"
                                                   class="top_socials share_pinterest"><i class="stand_icon icon-pinterest"></i>&nbsp;&nbsp;<?php _e('Pinterest', 'theme_localization'); ?></a>
                                                <a target="_blank"
                                                   href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>"
                                                   class="top_socials share_tweet"><i class="stand_icon icon-twitter"></i>&nbsp;&nbsp;<?php _e('Twitter', 'theme_localization'); ?></a>
                                                <a target="_blank"
                                                   href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"
                                                   class="top_socials share_gplus"><i class="icon-google-plus-square"></i>&nbsp;&nbsp;<?php _e('Google+', 'theme_localization'); ?></a>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="blogpost_author_name">
                                                <span><?php the_author(); ?></span>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--.blog_post_page -->
                                </div>
                            </div>
                            <?php
                                $showRelated = gt3_get_theme_option("related_posts");
                                if (isset($gt3_theme_pagebuilder['settings']['pf-related']) && $gt3_theme_pagebuilder['settings']['pf-related'] !== 'def') {
                                    $showRelated = $gt3_theme_pagebuilder['settings']['pf-related'];
                                }
                                if ($showRelated == "on") {
                                    if ($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "no-sidebar") {
                                        $posts_per_line = 4;
                                    } else {
                                        $posts_per_line = 3;
                                    }

                                    if (is_gt3_builder_active()) {
                                        echo '<div class="row"><div class="span12 single_post_module module_cont module_small_padding featured_items single_feature featured_posts">';
                                        echo do_shortcode("[feature_portfolio
                                        heading_color=''
                                        heading_size='h4'
                                        heading_text=''
                                        number_of_posts=" . $posts_per_line . "
                                        posts_per_line=" . $posts_per_line . "
                                        selected_categories='".$tmp_categ."'
                                        sorting_type='random'
                                        related='yes'
                                        post_type='post'][/feature_portfolio]");
                                        echo '</div></div>';
                                    }
                                }
                                if ( comments_open() && gt3_get_theme_option("portfolio_comments") == "enabled" ) { ?>
                                        <div class="row">
                                            <div class="span12">
                                                <?php comments_template(); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                        </div>
                        <!-- .contentarea -->
                    </div>
                    <?php get_sidebar('left'); ?>
                </div>
                <div class="clear"><!-- ClearFix --></div>
            </div>
            <!-- .fl-container -->
            <?php get_sidebar('right'); ?>
            <div class="clear"><!-- ClearFix --></div>
        </div>
    </div>
    <!-- .container -->
</div><!-- .content_wrapper -->
<script>
    jQuery(document).ready(function(){
        jQuery('.pf_output_container').each(function(){
            if (jQuery(this).html() == '') {
                jQuery(this).parents('.blog_post_page').addClass('no_pf');
            } else {
                jQuery(this).parents('.blog_post_page').addClass('has_pf');
            }
        });		
    });
</script>
<?php 	
	get_footer();
	}
//End Of Portfolio
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