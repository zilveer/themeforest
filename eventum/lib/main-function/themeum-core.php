<?php 

if(!function_exists('thmtheme_setup')):

    function thmtheme_setup()
    {
        //Textdomain
        load_theme_textdomain( 'eventum', get_stylesheet_directory() . '/languages' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'speaker-thumb', 458, 458, true ); // Speaker Thumb for Speaker single page
        add_image_size( 'blog-full', 1140, 500, true ); // Speaker Thumb for Speaker single page
        add_image_size( 'blog-medium', 750, 400, true ); // Speaker Thumb for Speaker single page
        add_image_size( 'blog-small', 360, 230, true ); // Speaker Thumb for Speaker single page
        add_image_size( 'x-blog-small', 94, 60, true ); // Speaker Thumb for Speaker single page
        add_theme_support( 'post-formats', array( 'aside','audio','gallery','image','link','quote','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );

        add_editor_style('');

        if ( ! isset( $content_width ) )
        $content_width = 660;
    }

    add_action('after_setup_theme','thmtheme_setup');

endif;


if(!function_exists('themeum_pagination')):

    function themeum_pagination($pages = '', $range = 2)
    {  
         $showitems = ($range * 1)+1;  
         global $paged;
         if(empty($paged)) $paged = 1;
         if($pages == '')
         {
             global $wp_query;
             $pages = $wp_query->max_num_pages;

             if(!$pages)
             {
                 $pages = 1;
             }
         }   
         if(1 != $pages)
         {
            echo "<div class='themeum-pagination'><ul class='pagination'>";
            if($paged > 2 && $paged > $range+1 && $showitems < $pages){
                echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
            }
            if($paged > 1 && $showitems < $pages){ 
                echo '<li>';
                previous_posts_link(esc_html__("Previous",'eventum'));
                echo '</li>';
            }
            for ($i=1; $i <= $pages; $i++)
            {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                {
                    echo ($paged == $i)? "<li class='active'><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
                }
            }
            if ($paged < $pages && $showitems < $pages){
                echo '<li>';
                next_posts_link(esc_html__("Next",'eventum'));
                echo '</li>';
            }
            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
                echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
            }
            echo "</ul></div>";
         }
    }

endif;


/*-------------------------------------------------------
 *              Themeum Comment
 *-------------------------------------------------------*/

if(!function_exists('themeum_comment')):

    function themeum_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
            // Display trackbacks differently than normal comments.
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'eventum' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
                break;
            default :
            
            global $post;
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-body media">
                
                    <div class="comment-avartar pull-left">
                        <?php
                            echo get_avatar( $comment, $args['avatar_size'] );
                        ?>
                    </div>
                    <div class="comment-context media-body">
                        <div class="comment-head">
                            <?php
                                printf( '<span class="comment-author">%1$s</span>',
                                    get_comment_author_link());
                            ?>
                            <span class="comment-date"><?php echo get_comment_date('d / m / Y') ?></span>

                            <?php edit_comment_link( esc_html__( 'Edit', 'eventum' ), '<span class="edit-link">', '</span>' ); ?>
                            <span class="comment-reply">
                                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'eventum' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                            </span>
                        </div>

                        <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'eventum' ); ?></p>
                        <?php endif; ?>

                        <div class="comment-content">
                            <?php comment_text(); ?>
                        </div>
                    </div>
                
            </div>
        <?php
            break;
        endswitch; 
    }

endif;


