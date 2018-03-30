<?php
/* spot theme's post type */
function is_retro_post_type() {
	return strpos( get_post_type(), 'portfolio-' ) !== false;
}

/* spot theme's post type page */
function get_retro_post_type_page() {
	return str_replace( 'portfolio-', null, get_post_type() );
}

/* get homepage page */
function get_retro_home_page() {
	$arr = get_pages( array( 'number' => 1, 'meta_key' => '_wp_page_template', 'meta_value' => 'template-home.php' ) );
	return end( $arr );
}

/* get portfolio pages list */
function get_retro_portfolio_pages() {
	return get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'template-portfolio.php' ) );
}

/* get theme's good stuff */
function get_retro_list( $name, $id ) {
	$meta = get_post_meta( $id, 'slider', true );
	return isset( $meta[ 'list' ] ) ? json_decode( $meta[ 'list' ] ) : array();
}

/* get attachment address */
function retro_get_media_url( $id, $size ) {
	echo esc_url( ( $i = wp_get_attachment_image_src( $id, $size ) ) && is_array( $i ) ? reset( $i ) : null );
}

/* get background color */
function retro_get_background_color( $post ) {
	$hex = op_theme_opt( 'background-color' );
	if ( $id = isset( $post->ID ) ? $post->ID : ( is_numeric( $post ) ? $post : null ) ) {
		$meta = get_post_meta( $id, 'layout', true );
		if ( isset( $meta['background-color'] ) )
			$hex = $meta['background-color'];
	}
	else if ( is_retro_post_type() ) {
		$meta = get_post_meta( get_retro_post_type_page(), 'layout', true );
		if ( isset( $meta['background-color'] ) )
			$hex = $meta['background-color'];
	}
	return $hex;	
}

/* light/dark text color */
function retro_text_color( $post ) {
	$lightColor = '';
	if ( $id = isset( $post->ID ) ? $post->ID : ( is_numeric( $post ) ? $post : null ) ) {
		$meta = get_post_meta( $id, 'layout', true );
		if ( isset( $meta['light-text'] ) ) {
			$lightColor = 'light-text';
		} else {
			$lightColor = '';
		}
	}
	else if ( is_retro_post_type() ) {
		$meta = get_post_meta( get_retro_post_type_page(), 'layout', true );
		if ( isset( $meta['light-text'] ) ) {
			$lightColor = 'light-text';
		} else {
			$lightColor = '';
		}
	}
	return $lightColor;	
}

/* get icons background color */
function retro_get_icons_background_color( $post ) {
	$hex = op_theme_opt( 'icons-bg-color' );
	if ( $id = isset( $post->ID ) ? $post->ID : ( is_numeric( $post ) ? $post : null ) ) {	
		$meta = get_post_meta( $id, 'about', true );
		if ( isset( $meta['icons-bg-color'] ) )
			$hex = $meta['icons-bg-color'];
	}
	return $hex;	
}

/* converts hex to rgba */
function retro_hex_to_rgba( $hex, $opacity ) {
	$hex = preg_match( '/^#?([a-h0-9]{2})([a-h0-9]{2})([a-h0-9]{2})$/i', $hex, $format );
	echo 'rgba( ' . hexdec( $format[1] ) . ', ' . hexdec( $format[2] ) . ', ' . hexdec( $format[3] ) . ', ' . $opacity . ' )';
}

/* get headlines */
function retro_get_headline( $post ) {
	if ( $id = isset( $post->ID ) ? $post->ID : ( is_numeric( $post ) ? $post : null ) ) {
		$meta = get_post_meta( $id, 'headline', true );
		if ( isset( $meta['headline'] ) ) {
			$headline = $meta['headline'];
		} else {
			$headline = '';
		}
	}
	else if ( is_retro_post_type() ) {
		$meta = get_post_meta( get_retro_post_type_page(), 'headline', true );
		if ( isset( $meta['headline'] ) ) {
			$headline = $meta['headline'];
		} else {
			$headline = '';
		}
	}
	return $headline;
}

