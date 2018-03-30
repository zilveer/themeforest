<?php
/**
 * The functions of theme
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */

// plugin managment system
include dirname(__FILE__) . '/yiw-plugin.php';

// default theme setup
function yiw_theme_setup() {
    global $wp_version;

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( 'css/editor-style.css' );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// This theme uses the menues
	add_theme_support( 'menus' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
    // Title tag
    add_theme_support( "title-tag" );

    add_theme_support( 'custom-logo', array(
        'height'      => 15,
        'width'       => 133,
        'flex-height' => true,
    ) );

	// Post Format support.
	//add_theme_support( 'post-formats', array( 'aside', 'gallery' ) ); // Your changeable header business starts here
	if ( ! defined( 'HEADER_TEXTCOLOR' ) )
		define( 'HEADER_TEXTCOLOR', '' );

	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	if ( ! defined( 'HEADER_IMAGE' ) )
		define( 'HEADER_IMAGE', '%s/images/slider/001.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'yiw_header_image_width', 960 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'yiw_header_image_height', 338 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	//set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	if ( ! defined( 'NO_HEADER_TEXT' ) )
		define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyten_admin_header_style(), below.
    if( version_compare( $wp_version, '3.4', ">=" ) )
        add_theme_support( 'custom-header', array( 'admin-head-callback' => 'yiw_admin_header_style' ) );
    else
        add_custom_image_header( '', 'yiw_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'design1' => array(
			'url' => '%s/images/slider/001.jpg',
			'thumbnail_url' => '%s/images/slider/thumb/001.jpg',
			/* translators: header image description */
			'description' => __( 'Design', 'yiw' ) . ' 1'
		),
		'design2' => array(
			'url' => '%s/images/slider/002.jpg',
			'thumbnail_url' => '%s/images/slider/thumb/002.jpg',
			/* translators: header image description */
			'description' => __( 'Design', 'yiw' ) . ' 2'
		),
		'design3' => array(
			'url' => '%s/images/slider/003.jpg',
			'thumbnail_url' => '%s/images/slider/thumb/003.jpg',
			/* translators: header image description */
			'description' => __( 'Design', 'yiw' ) . ' 3'
		),
		'design4' => array(
			'url' => '%s/images/slider/004.jpg',
			'thumbnail_url' => '%s/images/slider/thumb/004.jpg',
			/* translators: header image description */
			'description' => __( 'Design', 'yiw' ) . ' 4'
		),
		'design5' => array(
			'url' => '%s/images/slider/005.jpg',
			'thumbnail_url' => '%s/images/slider/thumb/005.jpg',
			/* translators: header image description */
			'description' => __( 'Design', 'yiw' ) . ' 5'
		),
	) );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in more locations.
	register_nav_menus(
        array(
            'nav'           => __( 'Navigation' ),
            'linksbar'      => __( 'Links Bar' ),
            'footer-nav'    => __( 'Footer Navigation' )
        )
    );

    // images size
    if ( function_exists( 'yiw_shop_large_w' ) && function_exists( 'yiw_shop_large_h' ) )
        add_image_size( 'shop_large_image', yiw_shop_large_w(), yiw_shop_large_h(), 'true' );
    add_image_size( 'blog_big'      , 640, 295, true );
    add_image_size( 'blog_small'    , 295, 295, true );
    add_image_size( 'thumb_recentposts'     , 55, 55, true );
    add_image_size( 'thumb_testimonial'     , 78, 78, true );
    add_image_size( 'thumb_testimonial'     , 147, 147, true );

    // sidebars registers
	register_sidebar( yiw_sidebar_args( 'Blog Sidebar', __( 'The sidebar shown on page with Blog template or on Home Page set with posts', 'yiw' ) ) );
	register_sidebar( yiw_sidebar_args( 'Shop Sidebar', __( 'The sidebar for all shop pages', 'yiw' ) ) );
	register_sidebar( yiw_sidebar_args( 'Footer Main', __( 'The footer main section.', 'yiw' ), 'widget', 'h3' ) );
	if ( yiw_get_option( 'footer_layout' ) != 'no-sidebar' )
		register_sidebar( yiw_sidebar_args( 'Footer Sidebar', __( 'The footer main section.', 'yiw' ), 'widget', 'h3' ) );

	// add sidebar created from plugin
	$sidebars = maybe_unserialize( yiw_get_option( 'sidebars' ) );
    if( is_array( $sidebars ) && ! empty( $sidebars ) )
    {
        foreach( $sidebars as $sidebar )
        {
            register_sidebar( yiw_sidebar_args( $sidebar, '', 'widget', 'h3' ) );
        }
    }
}

global $woocommerce;
if ( ! function_exists( 'is_plugin_active' ) )
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( is_plugin_active( 'jigoshop/jigoshop.php' ) )
    include 'jigoshop.php';
elseif ( isset( $woocommerce ) )
   include 'woocommerce.php';

// decide the layout of the theme, changing the class of body
function yiw_theme_layout_body_class( $classes ) {
	$classes[] = yiw_get_option( 'theme_layout' ) . '-layout';
	return $classes;
}
add_filter( 'body_class', 'yiw_theme_layout_body_class' );

// decide the layout of the theme, changing the class of body
function yiw_actual_font_body_class( $classes ) {
	$classes[] = yiw_get_option( 'font' ) . '-font';
	return $classes;
}
add_filter( 'body_class', 'yiw_actual_font_body_class' );

// add the font for the logo
function yiw_logo_font() {

	if ( is_admin() )
		return;

	$_logo_image = yiw_get_option( 'show_image_logo' );

	$logo_text = wptexturize( get_bloginfo( 'name' ) );

	if ( ! $_logo_image ) {
		wp_enqueue_style( 'Lobster-google-font', 'http://fonts.googleapis.com/css?family=Lobster&text=' . $logo_text );
	}
}
add_action( 'wp_print_styles', 'yiw_logo_font' );

function yiw_logo_cufon() {
	?>
	<script type="text/javascript">
		Cufon.replace( '#logo .logo-title', { fontFamily: 'Lobster', textShadow: '3px 3px 10px rgba(0,0,0,0.75)' } );
	</script>
	<?php
}



