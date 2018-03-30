<?php

if (!isset($content_width)) $content_width = 940;

function gt3_get_theme_pagebuilder($postid, $args = array())
{
    $gt3_theme_pagebuilder = get_post_meta($postid, "pagebuilder", true);
    if (!is_array($gt3_theme_pagebuilder)) {
        $gt3_theme_pagebuilder = array();
    }

    if (!isset($gt3_theme_pagebuilder['settings']['show_content_area'])) {
        $gt3_theme_pagebuilder['settings']['show_content_area'] = "yes";
    }
    if (!isset($gt3_theme_pagebuilder['settings']['show_page_title'])) {
        $gt3_theme_pagebuilder['settings']['show_page_title'] = "yes";
    }
    if (isset($args['not_prepare_sidebars']) && $args['not_prepare_sidebars'] == "true") {

    } else {
        if (!isset($gt3_theme_pagebuilder['settings']['layout-sidebars']) || $gt3_theme_pagebuilder['settings']['layout-sidebars'] == "default") {
            $gt3_theme_pagebuilder['settings']['layout-sidebars'] = gt3_get_theme_option("default_sidebar_layout");
        }
    }

    return $gt3_theme_pagebuilder;
}

function gt3_get_theme_sidebars_for_admin()
{
    $theme_sidebars = gt3_get_theme_option("theme_sidebars");
    if (!is_array($theme_sidebars)) {
        $theme_sidebars = array();
    }

    return $theme_sidebars;
}

/*Work with options*/
if (!function_exists('gt3pb_get_option')) {
    function gt3pb_get_option($optionname, $defaultValue = "")
    {
        $returnedValue = get_option("gt3pb_" . $optionname, $defaultValue);

        if (gettype($returnedValue) == "string") {
            return stripslashes($returnedValue);
        } else {
            return $returnedValue;
        }
    }
}

if (!function_exists('gt3pb_delete_option')) {
    function gt3pb_delete_option($optionname)
    {
        return delete_option("gt3pb_" . $optionname);
    }
}

if (!function_exists('gt3pb_update_option')) {
    function gt3pb_update_option($optionname, $optionvalue)
    {
        if (update_option("gt3pb_" . $optionname, $optionvalue)) {
            return true;
        }
    }
}

function gt3_get_theme_option($optionname, $defaultValue = "")
{
    $returnedValue = get_option(GT3_THEMESHORT . $optionname, $defaultValue);

    if (gettype($returnedValue) == "string") {
        return stripslashes($returnedValue);
    } else {
        return $returnedValue;
    }
}

function gt3_the_theme_option($optionname, $beforeoutput = "", $afteroutput = "")
{
    $returnedValue = get_option(GT3_THEMESHORT . $optionname);

    if (strlen($returnedValue) > 0) {
        echo $beforeoutput . stripslashes($returnedValue) . $afteroutput;
    }
}

function gt3_get_if_strlen($str, $beforeoutput = "", $afteroutput = "")
{
    if (strlen($str) > 0) {
        return $beforeoutput . $str . $afteroutput;
    }
}

function gt3_delete_theme_option($optionname)
{
    return delete_option(GT3_THEMESHORT . $optionname);
}

function gt3_update_theme_option($optionname, $optionvalue)
{
    if (update_option(GT3_THEMESHORT . $optionname, $optionvalue)) {
        return true;
    }
}

function gt3_messagebox($actionmessage)
{
    $compile = "<div class='admin_message_box fadeout'>" . $actionmessage . "</div>";
    return $compile;
}

