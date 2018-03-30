<?php
/**
 * Additional shortcodes for the theme.
 *
 * To create new shortcode, get for example the shortcode [sample] already written.
 * Replace it with your code for shortcode and for other shortcodes, duplicate the first
 * and continue following.
 *
 * CONVENTIONS:
 * - The name of function MUST be: yiw_sc_SHORTCODENAME_func.
 * - All html output of shortcode, must be passed by an hook: apply_filters( 'yiw_sc_SHORTCODENAME_html', $html ).
 * NB: SHORTCODENAME is the name of shortcode and must be written in lowercase.
 *
 * For example, we'll add new shortcode [sample], so:
 * - the function must be: yiw_sc_sample_func().
 * - the hooks to use will be: apply_filters( 'yiw_sc_sample_html', $html ).
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */

/**
 * SAMPLE
 *
 * @description
 *    description of sample shortcode
 *
 * @example
 *   [sample title="" incipit="" phone="" [class=""]]
 *
 * @attr
 *   class (optional) - class of container of box call to action (optional) @default: 'call-to-action'
 *   href  - url of button
 *   title  - the title of call to action
 *   incipit - the text below title
**/
function yiw_sc_sample_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'class' => 'call-to-action',
        'title' => null,
        'incipit' => null,
        'phone' => null
    ), $atts));

    $html = ''; // this is the var to use for the html output of shortcode

    return apply_filters( 'yiw_sc_sample_html', $html );   // this must be written for each shortcode
}
add_shortcode('sample', 'yiw_sc_sample_func');



