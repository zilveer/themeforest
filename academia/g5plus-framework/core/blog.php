<?php
// Paging Load More
//--------------------------------------------------------------
if (!function_exists('g5plus_paging_load_more')) {
	function g5plus_paging_load_more() {
		global $wp_query;
		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}
		$link = get_next_posts_page_link($wp_query->max_num_pages);
		if (!empty($link)) :
			?>

				<button data-href="<?php echo esc_url($link); ?>" type="button"  data-loading-text="<span class='fa fa-spinner fa-spin'></span> <?php esc_html_e('Loading...','g5plus-academia'); ?>" class="blog-load-more m-button m-button-3d m-button-primary m-button-xs">
					<?php esc_html_e('Load More','g5plus-academia'); ?>
				</button>

		<?php
		endif;
	}
}

// Paging Infinite Scroll
//--------------------------------------------------------------
if (!function_exists('g5plus_paging_infinitescroll')) {
	function g5plus_paging_infinitescroll(){
		global $wp_query;
		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}
		$link = get_next_posts_page_link($wp_query->max_num_pages);
		if (!empty($link)) :
			?>
			<nav id="infinite_scroll_button">
				<a href="<?php echo esc_url($link); ?>"></a>
			</nav>
			<div id="infinite_scroll_loading" class="text-center infinite-scroll-loading"></div>
		<?php
		endif;
	}
}

/** ------------------------------
 * Generate paginate link
 ---------------------------------*/
