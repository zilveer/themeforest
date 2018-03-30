<?php
/**
 * Widgets shortcodes.
 *
 * @package WordPress
 * @subpackage YIW Themes
 */


if ( ! function_exists( 'yiw_sc_call_func' ) ) :
/**
 * CALL TO ACTION
 *
 * @description
 *    Shows a box witth an incipit and a number phone
 *
 * @example
 *   [call title="" incipit="" phone="" [class=""]]
 *
 * @attr
 *   class - class of container of box call to action (optional) @default: 'call-to-action'
 *   href  - url of button
 *   title  - the title of call to action
 *   incipit - the text below title
**/
function yiw_sc_call_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'class' => 'call-to-action',
        'title' => null,
        'incipit' => null,
        'phone' => null
    ), $atts));

    $style = '';
    if( is_null( $incipit ) )
        $style = ' style="margin-top:0;line-height:101px;"';
    else
        $incipit = "<p>$incipit</p>";

    $html = "<div class=\"$class\">
                <div class=\"incipit\">
                    <h2{$style}>$title</h2>
                    $incipit
                </div>
                <div class=\"separate-phone\"></div>
                <div class=\"number-phone\">$phone</div>
                <div class=\"clear\"></div>
                <div class=\"decoration-image\"></div>
            </div>";

    return apply_filters( 'yiw_sc_call_html', $html );
}
endif;
add_shortcode('call', 'yiw_sc_call_func');


if ( ! function_exists( 'yiw_sc_recentpost_func' ) ) :
/**
 * RECENT POST
 *
 * @description
 *    Shows recent posts
 *
 * @example
 *   [recentpost items="" [cat_name=""] [more_text=""] [show_thumb=""] [date=""]]
 *
 * @attr
 *   cat_name - NAME category of last post to show (optional) @deafult: all categories
 *   more_text  - text of more link (optional)  @deafult: null
 *   items - number of items to show @default: 3
**/
function yiw_sc_recentpost_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'cat_name'   => null,
        'more_text'  => null,
        'items' => 3,
        'popular' => false,
        'show_thumb' => 'yes',
        'excerpt' => 10,
        'date' => 'true'
    ), $atts));

    global $icons_name;

    $args = array(
       'posts_per_page' => $items,
       'orderby' => 'date'
    );

    if(!is_null($cat_name)) $args['category_name'] = $cat_name;
    $exclude = maybe_unserialize( yiw_get_option( 'blog_cats_exclude_2' ) );
    if( ! empty( $exclude ) ){
        $cat_params = trim( yiw_get_option( 'blog_cats_exclude_2' ) );
        $cat_params = '-'. str_replace( ',', ',-', $cat_params );
        $args['cat'] = $cat_params;
    }

    if( $popular ) $args['orderby'] = 'comment_count';

    $args['order'] = 'DESC';

    $myposts = new WP_Query( apply_filters( 'yiw_sc_recentpost_query_args', $args ) );

    $html = "\n";
    $html .= '<div class="recent-post group">'."\n";

    add_filter('excerpt_length', create_function('$a',"return $excerpt;") );
    add_filter('excerpt_more', create_function('$a',"return '...';") );

    if( $myposts->have_posts() ) : while( $myposts->have_posts() ) : $myposts->the_post();

        $img = '';
        if(has_post_thumbnail())
        {
            $img = get_the_post_thumbnail( get_the_ID(), 'thumb_recentposts' );
        }
        else
        {
            $img = '<img src="'.get_template_directory_uri().'/images/no_image_recentposts.jpg" alt="No Image" />';
        }

        $html .= '<div class="hentry-post group">'."\n";
        if ( $show_thumb == 'yes' )
            $html .= "    <div class=\"thumb-img\">$img</div>\n";
        $html .= the_title( '<a href="'.get_permalink().'" title="'.get_the_title().'" class="title">', '</a>', false );

        $html .= ( $date == "true" ) ? '<p class="post-date">' . get_the_date() . '</p>' : '<p>' . get_the_excerpt() . ( $more_text ? ' <a href="'.get_permalink().'">' . $more_text . '</a>' : '' ) . '</p>';
        $html .= '</div>'."\n";

    endwhile; endif;

    $html .= '</div>';

    //$myposts->rewind_posts();
    wp_reset_postdata();
    //unset($myposts);

    return apply_filters( 'yiw_sc_recentpost_html', $html );
}
endif;
add_shortcode('recentpost', 'yiw_sc_recentpost_func');