/**
 * TESTIMONIALS
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
        "items" => null,
        "category" => ''
    ), $atts));

    wp_reset_query();

    $args = array(
        'post_type' => 'bl_testimonials'
    );

    if( !empty( $category ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category-testimonial',
                'field' => 'slug',
                'terms' => array_map( 'trim', explode( ',', $category ) )
            )
        );
    }

    $args['posts_per_page'] = ( !is_null( $items ) ) ? $items : -1;

    $tests = new WP_Query( $args );

    $html = '';
    if( !$tests->have_posts() ) return $html;

    ob_start();

    //loop
    $html = '';
    $c = 0;
    while( $tests->have_posts() ) : $tests->the_post();
        $website = get_post_meta( get_the_ID(), '_testimonial_website', true );
        $allow_link = get_post_meta( get_the_ID(), '_testimonial_link', true );
        $link = get_permalink();
        $label = get_post_meta( get_the_ID(), '_testimonial_label', true ) ? get_post_meta( get_the_ID(), '_testimonial_label', true ) : str_replace('http://', '', $website);
        $noavatar = "<img width=\"94\" height=\"94\" src=\"" . get_template_directory_uri() ."/images/noavatar.png\" class=\"attachment-thumb_testimonial wp-post-image\">";
        if ( ! empty( $website ) )
            $website = "<a class=\"website\" href=\"" . esc_url( $website ) . "\">". $label  ."</a>"; ?>

        <div class="testimonial two-fourth<?php if ( $c % 2 != 0 ) echo ' last' ?>">

            <div class="thumbnail">
                <?php


                    if ( has_post_thumbnail()){
                        echo $allow_link == 1 ? '<a href="' . $link .'">' : '';
                        the_post_thumbnail('thumb_testimonial');
                        echo $allow_link == 1 ? '</a>' : '';
                    } else {
                        echo $allow_link == 1 ? '<a href="' . $link .'">' : '';
                        echo $noavatar;
                        echo $allow_link == 1 ? '</a>' : '';
                    } ?>
            </div>

            <div class="testimonial-text">
                <?php echo yiw_content( 'content', apply_filters( 'yiw_testimonials_page_length', 38 ) ); ?>
            </div>

            <div class="testimonial-name">

                <?php
                    if($allow_link == '1'){ ?>
                        <a class="name" href="<?php echo $link; ?>"><?php the_title() ?></a>
                    <?php } else { ?>
                        <span class="name"><?php the_title(); ?></span>
                    <?php } ?>
                <?php echo $website ?>
            </div>

        </div>

    <?php $c++; endwhile;

    $html .= ob_get_clean();

    wp_reset_query();

    return apply_filters( 'yiw_sc_testimonials_html', $html );
}
add_shortcode("testimonials", "yiw_sc_testimonials_func");



/**
 * testimonials slider
 *
 * @description
 *    Show all post on testimonials post types
 *
 * @example
 *   [testimonials_slider items=""]
 *
 * @params
 *      items - number of item to show
 *
**/
function yiw_sc_testimonials_slider_func($atts, $content = null) {
    extract(shortcode_atts(array(
        "items" => -1,
        'speed' => 500,
        'timeout' => 7000,
        'excerpt' => 20,
        'link' => true,
        'category' => ''
    ), $atts));

    $args = array(
        'post_type' => 'bl_testimonials',
        'posts_per_page' => $items
    );

    if( !empty( $category ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category-testimonial',
                'field' => 'slug',
                'terms' => array_map( 'trim', explode( ',', $category ) )
            )
        );
    }

    $tests = new WP_Query( $args );

    $count_posts = wp_count_posts('bl_testimonials');

    if ( $count_posts->publish == 1 )
        $is_slider = false;
    else
        $is_slider = true;

    $html = '';
    if( !$tests->have_posts() ) return $html;

    ob_start(); ?>

   	    <div class="testimonials-slider">
       	    <ul class="testimonials group">

    <?php
    //loop
    $c = 0;
    while( $tests->have_posts() ) : $tests->the_post();

        $website = get_post_meta( get_the_ID(), '_testimonial_website', true ); ?>

        <li>
            <blockquote><p class="special-font"><?php if ( $link ) : ?><a href="<?php the_permalink() ?>"><?php endif; ?>&ldquo;<?php echo strip_tags( yiw_content( 'excerpt', $excerpt ) ) ?>&rdquo;<?php if ( $link ) : ?></a><?php endif; ?></p></blockquote>
            <p class="meta">
				<?php
				$title   = apply_filters( 'yiw_testimonials_slider_title_link', ('<a href="' . get_permalink() . '"><strong>' . get_the_title( get_the_ID() ) . '</strong></a>'), $link );
				$sep     = $website ? apply_filters( 'yiw_testimonials_slider_title_site_separator', '-' ) : '';
				$website = apply_filters( 'yiw_testimonials_slider_website_link', ('<a href="' . esc_url( $website ) . '">' . $website . '</a>'), $link );
				// Output
				echo $title . ' ' . $sep . ' ' . $website;
				?>
        </li>

    <?php $c++; endwhile; wp_reset_query();?>

            </ul>
            <?php if ( $is_slider ) : ?>
            <div class="prev"></div>
            <div class="next"></div>
            <?php endif; ?>
        </div> <?php

    if ( $is_slider ) : ?>
    <script type="text/javascript">
        jQuery(function($){
            $('.testimonials-slider ul').cycle({
                fx : 'scrollHorz',
                speed: <?php echo $speed ?>,
                timeout: <?php echo $timeout ?>,
                next: '.testimonials-slider .next',
                prev: '.testimonials-slider .prev'
            });
        });
    </script>
    <?php endif;

    $html = ob_get_clean();

    return apply_filters( 'yiw_sc_testimonials_slider_html', $html );
}
add_shortcode("testimonials_slider", "yiw_sc_testimonials_slider_func");


