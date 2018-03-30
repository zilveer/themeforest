<?php
/**
 * Useful functions that return arrays
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.3
 */

/**
 * Returns array of image background styles
 *
 * @since 3.5.0
 */
function wpex_get_bg_img_styles() {
	return array(
		''             => esc_html__( 'Default', 'total' ),
		'cover'        => esc_html__( 'Cover', 'total' ),
		'stretched'    => esc_html__( 'Fixed Cover', 'total' ),
		'repeat'       => esc_html__( 'Repeat', 'total' ),
		'fixed-top'    => esc_html__( 'Fixed Top', 'total' ),
		'fixed'        => esc_html__( 'Fixed Center', 'total' ),
		'fixed-bottom' => esc_html__( 'Fixed Bottom', 'total' ),
		'repeat-x'     => esc_html__( 'Repeat-x', 'total' ),
		'repeat-y'     => esc_html__( 'Repeat-y', 'total' ),
		'repeat-y'     => esc_html__( 'Repeat-y', 'total' ),
	);
}

/**
 * Returns array of dropdown styles
 *
 * @since 3.4.0
 */
function wpex_get_menu_dropdown_styles() {
	return apply_filters( 'wpex_get_header_menu_dropdown_styles', array(
		'default'    => esc_html__( 'Default', 'total' ),
		'minimal-sq' => esc_html__( 'Minimal', 'total' ),
		'minimal'    => esc_html__( 'Minimal - Rounded', 'total' ),
		'black'      => esc_html__( 'Black', 'total' ),
	) );
}

/**
 * Array of carousel arrow positions
 *
 * @since 3.5.3
 */
function wpex_carousel_arrow_positions() {
	return apply_filters( 'wpex_carousel_arrow_positions', array(
		'default' => __( 'Default', 'total' ),
		'left'    => __( 'Left', 'total' ) ,
	 	'center'  => __( 'Center', 'total' ),
		'right'   => __( 'Right', 'total' ),
		'abs'     => __( 'Absolute', 'total' ),
	) );
}

/**
 * Array of carousel arrow styles
 *
 * @since 3.5.3
 */
function wpex_carousel_arrow_styles() {
	return apply_filters( 'wpex_carousel_arrow_styles', array(
		''       => esc_html__( 'Default', 'total' ),
		'min'    => esc_html__( 'Minimal', 'total' ),
		'border' => esc_html__( 'Border', 'total' ),
		'circle' => esc_html__( 'Circle', 'total' ),
	) );
}

/**
 * Returns array of page layouts
 *
 * @since 3.3.3
 */
function wpex_get_post_layouts() {
	return array(
		''              => esc_html__( 'Default', 'total' ),
		'right-sidebar' => esc_html__( 'Right Sidebar', 'total' ),
		'left-sidebar'  => esc_html__( 'Left Sidebar', 'total' ),
		'full-width'    => esc_html__( 'No Sidebar', 'total' ),
		'full-screen'   => esc_html__( 'Full Screen', 'total' ),
	);
}

/**
 * Returns array of Header Overlay Styles
 *
 * @since 3.3.0
 */
function wpex_header_overlay_styles() {
	return apply_filters( 'wpex_header_overlay_styles', array(
		'white' => esc_html__( 'White Text', 'total' ),
		'light' => esc_html__( 'Light Text', 'total' ),
		'dark'  => esc_html__( 'Black Text', 'total' ),
		'core'  => esc_html__( 'Default Styles', 'total' ),
	) );
}

/**
 * Returns array of available post types
 *
 * @since 3.3.0
 */
function wpex_get_post_types( $instance = '' ) {
	$types = array();
	$get_types = get_post_types( array(
		'public'   => true,
		'_builtin' => false,
	), 'objects', 'and' );
	foreach ( $get_types as $key => $val ) {
		$types[$key] = $val->labels->name;
	}
	return apply_filters( 'wpex_get_post_types', $types, $instance );
}

/**
 * Returns array of WP dashicons
 *
 * @since 3.3.0
 */