if(!function_exists('g5plus_paginate_links')){
    function g5plus_paginate_links( $args = '' ) {
        global $wp_query, $wp_rewrite;

        // Setting up default values based on the current URL.
        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $url_parts    = explode( '?', $pagenum_link );

        // Get max pages and current page out of the current query, if available.
        $total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
        $current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

        // Append the format placeholder to the base URL.
        $pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

        // URL base depends on permalink settings.
        $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

        $defaults = array(
            'base' => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
            'format' => $format, // ?page=%#% : %#% is replaced by the page number
            'total' => $total,
            'current' => $current,
            'show_all' => false,
            'prev_next' => true,
            'prev_text' => esc_html__('&laquo; Previous','g5plus-academia'),
            'next_text' => esc_html__('Next &raquo;','g5plus-academia'),
            'end_size' => 1,
            'mid_size' => 2,
            'type' => 'plain',
            'add_args' => array(), // array of query args to add
            'add_fragment' => '',
            'before_page_number' => '',
            'after_page_number' => ''
        );

        $args = wp_parse_args( $args, $defaults );

        if ( ! is_array( $args['add_args'] ) ) {
            $args['add_args'] = array();
        }

        // Merge additional query vars found in the original URL into 'add_args' array.
        if ( isset( $url_parts[1] ) ) {
            // Find the format argument.
            $format = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
            $format_query = isset( $format[1] ) ? $format[1] : '';
            wp_parse_str( $format_query, $format_args );

            // Find the query args of the requested URL.
            wp_parse_str( $url_parts[1], $url_query_args );

            // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
            foreach ( $format_args as $format_arg => $format_arg_value ) {
                unset( $url_query_args[ $format_arg ] );
            }

            $args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
        }

        // Who knows what else people pass in $args
        $total = (int) $args['total'];
        if ( $total < 2 ) {
            return;
        }
        $current  = (int) $args['current'];
        $end_size = (int) $args['end_size']; // Out of bounds?  Make it the default.
        if ( $end_size < 1 ) {
            $end_size = 1;
        }
        $mid_size = (int) $args['mid_size'];
        if ( $mid_size < 0 ) {
            $mid_size = 2;
        }
        $add_args = $args['add_args'];
        $r = '';
        $page_links = array();
        $dots = false;

        $is_exists_prev = 0;
        if ( $args['prev_next'] && $current && 1 < $current ) :
            $link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
            $link = str_replace( '%#%', $current - 1, $link );
            if ( $add_args )
                $link = add_query_arg( $add_args, $link );
            $link .= $args['add_fragment'];

            /**
             * Filter the paginated links for the given archive pages.
             *
             * @since 3.0.0
             *
             * @param string $link The paginated link URL.
             */
            $page_links[] = '<a class="prev page-numbers" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $args['prev_text'] . '</a>';
            $is_exists_prev = 1;
        endif;
        for ( $n = 1; $n <= $total; $n++ ) :
            if ( $n == $current ) :
                $page_links[] = "<span class='page-numbers current'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</span>";
                $dots = true;
            else :
                if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
                    $link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
                    $link = str_replace( '%#%', $n, $link );
                    if ( $add_args )
                        $link = add_query_arg( $add_args, $link );
                    $link .= $args['add_fragment'];

                    /** This filter is documented in wp-includes/general-template.php */
                    $page_links[] = "<a class='page-numbers' href='" . esc_url( apply_filters( 'paginate_links', $link ) ) . "'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</a>";
                    $dots = true;
                elseif ( $dots && ! $args['show_all'] ) :
                    $page_links[] = '<span class="page-numbers dots">' . esc_html__( '&hellip;','g5plus-academia' ) . '</span>';
                    $dots = false;
                endif;
            endif;
        endfor;
        if ( $args['prev_next'] && $current && ( $current < $total || -1 == $total ) ) :
            $link = str_replace( '%_%', $args['format'], $args['base'] );
            $link = str_replace( '%#%', $current + 1, $link );
            if ( $add_args )
                $link = add_query_arg( $add_args, $link );
            $link .= $args['add_fragment'];

            /** This filter is documented in wp-includes/general-template.php */
            if(is_array($page_links) && count($page_links) >0){
                if($is_exists_prev==1){
                    $page_links_temps = array_slice($page_links,0, 1);
                    $page_links_temps[] = '<a class="next page-numbers" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $args['next_text'] . '</a>';
                    $page_links =  array_merge($page_links_temps, array_slice($page_links,1));
                }else{
                    $page_links_temps[] = '<a class="next page-numbers" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $args['next_text'] . '</a>';
                    $page_links =  array_merge($page_links_temps, $page_links);
                }

            }
        endif;
        switch ( $args['type'] ) {
            case 'array' :
                return $page_links;

            case 'list' :
                $r .= "<ul class='page-numbers'>\n\t<li>";
                $r .= join("</li>\n\t<li>", $page_links);
                $r .= "</li>\n</ul>\n";
                break;

            default :
                $r = join("\n", $page_links);
                break;
        }
        return $r;
    }
}

// Paging Infinite Scroll
//--------------------------------------------------------------
if ( ! function_exists( 'g5plus_paging_nav' ) ) {
	function g5plus_paging_nav() {
		global $wp_query, $wp_rewrite;
		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = esc_url(remove_query_arg( array_keys( $query_args ), $pagenum_link ));
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$page_links = g5plus_paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $wp_query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => wp_kses_post(__('<span>Previous</span>','g5plus-academia')) ,
			'next_text' => wp_kses_post(__('<span>Next</span>','g5plus-academia')),
			'type' => 'array'
		) );

		if (count($page_links) == 0) return;

		$links = "<ul class='pagination'>\n\t<li>";
		$links .= join("</li>\n\t<li>", $page_links);
		$links .= "</li>\n</ul>\n";
		return $links;
	}
}



