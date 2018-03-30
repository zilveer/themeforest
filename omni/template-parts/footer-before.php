<?php

$show_subscribe_widget = cs_get_customize_option( 'show_subscribe_widget' );
$show_socnetworks      = cs_get_customize_option( 'footer_show_soc_networks' );
$show_instagram        = cs_get_customize_option( 'show_instagram_widget' );

$output = '';

/*
 * Subscribe form
 */

if ( function_exists( 'smlsubform' ) && !($show_subscribe_widget === null) ) {

	$custom_style_subscribe = crumina_widget_background( 'subscribe' );

	$output .= '<section class="newsletter" ' . $custom_style_subscribe . '>';
	$output .= '<div class="container">';
	global $wp_widget_factory;

	$widget = 'Crum_Subscribe_Widget';

	$instance = array();

	$instance['title']             = esc_html__( 'Subscribe & Follow ', 'omni' );
	$instance['subtitle']          = esc_html__( 'Get an email of every new post! We\'ll never share your address.', 'omni' );
	$instance['email_placeholder'] = esc_html__( 'Enter Your Mail id here', 'omni' );
	$instance['button_text']       = esc_html__( 'Subscribe', 'omni' );

	$args = array(
		'before_widget' => '<div class="widget clearfix ">',
		'before_title'  => '<div class="widget-title"><h4>',
		'after_title'   => '</h4></div><!-- end widget-title -->',
	);

	$output .= '<div class="row">';

	$output .= '<div class="col-md-12">';

	if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $widget ] ) ) {
		ob_start();

		the_widget( $widget, $instance, $args );

		$output .= ob_get_clean();
	}

	$output .= '</div>';//col-md-12

	$output .= '</div>';//row
	$output .= '</div>';//container
	$output .= '</section>';//newsletter
}

/*
 * Soc networks
 */

$soc_networks_array = array(
	"fa fa-facebook"   => esc_html__( 'Facebook', 'omni' ),
	"fa fa-google"     => esc_html__( 'Google', 'omni' ),
	"fa fa-twitter"    => esc_html__( 'Twitter', 'omni' ),
	"fa fa-instagram"  => esc_html__( 'Instagram', 'omni' ),
	"fa fa-xing"       => esc_html__( 'Xing', 'omni' ),
	"fa fa-lastfm"     => esc_html__( 'LastFM', 'omni' ),
	"fa fa-dribbble"   => esc_html__( 'Dribble', 'omni' ),
	"fa fa-vk"         => esc_html__( 'Vkontakte', 'omni' ),
	"fa fa-youtube"    => esc_html__( 'Youtube', 'omni' ),
	"fa fa-windows"    => esc_html__( 'Microsoft', 'omni' ),
	"fa fa-deviantart" => esc_html__( 'Deviantart', 'omni' ),
	"fa fa-linkedin"   => esc_html__( 'LinkedIN', 'omni' ),
	"fa fa-pinterest"  => esc_html__( 'Pinterest', 'omni' ),
	"fa fa-wordpress"  => esc_html__( 'Wordpress', 'omni' ),
	"fa fa-behance"    => esc_html__( 'Behance', 'omni' ),
	"fa fa-flickr"     => esc_html__( 'Flickr', 'omni' ),
	"fa fa-rss"        => esc_html__( 'RSS', 'omni' ),
);