if ( ! function_exists( 'yiw_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 * @since Twenty Ten 1.0
 */
function yiw_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;


/**
 * Add style of body
 *
 * @since 1.0
 */
function yiw_body_style() {

// 	if ( yiw_get_option( 'theme_layout' ) != 'boxed' )
// 		return;

	$role = '';

	$bg_type = yiw_get_option( 'body_bg_type' );
	$color_bg = yiw_get_option( 'body_bg_color' );

	switch ( $bg_type ) {

		case 'color-unit' :
			$role = 'background:' . $color_bg . ';';
			break;

		case 'bg-image' :
			$image = yiw_get_option( 'body_bg_image', 'custom' );

            if ( yiw_get_option( 'theme_layout' ) == 'stretched' )
                $image = 'custom';

			// image
			if ( $image != 'custom' ) {
				$url_image = get_template_directory_uri() . '/' . $image;
				$position = 'top center';
				$repeat = 'repeat';
				$attachment = 'fixed';
			} else {
				$url_image = esc_url( yiw_get_option( 'body_bg_image_custom', '' ) );
				$position = yiw_get_option( 'body_bg_image_custom_position' );
				$repeat = yiw_get_option( 'body_bg_image_custom_repeat' );
				$attachment = yiw_get_option( 'body_bg_image_custom_attachment' );
			}

			if ( $url_image != '' )
			    $url_image = " url('$url_image')";

			$attrs = array(
                "background-color: $color_bg",
                "background-image: $url_image",
                "background-position: $position",
                "background-repeat: $repeat",
                "background-attachment: $attachment"
            );

			$role = implode( ";\n", $attrs );
			break;

	}
?>
body, .stretched-layout .bgWrapper {
	<?php echo $role ?>
}
<?php
}
add_action( 'yiw_custom_styles', 'yiw_body_style' );


/**
 * Add style of header
 *
 * @since 1.0
 */
function yiw_header_style() {
	$role = '';

	$bg_type = yiw_get_option( 'header_bg_type' );
	$color_bg = yiw_get_option( 'header_bg_color' );

	switch ( $bg_type ) {

		case 'color-unit' :
			$role = 'background:' . $color_bg . ';';
			break;

		case 'bg-image' :
			$image = yiw_get_option( 'header_bg_image' );

			// image
			if ( $image != 'custom' ) {
				$url_image = get_template_directory_uri() . '/' . $image;
				$position = 'top center';
				$repeat = 'no-repeat';
			} else {
				$url_image = esc_url( yiw_get_option( 'header_bg_image_custom' ) );
				$position = yiw_get_option( 'header_bg_image_custom_position' );
				$repeat = yiw_get_option( 'header_bg_image_custom_repeat' );
			}


			$role = 'background:' . $color_bg . ' url(\'' . $url_image . '\') ' . $repeat . ' ' . $position . ';';
			break;

	}
?>
#header {
	<?php echo $role ?>
}
<?php
}
add_action( 'yiw_custom_styles', 'yiw_header_style' );


/**
 * Add style of body
 *
 * @since 1.1.1
 */
function yiw_content_style() {

	if ( yiw_get_option( 'theme_layout' ) != 'boxed' )
		return;

	$color_bg = yiw_get_option( 'content_bg_color' );

	if ( $color_bg == '' || $color_bg == '#fff' || $color_bg == '#ffffff' )
	   return;

?>
.boxed-layout .bgWrapper, .rm_container ul li {
	background-color: <?php echo $color_bg ?>;
}
<?php
}
add_action( 'yiw_custom_styles', 'yiw_content_style' );


/** SLIDERS
-------------------------------------------------------------------- */

/**
 * vars for elegant slider
 */
function yiw_slider_elegant_scripts() {
	if ( ! yiw_can_show_slider() || yiw_slider_type() != 'elegant' )
		return;

	$easing = ( $eas = yiw_slide_get('easing') ) ? "'$eas'" : 'null';
	?>
	<script type="text/javascript">
		var 	yiw_slider_type = 'elegant',
                yiw_slider_elegant_easing = <?php echo $easing ?>,
				yiw_slider_elegant_fx = '<?php yiw_slide_the('effect') ?>',
				yiw_slider_elegant_speed = <?php echo yiw_slide_get('speed') * 1000 ?>,
				yiw_slider_elegant_timeout = <?php echo yiw_slide_get('timeout') * 1000 ?>,
				yiw_slider_elegant_caption_speed = <?php echo yiw_slide_get('caption_speed') * 1000 ?>;
    </script>
	<?php
}

/**
 * vars for thumbnails slider
 */
function yiw_slider_thubmnails_scripts() {
	if ( ! yiw_can_show_slider() || yiw_slider_type() != 'thumbnails' )
		return;

    $width = yiw_slide_get('width');
	$height = yiw_slide_get('height');

	if ( empty( $width ) )  $width  = 960;
	if ( empty( $height ) ) $height = 350;
	?>
	<script type="text/javascript">
		var 	yiw_slider_type = 'thumbnails',
                yiw_slider_thumbnails_width = '<?php yiw_slide_the('width') ?>',
                yiw_slider_thumbnails_height = '<?php yiw_slide_the('height') ?>',
                yiw_slider_thumbnails_fx = '<?php yiw_slide_the('effect') ?>',
				yiw_slider_thumbnails_speed = <?php echo yiw_slide_get('speed') * 1000 ?>,
				yiw_slider_thumbnails_timeout = <?php echo yiw_slide_get('timeout') * 1000 ?>;
    </script>
	<?php
}

/**
 * vars for elegant slider
 */
function yiw_slider_rotating_scripts() {
	if ( ! yiw_can_show_slider() || yiw_slider_type() != 'rotating' )
		return;

	$easing = ( $eas = yiw_slide_get('easing') ) ? "'$eas'" : 'null';
	?>
	<script type="text/javascript">
		var 	yiw_slider_type = 'rotating',
                yiw_slider_rotating_npanels = <?php echo yiw_slide_get('n_panels' ) * 1000 ?>,
				yiw_slider_rotating_timeDiff = <?php echo yiw_slide_get('speed1' ) * 1000 ?>,
				yiw_slider_rotating_slideshowTime = <?php echo yiw_slide_get('speed2' ) * 1000 ?>;
    </script>
	<?php
}


/**
 * vars for cycle slider
 */
function yiw_slider_cycle_scripts() {
    if ( ! yiw_can_show_slider() || yiw_slider_type() != 'cycle' )
        return;

    $easing = ( $eas = yiw_slide_get('easing') ) ? "'$eas'" : 'null';
    ?>
    <script type="text/javascript">
        var     yiw_slider_type = 'cycle',
                yiw_slider_cycle_easing = <?php echo $easing ?>,
                yiw_slider_cycle_fx = '<?php yiw_slide_the('effect') ?>',
                yiw_slider_cycle_speed = <?php echo yiw_slide_get('speed') * 1000 ?>,
                yiw_slider_cycle_timeout = <?php echo yiw_slide_get('timeout') * 1000 ?>;
    </script>
    <?php
}



/**
 * vars for nivo slider
 */
function yiw_slider_nivo_scripts() {
    if ( ! yiw_can_show_slider() || yiw_slider_type() != 'nivo' )
        return;
    ?>
    <script type="text/javascript">
        var     yiw_slider_type = 'nivo',
                yiw_slider_nivo_fx = '<?php yiw_slide_the('effect') ?>',
                yiw_slider_nivo_speed = <?php echo yiw_slide_get('speed') * 1000 ?>,
                yiw_slider_nivo_timeout = <?php echo yiw_slide_get('timeout') * 1000 ?>,
                yiw_slider_nivo_directionNav = <?php echo yiw_slide_get('directionNav') ? 'true' : 'false'; ?>,
                yiw_slider_nivo_directionNavHide = <?php echo yiw_slide_get('directionNavHide') ? 'true' : 'false'; ?>,
                yiw_slider_nivo_controlNav = <?php echo yiw_slide_get('controlNav') ? 'true' : 'false'; ?>;
    </script>
    <?php
}


add_action( 'wp_print_scripts', 'yiw_slider_cycle_scripts' );
add_action( 'wp_print_scripts', 'yiw_slider_nivo_scripts' );
add_action( 'wp_print_scripts', 'yiw_slider_rotating_scripts' );
add_action( 'wp_print_scripts', 'yiw_slider_elegant_scripts' );
add_action( 'wp_print_scripts', 'yiw_slider_thubmnails_scripts' );


/** ADMIN
-------------------------------------------------------------------- */

// add new type to theme options
function yiw_select_with_header_preview( $value ) {

	if ( isset( $value['id'] ) )
		$id_container = 'id="' . $value['id'] . '-option" ';

	// deps
    if ( isset( $value['deps'] ) ) {
    	$value['deps']['id_input'] = yiw_option_id( $value['deps']['id'], false );
    	$deps[ $value['id'] ] = $value['deps'];
    	$class_dep = ' yiw-deps';
    	$fade_color_dep = '<div class="fade_color"></div>';
    }
    ?>

        <div <?php echo $id_container ?>class="rm_option rm_input rm_select<?php echo $class_dep ?> rm_with_preview">
            <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>

            <select name="<?php yiw_option_name( $value['id'] ); ?>" id="<?php yiw_option_id( $value['id'] ); ?>" <?php if( isset( $value['button'] ) ) : ?>style="width:240px;" <?php endif ?>>
                <?php foreach ($value['options'] as $val => $option) { ?>
                    <option value="<?php echo $val ?>" <?php selected( yiw_get_option( $value['id'], $value['std'] ), $val ) ?>><?php echo $option; ?></option>
                <?php } ?>
            </select>

			<?php if( isset( $value['button'] ) ) : ?>
			<input type="submit" value="<?php echo $value['button']; ?>" class="button" name="<?php yiw_option_id( $value['id'] ); ?>_save" id="<?php yiw_option_id( $value['id'] ); ?>_save">
			<?php endif ?>

            <small><?php echo $value['desc']; ?></small>
            <div class="clearfix"></div>
            <?php $style = ( $value['std'] == 'custom' ) ? ' style="display:none;"' : ''; ?>
            <div class="preview"<?php echo $style ?>><img class="min" src="<?php echo get_template_directory_uri() . '/' . yiw_get_option( $value['id'], $value['std'] ) ?>" title="<?php _e( 'Click to expand the image to the natural size', 'yiw' ) ?>" /></div>
            <script type="text/javascript">
            	jQuery(document).ready(function($){
					var select = $('#<?php yiw_option_id( $value['id'] ); ?>');
					var preview = $('#<?php echo $value['id'] ?>-option .preview');

					var change_preview = function(){
						var value = select.val();
						if ( value != 'custom' ) {
							preview.find('img').attr('src', '<?php echo get_template_directory_uri() . '/'; ?>'+value);
						    preview.show();
						} else {
							preview.hide();
						}
					};

					select.change(change_preview).keypress(change_preview);

					preview.find('img').click(function(){
						$(this).toggleClass('min');
						if ( $(this).hasClass('min') )
							$(this).attr('title', '<?php _e( 'Click to expand the image to the natural size', 'yiw' ) ?>');
						else
							$(this).attr('title', '<?php _e( 'Click to minimize the image', 'yiw' ) ?>');
					});
				});
            </script>
        </div>

    <?php
}
add_action( 'yiw_panel_type_header_preview', 'yiw_select_with_header_preview' );

// add new type to theme options
function yiw_select_with_bg_preview( $value ) {

	if ( isset( $value['id'] ) )
		$id_container = 'id="' . $value['id'] . '-option" ';

	// deps
    if ( isset( $value['deps'] ) ) {
    	$value['deps']['id_input'] = yiw_option_id( $value['deps']['id'], false );
    	$deps[ $value['id'] ] = $value['deps'];
    	$class_dep = ' yiw-deps';
    	$fade_color_dep = '<div class="fade_color"></div>';
    }
    ?>

        <div <?php echo $id_container ?>class="rm_option rm_input rm_select<?php echo $class_dep ?> rm_with_preview rm_with_bg_preview">
            <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>

            <select name="<?php yiw_option_name( $value['id'] ); ?>" id="<?php yiw_option_id( $value['id'] ); ?>" <?php if( isset( $value['button'] ) ) : ?>style="width:240px;" <?php endif ?>>
                <?php foreach ($value['options'] as $val => $option) { ?>
                    <option value="<?php echo $val ?>" <?php selected( yiw_get_option( $value['id'], $value['std'] ), $val ) ?>><?php echo $option; ?></option>
                <?php } ?>
            </select>

			<?php if( isset( $value['button'] ) ) : ?>
			<input type="submit" value="<?php echo $value['button']; ?>" class="button" name="<?php yiw_option_id( $value['id'] ); ?>_save" id="<?php yiw_option_id( $value['id'] ); ?>_save">
			<?php endif ?>

            <small><?php echo $value['desc']; ?></small>
            <div class="clearfix"></div>

            <?php
				$url = get_template_directory_uri().'/'.yiw_get_option( $value['id'], $value['std'] );
				$color = yiw_get_option( $value['id_colors'] );

				$style = array(
					"background-color:$color;",
					"background-image:url('$url');",
					"background-position:top center;"
				);
				$style = implode( '', $style );

				$style_preview = ( yiw_get_option( $value['id'], $value['std'] ) == 'custom' ) ? ' style="display:none"' : '';
			?>

            <div class="preview"<?php echo $style_preview ?>><div class="img" style="<?php echo $style ?>"></div></div>
            <script type="text/javascript">
            	jQuery(document).ready(function($){
					var select = $('#<?php yiw_option_id( $value['id'] ); ?>');
					var text_color = $('#<?php yiw_option_id( $value['id_colors'] ); ?>');
					var preview = $('#<?php echo $value['id'] ?>-option .preview');

					preview.css('cursor', 'pointer').attr('title', '<?php _e( 'Click here to update the color selected above', 'yiw' ) ?>');

					select.change(function(){
						var value = $(this).val();
						if ( value != 'custom' ) {
							$('.img', preview).css({'background-image':'url(<?php echo get_template_directory_uri() . '/'; ?>'+value+')'});
						    preview.show();
						} else {
							preview.hide();
						}
					});

					preview.click(function(){
						var value = text_color.val();
						$('.img', preview).css({'background-color':value});
					});
				});
            </script>
        </div>

    <?php
}
add_action( 'yiw_panel_type_bg_preview', 'yiw_select_with_bg_preview' );

// add new type to theme options
function yiw_size_inputs( $value ) {

	if ( isset( $value['id'] ) )
		$id_container = 'id="' . $value['id'] . '-option" ';

	// deps
    if ( isset( $value['deps'] ) ) {
    	$value['deps']['id_input'] = yiw_option_id( $value['deps']['id'], false );
    	$deps[ $value['id'] ] = $value['deps'];
    	$class_dep = ' yiw-deps';
    	$fade_color_dep = '<div class="fade_color"></div>';
    }

    $s = maybe_unserialize( yiw_get_option( $value['id'], serialize( $value['std'] ) ) );
    ?>

        <div <?php echo $id_container ?>class="rm_option rm_input rm_text<?php echo $class_dep ?>">
            <label for="<?php yiw_option_id( $value['id'] ); ?>_w"><?php echo $value['name']; ?></label>
            <input name="<?php yiw_option_name( $value['id'] ); ?>[w]"
				   id="<?php yiw_option_id( $value['id'] . '_w' ); ?>"
				   type="text"
				   value="<?php echo $s['w']; ?>"
				   style="width:40px;" /> x
            <input name="<?php yiw_option_name( $value['id'] ); ?>[h]"
				   id="<?php yiw_option_id( $value['id'] . '_h' ); ?>"
				   type="text"
				   value="<?php echo $s['h']; ?>"
				   style="width:40px;" /> px

			<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
        </div>

    <?php
}
add_action( 'yiw_panel_type_size_inputs', 'yiw_size_inputs' );

function yiw_select_skin_option_type( $value ) {
    if ( isset( $value['id'] ) )
    		$id_container = 'id="' . $value['id'] . '-option" ';
    ?>

        <div <?php echo $id_container ?>class="rm_option rm_input rm_select">
            <label for="<?php yiw_option_id( $value['id'] ); ?>"><?php echo $value['name']; ?></label>

            <select name="<?php yiw_option_name( $value['id'] ); ?>" id="<?php yiw_option_id( $value['id'] ); ?>" <?php if( isset( $value['button'] ) ) : ?>style="width:240px;" <?php endif ?>>
                <?php foreach ($value['options'] as $val => $option) { ?>
                    <option value="<?php echo $val ?>" <?php selected( yiw_get_option( $value['id'], $value['std'] ), $val ) ?>><?php echo $option; ?></option>
                <?php } ?>
            </select>

			<?php if( isset( $value['button'] ) ) : ?>
			<input type="submit" value="<?php echo $value['button']; ?>" class="button" name="<?php yiw_option_id( $value['id'] ); ?>_save" id="<?php yiw_option_id( $value['id'] ); ?>_save">
			<?php endif ?>

			<input type="hidden" name="yiw-callback-save" value="yiw_select_skins_option" />

            <small><?php echo $value['desc']; ?></small>
            <div class="clearfix"></div>
        </div>

    <?php
}
add_action( 'yiw_panel_type_select_skin', 'yiw_select_skin_option_type' );

function yiw_select_skins_option() {
    global $yiw_theme_options, $yiw_colors;

    $selected_skin = yiw_post_option( 'select_skin' );
    if( $selected_skin == '' || $selected_skin == yiw_get_option( 'select_skin' ) )
	   return;

	$tab = yiw_get_current_tab();

	$skin = array(
        'elegant' => array(
            'theme_layout' => 'stretched',
            'nav_type' => 'elegant',
            'slider_type' => 'elegant',
            'slider_choosen' => 'elegant',
            'slider_elegant_slides' => serialize( array(
                    array(
                            'order' => 0,
                            'slide_title' => 'interior design',
                            'tooltip_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pulvinar turpis velit. Morbi rutrum, neque non pulvinar faucibus, ligula eros viverra ligula, et aliquam libero neque ac nisl.

[special_font size="24"]prices from [size px="42"]$45[/size][/special_font]',
                            'content_type' => 'image',
                            'image_url' => get_template_directory_uri() . '/images/slider/001.jpg',
                            'link_type' => 'none'
                        ),
                        array(
                            'order' => 1,
                            'slide_title' => 'Luxury gold',
                            'tooltip_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pulvinar turpis velit. Morbi rutrum, neque non pulvinar faucibus, ligula eros viverra ligula, et aliquam libero neque ac nisl. ',
                            'content_type' => 'image',
                            'image_url' => get_template_directory_uri() . '/images/slider/002.jpg',
                            'link_type' => 'none'
                        ),
                        array(
                            'order' => 2,
                            'slide_title' => 'Gold Parquet',
                            'tooltip_content' => 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum

[special_font size="24"]prices from [size px="42"]$37[/size][/special_font]',
                            'content_type' => 'image',
                            'image_url' => get_template_directory_uri() . '/images/slider/003.jpg',
                            'link_type' => 'none'
                        ),
            ) ),
            'slider_elegant_effect' => 'fade',
            'slider_elegant_speed' => 0.5,
            'slider_elegant_timeout' => 5,
            'slider_elegant_caption_position' => 'right',
            'slider_elegant_caption_speed' => 0.5,
            'body_bg_color' => '#ffffff',
            'shop_title_position' => 'inside-thumb',
            'shop_border_thumbnail' => 1,
            'shop_shadow_thumbnail' => 1,
            'shop_show_price' => 0,
            'shop_show_button_details' => 0,
            'shop_show_button_add_to_cart' => 0,
            'colors_footer-color-links-hover' => '#1b1b1b',
            'colors_footer-color-menues-links-hover' => '#4d4d4d',
            'colors_store-products-offer-bg' => '#616263',
            'colors_store-products-offer-text' => '#fff',
            'header_bg_image' => 'images/headers/002.jpg',
            'header_bg_type' => 'bg-image',
            'font_logo' => array( 'type' => 'google-font', 'google-font' => 'Lobster' ),
            'font_title' => array( 'type' => 'google-font', 'google-font' => 'Yanone Kaffeesatz:400' ),
            'font_slogan' => array( 'type' => 'google-font', 'google-font' => 'Yanone Kaffeesatz:400' ),
            'font_paragraph' => array( 'type' => 'web-fonts', 'web-fonts' => "'Trebuchet MS', Helvetica, sans-serif" )
        ),
        'creative' => array(
            'theme_layout' => 'boxed',
            'nav_type' => 'creative',
            'slider_type' => 'thumbnails',
            'slider_choosen' => 'thumbnails',
            'slider_thumbnails_slides' => serialize( array(
                    array(
                            'order' => 0,
                            'slide_title' => 'interior design',
                            'tooltip_content' => 'Lorem ipsum dolor sit amet',
                            'content_type' => 'image',
                            'image_url' => get_template_directory_uri() . '/images/slider-thumbnails/001.jpg',
                            'link_type' => 'none'
                        ),
                        array(
                            'order' => 1,
                            'slide_title' => 'Luxury gold',
                            'tooltip_content' => '',
                            'content_type' => 'image',
                            'image_url' => get_template_directory_uri() . '/images/slider-thumbnails/002.jpg',
                            'link_type' => 'none'
                        ),
                        array(
                            'order' => 2,
                            'slide_title' => 'Gold Parquet',
                            'tooltip_content' => '',
                            'content_type' => 'image',
                            'image_url' => get_template_directory_uri() . '/images/slider-thumbnails/003.jpg',
                            'link_type' => 'none'
                        ),
            ) ),
            'slider_thumbnails_effect' => 'fade',
            'slider_thumbnails_speed' => 0.5,
            'slider_thumbnails_timeout' => 5,
            'content_bg_color' => '#fff',
            'header_bg_type' => 'bg-image',
            'header_bg_color' => '#0A1622',
            'header_bg_image' => 'images/headers/001.jpg',
            'colors_copyright-links-color' => '#335e86',
            'colors_general-color-links' => '#335e86',
            'colors_general-color-links-hover', '#3374b3',
            'shop_title_position' => 'below-thumb',
            'shop_border_thumbnail' => 1,
            'shop_shadow_thumbnail' => 0,
            'shop_show_price' => 1,
            'shop_show_button_details' => 1,
            'shop_show_button_add_to_cart' => 1,
            'colors_store-products-offer-bg' => '#B9B701',
            'colors_store-products-offer-text' => '#fff',
            'body_bg_type' => 'bg-image',
            'body_bg_image' => 'images/backgrounds/backgrounds/002.jpg',
            'font_logo' => array( 'type' => 'google-font', 'google-font' => 'Lobster' ),
            'font_title' => array( 'type' => 'google-font', 'google-font' => 'Yanone Kaffeesatz:400' ),
            'font_slogan' => array( 'type' => 'google-font', 'google-font' => 'Yanone Kaffeesatz:400' ),
            'font_paragraph' => array( 'type' => 'web-fonts', 'web-fonts' => "'Trebuchet MS', Helvetica, sans-serif" )
        ),
    );

    // the slides already existing
    $slides = maybe_unserialize( yiw_get_option( 'slider_'.$skin[$selected_skin]['slider_type'].'_slides' ) );

    // if there are already some images into the slider, doesn't add the default images
    if ( ! empty( $slides ) )
        unset( $skin[$selected_skin]['slider_'.$skin[$selected_skin]['slider_type'].'_slides'] );

    // retrieve the default color for the navigation
    foreach ( $yiw_colors[$skin[$selected_skin]['nav_type'].'-navigation']['options'] as $color_id => $value )
        $skin[$selected_skin]['colors_'.$color_id] = $value['default'];

    $yiw_theme_options = wp_parse_args( $skin[ $selected_skin ], $yiw_theme_options );

    // save the skin selected
    $yiw_theme_options['select_skin'] = $selected_skin;

    //yiw_debug( $yiw_theme_options );

	yiw_update_theme_options();

	$url = admin_url( 'themes.php' ) . "?page=$_GET[page]&tab=$tab&message=saved";
    yiw_end_process( $url );
    die;
}


/**
 * Return the page breadcrumbs
 *
 */
function yiw_breadcrumb() {
    //if ( is_page_with_breadcrumb() ) :

        $delimiter = ' &rsaquo; ';
        $home = 'Home Page'; // text for the 'Home' link
        $before = '<a class="no-link current" href="#">'; // tag before the current crumb
        $after = '</a>'; // tag after the current crumb

        if ( !is_home() && !is_front_page() || is_paged() ) {

            echo '<div id="crumbs" class="theme_breadcumb">';

            global $post;
            $homeLink = site_url();
            echo '<a class="home" href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

            if ( is_category() ) {
                global $wp_query;
                $cat_obj = $wp_query->get_queried_object();
                $thisCat = $cat_obj->term_id;
                $thisCat = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                if ( $thisCat->parent != 0 )
    echo get_category_parents( $parentCat, TRUE, ' ' . $delimiter . ' ' );
                echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;

            } elseif ( is_day() ) {
                echo '<a class="no-link" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                echo '<a class="no-link" href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
                echo $before . get_the_time('d') . $after;

            } elseif ( is_month() ) {
                echo '<a class="no-link" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                echo $before . get_the_time('F') . $after;

            } elseif ( is_year() ) {
                echo $before . get_the_time('Y') . $after;

            } elseif ( is_single() && !is_attachment() ) {
                if ( get_post_type() != 'post' ) {
    $post_type = get_post_type_object(get_post_type());
    $slug = $post_type->rewrite;
    echo '<a class="no-link" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
    echo $before . get_the_title() . $after;
                } else {
    $cat = get_the_category(); $cat = $cat[0];
    echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
    echo $before . get_the_title() . $after;
                }

            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;

            } elseif ( is_attachment() ) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID); $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                echo '<a class="no-link" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
                echo $before . get_the_title() . $after;

            } elseif ( is_page() && !$post->post_parent ) {
                echo $before . get_the_title() . $after;

            } elseif ( is_page() && $post->post_parent ) {
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                while ( $parent_id ) {
    $page = get_page($parent_id);
    $breadcrumbs[] = '<a class="no-link" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
    $parent_id  = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach ( $breadcrumbs as $crumb )
    echo $crumb . ' ' . $delimiter . ' ';
                echo $before . get_the_title() . $after;

            } elseif ( is_search() ) {
                echo $before . 'Search results for "' . get_search_query() . '"' . $after;

            } elseif ( is_tag() ) {
                echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

            } elseif ( is_author() ) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . 'Articles posted by ' . $userdata->display_name . $after;

            } elseif ( is_404() ) {
                echo $before . 'Error 404' . $after;
            }

            if ( get_query_var('paged') ) {
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
    echo ' (';
                echo $before . __('Page', 'yiw') . ' ' . get_query_var('paged') . $after;
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
    echo ')';
            }

            echo '<div class="breadcrumb-end"></div>';
            echo '</div>';

        }

    //endif;
}