function wpex_get_dashicons_array() {
	return array('admin-appearance' => 'f100', 'admin-collapse' => 'f148', 'admin-comments' => 'f117', 'admin-generic' => 'f111', 'admin-home' => 'f102', 'admin-media' => 'f104', 'admin-network' => 'f112', 'admin-page' => 'f133', 'admin-plugins' => 'f106', 'admin-settings' => 'f108', 'admin-site' => 'f319', 'admin-tools' => 'f107', 'admin-users' => 'f110', 'align-center' => 'f134', 'align-left' => 'f135', 'align-none' => 'f138', 'align-right' => 'f136', 'analytics' => 'f183', 'arrow-down' => 'f140', 'arrow-down-alt' => 'f346', 'arrow-down-alt2' => 'f347', 'arrow-left' => 'f141', 'arrow-left-alt' => 'f340', 'arrow-left-alt2' => 'f341', 'arrow-right' => 'f139', 'arrow-right-alt' => 'f344', 'arrow-right-alt2' => 'f345', 'arrow-up' => 'f142', 'arrow-up-alt' => 'f342', 'arrow-up-alt2' => 'f343', 'art' => 'f309', 'awards' => 'f313', 'backup' => 'f321', 'book' => 'f330', 'book-alt' => 'f331', 'businessman' => 'f338', 'calendar' => 'f145', 'camera' => 'f306', 'cart' => 'f174', 'category' => 'f318', 'chart-area' => 'f239', 'chart-bar' => 'f185', 'chart-line' => 'f238', 'chart-pie' => 'f184', 'clock' => 'f469', 'cloud' => 'f176', 'dashboard' => 'f226', 'desktop' => 'f472', 'dismiss' => 'f153', 'download' => 'f316', 'edit' => 'f464', 'editor-aligncenter' => 'f207', 'editor-alignleft' => 'f206', 'editor-alignright' => 'f208', 'editor-bold' => 'f200', 'editor-customchar' => 'f220', 'editor-distractionfree' => 'f211', 'editor-help' => 'f223', 'editor-indent' => 'f222', 'editor-insertmore' => 'f209', 'editor-italic' => 'f201', 'editor-justify' => 'f214', 'editor-kitchensink' => 'f212', 'editor-ol' => 'f204', 'editor-outdent' => 'f221', 'editor-paste-text' => 'f217', 'editor-paste-word' => 'f216', 'editor-quote' => 'f205', 'editor-removeformatting' => 'f218', 'editor-rtl' => 'f320', 'editor-spellcheck' => 'f210', 'editor-strikethrough' => 'f224', 'editor-textcolor' => 'f215', 'editor-ul' => 'f203', 'editor-underline' => 'f213', 'editor-unlink' => 'f225', 'editor-video' => 'f219', 'email' => 'f465', 'email-alt' => 'f466', 'exerpt-view' => 'f164', 'facebook' => 'f304', 'facebook-alt' => 'f305', 'feedback' => 'f175', 'flag' => 'f227', 'format-aside' => 'f123', 'format-audio' => 'f127', 'format-chat' => 'f125', 'format-gallery' => 'f161', 'format-image' => 'f128', 'format-links' => 'f103', 'format-quote' => 'f122', 'format-standard' => 'f109', 'format-status' => 'f130', 'format-video' => 'f126', 'forms' => 'f314', 'googleplus' => 'f462', 'groups' => 'f307', 'hammer' => 'f308', 'id' => 'f336', 'id-alt' => 'f337', 'image-crop' => 'f165', 'image-flip-horizontal' => 'f169', 'image-flip-vertical' => 'f168', 'image-rotate-left' => 'f166', 'image-rotate-right' => 'f167', 'images-alt' => 'f232', 'images-alt2' => 'f233', 'info' => 'f348', 'leftright' => 'f229', 'lightbulb' => 'f339', 'list-view' => 'f163', 'location' => 'f230', 'location-alt' => 'f231', 'lock' => 'f160', 'marker' => 'f159', 'menu' => 'f333', 'migrate' => 'f310', 'minus' => 'f460', 'networking' => 'f325', 'no' => 'f158', 'no-alt' => 'f335', 'performance' => 'f311', 'plus' => 'f132', 'portfolio' => 'f322', 'post-status' => 'f173', 'pressthis' => 'f157', 'products' => 'f312', 'redo' => 'f172', 'rss' => 'f303', 'screenoptions' => 'f180', 'search' => 'f179', 'share' => 'f237', 'share-alt' => 'f240', 'share-alt2' => 'f242', 'shield' => 'f332', 'shield-alt' => 'f334', 'slides' => 'f181', 'smartphone' => 'f470', 'smiley' => 'f328', 'sort' => 'f156', 'sos' => 'f468', 'star-empty' => 'f154', 'star-filled' => 'f155', 'star-half' => 'f459', 'tablet' => 'f471', 'tag' => 'f323', 'testimonial' => 'f473', 'translation' => 'f326', 'trash' => 'f182', 'twitter' => 'f301', 'undo' => 'f171', 'update' => 'f463', 'upload' => 'f317', 'vault' => 'f178', 'video-alt' => 'f234', 'video-alt2' => 'f235', 'video-alt3' => 'f236', 'visibility' => 'f177', 'welcome-add-page' => 'f133', 'welcome-comments' => 'f117', 'welcome-edit-page' => 'f119', 'welcome-learn-more' => 'f118', 'welcome-view-site' => 'f115', 'welcome-widgets-menus' => 'f116', 'wordpress' => 'f120', 'wordpress-alt' => 'f324', 'yes' => 'f147');
}