if ( ! function_exists( 'yiw_sc_popularpost_func' ) ) :
/**
 * POPULAR POST
 *
 * @description
 *    Shows popular posts
 *
 * @example
 *   [popularpost items="" [cat_name=""] [more_text=""] [show_thumb=""] [excerpt=""] [date=""]]
 *
 * @attr
 *   cat_name - NAME category of last post to show (optional) @deafult: all categories
 *   more_text  - text of more link (optional)  @deafult: null
 *   items - number of items to show @default: 3
**/
function yiw_sc_popularpost_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'cat_name'   => null,
        'more_text'  => null,
        'items' => null,
        'show_thumb' => 'yes',
        'excerpt' => 10,
        'date' => 'true'
    ), $atts));

    $html = do_shortcode('[recentpost items="' . $items . '" cat_name="' . $cat_name . '" more_text="' . $more_text . '" show_thumb="' . $show_thumb . '" popular="1" excerpt="' . $excerpt . '" date="' . $date . '"]');

    return apply_filters( 'yiw_sc_popularpost_html', $html );
}
endif;
add_shortcode('popularpost', 'yiw_sc_popularpost_func');


if ( ! function_exists( 'yiw_sc_social_func' ) ) :
/**
 * SOCIAL
 *
 * @description
 *    Print a simple icon link for social
 *
 * @example
 *   [social type="" href="" [title=""]]
 *
 * @attr
 *   type - the icon of social @params: facebook|twitter|rss|ecc...
 *   title - a title for the link icon
 *   href - the url of social page
**/
function yiw_sc_social_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "type" => '',
        "title" => null,
        "href" => '#',
        "size" => '',
    ), $atts));

    if( $size != 'small' )
        $size = '';

    if( $size != '' ) $size = '-' . $size;

    if( is_null($title) ) $title = ucfirst($type);

    // toglie gli attributi previsti e lascia i restanti eventuali attributi, per aggiungerli al tag <a>
    unset( $atts['type'], $atts['title'], $atts['href'], $atts['size'] );

    $attrs = '';
    if ( ! empty( $atts ) )
        foreach ( $atts as $a => $v )
            if ( is_int( $a ) )
                $attrs .= " $v";
            else
                $attrs .= " $a=\"$v\"";

    $html = "<a href=\"$href\" class=\"socials{$size} {$type}{$size}\" $attrs title=\"$title\" >$type</a>\n";

    return apply_filters( 'yiw_sc_social_html', $html );
}
endif;
add_shortcode("social", "yiw_sc_social_func");


