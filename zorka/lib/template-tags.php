<?php
/**
 * Custom template tags for zorka
 *
 * @package WordPress
 * @subpackage zorka
 * @since zorka 1.0
 */

if (!function_exists('zorka_post_thumbnail')) :
    function zorka_post_thumbnail($size){
        $html = '';
        switch(get_post_format()) {
            case 'image':
                $args = array(
                    'size'     => $size,
                    'format'   => 'src',
                    'meta_key' => 'post-format-image'
                );
                $image = zorka_get_image($args);
                if (!$image) break;
                $html = zorka_get_image_hover($image,get_permalink(),the_title_attribute( 'echo=0' ),$size);
                break;
            case 'gallery':
                $images = get_post_meta(get_the_ID(),'post-format-gallery');
                if (count($images) > 0) {
                    $data_plugin_options = "data-plugin-options='{\"singleItem\" : true, \"pagination\" : false, \"navigation\" : true, \"autoHeight\" : true}'";
                    $html ="<div class='owl-carousel' $data_plugin_options>";
                    foreach ( $images as $image ) {
                        $src = wp_get_attachment_image_src( $image, $size );
                        $image = $src[0];
                        $html .= zorka_get_image_hover($image,get_permalink(),the_title_attribute( 'echo=0' ),$size);
                    }
                    $html .= '</div>';
                } else {
                    $args = array(
                        'size'     => $size,
                        'format'   => 'src',
                        'meta_key' => ''
                    );
                    $image = zorka_get_image($args);
                    if (!$image) break;
                    $html = zorka_get_image_hover($image,get_permalink(),the_title_attribute( 'echo=0' ),$size);
                }
                break;
            case 'video':
                $video = get_post_meta(get_the_ID(),'post-format-video');
                if (count($video) > 0){
                    $html.= '<div class="embed-responsive embed-responsive-16by9 embed-responsive-'.$size.'">';
                    $video = $video[0];
                    // If URL: show oEmbed HTML
                    if ( filter_var( $video, FILTER_VALIDATE_URL ) ) {
                        $args = array(
                            'wmode' => 'transparent'
                        );
                        $html .= wp_oembed_get( $video,$args);
                    } // If embed code: just display
                    else {
                        $html .= $video;
                    }
                    $html.= '</div>';
                }
                break;
            case 'audio':
                $audio = get_post_meta( get_the_ID(),'post-format-audio');
                if (count($audio) > 0) {
                    $audio = $audio[0];
                    if ( filter_var( $audio, FILTER_VALIDATE_URL ) ) {
                        $html .= wp_oembed_get( $audio);
                        $title = esc_attr(get_the_title());
                        $audio = esc_url($audio);
                        if (empty($html)) {
                            $id = uniqid();
                            $html .= "<div data-player='$id' class='jp-jplayer' data-audio='$audio' data-title='$title'></div>";
                            $html .= zorka_jplayer( $id,$audio );
                        }
                    }
                    else{
                        $html .= $audio;
                    }
                    $html.= '<div style="clear:both;"></div>';
                }
                break;
            default:
                $args = array(
                    'size'     => $size,
                    'format'   => 'src',
                    'meta_key' => ''
                );
                $image = zorka_get_image($args);
                if (!$image) break;
                $html = zorka_get_image_hover($image,get_permalink(),the_title_attribute( 'echo=0' ),$size);
                break;
        }

        return $html;
    }
endif;

if (!function_exists('zorka_get_image_hover')) :
    function zorka_get_image_hover($image,$url,$title,$size) {
        global $_wp_additional_image_sizes;

        $width = '';
        $height = '';
        if (isset($size) && isset($_wp_additional_image_sizes[$size])) {
            $width = 'width="'. $_wp_additional_image_sizes[$size]['width'].'"';
            $height = 'height="'. $_wp_additional_image_sizes[$size]['height'] .'"';
        }



        if (is_single()) {
            return sprintf('<div class="entry-thumbnail">
                                <img %3$s %4$s src="%2$s" alt="%1$s" class="img-responsive">
                            </div>',
                $title,
                $image,
                $width,
                $height);
        } else {
            return sprintf('<div class="entry-thumbnail">
                        <a href="%1$s" title="%2$s">
                            <img %4$s %5$s class="img-responsive" src="%3$s" alt="%2$s"/>
                        </a>
                      </div>',
                $url,
                $title,
                $image,
                $width,
                $height
            );
        }



    }
endif;