/**
 * Returns array of Social Options for the Top Bar
 *
 * @since 1.6.0
 */
function wpex_topbar_social_options() {
	return apply_filters ( 'wpex_topbar_social_options', array(
		'twitter' => array(
			'label' => 'Twitter',
			'icon_class' => 'fa fa-twitter',
		),
		'facebook' => array(
			'label' => 'Facebook',
			'icon_class' => 'fa fa-facebook',
		),
		'googleplus' => array(
			'label' => 'Google Plus',
			'icon_class' => 'fa fa-google-plus',
		),
		'pinterest'  => array(
			'label' => 'Pinterest',
			'icon_class' => 'fa fa-pinterest',
		),
		'dribbble' => array(
			'label' => 'Dribbble',
			'icon_class' => 'fa fa-dribbble',
		),
		'vk' => array(
			'label' => 'VK',
			'icon_class' => 'fa fa-vk',
		),
		'instagram'  => array(
			'label' => 'Instagram',
			'icon_class' => 'fa fa-instagram',
		),
		'linkedin' => array(
			'label' => 'LinkedIn',
			'icon_class' => 'fa fa-linkedin',
		),
		'tumblr'  => array(
			'label' => 'Tumblr',
			'icon_class' => 'fa fa-tumblr',
		),
		'github'  => array(
			'label' => 'Github',
			'icon_class' => 'fa fa-github-alt',
		),
		'flickr'  => array(
			'label' => 'Flickr',
			'icon_class' => 'fa fa-flickr',
		),
		'skype' => array(
			'label' => 'Skype',
			'icon_class' => 'fa fa-skype',
		),
		'youtube' => array(
			'label' => 'Youtube',
			'icon_class' => 'fa fa-youtube',
		),
		'vimeo' => array(
			'label' => 'Vimeo',
			'icon_class' => 'fa fa-vimeo-square',
		),
		'vine' => array(
			'label' => 'Vine',
			'icon_class' => 'fa fa-vine',
		),
		'xing' => array(
			'label' => 'Xing',
			'icon_class' => 'fa fa-xing',
		),
		'yelp' => array(
			'label' => 'Yelp',
			'icon_class' => 'fa fa-yelp',
		),
		'tripadvisor' => array(
			'label' => 'Tripadvisor',
			'icon_class' => 'fa fa-tripadvisor',
		),
		'twitch' => array(
			'label' => 'Twitch',
			'icon_class' => 'fa fa-twitch',
		),
		'rss'  => array(
			'label' => esc_html__( 'RSS', 'total' ),
			'icon_class' => 'fa fa-rss',
		),
		'email' => array(
			'label' => esc_html__( 'Email', 'total' ),
			'icon_class' => 'fa fa-envelope',
		),
	) );
}

/**
 * Array of social profiles for staff members
 *
 * @since 1.5.4
 */