/*================================================
GET POST THUMBNAIL
================================================== */
if (!function_exists('g5plus_post_thumbnail')) {
    function g5plus_post_thumbnail($size = '',&$showDate=false) {
        $html = '';
        $prefix = 'g5plus_';
        $width = '';
        $height = '';
        $g5plus_image_size = &G5Plus_Global::get_image_sizes();
        if (isset($g5plus_image_size[$size])) {
            $width = $g5plus_image_size[$size]['width'];
            $height = $g5plus_image_size[$size]['height'];
        }

        switch(get_post_format()) {
            case 'image' :
                $args = array(
                    'size' => $size,
                    'meta_key' => $prefix.'post_format_image'
                );
                $image = g5plus_get_image($args);
                if (!$image) break;
                $html = g5plus_get_image_hover($image,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID());
                break;
            case 'gallery':
                $images = g5plus_get_post_meta(get_the_ID(), $prefix.'post_format_gallery');
                if (count($images) > 0) {
                    $data_plugin_options = "data-plugin-options='{\"items\" : 1, \"dots\" : false, \"nav\" : true, \"animateOut\" : \"fadeOut\", \"animateIn\" : \"fadeIn\", \"autoplay\" : true}'";
                    $html = "<div class='owl-carousel' $data_plugin_options>";
                    foreach ($images as $image) {

                        if (empty($width) || empty($height)) {
                            $image_src_arr = wp_get_attachment_image_src( $image, $size );
                            if ($image_src_arr) {
                                $image_src = $image_src_arr[0];
                            }
                        } else {
                            $image_src = matthewruddy_image_resize_id($image,$width,$height);
                        }

                        if (!empty($image_src)) {
                            $html .= g5plus_get_image_hover($image_src,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID(),1);
                        }
                    }
                    $html .= '</div>';
                } else {
                    $args = array(
                        'size' => $size,
                        'meta_key' => ''
                    );
                    $image = g5plus_get_image($args);
                    if (!$image) break;
                    $html = g5plus_get_image_hover($image,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID());
                }
                break;
            case 'video':
                $video = g5plus_get_post_meta(get_the_ID(), $prefix.'post_format_video');
                $args = array(
                    'size' => $size,
                    'meta_key' => ''
                );
                $image = g5plus_get_image($args);
                if (!$image) {
                    $showDate = true;
                    if (count($video) > 0) {
                        $html .= '<div class="embed-responsive embed-responsive-16by9 embed-responsive-' . $size . '">';
                        $video = $video[0];
                        // If URL: show oEmbed HTML
                        if (filter_var($video, FILTER_VALIDATE_URL)) {
                            $args = array(
                                'wmode' => 'transparent'
                            );
                            $html .= wp_oembed_get($video, $args);
                        } // If embed code: just display
                        else {
                            $html .= $video;
                        }
                        $html .= '</div>';

                    }
                } else {
                    $video = $video[0];
                    if (filter_var($video, FILTER_VALIDATE_URL)) {
                        $html .= g5plus_get_video_hover($image, get_permalink(), the_title_attribute('echo=0'), $video);
                    } else {
                        $showDate = true;
                        $html .= '<div class="embed-responsive embed-responsive-16by9 embed-responsive-' . $size . '">';
                        $html .= $video;
                        $html .= '</div>';
                    }
                }
                break;
            case 'audio':
                $audio = g5plus_get_post_meta(get_the_ID(), $prefix.'post_format_audio');
                $args = array(
                    'size' => $size,
                    'meta_key' => ''
                );
                $image = g5plus_get_image($args);
                if(!$image || is_single()){
                    if (count($audio) > 0) {
                        $showDate = true;
                        $audio = $audio[0];
                        if (filter_var($audio, FILTER_VALIDATE_URL)) {
                            $html .= wp_oembed_get($audio);
                            $title = esc_attr(get_the_title());
                            $audio = esc_url($audio);
                            if (empty($html)) {
                                $id = uniqid();
                                $html .= "<div data-player='$id' class='jp-jplayer' data-audio='$audio' data-title='$title'></div>";
                                $html .= g5plus_jplayer($id);
                            }
                        } else {
                            $html .= $audio;
                        }
                        $html .= '<div style="clear:both;"></div>';

                    }
                }else{
                    $audio = $audio[0];
                    $html .= g5plus_get_audio_hover($image, get_permalink(), the_title_attribute('echo=0'), $audio);
                }

                break;
            default:
                $args = array(
                    'size' => $size,
                    'meta_key' => ''
                );
                $image = g5plus_get_image($args);
                if (!$image) break;
                $html = g5plus_get_image_hover($image,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID());
                break;
        }
        return $html;
    }
}