if (!function_exists('zorka_get_image')) :
    function zorka_get_image($args = array()) {
        $default = apply_filters(
            'zorka_get_image_default_args',
            array(
                'post_id'  => get_the_ID(),
                'size'     => 'thumbnail',
                'format'   => 'html', // html or src
                'attr'     => '',
                'meta_key' => '',
                'scan'     => false,
                'default'  => ''
            )
        );

        $args = wp_parse_args( $args, $default );
        if ( ! $args['post_id'] ) {
            $args['post_id'] = get_the_ID();
        }

        // Get image from cache
        $key         = md5( serialize( $args ) );
        $image_cache = wp_cache_get( $args['post_id'], 'zorka_get_image' );



        if ( ! is_array( $image_cache ) ) {
            $image_cache = array();
        }

        if ( empty( $image_cache[$key] ) ) {
            // Get post thumbnail
            if (has_post_thumbnail($args['post_id'])) {
                $id   = get_post_thumbnail_id();
                $html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
                list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false, $args['attr'] );
            }

            // Get the first image in the custom field
            if (!isset($html,$src) && $args['meta_key']) {
                $id = get_post_meta( $args['post_id'], $args['meta_key'], true );
                if ( $id ) {
                    $html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
                    list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false, $args['attr'] );
                }
            }

            // Get the first attached image
            /*if (!isset($html,$src)) {
                $image_ids = array_keys( get_children( array(
                    'post_parent'    => $args['post_id'],
                    'post_type'      => 'attachment',
                    'post_mime_type' => 'image',
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                ) ) );
                if (!empty($image_ids)) {
                    $id   = $image_ids[0];
                    $html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
                    list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false, $args['attr'] );
                }
            }*/

            // Get the first image in the post content
            if (!isset($html,$src) && ($args['scan'])) {
                preg_match( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_post_field( 'post_content', $args['post_id'] ), $matches );
                if ( ! empty( $matches ) ){
                    $html = $matches[0];
                    $src  = $matches[1];
                }
            }

            // Use default when nothing found
            if ( ! isset( $html, $src ) && ! empty( $args['default'] ) ){
                if ( is_array( $args['default'] ) ){
                    $html = @$args['html'];
                    $src  = @$args['src'];
                } else {
                    $html = $src = $args['default'];
                }
            }

            if ( ! isset( $html, $src ) ) {
                return false;
            }

            $output = 'html' === strtolower( $args['format'] ) ? $html : $src;
            $image_cache[$key] = $output;
            wp_cache_set( $args['post_id'], $image_cache, 'zorka_get_image' );
        }
        else {
            $output = $image_cache[$key];
        }
        $output = apply_filters( 'zorka_get_image', $output, $args );
        return $output;
    }
endif;