if ( !($show_socnetworks === null) ) {

	$custom_style_soc_networks = crumina_widget_background( 'soc_networks' );

	$widget_text_color = cs_get_customize_option( 'soc_networks_widget_text_color' );
	if ( isset( $widget_text_color ) && ! ( empty( $widget_text_color ) ) ) {
		$text_additional_style = 'style="color:' . $widget_text_color . '"';
	} else {
		$text_additional_style = '';
	}

	$output .= '<section class="big-social-wrapper" ' . $custom_style_soc_networks . '>';
	$output .= '<div class="big-social container" '.$text_additional_style.'>';

	$i = 0;

	foreach ( $soc_networks_array as $icon => $soc_network ) {
		$soc_network_link = cs_get_customize_option( 'soc_' . str_replace( 'fa fa-', '', $icon ) );
		if ( isset( $soc_network_link ) && ! ( $soc_network_link == '' ) ) {
			$i ++;
		}
	}

	if ( $i > 0 ) {
		$column_number = intval( 12 / $i );
		if ( ! ( $column_number == 0 ) ) {
			$cols = $column_number;
		} else {
			$cols = '2';
		}

		foreach ( $soc_networks_array as $icon => $soc_network ) {

			$soc_network_link = cs_get_customize_option( 'soc_' . str_replace( 'fa fa-', '', $icon ) );
			if ( isset( $soc_network_link ) && ! ( $soc_network_link == '' ) ) {
				$output .= '<div class="social-icon-wrapper">';
				$output .= '<div class="blog-social">';
				$output .= '<a href="' . esc_url( $soc_network_link ) . '" data-tooltip="tooltip" data-placement="bottom" title="' . esc_attr( $soc_network ) . '">';
				$output .= '<div class="socibox">';
				$output .= '<span class="' . esc_attr( $icon ) . '" '.$text_additional_style.'></span>';
				$output .= '</div>';//socibox
				$output .= esc_attr( $soc_network );
				$output .= '</a>';
				$output .= '</div>';//blog-social
				$output .= '</div>';//cols
			}

		}
	}

	$output .= '</div>';//big-social
	$output .= '</section>';//big-social-wrapper
}

/*
 * Instagram widget
 */

if ( !($show_instagram === null) ) {

	$instance = array();

	$title         = cs_get_customize_option( 'instagram_title' );
	$user_name     = cs_get_customize_option( 'instagram_username' );
	$cache_time    = cs_get_customize_option( 'instagram_cachetime' );
	$photo_number  = cs_get_customize_option( 'instagram_number' );
	$column_number = cs_get_customize_option( 'instagram_columns_number' );

	if ( isset( $column_number ) && !empty($column_number) ) {
		$column_class = ' insta-col-' . $column_number . '';
	} else {
		$column_class = ' insta-col-7';
	}

	if(isset($photo_number) && !(empty($photo_number))){
		$number_photos = $photo_number;
	}else{
		$number_photos = 14;
	}

	$custom_style_instagram = crumina_widget_background( 'instagram' );
	$widget_text_color = cs_get_customize_option( 'instagram_widget_text_color' );
	if ( isset( $widget_text_color ) && ! ( empty( $widget_text_color ) ) ) {
		$text_additional_style = 'style="color:inherit"';
	} else {
		$text_additional_style = '';
	}

	$output .= '<section class="instagram-section clearfix" ' . $custom_style_instagram . '>';

	if ( isset($title) && !(empty($title)) ) {
		$output .= '<div class="insta-title">';
		$output .= '<p '.$text_additional_style.'>' . wp_kses( $title, array( 'i' => array( 'class' => array() ) ) ) . '</p>';
		$output .= '</div>';
	}
	$output .= '<div class="instagram-wrapper ' . esc_attr( $column_class ) . '">';
	if ( class_exists( 'Crumina_Instagram_Widget' ) ) {

		$insta_widget = new Crumina_Instagram_Widget;
		$media_array  = $insta_widget->scrape_instagram( $user_name, $cache_time );

		if ( is_wp_error( $media_array ) ) {
			echo( $media_array->get_error_message() );
		} else {
			$media_array = array_filter( $media_array, array( $insta_widget, 'images_only' ) );

			$i = 0;

			foreach ( $media_array as $single_image ) {
				if ( $i < $number_photos ) {
					if ( isset( $column_number ) && ($column_number < 6)) {
						$small_link = str_replace( 'e35', 's640x640/e35', $single_image['link'] );
					} else {
						$small_link = str_replace( 'e35', 's320x320/e35', $single_image['link'] );
					}
					$output .= '<a rel="prettyPhoto[insta_widget__gal]" href="' . esc_url( $single_image['link'] ) . '" ><img class="img-responsive "src="' . esc_url( $small_link ) . '" alt="" /></a>';
					$i ++;
				}
			}

		}

	}
	$output .= '</div>';

	$output .= '</div>';//instagram-section
}

echo( $output );