/*================================================
GET POST IMAGE
================================================== */
if (!function_exists('g5plus_get_image')) {
    function g5plus_get_image($args) {
        $default = apply_filters(
            'g5plus_get_image_default_args',
            array(
                'post_id'  => get_the_ID(),
                'size'    => '',
                'width'    => '',
                'height'   => '',
                'attr'     => '',
                'meta_key' => '',
                'scan'     => false,
                'default'  => ''
            )
        );


        $args = wp_parse_args( $args, $default );
        $size = $args['size'];



        $width = '';
        $height = '';

	    $g5plus_image_size = &G5Plus_Global::get_image_sizes();
        if (isset($g5plus_image_size[$size])) {
            $width = $g5plus_image_size[$size]['width'];
            $height = $g5plus_image_size[$size]['height'];
        }



        if ( ! $args['post_id'] ) {
            $args['post_id'] = get_the_ID();
        }

        // Get image from cache
        $key         = md5( serialize( $args ) );
        $image_cache = wp_cache_get( $args['post_id'], 'g5plus_get_image' );

        if ( ! is_array( $image_cache ) ) {
            $image_cache = array();
        }


        if ( empty( $image_cache[$key] ) ) {

            $image_src = '';

            // Get post thumbnail
            if (has_post_thumbnail($args['post_id'])) {
                $post_thumbnail_id   = get_post_thumbnail_id($args['post_id']);




                if (empty($width) || empty($height)) {
                    $image_src_arr = wp_get_attachment_image_src( $post_thumbnail_id, $size );
                    if ($image_src_arr) {
                        $image_src = $image_src_arr[0];
                    }
                } else {
                    $image_src = matthewruddy_image_resize_id($post_thumbnail_id,$width,$height);
                }
            }

            // Get the first image in the custom field
            if ((!isset($image_src) || empty($image_src))  && $args['meta_key']) {
                $post_thumbnail_id = g5plus_get_post_meta( $args['post_id'], $args['meta_key'], true );
                if ( $post_thumbnail_id ) {

                    if (empty($width) || empty($height)) {
                        $image_src_arr = wp_get_attachment_image_src( $post_thumbnail_id, $size );
                        if ($image_src_arr) {
                            $image_src = $image_src_arr[0];
                        }
                    } else {
                        $image_src = matthewruddy_image_resize_id($post_thumbnail_id,$width,$height);
                    }
                }
            }

            // Get the first image in the post content
            if ((!isset($image_src) || empty($image_src)) && ($args['scan'])) {
                preg_match( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_post_field( 'post_content', $args['post_id'] ), $matches );
                if ( ! empty( $matches ) ){
                    $image_src  = $matches[1];
                }
            }

            // Use default when nothing found
            if ( (!isset($image_src) || empty($image_src)) && ! empty( $args['default'] ) ){
                if ( is_array( $args['default'] ) ){
                    $image_src  = @$args['src'];
                } else {
                    $image_src = $args['default'];
                }
            }

            if (!isset($image_src) || empty($image_src)) {
                return false;
            }
            $image_cache[$key] = $image_src;
            wp_cache_set( $args['post_id'], $image_cache, 'g5plus_get_image' );
        } else {
            $image_src = $image_cache[$key];
        }
        $image_src = apply_filters( 'g5plus_get_image', $image_src, $args );
        return $image_src;
    }
}