/**
 * Image
 *
 * @example
 *   [image size="small" lightbox="true"]http://url.to/image.jpg[/image]
 *
 * @params
 *   size (“small”, “medium”, “large” or “fullwidth”, medium by default)
 *   link (image link – optional)
 *   target (“_blank”, “_parent”, “_self”, or “_top” – optional)
 *   lightbox (“true” or “false”, “true” by default
 *   title (lightbox caption – optional)
 *   align (“left” or “right” – optional)
 *   group (group name to make lighbox gallery)
 *   width (image width – optional)
 *   height (image height – optional)
 *   autoheight (“true” or “false” for auto height the image, false by default – optional)
 *
**/
function yiw_sc_image_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'size' => 'medium',
        'link' => '',
        'target' => '',
        'lightbox' => 'true',
        'title' => '',
        'align' => 'left',
        'group' => '',
        'width' => '',
        'height' => '',
        'autoheight' => 'false'
    ), $atts));

    if ( $size == 'small' ) $size = 'thumbnail';

    $a_attrs = $img_attrs = $div_attrs = array();

    $div_attrs['class'][] = "img_frame img_size_$size";

    if ( $lightbox == 'true' || $lightbox == 'false' && ! empty( $link ) )
        $is_link = true;
    else
        $is_link = false;

    if ( ! empty( $link ) )
        $a_attrs['href'] = $link;
    else {
        $image_id = yiw_get_attachment_id($content);
        if ( $image_id != 0 ) {
            list( $image_url, $image_width, $image_height ) = wp_get_attachment_image_src( $image_id, $size );
            if ( empty( $width ) )  $width = $image_width;
            if ( empty( $height ) ) $height = $image_height;
            $img_attrs['src'] = $image_url;
            $a_attrs['href'] = $content;
        } else {
            $img_attrs['src'] = $a_attrs['href'] = $content;
        }
    }

    if ( ! empty( $target ) )
        $a_attrs['target'] = $target;

    if ( ! empty( $lightbox ) && $lightbox == 'true' ) {
        $a_attrs['class'][] = 'thumb img';
        $a_attrs['rel'] = 'prettyphoto';
        if ( ! empty( $group ) )
            $a_attrs['rel'] .= "[$group]";
    }

    if ( ! empty( $title ) )
        $img_attrs['title'] = $a_attrs['title'] = $title;

    if ( ! empty( $align ) )
        $div_attrs['class'][] = "align$align";

    if ( ! empty( $width ) ) {
        $div_attrs['style'][] = "width:{$width}px;";
        $img_attrs['width'] = $width;
    }

    if ( ! empty( $height ) && $autoheight == 'false' ) {
        $div_attrs['style'][] = "height:{$height}px;";
        $img_attrs['height'] = $height;
    } else if ( $autoheight == 'true' ) {
        $div_attrs['style'] = "height:auto;";
    }

    $attrs = array();
    foreach ( $div_attrs as $attr => $value ) {
        if ( is_array( $value ) )
            $attrs[] = "$attr=\"" . implode( ' ', $value ) . "\"";
        else
            $attrs[] = "$attr=\"$value\"";
    }
    $div_attrs = implode( ' ', $attrs );

    $attrs = array();
    foreach ( $img_attrs as $attr => $value ) {
        if ( is_array( $value ) )
            $attrs[] = "$attr=\"" . implode( ' ', $value ) . "\"";
        else
            $attrs[] = "$attr=\"$value\"";
    }
    $img_attrs = implode( ' ', $attrs );

    $attrs = array();
    foreach ( $a_attrs as $attr => $value ) {
        if ( is_array( $value ) )
            $attrs[] = "$attr=\"" . implode( ' ', $value ) . "\"";
        else
            $attrs[] = "$attr=\"$value\"";
    }
    $a_attrs = implode( ' ', $attrs );

    ob_start(); ?>

    <div class="image-styled">
        <div <?php echo $div_attrs ?>>
            <?php if ( $is_link ) : ?><a <?php echo $a_attrs ?>><?php endif ?>
                <img <?php echo $img_attrs ?> />
            <?php if ( $is_link ) : ?></a><?php endif ?>
        </div>
    </div>

    <?php $html = ob_get_clean();

    return apply_filters( 'yiw_sc_image_html', $html );
}
add_shortcode("image", "yiw_sc_image_func");

/**
 * CALL TO ACTION
 *
 * @description
 *    Shows a box witth an incipit and a number phone
 *
 * @example
 *   [call_two label_button="" href=""]
 *
 * @attr
 *   class - class of container of box call to action (optional) @default: 'call-to-action'
 *   href  - url of button
 *   title  - the title of call to action
**/
function yiw_sc_call_two_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'class' => 'call-to-action-two',
        'label_button' => null,
        'href' => null
    ), $atts));

	$content = do_shortcode( $content );

    $html = "<div class=\"$class group\">
				<div class=\"incipit\">
					<p class=\"special-font\">$content</p>
				</div>
				<a href=\"$href\" class=\"call-button\">
					$label_button
				</a>
			</div>";

    return apply_filters( 'yiw_sc_call_two_html', $html );
}
add_shortcode('call_two', 'yiw_sc_call_two_func');

