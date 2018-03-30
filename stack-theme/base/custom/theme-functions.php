<?php
// Hide Image in Blog Page
// add_filter('the_content','blog_content_filter');
function blog_content_filter($content){
    if ( is_home() ){ $content = preg_replace("/<img[^>]+\>/i", "", $content); }
    return $content;
}

// Change Excerpt "More" text
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more( $more ) {
	return '';
}

// Custom Password Required Template
add_filter('the_password_form', 'base_password_form');
function base_password_form() {
    global $post;

    $label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);
    $output = '<form action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post" class="validate-form">
    <p>' . __('This post is password protected. Please fill the password:', 'theme_front') . '</p>
    <div class="form-input-item protected-password-input-item clearfix">
    <input name="post_password" class="input-text {required:true}" id="' . $label . '" type="password" size="20" value="" autocomplete="off" /><label for="' . $label . '">' . __('Password', 'theme_front') . ' <span class="required-star">*</span></label>
	</div>
	<div class="form-input-item clearfix">
	<button type="submit" name="Submit" class="button medium"><span>' . esc_attr__('Submit', 'theme_front') . '</span></button>
	</div>
    </form>';

    return $output;
}

// Add action wp_footer
add_action('wp_footer', 'theme_footer');
function theme_footer() {

	if( theme_options('advance', 'show_customize') == 'on' && !isset($_REQUEST['disable_customize']) ) get_template_part('section', 'customize-panel');

	if( theme_options('advance', 'analytic_ua') ) {
?>
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', <?php echo theme_options('advance', 'analytic_ua'); ?>]);
			_gaq.push(['_trackPageview']);

			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
<?php
	} 
}

// Theme Title
function theme_title() {
	global $page, $paged;
	
	$output =  wp_title( '|', false, 'right' );
	$output .=  get_bloginfo( 'name' );
	
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( !empty($site_description) && is_front_page() )
		$output .=  " | $site_description";
	
	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$output .= ' | ' . sprintf( __( 'Page %s', 'theme_front' ), max( $paged, $page ) );
	
	return $output;
}

// Comment Form Wrap
add_action('comment_form_top', 'custom_comment_form_top');
function custom_comment_form_top() {
	echo '<div class="theme-form">';
}
add_action('comment_form', 'custom_comment_form_bottom');
function custom_comment_form_bottom() {
	echo '</div>';
}