if ( ! function_exists( 'yiw_sc_twitter_func' ) ) :
/**
 * TWITTER
 *
 * @description
 *    Print a list of last tweets
 *
 * @example
 *   [twitter username="YIW" items="5" consumer_key="" consumer_secret="" access_token="" access_token_secret="" [class="last-tweets-widget"] [time="true"] ]
 *
 * @attr
 *   usarname - the username
 *   items - number of post for list
**/
function yiw_sc_twitter_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "username" => null,
        "items" => 5,
        "class" => 'last-tweets-widget',
        "time" => true,
        'consumer_key' => '',
        'consumer_secret' => '',
        'access_token' => '',
        'access_token_secret' => ''
    ), $atts));

    $access_token = ( $access_token != '' ) ? $access_token : yiw_get_option( 'twitter_access_token' ) ;
    $access_token_secret = ( $access_token_secret != '' ) ? $access_token_secret : yiw_get_option( 'twitter_access_token_secret' ) ;
    $consumer_key = ( $consumer_key != '' ) ? $consumer_key : yiw_get_option( 'twitter_consumer_key' ) ;
    $consumer_secret = ( $consumer_secret != '' ) ? $consumer_secret : yiw_get_option( 'twitter_consumer_secret' ) ;

    $twitter_data = yit_get_tweets( $access_token, $access_token_secret, $consumer_key, $consumer_secret, $items);

    $html = '<div class="last-tweets-widget">';

    $show_time = ( isset($time) && $time == 'yes' ) ? 'true' : 'false';

    if ( !isset($twitter_data->errors) ) :
        $html .= '<ul class="tweets-widget">';
        $i = 1;
        foreach ($twitter_data as $tweet){
            if (!empty($tweet)) {
                $text = $tweet->text;
                $text_in_tooltip = str_replace('"', '', $text); // replace " to avoid conflicts with title="" opening tags
                $id = $tweet->id;
                $time = strftime('%d/%m/%Y %H:%M:%S', strtotime($tweet->created_at));
                $username = $tweet->user->name;
            }
            $html .= '<li class="tweet_' . $i . '"><p><span class="text">' . $text . '</span><br />';
            if ( $show_time == 'true' ) $html .= '<span class="meta">' . $time . '</span>';
            $html .= '</p></li>';

            ?>
            <script type="text/javascript">
                jQuery(function($){
                    var test = twttr.txt.autoLink("<?php echo $text ?>");
                    $('ul li.tweet_<?php echo $i ?> span.text').replaceWith(test);
                });
            </script>
            <?php $i++;
        }
        $html .= '</ul>';
    endif;
    $html .= '</div>';


    return apply_filters( 'yiw_sc_twitter_html', $html );
}
endif;
add_shortcode("twitter", "yiw_sc_twitter_func");


if ( ! function_exists( 'yiw_sc_slider_func' ) ) :
/**
 * SLIDER
 *
 * @description
 *    Show a custom FlexSlider
 *
 * @example
 *   [slider effect="sliceDown" width="600" height="350"]
 *       wp-content/themes/bolder/example/slide/1.jpg
 *       wp-content/themes/bolder/example/slide/2.jpg
 *       wp-content/themes/bolder/example/slide/3.jpg
 *       wp-content/themes/bolder/example/slide/4.jpg
 *       wp-content/themes/bolder/example/slide/5.jpg
 *   [/slider]
 *
 * @attr
 *   effect - the effetc of slider. @param:
        * fade
        * slide
 *   width - the width of slider
 *   height - height of slider
**/
function yiw_sc_slider_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "effect" => 'fade',
        "width" => 640,
        "height" => 480,
        "speed" => 3000,
        "direction" => 'horizontal'
    ), $atts));

    if( substr( $width, -1 ) != '%' ) {
        $width = "width:{$width}px";
    } else {
        $width = "width:{$width}";
    }




    if( $height != 'no' ) {
        if( substr( $height, -1 ) != '%' ) {
            $height = "height:{$height}px";
        } else {
            $height = "height:{$height}";
        }
    } else {
        $height = '';
    }


    $urls = explode("\n", $content);
    $urls = array_map('trim', $urls);

        $html = "<div class=\"flexslider-sc\" style=\"{$width};{$height}\">\n<ul class=\"slides\">";

        $i = 0;
        foreach($urls as $url)
        {
            if( empty( $url ) )
                { continue; }

            $host = $a_before = $a_after = '';

            if( preg_match( '%^(?=[^&])(?:(?<scheme>[^:/?#]+):)?(?://(?<authority>[^/?#]*))?(?<path>[^?#]*)(?:\?(?<query>[^#]*))?(?:#(?<fragment>.*))?%', $url, $matches ) ) {
                if( empty( $matches[1] ) )
                    $url = site_url() . '/' . $matches[3];
                else
                    $url = $matches[0];
            }


            $url = str_replace( '<br />', '', $url );
            $url = str_replace( array( '<p>', '</p>' ), '', $url );

            if($url != '') $html .= "    <li><img src=\"{$host}{$url}\" alt=\"$i\" /></li>\n";
            $i++;
        }

        $html .= "</ul></div>\n";



    $html .= "  <script type=\"text/javascript\">
                    jQuery(document).ready(function($){
                            $.getScript('". get_template_directory_uri() . "/js/jquery.flexslider.min.js', function(){

                                $('.flexslider-sc').flexslider({
                                    animation: '$effect',
                                    directionNav: false,
                    				controlNav: true,
                    				keyboardNav: false,
                                    slideshowSpeed: $speed,
                                    slideDirection: '$direction'
                                });

                            });
                    });
                </script>";

    return apply_filters( 'yiw_sc_slider_html', $html );
}
endif;
add_shortcode("slider", "yiw_sc_slider_func");