/**
 * LOGO
 *
 * @description
 *    Show a simple text with the same font of logo
 *
 * @example
 *   [logo size="18px/em/pt/%"]text[/logo]
**/
function yiw_sc_logo_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'size' => ''
    ), $atts));

    $html = "<span class=\"logo\" ";

    if( !empty( $size ) ) {
        $html .= "style=\"font-size:$size\"";
    }

    $html .= ">$content</span>";

    return apply_filters( 'yiw_sc_logo_html', $html );
}
add_shortcode('logo', 'yiw_sc_logo_func');

/**
 * CREDIT CARD
 *
 * @description
 *    Show the icons for the credit cards
 *
 * @example
 *   [credit cards="paypal,visa,mastercard,amex,cirrus"]
**/
function yiw_sc_credit_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'cards' => 'paypal,visa,mastercard,amex,cirrus'
    ), $atts));

    $cards = explode( ',', $cards );

    $html = '';
    foreach ( $cards as $card ) {
        $card = trim($card);
        $html .= "<img src=\"" . get_template_directory_uri() . "/images/credit-cards/$card.png\" alt=\"$card\" style=\"margin-right:8px\" />";
    }

    return apply_filters( 'yiw_sc_credit_html', '<span style="padding-left:10px;">' . $html . '</span>' );
}
add_shortcode('credit', 'yiw_sc_credit_func');

/**
 * READ MORE (GREY CTA)
 *
 * @description
 *    Show the general read more button
 *
 * @example
 *   [read_more href=""]label[/read_more]
**/
function yiw_sc_read_more_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'href' => '#',
        'target' => ''
    ), $atts));

	$content = do_shortcode( $content );

    if( !empty( $target ) )
        $target = 'target="' . $target . '"';

    $html = "<a class=\"read-more\" href=\"$href\" $target>$content</a>";

    return apply_filters( 'yiw_sc_read_more_html', $html );
}
add_shortcode('grey_cta', 'yiw_sc_read_more_func');

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
        'action' => yiw_get_option( 'newsletter_form_action' ),
        'email' => yiw_get_option( 'newsletter_form_email' ),
        'email_label' => yiw_get_option( 'newsletter_form_label_email' ),
        'submit' => yiw_get_option( 'newsletter_form_label_submit' ),
        'hidden_fields' => yiw_get_option( 'newsletter_form_label_hidden_fields' ),
        'method' => yiw_get_option( 'newsletter_form_method' )
    ), $atts));

    $html = '';

    $html .= '<div class="newsletter-section">';

        $html .= '<form method="' . $method . '" action="' . $action . '">';

            $html .= '<fieldset>';

                    $html .= '<input type="text" value="' . $email_label . '" name="' . $email . '" id="' . $email . '" class="email-field text-field autoclear" />';
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

            $html .= '</fieldset>';

        $html .= '</form>';

    $html .= '</div>';

    return apply_filters( 'yiw_sc_newsletter_form_html', $html );
}
add_shortcode("newsletter_form", "yiw_sc_newsletter_form_func");


/**
 * SHARE
 *
 * @description
 *    Scroll to the latest slide
 *
 * @example
 *   [share socials="facebook, twitter, googleplus, pinterest"]
 *
 * @params
 *      title - the title to show after the arrow icon
 *
**/
function yiw_sc_share_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'title'   => yiw_get_option( 'share_title', __( 'love it, share it!', 'yiw' ) ),
        'socials' => yiw_get_option( 'share_socials', 'facebook, twitter, google, pinterest' ),
    ), $atts));

    ob_start();

    echo '<div class="socials">';
    if ( ! empty( $title ) ) echo '<h2>' . $title . '</h2>';

    $socials = array_map( 'trim', explode( ',', $socials ) );
    $socials_accepted = array( 'facebook', 'twitter', 'google', 'pinterest'  );

    foreach ( $socials as $i => $social ) {
        if ( in_array( $social, $socials_accepted ) ) {

            $url = $script = $attrs = '';

            $title_post = urlencode( get_the_title() );
            $permalink = urlencode( get_permalink() );
            $excerpt = urlencode( strip_tags ( strip_shortcodes( get_the_excerpt() ) ) );

            if ( $social == 'facebook' ) {
                $url = apply_filters( 'yiw_share_facebook', 'https://www.facebook.com/sharer.php?u=' . $permalink . '&t=' . $title_post . '' );

            } else if ( $social == 'twitter' ) {
                $url = apply_filters( 'yiw_share_twitter', 'https://twitter.com/share?url=' . $permalink . '&text=' . $title_post . '' );

            } else if ( $social == 'google' ) {
                $url = apply_filters( 'yiw_share_google', 'https://plus.google.com/share?url=' . $permalink . '&title=' . $title_post . '' );

            } else if ( $social == 'pinterest' ) {
                $src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                $url = apply_filters( 'yiw_share_pinterest', 'http://pinterest.com/pin/create/button/?url=' . $permalink . '&media=' . $src[0] . '&description=' . $excerpt );
                $attrs = ' onclick="window.open(this.href); return false;"';

            }

            echo do_shortcode( '[social size="small" type="' . $social . '" href="' . $url . '"' . $attrs . ' target="_blank"]' );
            echo $script;
        }
    }
    echo '</div>';

    $html = ob_get_clean();

    return apply_filters( 'yiw_sc_share_html', $html );
}
add_shortcode("share", "yiw_sc_share_func");