function gt3_theme_comment($comment, $args, $depth)
{
    $max_depth_comment = $args['max_depth'];
    if ($max_depth_comment > 4) {
        $max_depth_comment = 4;
    }
    $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="stand_comment">
        <div class="commentava wrapped_img">
            <?php echo get_avatar($comment->comment_author_email, 128); ?>
            <div class="img_inset"></div>
        </div>
        <div class="thiscommentbody">
            <div class="comment_content">
            	<div class="comment_box">
					<?php if ($comment->comment_approved == '0') : ?>
                        <p><em><?php _e('Your comment is awaiting moderation.', 'theme_localization'); ?></em></p>
                    <?php endif; ?>
                    <?php comment_text() ?>
                    <?php comment_reply_link(array_merge($args, array('before' => ' <span class="comments">', 'after' => '</span>', 'depth' => $depth, 'reply_text' => '', 'max_depth' => $max_depth_comment))) ?>
				</div>				
            </div>
            <div class="comment_info">            
                <span class="author_name"><?php printf('%s', get_comment_author_link()) ?> <?php edit_comment_link('(Edit)', '  ', '') ?></span>
                <span class="middot">&middot;</span>
                <span class="comment_date"><?php printf('%1$s', get_comment_date("F d, Y")) ?></span>
            </div>            
        </div>
    </div>
<?php
}

#Custom paging
function gt3_get_theme_pagination($range = 10, $type = "")
{
    if ($type == "show_in_shortcodes") {
        global $paged, $wp_query_in_shortcodes;
        $wp_query = $wp_query_in_shortcodes;
    } else {
        global $paged, $wp_query;
    }

    if (empty($paged)) {
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    }

    $max_page = $wp_query->max_num_pages;
    if ($max_page > 1) {
        echo '<ul class="pagerblock">';
    }
    if ($max_page > 1) {
        if (!$paged) {
            $paged = 1;
        }
        $ppl = "<span class='btn_prev'></span>";
        if ($max_page > $range) {
            if ($paged < $range) {
                for ($i = 1; $i <= ($range + 1); $i++) {
                    echo "<li><a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a></li>";
                }
            } elseif ($paged >= ($max_page - ceil(($range / 2)))) {
                for ($i = $max_page - $range; $i <= $max_page; $i++) {
                    echo "<li><a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a></li>";
                }
            } elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {
                for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {
                    echo "<li><a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a></li>";
                }
            }
        } else {
            for ($i = 1; $i <= $max_page; $i++) {
                echo "<li><a href='" . get_pagenum_link($i) . "'";
                if ($i == $paged) echo " class='current'";
                echo ">$i</a></li>";
            }
        }
        $npl = "<span class='btn_next'></span>";
    }
    if ($max_page > 1) {
        echo '</ul>';
    }
}

