<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }


if( ! function_exists( 'zen_entry_meta' ) ) :
    function zen_entry_meta() {
        if ( 'post' == get_post_type() ) : ?>

            <span>
                <i class="fa fa-user"></i>
                <?php the_author(); ?>
                <?php _e(' in ', LANGUAGE_ZONE) ?>
                <?php the_category(', '); ?>
            </span>

        <?php endif;
    }
endif;

if( ! function_exists( 'zen_comments_information' ) ) :

    function zen_comments_information(){
        if ( comments_open() ) {
        ?>
            <span>
                <i class="fa fa-comment"></i>
                <a href="#" rel="23 comments">
                    <?php
                        comments_popup_link(
                            __( ' 0 comments', LANGUAGE_ZONE ),
                            __( ' 1 comment', LANGUAGE_ZONE ),
                            __( ' % comments', LANGUAGE_ZONE  )
                        );
                    ?>
                </a>
            </span>
        <?php
        }
    }

endif;

if( ! function_exists( 'zen_the_date' ) ) :

    /**
     * Display the date in the ZEN format.
     *
     * @since 1.0.0
     */

    function zen_the_date() {

        $zen_date = get_the_time('d-M-Y');

        $zen_day = substr($zen_date, 0, 2);
        $zen_month = substr($zen_date, 3, 3);
        $zen_month = strtoupper($zen_month);
        $zen_year = substr($zen_date, 7, 4);

        $output = '<span><i class="fa fa-clock-o"></i>' . '<a class="date">' . $zen_day . ' ';
        $output .= $zen_month . ' ';
        $output .= $zen_year . '</a></span>';

        echo $output;

    }

endif;

if( ! function_exists( 'zen_edit_link' ) ) :
    function zen_edit_link() {
        edit_post_link( __( 'EDIT', LANGUAGE_ZONE ), '<span><i class="fa fa-edit"></i> ', '</span>' );
    }
endif;

if( ! function_exists( 'zen_entry_tags' ) ) :

    function zen_entry_tags() {
        $tag_list = get_the_tags();
        if ( $tag_list ) {
            echo '<h6>' . __('tags: ', LANGUAGE_ZONE) . '</h6><ul class="clearfix">';

            $i = 0;
            $n = count( $tag_list );

            foreach($tag_list as $tag) {
                echo '<li><a href="' . home_url( '/' ) . '?tag=' . $tag->slug . '">' . $tag->name . '</a></li>';
                //if ($i != $n-1) echo ', ';
                $i++;
            }

            echo '</ul>';
        }
    }

endif;

if( ! function_exists( 'clx_tags' ) ) :

    function clx_tags() {
        $tag_list = wp_get_post_terms(get_the_ID(), AlbumPostType::get_instance()->postTypeTag);
        if ( $tag_list ) {
            echo '<h6>' . __('tags: ', LANGUAGE_ZONE) . '</h6><ul class="clearfix">';

            $i = 0;
            $n = count( $tag_list );

            foreach($tag_list as $tag) {
                echo '<li><a href="' . home_url( '/' ) . '?atag=' . $tag->slug . '">' . $tag->name . '</a></li>';
                $i++;
            }

            echo '</ul>';
        }
    }

endif;

if( ! function_exists( 'zen_the_excerpt' ) ) :
    function zen_the_excerpt() {
        echo zen_get_the_excerpt();
    }
endif;

if( ! function_exists( 'zen_get_the_excerpt' ) ) :

    /**
     * Returns a nice excerpt/content for the blog page.
     *
     * @return mixed|string|void
     *
     * @since 1.0.0
     *
     */

    function zen_get_the_excerpt() {

        global $post, $more, $pages;
        $more = 0;

        if ( !has_excerpt( $post->ID ) ) {

            $excerpt_length = apply_filters('excerpt_length', 55);
            $content = zen_get_the_clear_content();

            // check for more tag
            if ( preg_match( '/<!--more(.*?)?-->/', $post->post_content, $matches ) ) {

                // check content length
            } elseif ( st_count_words( $content ) <= $excerpt_length ) {

                add_filter('zen_get_content_more', 'zen_return_empty_string', 15);

            } else {

                $content = '';

            }

        }

        // if we got excerpt or content more than $excerpt_length
        if ( empty($content) && get_the_excerpt() ) {

            $content = apply_filters( 'the_excerpt', get_the_excerpt() );

        }

        return $content;

    }
endif;

if( ! function_exists( 'zen_get_the_clear_content' ) ) :

    /**
     * Return content passed throw these functions:
     *	strip_shortcodes( $content );
     *	apply_filters( 'the_content', $content );
     *	str_replace( ']]>', ']]&gt;', $content );
     *
     * @return string
     */
    function zen_get_the_clear_content() {
        $content = get_the_content( '' );
        $content = strip_shortcodes( $content );
        $content = apply_filters( 'the_content', $content );
        $content = str_replace( ']]>', ']]&gt;', $content );

        return $content;
    }

endif;

if( ! function_exists( 'zen_return_empty_string' ) ) :
    /**
     * Return empty string.
     *
     * @return string
     */
    function zen_return_empty_string() {
        return '';
    }
endif;

if( ! function_exists( 'zen_get_content_more' ) ) :

    /**
     * A filter for the "Read More" button
     *
     * @return mixed|void
     *
     * @since 1.0.0
     */

    function zen_get_content_more() {
        $more_button = '<a class="read-more" href="';
        $more_button .= get_permalink();
        $more_button .= '" >';
        $more_button .= __('Read more', LANGUAGE_ZONE);
        $more_button .= ' <i class="fa fa-angle-double-right"></i></a>';

        return apply_filters('zen_get_content_more', $more_button);
    }

endif;

