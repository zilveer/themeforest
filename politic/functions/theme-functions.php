<?php
/*-----------------------------------------------------------------------------------*/
/* Output Custom CSS from theme options
/*-----------------------------------------------------------------------------------*/

function icy_head_css() {

		$shortname =  get_option('icy_shortname'); 
		$output = '';
		
		$custom_css = get_option('icy_custom_css');
		
		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}

        /* Custom Highlight Color */
        $link_normal = get_option('icy_link_color_normal');
        $link_hover = get_option('icy_link_color_hover');
        $nav_normal = get_option('icy_navlink_color_normal');
        $nav_hover = get_option('icy_navlink_color_hover');
        $nav_current = get_option('icy_navlink_color_current');

        if( !empty($link_normal) && $link_normal != '#' ) {
            $output .= "\n\n /* Custom Link Colour */ \n\n";
            $output .= "a { color: $link_normal; }\n";
        }


        if( !empty($link_hover) && $link_hover != '#' ) {
            $output .= "\n\n /* Custom Link Hover Colour */ \n\n";
            $output .= "a:hover { color: $link_hover; }\n";
        }

        if( !empty($nav_normal) && $nav_normal != '#' ) {
            $output .= "\n\n /* Custom Nav Link Colour */ \n\n";
            $output .= "nav ul li a { color: $nav_normal; }\n";
        }

        if( !empty($nav_hover) && $nav_hover != '#' ) {
            $output .= "\n\n /* Custom Nav Link Hover Colour */ \n\n";
            $output .= "nav ul li a:hover { color: $nav_hover; }\n";
        }        
		
        if( !empty($nav_current) && $nav_current != '#' ) {
            $output .= "\n\n /* Custom Nav Link Current Item Colour */ \n\n";
            $output .= "nav ul li.current-cat a, nav ul li.current_page_item a, nav ul li.current-menu-item a { color: $nav_current; }\n";
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

function icy_favicon() {

	$shortname = get_option('icy_shortname');

	if (get_option($shortname . '_custom_favicon') != '') {

	echo '<link rel="shortcut icon" href="'. get_option('icy_custom_favicon') .'"/>'."\n";

	}

	else { ?>

	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/admin/images/favicon.ico" />

	<?php }
}
add_action('wp_head', 'icy_favicon');

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
            jQuery(document).ready(function($){
                                   
                $('.flexslider').flexslider({
                    animation: "fade",
                    controlNav: false,
                    animationLoop: true,
                    slideshow: true,
                    useCSS: true,
                    prevText: "<",           //String: Set the text for the "previous" directionNav item
                    nextText: ">"                 
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
            foreach( $attachments as $attachment ) {
                if( $attachment->ID == $thumbid ) continue;
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $caption = $attachment->post_excerpt;
                $caption = ($caption) ? $caption : $posttitle;
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<li><img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' /></li>";
                $i++;
            }
            echo '</ul>';
            echo "<!-- END #slider -->\n</div>";
        }
        
    }
}

/*  Output Audio */
if ( !function_exists( 'icy_audio' ) ) {
    function icy_audio($postid, $width = 700) {
    
        $mp3 = get_post_meta($postid, 'icy_audio_mp3', TRUE);
        $ogg = get_post_meta($postid, 'icy_audio_ogg', TRUE);
        $poster = get_post_meta($postid, 'icy_audio_poster', TRUE);
        $height = get_post_meta($postid, 'icy_poster_height', TRUE);
        $width = 700;
    
    ?>

            <script type="text/javascript">
        
                jQuery(document).ready(function(){
    
                    if(jQuery().jPlayer) {
                        jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
                            ready: function () {
                                jQuery(this).jPlayer("setMedia", {
                                    <?php if($poster != '') : ?>
                                    poster: "<?php echo $poster; ?>",
                                    <?php endif; ?>
                                    <?php if($mp3 != '') : ?>
                                    mp3: "<?php echo $mp3; ?>",
                                    <?php endif; ?>
                                    <?php if($ogg != '') : ?>
                                    oga: "<?php echo $ogg; ?>",
                                    <?php endif; ?>
                                    end: ""
                                });
                            },
                            <?php if( !empty($poster) ) { ?>
                            size: {
                                width: "<?php echo $width; ?>px",
                                height: "<?php echo $height . 'px'; ?>"
                            },
                            <?php } ?>
                            swfPath: "<?php echo get_template_directory_uri(); ?>/js",
                            cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
                            supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
                        });
                    
                    }
                });
            </script>
        
            <div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-audio"></div>

            <div class="jp-audio-container">
                <div class="jp-audio">
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
        <?php 
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


/* Custom Walker for wp_list_categories in template-portfolio.php */

class Portfolio_Walker extends Walker_Category {
    function start_el(&$output, $category, $depth, $args) {
            extract($args);

            $cat_name = esc_attr( $category->name );
            $cat_name = apply_filters( 'list_cats', $cat_name, $category );
            $link = '<a href="' . esc_attr( get_term_link($category) ) . '" ';
            $link .= 'data-filter="' . $category->slug . '" ';
            if ( $use_desc_for_title == 0 || empty($category->description) )
                    $link .= 'title="' . esc_attr( sprintf(__( 'View all posts filed under %s' ), $cat_name) ) . '"';
            else
                    $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
            $link .= '>';
            $link .= $cat_name . '</a>';

            if ( !empty($feed_image) || !empty($feed) ) {
                    $link .= ' ';

                    if ( empty($feed_image) )
                            $link .= '(';

                    $link .= '<a href="' . get_term_feed_link( $category->term_id, $category->taxonomy, $feed_type ) . '"';

                    if ( empty($feed) ) {
                            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
                    } else {
                            $title = ' title="' . $feed . '"';
                            $alt = ' alt="' . $feed . '"';
                            $name = $feed;
                            $link .= $title;
                    }

                    $link .= '>';

                    if ( empty($feed_image) )
                            $link .= $name;
                    else
                            $link .= "<img src='$feed_image'$alt$title" . ' />';

                    $link .= '</a>';

                    if ( empty($feed_image) )
                            $link .= ')';
            }

            if ( !empty($show_count) )
                    $link .= ' (' . intval($category->count) . ')';

            if ( !empty($show_date) )
                    $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);

            if ( 'list' == $args['style'] ) {
                    $output .= "\t<li";
                    $class = 'cat-item cat-item-' . $category->term_id;
                    if ( !empty($current_category) ) {
                            $_current_category = get_term( $current_category, $category->taxonomy );
                            if ( $category->term_id == $current_category )
                                    $class .=  ' current-cat';
                            elseif ( $category->term_id == $_current_category->parent )
                                    $class .=  ' current-cat-parent';
                    }
                    $output .=  ' class="' . $class . '"';
                    $output .= ">$link\n";
            } else {
                    $output .= "\t$link<br />\n";
            }
    }
}


/*-----------------------------------------------------------------------------------*/
/*  Get related posts by taxonomy
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'icy_get_posts_related_by_taxonomy' ) ) {
    function icy_get_posts_related_by_taxonomy($post_id, $taxonomy, $args=array()) {
        $query = new WP_Query();
        $terms = wp_get_object_terms($post_id, $taxonomy);
        if (count($terms)) {
        // Assumes only one term for per post in this taxonomy
        $post_ids = get_objects_in_term($terms[0]->term_id,$taxonomy);
        $post = get_post($post_id);
        $args = wp_parse_args($args,array(
            'post_type' => $post->post_type, // The assumes the post types match
            'post__not_in' => array($post_id),
            'taxonomy' => $taxonomy,
            'term' => $terms[0]->slug,
            'orderby' => 'rand',
            'posts_per_page' => get_option('tz_portfolio_related_number')
        ));
        $query = new WP_Query($args);
        }
        return $query;
    }
}

?>