if ( ! function_exists( 'yiw_sc_toggle_func' ) ) :
/**
 * TOGGLE
 *
 * @description
 *    Create a toggle content.
 *
 * @example
 *   [toggle title="" opened=""]text[/toggle]
 *
 * @attr
 *   title - the title of toggle content
 *   text - the text
**/
function yiw_sc_toggle_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "title" => null,
        "opened" => false
    ), $atts));

    $content = wpautop( $content );

    $class = 'closed';
    if( $opened )
        $class = 'opened';

    $html = '<div class="toggle">
                <p class="tab-index tab-'.$class.'"><a href="#" title="' . ( $opened ? __( 'Close', 'yiw' ) : __( 'Open', 'yiw' ) ) . '">'.$title.'</a></p>
                <div class="content-tab '.$class.'">
                    '.yiw_addp($content).'
                </div>
            </div>';

    return apply_filters( 'yiw_sc_toggle_html', $html );
}
endif;
add_shortcode("toggle", "yiw_sc_toggle_func");


if ( ! function_exists( 'yiw_sc_tabs_func' ) ) :
/**
 * TABS
 *
 * @description
 *    Create a content with tabs.
 *
 * @example
 *   [tabs {ID}1={TITLE}1 {ID}2={TITLE} ... {ID}n={TITLE}n]
 *       [tab id="{ID}"]Text[/tab]
 *       [tab id="{ID}"]Text[/tab]
 *   [/tabs]
 *
 * @attr
 *   {ID} - the ID of tab
 *   {TITLE} - the title of tab
 *   id - the id of each tab
 *   text - the text
**/
function yiw_sc_tabs_func($atts, $content = null) {

    $html = '<div class="tabs-container">'."\n";
    $html .= '    <ul class="tabs">'."\n";

    $i = 1;
    foreach($atts as $id => $title)
    {
        //if( !preg_match('/tab([0-9]{2})/', $attr) ) continue;

        $html .= '<li><h4><a href="#'.$id.'" title="'.$title.'">'.$title.'</a></h4></li>'."\n";

        $i++;
    }

    $html .= '    </ul>'."\n";

    $html .= '<div class="border-box group">' . do_shortcode($content) . '</div>';

    $html .= '</div>'."\n";

    return apply_filters( 'yiw_sc_tabs_html', $html );
}
endif;
add_shortcode("tabs", "yiw_sc_tabs_func");


if ( ! function_exists( 'yiw_sc_tab_func' ) ) :
/**
 * TAB
 *
 * @description
 *    See above.
 *
 * @example
 *   [tab id=N]Text[/tab]
 *
**/
function yiw_sc_tab_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "id" => null
    ), $atts));

    //$content = wpautop( $content);

    $html = '<div id="'.$id.'" class="panel group">'.do_shortcode( $content ).'</div>';

    //return wpautop(, $html);
    return apply_filters( 'yiw_sc_tab_html', $html );
}
endif;
add_shortcode("tab", "yiw_sc_tab_func");


if ( ! function_exists( 'yiw_sc_quick_contact_func' ) ) :
/**
 * QUICK CONTACT BOX
 *
 * @description
 *    Create a box for quick contact with tab.
 *
 * @example
 *   [quick_contact [class=""] icon1="" icon2=""]
 *       [tab id=1]Text[/tab]
 *       [tab id=2]Text[/tab]
 *   [/quick_contact]
 *
 * @attr
 *   iconN - the icon of each tab
 *   id - the id of each tab
 *   text - the text
**/
function yiw_sc_quick_contact_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => 'quick-contact-box'
    ), $atts));

    $html = '<div class="' . $class . ' group">'."\n";
    $html .= '    <ul class="nav-box">'."\n";

    $i = 1;
    foreach($atts as $attr => $value)
    {
        if( !preg_match('/icon([0-9]{1,2})/', $attr) ) continue;

        $html .= '<li><a href="#icon'.$i.'">' . yiw_get_img( 'images/icons/set_icons/' . $value . '.png', 'Image Tab ' . $i, 'nofade' ) . '</a></li>'."\n";

        $i++;
    }

    $html .= '    </ul>'."\n";

    $html .= '<div class="box-info group">' . $content . '</div>';

    $html .= '</div>'."\n";

    $html = do_shortcode( $html );

    return apply_filters( 'yiw_sc_quick_contact_html', $html );
}
endif;
add_shortcode("quick_contact", "yiw_sc_quick_contact_func");