if ( ! function_exists( 'zen_breadcrumbs' ) ) :

    // original script you can find on http://dimox.net
    function zen_breadcrumbs() {

        $breadcrumbs_html = apply_filters( 'zen_get_breadcrumbs-html', '' );
        if ( $breadcrumbs_html ) {
            return $breadcrumbs_html;
        }

        global $clx_data;

        $text['home']     = __('Home', LANGUAGE_ZONE);
        $text['category'] = __('Category "%s"', LANGUAGE_ZONE);
        $text['search']   = __('Results for "%s"', LANGUAGE_ZONE);
        $text['tag']      = __('Entries tagged with "%s"', LANGUAGE_ZONE);
        $text['author']   = __('Article author %s', LANGUAGE_ZONE);
        $text['404']      = __('Error 404', LANGUAGE_ZONE);

        $showCurrent = 1;
        $showOnHome  = 1;
        $delimiter   = '';
        $before      = '<li class="current">';
        $after       = '</li>';

        global $post;
        $homeLink = home_url() . '/';
        $linkBefore = '<li typeof="v:Breadcrumb">';
        $linkAfter = '</li>';
        $linkAttr = ' rel="v:url" property="v:title"';
        $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s" title="">%2$s</a>' . $linkAfter;


        if (is_home() || is_front_page()) {

            if ($showOnHome == 1) {
                $breadcrumbs_html .= '<ol class="breadcrumb"><li><a href="' . $homeLink . '">' . $text['home'] . '</a></li></ol>';
            }

        } else {

            $breadcrumbs_html .= '<ul class="breadcrumb">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

            if ( is_category() ) {

                $thisCat = get_category(get_query_var('cat'), false);

                if ($thisCat->parent != 0) {

                    $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);

                    if(preg_match( '/title="/', $cats ) ===0) {
                        $cats = preg_replace('/title=""/', 'title=""', $cats);
                    }

                    $breadcrumbs_html .= $cats;
                }

                $breadcrumbs_html .= $before . sprintf($text['category'], single_cat_title('', false)) . $after;

            } elseif ( is_search() ) {

                $breadcrumbs_html .= $before . sprintf($text['search'], get_search_query()) . $after;

            } elseif ( is_day() ) {

                $breadcrumbs_html .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                $breadcrumbs_html .= sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
                $breadcrumbs_html .= $before . get_the_time('d') . $after;

            } elseif ( is_month() ) {

                $breadcrumbs_html .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                $breadcrumbs_html .= $before . get_the_time('F') . $after;

            } elseif ( is_year() ) {

                $breadcrumbs_html .= $before . get_the_time('Y') . $after;

            } elseif ( is_single() && !is_attachment() ) {

                if ( get_post_type() != 'post' && get_post_type() != AlbumPostType::get_instance()->postType && get_post_type() != ArtistPostType::get_instance()->postType && get_post_type() != SongPostType::get_instance()->postType && get_post_type() != EventPostType::get_instance()->postType && get_post_type() != PhotoPostType::get_instance()->postType && get_post_type() != VideoPostType::get_instance()->postType ) {

                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    $breadcrumbs_html .= sprintf($link, $homeLink . '' . $slug['slug'] . '/', $post_type->labels->singular_name);

                    if ($showCurrent == 1) {
                        $breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
                    }

                } elseif ( get_post_type() == AlbumPostType::get_instance()->postType ) {

                    $url = get_post_type_archive_link( AlbumPostType::get_instance()->postType );

                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    $breadcrumbs_html .= sprintf($link, $url, $post_type->labels->singular_name);

                    if ($showCurrent == 1) {
                        $breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
                    }

                } elseif ( get_post_type() == EventPostType::get_instance()->postType ) {

                    if(isset($clx_data['events-page-default'])) {
                        $url = get_permalink($clx_data['events-page-default']);
                    }

                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    $breadcrumbs_html .= sprintf($link, $url, $post_type->labels->singular_name);

                    if ($showCurrent == 1) {
                        $breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
                    }

                } elseif ( get_post_type() == ArtistPostType::get_instance()->postType ) {

                    $url = get_post_type_archive_link( ArtistPostType::get_instance()->postType );

                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    $breadcrumbs_html .= sprintf($link, $url, $post_type->labels->singular_name);

                    if ($showCurrent == 1) {
                        $breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
                    }

                } elseif ( get_post_type() == SongPostType::get_instance()->postType ) {

                    $url = get_post_type_archive_link( AlbumPostType::get_instance()->postType );

                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    $breadcrumbs_html .= sprintf($link, $url, $post_type->labels->singular_name);

                    if ($showCurrent == 1) {
                        $breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
                    }

                } elseif ( get_post_type() == PhotoPostType::get_instance()->postType ) {

                    $url = get_post_type_archive_link( AlbumPostType::get_instance()->postType );

                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    $breadcrumbs_html .= sprintf($link, $url, $post_type->labels->singular_name);

                    if ($showCurrent == 1) {
                        $breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
                    }

                } elseif ( get_post_type() == VideoPostType::get_instance()->postType ) {

                    $url = get_post_type_archive_link( AlbumPostType::get_instance()->postType );

                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    $breadcrumbs_html .= sprintf($link, $url, $post_type->labels->singular_name);

                    if ($showCurrent == 1) {
                        $breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
                    }

                } else {

                    $cat = get_the_category(); $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, $delimiter);

                    if ($showCurrent == 0) {
                        $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                    }

                    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);

                    $breadcrumbs_html .= $cats;

                    if ($showCurrent == 1) {
                        $breadcrumbs_html .= $before . get_the_title() . $after;
                    }
                }

            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

                $post_type = get_post_type_object(get_post_type());
                if ( $post_type ) {
                    $breadcrumbs_html .= $before . $post_type->labels->singular_name . $after;
                }

            } elseif ( is_attachment() ) {

                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);

                $breadcrumbs_html .= $cats;

                $breadcrumbs_html .= sprintf($link, get_permalink($parent), $parent->post_title);

                if ($showCurrent == 1) {
                    $breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
                }

            } elseif ( is_page() && !$post->post_parent ) {

                if ($showCurrent == 1) {
                    $breadcrumbs_html .= $before . '<a href="'.get_permalink().'">' .get_the_title() . '</a>' . $after;
                }

            } elseif ( is_page() && $post->post_parent ) {

                $parent_id  = $post->post_parent;
                $breadcrumbs = array();

                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    $parent_id  = $page->post_parent;
                }

                $breadcrumbs = array_reverse($breadcrumbs);

                for ($i = 0; $i < count($breadcrumbs); $i++) {

                    $breadcrumbs_html .= $breadcrumbs[$i];

                    if ($i != count($breadcrumbs)-1) {
                        $breadcrumbs_html .= $delimiter;
                    }
                }

                if ($showCurrent == 1) {
                    $breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
                }

            } elseif ( is_tag() ) {

                $breadcrumbs_html .= $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

            } elseif ( is_author() ) {

                global $author;
                $userdata = get_userdata($author);
                $breadcrumbs_html .= $before . sprintf($text['author'], $userdata->display_name) . $after;

            } elseif ( is_404() ) {

                $breadcrumbs_html .= $before . $text['404'] . $after;
            }

            if ( get_query_var('paged') ) {

                $breadcrumbs_html .= $before;

                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
                    $breadcrumbs_html .= ' (';
                }

                $breadcrumbs_html .= __('Page', LANGUAGE_ZONE) . ' ' . get_query_var('paged');

                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
                    $breadcrumbs_html .= ')';
                }

                $breadcrumbs_html .= $after;

            }

            $breadcrumbs_html .= '</ol>';
        }

        return apply_filters('zen_get_breadcrumbs', $breadcrumbs_html);
    }

endif;

if( ! function_exists( 'zen_single_post_pagination' ) ) :

    /**
     * Outputs the single post pagination.
     *
     * @since 1.0.0
     */

    function zen_single_post_pagination() {

        $output = wp_link_pages(
            array(
                'before'            => '<ul class="pager">',
                'after'             => '</ul>',
                'next_or_number'    =>'next',
                'previouspagelink'  => __(' &laquo; Previous Page','zen7'),
                'nextpagelink'      => __(' Next Page &raquo; ', 'zen7'),
                'separator'         => ' ', 'link_before' => '<li>',
                'link_after'        => '</li>',
                'echo'              => 0
            ));

        $output = str_replace('li></a>', 'a></li>', $output);
        $output = str_replace('<li>', '', $output);
        $output = str_replace('<a href', '<li><a href', $output);

        echo $output;

    }

    function haze_unused() {
        posts_nav_link();
    }

endif;

if( ! function_exists( 'zen_get_attachment' ) ) :

    function zen_get_attachment( $attachment_id ) {

        $attachment = get_post( $attachment_id );

        return array(
            'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
            'video_url' => get_post_meta( $attachment->ID, 'zen_video_url', true ),
            'caption' => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href' => get_permalink( $attachment->ID ),
            'src' => $attachment->guid,
            'title' => $attachment->post_title
        );

    }

endif;

if( ! function_exists( 'zen_the_post_rs' ) ) :

    function zen_the_post_rs( $attachments, $options = array() ) {
        $output = '';

        // If we have some images, build the slider
        if ( (int)$attachments['count'] != 0 ) {
            foreach ($attachments['images'] as $image) {

                $img_details = zen_get_attachment($image->ID);

                if ( $img_details['video_url'] != '' ) {
                    $output .= '<a class="rsImg" href="'.$img_details['src'].'" data-rsVideo="'.$img_details['video_url'].'" alt="'.$img_details['caption'].'" /></a>';
                } else {
                    $output .= '<img class="rsImg" data-rsBigImg="'.$img_details['src'].'" src="'.$img_details['src'].'" alt="'.$img_details['caption'].'" />';
                }
            }

            $output = ' <div class="rsClubix rsDefault">'. $output .'</div>';
        }

        return $output;
    }

