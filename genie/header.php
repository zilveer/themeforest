<?php

global $bt_options;
$bt_options = get_option( BTPFX . '_theme_options' );

global $bt_page_options;
$bt_page_options = array();

if ( ! function_exists( 'bt_transform_override' ) ) {
	function bt_transform_override( $arr ) {
		$new_arr = array();
		foreach( $arr as $item ) {
			$key = substr( $item, 0, strpos( $item, ':' ) );
			$value = substr( $item, strpos( $item, ':' ) + 1 );
			$new_arr[ $key ] = $value;
		}
		return $new_arr;
	}
}

if ( ! is_404() ) {
	$tmp_bt_page_options = bt_rwmb_meta( BTPFX . '_override' );
	$tmp_bt_page_options1 = '';
	if ( ( is_search() || is_archive() || is_home() || is_singular( 'post' ) ) && get_option( 'page_for_posts' ) != 0 ) {
		$tmp_bt_page_options1 = bt_rwmb_meta( BTPFX . '_override', array(), get_option( 'page_for_posts' ) );
	}
	
	if ( ! is_array( $tmp_bt_page_options ) ) $tmp_bt_page_options = array();

	if ( is_array( $tmp_bt_page_options1 ) ) {
		if ( is_singular() ) {
			$tmp_bt_page_options = array_merge( bt_transform_override( $tmp_bt_page_options1 ), bt_transform_override( $tmp_bt_page_options ) );
		} else {
			$tmp_bt_page_options = bt_transform_override( $tmp_bt_page_options1 );
		}
	} else if ( count( $tmp_bt_page_options ) > 0 ) {
		$tmp_bt_page_options = bt_transform_override( $tmp_bt_page_options );
	}

	foreach ( $tmp_bt_page_options as $key => $value ) {
		$bt_page_options[ $key ] = $value;
	}
}

$html_class = '';
if ( bt_get_option( 'sticky_header' ) ) {
	$html_class = ' boldFixedHeader';
	if ( bt_get_option( 'centered_logo' ) ) {
		$html_class .= ' boldFixedHeaderCentered';
	}	
}

$page_type = bt_rwmb_meta( BTPFX . '_page_type', array(), get_the_ID() );

if ( $page_type == 'tile_grid' ) {
	$html_class .= ' tile';
} else if ( $page_type == 'grid' || $page_type == 'wide_grid' ) {
	$html_class .= ' grid';
}

