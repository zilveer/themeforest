<?php

// This file contains some new shortcodes for the Visual Composer plugin - custom shortcodes made by me

// Gallery

function krown_gallery_function( $attr ) {

    global $post;

    $post = get_post();

    static $instance = 0;
    $instance++;

    if ( ! empty( $attr['ids'] ) ) {
        if ( empty( $attr['orderby'] ) ) {
            $attr['orderby'] = 'post__in';
        }
        $attr['include'] = $attr['ids'];
    }

    $html = apply_filters( 'post_gallery', '', $attr );
    if ( $html != '' ) {
        return $html;
    }

    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] ) {
            unset( $attr['orderby'] );
        }
    }

    extract( shortcode_atts( array(
        'order'          => 'ASC',
        'orderby'        => 'menu_order ID',
        'id'             => $post->ID,
        'include'        => '',
        'exclude'        => '',
        'type'           => 'thumbs',
        'columns'        => '3',
        'width'          => 'null',
        'lightbox'       => 'false',
        'grid'           => 'false'
    ), $attr ) );

    $id = intval( $id );
    if ( 'RAND' == $order ) {
        $orderby = 'none';
    }

    if ( ! empty( $include ) ) {

        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();

        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }

    } else if ( ! empty( $exclude ) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty( $attachments ) ) {
        return '';
    }

    if ( is_feed() ) {
        $html = "\n";
        foreach ( $attachments as $att_id => $attachment ) {
            $html .= wp_get_attachment_link($att_id, $size, true) . "\n";
        }
        return $html;
    }

    $slides = '';

    $thumbs_col = 100 / $columns;
    $thumbs_width = floor(1296 / $columns);

    $i = 0;

    foreach ( $attachments as $id => $attachment ) {

        $link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_image_src( $id, 'full', false, false ) : wp_get_attachment_image_src( $id, 'full', true, false );

        $caption = get_post( $id )->post_excerpt;
        $title = get_post( $id )->post_title;

        $extra_class = '';
        if ( $i % $columns == 0 ) {
            $extra_class = ' first';
        }
        if ( ++$i % $columns == 0 ) {
            $extra_class = ' last';
        } 

        if ( $type == 'slider' ) {

            $slides .= '<li>';

            if ( $lightbox == 'true') {
                $slides .= '<a href="' . $link[0] . '" class="fancybox fancybox-thumb">';
            }

            if ( $grid == 'true' ) {
                $link[0] = aq_resize( $link[0], '680', null );
            }

            $slides .= '<img src="' . $link[0] . '" alt="' . $caption .'" />';


            if ( $lightbox == 'true') {
                $slides .= '</a>';
            }

            if ( isset( $caption ) && $caption != '' ) {
                $slides .= '<p class="flex-caption">'. $caption . '</p>';
            }

            $slides .= '</li>';


        } else {

        	$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
            $slides .= '<a class="fancybox fancybox-thumb' . $extra_class . '" data-fancybox-group="gallery-' . $instance . '" data-fancybox-title="' . $caption . '" href="' . $link[0] . '" style="width:' . $thumbs_col . '%"><img src="' . aq_resize( $link[0], $thumbs_width, $thumbs_width, true ) . '" alt="' . $alt . '" /></a>';

        }

    }

    if ( $type == 'slider' ) {

        $html = '<div class="flexslider mini"><ul class="slides">' . $slides . '</ul></div>';

    } else {

        $html = '<div class="krown-thumbnail-gallery clearfix">' . $slides . '</div>';

    }

    return $html;

}

remove_shortcode( 'gallery', 'gallery_shortcode' );
add_shortcode( 'gallery', 'krown_gallery_function' );

// Contact Form