endif;

if( ! function_exists( 'zen_get_gallery_images' ) ) :

    /**
     * Return the images from the gallery.
     *
     * @return array
     * @since 1.0.0
     */
    function zen_get_gallery_images() {
        global $post; $ids = '';

        $gallery_images = array();

        $array = get_post_gallery( $post->ID, false );
        if ( $array['ids'] != '' )
            $ids = explode(",", $array['ids']);

        foreach( $ids as $id ) {

            array_unshift($gallery_images, get_post( $id ));

        }

        if (!empty($gallery_images)) {
            $gallery_count = count($gallery_images);

            return array(
                'images' => $gallery_images,
                'count'  => $gallery_count
            );
        }

        return array(
            'images' => array(),
            'count'  => 0
        );
    }

endif;

if( !function_exists( 'clx_genres' ) ) :

    function clx_genres($items = 4) {
        $terms = wp_get_post_terms( get_the_ID(), SongPostType::get_instance()->postTypeTax );

        $s_items = count($terms);

        if($s_items > 0) {
            _e('Genre(s)', LANGUAGE_ZONE);
            echo '<span>';

            foreach($terms as $genre) {
                if($items > 0) {

                    if($items > 1 && $s_items > 1) {
                        echo $genre->name . ', ';
                    } else {
                        echo $genre->name;
                    }

                }
                $items--;
            }

            echo '</span>';
        }

    }

endif;

if( !function_exists( 'clx_album_genres' ) ) :

    function clx_album_genres($items = 4) {
        $terms = wp_get_post_terms( get_the_ID(), AlbumPostType::get_instance()->postTypeTax );

        $s_items = count($terms);

        if($s_items > 0) {
            _e('Genre(s)', LANGUAGE_ZONE);
            echo '<span>';

            foreach($terms as $genre) {
                if($items > 0) {

                    if($items > 1 && $s_items > 1) {
                        echo $genre->name . ', ';
                    } else {
                        echo $genre->name;
                    }

                }
                $items--;
            }

            echo '</span>';
        }

    }

endif;

if( !function_exists( 'clx_simple_song_player' ) ) :

    function clx_simple_song_player($songs_ids) {
        $prefix = Haze_Meta_Boxes::get_instance()->prefix;
        $songs_nr = count($songs_ids);
        $output = '';

        if($songs_nr > 0) {

            // Construct the player
            $output .= '<ul data-component="audio-player" class="component">';
            foreach($songs_ids as $song_id) {

                // Get the song data
                $song_external_url = rwmb_meta("{$prefix}song_url", array(), $song_id);
                $song_name = rwmb_meta("{$prefix}song_name", array(), $song_id);
                $artist_name = rwmb_meta("{$prefix}song_artist_name", array(), $song_id);
                $song_beatport = rwmb_meta("{$prefix}beatport_url", array(), $song_id);
                $song_itunes = rwmb_meta("{$prefix}itunes_url", array(), $song_id);
                $song_soundcloud = rwmb_meta("{$prefix}soundcloud_url", array(), $song_id);
                $song_youtube = rwmb_meta("{$prefix}youtube_url", array(), $song_id);

                // If the external url it's set, use it.
                // If it's not set, use the uploader field URL.
                if($song_external_url != '') {

                    $output .= '<li class="track" data-song-path="'.$song_external_url.'" data-song-name="'.$song_name.'" data-author-name="'.$artist_name.'" data-track-number="">';
                    $output .= '<div class="additional-buttons">';
                    if($song_soundcloud) {$output .= '<a href="'.$song_soundcloud.'" target="_blank" title="Soundcloud"><i class="fa fa-cloud-download"></i></a>';}
                    if($song_beatport) {$output .= '<a href="'.$song_beatport.'" target="_blank" title="Beatport"><i class="fa fa-headphones"></i></a>';}
                    if($song_itunes) {$output .= '<a href="'.$song_itunes.'" target="_blank" title="iTunes"><i class="fa fa-apple"></i></a>';}
                    if($song_youtube) {$output .= '<a href="'.$song_youtube.'" target="_blank" title="YouTube"><i class="fa fa-youtube-square"></i></a>';}
                    $output .= '</div>';
                    $output .= '<a class="play-pause-button"><i class="fa fa-play"></i></a>';
                    $output .= '<div class="name"><p>'.$artist_name.' - '.$song_name.'</p>';
                    $output .= '<div class="time-bar"><span style="width: 0%;"></span></div></div>';
                    $output .= '<time></time>';
                    $output .= '</li>';

                } else {
                    $song_files = rwmb_meta("{$prefix}song_upload_url", array('type'=>'file'), $song_id);

                    foreach($song_files as $song_file) {
                        $song_url = wp_get_attachment_url( $song_file['ID'] );

                        $output .= '<li class="track" data-song-path="'.$song_url.'" data-song-name="'.$song_name.'" data-author-name="'.$artist_name.'" data-track-number="">';
                        $output .= '<div class="additional-buttons">';
                        if($song_soundcloud) {$output .= '<a href="'.$song_soundcloud.'" target="_blank" title="Soundcloud"><i class="fa fa-cloud-download"></i></a>';}
                        if($song_beatport) {$output .= '<a href="'.$song_beatport.'" target="_blank" title="Beatport"><i class="fa fa-headphones"></i></a>';}
                        if($song_itunes) {$output .= '<a href="'.$song_itunes.'" target="_blank" title="iTunes"><i class="fa fa-apple"></i></a>';}
                        if($song_youtube) {$output .= '<a href="'.$song_youtube.'" target="_blank" title="YouTube"><i class="fa fa-youtube-square"></i></a>';}
                        $output .= '</div>';
                        $output .= '<a class="play-pause-button"><i class="fa fa-play"></i></a>';
                        $output .= '<div class="name"><p>'.$artist_name.' - '.$song_name.'</p>';
                        $output .= '<div class="time-bar"><span style="width: 0%;"></span></div></div>';
                        $output .= '<time></time>';
                        $output .= '</li>';

                    }

                }

            }

            $output .= '</ul>';
        }

        return $output;
    }

endif;