/*================================================
GET IMAGE HOVER
================================================== */
if (!function_exists('g5plus_get_image_hover')) {
    function g5plus_get_image_hover($image,$size, $url, $title, $post_id,$gallery = 0) {
        $attachment_id = g5plus_get_attachment_id_from_url($image);

        $image_full_arr = wp_get_attachment_image_src($attachment_id,'full');

        $image_full = $image;

         if (isset($image_full_arr)) {
            $image_full = $image_full_arr[0];
        }

	    $width = '';
	    $height = '';

	    $g5plus_image_size = &G5Plus_Global::get_image_sizes();
	    if (isset($g5plus_image_size[$size])) {
		    $width = $g5plus_image_size[$size]['width'];
		    $height = $g5plus_image_size[$size]['height'];
	    } else {
		    global $_wp_additional_image_sizes;
		    if ( in_array( $size, array( 'thumbnail', 'medium', 'large' ) ) ) {
			    $width = get_option( $size . '_size_w' );
			    $height = get_option( $size . '_size_h' );

		    } elseif ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
			    $width = $_wp_additional_image_sizes[ $size ]['width'];
			    $height = $_wp_additional_image_sizes[ $size ]['height'];
		    }
	    }

        $prettyPhoto = 'prettyPhoto';
        if ($gallery == 1) {
            $prettyPhoto='prettyPhoto[blog_'.$post_id.']';
        }

	    if (empty($width) || empty($height)) {
		    return sprintf('<div class="entry-thumbnail">
                        <a href="%1$s" title="%2$s" class="entry-thumbnail-overlay">
                            <img class="img-responsive" src="%3$s" alt="%2$s"/>
                        </a>
                        <a data-rel="%5$s" href="%4$s" class="prettyPhoto"><i class="fa fa-expand"></i></a>
                      </div>',
			    $url,
			    $title,
			    $image,
			    $image_full,
			    $prettyPhoto
		    );
	    } else {
		    return sprintf('<div class="entry-thumbnail">
                        <a href="%1$s" title="%2$s" class="entry-thumbnail-overlay">
                            <img width="%6$s" height="%7$s" class="img-responsive" src="%3$s" alt="%2$s"/>
                        </a>
                        <a data-rel="%5$s" href="%4$s" class="prettyPhoto"><i class="fa fa-expand"></i></a>
                      </div>',
			    $url,
			    $title,
			    $image,
			    $image_full,
			    $prettyPhoto,
			    $width,
			    $height
		    );
	    }


    }
}

if (!function_exists('g5plus_get_audio_hover')) {
    function g5plus_get_audio_hover($image, $url, $title) {
        return sprintf('<div class="entry-thumbnail post-audio">
                        <a class="entry-thumbnail-overlay" href="%1$s" title="%2$s">
                            <img class="img-responsive" src="%3$s" alt="%2$s"/>
                        </a>
                        <a href="%1$s" class="prettyPhoto"><i class="fa fa-microphone"></i></a>
                      </div>',
            $url,
            $title,
            $image
        );
    }
}

if (!function_exists('g5plus_get_video_hover')) {
    function g5plus_get_video_hover($image, $url, $title, $video_url) {
        return sprintf('<div class="entry-thumbnail post-video">
                        <a class="entry-thumbnail-overlay" href="%1$s" title="%2$s">
                            <img class="img-responsive" src="%3$s" alt="%2$s"/>
                        </a>
                        <a data-rel="prettyPhoto" href="%4$s" class="prettyPhoto"><i class="fa fa-play-circle-o"></i></a>
                      </div>',
            $url,
            $title,
            $image,
            $video_url
        );
    }
}

/*================================================
GET ATTACHMENT ID FROM URL
================================================== */
if (!function_exists('g5plus_get_attachment_id_from_url')) {
    function g5plus_get_attachment_id_from_url($attachment_url = '') {
        global $wpdb;
        $attachment_id = false;

        // If there is no url, return.
        if ( '' == $attachment_url )
            return;

        // Get the upload directory paths
        $upload_dir_paths = wp_upload_dir();

        // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
        if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

            // If this is the URL of an auto-generated thumbnail, get the URL of the original image
            $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

            // Remove the upload path base directory from the attachment URL
            $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

            // Finally, run a custom database query to get the attachment ID from the modified attachment URL
            $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

        }
        return $attachment_id;
    }
}