function vc_contact_form_function( $atts, $content ) {

    extract( shortcode_atts( array(
        'el_class'       => '',
        'label_name'     => 'Name',
        'label_email'    => 'Email',
        'label_subject'  => 'Subject',
        'label_message'  => 'Message',
        'label_send'     => 'Send',
        'email'          => '',
        'success'        => 'Your message was sent!',
        'error'          => 'Complete all the fields',
        'css_animation' => '',
        'css_animation_speed' => 'default',
        'css_animation_delay' => '0'
    ), $atts ) );

    $output = '<section class="krown-form' . ( $el_class != '' ? ' ' . $el_class : '' ) . ' clearfix' . ( $css_animation != '' ? ' animate ' . $css_animation_speed . '" data-anim-type="' . $css_animation . '" data-anim-delay="' . $css_animation_delay . '"' : '"') . '>
        <form method="POST" action="' . get_template_directory_uri() . '/includes/contact-form.php">';

        $output .= '
            <div class="krown-column-container span4">
                <label for="name">' . $label_name . '</label>
                <input id="name" type="text" name="name" class="name" />
            </div>
            <div class="krown-column-container span4">
                <label for="email">' . $label_email . '</label>
                <input id="email" type="email" name="email" class="email" novalidate="" />
            </div>
            <div class="krown-column-container span4">
                <label for="subject">' . $label_subject . '</label>
                <input id="subject" type="text" name="subject" class="subject" />
            </div>
            <div class="krown-column-container span12" style="margin-left: 0">
                <label for="message">' . $label_message . '</label>
                <textarea id="message" name="message" class="message"></textarea>
            </div>
            <input type="text" name="fred" class="fred hidden" value="" />
            <input type="submit" class="submit" value="'. $label_send . '" />
            <input type="hidden" name="dlo128" class="hidden dlo128" value="' . $email . '" />';

    $output .= '</form>
        <p class="hidden success-message">' . str_replace( "\n", "<br />", $success ) . '</p>
        <p class="hidden error-message">' . str_replace( "\n", "<br />", $error ) . '</p>
    </section>';
   
   return $output;

}

add_shortcode( 'vc_contact_form', 'vc_contact_form_function' );

// Icon Text Block

function vc_icon_text_function( $atts, $content ) {

	$output = $el_class = $css_animation = '';

	extract(shortcode_atts(array(
		'title' => 'Title',
	    'icon' => 'none',
	    'size' => 'fa-regular',
	    'background' => '#656565',
	    'style' => 'one',
	    'href' => '',
	    'target' => '_blank',
	    'el_class' => ''
	), $atts));

	//$el_class = $this->getExtraClass($el_class);

	$css_class = /*apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,*/'krown-text-icon style-' . $style . $el_class/*, $this->settings['base'])*/;

    $output .= '<div class="' . $css_class . '">';

	if ( $href != '' ) {
    	$output .= '<a class="icon-wrap" href="'. $href . '" target="' . $target . '">';
    }

    $output .= '<i class="fa fa-fw ' . $icon . ' ' . $size . '" style="color:' . $background . '"></i>';

    $output .= '<h5>' . $title . '</h5>';

    if ( $href != '' ) {
    	$output .= '</a>';
    }

    $output .= '</div>';

	return $output;

}

add_shortcode( 'vc_icon_text', 'vc_icon_text_function' );

// Portfolio Grid