if( !function_exists( 'clx_big_song_player' ) ) :

    function clx_big_song_player($songs_ids, $autoplay = false) {
        $prefix = Haze_Meta_Boxes::get_instance()->prefix;
        $songs_nr = count($songs_ids);
        $output = '';

        if($songs_nr > 0) {

            // Construct the player
            $output .= '<ul data-component="audio-player-large" '. ( $autoplay ? 'data-autoplay="1"' : 'data-autoplay="0"' ) .' class="component">';
            foreach($songs_ids as $song_id) {

                // Get the song data
                $song_external_url = rwmb_meta("{$prefix}song_url", array(), $song_id);
                $song_name = rwmb_meta("{$prefix}song_name", array(), $song_id);
                $artist_name = rwmb_meta("{$prefix}song_artist_name", array(), $song_id);
                $song_beatport = rwmb_meta("{$prefix}beatport_url", array(), $song_id);
                $song_itunes = rwmb_meta("{$prefix}itunes_url", array(), $song_id);
                $song_soundcloud = rwmb_meta("{$prefix}soundcloud_url", array(), $song_id);
                $song_youtube = rwmb_meta("{$prefix}youtube_url", array(), $song_id);
                $song_img = wp_get_attachment_url(get_post_thumbnail_id( $song_id ));

                // If the external url it's set, use it.
                // If it's not set, use the uploader field URL.
                if($song_external_url != '') {

                    $output .= '<li class="track" data-song-path="'.$song_external_url.'" data-song-img="'.$song_img.'" data-song-name="'.$song_name.'" data-author-name="'.$artist_name.'" data-track-number=""  data-beatport="'.$song_beatport.'" data-itunes="'.$song_itunes.'" data-soundcloud="'.$song_soundcloud.'" data-youtube="'.$song_youtube.'">';
                    $output .= '<div class="additional-buttons">';
                    $output .= '</div>';
                    $output .= '<a class="play-pause-button"><i class="fa fa-play"></i></a>';
                    $output .= '<div class="name"><p>'.$artist_name.' - '.$song_name.'</p>';
                    $output .= '<div class="time-bar"><span style="width: 0%;"></span></div></div>';
                    $output .= '<time></time>';
                    $output .= '</li>';

                } else {
                    $song_files = rwmb_meta("{$prefix}song_upload_url", array('type'=>'file'), $song_id);

                    foreach($song_files as $song_file) {
                        $song_url = wp_get_attachment_url( $song_file['ID'] );

                        $output .= '<li class="track" data-song-path="'.$song_url.'" data-song-img="'.$song_img.'" data-song-name="'.$song_name.'" data-author-name="'.$artist_name.'" data-track-number=""  data-beatport="'.$song_beatport.'" data-itunes="'.$song_itunes.'" data-soundcloud="'.$song_soundcloud.'" data-youtube="'.$song_youtube.'">';
                        $output .= '<div class="additional-buttons">';
                        $output .= '</div>';
                        $output .= '<a class="play-pause-button"><i class="fa fa-play"></i></a>';
                        $output .= '<div class="name"><p>'.$artist_name.' - '.$song_name.'</p>';
                        $output .= '<div class="time-bar"><span style="width: 0%;"></span></div></div>';
                        $output .= '<time></time>';
                        $output .= '</li>';

                    }

                }

            }

            $output .= '</ul>';
        }

        return $output;
    }

endif;

if( !function_exists( 'clx_download_button' ) ) :

    function clx_download_button($post_id) {
        $prefix = Haze_Meta_Boxes::get_instance()->prefix;
        ?>

        <?php if(rwmb_meta("{$prefix}album_field_1_name", array(), $post_id) != '') : ?>
        <div class="dropdown">
            <a data-toggle="dropdown" href="#">
                <?php _e('download', LANGUAGE_ZONE); ?>
                <i class="fa fa-angle-down"></i>
            </a>

                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <?php for($i = 1; $i <= 4; $i++ ) : ?>
                        <?php if(rwmb_meta("{$prefix}album_field_{$i}_name", array(), $post_id) != '') : ?>
                        <li>
                            <a href="<?= rwmb_meta("{$prefix}album_field_{$i}_url", array(), $post_id); ?>" target="_blank">
                                <?= rwmb_meta("{$prefix}album_field_{$i}_name", array(), $post_id); ?>
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ul>

        </div>
        <?php else : ?>
        <div class="dropdown disable">
            <a data-toggle="dropdown" href="#">
                download
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
            </ul>
        </div>
        <?php endif; ?>

        <?php

    }

endif;

if( ! function_exists( 'clx_album_single_nav' ) ) :

    function clx_album_single_nav($current_id) {

        $args = array(
            'posts_per_page'   => 999,
            'offset'           => 0,
            'category'         => '',
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'include'          => '',
            'exclude'          => '',
            'meta_key'         => '',
            'meta_value'       => '',
            'post_type'        => AlbumPostType::get_instance()->postType,
            'post_mime_type'   => '',
            'post_parent'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => true );

        $posts_array = get_posts( $args );

        $n = count($posts_array);
        $has_next = false;
        $has_previous = false;
        $next_portfolio = array();
        $previous_portfolio = array();

        for ( $i = 0; $i < $n; $i++ ){
            if ( $current_id == $posts_array[$i]->ID && $n > 1 ) {

                if( $i == 0 ) {
                    $has_next = false;
                    $has_previous = true;

                    $next_portfolio = array();
                    $previous_portfolio = array('title' => $posts_array[$i+1]->post_title, 'link' => get_permalink( $posts_array[$i+1]->ID ));
                } else if( $i == $n-1 ) {
                    $has_next = true;
                    $has_previous = false;

                    $next_portfolio = array('title' => $posts_array[$i-1]->post_title, 'link' => get_permalink( $posts_array[$i-1]->ID ));
                    $previous_portfolio = array();
                } else {
                    $has_next = true;
                    $has_previous = true;

                    $next_portfolio = array('title' => $posts_array[$i-1]->post_title, 'link' => get_permalink( $posts_array[$i-1]->ID ));
                    $previous_portfolio = array('title' => $posts_array[$i+1]->post_title, 'link' => get_permalink( $posts_array[$i+1]->ID ));
                }

            }
        }

        ?>
        <?php if ($has_next) : ?>
            <a href="<?php echo $next_portfolio['link']; ?>" class="nav-posts right"><i class="fa fa-angle-right"></i></a>
        <?php else: ?>
            <a href="#" style="cursor: not-allowed;" class="nav-posts canceled right"><i class="fa fa-angle-right"></i></a>
        <?php endif; ?>

        <?php if ($has_previous) : ?>
            <a href="<?php echo $previous_portfolio['link']; ?>" class="nav-posts left"><i class="fa fa-angle-left"></i></a>
        <?php else: ?>
            <a href="#" style="cursor: not-allowed;" class="nav-posts canceled left"><i class="fa fa-angle-left"></i></a>
        <?php endif;

    }

endif;

if( ! function_exists( 'clx_event_single_nav' ) ) :

    function clx_event_single_nav($current_id) {

        $args = array(
            'posts_per_page'   => 999,
            'offset'           => 0,
            'category'         => '',
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'include'          => '',
            'exclude'          => '',
            'meta_key'         => '',
            'meta_value'       => '',
            'post_type'        => EventPostType::get_instance()->postType,
            'post_mime_type'   => '',
            'post_parent'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => true );

        $posts_array = get_posts( $args );

        $n = count($posts_array);
        $has_next = false;
        $has_previous = false;
        $next_portfolio = array();
        $previous_portfolio = array();

        for ( $i = 0; $i < $n; $i++ ){
            if ( $current_id == $posts_array[$i]->ID && $n > 1 ) {

                if( $i == 0 ) {
                    $has_next = false;
                    $has_previous = true;

                    $next_portfolio = array();
                    $previous_portfolio = array('title' => $posts_array[$i+1]->post_title, 'link' => get_permalink( $posts_array[$i+1]->ID ));
                } else if( $i == $n-1 ) {
                    $has_next = true;
                    $has_previous = false;

                    $next_portfolio = array('title' => $posts_array[$i-1]->post_title, 'link' => get_permalink( $posts_array[$i-1]->ID ));
                    $previous_portfolio = array();
                } else {
                    $has_next = true;
                    $has_previous = true;

                    $next_portfolio = array('title' => $posts_array[$i-1]->post_title, 'link' => get_permalink( $posts_array[$i-1]->ID ));
                    $previous_portfolio = array('title' => $posts_array[$i+1]->post_title, 'link' => get_permalink( $posts_array[$i+1]->ID ));
                }

            }
        }

        ?>
        <?php if ($has_next) : ?>
            <a href="<?php echo $next_portfolio['link']; ?>" class="nav-posts right"><i class="fa fa-angle-right"></i></a>
        <?php else: ?>
            <a href="#" style="cursor: not-allowed;" class="nav-posts canceled right"><i class="fa fa-angle-right"></i></a>
        <?php endif; ?>

        <?php if ($has_previous) : ?>
            <a href="<?php echo $previous_portfolio['link']; ?>" class="nav-posts left"><i class="fa fa-angle-left"></i></a>
        <?php else: ?>
            <a href="#" style="cursor: not-allowed;" class="nav-posts canceled left"><i class="fa fa-angle-left"></i></a>
        <?php endif;

    }