function gt3_the_pb_custom_bg_and_color($gt3_theme_pagebuilder, $args = array())
{
	if ((isset($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid']) && $gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'] !== '') || (isset($gt3_theme_pagebuilder['page_settings']['page_layout']['color']['hash']) && $gt3_theme_pagebuilder['page_settings']['page_layout']['color']['hash'] !== '')) {
        $bgimg_url = wp_get_attachment_url($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid']);
        $bgcolor_hash = $gt3_theme_pagebuilder['page_settings']['page_layout']['color']['hash'];		
	} else {
		if (get_page_template_slug() !== "page-portfolio-grid.php" && get_page_template_slug() !== "page-portfolio-masonry.php" && get_page_template_slug() !== "page-gallery-grid.php" && get_page_template_slug() !== "page-gallery-masonry.php") {
			$bgimg_url = gt3_get_theme_option("bg_img");
			$bgcolor_hash = gt3_get_theme_option("default_bg_color");
		}
	}
	if (isset($args['classes_for_body']) && $args['classes_for_body'] == true) {
		return "page_with_custom_background_image";
	} else {
		if (!isset ($bgimg_url)) $bgimg_url = '';
		if (!isset ($bgcolor_hash)) $bgcolor_hash = '';
		echo '<div class="custom_bg img_bg" style="background-image: url(\'' . $bgimg_url . '\'); background-color:#' . $bgcolor_hash . ';"></div>';
	}
	return true;
}

if (!function_exists('gt3_get_default_pb_settings')) {
    function gt3_get_default_pb_settings()
    {
        $gt3_theme_pagebuilder['settings']['layout-sidebars'] = gt3_get_theme_option("default_sidebar_layout");
        $gt3_theme_pagebuilder['settings']['left-sidebar'] = "Default";
        $gt3_theme_pagebuilder['settings']['right-sidebar'] = "Default";
        $gt3_theme_pagebuilder['settings']['bg_image']['status'] = gt3_get_theme_option("show_bg_img_by_default");
        $gt3_theme_pagebuilder['settings']['bg_image']['src'] = gt3_get_theme_option("bg_img");
        $gt3_theme_pagebuilder['settings']['custom_color']['status'] = gt3_get_theme_option("show_bg_color_by_default");
        $gt3_theme_pagebuilder['settings']['custom_color']['value'] = gt3_get_theme_option("default_bg_color");
        $gt3_theme_pagebuilder['settings']['bg_image']['type'] = gt3_get_theme_option("default_bg_img_position");

        return $gt3_theme_pagebuilder;
    }
}

if (!function_exists('gt3_get_selected_pf_images')) {
    function gt3_get_selected_pf_images($gt3_theme_pagebuilder, $width, $height)
    {
        if (!isset($compile)) {
            $compile = '';
        }
        if (isset($gt3_theme_pagebuilder['post-formats']['images']) && is_array($gt3_theme_pagebuilder['post-formats']['images'])) {
            if (count($gt3_theme_pagebuilder['post-formats']['images']) == 1) {
                $onlyOneImage = "oneImage";
            } else {
                $onlyOneImage = "";
            }
            $compile .= '
                <div class="slider-wrapper theme-default ' . $onlyOneImage . '">
                    <div class="nivoSlider">
            ';

            if (is_array($gt3_theme_pagebuilder['post-formats']['images'])) {
                foreach ($gt3_theme_pagebuilder['post-formats']['images'] as $imgid => $img) {
					$img_metadata = wp_get_attachment_metadata($img['attach_id']);
					
					//pre($img_metadata['image_meta']);
					$img_alt = get_post_meta($img['attach_id'], '_wp_attachment_image_alt', true);
                    $compile .= '
                        <img src="' . aq_resize(wp_get_attachment_url($img['attach_id']), $width, $height, true, true, true) . '" data-thumb="' . aq_resize(wp_get_attachment_url($img['attach_id']), $width, $height, true, true, true) . '" alt="'.$img_alt.'" />
                    ';

                }
            }

            $compile .= '
                    </div>
                </div>
            ';

        }

        $GLOBALS['showOnlyOneTimeJS']['nivo_slider'] = "
        <script>
            jQuery(document).ready(function($) {
                jQuery('.nivoSlider').each(function(){
                    jQuery(this).nivoSlider({
						directionNav: false,
						controlNav: true,
						effect:'fade',
						pauseTime:4000,
						slices: 1
                    });
                });
            });
        </script>
        ";

        wp_enqueue_script('gt3_nivo_js', get_template_directory_uri() . '/js/nivo.js', array(), false, true);
        return $compile;
    }
}

if (!function_exists('gt3_HexToRGB')) {
    function gt3_HexToRGB($hex = "ffffff")
    {
        $color = array();
        if (strlen($hex) < 1) {
            $hex = "ffffff";
        }

        if (strlen($hex) == 3) {
            $color['r'] = hexdec(substr($hex, 0, 1) . $r);
            $color['g'] = hexdec(substr($hex, 1, 1) . $g);
            $color['b'] = hexdec(substr($hex, 2, 1) . $b);
        } else if (strlen($hex) == 6) {
            $color['r'] = hexdec(substr($hex, 0, 2));
            $color['g'] = hexdec(substr($hex, 2, 2));
            $color['b'] = hexdec(substr($hex, 4, 2));
        }

        return $color['r'] . "," . $color['g'] . "," . $color['b'];
    }
}

if (!function_exists('gt3_smarty_modifier_truncate')) {
    function gt3_smarty_modifier_truncate($string, $length = 80, $etc = '... ',
                                          $break_words = false, $middle = false)
    {
        if ($length == 0)
            return '';

        if (mb_strlen($string, 'utf8') > $length) {
            $length -= mb_strlen($etc, 'utf8');
            if (!$break_words && !$middle) {
                $string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($string, 0, $length + 1, 'utf8'));
            }
            if (!$middle) {
                return mb_substr($string, 0, $length, 'utf8') . $etc;
            } else {
                return mb_substr($string, 0, $length / 2, 'utf8') . $etc . mb_substr($string, -$length / 2, utf8);
            }
        } else {
            return $string;
        }
    }
}