/* get ribbon */
function retro_get_ribbon( $post ) {
	if ( $id = isset( $post->ID ) ? $post->ID : ( is_numeric( $post ) ? $post : null ) ) {
		$meta = get_post_meta( $id, 'headline', true );
		if ( isset( $meta['headline'] ) ) {
			$headline  = '<div class="ribbon">';
			$headline .= '<span class="dots dot1"></span>';
			$headline .= '<span class="dots dot2"></span>';
			$headline .= '<span class="dots dot3"></span>';
			$headline .= '<span class="dots dot4"></span>';
			$headline .= '<span class="dots dot5"></span>';
			$headline .= '<span class="dots dot6"></span>';
			$headline .= '<span class="dots dot7"></span>';
			$headline .= '<span class="dots dot8"></span>';	
			$headline .= '<h3 class="ribbon-content">';		
			$headline .= '<span>';			
			$headline .= $meta['headline'];
			$headline .= '</span>';
			$headline .= '</h3>';
			$headline .= '</div>';
		}
	}
	return $headline;
}

/* get google font name */
function retro_get_font_name( $url = null ) {
	return preg_replace( array( '!^http://fonts.googleapis.com/css\?!', '!(family=[^&:]+).*$!', '!family=!', '!\+!' ), array( '', '$1', '', ' ' ), $url );
}

/* get social links */
function retro_get_social_links() {
	$target = '';
	if ( op_theme_opt( 'social-link-new-window' ) ) {
		$target = ' target="_blank"';
	}

	$social = '<ul>';
	if ( $i = op_theme_opt( 'twitter' ) )
		$social .= '<li><a href="' . esc_url( $i ) . '"' . $target . '><span class="icon retroicon-twitter"></span></a></li>';
	if ( $i = op_theme_opt( 'facebook' ) )
		$social .= '<li><a href="' . esc_url( $i ) . '"' . $target . '><span class="icon retroicon-facebook"></span></a></li>';
	if ( $i = op_theme_opt( 'google-plus' ) )
		$social .= '<li><a href="' . esc_url( $i ) . '"' . $target . '><span class="icon retroicon-gplus"></span></a></li>';
	if ( $i = op_theme_opt( 'pinterest' ) )
		$social .= '<li><a href="' . esc_url( $i ) . '"' . $target . '><span class="icon retroicon-pinterest"></span></a></li>';
	if ( $i = op_theme_opt( 'linkedin' ) )
		$social .= '<li><a href="' . esc_url( $i ) . '"' . $target . '><span class="icon retroicon-linkedin"></span></a></li>';
	if ( $i = op_theme_opt( 'dribbble' ) )
		$social .= '<li><a href="' . esc_url( $i ) . '"' . $target . '><span class="icon retroicon-dribbble"></span></a></li>';
	if ( $i = op_theme_opt( 'flickr' ) )
		$social .= '<li><a href="' . esc_url( $i ) . '"' . $target . '><span class="icon retroicon-flickr"></span></a></li>';
	if ( $i = op_theme_opt( 'tumblr' ) )
		$social .= '<li><a href="' . esc_url( $i ) . '"' . $target . '><span class="icon retroicon-tumblr"></span></a></li>';
	if ( $i = op_theme_opt( 'youtube' ) )
		$social .= '<li><a href="' . esc_url( $i ) . '"' . $target . '><span class="icon retroicon-youtube"></span></a></li>';
	if ( $i = op_theme_opt( 'instagram' ) )
		$social .= '<li><a href="' . esc_url( $i ) . '"' . $target . '><span class="icon retroicon-instagram"></span></a></li>';
	if ( $i = op_theme_opt( 'skype' ) )
		$social .= '<li><a href="' . $i . '"><span class="icon retroicon-skype"></span></a></li>';
	if ( $i = op_theme_opt( 'dropbox' ) )
		$social .= '<li><a href="' . esc_url( $i ) . '"' . $target . '><span class="icon retroicon-dropbox"></span></a></li>';
	if ( $i = op_theme_opt( 'github' ) )
		$social .= '<li><a href="' . esc_url( $i ) . '"' . $target . '><span class="icon retroicon-github-1"></span></a></li>';
	if ( $i = op_theme_opt( 'behance' ) )
		$social .= '<li><a href="' . esc_url( $i ) . '"' . $target . '><span class="icon retroicon-behance"></span></a></li>';
	if ( $i = op_theme_opt( 'vimeo' ) )
		$social .= '<li><a href="' . esc_url( $i ) . '"' . $target . '><span class="icon retroicon-vimeo"></span></a></li>';
	$social .= '</ul>';
	return $social;
}

?>