if ( ! function_exists( 'yiw_sc_faq_func' ) ) :
/**
 * Faqs
 *
 * @description
 *    Show all post on faq post types
 *
 * @example
 *   [faq items=""]
 *
 * @params
 *      items - number of item to show
 *
**/
function yiw_sc_faq_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "category" => null,
        "items" => -1,
        "close_first" => false
    ), $atts));

    $args = array(
        'post_type' => 'bl_faq',
        'posts_per_page' => $items,
    );

    if(!empty( $category )) {
        $tax = 'category-faq';
        $category = array_map( 'trim', explode( ',', $category ) );
        if ( count($category) == 1 ) $category = $category[0];
        $args['tax_query'] = array(
            array(
                'taxonomy' => $tax,
                'field' => 'slug',
                'terms' => $category
            )
        );
    }

    $faqs = new WP_Query( $args );

    $first = TRUE;
    if( $close_first ) $first = FALSE;

    $html = '';
    if( !$faqs->have_posts() ) return $html;

    //loop
    while( $faqs->have_posts() ) : $faqs->the_post();

            $title = the_title( '', '', false );
            $content = get_the_content();

            $attr = '';
            if( $first )
                $attr = ' opened="1"';

            $html .= do_shortcode( "[toggle title=\"$title\"{$attr}]{$content}[/toggle]" );
            $first = FALSE;

    endwhile;

    return apply_filters( 'yiw_sc_faq_html', $html );
}
endif;
add_shortcode("faq", "yiw_sc_faq_func");


if ( ! function_exists( 'yiw_sc_testimonials_func' ) ) :
/**
 * testimonials
 *
 * @description
 *    Show all post on testimonials post types
 *
 * @example
 *   [testimonials items=""]
 *
 * @params
 *      items - number of item to show
 *
**/
function yiw_sc_testimonials_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "items" => null
    ), $atts));

    wp_reset_query();

    $args = array(
        'post_type' => 'bl_testimonials'
    );
    if( !is_null( $items ) ) $args['posts_per_page'] = $items;

    $tests = new WP_Query( $args );

    $html = '';
    if( !$tests->have_posts() ) return $html;

    //loop
    $html = '';
    while( $tests->have_posts() ) : $tests->the_post();

        $title = the_title( '<span class="title">', ',</span>', false );
        $website = get_post_meta( get_the_ID(), '_testimonial_website', true );
        $website = "<a href=\"" . esc_url( $website ) . "\">$website</a>";

        $html .= '<div class="testimonials-list group">';

        $html .= '  <div class="thumb-testimonial group">';
        $html .= '      ' . get_the_post_thumbnail( null, 'thumb-testimonial' );
        $html .= '      <div class="shadow-thumb"></div>';
        $html .= '      <p class="name-testimonial group">' . $title . '<span class="website">' . $website . '</span></p>';
        $html .= '  </div>';

        $content = wpautop( get_the_content() );

        $html .= '  <div class="the-post group">';
        $html .= '      ' . $content;
        $html .= '  </div>';

        $html .= '</div>';

    endwhile;

    return apply_filters( 'yiw_sc_testimonials_html', $html );
}
endif;
add_shortcode("testimonials", "yiw_sc_testimonials_func");