function wpex_staff_social_array() {
	return apply_filters( 'wpex_staff_social_array', array(
		'twitter'        => array(
			'key'        => 'twitter',
			'meta'       => 'wpex_staff_twitter',
			'icon_class' => 'fa fa-twitter',
			'label'      => 'Twitter',
		),
		'facebook'        => array(
			'key'        => 'facebook',
			'meta'       => 'wpex_staff_facebook',
			'icon_class' => 'fa fa-facebook',
			'label'      => 'Facebook',
		),
		'instagram'      => array(
			'key'        => 'instagram',
			'meta'       => 'wpex_staff_instagram',
			'icon_class' => 'fa fa-instagram',
			'label'      => 'Instagram',
		),
		'google-plus'    => array(
			'key'        => 'google-plus',
			'meta'       => 'wpex_staff_google-plus',
			'icon_class' => 'fa fa-google-plus',
			'label'      => 'Google Plus',
		),
		'linkedin'       => array(
			'key'        => 'linkedin',
			'meta'       => 'wpex_staff_linkedin',
			'icon_class' => 'fa fa-linkedin',
			'label'      => 'Linkedin',
		),
		'dribbble'       => array(
			'key'        => 'dribbble',
			'meta'       => 'wpex_staff_dribbble',
			'icon_class' => 'fa fa-dribbble',
			'label'      => 'Dribbble',
		),
		'vk'             => array(
			'key'        => 'vk',
			'meta'       => 'wpex_staff_vk',
			'icon_class' => 'fa fa-vk',
			'label'      => 'VK',
		),
		'skype'          => array(
			'key'        => 'skype',
			'meta'       => 'wpex_staff_skype',
			'icon_class' => 'fa fa-skype',
			'label'      => 'Skype',
		),
		'phone_number'   => array(
			'key'        => 'phone_number',
			'meta'       => 'wpex_staff_phone_number',
			'icon_class' => 'fa fa-phone',
			'label'      => esc_html__( 'Phone Number', 'total' ),
		),
		'email'          => array(
			'key'        => 'email',
			'meta'       => 'wpex_staff_email',
			'icon_class' => 'fa fa-envelope',
			'label'      => esc_html__( 'Email', 'total' ),
		),
		'website'        => array(
			'key'        => 'website',
			'meta'       => 'wpex_staff_website',
			'icon_class' => 'fa fa-external-link-square',
			'label'      => esc_html__( 'Website', 'total' ),
		),
	) );
}

/**
 * Creates an array for adding the staff social options to the metaboxes
 *
 * @since 1.5.4
 */
function wpex_staff_social_meta_array() {
	$profiles = wpex_staff_social_array();
	$array = array();
	foreach ( $profiles as $profile ) {
		$array[] = array(
			'title' => '<span class="'. $profile['icon_class'] .'"></span>' . $profile['label'],
			'id'    => $profile['meta'],
			'type'  => 'text',
			'std'   => '',
		);
	}
	return $array;
}

/**
 * Grid Columns
 *
 * @since 2.0.0
 */
function wpex_grid_columns() {
	return apply_filters( 'wpex_grid_columns', array(
		'1' => '1',
		'2' => '2',
		'3' => '3',
		'4' => '4',
		'5' => '5',
		'6' => '6',
		'7' => '7',
	) );
}

/**
 * Grid Column Gaps
 *
 * @since 2.0.0
 */
function wpex_column_gaps() {
	return apply_filters( 'wpex_column_gaps', array(
		''     => esc_html__( 'Default', 'total' ),
		'none' => '0px',
		'1'    => '1px',
		'5'    => '5px',
		'10'   => '10px',
		'15'   => '15px',
		'20'   => '20px',
		'25'   => '25px',
		'30'   => '30px',
		'35'   => '35px',
		'40'   => '40px',
		'50'   => '50px',
		'60'   => '60px',
	) );
}

/**
 * Typography Styles
 *
 * @since 2.0.0
 */
function wpex_typography_styles() {
	return apply_filters( 'wpex_typography_styles', array(
		''             => esc_html__( 'Default', 'total' ),
		'light'        => esc_html__( 'Light', 'total' ),
		'white'        => esc_html__( 'White', 'total' ),
		'white-shadow' => esc_html__( 'White with Shadow', 'total' ),
		'black'        => esc_html__( 'Black', 'total' ),
		'none'         => esc_html__( 'None', 'total' ),
	) );
}

/**
 * Button styles
 *
 * @since 1.6.2
 */