function vc_portfolio_grid_function( $atts, $content ) {

    extract( shortcode_atts( array(
        'el_class'     => '',
        'no'           => '8',
        'cols'         => 'four',
        'cat'          => '',
    ), $atts ) );

    global $post;

    // Get proper thumb size

    $img_size = krown_portfolio_thumbnails_size( krown_sidebar_class(), $cols );

    // Fix categories

    if ( $cat == '' ) {

        $cat_temp = get_categories( array( 'taxonomy' => 'portfolio_category' ) );
        foreach ( $cat_temp as $t ) {
            $cat .= $t->slug . ',';
        }
        $cat = substr( $cat, 0, -1 );

    }

    // Check pagination

    $pagination = ( $cols == 'four' && $no > 4 ) || ( $cols == 'three' && $no > 3 ) || ( $cols == 'two' && $no > 2 );

    // Start shortcode 

    $html = '<div class="krown-latest-portfolio' . ( $el_class != '' ? ' ' . $el_class : '' ) . ( $pagination ? ' carousel" data-visible="' . $cols . '"' : '"' ) .  '>';

    if ( $pagination ) {
        $html .= '<div class="post-nav"><a class="btn-prev" href="#"></a><a class="btn-next" href="#"></a></div>';
    }

    $html .= '<div class="inner">

    	<ul class="folio-grid clearfix c' . $cols . '">';

    $args = array(
        'posts_per_page' => $no, 
        'portfolio_category'  => $cat,
        'post_type' => 'portfolio' 
    );

    $all_posts = new WP_Query( $args );

    while( $all_posts->have_posts() ) : $all_posts->the_post();

        $thumb = get_post_thumbnail_id();
        $img_url = wp_get_attachment_url( $thumb, 'full' );  
        $image = aq_resize( $img_url, $img_size[0], $img_size[1], true, false ); 

        $html .= '<li class="item">

            <a href="' . get_permalink( $post->ID ) . '" class="clearfix">

            	<div class="fancybox-thumb">
                	<img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . get_the_title() . '" />
                	<span></span>
                </div>

                <div class="caption">
                	<h3>' . get_the_title() . '</h3>
                	<span>' . krown_categories( $post->ID, 'portfolio_category', ', ', 'name', false ) . '</span>
                </div>

            </a>

        </li>';

    endwhile;

    wp_reset_query();

    $html .= '</ul>';

    $html .= '</div></div>';

    return $html;

}

add_shortcode( 'vc_portfolio_grid', 'vc_portfolio_grid_function' );


// Portfolio Grid

function vc_promo_box_function( $atts, $content ) {

    extract( shortcode_atts( array(
        'el_class'     => '',
        'style'           => 'light-1'
    ), $atts ) );

    $html = '<div class="krown-promo clearfix ' . $style . ' ' . $el_class . '">' . do_shortcode( $content ) . '</div>';
    return $html;

}

add_shortcode( 'vc_promo_box', 'vc_promo_box_function' );

// Pricing Table

function vc_krown_pricing_table_function( $atts, $content ) {

    extract( shortcode_atts( array(
        'el_class'  => '',
        'columns' => '3'
    ), $atts ) );

    return '<div class="krown-pricing col-' . $columns . ' ' . $el_class . ' clearfix">' . do_shortcode( $content ) . '</div>';
}

function vc_krown_pricing_column_function( $atts, $content ) {

    extract( shortcode_atts( array(
        'title'     => '',
        'subtitle'  => '',
        'button_label'  => '',
        'button_url'  => '#',
        'featured' => 'no'
    ), $atts ) );

    $output = '<div class="krown-pricing-column' . ( $featured != 'no' ? ' featured' : '' ) . '">';

    $title = preg_replace( "(\*\*(.+)\*\*)", "<sub>$1</sub>", $title );
    $title = preg_replace( "(\*(.+)\*)", "<sup>$1</sup>", $title );

    $output .= '<div class="krown-pricing-title"><h3>' . $title . '</h3>';

    if ( $subtitle != '' ) {
        $output .= '<h5>' . $subtitle . '</h5>';
    }

    if ( $featured != 'no' ) {
    	$output .= '<span class="featured-text">' . __( 'Most Popular', 'krown' ) . '</span>';
    }

    $output .= '</div>';

    $output .= '<div class="krown-pricing-content">' . $content . '</div>';

    if ( $button_label != '' ) {
        $output .= '<div class="krown-pricing-button"><a class="krown-button normal light" href="' . $button_url . '">' . $button_label . '</a></div>';
    }

    $output .= '</div>';

    return $output;

}

add_shortcode( 'vc_krown_pricing_column', 'vc_krown_pricing_column_function' );
add_shortcode( 'vc_krown_pricing_table', 'vc_krown_pricing_table_function' );

// Team Member