#Get all portfolio category inline (With Ajax)
function showPortCategoryWithAjax($postid = "")
{
    if (!isset($term_list)) {
        $term_list = '';
    }
    $permalink = get_permalink();
    $args = array('taxonomy' => 'Category');
    $terms = get_terms('portcat', $args);
    $count = count($terms);
    $i = 0;
    $iterm = 1;

    if ($count > 0) {
        if (!isset($_GET['slug'])) $all_current = 'selected';		
        $cape_list = '';
        $term_list .= '<li class="' . $all_current . '">';

        $term_list .= '<a href="#filter" data-option-value="*">' . ((gt3_get_theme_option("translator_status") == "enable") ? get_text("translator_portfolio_all") : __('All', 'theme_localization')) . '</a>
		</li>';
        $termcount = count($terms);
        if (is_array($terms)) {
            foreach ($terms as $term) {
                $i++;
                $permalink = esc_url(add_query_arg("slug", $term->slug, $permalink));
                $term_list .= '<li ';
                if (isset($_GET['slug'])) {
                    $getslug = $_GET['slug'];
                } else {
                    $getslug = '';
                }
                if (strnatcasecmp($getslug, $term->name) == 0) $term_list .= 'class="selected"';

                $tempname = strtr($term->name, array(
                    ' ' => '-',
                ));
                $tempname = strtolower($tempname);

                $term_list .= '><a href="#filter" data-option-value=".' . $tempname . '" title="View all post filed under ">' . $term->name . '</a>
                    <div class="filter_fadder"></div>
                </li>';
                if ($count != $i) $term_list .= ' '; else $term_list .= '';
                #if ($iterm<$termcount) {$term_list .= '<li class="sep fltr_after">:</li>';}
                $iterm++;
            }
        }
        echo '<ul class="optionset" data-option-key="filter">' . $term_list . '</ul>';
    }
}

function gt3_show_social_icons($array)
{
    $compile = "<ul class='socials_list'>";
    foreach ($array as $key => $value) {
        if (strlen(gt3_get_theme_option($value['uniqid'])) > 0) {
            $compile .= "<li><a class='" . $value['class'] . "' target='" . $value['target'] . "' href='" . gt3_get_theme_option($value['uniqid']) . "' title='" . $value['title'] . "'></a></li>";
        }
    }
    $compile .= "</ul>";
    if (is_array($array) && count($array) > 0) {
        return $compile;
    } else {
        return "";
    }
}

add_action("wp_head", "wp_head_mix_var");
function wp_head_mix_var()
{
    echo "<script>var " . GT3_THEMESHORT . "var = true;</script>";
}