if (!function_exists('zorka_jplayer')) :
    function zorka_jplayer( $id = 'jp_container_1' ) {
        ob_start();
        ?>
        <div id="<?php echo esc_attr($id); ?>" class="jp-audio">
            <div class="jp-type-playlist">
                <div class="jp-gui jp-interface">
                    <ul class="jp-controls jp-play-pause">
                        <li><a href="javascript:;" class="jp-play" tabindex="1"><i class="fa fa-play"></i> <?php esc_html_e('play', 'zorka' ); ?></a></li>
                        <li><a href="javascript:;" class="jp-pause" tabindex="1"><i class="fa fa-pause"></i> <?php esc_html_e('pause', 'zorka' ); ?></a></li>
                    </ul>

                    <div class="jp-progress">
                        <div class="jp-seek-bar">
                            <div class="jp-play-bar"></div>
                        </div>
                    </div>

                    <ul class="jp-controls jp-volume">
                        <li>
                            <a href="javascript:;" class="jp-mute" tabindex="1" title="mute"><i class="fa  fa-volume-up"></i> <?php esc_html_e('mute', 'zorka' ); ?></a>
                        </li>
                        <li>
                            <a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute"><i class="fa fa-volume-off"></i><?php esc_html_e('unmute', 'zorka' ); ?></a>
                        </li>
                        <li>
                            <div class="jp-volume-bar">
                                <div class="jp-volume-bar-value"></div>
                            </div>
                        </li>

                    </ul>

                    <div class="jp-time-holder">
                        <div class="jp-current-time"></div>
                        <div class="jp-duration"></div>
                    </div>
                    <ul class="jp-toggles">
                        <li>
                            <a href="javascript:;" class="jp-shuffle" tabindex="1" title="shuffle"><?php esc_html_e('shuffle', 'zorka' ); ?></a>
                        </li>
                        <li>
                            <a href="javascript:;" class="jp-shuffle-off" tabindex="1" title="shuffle off"><?php esc_html_e('shuffle off', 'zorka' ); ?></a>
                        </li>
                        <li>
                            <a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat"><?php esc_html_e('repeat', 'zorka' ); ?></a>
                        </li>
                        <li>
                            <a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off"><?php esc_html_e('repeat off', 'zorka' ); ?></a>
                        </li>
                    </ul>
                </div>


                <div class="jp-no-solution">
                    <?php printf( esc_html__('<span>Update Required</span> To play the media you will need to either update your browser to a recent version or update your <a href="%s" target="_blank">Flash plugin</a>.', 'zorka' ), 'http://get.adobe.com/flashplayer/' ); ?>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
endif;


if ( ! function_exists( 'zorka_render_comments' ) ) {
    function zorka_render_comments( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment; ?>

        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">

            <?php echo get_avatar($comment, $args['avatar_size']); ?>

            <div class="comment-text">
                <div class="text"><?php comment_text() ?></div>
                <div class="author">
                    <div class="author-name"><?php printf( esc_html__('%s', 'zorka'), get_comment_author_link() ) ?></div>
                    <div class="comment-meta">
                        <span class="comment-meta-date">
                            <i class="pe-7s-clock"></i> <?php echo  get_comment_date(get_option('date_format'));?>
                        </span>
                        <?php edit_comment_link( esc_html__('Edit', 'zorka'),'<span class="comment-meta-edit"><i class="pe-7s-hammer"></i>','</span>' ) ?>
                        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                    </div>
                </div>
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><?php esc_html_e('Your comment is awaiting moderation.', 'zorka' ) ?></em>
               <?php endif; ?>
            </div>
        </div>
    <?php
    }
}




if (!function_exists('zorka_comment_form')) :
    function zorka_comment_form() {
        $commenter = wp_get_current_commenter();
        $req      = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';;

        $fields   =  array(

            'author' => '<div>'.
                '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"  placeholder="'.__('Your Name*','zorka').'" '. $aria_req.'>' .
                '</div>',

            'email' => '<div>'.
                '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '"  placeholder="'.__('Your Email*','zorka') . '" '. $aria_req .'>' .
                '</div>'
        );

        $comment_form_args = array(
            'fields'               => $fields,
            'comment_field' => '<div>'.
                '<textarea rows="6" id="comment" name="comment"  value="' . esc_attr( $commenter['comment_author_url'] ) . '"  placeholder="'.__('Your Comment','zorka') .'"  aria-required="true"></textarea>' .
              '</div>',


            'comment_notes_before' => '<p class="comment-notes">' .
                esc_html__('Your email address will not be published.', 'zorka') /* . ( $req ? $required_text : '' ) */ .
                '</p>',
            'comment_notes_after'  => '',
            'id_submit'            => 'btnComment',
            'class_submit'          => 'zorka-button style1 button-md',
            'title_reply'          => esc_html__('Leave a Comment','zorka' ),
            'title_reply_to'       => esc_html__('Leave a Comment to %s','zorka' ),
            'cancel_reply_link'    => esc_html__('Cancel reply','zorka'),
            'label_submit'         => esc_html__('Add Comment','zorka')
        );
        comment_form($comment_form_args);
    }
endif;


if (!function_exists('zorka_paging_load_more')) :
    function zorka_paging_load_more() {
        global $wp_query;
        // Don't print empty markup if there's only one page.
        if ( $wp_query->max_num_pages < 2 ) {
            return;
        }
        $link = get_next_posts_page_link($wp_query->max_num_pages);
        if (!empty($link)) :
            ?>
            <div class="blog-load-more-wrapper">
                <button data-href="<?php echo esc_url($link); ?>" type="button"  data-loading-text="<i class='fa fa-refresh fa-spin'></i> <?php esc_html_e("Loading...",'zorka'); ?>" class="blog-load-more zorka-button button-sm style1" autocomplete="off">
                    <?php esc_html_e("Load More",'zorka'); ?>
                </button>
            </div>
        <?php
        endif;
    }
endif;


if (!function_exists('zorka_post_date')) :
    function zorka_post_date(){
        ?>
        <div class="entry-date">
            <div class="day">
                <?php echo get_the_time('d'); ?>
            </div>
            <div class="month">
                <?php echo get_the_date('M'); ?>
            </div>
        </div>
    <?php
    }
endif;


if (!function_exists('zorka_post_meta')) :
    function zorka_post_meta() {
        ?>
        <span class="entry-meta-author">
                <i class="pe-7s-users"></i> <?php printf('<a href="%1$s">%2$s</a>',esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),esc_html( get_the_author() )); ?>
        </span>
        <span class="entry-meta-date">
            <i class="pe-7s-clock"></i> <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"> <?php echo  get_the_date(get_option('date_format'));?> </a>
        </span>

        <?php if (has_category()):?>
            <span class="entry-meta-category">
                <i class="pe-7s-ribbon"></i> <?php echo get_the_category_list( ', ' ); ?>
            </span>
        <?php endif; ?>

        <?php if ( comments_open() || get_comments_number() ) : ?>
        <span class="entry-meta-comment">
            <?php comments_popup_link( wp_kses_post(__('<i class="pe-7s-comment"></i> 0 Comment','zorka')) , wp_kses_post(__('<i class="pe-7s-comment"></i> 1 Comment','zorka')), wp_kses_post(__('<i class="pe-7s-comment"></i> % Comments','zorka'))); ?>
        </span>
        <?php endif; ?>

        <?php edit_post_link( wp_kses_post(__('<i class="pe-7s-hammer"></i> Edit', 'zorka' )), '<span class="edit-link">', '</span>' ); ?>
    <?php
    }