function vc_team_function( $atts, $content ) {

	extract( shortcode_atts( array(
        'el_class'  => '',
        'image' 	=> '',
        'title'  => '',
        'subtitle'  => ''
    ), $atts ) );

	//$el_class = $this->getExtraClass($el_class)

	$css_class = /*apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,*/'krown-team'.$el_class/*, $this->settings['base'])*/;

	$img = wp_get_attachment_image_src( $image, 'full' );

    $output = '<div class="' . $css_class . '"><div class="holder">';

    $output .= '<div class="image"><img src="' . $img[0] . '" alt="' . $title . '" /></div>
    	<div class="caption">
	    	<h4>' . $title . '</h4>
	    	<h5>' . $subtitle . '</h5>
    		<div class="content">' . wpb_js_remove_wpautop( $content, true ) . '</div>
    	</div>
    </div></div>';

	return $output;

}

add_shortcode( 'vc_team', 'vc_team_function' );

// Testimonial

function vc_testimonial_function( $atts, $content ) { 

    extract( shortcode_atts( array(
        'el_class'  => '',
        'client'    => '',
        'position'  => '',
        'style'      => 'one',
        'css_animation' => '',
        'css_animation_speed' => 'default',
        'css_animation_delay' => '0'
    ), $atts ) );

    $html = '<figure class="krown-testimonial style-' . $style . ( $el_class != '' ? ' ' . $el_class : '' ) . ( $css_animation != '' ? ' animate ' . $css_animation_speed . '" data-anim-type="' . $css_animation . '" data-anim-delay="' . $css_animation_delay . '"' : '"') . '>
        <blockquote>' . $content . '</blockquote>
        <figcaption><p>';

    if ( $style == 'two' ) {
        $html .= '<i class="fa-about_us"></i>' . $client . '</p>';
    } else if ( $style == 'one' ) {
        $html .= $client . '</p><span>' . $position . '</span>';
    }

    $html .= '</figcaption>
        </figure>';
   
    return $html;

}

add_shortcode( 'vc_testimonial', 'vc_testimonial_function' );

// Social Icons

function vc_social_links_function( $atts, $content ) {

	extract( shortcode_atts( array(
        'el_class'  => '',
        'target' => '_self'
    ), $atts ) );

    $output = '<div class="krown-social clearfix' . ( $el_class != '' ? ' ' . $el_class : '' ) . '"><ul>';

    foreach ( $atts as $type => $href ) {

    	if ( $type != 'target' ) {

	    	if ( $type == 'email' ) {
	    		$icon = 'fa fa-fw fa-envelope-o';
	    	} else if ( $type == 'googleplus' ) {
	    		$icon = 'fa fa-fw fa-google-plus';
	    	} else if ( $type == 'vimeo' ) {
	    		$icon = 'fa fa-fw fa-vimeo-square';
	    	} else {
	    		$icon = 'fa fa-fw fa-' . $type;
	    	}

	    	$output .= '<li><a target="' . $target . '" href="' . $href . '"><i class="' . $icon . '"></i></a></li>';

    	}

    }

    $output .= '</ul></div>';

	return $output;

}

add_shortcode( 'vc_social_links', 'vc_social_links_function' );

// Images List

function vc_images_list_function( $attr, $content ) {

    extract( shortcode_atts( array(
        'el_class'    => '',
        'columns'     => '4'
    ), $attr ) );

	$output = '<ul class="krown-images-list col-' . $columns . ' clearfix">' . do_shortcode( $content ) . '</ul>';

	return $output;

}

add_shortcode( 'vc_images_list', 'vc_images_list_function' );

function vc_images_list_item_function( $attr, $content ) {

    extract( shortcode_atts( array(
        'img'    => '',
        'link'     => '',
        'target'     => '_self'
    ), $attr ) );

    $output = '<li>';

    if ( $link != '' ) {
    	$output .= '<a href="' . $link . '" target="' . $target . '">';
    }

    $output .= '<img src="' . $img . '" alt="" />';

    if ( $link != '' ){
    	$output .= '</a>';
    }

    $output .= '</li>';

    return $output;

}

add_shortcode( 'vc_images_list_item', 'vc_images_list_item_function' );

?>