/*-------------------------------------------------------
*           Themeum Breadcrumb
*-------------------------------------------------------*/
if(!function_exists('themeum_breadcrumbs')):
function themeum_breadcrumbs(){ ?>
    <ol class="breadcrumb">
        <li><i class="fa fa-home"></i></li>
        <li><a href="<?php echo esc_url(site_url()); ?>" class="breadcrumb_home"><?php esc_html_e('Home', 'eventum') ?></a></li>
        <?php
        if(function_exists('is_product')){
             $shop_page_id = get_permalink( get_page_by_path( 'shop' ) );
            if(is_product()){
                if($shop_page_id){
                    echo "<li><a href='".$shop_page_id."'>shop</a></li>";
                }
            }   
        }
        ?>
        <li class="active">
                    <?php
                      if(function_exists('is_shop')){
                        if(is_shop()){
                          echo "shop";
                        }   
                      }
                    ?>
                    <?php if( is_tag() ) { ?>
                    <?php esc_html_e('Posts Tagged ', 'eventum') ?><span class="raquo">/</span><?php single_tag_title(); echo('/'); ?>
                    <?php } elseif (is_day()) { ?>
                    <?php esc_html_e('Posts made in', 'eventum') ?> <?php the_time('F jS, Y'); ?>
                    <?php } elseif (is_month()) { ?>
                    <?php esc_html_e('Posts made in', 'eventum') ?> <?php the_time('F, Y'); ?>
                    <?php } elseif (is_year()) { ?>
                    <?php esc_html_e('Posts made in', 'eventum') ?> <?php the_time('Y'); ?>
                    <?php } elseif (is_search()) { ?>
                    <?php esc_html_e('Search results for', 'eventum') ?> <?php the_search_query() ?>
                    <?php } elseif (is_single()) { ?>
                    <?php $category = get_the_category();
                    if ( $category ) { 
                        $catlink = get_category_link( $category[0]->cat_ID );
                        echo ('<a href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'</a> '.'<span class="raquo"> /</span> ');
                    }
                    echo get_the_title(); ?>
                    <?php } elseif (is_category()) { ?>
                    <?php single_cat_title(); ?>
                    <?php } elseif (is_tax()) { ?>
                    <?php 
                    $themeum_taxonomy_links = array();
                    $themeum_term = get_queried_object();
                    $themeum_term_parent_id = $themeum_term->parent;
                    $themeum_term_taxonomy = $themeum_term->taxonomy;

                    while ( $themeum_term_parent_id ) {
                        $themeum_current_term = get_term( $themeum_term_parent_id, $themeum_term_taxonomy );
                        $themeum_taxonomy_links[] = '<a href="' . esc_url( get_term_link( $themeum_current_term, $themeum_term_taxonomy ) ) . '" title="' . esc_attr( $themeum_current_term->name ) . '">' . esc_html( $themeum_current_term->name ) . '</a>';
                        $themeum_term_parent_id = $themeum_current_term->parent;
                    }

                    if ( !empty( $themeum_taxonomy_links ) ) echo implode( ' <span class="raquo">/</span> ', array_reverse( $themeum_taxonomy_links ) ) . ' <span class="raquo">/</span> ';

                    echo esc_html( $themeum_term->name ); 
                } elseif (is_author()) { 
                    global $wp_query;
                    $curauth = $wp_query->get_queried_object();

                    esc_html_e('Posts by ', 'eventum'); echo ' ',$curauth->nickname; 
                } elseif (is_page()) { 
                    echo get_the_title(); 
                } elseif (is_home()) { 
                    esc_html_e('Blog', 'eventum');
                } ?>  
            </li>
    </ol>

<?php
}
endif;


/*-----------------------------------------------------
 *              Coming Soon Page Settings
 *----------------------------------------------------*/
if (isset($themeum_options['comingsoon-en']) && $themeum_options['comingsoon-en']) {
    if(!function_exists('themeum_my_page_template_redirect')):
        function themeum_my_page_template_redirect()
        {
            if( is_page( ) || is_home() || is_category() || is_single() )
            {
                get_template_part( 'coming','soon');
                exit();
            }
        }
        add_action( 'template_redirect', 'themeum_my_page_template_redirect' );
    endif;

    if(!function_exists('themeum_cooming_soon_wp_title')):
        function themeum_cooming_soon_wp_title(){
            return 'Coming Soon';
        }
        add_filter( 'wp_title', 'themeum_cooming_soon_wp_title' );
    endif;
}



/*-----------------------------------------------------
 *              Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('themeum_the_excerpt_max_charlength')):

    function themeum_the_excerpt_max_charlength($limit) {
          $content = explode(' ', get_the_content(), $limit);
          if(count($content)>=$limit) {
            array_pop($content);
            $content = implode(" ",$content);
          }else{
            $content = implode(" ",$content);
          } 
          $content = preg_replace('/\[.+\]/','', $content);
          $content = apply_filters('the_content', $content); 
          $content = str_replace(']]>', ']]&gt;', $content);
          return $content;
    }

endif;



/*-----------------------------------------------------
 *              Custom Excerpt Length
 *----------------------------------------------------*/

if(!function_exists('themeum_get_video_id')){
    function themeum_get_video_id($url){
        $video = parse_url($url);

        switch($video['host']) {
            case 'youtu.be':
            $id = trim($video['path'],'/');
            $src = 'https://www.youtube.com/embed/' . esc_attr($id);
            break;

            case 'www.youtube.com':
            case 'youtube.com':
            parse_str($video['query'], $query);
            $id = $query['v'];
            $src = 'https://www.youtube.com/embed/' . esc_attr($id);
            break;

            case 'vimeo.com':
            case 'www.vimeo.com':
            $id = esc_attr(trim($video['path'],'/'));
            $src = "http://player.vimeo.com/video/{$id}";
        }

        return $src;
    }
}

if(!function_exists('themeum_hex2rgb')){
    function themeum_hex2rgb($hex) {
       $hex = str_replace("#", "", $hex);

       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       $rgb = array($r, $g, $b);

       return $rgb[0].','.$rgb[1].','.$rgb[2];
    }
}

// /*-------------------------------------------*
//  *               Excerpt Length
//  *------------------------------------------*/

if(!function_exists('new_excerpt_more')):

    if( isset($themeum_options['blog-continue-en']) && $themeum_options['blog-continue-en'] ){

        function new_excerpt_more( $more )
        {
            global $themeum_options;
            $continue = 'Continue Reading';

            if ( isset($themeum_options['blog-continue']) ){
                $continue = esc_html($themeum_options['blog-continue']);
            }
            
            return '&nbsp;<br /><br /><a class="btn btn-style" href="'. get_permalink( get_the_ID() ) . '">'.$continue. '</a>';
        }
        add_filter( 'excerpt_more', 'new_excerpt_more' );

    }

endif;