function get_flow_type_output($args) 
{
    $compile = "";
    extract($args);
    if (isset($gt3_theme_pagebuilder['post-formats']['images'])) {
		$count = 1;
		if (!isset($autoplay) || $autoplay == '') {
			$autoplay = 'true';		
		}
		if (!isset($interval)) {
			$interval = '3000';		
		}
		$compile .= '<div class="whaterWheel_content dragme">
			<div id="whaterwheel" class="'.$autoplay.'" data-int="'.$interval.'">';

		foreach ($gt3_theme_pagebuilder['post-formats']['images'] as $imageid => $image) {
			if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoTitle = '';} else {$photoTitle = " ";}
			if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoAlt = $image['title']['value'];} else {$photoAlt = " ";}
			if (isset($image['caption']['value']) && strlen($image['caption']['value'])>0) {$photoCaption  = $image['caption']['value'];} else {$photoCaption = " ";}				
			$photoCaption = "";
			$photoTitle = "";
			$photoAlt = get_post_meta($image['attach_id'], '_wp_attachment_image_alt', true);
				$compile .= "<div class='ww_block' id='ww_block".$count."' data-count='".$count."'><div class='ww_wrapper'><img width='550' alt='". $photoAlt ."' height='550' src='" . aq_resize(wp_get_attachment_url($image['attach_id']), "550", "550", true, true, true) . "'/></div></div>";			
			$count++;
		}
		$compile .= '</div>
		</div>';
			$compile .= "
				<script>
				var owl = jQuery('#whaterwheel');
				jQuery(document).ready(function(){
					owl.owlCarousel({
						loop:true,
						nav:false,
						margin:15,
						center:true,
						autoplay:". $autoplay .",
						autoplayTimeout:". $interval .",
						autoplayHoverPause:true,
						responsive:{
							0:{
								items:2
							},
							760:{
								items:2
							},            
							960:{
								items:4
							},
							1200:{
								items:4
							}
						}
					});
					setTimeout('owl.animate({opacity : 1}, 500)',500);
				});
				</script>
			";
    }
    return $compile;
}
function get_pf_type_output($args)
{
    $compile = "";
    extract($args);
    if (!isset($width)) {
        $width = 1170;
    }
    if (!isset($height)) {
        $height = 563;
    }
	if (!isset($isPort)) {
		$isPort = false;
	}
	$featured_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
	
    if (isset($pf)) {
        $compile .= '<div class="pf_output_container">';

        /* Image */
        if ($pf == 'image') {
            if (isset($fw_post) && $fw_post == true) {
                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                if (strlen($featured_image[0]) > 0) {
                    $compile .= '<a href="'.$link2post.'"><img class="featured_image_standalone" src="' . aq_resize($featured_image[0], $width, $height, true, true, true) . '" alt="'.$featured_alt.'" /></a>';
                }
            } else {
                $compile .= gt3_get_selected_pf_images($gt3_theme_pagebuilder, $width, $height);
            }
        } else if ($pf == "video") {

            $uniqid = mt_rand(0, 9999);
            global $YTApiLoaded, $allYTVideos;
            if (empty($YTApiLoaded)) {
                $YTApiLoaded = false;
            }
            if (empty($allYTVideos)) {
                $allYTVideos = array();
            }

            $video_url = (isset($gt3_theme_pagebuilder['post-formats']['videourl']) ? $gt3_theme_pagebuilder['post-formats']['videourl'] : "");
            if (isset($gt3_theme_pagebuilder['post-formats']['video_height'])) {
                $video_height = $gt3_theme_pagebuilder['post-formats']['video_height'];
            } else {
                $video_height = $GLOBALS["pbconfig"]['default_video_height'];
            }

            #YOUTUBE
            $is_youtube = substr_count($video_url, "youtu");
            if ($is_youtube > 0) {
                $videoid = substr(strstr($video_url, "="), 1);
                $compile .= '<iframe width="100%" height="'. $video_height .'" frameborder="0" allowfullscreen="1" title="YouTube video player" src="https://www.youtube.com/embed/'. $videoid .'?autoplay=0&amp;controls=1"></iframe>';
                //array_push($allYTVideos, array("h" => $video_height, "w" => "100%", "videoid" => $videoid, "uniqid" => $uniqid));
            }

            #VIMEO
            $is_vimeo = substr_count($video_url, "vimeo");
            if ($is_vimeo > 0) {
                $videoid = substr(strstr($video_url, "m/"), 2);
                $compile .= "
            <iframe src=\"http://player.vimeo.com/video/" . $videoid . "\" width=\"100%\" height=\"" . $video_height . "\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        ";
            }
        } else {
            if (isset($fw_post) && $fw_post == true) {
                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                if (strlen($featured_image[0]) > 0) {
                    $compile .= '<a href="'.$link2post.'"><img class="featured_image_standalone" src="' . aq_resize($featured_image[0], $width, $height, true, true, true) . '" alt="'.$featured_alt.'" /></a>';
                }
            } else {
                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                if (strlen($featured_image[0]) > 0) {
                    $compile .= '<img class="featured_image_standalone" src="' . aq_resize($featured_image[0], $width, $height, true, true, true) . '" alt="'.$featured_alt.'" />';
                }
            }
        }

        $compile .= '</div>';
    }

    return $compile;
}

