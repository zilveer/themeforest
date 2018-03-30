<?php
/*-----------------------------------------------------------------------------------*/
/* Output Custom CSS from theme options
/*-----------------------------------------------------------------------------------*/

function icy_head_css() {
    global $icy_options;	
		$output = '';
		
		$custom_css = $icy_options['custom_css'];
        $highlight = $icy_options['primary_accent'];
		
        if ($highlight <> '') {
            $output .= "button:hover, input[type=\"submit\"]:hover, span.reply-to a:hover, .more-link:hover, .post-tags a:hover { background-color: " . $highlight . "; }";
            $output .= "a, a:hover, .navigation-posts a:hover, .entry-meta .icy-meta-data a:hover, footer .copyright a:hover, .widget a:hover, nav ul a:hover, nav ul li.current-cat a, nav ul li.current_page_item a, nav ul li.current-menu-item a { color: ". $highlight . "; }"; 
        }

		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}
		
        if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
	
}
add_action('wp_head', 'icy_head_css');

/*-----------------------------------------------------------------------------------*/
/* - Add Favicon
/*-----------------------------------------------------------------------------------*/

/**
 * Favicon
 *
 * @return  string     Outputs the HTML required for the favicon to be displayed
 * @uses    thsp_cbp_get_options_values(); defined in customizer/helpers.php to retrieve values from the customizer   
 */

function icy_graphics() {
    global $icy_options;

    $output = '';
    $favicon = $icy_options['favicon'] ;
    
    if ($favicon != "") {
       echo '<link rel="shortcut icon" href="' . $favicon . '"/>'."\n";
    }
}
add_action('wp_head', 'icy_graphics');
/*-----------------------------------------------------------------------------------*/
/* - Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function icy_analytics(){
	$shortname =  get_option('icy_shortname');
	$output = get_option($shortname . '_google_analytics');

	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";

}
add_action('wp_footer','icy_analytics');


/*-----------------------------------------------------------------------------------*/
/* - Custom Functions for Post Formats */
/*-----------------------------------------------------------------------------------*/

/* Output image */
if ( !function_exists( 'icy_image' ) ) {
    function icy_image($postid, $imagesize) {
        // get the featured image for the post
        $thumbid = 0;
        if( has_post_thumbnail($postid) ) {
            $thumbid = get_post_thumbnail_id($postid);
        }
    
        // get first 2 attachments for the post
        $args = array(
            'orderby' => 'menu_order',
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => 2
        );
        $attachments = get_posts($args);

        if( !empty($attachments) ) {
            foreach( $attachments as $attachment ) {
                // if current image is featured image reloop
                if( $attachment->ID == $thumbid ) continue;
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<div class='image-frame'>";
                echo "<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />";
                echo "</div>";
                // got image, time to exit foreach
                break;
            }
        }
    }
}

if ( !function_exists( 'icy_theme_gallery' ) ) {
    function icy_theme_gallery($postid, $imagesize) { ?>
        <script type="text/javascript">
            jQuery(window).load(function() {                                   
                jQuery('.flexslider').flexslider({
                    animation: 'fade',            
                    slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
                    animationSpeed: 700,            //Integer: Set the speed of animations, in milliseconds                     
                    animationLoop: true, 
                    slideshow: true,               // Set to true to autostart slideshow.
                    controlNav: false,
                    directionNav: true,
                    smoothHeight: true,        
                    useCSS: true,                 
                });
            });
        </script>
        <?php         
        $thumbid = 0;
    
        // get the featured image for the post
        if( has_post_thumbnail($postid) ) {
            $thumbid = get_post_thumbnail_id($postid);
        }                   
        
        $image_ids_raw = get_post_meta($postid, '_icy_image_ids', true);

        if( $image_ids_raw ) {
            // Using WP3.5; use post__in orderby option
            $image_ids = explode(',', $image_ids_raw);
            $postid = null;
            $orderby = 'post__in';
            $include = $image_ids;
        } else {
            $orderby = 'menu_order';
            $include = '';
        }
    
        // get attachments for the post
        $args = array(
            'include' => $include,
            'order' => 'ASC',
            'orderby' => $orderby,
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => -1
        );
        $attachments = get_posts($args);

        if( !empty($attachments) ) {
            echo "<!-- BEGIN #slider -->\n<div id='slider-$postid' class='flexslider'>"; 
            echo '<ul class="slides">';
            $i = 0;
            $posttitle = '';
            foreach( $attachments as $attachment ) {
                if( $attachment->ID == $thumbid ) continue;
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $caption = $attachment->post_excerpt;
                $caption = ($caption) ? $caption : $posttitle;
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<li><img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />";
                    if ($caption != '') echo "<p class='flex-caption'>$caption</p>";
                    echo "</li>";
                $i++;
            }
            echo '</ul>';
            echo "<!-- END #slider -->\n</div>";
        }
        
    }
}