endif;

if( ! function_exists( 'clx_post_single_nav' ) ) :

    function clx_post_single_nav($current_id, $post_type) {

        $args = array(
            'posts_per_page'   => 999,
            'offset'           => 0,
            'category'         => '',
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'include'          => '',
            'exclude'          => '',
            'meta_key'         => '',
            'meta_value'       => '',
            'post_type'        => $post_type,
            'post_mime_type'   => '',
            'post_parent'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => true );

        $posts_array = get_posts( $args );

        $n = count($posts_array);
        $has_next = false;
        $has_previous = false;
        $next_portfolio = array();
        $previous_portfolio = array();

        for ( $i = 0; $i < $n; $i++ ){
            if ( $current_id == $posts_array[$i]->ID && $n > 1 ) {

                if( $i == 0 ) {
                    $has_next = false;
                    $has_previous = true;

                    $next_portfolio = array();
                    $previous_portfolio = array('title' => $posts_array[$i+1]->post_title, 'link' => get_permalink( $posts_array[$i+1]->ID ));
                } else if( $i == $n-1 ) {
                    $has_next = true;
                    $has_previous = false;

                    $next_portfolio = array('title' => $posts_array[$i-1]->post_title, 'link' => get_permalink( $posts_array[$i-1]->ID ));
                    $previous_portfolio = array();
                } else {
                    $has_next = true;
                    $has_previous = true;

                    $next_portfolio = array('title' => $posts_array[$i-1]->post_title, 'link' => get_permalink( $posts_array[$i-1]->ID ));
                    $previous_portfolio = array('title' => $posts_array[$i+1]->post_title, 'link' => get_permalink( $posts_array[$i+1]->ID ));
                }

            }
        }

        ?>
        <?php if ($has_next) : ?>
            <a href="<?php echo $next_portfolio['link']; ?>" class="nav-posts right"><i class="fa fa-angle-right"></i></a>
        <?php else: ?>
            <a href="#" style="cursor: not-allowed;" class="nav-posts canceled right"><i class="fa fa-angle-right"></i></a>
        <?php endif; ?>

        <?php if ($has_previous) : ?>
            <a href="<?php echo $previous_portfolio['link']; ?>" class="nav-posts left"><i class="fa fa-angle-left"></i></a>
        <?php else: ?>
            <a href="#" style="cursor: not-allowed;" class="nav-posts canceled left"><i class="fa fa-angle-left"></i></a>
        <?php endif;

    }

endif;

if(!function_exists('clx_breadcrumbs_filter')) :

    function clx_breadcrumbs_filter($taxonomy, $ids = array()) {
        $output = '';

        $output .= '<nav class="categories-portfolio"><ul data-option-key="filter" class="option-set">';
        $output .= '<li><a class="selected" data-option-value="*">'.__('All', LANGUAGE_ZONE).'</a></li>';

        if(empty($ids)) {
            $terms = get_terms($taxonomy);

            foreach($terms as $term) { $ids[] = $term->term_id; }
        }

        foreach($ids as $id) {
            $term = get_term($id, $taxonomy);

            $output .= '<li><a data-option-value=".'.$term->slug.'">'.$term->name.'</a></li>';
        }

        $output .= '</ul></nav>';


        return $output;
    }

endif;

if(!function_exists('clx_save_recurring_event')) :

    /**
     * Function developed by StylishThemes.
     * All rights reserved.
     * @param $post_id
     */
    function clx_save_recurring_event($post_id){

        // verify if this is an auto save routine.
        // If it is our form has not been submitted, so we dont want to do anything
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;

        if ( wp_is_post_revision( $post_id ) )
            return;

        // If this isn't a post, don't update it.
        if ( !isset($_POST['post_type'])
            || EventRecurringPostType::get_instance()->postType != $_POST['post_type'] ) {
            return;
        }

        // Get the recurring event hidden field that tells us if we are creating or just editing the post.
        // If we are just creating it, it will return an empty array.
        $events_ids = get_post_meta( $post_id, '_events_created', true );
        $events_new_ids = array();

        // If the array is not empty when we are updating/creating the recurring event, delete all the events.
        // TODO Find a way to do this more efficient.
        if( !empty( $events_ids ) ) {

            foreach($events_ids as $event_id) {
                wp_delete_post($event_id, true);
            }

        }

        // If there are no posts yet, or we just deleted them, we have to create or re-create them.
        $post = get_post($post_id);
        $terms = wp_get_post_terms( $post_id, EventRecurringPostType::get_instance()->postTypeTax, array('fields' => 'ids') );

        // Get custom fields from the recurring event
        $prefix = Haze_Meta_Boxes::get_instance()->prefix;

        $event_meta_obj = clx_get_event_meta($post_id);
        $event_recurrence_meta_obj = clx_get_event_recurrence_meta($post_id);
        $recurrence_days = $event_recurrence_meta_obj['recurrence_days'];

        $events_starting_dates = clx_get_starting_dates($event_recurrence_meta_obj);

        // EDIT EVENTS OR CREATE NEW ONE IF IT's THE CASE
        foreach($events_starting_dates as $event_start_date) {

            //$event_start_date = $event_start_date->format('d-m-Y');

            if($recurrence_days == '' || $recurrence_days == '0') {

                $event_end_date = $event_start_date;

            } else {

                $date = new DateTime($event_start_date);
                $date->add(new DateInterval('P'.$recurrence_days.'D'));
                $event_end_date = $date->format('d-m-Y');

            }


            // CREATE EVENTS AND FILL THEM WITH THE INFO
            remove_action( 'save_post', 'clx_save_recurring_event', 999 );

            $my_post = array(
                //'ID'                => $events_ids[0],
                'post_title'        => $post->post_title,
                'post_content'      => $post->post_content,
                'post_excerpt'      => $post->post_excerpt,
                'tax_input'         => array(
                    EventPostType::get_instance()->postTypeTax => $terms,
                ),
                'post_status'       => 'publish',
                'comment_status'    => $post->comment_status,
                'post_type'         => EventPostType::get_instance()->postType
            );

            $new_post_id = wp_insert_post( $my_post );

            add_action( 'save_post', 'clx_save_recurring_event', 999 );


            // If the post was successfully added, then update the post meta.
            if($new_post_id != 0) {

                $events_new_ids[] = $new_post_id;

                // Fill the custom fields
                clx_update_event_meta( $new_post_id, $event_meta_obj);

                update_post_meta ( $new_post_id, "{$prefix}event_start_date", $event_start_date);
                update_post_meta ( $new_post_id, "{$prefix}event_end_date", $event_end_date);

                // Fill the featured image
                set_post_thumbnail( $new_post_id, get_post_thumbnail_id( $post_id ) );

            }

        }

        update_post_meta ($post_id, '_events_created', $events_new_ids);

        //ob_start();

    }
    add_action('save_post', 'clx_save_recurring_event', 999);
    //add_action('untrash_post', 'clx_save_recurring_event', 999);


endif;

if(!function_exists('clx_trash_recurring_event')) :

    function clx_trash_recurring_event($post_id) {

        // Get the recurring event hidden field that tells us if we are creating or just editing the post.
        // If we are just creating it, it will return an empty array.
        $events_ids = get_post_meta( $post_id, '_events_created', true );

        // If the array is not empty when we are updating/creating the recurring event, delete all the events.
        // TODO Find a way to do this more efficient.
        if( !empty( $events_ids ) ) {

            foreach($events_ids as $event_id) {
                wp_trash_post($event_id, true);
            }

        }

    }
    add_action('wp_trash_post', 'clx_trash_recurring_event', 999);

endif;