function wpex_button_styles() {
	return apply_filters( 'wpex_button_styles', array(
		''               => esc_html__( 'Default', 'total' ),
		'flat'           => esc_html__( 'Flat', 'total' ),
		'graphical'      => esc_html__( 'Graphical', 'total' ),
		'clean'          => esc_html__( 'Clean', 'total' ),
		'three-d'        => esc_html__( '3D', 'total' ),
		'outline'        => esc_html__( 'Outline', 'total' ),
		'minimal-border' => esc_html__( 'Minimal Border', 'total' ),
		'plain-text'     => esc_html__( 'Plain Text', 'total' ),
	) );
}

/**
 * Button colors
 *
 * @since 1.6.2
 */
function wpex_button_colors() {
	return apply_filters( 'wpex_button_colors', array(
		''       => esc_html__( 'Default', 'total' ),
		'black'  => esc_html__( 'Black', 'total' ),
		'blue'   => esc_html__( 'Blue', 'total' ),
		'brown'  => esc_html__( 'Brown', 'total' ),
		'grey'   => esc_html__( 'Grey', 'total' ),
		'green'  => esc_html__( 'Green', 'total' ),
		'gold'   => esc_html__( 'Gold', 'total' ),
		'orange' => esc_html__( 'Orange', 'total' ),
		'pink'   => esc_html__( 'Pink', 'total' ),
		'purple' => esc_html__( 'Purple', 'total' ),
		'red'    => esc_html__( 'Red', 'total' ),
		'rosy'   => esc_html__( 'Rosy', 'total' ),
		'teal'   => esc_html__( 'Teal', 'total' ),
		'white'  => esc_html__( 'White', 'total' ),
	) );
}

/**
 * Array of image crop locations
 *
 * @link 2.0.0
 */
function wpex_image_crop_locations() {
	return array(
		''              => esc_html__( 'Default', 'total' ),
		'left-top'      => esc_html__( 'Top Left', 'total' ),
		'right-top'     => esc_html__( 'Top Right', 'total' ),
		'center-top'    => esc_html__( 'Top Center', 'total' ),
		'left-center'   => esc_html__( 'Center Left', 'total' ),
		'right-center'  => esc_html__( 'Center Right', 'total' ),
		'center-center' => esc_html__( 'Center Center', 'total' ),
		'left-bottom'   => esc_html__( 'Bottom Left', 'total' ),
		'right-bottom'  => esc_html__( 'Bottom Right', 'total' ),
		'center-bottom' => esc_html__( 'Bottom Center', 'total' ),
	);
}

/**
 * Image Hovers
 *
 * @since 1.6.2
 */
function wpex_image_hovers() {
	return apply_filters( 'wpex_image_hovers', array(
		''             => esc_html__( 'Default', 'total' ),
		'opacity'      => esc_html__( 'Opacity', 'total' ),
		'grow'         => esc_html__( 'Grow', 'total' ),
		'shrink'       => esc_html__( 'Shrink', 'total' ),
		'side-pan'     => esc_html__( 'Side Pan', 'total' ),
		'vertical-pan' => esc_html__( 'Vertical Pan', 'total' ),
		'tilt'         => esc_html__( 'Tilt', 'total' ),
		'blurr'        => esc_html__( 'Normal - Blurr', 'total' ),
		'blurr-invert' => esc_html__( 'Blurr - Normal', 'total' ),
		'sepia'        => esc_html__( 'Sepia', 'total' ),
		'fade-out'     => esc_html__( 'Fade Out', 'total' ),
		'fade-in'      => esc_html__( 'Fade In', 'total' ),
	) );
}

/**
 * Text decorations
 *
 * @since 1.6.2
 */
function wpex_text_decorations() {
	return apply_filters( 'wpex_text_decorations', array(
		''             => esc_html__( 'Default', 'total' ),
		'underline'    => esc_html__( 'Underline', 'total' ),
		'overline'     => esc_html__( 'Overline','total' ),
		'line-through' => esc_html__( 'Line-through', 'total' ),
	) );
}

/**
 * Font Weights
 *
 * @since 1.6.2
 */
function wpex_font_weights() {
	return apply_filters( 'wpex_font_weights', array(
		''         => esc_html__( 'Default', 'total' ),
		'normal'   => esc_html__( 'Normal', 'total' ),
		'semibold' => esc_html__( 'Semibold','total' ),
		'bold'     => esc_html__( 'Bold', 'total' ),
		'bolder'   => esc_html__( 'Bolder', 'total' ),
		'100'      => '100',
		'200'      => '200',
		'300'      => '300',
		'400'      => '400',
		'500'      => '500',
		'600'      => '600',
		'700'      => '700',
		'800'      => '800',
		'900'      => '900',
	) );
}