/**
 * SITEMAP
 *
 * @description
 *    Print a sitemap of the site
 *
 * @example
 *   [sitemap title=""]
 *
 * @attr
 *   title  - the title of sitemap
 **/
function yiw_sc_sitemap($atts, $content = null)
{
    extract(shortcode_atts(array(
        'title' => null,
    ), $atts));

    $html = ''; // this is the var to use for the html output of shortcode

    if($title): ?>
        <h1><?php echo $title ?></h1>
    <?php endif ?>

    <div class="sitemap row">
    <?php
    $order = array();
    //$order = array('include' => array('pages' => 'Pages', 'posts' => 'Posts', 'archives' => 'Archives'), 'exclude' => '');
    $order = json_decode(stripslashes(yiw_get_option('sitemap-order')), true);
    if( !empty($order) ) {
        $order = array_keys($order['include']);
    }

    $sitemap = array();

    //get pages
    if( in_array('pages', $order) ) {
        //retrieve pages with metabox _exclude-sitemap setted to On
        $args = array(
            'fields' => 'ids',
            'post_type' => 'page',
            'meta_query' => array(
                array(
                    'key' => '_exclude-sitemap',
                    'value' => '1',
                    'compare' => '='
                )
            )
        );
        $query = new WP_Query( $args );
        $exclude = implode(',', $query->posts) . ',' . yiw_get_option('sitemap-page-exclude');

        $sitemap['pages'] = '<h3>' . yiw_get_option('sitemap-page-title') . '</h3>';

        $sitemap['pages'] .= '<ul>' . wp_list_pages(array(
            'depth'        => yiw_get_option('sitemap-page-depth'),
            'exclude'      => $exclude,
            'echo'         => 0,
            'title_li'     => '',
            'sort_column'  => yiw_get_option('sitemap-page-sort_column'),
            'sort_order'   => yiw_get_option('sitemap-page-sort_order'),
            'post_type'    => 'page',
            'post_status'  => 'publish'
        )) . '</ul>';

        wp_reset_query();
    }

    //get posts
    if( in_array('posts', $order) ) {
        //get categories
        $exclude_cat = yiw_get_option('sitemap-posts-cats_exclude');

        $categories = get_categories(array(
            'type' => 'post',
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => 1,
            'exclude' => $exclude_cat,
            'hierarchical' => 1,
            'taxonomy' => 'category'
        ));

        //retrieve pages with metabox _exclude-sitemap setted to On
        $args = array(
            'fields' => 'ids',
            'post_type' => 'post',
            'meta_query' => array(
                array(
                    'key' => '_visibility',
                    'value' => array('catalog', 'visible'),
                    'compare' => 'IN'
                )
            ),
            'meta_query' => array(
                array(
                    'key' => '_exclude-sitemap',
                    'value' => '1',
                    'compare' => '='
                )
            )
        );
        $query = new WP_Query( $args );
        $exclude = implode(',', $query->posts) . ',' . yiw_get_option('sitemap-posts-exclude');

        $sitemap['posts'] = '<h3>' . yiw_get_option('sitemap-posts-title') . '</h3>';

        foreach($categories as $category) {
            //get posts in category
            $sitemap['posts'] .= '<h4>' . $category->name . '</h4>';

            $posts = get_posts(array(
                'numberposts'	=> yiw_get_option('sitemap-posts-number'),
                'category'	=> $category->cat_ID,
                'orderby'	=> yiw_get_option('sitemap-posts-orderby'),
                'order'		=> yiw_get_option('sitemap-posts-order'),
                'exclude'	=> $exclude,
                'post_type'	=> 'post',
            ));

            if (count($posts) > 0) {
                $sitemap['posts'] .= '<ul class="cat_' . $category->cat_ID .' cat">';

                foreach($posts as $post) {

                    $extra = '';

                    if (yiw_get_option('sitemap-posts-show_date')) {
                        $extra = ' <span>' . get_the_date() . '</span>';
                    }

                    $sitemap['posts'] .= '<li><a href="' . get_permalink($post->ID) . '" title="' . sprintf(esc_attr__('Permalink to %s', 'yiw'), the_title_attribute('echo=0')) . '" rel="bookmark">' . get_the_title($post->ID) . '</a>' . $extra . '</li>';
                }

                $sitemap['posts'] .= '</ul>';
            }
        }

        wp_reset_query();
    }

    //get archives
    if( in_array('archives', $order) ) {

        $sitemap['archives'] = '<h3>' . yiw_get_option('sitemap-archive-title') . '</h3>';
        $sitemap['archives'] .= '<ul>';

        $sitemap['archives'] .= wp_get_archives(array(
            'type' => yiw_get_option('sitemap-archive-type'),
            'limit' => yiw_get_option('sitemap-archive-limit') == -1 ? '' : yiw_get_option('sitemap-archive-limit'),
            'show_post_count' => yiw_get_option('sitemap-archive-show_post_count'),
            'echo' => 0
        ));

        $sitemap['archives'] .= '</ul>';
    }

    //get products
    global $woocommerce;
    if( in_array('products', $order) && isset( $woocommerce ) ) {

        $categories = get_terms( 'product_cat', array(
            'hide_empty' => 0
        ));

        $sitemap['products'] = '<h3>' . yiw_get_option('sitemap-products-title') . '</h3>';

        foreach($categories as $category) {
            //get posts in category
            $args = array(
                'post_type'	=> 'product',
                'post_status' => 'publish',
                'ignore_sticky_posts'	=> 1,
                'posts_per_page' => yiw_get_option('sitemap-products-number'),
                'meta_query' => array(
                    array(
                        'key' => '_visibility',
                        'value' => array('catalog', 'visible'),
                        'compare' => 'IN'
                    )
                ),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'terms' => array( esc_attr($category->slug) ),
                        'field' => 'slug',
                        'operator' => 'IN'
                    )
                )
            );
            $products = new WP_Query( $args );

            if (count($products->posts) > 0) {
                $sitemap['products'] .= '<h4>' . $category->name . '</h4>';
                $sitemap['products'] .= '<ul class="cat_' . $category->term_id .' cat">';

                foreach($products->posts as $post) {
                    $sitemap['products'] .= '<li><a href="' . get_permalink($post->ID) . '" title="' . sprintf(esc_attr__('Permalink to %s', 'yiw'), the_title_attribute('echo=0')) . '" rel="bookmark">' . get_the_title($post->ID) . '</a></li>';
                }

                $sitemap['products'] .= '</ul>';
            }
        }

    }

    //print the sitemap
    $i = 0;

    foreach($order as $k=>$item) {
        $i++;
        $div = yiw_layout_page() == 'sidebar-no' ? 4 : 3;
        $columns = yiw_layout_page() == 'sidebar-no' ? 'one-fourth' : 'one-third';
        $class = ( $i % $div ) == 0 ? ' last' : '';
        echo '<div class="sitemap-' . $k . '-container '. $columns .' '. $class .'">';
        echo $sitemap[$item];
        echo '</div>';
        if ( ($i % $div) == 0 ) echo '<div class="clear"></div>';
    }

    ?>
    </div>

    <?php return apply_filters( 'yiw_sc_sitemap', $html );   // this must be written for each shortcode
}
add_shortcode('sitemap', 'yiw_sc_sitemap');
?>