if ( ! function_exists( 'yiw_sc_googlemap_func' ) ) :
/**
 * Google Maps
 *
 * @description
 *    Print the google map box
 *
 * @example
 *   [googlemap src="" [width=""] [height=""] ]
 *
 * @params
 *   src - the link of google map
 *   width - the width of box
 *   height - the height of box
 *
**/
function yiw_sc_googlemap_func($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '274',
      "height" => '200',
      "src" => ''
   ), $atts));

   $html  = '<div class="google-map-frame">';
   $html .= '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed" ></iframe>';
   $html .= '<div class="shadow-thumb-sidebar"></div>';
   $html .= '</div>';

   return apply_filters( 'yiw_sc_googlemap_html', $html );
}
endif;
add_shortcode("googlemap", "yiw_sc_googlemap_func");


if ( ! function_exists( 'yiw_sc_posts_func' ) ) :
/**
 * News List
 *
 * @description
 *    Print list of posts
 *
 * @example
 *   [posts cat="" items="" icon="" title="" size="" last="" ]
 *
 * @params
 *   cat   - id category of post
 *   items - number of posts
 *   icon  - one of set already been in $icons_name array
 *   size  - icons size (32 or 48) (optional) @default: 48
 *   last  - specifics if this section is the last element (optional) @default: false
 *   title - the title
 *
**/
function yiw_sc_posts_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "cat" => -1,
        "icon" => null,
        "items" => 3,
        "size" => 32,
        "last" => false,
        "title" => null
    ), $atts));

    $loop = new WP_Query( array(
        'cat' => $cat,
        'posts_per_page' => $items
    ) );

    $html = '';
    while( $loop->have_posts() ) : $loop->the_post();

        $html .= '<p>';
        $html .= the_title( '<a href="' . get_permalink() . '">', '</a><br />', false );

        add_filter( 'excerpt_length', 'yiw_excerpt_length_posts' );
        $html .= get_the_excerpt();
        remove_filter( 'excerpt_length', 'yiw_excerpt_length_posts' );

        $html .= '</p>';

    endwhile;

    //return do_shortcode('[section icon="' . $icon . '" size="' . $size . '" title="' . $title . '" last="' . $last . '"]' . $html . '[/section]');

    return apply_filters( 'yiw_sc_posts_html', $html );
}
endif;
add_shortcode("posts", "yiw_sc_posts_func");

function yiw_excerpt_length_posts() {
    return 5;
}


if ( ! function_exists( 'yiw_sc_newsletter_form_func' ) ) :
/**
 * NEWSLETTER FORM
 *
 * @description
 *    Show a newsletter form
 *
 * @example
 *   [newsletter_form action="" label="" [label_submit=""] ]
 *
 * @params
 *   action   - the action of form
 *   label    - the label of input text
 *   label_submit - the label of submit button
 *
**/
function yiw_sc_newsletter_form_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "title" => '',
        "description" => '',
        'action' => yiw_get_option( 'newsletter_form_action' ),
        'name' => yiw_get_option( 'newsletter_form_name' ),
        'email' => yiw_get_option( 'newsletter_form_email' ),
        'name_label' => yiw_get_option( 'newsletter_form_label_name' ),
        'email_label' => yiw_get_option( 'newsletter_form_label_email' ),
        'submit' => yiw_get_option( 'newsletter_form_label_submit' ),
        'hidden_fields' => yiw_get_option( 'newsletter_form_label_hidden_fields' ),
        'method' => yiw_get_option( 'newsletter_form_method' )
    ), $atts));

    $html = '';

    $html .= '<div class="newsletter-section group">';

        $html .= '<p class="description special-font">';
        $html .= yiw_string_( '<strong>', $title, '</strong>', false );
        $html .= yiw_string_( ' ', $description, '', false );
        $html .= '</p>';

        $html .= '<form method="' . $method . '" action="' . $action . '">';

            $html .= '<fieldset>';

                $html .= '<ul class="group">';

                    $html .= '<li>';
                    $html .= '<label for="' . $name . '">' . $name_label . '</label>';
                    $html .= '<input type="text" name="' . $name . '" id="' . $name . '" class="name-field text-field autoclear" />';
                    $html .= '</li>';

                    $html .= '<li>';
                    $html .= '<label for="' . $email . '">' . $email_label . '</label>';
                    $html .= '<input type="text" name="' . $email . '" id="' . $email . '" class="email-field text-field autoclear" />';
                    $html .= '</li>';

                    $html .= '<li>';
                    // hidden fileds
                    if ( $hidden_fields != '' ) {
                        $hidden_fields = explode( '&', $hidden_fields );
                        foreach ( $hidden_fields as $field ) {
                            list( $id_field, $value_field ) = explode( '=', $field );
                            $html .= '<input type="hidden" name="' . $id_field . '" value="' . $value_field . '" />';
                        }
                    }
                    $html .= wp_nonce_field('mc_submit_signup_form', '_mc_submit_signup_form_nonce', false, false);
                    $html .= '<input type="submit" value="' . $submit . '" class="submit-field" />';
                    $html .= '</li>';

                $html .= '</ul>';

            $html .= '</fieldset>';

        $html .= '</form>';

    $html .= '</div>';

    return apply_filters( 'yiw_sc_newsletter_form_html', $html );
}
endif;
add_shortcode("newsletter_form", "yiw_sc_newsletter_form_func");