/*================================================
GET JPLAYER
================================================== */
if (!function_exists('g5plus_jplayer')) {
    function g5plus_jplayer($id = 'jp_container_1') {
        ob_start();
        ?>
        <div id="<?php echo esc_attr($id); ?>" class="jp-audio">
            <div class="jp-type-single">
                <div class="jp-details">
                    <div class="jp-details-inner">
                        <div class="jp-title" aria-label="title">&nbsp;</div>
                        <div class="jp-time-holder">
                            <div class="jp-current-time"></div> /
                            <div class="jp-duration"></div>
                        </div>
                    </div>
                </div>

                <div class="jp-gui jp-interface">
                    <div class="jp-controls">
                        <a href="#" class="jp-play" tabindex="1"><i class="fa fa-play"></i></a>
                        <a href="#" class="jp-pause" tabindex="1"><i class="fa fa-pause"></i></a>
                    </div>
                    <div class="jp-progress">
                        <div class="jp-seek-bar">
                            <div class="jp-play-bar"></div>
                        </div>
                    </div>
                </div>
                <div class="jp-no-solution">
                    <?php printf(esc_html__('<span>Update Required</span> To play the media you will need to either update your browser to a recent version or update your <a href="%s" target="_blank">Flash plugin</a>.', 'g5plus-academia'), 'http://get.adobe.com/flashplayer/'); ?>
                </div>
            </div>
        </div>
        <?php
        $content = ob_get_clean();
        return $content;
    }
}


/*================================================
GET POST DATE
================================================== */
if (!function_exists('g5plus_post_date')) {
    function g5plus_post_date()
    {
        ob_start();
        ?>
        <div class="entry-date">
            <div class="entry-date-inner">
                <div class="day">
                    <?php echo get_the_time('d'); ?>
                </div>
                <div class="month">
                    <?php echo get_the_date('M'); ?>
                </div>
            </div>
        </div>
    <?php
        $content = ob_get_clean();
        echo wp_kses_post($content);
    }
}

/*================================================
GET POST META
================================================== */
if (!function_exists('g5plus_post_meta')) {
    function g5plus_post_meta() {
        g5plus_get_template('archive/post-meta');
    }
}

/*================================================
GET POST META RELATED
================================================== */
if (!function_exists('g5plus_post_meta_related')) {
    function g5plus_post_meta_related() {
        g5plus_get_template('single-blog/post-meta-related');
    }
}


/*================================================
ARCHIVE LOOP RESET
================================================== */
if (!function_exists('g5plus_archive_loop_reset')) {
    function g5plus_archive_loop_reset()
    {
        $g5plus_archive_loop = &G5Plus_Global::get_archive_loop();
        $g5plus_archive_loop['image-size'] = '';
        $g5plus_archive_loop['style'] = '';
    }
}

/*================================================
POST NAV
================================================== */
if (!function_exists('g5plus_post_nav')) {
    function g5plus_post_nav() {
        g5plus_get_template('single-blog/post-nav');
    }
    add_action('g5plus_after_single_post','g5plus_post_nav',20);
}


/*================================================
LINK PAGES
================================================== */
if (!function_exists('g5plus_link_pages')) {
    function g5plus_link_pages() {
        wp_link_pages(array(
            'before' => '<div class="g5plus-page-links"><span class="g5plus-page-links-title">' . esc_html__('Pages:','g5plus-academia') . '</span>',
            'after' => '</div>',
            'link_before' => '<span class="g5plus-page-link">',
            'link_after' => '</span>',
        ));
    }
    //add_action('g5plus_after_single_post_content','g5plus_link_pages',5);
}

/*================================================
POST TAGS
================================================== */
if (!function_exists('g5plus_post_tags')) {
    function g5plus_post_tags() {
        g5plus_get_template('single-blog/post-tags');
    }
    add_action('g5plus_after_single_post_content','g5plus_post_tags',10);
}