/**
 * LOGIN PAGE
 */

function yiw_login_page_logo() {
    $logo = yiw_get_option( 'login_logo', '' );

    if ( empty( $logo ) )
        return;

    ?>
    <style type="text/css">
        .login h1 a { background-image:url('<?php echo $logo ?>') }
    </style>
    <?php
}
add_action( 'login_head', 'yiw_login_page_logo' );

function yiw_login_page_url( $url ) {
    $logo = yiw_get_option( 'login_url', home_url() );

    if ( empty( $logo ) )
        return $url;

    return $logo;
}
add_action( 'login_headerurl', 'yiw_login_page_url' );


if ( ! function_exists('get_page_template_slug') ) {
    function get_page_template_slug( $page_id ) {
    	if (!is_page()) {
    		return false;
    	}

    	global $wp_query;

    	$custom_fields = get_post_custom_values('_wp_page_template',$page_id);
    	$page_template = $custom_fields[0];

    	// We have no argument passed so just see if a page_template has been specified
    	if ( empty( $template ) ) {
    		if ( !empty( $page_template ) and ( 'default' != $page_template ) ) {
    			return true;
    		}
    	} elseif ( $template == $page_template) {
    		return true;
    	}

    	return false;
    }
}

if ( ! function_exists('add_menu_responsive_class') ) {
    function add_menu_responsive_class($classes) {
        $classes[] = 'responsive-menu';
        return $classes;
    }
}