/* Output video */
if ( !function_exists( 'icy_video' ) ) {
    function icy_video($postid, $width = 700) {
    
        $height = get_post_meta($postid, 'icy_video_height', true);
        $m4v = get_post_meta($postid, 'icy_video_m4v', true);
        $ogv = get_post_meta($postid, 'icy_video_ogv', true);
        $poster = get_post_meta($postid, 'icy_video_poster', true);
        $width = 700;
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
        
            if(jQuery().jPlayer) {
                jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
                    ready: function () {
                        jQuery(this).jPlayer("setMedia", {
                            <?php if($m4v != '') : ?>
                            m4v: "<?php echo $m4v; ?>",
                            <?php endif; ?>
                            <?php if($ogv != '') : ?>
                            ogv: "<?php echo $ogv; ?>",
                            <?php endif; ?>
                            <?php if ($poster != '') : ?>
                            poster: "<?php echo $poster; ?>"
                            <?php endif; ?>
                        });
                    },
                    size: {
                        width: "<?php echo $width ?>px",
                        height: "<?php echo $height . 'px'; ?>"
                    },
                    swfPath: "<?php echo get_template_directory_uri(); ?>/js",
                    cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
                    supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
                });
            }
        });
    </script>

    <div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-video"></div>

    <div class="jp-video-container">
        <div class="jp-video">
            <div class="jp-type-single">
                <div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
                    <ul class="jp-controls">
                        <li><div class="seperator-first"></div></li>
                        <li><div class="seperator-second"></div></li>
                        <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                        <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                        <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                        <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                    </ul>
                    <div class="jp-progress-container">
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                    </div>
                    <div class="jp-volume-bar-container">
                        <div class="jp-volume-bar">
                            <div class="jp-volume-bar-value"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php }
}

/*-----------------------------------------------------------------------------------*/
/* Add Related Posts
/*-----------------------------------------------------------------------------------*/

function icy_custom_related_posts() {
    if (is_single()) {
        global $post;
        $current_post = $post->ID;
        $categories = get_the_category();
        
        foreach ($categories as $category) :
        ?>
            <div class="related-posts">
            <h3><?php _e('Related articles', 'framework'); ?></h3>
                <ul>
                <?php
                    $posts = get_posts('numberposts=8&category='. $category->term_id . '&exclude=' . $current_post);
                    foreach($posts as $post) :
                ?>
                    <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_time( get_option('date_format') ); ?> - <?php the_title(); ?></a></li>
                    <?php endforeach; ?>
        <?php endforeach; ?>
                </ul>
            </div>
        <?php }
        wp_reset_query();
}

/*-----------------------------------------------------------------------------------*/
/* Add Body Classes for Sidebar Position
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'icy_body_class' ) ) { 
    function icy_body_class($classes) {        
        global $icy_options;
        $layout = '';
        $layout = $icy_options['sidebar_position'];
        if ($layout == '') {
            $layout = 'sidebar-right';
        }
        $classes[] = $layout;
        return $classes;
    }
    add_filter('body_class','icy_body_class');
}

?>