/*================================================
SHARE
================================================== */
if (!function_exists('g5plus_share')) {
    function g5plus_share() {
        g5plus_get_template('social-share');
    }
    add_action('g5plus_after_single_post_content','g5plus_share',15);
}

/*================================================
AUTHOR INFO
================================================== */
if (!function_exists('g5plus_post_author_info')) {
    function g5plus_post_author_info() {
        g5plus_get_template('single-blog/post-author-info');
    }
    add_action('g5plus_after_single_post','g5plus_post_author_info',25);
}

/*================================================
POSTS RELATED
================================================== */
if (!function_exists('g5plus_post_related')) {
    function g5plus_post_related() {
        g5plus_get_template('single-blog/related');
    }
    add_action('g5plus_after_single_post','g5plus_post_related',30);
}

/*================================================
GET POSTS RELATED
================================================== */
if (!function_exists('g5plus_get_related_post')) {
    function g5plus_get_related_post($post_id,$limit = 5) {

        // Related products are found from category and tag
        $tags_array = g5plus_get_related_terms( $post_id,'post_tag' );
        $cats_array = g5plus_get_related_terms( $post_id,'category' );
        if ( sizeof( $cats_array ) == 1 && sizeof( $tags_array ) == 1 ) {
            $related_posts = array();
        } else {
            global $wpdb;
            $query = g5plus_build_related_post_query( $post_id, $cats_array, $tags_array, $limit );
            // Get the posts
            $related_posts = $wpdb->get_col( implode( ' ', $query ));
        }
        return $related_posts;
    }
}

/*================================================
GET RELATED TERM
================================================== */
if (!function_exists('g5plus_get_related_terms')) {
    function g5plus_get_related_terms($post_id,$term) {
        $terms_array = array(0);
        $terms = apply_filters( 'g5plus_get_related_' . $term . '_terms', wp_get_post_terms( $post_id, $term ), $post_id );
        foreach ( $terms as $term ) {
            $terms_array[] = $term->term_id;
        }
        return array_map( 'absint', $terms_array );
    }
}

/*================================================
GET RELATED QUERY
================================================== */
if (!function_exists('g5plus_build_related_post_query')) {
    function g5plus_build_related_post_query($post_id, $cats_array, $tags_array,$limit) {
        global $wpdb;
	    $g5plus_options = &G5Plus_Global::get_options();

        $limit = absint( $limit );

        $query           = array();
        $query['fields'] = "SELECT DISTINCT ID FROM {$wpdb->posts} p";
        $query['join']  = " INNER JOIN {$wpdb->term_relationships} tr ON (p.ID = tr.object_id)";
        $query['join']  .= " INNER JOIN {$wpdb->term_taxonomy} tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)";
        $query['join']  .= " INNER JOIN {$wpdb->terms} t ON (t.term_id = tt.term_id)";


        $query['where']  = " WHERE 1=1";
        $query['where'] .= " AND p.post_status = 'publish'";
        $query['where'] .= " AND p.post_type = 'post'";
        $query['where'] .= " AND p.ID <> {$post_id}";


        $related_by_category =  $g5plus_options['related_post_condition']['category'] == 1 ? true : false;


        if ( apply_filters( 'g5plus_post_related_posts_relate_by_category', $related_by_category, $post_id ) ) {
            $query['where'] .= " AND ( ( tt.taxonomy = 'category' AND t.term_id IN ( " . implode( ',', $cats_array ) . " ) )";
            $andor = 'OR';
        } else {
            $andor = 'AND';
        }

        $related_by_tag =  $g5plus_options['related_post_condition']['tag'] == 1 ? true : false;

        // when query is OR - need to check against excluded ids again
        if ( apply_filters( 'g5plus_post_related_posts_relate_by_tag', $related_by_tag, $post_id ) ) {
            $query['where'] .= " {$andor}  ( tt.taxonomy = 'post_tag' AND t.term_id IN ( " . implode( ',', $tags_array ) . " ) )";
        }

        if ( apply_filters( 'g5plus_post_related_posts_relate_by_category', $related_by_category, $post_id ) ) {
            $query['where'] .= ")";
        }


        $query['limits'] = " LIMIT {$limit} ";
        $query           = apply_filters( 'g5plus_post_related_posts_query', $query, $post_id );
        return $query;
    }
}

