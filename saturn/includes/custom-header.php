<?php
/**
 * Custom header
 */
if( !function_exists('saturn_custom_header_setup') ){
	function saturn_custom_header_setup() {
		add_theme_support( 'custom-header', apply_filters( 'saturn_custom_header_args', array(
			'default-text-color'     => '000',
			'width'                  => 120,
			'height'                 => 35,
			'flex-height'            => true,
			'flex-width'             => true,
			'header-text'			 =>	false,
			'wp-head-callback'       => 'saturn_header_style',
			'admin-head-callback'    => 'saturn_admin_header_style',
			'admin-preview-callback' => 'saturn_admin_header_image',
		) ) );
	}
	add_action( 'after_setup_theme', 'saturn_custom_header_setup' );	
}

if ( ! function_exists( 'saturn_header_style' ) ) {
	function saturn_header_style() {
		$text_color = get_header_textcolor();
	
		// If no custom color for text is set, let's bail.
		if ( display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
			return;
	
		// If we get this far, we have custom styles.
		?>
		<style type="text/css" id="neat-header-css">
		<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
		?>
			.appearance_page_custom-header .site-title,
			.appearance_page_custom-header .site-description {
				clip: rect(1px 1px 1px 1px); /* IE7 */
				clip: rect(1px, 1px, 1px, 1px);
				position: absolute;
			}
		<?php
			// If the user has set a custom color for the text, use that.
			elseif ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) :
		?>
			.appearance_page_custom-header .site-title a {
				color: #<?php echo esc_attr( $text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
}

if ( ! function_exists( 'saturn_admin_header_style' ) ){
	function saturn_admin_header_style() {
		?>
		<style type="text/css" id="admin-header-css">
		.appearance_page_custom-header #headimg {
			background-color: #222;
			border: none;
			max-width: 1260px;
			min-height: 48px;
			padding: 16px 0 0px 0;
		}
		.appearance_page_custom-header #headimg h1 {
			font-size: 35px;
			font-family: Roboto Slab;
			color: #000;
			line-height: 47px;	
		}
		.appearance_page_custom-header #headimg img {
			vertical-align: middle;
		}
		</style>
	<?php
	}
}

if ( ! function_exists( 'saturn_admin_header_image' ) ) {
	function saturn_admin_header_image() {
		?>
		<div id="headimg">
			<?php if ( get_header_image() ) : ?>
				<img src="<?php header_image(); ?>" alt="<?php print apply_filters( 'saturn_sub_heading_text' , get_bloginfo( 'description' ));?>">
			<?php endif; ?>
		</div>
	<?php
	}
}