if(!function_exists('clx_delete_recurring_event')) :

    function clx_delete_recurring_event($post_id) {

        // Get the recurring event hidden field that tells us if we are creating or just editing the post.
        // If we are just creating it, it will return an empty array.
        $events_ids = get_post_meta( $post_id, '_events_created', true );

        // If the array is not empty when we are updating/creating the recurring event, delete all the events.
        // TODO Find a way to do this more efficient.
        if( !empty( $events_ids ) ) {

            foreach($events_ids as $event_id) {
                wp_delete_post($event_id, true);
            }

        }

    }
    add_action('delete_post', 'clx_delete_recurring_event', 999);

endif;

if(!function_exists('clx_get_starting_dates')) :

    function clx_get_starting_dates($event_recurrence_meta_obj) {
        $starting_dates = array();

        $every = $event_recurrence_meta_obj['recurrence_every'];
        $start_date = $event_recurrence_meta_obj['event_start_date_recurrence'];
        $end_date = $event_recurrence_meta_obj['event_end_date_recurrence'];
        $week_days = $event_recurrence_meta_obj['recurrence_weekly_days'];
        $the_day = $event_recurrence_meta_obj['recurrence_monthly_days_number'];
        $the_day_name = $event_recurrence_meta_obj['recurrence_monthly_days'];

        $start_date = new DateTime($start_date);
        $end_date = new DateTime($end_date);

        switch($event_recurrence_meta_obj['event_recurrence_type']) {
            case 'daily':

                $interval = new DateInterval('P'.$every.'D');
                $dates_interval = new DatePeriod($start_date, $interval, $end_date);

                foreach($dates_interval as $date) {
                    $starting_dates[] = $date->format('d-m-Y');
                }

                break;
            case 'weekly':

                foreach($week_days as $day) {

                    $first_date = new DateTime(date('d-m-Y', strtotime($day, strtotime($event_recurrence_meta_obj['event_start_date_recurrence']))));

                    $interval = new DateInterval('P'.$every.'W');

                    $dates_interval = new DatePeriod($first_date, $interval, $end_date);

                    foreach($dates_interval as $date) {
                        $starting_dates[] = $date->format('d-m-Y');
                    }

                }

                break;
            case 'monthly':

                $interval = DateInterval::createFromDateString($the_day.' '.$the_day_name.' of this month, +1 month');
                $dates_interval = new DatePeriod($start_date, $interval, $end_date);

                $i = 0;
                foreach($dates_interval as $date) {

                    $y_x_of_this_month = strtotime($the_day.' '.$the_day_name.' of '.$start_date->format('F Y'));

                    if($i == 0 && $date->format('d-m-Y') != date('d-m-Y', $y_x_of_this_month)) {
                        // Do nothing.
                    } else {
                        $starting_dates[] = $date->format('d-m-Y');
                    }

                    $i++;
                }

                break;
            case 'yearly':

                $interval = new DateInterval('P'.$every.'Y');
                $dates_interval = new DatePeriod($start_date, $interval, $end_date);

                foreach($dates_interval as $date) {
                    $starting_dates[] = $date->format('d-m-Y');
                }

                break;
        }

        return $starting_dates;
    }

endif;

if(!function_exists('clx_get_event_recurrence_meta')) :

    function clx_get_event_recurrence_meta($post_id) {
        $event_meta_obj = array();

        $prefix = Haze_Meta_Boxes::get_instance()->prefix;

        $event_meta_obj['recurrence_days'] = rwmb_meta("{$prefix}recurrence_days", array(), $post_id);
        $event_meta_obj['event_start_date_recurrence'] = rwmb_meta("{$prefix}event_start_date_recurrence", array(), $post_id);
        $event_meta_obj['event_end_date_recurrence'] = rwmb_meta("{$prefix}event_end_date_recurrence", array(), $post_id);
        $event_meta_obj['event_recurrence_type'] = rwmb_meta("{$prefix}event_recurrence_type", array(), $post_id);
        $event_meta_obj['recurrence_every'] = rwmb_meta("{$prefix}recurrence_every", array(), $post_id);
        $event_meta_obj['recurrence_weekly_days'] = rwmb_meta("{$prefix}recurrence_weekly_days", array('type' => 'checkbox_list'), $post_id);
        $event_meta_obj['recurrence_monthly_days_number'] = rwmb_meta("{$prefix}recurrence_monthly_days_number", array(), $post_id);
        $event_meta_obj['recurrence_monthly_days'] = rwmb_meta("{$prefix}recurrence_monthly_days", array(), $post_id);


        return $event_meta_obj;
    }

endif;

if(!function_exists('clx_get_event_meta')) :

    function clx_get_event_meta($post_id) {
        $event_meta_obj = array();

        $prefix = Haze_Meta_Boxes::get_instance()->prefix;

        $event_meta_obj['event_all_day'] = rwmb_meta("{$prefix}event_all_day", array(), $post_id);
        $event_meta_obj['event_start_date'] = rwmb_meta("{$prefix}event_start_date", array(), $post_id);
        $event_meta_obj['event_end_date'] = rwmb_meta("{$prefix}event_end_date", array(), $post_id);
        $event_meta_obj['event_start_hour'] = rwmb_meta("{$prefix}event_start_hour", array(), $post_id);
        $event_meta_obj['event_start_minute'] = rwmb_meta("{$prefix}event_start_minute", array(), $post_id);
        $event_meta_obj['event_start_am_pm'] = rwmb_meta("{$prefix}event_start_am_pm", array(), $post_id);
        $event_meta_obj['event_end_hour'] = rwmb_meta("{$prefix}event_end_hour", array(), $post_id);
        $event_meta_obj['event_end_minute'] = rwmb_meta("{$prefix}event_end_minute", array(), $post_id);
        $event_meta_obj['event_end_am_pm'] = rwmb_meta("{$prefix}event_end_am_pm", array(), $post_id);
        $event_meta_obj['event_venue_name'] = rwmb_meta("{$prefix}event_venue_name", array(), $post_id);
        $event_meta_obj['event_city'] = rwmb_meta("{$prefix}event_city", array(), $post_id);
        $event_meta_obj['event_country'] = rwmb_meta("{$prefix}event_country", array(), $post_id);
        $event_meta_obj['event_address'] = rwmb_meta("{$prefix}event_address", array(), $post_id);
        $event_meta_obj['event_show_map'] = rwmb_meta("{$prefix}event_show_map", array(), $post_id);
        $event_meta_obj['event_enable_tickets'] = rwmb_meta("{$prefix}event_enable_tickets", array(), $post_id);
        $event_meta_obj['event_tickets_type'] = rwmb_meta("{$prefix}event_tickets_type", array(), $post_id);
        $event_meta_obj['event_price_currency'] = rwmb_meta("{$prefix}event_price_currency", array(), $post_id);
        $event_meta_obj['event_price'] = rwmb_meta("{$prefix}event_price", array(), $post_id);
        $event_meta_obj['event_buy_title_1'] = rwmb_meta("{$prefix}event_buy_title_1", array(), $post_id);
        $event_meta_obj['event_buy_url_1'] = rwmb_meta("{$prefix}event_buy_url_1", array(), $post_id);
        $event_meta_obj['event_buy_title_2'] = rwmb_meta("{$prefix}event_buy_title_2", array(), $post_id);
        $event_meta_obj['event_buy_url_2'] = rwmb_meta("{$prefix}event_buy_url_2", array(), $post_id);
        $event_meta_obj['event_template'] = rwmb_meta("{$prefix}event_template", array(), $post_id);


        return $event_meta_obj;
    }

endif;

if(!function_exists('clx_update_event_meta')) :

    function clx_update_event_meta($post_id, $event_meta_obj) {

        $prefix = Haze_Meta_Boxes::get_instance()->prefix;

        foreach($event_meta_obj as $key => $info) {
            update_post_meta($post_id, "{$prefix}{$key}", $info);
        }

    }