// Register slides texts to translation
function wpml_slides_translation() {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle' );

    foreach( $sliders as $slider => $name ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $name . '_slides' ) );

        if ( !empty( $slides ) ) {
            foreach( $slides as $k => $slide ) {
                if( isset( $slides[$k]['slide_title'] ) ) { $slides[$k]['slide_title'] = icl_register_string( 'yiw',  $name . '_slide_' . $k . '_slide_title', $slide['slide_title'] ); }
                if( isset( $slides[$k]['tooltip_content'] ) ) { $slides[$k]['tooltip_content'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_tooltip_content', $slide['tooltip_content'] ); }
                if( isset( $slides[$k]['extra_tooltip_content'] ) ) { $slides[$k]['extra_tooltip_content'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_extra_tooltip_content', $slide['extra_tooltip_content'] ); }
                if( isset( $slides[$k]['image_url'] ) ) { $slides[$k]['image_url'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_image_url', $slide['image_url'] ); }
                if( isset( $slides[$k]['url_video'] ) ) { $slides[$k]['url_video'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_url_video', $slide['url_video'] ); }
                if( isset( $slides[$k]['extra_tooltip_image'] ) ) { $slides[$k]['extra_tooltip_image'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_extra_tooltip_image', $slide['extra_tooltip_image'] ); }
                if( isset( $slides[$k]['extra_tooltip_url'] ) ) { $slides[$k]['extra_tooltip_url'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_extra_tooltip_url', $slide['extra_tooltip_url'] ); }
                if( isset( $slides[$k]['extra_tooltip_x_pos'] ) ) { $slides[$k]['extra_tooltip_x_pos'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_extra_tooltip_x_pos', $slide['extra_tooltip_x_pos'] ); }
                if( isset( $slides[$k]['extra_tooltip_y_pos'] ) ) { $slides[$k]['extra_tooltip_y_pos'] = icl_register_string( 'yiw', $name . '_slide_' . $k . '_extra_tooltip_y_pos', $slide['extra_tooltip_y_pos'] ); }
            }
        }
    }
}

// Filter the slide title for the current language
function wpml_slide_title( $slide_title ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle' );

    foreach( $sliders as $slider ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        if ( $slides ) {
            foreach( $slides as $k => $slide ) {
                if ( isset( $slide['slide_title'] ) && $slide['slide_title'] == $slide_title ) {
                    $slide_title = icl_t( 'yiw', $slider . '_slide_' . $k . '_slide_title', $slide['slide_title'] );
                }
            }
        }
    }

    return $slide_title;
}

// Filter the slide content for the current language
function wpml_tooltip_content( $tooltip_content ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle' );

    foreach( $sliders as $slider ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        if ( $slides ) {
            foreach( $slides as $k => $slide ) {
                if ( isset( $slide['tooltip_content'] ) && $slide['tooltip_content'] == $tooltip_content ) {
                    $tooltip_content = icl_t( 'yiw', $slider . '_slide_' . $k . '_tooltip_content', $slide['tooltip_content'] );
                }
            }
        }
    }

    return $tooltip_content;
}

// Filter the slide image URL for the current language
function wpml_image_url( $image_url ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle' );

    foreach( $sliders as $slider ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        if ( $slides ) {
            foreach( $slides as $k => $slide ) {
                if ( isset( $slide['image_url'] ) && $slide['image_url'] == $image_url ) {
                    $image_url = icl_t( 'yiw', $slider . '_slide_' . $k . '_image_url', $slide['image_url'] );
                }
            }
        }
    }

    return $image_url;
}

function wpml_extra_tooltip_content( $extra_tooltip_content ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle' );

    foreach( $sliders as $slider ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        if ( $slides ) {
            foreach( $slides as $k => $slide ) {
                if ( isset( $slide['extra_tooltip_content'] ) && $slide['extra_tooltip_content'] == $extra_tooltip_content ) {
                    $extra_tooltip_content = icl_t( 'yiw', $slider . '_slide_' . $k . '_extra_tooltip_content', $slide['extra_tooltip_content'] );
                }
            }
        }
    }

    return $extra_tooltip_content;
}

function wpml_url_video( $url_video ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle' );

    foreach( $sliders as $slider ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        if ( $slides ) {
            foreach( $slides as $k => $slide ) {
                if ( isset( $slide['url_video'] ) && $slide['url_video'] == $url_video ) {
                    $url_video = icl_t( 'yiw', $slider . '_slide_' . $k . '_url_video', $slide['url_video'] );
                }
            }
        }
    }

    return $url_video;
}

function wpml_extra_tooltip_image( $extra_tooltip_image ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle' );

    foreach( $sliders as $slider) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        if ( $slides ) {
            foreach( $slides as $k => $slide ) {
                if ( isset( $slide['extra_tooltip_image'] ) && $slide['extra_tooltip_image'] == $extra_tooltip_image ) {
                    $extra_tooltip_image = icl_t( 'yiw', $slider . '_slide_' . $k . '_extra_tooltip_image', $slide['extra_tooltip_image'] );
                }
            }
        }
    }

    return $extra_tooltip_image;
}

function wpml_extra_tooltip_url( $extra_tooltip_url ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle' );

    foreach( $sliders as $slider) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        if ( $slides ) {
            foreach( $slides as $k => $slide ) {
                if ( isset( $slide['extra_tooltip_url'] ) && $slide['extra_tooltip_url'] == $extra_tooltip_url ) {
                    $extra_tooltip_url = icl_t( 'yiw', $slider . '_slide_' . $k . '_extra_tooltip_url', $slide['extra_tooltip_url'] );
                }
            }
        }
    }

    return $extra_tooltip_url;
}

function wpml_extra_tooltip_x_pos( $extra_tooltip_x_pos ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle' );

    foreach( $sliders as $slider ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        if ( $slides ) {
            foreach( $slides as $k => $slide ) {
                if ( isset( $slide['extra_tooltip_x_pos'] ) && $slide['extra_tooltip_x_pos'] == $extra_tooltip_x_pos ) {
                    $extra_tooltip_x_pos = icl_t( 'yiw', $slider . '_slide_' . $k . '_extra_tooltip_x_pos', $slide['extra_tooltip_x_pos'] );
                }
            }
        }
    }

    return $extra_tooltip_x_pos;
}

function wpml_extra_tooltip_y_pos( $extra_tooltip_y_pos ) {
    $sliders = array( 'elegant', 'flash', 'rotating', 'thumbnails', 'nivo', 'cycle' );

    foreach( $sliders as $slider ) {
        $slides = maybe_unserialize( yiw_get_option( 'slider_' . $slider . '_slides' ) );

        if ( $slides ) {
            foreach( $slides as $k => $slide ) {
                if ( isset( $slide['extra_tooltip_y_pos'] ) && $slide['extra_tooltip_url'] == $extra_tooltip_y_pos ) {
                    $extra_tooltip_y_pos = icl_t( 'yiw', $slider . '_slide_' . $k . '_extra_tooltip_y_pos', $slide['extra_tooltip_y_pos'] );
                }
            }
        }
    }

    return $extra_tooltip_y_pos;
}

// WPML compability
// Fire filters if WPML is activate and its functions exists
if ( defined('ICL_SITEPRESS_VERSION') && function_exists( 'icl_register_string' ) && function_exists( 'icl_t' ) ) {
    add_action( 'admin_init', 'wpml_slides_translation' );

    add_filter( 'yiw_slide_title', 'wpml_slide_title' );
    add_filter( 'yiw_slide_subtitle', 'wpml_slide_title' );
    add_filter( 'yiw_slide_content', 'wpml_tooltip_content' );
    add_filter( 'yiw_slide_clean', 'wpml_tooltip_content' );
    add_filter( 'yiw_slide_image', 'wpml_image_url' );
    add_filter( 'yiw_slide_default', 'wpml_extra_tooltip_content' );
    add_filter( 'yiw_slide_clean', 'wpml_extra_tooltip_content' );
    add_filter( 'yiw_slide_default', 'wpml_url_video' );
    add_filter( 'yiw_slide_default', 'wpml_extra_tooltip_image' );
    add_filter( 'yiw_slide_default', 'wpml_extra_tooltip_url' );
    add_filter( 'yiw_slide_default', 'wpml_extra_tooltip_x_pos' );
    add_filter( 'yiw_slide_default', 'wpml_extra_tooltip_y_pos' );
}


if ( ! function_exists( 'yiw_icl_translate' ) ) {
    /**
     * Add a string to string translation list and return it translation
     *
     * @author   Andrea Frascaspata  <andrea.frascaspata@yithemes.com>
     *
     * @param $context
     * @param $domain
     * @param $name
     * @param $string

     *
     * @return string | the string translation
     * @since  2.9.0
     */
    function yiw_icl_translate( $context, $domain,$name, $string ) {

	    global $sitepress;

        if ( isset( $sitepress ) ) {

            $name = "[" . $domain . "]" . $name;

	        yit_wpml_register_string( $context, $name, $string );

	        return yit_wpml_string_translate( $context, $name, $string );

        }
        else {
            return sprintf( __( '%s', $domain ), $string );
        }
    }
}


if ( ! function_exists( 'yiw_st_get_cart_label' ) ) {
    /**
     * Get the string 'items' or 'item' translated
     *
     * @author   Andrea Frascaspata  <andrea.frascaspata@yithemes.com>
     *
     * @param $cart_items
     *
     * @return string | the string translation
     * @since    2.9.0
     */
    function yiw_st_get_cart_label( $cart_items ) {
        // wpml fix ----------
        global $sitepress;

        if ( $sitepress == '' || empty( $sitepress ) || ! isset( $sitepress ) ) {

            if ( $cart_items != 1 ) {
                $label = __( 'Items', 'yiw' );
            }
            else {
                $label = __( 'Item', 'yiw' );
            }

        }
        else {

            if ( $cart_items != 1 ) {

                $label = yiw_icl_translate( 'theme', 'yiw', 'mini-cart-items-label', 'items' );

            }
            else {

                $label = yiw_icl_translate( 'theme', 'yiw', 'mini-cart-item-label', 'item' );

            }

        }
        //--End wpml Fix-----------------

        return $label;
    }
}

/**
* Remove Add to wishlist text option
    *
 */
function yiw_remove_wishlist_text_option( $options ) {
    if( isset( $options['general_settings'][7] ) && $options['general_settings'][7]['id'] == 'yith_wcwl_add_to_wishlist_text' )
    { unset( $options['general_settings'][7] ); }

    return $options;
}

if( !function_exists( 'yiw_remove_wp_admin_bar' ) ) {
    /**
     * Remove the wp admin bar in frontend if user is logged in
     *
     * @return void
     * @since  1.6.0
     */
    function yiw_remove_wp_admin_bar() {
        $current_user = wp_get_current_user();
        $is_customer  = array_search( 'customer', (array) $current_user->roles );
        if ( yiw_get_option( 'general-lock-down-admin' ) == '1' && $is_customer >= 0 ) {

            add_filter( 'show_admin_bar', '__return_false' );
        }
    }
}


/**
 * === YIW links problem fix ===
 */

if( !function_exists( 'yiw_removeYIWLink_notice' ) ) {
    /**
     * Add an admin notice about the YIWLink fix
     *
     *
     * @return void
     * @author Corrado Porzio <corradoporzio@gmail.com>
     * @since 2.0
     */
    function yiw_removeYIWLink_notice() { ?>

        <div id="setting-error-yit-communication" class="updated settings-error yiw_removeYIWLink_notice">
            <p>
                <strong>
                    <p><?php echo __( 'Please, update your DB to use the latest version of', 'yiw' ); ?> <?php echo wp_get_theme()->get( 'Name' ); ?> <?php echo __( 'theme', 'yiw' ); ?>.</p>
                    <p class="action_links"><a href="#" id="yiw_removeYIWLink_update"><?php echo __( 'UPDATE NOW', 'yiw' ); ?></a></p>
                </strong>
            </p>
        </div> <?php
    }
}

if( !function_exists( 'yiw_removeYIWLink_js' ) ) {
    /**
     * Add a js script about the YIWLink fix
     *
     *
     * @return void
     * @author Corrado Porzio <corradoporzio@gmail.com>
     * @since 2.0
     */
function yiw_removeYIWLink_js() { ?>
    <script type="text/javascript">

        jQuery(document).ready(function($){

            $( '#yiw_removeYIWLink_update').click(function(){


                $( ".yiw_removeYIWLink_notice .action_links" ).html( '<p><i class="fa fa-refresh fa-spin"></i> <?php echo __( 'Loading', 'yiw' ); ?>...</p>' );

                var data = {
                    'action': 'yiw_removeYIWLink',
                    'start_update': 1
                };

                $.post( ajaxurl, data, function( response ) {
                    $( ".yiw_removeYIWLink_notice .action_links" ).html( response );
                });

            });

        });

    </script> <?php
}
}

//delete_transient('yiw_removeYIWLink');

if( !function_exists( 'yiw_removeYIWLink' ) ) {
    /**
     * The function that fix the YIWLink problem
     *
     *
     * @return void
     * @author Corrado Porzio <corradoporzio@gmail.com>
     * @since 2.0
     */
    function yiw_removeYIWLink() {

        $start_update = intval( $_POST['start_update'] );

        if ( $start_update == 1 ) {

            yiw_execute_removeYIWLink();

            set_transient( 'yiw_removeYIWLink', true );
            echo '<p><i class="fa fa-check"></i> ' . __( 'Updated', 'yiw' ) . '!</p>';

        }

        die();
    }
}

if ( is_admin() && false === get_transient( 'yiw_removeYIWLink' ) && version_compare( wp_get_theme()->get( 'Version' ), '2.9.2', '<=')  ) {

    add_action( 'admin_notices', 'yiw_removeYIWLink_notice' );
    add_action( 'admin_footer', 'yiw_removeYIWLink_js' );
    add_action( 'wp_ajax_yiw_removeYIWLink', 'yiw_removeYIWLink' );

}

if(!function_exists('yiw_execute_removeYIWLink')) {
    /**
     * The function that fix the YIWLink problem
     *
     *
     * @return void
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     * @since 2.0
     */
    function yiw_execute_removeYIWLink(){

        global $wpdb;

        $db = array(); // all backup will be in this array

        $yiw_tables = yiw_get_wp_tables();

        set_time_limit( 0 );

        /* === START EXPORT CONTENT === */

        // retrive all values of tables
        foreach ( $yiw_tables['wp'] as $table ) {
            if ( $table == 'posts' ) {
                $where = " WHERE post_type <> 'revision'";
            }
            else {
                $where = '';
            }

            $db[$table] = $wpdb->get_results( "SELECT * FROM {$wpdb->$table}{$where}", ARRAY_A );
        }

        if ( ! empty( $yiw_tables['plugins'] ) ) {
            foreach ( $yiw_tables['plugins'] as $table_prefix ) {
                $tables = $wpdb->get_results( "SHOW TABLES LIKE '{$wpdb->prefix}{$table_prefix}'", ARRAY_A );
                if ( count( $tables ) != 0 ) {
                    foreach ( $tables as $key => $table_array ) {
                        foreach ( $table_array as $k => $table ) {
                            $table_no_prefix = preg_replace( "/^{$wpdb->prefix}/", '', $table );
                            $db[$table_no_prefix] = $wpdb->get_results( "SELECT * FROM {$table}", ARRAY_A );
                        }
                    }
                }
            }
        }

        $sql_options = array();
        foreach ( $yiw_tables['options'] as $option ) {
            if ( strpos( $option, '%' ) !== FALSE ) {
                $operator = 'LIKE';
            }
            else {
                $operator = '=';
            }
            $sql_options[] = "option_name $operator '$option'";
        }

        $sql_options = implode( ' OR ', $sql_options );

        $sql = "SELECT option_name, option_value, autoload FROM {$wpdb->options} WHERE $sql_options;";

        $db['options'] = $wpdb->get_results( $sql, ARRAY_A );

        array_walk_recursive( $db, 'convert_yiw_url' , 'in_export' );

        /* === END EXPORT CONTENT === */

        /* === START IMPORT CONTENT === */

        array_walk_recursive( $db, 'convert_yiw_url', 'in_import' );

        // tables
        $tables     = array_keys( $db );
        $db_tables  = $wpdb->get_col( "SHOW TABLES" );
        $theme_name = is_child_theme() ? strtolower( wp_get_theme()->parent()->get( 'Name' ) ) : strtolower( wp_get_theme()->get( 'Name' ) );

        foreach ( $tables as $key => $table ) {

            if ( $table != 'options' && in_array( ( $wpdb->prefix . $table ), $db_tables ) ) {
                // delete all row of each table
                $wpdb->query( "TRUNCATE TABLE {$wpdb->prefix}{$table}" );

                $insert = array();
                foreach ( $db[$table] as $id => $data ) {
                    $insert[] = yiw_make_insert_SQL( $data );
                }

                if ( ! empty( $db[$table] ) ) {

                    $num_rows    = count( $insert );
                    $step        = 5000;
                    $insert_step = intval( ceil( $num_rows / $step ) );
                    $fields      = implode( '`, `', array_keys( $db[$table][0] ) );

                    for ( $i = 0; $i < $insert_step; $i ++ ) {

                        $insert_row = implode( ', ', array_slice( $insert, ( $i * $step ), $step ) );
                        $wpdb->query( "INSERT INTO `{$wpdb->prefix}{$table}` ( `$fields` ) VALUES " . $insert_row );
                    }
                }
            }
            elseif ( $table == 'options' ) {

                $options_iterator = new ArrayIterator( $db[ $table ] );

                foreach ( $options_iterator as $id => $data ) {

                    if( $data['option_name'] == ( 'theme_mods_' . $theme_name ) ) {
                        $data_child = $data;
                        $data_child['option_name'] = $data_child['option_name'] . '-child';
                        $options_iterator->append( $data_child );
                    }

                    $fields  = implode( "`,`", array_keys( $data ) );
                    $values  = implode( "', '", array_values( array_map( 'esc_sql', $data ) ) );
                    $updates = '';

                    foreach ( $data as $k => $v ) {
                        $v = esc_sql( $v );
                        $updates .= "{$k} = '{$v}',";
                    }

                    $updates = substr( $updates, 0, - 1 );

                    $query = "INSERT INTO {$wpdb->prefix}{$table}
                          (`{$fields}`)
                        VALUES
                          ('{$values}')
                        ON DUPLICATE KEY UPDATE
                          {$updates};";

                    $wpdb->query( $query );
                }
            }
        }
    }
}



if( !function_exists( 'yiw_make_insert_SQL' ) ) {
    /**
     * The function that fix the YIWLink problem
     *
     *
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @since 2.0
     */
    function yiw_make_insert_SQL( $data ) {
        global $wpdb;

        $fields           = array_keys( $data );
        $formatted_fields = array();
        foreach ( $fields as $field ) {
            if ( isset( $wpdb->field_types[$field] ) ) {
                $form = $wpdb->field_types[$field];
            }
            else {
                $form = '%s';
            }
            $formatted_fields[] = $form;
        }
        $insert_data = implode( ', ', $formatted_fields );
        return $wpdb->prepare( "( $insert_data )", $data );
    }
}


if( !function_exists( 'convert_yiw_url' ) ) {
    /**
     * The function that fix the YIWLink problem
     *
     *
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     * @since 2.0
     **/
    function convert_yiw_url( &$item, $key, $type ) {

        if( yiw_string_is_serialized( $item ) ){
            $item = maybe_unserialize( $item );
            $item_type = 'serialized';
        }elseif( yiw_string_is_json( $item ) ){
            $item = json_decode( $item, true );
            $item_type = 'json_encoded';
        }else {
            $item_type = 'string';
        }

        switch ( $type ) {

            case 'in_import' :

                $upload_dir             = wp_upload_dir();
                $importer_uploads_url   = $upload_dir['baseurl'];
                $importer_site_url      = site_url();

                if ( ! is_object( $item ) && ! is_a( $item, '__PHP_Incomplete_Class' ) ) {
                    if ( is_array( $item ) ) {

                        array_walk_recursive( $item, 'convert_yiw_url', $type );

                        if( $item_type == 'serialized' ){
                            $item = serialize( $item );
                        } elseif( $item_type == 'json_encoded' ) {
                            $item = json_encode( $item );
                        }

                    }
                    else {
                        $item = str_replace( '%uploadsurl%', $importer_uploads_url, $item );
                        $item = str_replace( '%siteurl%', $importer_site_url, $item );
                    }
                }
                break;

            case 'in_export' :

                yiw_update_db_value('http://demo.yithemes.com/','sommerce',$item,$item_type,$type);
                yiw_update_db_value('http://yourinspirationtheme.com/demo/','sommerce',$item,$item_type,$type);
                yiw_update_db_value('http://www.yourinspirationweb.com/demo/','sommerce',$item,$item_type,$type);
                yiw_update_db_value('http://yourinspirationweb.com/demo/','sommerce',$item,$item_type,$type);
                yiw_update_db_value('http://yourinspirationweb.com/demo/','sheeva',$item,$item_type,$type);
                yiw_update_db_value('http://yourinspirationweb.com/demo/','impero',$item,$item_type,$type);
                yiw_update_db_value('http://www.yourinspirationweb.com/tf/support/','sommerce',$item,$item_type,$type);
                yiw_update_db_value('http://www.yourinspirationweb.com/tf/bolder','',$item,$item_type,$type);
                yiw_update_db_value('http://www.yourinspirationweb.com/tf/','sommerce',$item,$item_type,$type);

                break;

        }
    }
}


if( !function_exists( 'yiw_update_db_value' ) ) {
    /**
     * The function that fix the YIWLink problem
     *
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     * @since 2.0
     */
    function yiw_update_db_value($base_url,$dir,&$item,$item_type,$type){

        if ( ! is_object( $item ) && ! is_a( $item, '__PHP_Incomplete_Class' ) ) {
            if ( is_array( $item ) ) {

                array_walk_recursive( $item, 'convert_yiw_url' , $type );

                if( $item_type == 'serialized' ){
                    $item = serialize( $item );
                } elseif( $item_type == 'json_encoded' ) {
                    $item = json_encode( $item );
                }
            }
            else {

                $importer_uploads_url   = $base_url.$dir.'/files';
                $importer_site_url      = $base_url.$dir;

                $current_item = '' . $item; //clone

                $item         = str_replace( $importer_uploads_url, '%uploadsurl%', $item );
                if ( !(strcmp( $current_item, $item ) == 0) ) {
                    $parsed_site_url = @parse_url( $importer_site_url );
                    $item            = str_replace( str_replace( $parsed_site_url['scheme'] . '://' . $parsed_site_url['host'], '', $importer_uploads_url ), '%uploadsurl%', $item );
                }

                $item            = str_replace( $importer_site_url, '%siteurl%', $item );
            }
        }
    }
}



if( !function_exists( 'yiw_get_wp_tables' ) ) {
    /**
     * The function that fix the YIWLink problem
     *
     *
     * @return void
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @since 2.0
     */
    function yiw_get_wp_tables(){
        global $wpdb;

        return apply_filters( 'yiw_yiw_link_data_tables', array(
                'wp' => array(
                    'posts',
                    'postmeta',
                ),

                'options' => array(
                    'widget_rss',
                    'yiw_theme_options_sommerce',
                    'widget_text-image',
                    'yiw_theme_options_sommerce'
                ),

                'plugins' => array(),
            )
        );
    }
}

/* === CHECK FOR NON STANDARD WORDPRESS TABLE == */
add_filter( 'yiw_yiw_link_data_tables', 'yiw_remove_link_add_layer_slider' );


if( ! function_exists( 'yiw_remove_link_add_layer_slider' ) ) {
    /**
     * add Layer Slider table to export functions
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     * @author   Corrado Porzio  <corradoporzio@gmail.com>
     *
     * @param array
     * @param $tables
     *
     * @return mixed array
     * @since    1.0.2
     */
    function yiw_remove_link_add_layer_slider( $tables ) {
        global $wpdb;

        $tables['plugins'][] = 'layerslider';

        return $tables;
    }
}

if( ! function_exists( 'yiw_string_is_serialized' ) ) {
    /**
     * Check if a string is serialized
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param $string
     *
     * @internal param string $src
     * @return bool | true if string is serialized, false otherwise
     * @since    2.0.0
     */
    function yiw_string_is_serialized( $string ) {
        $data = @unserialize( $string );
        return ! $data ? $data : true;
    }
}

if( ! function_exists( 'yiw_string_is_json' ) ){
    /**
     * Check if a string is json
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param $string
     *
     * @internal param string $src
     * @return bool | true if string is json, false otherwise
     * @since    2.0.0
     */
    function yiw_string_is_json( $string ) {
        $data = @json_decode( $string );
        return $data == NULL ? false : true;
    }
}

if ( ! function_exists( 'yiw_get_ajax_loader_gif_url' ) ) {
    function yiw_get_ajax_loader_gif_url() {
        return get_template_directory_uri(). '/images/ajax-loader.gif';
    }
}


?>