?>
<!DOCTYPE html>
<html class="no-js<?php echo $html_class; ?>" <?php language_attributes(); ?>>
<head>

    <title><?php wp_title( '' ); ?></title>
	
	<?php
	
		$desc = bt_rwmb_meta( BTPFX . '_description' );
		
		if ( $desc != '' ) {
			echo '<meta name="description" content="' . $desc . '">';
		}
		
		if ( is_single() ) {
			echo '<meta property="twitter:card" content="summary">';

			echo '<meta property="og:title" content="' . get_the_title() . '" />';
			echo '<meta property="og:type" content="article" />';
			echo '<meta property="og:url" content="' . get_permalink() . '" />';
			
			$img = null;
			
			$bt_featured_slider = bt_get_option( 'blog_featured_image_slider' ) && has_post_thumbnail();
			if ( $bt_featured_slider ) {
				$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$img = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
				$img = $img[0];
			} else {
				$images = bt_rwmb_meta( BTPFX . '_images', 'type=image' );
				if ( is_array( $images ) ) {
					foreach ( $images as $img ) {
						$img = $img['full_url'];
						break;
					}
				}
			}
			if ( $img ) {
				echo '<meta property="og:image" content="' . $img . '" />';
			}
			
			if ( $desc != '' ) {
				echo '<meta property="og:description" content="' . $desc . '" />';
			}
		}
	
		$favicon = bt_get_option( 'favicon' );
		$mobile_touch_icon = bt_get_option( 'mobile_touch_icon' );
		
		if ( strpos( $favicon, '/wp-content' ) === 0 ) $favicon = get_site_url() . $favicon;
		if ( strpos( $mobile_touch_icon, '/wp-content' ) === 0 ) $mobile_touch_icon = get_site_url() . $mobile_touch_icon;
		
		if ( bt_get_option( 'favicon' ) != '' ) {
			echo '<link rel="shortcut icon" href="' . esc_url( $favicon ) . '" type="image/x-icon">';
		}
		
		if ( bt_get_option( 'mobile_touch_icon' ) != '' ) {
			echo '<link rel="icon" href="' . esc_url( $mobile_touch_icon ) . '">';
			echo '<link rel="apple-touch-icon-precomposed" href="' . esc_url( $mobile_touch_icon ) . '">';
		}
		
		$show_social = intval( bt_get_option( 'show_social' ) );
		
		if ( $show_social == 1 && intval( bt_get_option( 'centered_logo' ) ) != 1 ) {
			$show_social = true;
		} else {
			$show_social = false;
		}
		
		$facebook = '';
		if ( bt_get_option( 'contact_facebook' ) ) {
			$facebook = '<li><a href="' . esc_url( bt_get_option( 'contact_facebook' ) ) . '" data-icon="&#xf09a;"></a></li>';
		}
		$twitter = '';
		if ( bt_get_option( 'contact_twitter' ) ) {
			$twitter = '<li><a href="' . esc_url( bt_get_option( 'contact_twitter' ) ) . '" data-icon="&#xf099;"></a></li>';
		}
		$google_plus = '';
		if ( bt_get_option( 'contact_google_plus' ) ) {
			$google_plus = '<li><a href="' . esc_url( bt_get_option( 'contact_google_plus' ) ) . '" data-icon="&#xf0d5;"></a></li>';
		}
		$linkedin = '';
		if ( bt_get_option( 'contact_linkedin' ) ) {
			$linkedin = '<li><a href="' . esc_url( bt_get_option( 'contact_linkedin' ) ) . '" data-icon="&#xf0e1;"></a></li>';
		}
		$pinterest = '';
		if ( bt_get_option( 'contact_pinterest' ) ) {
			$pinterest = '<li><a href="' . esc_url( bt_get_option( 'contact_pinterest' ) ) . '" data-icon="&#xf0d2;"></a></li>';
		}
		$vk = '';
		if ( bt_get_option( 'contact_vk' ) ) {
			$vk = '<li><a href="' . esc_url( bt_get_option( 'contact_vk' ) ) . '" data-icon="&#xf189;"></a></li>';
		}
		$slideshare = '';
		if ( bt_get_option( 'contact_slideshare' ) ) {
			$slideshare = '<li><a href="' . esc_url( bt_get_option( 'contact_slideshare' ) ) . '" data-icon="&#xf1e7;"></a></li>';
		}
		$instagram = '';
		if ( bt_get_option( 'contact_instagram' ) ) {
			$instagram = '<li><a href="' . esc_url( bt_get_option( 'contact_instagram' ) ) . '" data-icon="&#xf16d;"></a></li>';
		}		
		$youtube = '';
		if ( bt_get_option( 'contact_youtube' ) ) {
			$youtube = '<li><a href="' . esc_url( bt_get_option( 'contact_youtube' ) ) . '" data-icon="&#xf167;"></a></li>';
		}
		$vimeo = '';
		if ( bt_get_option( 'contact_vimeo' ) ) {
			$vimeo = '<li><a href="' . esc_url( bt_get_option( 'contact_vimeo' ) ) . '" data-icon="&#xf194;"></a></li>';
		}
		
		$custom_text = '';
		if ( bt_get_option( 'custom_text' ) ) {
			$custom_text = bt_get_option( 'custom_text' );
		}
		
		$social_html = '';
		if ( $facebook != '' || $twitter != '' || $google_plus != '' || $linkedin != '' || $pinterest != '' || $vk != '' || $slideshare != '' || $instagram != '' || $youtube != '' || $vimeo != '' ) {
			$social_html = $facebook . $twitter . $google_plus . $linkedin . $pinterest . $vk . $slideshare . $instagram . $youtube . $vimeo;
		}
		
		$lang_selector = '';
		if ( function_exists( 'icl_get_languages' ) ) {
		$lang_arr = icl_get_languages( 'skip_missing=0&orderby=code' );
			if ( count( $lang_arr > 1 ) ) {
				$lang_selector = '<li class="lang">';

				foreach ( $lang_arr as $key => $lang ) {
					if ( $lang['active'] == 1 ) {
						$lang_selector .= '<a href="#">' . strtoupper( $lang['language_code'] ) . '</a>';
						unset ( $lang_arr[ $key ] );
						break;
					}
				}
				
				$lang_selector .= '<ul>';
				foreach ( $lang_arr as $key => $lang ) {
					$lang_selector .= '<li><a href="' . esc_url( $lang['url'] ) . '">' . strtoupper( $lang['language_code'] ) . '</a></li>';
				}
				$lang_selector .= '</ul>';
				$lang_selector .= '</li>';
			}
		}		
		
	?> 
	
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta charset="utf-8">

	<?php
		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		$centered_logo_class = '';
		if ( bt_get_option( 'centered_logo' ) ) {
			$centered_logo_class = ' btr boldTwoRow';
		}

		wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="pageWrap">
	<header class="mainHeader<?php echo $centered_logo_class; ?>">
		<div class="blackBar">
			<div class="logo"><?php bt_logo(); ?></div>
			
			<div class="socNtools <?php if ( $show_social ) echo 'showSocial'; ?>">
				<span class="toolsToggler"></span>
				<ul class="standAlone">
					<?php if ( $show_social ) echo '<span>' . $social_html . '</span>'; ?>
					<li class="search"><a href="#" data-icon="&#xf002;"></a></li>
				</ul>
				<ul class="sntList">
					<?php echo $social_html; ?>
				</ul>
			</div><!-- /socNtools -->
			<nav class="mainNav" role="navigation">
				<ul>
					<?php
						wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '%3$s', 'container' => '', 'depth' => 3, 'fallback_cb' => false ));
					?>
				</ul>
			</nav>
		</div><!-- /blackBar -->
	</header><!-- /mainHeader -->

		<div class="ssPort" role="search">
			<span class="closeSearch"></span>
			<form action="/" method="get">
				<input type="text" name="s" value="<?php _e( 'Search term...', 'bt_theme' ); ?>">
			</form>
		</div><!-- /ssPort -->
	
	<?php
	
	if ( ( is_front_page() && bt_get_option( 'slider' ) ) || ( isset( $_GET['slider'] ) && $_GET['slider'] != '' ) ) {
		global $bt_home_slider;
		$bt_home_slider = true;
		get_template_part( 'php/slider' ); 
	}