/**
 * Text Transform
 *
 * @since 1.6.2
 */
function wpex_text_transforms() {
	return array(
		''           => esc_html__( 'Default', 'total' ),
		'none'       => esc_html__( 'None', 'total' ) ,
		'capitalize' => esc_html__( 'Capitalize', 'total' ),
		'uppercase'  => esc_html__( 'Uppercase', 'total' ),
		'lowercase'  => esc_html__( 'Lowercase', 'total' ),
	);
}

/**
 * Border Styles
 *
 * @since 1.6.0
 */
function wpex_border_styles() {
	return array(
		''       => esc_html__( 'Default', 'total' ),
		'solid'  => esc_html__( 'Solid', 'total' ),
		'dotted' => esc_html__( 'Dotted', 'total' ),
		'dashed' => esc_html__( 'Dashed', 'total' ),
	);
}

/**
 * Alignments
 *
 * @since 1.6.0
 */
function wpex_alignments() {
	return array(
		''       => esc_html__( 'Default', 'total' ),
		'left'   => esc_html__( 'Left', 'total' ),
		'right'  => esc_html__( 'Right', 'total' ),
		'center' => esc_html__( 'Center', 'total' ),
	);
}

/**
 * Visibility
 *
 * @since 1.6.0
 */
function wpex_visibility() {
	return apply_filters( 'wpex_visibility', array(
		''                         => esc_html__( 'Always Visible', 'total' ),
		'hidden-phone'             => esc_html__( 'Hidden on Phones', 'total' ),
		'hidden-tablet'            => esc_html__( 'Hidden on Tablets', 'total' ),
		'hidden-tablet-landscape'  => esc_html__( 'Hidden on Tablets: Landscape', 'total' ),
		'hidden-tablet-portrait'   => esc_html__( 'Hidden on Tablets: Portrait', 'total' ),
		'hidden-desktop'           => esc_html__( 'Hidden on Desktop', 'total' ),
		'visible-desktop'          => esc_html__( 'Visible on Desktop Only', 'total' ),
		'visible-phone'            => esc_html__( 'Visible on Phones Only', 'total' ),
		'visible-tablet'           => esc_html__( 'Visible on Tablets Only', 'total' ),
		'visible-tablet-landscape' => esc_html__( 'Visible on Tablets: Landscape Only', 'total' ),
		'visible-tablet-portrait'  => esc_html__( 'Visible on Tablets: Portrait Only', 'total' ),
	) );
}

/**
 * CSS Animations
 *
 * @since 1.6.0
 */
function wpex_css_animations() {
	return apply_filters( 'wpex_css_animations', array(
		''              => esc_html__( 'None', 'total') ,
		'top-to-bottom' => esc_html__( 'Top to bottom', 'total' ),
		'bottom-to-top' => esc_html__( 'Bottom to top', 'total' ),
		'left-to-right' => esc_html__( 'Left to right', 'total' ),
		'right-to-left' => esc_html__( 'Right to left', 'total' ),
		'appear'        => esc_html__( 'Appear from center', 'total' ),
	) );
}

/**
 * Array of Hover CSS animations
 *
 * @since 2.0.0
 */