// Modify Shortcode Ultimate
delete_transient('su/generator/popup');
add_filter('su/data/shortcodes', 'nt_custom_su_shortcode');
function nt_custom_su_shortcode($shortcodes) {
	$filter = array('heading', 'tabs', 'tab', 'spoiler', 'accordion', 'divider', 'spacer', 'highlight', 'label', 'quote', 'pullquote', 'dropcap', 'frame', 'row', 'column', 'list', 'button', 'service', 'box', 'note', 'lightbox', 'tooltip', 'private', 'youtube', 'youtube_advanced', 'vimeo', 'screenr', 'dailymotion', 'audio', 'video', 'table', 'permalink', 'members', 'guests', 'feed', 'menu', 'subpages', 'siblings', 'document', 'gmap', 'slider', 'carousel', 'custom_gallery', 'posts', 'dummy_text', 'dummy_image', 'animate', 'meta', 'user', 'post', 'template');
	foreach($shortcodes as $key => $shortcode) {
		if( in_array($key, $filter) )
			unset($shortcodes[$key]);
	}

	$shortcodes['nt_box'] = array(
		'name' => 'Box',
		'type' => 'wrap',
		'group' => 'box',
		'atts' => array(
			'style' => array(
				'type' => 'select',
				'values' => array(
								'grey' => 'Grey',
								'blue' => 'Blue',
								'red' => 'Red',
								'yellow' => 'Yellow',
								'green' => 'Green'
							),
				'default' => 'grey',
				'name' => 'Style',
				'desc' => ''
			),
			'closable' => array(
				'type' => 'select',
				'values' => array(
								'closable' => 'Yes',
								'un-closable' => 'No'
							),
				'default' => 'closable',
				'name' => 'Closable',
				'desc' => ''
			),
		),
		'content' => 'Content',
		'value' => '',
		'desc' => '',
		'icon' => 'ellipsis-h'
	);

	$shortcodes['nt_button'] = array(
		'name' => 'Button',
		'type' => 'wrap',
		'group' => 'box',
		'atts' => array(
			'type' => array(
				'type' => 'select',
				'values' => array(
								'primary' => 'Primary',
								'secondary' => 'Secondary',
							),
				'default' => 'primary',
				'name' => 'Type',
				'desc' => ''
			),
			'style' => array(
				'type' => 'select',
				'values' => array(
								'' => 'Default (same as theme color)',
								'black' => 'Black',
								'green' => 'Green',
								'blue' => 'Blue',
								'red' => 'Red',
								'orange' => 'Orange',
								'magenta' => 'Magenta',
								'yellow' => 'Yellow'
							),
				'default' => '',
				'name' => 'Color',
				'desc' => ''
			),
			'size' => array(
				'type' => 'select',
				'values' => array(
								'small' => 'Small',
								'medium' => 'Medium',
								'large' => 'Large'
							),
				'default' => 'medium',
				'name' => 'Size',
				'desc' => ''
			),
			'target' => array(
				'type' => 'select',
				'values' => array(
								'_self' => '_self',
								'_blank' => '_blank'
							),
				'default' => '_self',
				'name' => 'Link Target',
				'desc' => ''
			),
			'url' => array(
				'type' => 'text',
				'default' => '',
				'name' => 'Link URL',
				'desc' => ''
			),
		),
		'content' => 'Button Text',
		'value' => '',
		'desc' => '',
		'icon' => 'ellipsis-h'
	);

	$shortcodes['nt_divider'] = array(
		'name' => 'Divider',
		'type' => 'single',
		'group' => 'box',
		'atts' => array(
			'style' => array(
				'type' => 'select',
				'values' => array(
								'1' => 'Style #1',
								'2' => 'Style #2'
							),
				'default' => '1',
				'name' => 'Style',
				'desc' => ''
			),
		),
		'desc' => '',
		'icon' => 'ellipsis-h'
	);

	$shortcodes['nt_spacer'] = array(
		'name' => 'Spacer',
		'type' => 'single',
		'group' => 'box',
		'atts' => array(
			'size' => array(
				'type' => 'slider',
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 20,
				'name' => 'Size',
				'desc' => ''
			),
		),
		'desc' => '',
		'icon' => 'ellipsis-h'
	);

	$shortcodes['nt_list'] = array(
		'name' => 'List',
		'type' => 'wrap',
		'group' => 'box',
		'atts' => array(
			'color' => array(
				'type' => 'select',
				'values' => array(
								'' => 'Default',
								'black' => 'Black',
								'green' => 'Green',
								'blue' => 'Blue',
								'red' => 'Red',
								'orange' => 'Orange',
								'magenta' => 'Magenta',
								'yellow' => 'Yellow'
							),
				'default' => '',
				'name' => 'Color',
				'desc' => ''
			),
			'icon' => array(
				'type' => 'select',
				'values' => $GLOBALS['font_awesome_list'],
				'default' => '',
				'name' => 'Icon',
				'desc' => ''
			),
		),
		'content' => "\n[li]List item[/li]\n[li]List item[/li]\n[li]List item[/li]\n",
		'desc' => '',
		'icon' => 'ellipsis-h'
	);

	$shortcodes['nt_icon'] = array(
		'name' => 'Icon',
		'type' => 'single',
		'group' => 'box',
		'atts' => array(
			'id' => array(
				'type' => 'select',
				'values' => $GLOBALS['font_awesome_list'],
				'default' => '',
				'name' => 'Icon',
				'desc' => ''
			),
		),
		'desc' => '',
		'icon' => 'ellipsis-h'
	);

	$shortcodes['nt_dropcap'] = array(
		'name' => 'Dropcap',
		'type' => 'single',
		'group' => 'box',
		'atts' => array(
			'letter' => array(
				'type' => 'text',
				'values' => '',
				'default' => '',
				'name' => 'Letter',
				'desc' => ''
			),
		),
		'desc' => '',
		'icon' => 'ellipsis-h'
	);

	$shortcodes['nt_image'] = array(
		'name' => 'Image',
		'type' => 'single',
		'group' => 'box',
		'atts' => array(
			'source' => array(
				'type' => 'upload',
				'default' => 'media',
				'name' => 'Image Source',
				'desc' => ''
			),
			'width' => array(
				'type' => 'select',
				'values' => array(
					'full' => 'Full Width (940px)',
					'full_sidebar' => 'Full Width with Sidebar (600px)',
					'one_half' => 'One Half (460px)',
					'one_third' => 'One Third (300px)',
					'two_third' => 'Two Third (620px)',
					'one_fourth' => 'One Fourth (290px)',
					'three_fourth' => 'Three Fourth (700px)',
				),
				'default' => 'full',
				'name' => 'Width',
				'desc' => ''
			),
			'link' => array(
				'type' => 'text',
				'values' => '',
				'default' => '',
				'name' => 'Link URL',
				'desc' => ''
			),
			'target' => array(
				'type' => 'select',
				'values' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				),
				'default' => '_self',
				'name' => 'Link Target',
				'desc' => ''
			),
			'lightbox' => array(
				'type' => 'select',
				'values' => array(
					'false' => 'None',
					'image' => 'Image',
					'youtube' => 'Youtube',
					'vimeo' => 'Vimeo',
				),
				'default' => 'false',
				'name' => 'Link Lightbox',
				'desc' => ''
			),
		),
		'desc' => '',
		'icon' => 'ellipsis-h'
	);

	$shortcodes['nt_video'] = array(
		'name' => 'Video',
		'type' => 'single',
		'group' => 'box',
		'atts' => array(
			'type' => array(
				'type' => 'select',
				'values' => array(
					'youtube' => 'Youtube',
					'vimeo' => 'Vimeo'
				),
				'default' => 'youtube',
				'name' => 'Type',
				'desc' => ''
			),
			'id' => array(
				'type' => 'text',
				'values' => '',
				'default' => '',
				'name' => 'Video ID',
				'desc' => ''
			),
			'width' => array(
				'type' => 'text',
				'values' => '',
				'default' => '',
				'name' => 'Width',
				'desc' => ''
			),
			'height' => array(
				'type' => 'text',
				'values' => '',
				'default' => '',
				'name' => 'Height',
				'desc' => ''
			),
		),
		'desc' => '',
		'icon' => 'ellipsis-h'
	);

	$shortcodes['nt_quote'] = array(
		'name' => 'Quote',
		'type' => 'wrap',
		'group' => 'box',
		'atts' => array(
			'name' => array(
				'type' => 'text',
				'values' => '',
				'default' => '',
				'name' => 'Name',
				'desc' => ''
			),
			'meta' => array(
				'type' => 'text',
				'values' => '',
				'default' => '',
				'name' => 'Meta',
				'desc' => ''
			),
		),
		'content' => '',
		'desc' => '',
		'icon' => 'ellipsis-h'
	);

	$shortcodes['nt_tabs'] = array(
		'name' => 'Tabs',
		'type' => 'wrap',
		'group' => 'box',
		'atts' => array(
		),
		'content' => "\n[tab title='title']content[/tab]\n[tab title='title']content[/tab]\n[tab title='title']content[/tab]\n",
		'desc' => '',
		'icon' => 'ellipsis-h'
	);

	$shortcodes['nt_accordions'] = array(
		'name' => 'Accordions',
		'type' => 'wrap',
		'group' => 'box',
		'atts' => array(
		),
		'content' => "\n[accordion title='title']content[/accordion]\n[accordion title='title']content[/accordion]\n[accordion title='title']content[/accordion]\n",
		'desc' => '',
		'icon' => 'ellipsis-h'
	);

	$shortcodes['nt_toggle'] = array(
		'name' => 'Toggle',
		'type' => 'wrap',
		'group' => 'box',
		'atts' => array(
			'title' => array(
				'type' => 'text',
				'values' => '',
				'default' => '',
				'name' => 'Title',
				'desc' => ''
			),
			'state' => array(
				'type' => 'select',
				'values' => array(
					'open' => 'Open',
					'closed' => 'Closed'
				),
				'default' => 'open',
				'name' => 'State',
				'desc' => ''
			),
		),
		'content' => '',
		'desc' => '',
		'icon' => 'ellipsis-h'
	);

	return $shortcodes;
}