endif;

if(!function_exists('clx_recurring_events_notice')):

    function clx_recurring_events_notice() {

        global $current_screen;

        if($current_screen->post_type == EventRecurringPostType::get_instance()->postType && $current_screen->base == 'edit'):
        ?>
        <div class="updated">
            <p><?php _e( 'Modifications to these events will cause all recurrences of each event to be deleted and recreated!', LANGUAGE_ZONE   ); ?></p>
        </div>
        <?php
        endif;

        if($current_screen->post_type == EventRecurringPostType::get_instance()->postType && $current_screen->base == 'post'):
            ?>
            <div class="updated">
                <p><?php _e( '<strong>WARNING: This is a recurring event.</strong><br>
Modifications to this event will cause all recurrences of this event to be deleted and recreated and previous bookings will be deleted! ', LANGUAGE_ZONE   ); ?></p>
            </div>
        <?php
        endif;

        if($current_screen->post_type == EventPostType::get_instance()->postType && $current_screen->base == 'post'):
            ?>
            <div class="updated">
                <p><?php _e( '<strong>WARNING: If this is a recurrence in a set of recurring events and you update this event data and save, it could get overwritten if you edit the recurring event template. </strong>', LANGUAGE_ZONE   ); ?></p>
            </div>
        <?php
        endif;

    }
    add_action( 'admin_notices', 'clx_recurring_events_notice' );

endif;

if(!function_exists('clx_buy_tickets_button')):

    function clx_buy_tickets_button($event_id) {

        $Event = clx_get_event_meta($event_id);

        ?>

        <?php if($Event['event_enable_tickets']): ?>

            <?php

            switch($Event['event_tickets_type']) {
                case 'selling':
                    ?>
                    <div class="dropdown">
                        <a data-toggle="dropdown" href="#">
                            <?php _e('buy tickets', LANGUAGE_ZONE) ?>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <?php if($Event['event_buy_title_1'] != ''): ?>
                            <li>
                                <a href="<?php echo $Event['event_buy_url_1']; ?>">
                                    <?php echo $Event['event_buy_title_1']; ?>
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if($Event['event_buy_title_2'] != ''): ?>
                                <li>
                                    <a href="<?php echo $Event['event_buy_url_2']; ?>">
                                        <?php echo $Event['event_buy_title_2']; ?>
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php
                    break;

                case 'free':
                    ?>
                    <div class="dropdown disable">
                        <a data-toggle="dropdown" href="#">
                            <?php _e('free entry', LANGUAGE_ZONE); ?>
                            <i class="fa fa-angle-down"></i>
                        </a>
                    </div>
                    <?php
                    break;

                case 'cancelled':
                    ?>
                    <div class="dropdown disable">
                        <a data-toggle="dropdown" href="#">
                            <?php _e('cancelled', LANGUAGE_ZONE); ?>
                            <i class="fa fa-angle-down"></i>
                        </a>
                    </div>
                    <?php
                    break;

                case 'soldout':
                    ?>
                    <div class="dropdown disable">
                        <a data-toggle="dropdown" href="#">
                            <?php _e('sold out', LANGUAGE_ZONE); ?>
                            <i class="fa fa-angle-down"></i>
                        </a>
                    </div>
                    <?php
                    break;
            }

            ?>

        <?php endif; ?>

        <?php

    }

endif;

if( !function_exists('clx_get_google_maps') ) :

    function clx_get_google_maps($address, $visible = true) {

        $coordinates = clx_get_coordinates($address);

        $pointer = get_template_directory_uri() . '/assets/img/contact/map-marker.png';

        if($visible) {
            $output = '<div id="map-canvas" style="height: 240px;" data-lat="'.$coordinates['lat'].'" data-long="'.$coordinates['lng'].'" data-pointer="'.$pointer.'"></div>';

            return $output;
        } else {return '';}

    }

endif;

if( !function_exists('clx_get_coordinates') ) :

    /**
     * @param $address
     * @param bool $force_refresh
     * @return array|mixed|string|void
     */
    function clx_get_coordinates($address, $force_refresh = false) {
        $address_hash = md5( $address );

        $coordinates = get_transient( $address_hash );

        if ($force_refresh || $coordinates === false) {

            $args       = array( 'address' => urlencode( $address ), 'sensor' => 'false' );
            $url        = add_query_arg( $args, 'http://maps.googleapis.com/maps/api/geocode/json' );
            $response   = wp_remote_get( $url );

            if( is_wp_error( $response ) )
                return;

            $data = wp_remote_retrieve_body( $response );

            if( is_wp_error( $data ) )
                return;

            if ( $response['response']['code'] == 200 ) {

                $data = json_decode( $data );

                if ( $data->status === 'OK' ) {

                    $coordinates = $data->results[0]->geometry->location;

                    $cache_value['lat']   = $coordinates->lat;
                    $cache_value['lng']   = $coordinates->lng;
                    $cache_value['address'] = (string) $data->results[0]->formatted_address;

                    // cache coordinates for 3 months
                    set_transient($address_hash, $cache_value, 3600*24*30*3);
                    $data = $cache_value;

                } elseif ( $data->status === 'ZERO_RESULTS' ) {
                    return __( 'No location found for the entered address.', 'pw-maps' );
                } elseif( $data->status === 'INVALID_REQUEST' ) {
                    return __( 'Invalid request. Did you enter an address?', 'pw-maps' );
                } else {
                    return __( 'Something went wrong while retrieving your map, please ensure you have entered the short code correctly.', 'pw-maps' );
                }

            } else {
                return __( 'Unable to contact Google API service.', 'pw-maps' );
            }

        } else {
            // return cached results
            $data = $coordinates;
        }

        return $data;
    }

endif;

if(!function_exists('clx_get_events_ordered_ids')) :

    /**
     * @modified by Vlad
     * @date 28-8-2014
     * @reason Events with same date don't show up
     */
    function clx_get_events_ordered_ids($past_events_visible = false) {
        $ids = array();
        $next = array();
        $old = array();

        // We have to make two queries. One for the upcoming events, ordered ASC and one for the older events ordered DESC.
        // Save all ids on the array, and return it for the final query.
        $now = strtotime('now');

        $args = array(
            'post_type'         => EventPostType::get_instance()->postType,
            'post_status'       => 'publish',
            'posts_per_page'    => 9999,
        );

        $query = new WP_Query($args);

        /*if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post();

                $Event = clx_get_event_meta(get_the_ID());
                $date = strtotime($Event['event_start_date'] . ' ' . $Event['event_start_hour'].':'.$Event['event_start_minute'] .' '. $Event['event_start_am_pm'] );

                if($date >= $now) {
                    $next[$date] = get_the_ID();
                } else {
                    $old[$date] = get_the_ID();
                }

            endwhile;
        endif;
        wp_reset_postdata();

        ksort($next);
        krsort($old);

        if(!$past_events_visible) {
            $ids = $next;
        } else {
            $ids = array_merge($next, $old);
        }*/

        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post();

                $Event = clx_get_event_meta(get_the_ID());
                $date = strtotime($Event['event_start_date'] . ' ' . $Event['event_start_hour'].':'.$Event['event_start_minute'] .' '. $Event['event_start_am_pm'] );
                $date_final = strtotime($Event['event_end_date'] . ' ' . $Event['event_end_hour'].':'.$Event['event_end_minute'] .' '. $Event['event_end_am_pm'] );

                if($date >= $now || $date_final >= $now) {
                    $nid = get_the_ID();
                    $next[$nid] = $date;
                } else {
                    $nid = get_the_ID();
                    $old[$nid] = $date;
                }

            endwhile;
        endif;
        wp_reset_postdata();

        asort($next);
        arsort($old);

        if(!$past_events_visible) {
            foreach($next as $key => $ev){
                $ids[] = $key;
            }
        } else {
            foreach($next as $key => $ev){
                $ids[] = $key;
            }
            foreach($old as $key => $ev){
                $ids[] = $key;
            }
        }

        return $ids;
    }

endif;

if( ! function_exists( 'zen_slider_header' ) ) :

    /**
     * Returns the Revolution slider in a shortcode to the page.
     *
     * @since 1.0.0
     */
    function zen_slider_header() {
    	global $clx_data;
        $prefix = Haze_Meta_Boxes::get_instance()->prefix;

        // Background image to insert in the parallax style
        $slider_slug = rwmb_meta( "{$prefix}rev_slider", array('type' => 'select') );

        if ( $slider_slug != 'none' ) {

            printf( '<div class="revolutionSliderContainer%s">', $clx_data['slider-position'] ? '' : ' rev-slider-padding' );
            echo do_shortcode('[rev_slider '.$slider_slug.']');
            echo '</div>';

        }

    }

endif;

if(!function_exists('clx_big_player')) :

    function clx_big_player($songs, $autoplay = false) {

        $output = '';

        $output .= '<div class="base-player combine-player"><div class="col-sm-12"><div class="content-base-player"><div class="buttons clearfix"><div class="navigation"><a class="next"><i class="fa fa-step-forward"></i></a><a class="prev"><i class="fa fa-step-backward"></i></a></div><a class="play-pause play"><i class="fa"></i></a></div>';
        $output .= '<div class="sound-informations"><figure><figcaption><a href="#">';
        $output .= '<img class="feat-img" src="" alt="">';
        $output .= '</a>';
        $output .= '</figcaption>';
        $output .= '<span class="author"></span>';
        $output .= '<span class="song-name"></span>';
        $output .= '</figure></div><div class="sound-bar-container"><div class="sound-bar-content"><span class="progress-sound" style="width: 0%;"></span>';
        $output .= '<div class="content"><time></time><div class="additional-buttons">';
        $output .= '';
        $output .= '</div></div></div></div><div class="playlist"><div class="button-playlist collapsed" data-toggle="collapse" href=".playlist-container"><span class="first"></span><span class="middle"></span><span class="last"></span></div>';
        $output .= '<div class="playlist-container collapse"><div class="playlist-content">';
        $output .= clx_big_song_player($songs, $autoplay);
        $output .= '</div></div></div></div></div></div>';

        return $output;

    }

endif;

if(!function_exists('clx_header_big_player')) :

    function clx_header_big_player() {
        $prefix = Haze_Meta_Boxes::get_instance()->prefix;

        $songs = rwmb_meta("{$prefix}big_player", array('type'=>'checkbox_list'), get_the_ID());
        $autoplay = rwmb_meta("{$prefix}auto_play_player", array('type'=>'checkbox'), get_the_ID());

        echo '<section class="container"><div class="row"><div class="col-sm-12"><div class="row">';
        echo clx_big_player($songs, $autoplay);
        echo '</div></div></div></section>';

    }

endif;

if(!function_exists('clx_header_title')) :

    function clx_header_title() {
        $prefix = Haze_Meta_Boxes::get_instance()->prefix;

        $title = rwmb_meta("{$prefix}text_title", array(), get_the_ID());

        ?>
        <section class="full-title">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 style="text-transform: uppercase;font-size: 28px;font-weight: 400;color: #e7e7e7;text-align: center;"><?= $title; ?></h3>
                    </div>
                </div>
            </div>
        </section>
        <?php

    }

endif;

if(!function_exists('clx_header_featured')) :

    function clx_header_featured() {
        $prefix = Haze_Meta_Boxes::get_instance()->prefix;

        $post_type = rwmb_meta("{$prefix}featured_widget_post_type", array('type'=>'select'), get_the_ID());
        $order_by = rwmb_meta("{$prefix}featured_widget_order_by", array('type'=>'select'), get_the_ID());
        $order = rwmb_meta("{$prefix}featured_widget_order", array('type'=>'select'), get_the_ID());
        $per_page = rwmb_meta("{$prefix}featured_widget_items", array(), get_the_ID());

        if($post_type == EventPostType::get_instance()->postType) {

            $ids = clx_get_events_ordered_ids(rwmb_meta("{$prefix}hide_past_events"));
            $args = array(
                'post_type' => $post_type,
                'posts_per_page' => $per_page,
                'post_status'       => 'publish',
                'post__in'          => $ids,
                'orderby'           => 'post__in'
            );

            $query = new WP_Query($args);

        } else {

            $args = array(
                'post_type' => $post_type,
                'posts_per_page' => $per_page,
                'orderby'   => $order_by,
                'order' => $order
            );

            $query = new WP_Query($args);

        }
        ?>

        <section class="top-events-albums">
        <nav class="events-albums collapse in">
        <ul class="clearfix owl-events-albums">

        <?php if ( $query->have_posts() ) : ?>

            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <li>
                    <figure>
                        <div class="main-content">
                            <h3>
                                <?php the_title(); ?>
                            </h3>
                            <hr>
                            <p>
                                <?php the_excerpt(); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>">
                                <?php _e('more info', LANGUAGE_ZONE); ?>
                            </a>
                        </div>
                        <figcaption>

                            <?php //switch($post_type) {
                                    switch('caca') {

                                case AlbumPostType::get_instance()->postType: ?>
                                <div class="specification">
                                    <div class="row-widget">
                                        <div class="type">
                                            <?php _e('Album', LANGUAGE_ZONE); ?>
                                        </div>
                                    </div>
                                    <div class="row-widget">
                                        <div class="title-author">
                                            <h4>
                                                <?php the_title(); ?>
                                            </h4>
                                            <h5>
                                                <?= rwmb_meta("{$prefix}album_artist_name"); ?>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <?php break;

                                case EventPostType::get_instance()->postType: ?>
                                <div class="specification">
                                    <div class="row-widget">
                                        <div class="type">
                                            <?php _e('Event', LANGUAGE_ZONE); ?>
                                        </div>
                                    </div>
                                    <div class="row-widget">
                                        <div class="title-author">
                                            <h4>
                                                <?php the_title(); ?>
                                            </h4>
                                            <h5>
                                                <?= rwmb_meta("{$prefix}event_start_date", array(), get_the_ID()); ?>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <?php break;

                                case ArtistPostType::get_instance()->postType: ?>
                                <div class="specification">
                                    <div class="row-widget">
                                        <div class="type">
                                            <?php the_title(); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php break;
                            } ?>

                            <?php if ( has_post_thumbnail() ) : ?>

                                <?php the_post_thumbnail('blog_image_1'); ?>

                            <?php endif; ?>
                        </figcaption>
                    </figure>
                </li>

            <?php endwhile; ?>

        <?php else : ?>

            <?php
            /* Get the none-content template (error) */
            get_template_part( 'content', 'none' );
            ?>

        <?php endif; ?>
        <?php
        wp_reset_postdata(); ?>

        </ul>
        </nav>
        <div class="hide-top-events-albums" data-toggle="collapse" href=".events-albums"><i class="fa"></i></div>
        </section>

        <?php
    }

endif;

if( ! function_exists( 'haze_translateColumnWidthToSpan' ) ) :

    function haze_translateColumnWidthToSpan($width, $front = true) {
        preg_match( '/(\d+)\/(\d+)/', $width, $matches );
        $w = $width;
        if ( ! empty( $matches ) ) {
            $part_x = (int) $matches[1];
            $part_y = (int) $matches[2];
            if ( $part_x > 0 && $part_y > 0 ) {
                $value = ceil( $part_x / $part_y * 12 );
                if ( $value > 0 && $value <= 12 ) {
                    $w = 'col-sm-' . $value;
                }
            }
        }

        return $w;
    }

endif;