if ( ! function_exists( 'yiw_sc_team_func' ) ) :
/**
 * TEAM
 *
 * @description
 *    Show a list of post type team
 *
 * @example
 *   [team items=""]
 *
 * @params
 *      items - number of item to show
 *
**/
function yiw_sc_team_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "items" => 10
    ), $atts));

    $args = array(
        'post_type' => 'bl_team'
    );
    if( !is_null( $items ) ) $args['posts_per_page'] = $items;

    $team = new WP_Query( $args );

    $html = '';
    if( !$team->have_posts() )
        return $html;

    //loop
    $html .= '<ul id="team" class="group">';

    while( $team->have_posts() ) : $team->the_post();

        $title = the_title( '', '', false );
        $content = get_the_content();

        $html .= '<li class="group">';

            if( has_post_thumbnail() )
                $html .= get_the_post_thumbnail( get_the_ID(), 'team-thumb' );

            $html .= '<blockquote>' . $content . '</blockquote>';

        $html .= '</li>';

    endwhile;

    $html .= '</ul>';

    return apply_filters( 'yiw_sc_team_html', $html );
}
endif;
add_shortcode("team", "yiw_sc_team_func");

if( ! function_exists( 'yiw_sc_features_tab' ) ) :
/**
 * FEATURES TAB
 *
 * @description
 *      Show all features tab posts in a tabbed div.
 *
 * @example
 *      [features_tab name="" open=""]
 *
 * @params
 *      name - Features tab name
 *      open - Open this tab at startup
**/
function yiw_sc_features_tab($atts, $content = null) {
    extract(shortcode_atts(array(
        'name' => '',
        'open' => 1
    ), $atts));

    $name = sanitize_title( $name );
    $open = abs( ( int ) $open );

    if( empty( $name ) ) {
        return false;
    }

    $args = array( 'post_type' => $name, 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' );
    //$ft = new WP_Query( $args );
    $ft_posts = get_posts( $args );

    $features_label = '';
    $features_content = '';
    $i = 0;

    foreach ( $ft_posts as $ft ) :

        $current = ( $open == ( $i + 1 ) ) ? 'current-feature' : '';

        $the_label = '<li class="features-tab-' . ( $i ) . ' ' . $current . '">';



        if( has_post_thumbnail( $ft->ID ) ) {
            $the_label .= get_the_post_thumbnail( $ft->ID, 'features_tab_icon' );
        }

        $the_label .= $ft->post_title;
        $the_label .= '</li>';

        $the_content = '<div class="features-tab-content features-tab-' . ( $i ) . ' ' . $current . '">' . do_shortcode( $ft->post_content ) . '</div>';

        $features_label .= $the_label;
        $features_content .= $the_content;

        $i++;

    endforeach;

    $without_sidebar = ( yiw_layout_page() == 'sidebar-no' ) ? 'without-sidebar' : '';

    $html  = '<div id="features-tab-' . $name . '" class="features-tab-container ' . $without_sidebar . ' group">';
        $html .= '<ul class="features-tab-labels">' . $features_label . '</ul>';
        $html .= '<div class="features-tab-wrapper">' . yiw_addp( $features_content ) . '</div>';
    $html .= '</div>';

    return $html;
}
endif;
add_shortcode("features_tab", "yiw_sc_features_tab");
?>