endif;


if ( ! function_exists( 'zorka_paging_nav' ) ) :
    function zorka_paging_nav() {
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
        $page_links = paginate_links( array(
            'base'     => $pagenum_link,
            'format'   => $format,
            'total'    => $wp_query->max_num_pages,
            'current'  => $paged,
            'mid_size' => 1,
            'add_args' => array_map( 'urlencode', $query_args ),
            'prev_text' => '<i class="fa fa-angle-double-left"></i>',
            'next_text' => '<i class="fa fa-angle-double-right"></i>',
            'type' => 'array'
        ) );

        if (count($page_links) == 0) return;





        $links = "<ul class='pagination'>\n\t<li>";
        $links .= join("</li>\n\t<li>", $page_links);
        $links .= "</li>\n</ul>\n";
        return $links;
    }
endif;

if (!function_exists('zorka_paging_infinitescroll')):
    function zorka_paging_infinitescroll(){
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
endif;


if (!function_exists('zorka_archive_loop_reset')) :
    function zorka_archive_loop_reset() {
        global $zorka_archive_loop;
        // Reset loop/columns globals when starting a new loop
        $zorka_archive_loop['style'] = $zorka_archive_loop['layout'] = $zorka_archive_loop['image-size'] = $zorka_archive_loop['image-style'] = '';
        $zorka_archive_loop['rows'] = 0;
        $zorka_archive_loop['column'] = 0;
        $zorka_archive_loop['post_count'] = 0;
    }
endif;

if (!function_exists('zorka_the_breadcrumb')) :
    function zorka_the_breadcrumb(){
        get_template_part( 'templates/breadcrumb' );
    }
endif;


if (!function_exists('zorka_post_social')):
    function zorka_post_social(){
        global $zorka_data;
        $sharing_facebook = isset($zorka_data['social-sharing']['sharing-facebook']) ? $zorka_data['social-sharing']['sharing-facebook'] : 0;
        $sharing_twitter = isset($zorka_data['social-sharing']['sharing-twitter']) ? $zorka_data['social-sharing']['sharing-twitter'] : 0;
        $sharing_google = isset($zorka_data['social-sharing']['sharing-google']) ? $zorka_data['social-sharing']['sharing-google'] : 0;
        $sharing_linkedin = isset($zorka_data['social-sharing']['sharing-linkedin']) ? $zorka_data['social-sharing']['sharing-linkedin'] : 0;
        $sharing_tumblr = isset($zorka_data['social-sharing']['sharing-tumblr']) ? $zorka_data['social-sharing']['sharing-tumblr'] : 0;
        $sharing_pinterest = isset($zorka_data['social-sharing']['sharing-pinterest']) ? $zorka_data['social-sharing']['sharing-pinterest'] : 0;
        if (($sharing_facebook == 1) ||
            ($sharing_twitter == 1) ||
            ($sharing_linkedin == 1) ||
            ($sharing_tumblr == 1) ||
            ($sharing_google == 1) ||
            ($sharing_pinterest == 1)
        ) :
            ?>
            <div class="entry-share-wrapper">
            <div class="entry-share">
                <div class="entry-share-inner">
                    <span><?php esc_html_e("Share","zorka"); ?></span>
         <ul>
                <?php if ($sharing_facebook == 1) : ?>
                    <li><a onclick="window.open('https://www.facebook.com/sharer.php?s=100&p[title]=<?php echo esc_attr(urlencode(get_the_title())); ?>&p[url]=<?php echo esc_attr(urlencode(get_permalink()));?>&p[summary]=<?php echo esc_attr(urlencode(get_the_excerpt())); ?>&p[images][0]=<?php $arrImages = wp_get_attachment_image_src(get_post_thumbnail_id(),'full'); echo  has_post_thumbnail() ? esc_attr($arrImages[0]) : '' ;?>','sharer', 'toolbar=0,status=0,width=620,height=280');" href="javascript:;" title="<?php esc_html_e('Share on Facebook','zorka');?>"><i class="fa fa-facebook"></i></a></li>
                <?php endif; ?>
                <?php if ($sharing_twitter == 1) :  ?>
                    <li><a onclick="popUp=window.open('http://twitter.com/home?status=<?php echo esc_attr(urlencode(get_the_title())); ?> <?php echo esc_attr(urlencode(get_permalink())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;" title="<?php esc_html_e('Share on Twitter','zorka');?>"><i class="fa fa-twitter"></i></a></li>
                <?php endif; ?>
                <?php if ($sharing_google == 1) :  ?>
                    <li><a onclick="popUp=window.open('https://plus.google.com/share?url=<?php echo esc_attr(urlencode(get_permalink())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;" title="<?php esc_html_e('Share on Google +1','zorka');?>"><i class="fa fa-google-plus"></i></a></li>
                <?php endif; ?>
                <?php if ($sharing_linkedin == 1):?>
                    <li><a onclick="popUp=window.open('http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_attr(urlencode(get_permalink())); ?>&amp;title=<?php echo esc_attr(urlencode(get_the_title())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;" title="<?php esc_html_e('Share on Linkedin','zorka');?>"><i class="fa fa-linkedin"></i></a></li>
                <?php endif; ?>
                <?php if ($sharing_tumblr == 1) :  ?>
                    <li><a onclick="popUp=window.open('http://www.tumblr.com/share/link?url=<?php echo esc_attr(urlencode(get_permalink())); ?>&amp;name=<?php echo esc_attr(urlencode(get_the_title())); ?>&amp;description=<?php echo esc_attr(urlencode(get_the_excerpt())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;" title="<?php esc_html_e('Share on Tumblr','zorka');?>"><i class="fa fa-tumblr"></i></a></li>
                <?php endif; ?>
                <?php if ($sharing_pinterest == 1) :  ?>
                    <li><a onclick="popUp=window.open('http://pinterest.com/pin/create/button/?url=<?php echo esc_attr(urlencode(get_permalink())); ?>&amp;description=<?php echo esc_attr(urlencode(get_the_title())); ?>&amp;media=<?php $arrImages = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo has_post_thumbnail() ? esc_attr($arrImages[0])  : "" ; ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;" title="<?php esc_html_e('Share on Pinterest','zorka');?>"><i class="fa fa-pinterest"></i></a></li>
                <?php endif; ?>
            </ul>
                </div>
            </div>
            </div>
        <?php endif;
    }
endif;


if (!function_exists('zorka_post_nav')) {
    function zorka_post_nav() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
        $next     = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous ) {
            return;
        }
        ?>
        <nav class="post-navigation" role="navigation">
            <div class="nav-links">
                <?php
                previous_post_link( '<div class="nav-previous">%link</div>', _x( '<i class="post-navigation-icon fa fa-caret-left"></i> <div class="post-navigation-content"><div class="post-navigation-label">Previous Post</div> <div class="post-navigation-title">%title </div> </div> ', 'Previous post link', 'zorka' ) );
                next_post_link( '<div class="nav-next">%link</div>', _x( '<i class="post-navigation-icon fa fa-caret-right"></i> <div class="post-navigation-content"><div class="post-navigation-label">Next Post</div> <div class="post-navigation-title">%title</div></div> ', 'Next post link', 'zorka' ) );
                ?>
            </div>
            <!-- .nav-links -->
        </nav><!-- .navigation -->
    <?php
    }
}

if (!function_exists('zorka_get_link_url')) {
    function zorka_get_link_url() {
        $content = get_the_content();
        $has_url = get_url_in_content( $content );

        return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
    }
}