/*================================================
RENDER COMMENTS
================================================== */
if (!function_exists('g5plus_render_comments')) {
    function g5plus_render_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
                <?php echo get_avatar($comment, $args['avatar_size']); ?>
                <div class="comment-text entry-content">
                    <div class="author p-font">
                        <div class="author-name"><?php printf('%s', get_comment_author_link()) ?></div>
                        <div class="comment-meta s-font">
                            <i class="fa fa-calendar"></i>
                            <span class="comment-meta-date">
                                added on  <?php echo get_comment_date('j M, Y '); ?>
                            </span>
                            <?php edit_comment_link(esc_html__('Edit','g5plus-academia')) ?>
                        </div>
                    </div>
                    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                    <div class="text">
                        <?php comment_text() ?>
                        <?php if ($comment->comment_approved == '0') : ?>
                            <em><?php esc_html_e('Your comment is awaiting moderation.','g5plus-academia');?></em>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
    <?php
    }
}

/*================================================
COMMENTS FORM
================================================== */
if (!function_exists('g5plus_comment_form')) {
    function g5plus_comment_form() {
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');
        $html5 = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';;
        $fields = array(
            'author' => '<div class="form-group col-md-12">' .
                '<label for="author">'. esc_html__('Name*','g5plus-academia').'</label>'.
                '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" placeholder="'.esc_html__('Name*','g5plus-academia').'" ' . $aria_req . '>' .
                '</div>',
            'email' => '<div class="form-group col-md-12">' .
                '<label for="email">'.esc_html__('Email*','g5plus-academia').'</label>'.
                '<input id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="'.esc_html__('Email*','g5plus-academia').'" ' . $aria_req . '>' .
                '</div>',
            'url'   => '<div class="form-group col-md-12">'.
                '<label for="url">'.esc_html__('Website','g5plus-academia').'</label>'.
                '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="'.esc_html__('Website','g5plus-academia').'" />'.
                '</div>',
        );
        $fields = apply_filters('g5plus_comment_fields',$fields);
        $comment_form_args = array(
            'fields' => $fields,
            'comment_field' => '<div class="form-group col-md-12">' .
                '<label for="comment">'.esc_html__('Message*','g5plus-academia').'</label>'.
                '<textarea rows="6" id="comment" name="comment" placeholder="'.esc_html__('Message*','g5plus-academia') .'" '. $aria_req .'></textarea>' .
                '</div>',
            'comment_notes_before' => '<p class="comment-notes">' .
                esc_html__('Your email address will not be published.', 'g5plus-academia') /* . ( $req ? $required_text : '' ) */ .
                '</p>',
            'comment_notes_after' => '',
            'id_submit' => 'btnComment',
            'class_submit' => 'button-comment',
            'title_reply' => esc_html__('Leave a Comment', 'g5plus-academia'),
            'title_reply_to' => esc_html__('Leave a Comment to %s', 'g5plus-academia'),
            'cancel_reply_link' => esc_html__('Cancel reply', 'g5plus-academia'),
            'label_submit' => esc_html__('Send', 'g5plus-academia')
        );

        $comment_form_args = apply_filters('g5plus_comment_form_args',$comment_form_args);

        comment_form($comment_form_args);
    }
}

/*================================================
SET FUNCTION COUNT VIEWS
================================================== */
if(!function_exists("g5plus_set_view")){
    function g5plus_set_view($postID) {
        $count_key = 'postview_number';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}
/*================================================
 SHOW VIEW
================================================== */
if(!function_exists('g5plus_show_view')){
    function g5plus_show_view($postID){
        $count_key = 'postview_number';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0";
        }
        return $count;
    }
}