function init_YTvideo_in_footer()
{
    global $allYTVideos;
    $compile = "";
    $result = "";
    if (is_array($allYTVideos) && count($allYTVideos) > 0) {
        $compile .= "
        <script>
        var tag = document.createElement('script');
        tag.src = 'https://www.youtube.com/iframe_api';
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        function onPlayerReady(event) {}
        function onPlayerStateChange(event) {}
        function stopVideo() {
            player.stopVideo();
        }
        ";

        foreach ($allYTVideos as $key => $value) {
            $result .= "
            new YT.Player('player{$value['uniqid']}', {
                height: '{$value['h']}',
                width: '{$value['w']}',
                playerVars: { 'autoplay': 0, 'controls': 1 },
                videoId: '{$value['videoid']}',
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
            ";
        }
        $compile .= "function onYouTubeIframeAPIReady() {" . $result . "}</script>";
    }
    echo $compile;
}

add_filter('the_password_form', 'custom_password_form');
function custom_password_form()
{
    global $post;
    $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
    $o = '<form class="protected-post-form" action="' . esc_url(get_option('siteurl')) . '/wp-login.php?action=postpass" method="post">
	<p class="pp_notify">' . __("To view it please enter your password", 'theme_localization') . '</p>
	<input name="post_password" id="' . $label . '" type="password" size="20" placeholder="Password" /><input type="submit" name="Submit" value="' . esc_attr__("Submit") . '" />
	</form>
	';
    return $o;
}

function gt3_change_pw_text($content)
{
    if (gt3_get_theme_option("demo_server") == "true") {
        $content = str_replace(
            'To view it please enter your password',
            'To view it please enter your password (Hint:12345)',
            $content);
        return $content;
    } else {
        return $content;
    }
}

add_filter('the_content', 'gt3_change_pw_text');

function gt3_get_field_media_and_attach_id($name, $attach_id, $previewW = "200px", $previewH = null, $classname = "")
{
    return "<div class='select_image_root " . $classname . "'>
		<br>
		<h4>". __('Please select image to display as a featured:', 'theme_localization')."</h4>
        <input type='hidden' name='" . $name . "' value='" . $attach_id . "' class='select_img_attachid'>
        <div class='select_img_preview'><img src='" . ($attach_id > 0 ? aq_resize(wp_get_attachment_url($attach_id), $previewW, $previewH, true, true, true) : "") . "' alt=''></div>
        <input type='button' class='button button-secondary button-large select_attach_id_from_media_library' value='Select Image'>
    </div>";
}


function showJSInFooter()
{
    if (isset($GLOBALS['showOnlyOneTimeJS']) && is_array($GLOBALS['showOnlyOneTimeJS'])) {
        foreach ($GLOBALS['showOnlyOneTimeJS'] as $id => $js) {
            echo $js;
        }
    }
}

add_action('wp_footer', 'showJSInFooter');
add_action('wp_footer', 'init_YTvideo_in_footer');


function custom_wp_title( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }

    global $page, $paged;

    $title = get_bloginfo( 'name', 'display' ) . $title;

    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
    }

    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
    }

    return $title;
}
add_filter( 'wp_title', 'custom_wp_title', 10, 2 );

function is_gt3_builder_active() {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if (is_plugin_active('gt3-pagebuilder-custom/gt3_builder.php') || is_plugin_active('gt3-pagebuilder/gt3_builder.php')) {
        return true;
    } else {
        return false;
    }
}

require_once("core/loader.php");

// Woocommerce Related Products (3)
function woocommerce_output_related_products() {
	$args = array(
		'posts_per_page' => 3
	);
	woocommerce_related_products($args);
}	

// Woocommerce products per page (6)
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 6;' ), 20 ); 

// Woocommerce Header cart
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'theme_localization'); ?>"><span class="total_price"><span class="price_count"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'theme_localization'), $woocommerce->cart->cart_contents_count);?></span><?php echo $woocommerce->cart->get_cart_total(); ?></span></a>
	<?php
	$fragments['a.cart-contents'] = ob_get_clean();
	return $fragments;
}

add_theme_support('woocommerce');

// Woocommerce remove price & rating from template loop
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// Woocommerce add to list categories, price, post excerpt
add_action('woocommerce_after_shop_loop_item','woocommerce_template_single_meta', 5);

add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 10 );

add_action( 'woocommerce_after_shop_loop_item', 'woo_product_excerpt', 15);
if (!function_exists('woo_product_excerpt')) {
	function woo_product_excerpt() {
		global $post;
		$prod_excerpt = substr($post->post_excerpt, 0, 80);
		echo "<div class='loop_item_excerpt'><p>$prod_excerpt</p></div>";
	}
}

?>