function wpex_hover_css_animations() {
	return apply_filters( 'wpex_hover_css_animations', array(
		''                       => esc_html__( 'Default', 'total' ),
		'shadow'                 => esc_html__( 'Shadow', 'total' ),
		'grow-shadow'            => esc_html__( 'Grow Shadow', 'total' ),
		'float-shadow'           => esc_html__( 'Float Shadow', 'total' ),
		'grow'                   => esc_html__( 'Grow', 'total' ),
		'shrink'                 => esc_html__( 'Shrink', 'total' ),
		'pulse'                  => esc_html__( 'Pulse', 'total' ),
		'pulse-grow'             => esc_html__( 'Pulse Grow', 'total' ),
		'pulse-shrink'           => esc_html__( 'Pulse Shrink', 'total' ),
		'push'                   => esc_html__( 'Push', 'total' ),
		'pop'                    => esc_html__( 'Pop', 'total' ),
		'bounce-in'              => esc_html__( 'Bounce In', 'total' ),
		'bounce-out'             => esc_html__( 'Bounce Out', 'total' ),
		'rotate'                 => esc_html__( 'Rotate', 'total' ),
		'grow-rotate'            => esc_html__( 'Grow Rotate', 'total' ),
		'float'                  => esc_html__( 'Float', 'total' ),
		'sink'                   => esc_html__( 'Sink', 'total' ),
		'bob'                    => esc_html__( 'Bob', 'total' ),
		'hang'                   => esc_html__( 'Hang', 'total' ),
		'skew'                   => esc_html__( 'Skew', 'total' ),
		'skew-backward'          => esc_html__( 'Skew Backward', 'total' ),
		'wobble-horizontal'      => esc_html__( 'Wobble Horizontal', 'total' ),
		'wobble-vertical'        => esc_html__( 'Wobble Vertical', 'total' ),
		'wobble-to-bottom-right' => esc_html__( 'Wobble To Bottom Right', 'total' ),
		'wobble-to-top-right'    => esc_html__( 'Wobble To Top Right', 'total' ),
		'wobble-top'             => esc_html__( 'Wobble Top', 'total' ),
		'wobble-bottom'          => esc_html__( 'Wobble Bottom', 'total' ),
		'wobble-skew'            => esc_html__( 'Wobble Skew', 'total' ),
		'buzz'                   => esc_html__( 'Buzz', 'total' ),
		'buzz-out'               => esc_html__( 'Buzz Out', 'total' ),
		'glow'                   => esc_html__( 'Glow', 'total' ),
		'shadow-radial'          => esc_html__( 'Shadow Radial', 'total' ),
		'box-shadow-outset'      => esc_html__( 'Box Shadow Outset', 'total' ),
		'box-shadow-inset'       => esc_html__( 'Box Shadow Inset', 'total' ),
	) );
}

/**
 * Image filter styles
 *
 * @since 1.4.0
 */
function wpex_image_filters() {
	return apply_filters( 'wpex_image_filters', array(
		''          => esc_html__( 'None', 'total' ),
		'grayscale' => esc_html__( 'Grayscale', 'total' ),
	) );
}

/**
 * Social Link styles
 *
 * @since 3.0.0
 */
function wpex_social_button_styles() {
	return apply_filters( 'wpex_social_button_styles', array(
		'default'            => esc_html__( 'Skin Default', 'total' ),
		'none'               => esc_html__( 'None', 'total' ),
		'minimal'            => esc_html__( 'Minimal', 'total' ),
		'minimal-rounded'    => esc_html__( 'Minimal Rounded', 'total' ),
		'minimal-round'      => esc_html__( 'Minimal Round', 'total' ),
		'flat'               => esc_html__( 'Flat', 'total' ),
		'flat-rounded'       => esc_html__( 'Flat Rounded', 'total' ),
		'flat-round'         => esc_html__( 'Flat Round', 'total' ),
		'flat-color'         => esc_html__( 'Flat Color', 'total' ),
		'flat-color-rounded' => esc_html__( 'Flat Color Rounded', 'total' ),
		'flat-color-round'   => esc_html__( 'Flat Color Round', 'total' ),
		'3d'                 => esc_html__( '3D', 'total' ),
		'3d-color'           => esc_html__( '3D Color', 'total' ),
		'black'              => esc_html__( 'Black', 'total' ),
		'black-rounded'      => esc_html__( 'Black Rounded', 'total' ),
		'black-round'        => esc_html__( 'Black Round', 'total' ),
		'black-ch'           => esc_html__( 'Black with Color Hover', 'total' ),
		'black-ch-rounded'   => esc_html__( 'Black with Color Hover Rounded', 'total' ),
		'black-ch-round'     => esc_html__( 'Black with Color Hover Round', 'total' ),
		'graphical'          => esc_html__( 'Graphical', 'total' ),
		'graphical-rounded'  => esc_html__( 'Graphical Rounded', 'total' ),
		'graphical-round'    => esc_html__( 'Graphical Round', 'total' ),
		'bordered'           => esc_html__( 'Bordered', 'total' ),
		'bordered-rounded'   => esc_html__( 'Bordered Rounded', 'total' ),
		'bordered-round'     => esc_html__( 'Bordered Round', 'total' ),
	) );
}