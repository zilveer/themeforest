<?php
require_once(dirname(__FILE__) . '/admin_options/AdminPageFactory.php');

function theme_options_pages() {
	/*-------------------- Appearance Options Subpage --------------------*/
	ap_add_sub_page('Appearance', __('Theme Options', TEMPLATENAME), __('Theme Options', TEMPLATENAME), 'administrator', 'custom_theme_options');
	ap_page_title(__('Theme Options', TEMPLATENAME));
	ap_page_icon('index');

	/*-------------------- General Options --------------------*/
	ap_add_section('general', __('General', TEMPLATENAME));
	ap_add_checkbox(array(
		'name' => 'show_switcher',
		'title' => __('Display color switcher?', TEMPLATENAME),
		'default' => true,
		'desc' => __('Check this to display color switcher on the frontend.', TEMPLATENAME),
	));
	$_theme_colors = theme_get_color_styles();
	reset($_theme_colors);
	ap_add_select(array(
		'name' => 'default_theme_color',
		'title' => __('Choose color scheme', TEMPLATENAME),
		'default' => key($_theme_colors),
		'options' => $_theme_colors,
	));
	ap_add_upload(array(
		'name' => 'logo',
		'title' => __('Upload logo', TEMPLATENAME),
		'class' => 'large-text',
	));
	ap_add_upload(array(
		'name' => 'favicon',
		'title' => __('Upload favicon', TEMPLATENAME),
		'class' => 'large-text',
		'desc' => __('File type: .ico or .png File dimensions: 16x16, 32x32.', TEMPLATENAME),
	));
	ap_add_checkbox(array(
		'name' => 'use_breadcrumbs',
		'title' => __('Display breadcrumbs?', TEMPLATENAME),
		'default' => true,
		'desc' => __('Check this to display breadcrumbs.', TEMPLATENAME),
	));
	ap_add_select(array(
		'name' => 'default_side_sidebar',
		'title' => __('Default side sidebar', TEMPLATENAME),
		'default' => 'disable',
		'options' => array('disable' => __('Disable', TEMPLATENAME)),
		'options_func' => 'get_registered_sidebars',
		'desc' => __('Choose sidebar for side of page.', TEMPLATENAME),
	));

	ap_add_select(array(
		'name' => 'default_bottom_sidebar',
		'title' => __('Default bottom sidebar', TEMPLATENAME),
		'default' => 'disable',
		'options' => array('disable' => __('Disable', TEMPLATENAME)),
		'options_func' => 'get_registered_sidebars',
		'desc' => __('Choose sidebar for bottom of page.', TEMPLATENAME),
	));

	ap_add_input(array(
		'name' => 'copyright',
		'title' => __('Footer copyright text', TEMPLATENAME),
		'default' => 'Copyright &copy; 2010 '.get_bloginfo('name').' company. All rights reserved.',
		'desc' => __('Type a copyright text.', TEMPLATENAME),
		'class' => 'large-text code',
	));
	ap_add_textarea(array(
		'name' => 'custom_css',
		'title' => __('Custom CSS', TEMPLATENAME),
		'class' => 'large-text code',
	));
	/*-------------------- Theme Fonts Options --------------------*/
	ap_add_section('fonts', __('Fonts', TEMPLATENAME));
	ap_add_radio(array(
		'name' => 'font_family',
		'title' => __('Base theme font', TEMPLATENAME),
		'default' => 'Arial,Helvetica,Garuda,sans-serif',
		'options' => theme_base_font_options(),
	));
	ap_add_checkbox(array(
		'name' => 'use_cufon_font',
		'title' => __('Enable Cufon', TEMPLATENAME),
		'default' => true,
		'desc' => __('Check this to use cufon font.', TEMPLATENAME),
	));
	ap_add_radio(array(
		'name' => 'cufon_font',
		'title' => __('Choose cufon fonts', TEMPLATENAME),
		'default' => 'MgOpen Modata',
		'options_func' => 'theme_cufon_font_options',
	));
	/*-------------------- Home Page Options --------------------*/
	ap_add_section('home', __('Home & Slider', TEMPLATENAME));
	ap_add_radio(array(
		'name' => 'show_on_front',
		'title' => __('Home page displays', TEMPLATENAME),
		'options' => array(
			'posts' => __('Your latest posts', TEMPLATENAME),
			'page' => sprintf(__('A %sstatic page%s (select bellow)', TEMPLATENAME), '<a href="edit.php?post_type=page">', '</a>'),
		),
		'default' => 'posts',
	));

	ap_add_select(array(
		'name' => 'page_on_front',
		'title' => __('Static home page', TEMPLATENAME),
		'options' => array(
			0  => __('- Select -', TEMPLATENAME),
		) + get_registered_pages(),
		'default' => '0',
	));

	ap_add_checkbox(array(
		'name' => 'use_feature_home_box',
		'title' => __('Show Special box?', TEMPLATENAME),
		'default' => false,
		'desc' => __('Check this to show special box.', TEMPLATENAME),
	));

	ap_add_textarea(array(
		'name' => 'feature_home_box',
		'title' => __('Home page Special box', TEMPLATENAME),
		'default' => '',
		'desc' => __('Content area for special gray box, which is under slider.', TEMPLATENAME),
		'class' => 'large-text code',
	));

	global $_theme_sliders_list;
	ap_add_select(array(
		'name' => 'slider_type',
		'title' => __('Choose a slider type', TEMPLATENAME),
		'default' => '',
		'options' => array('disable' => __('Disable', TEMPLATENAME)) + $_theme_sliders_list,
		'desc' => __('Slider to be Displayed in Header.', TEMPLATENAME),
		'onchange' => 'this.form.submit();',
	));

	ap_add_input(array(
		'name' => 'slider_count_items',
		'title' => __('Number of slides', TEMPLATENAME),
		'default' => '',
		'desc' => __('Number of slides to be displayed. (Empty to show all the slides)', TEMPLATENAME),
		'class' => 'small-text',
	));

	ap_add_select(array(
		'name' => 'slider_post_order',
		'title' => __('Order by', TEMPLATENAME),
		'default' => 'rand',
		'options' => array(
			'none' => __('No order', TEMPLATENAME),
			'rand' => __('Randomly', TEMPLATENAME),
			'date' => __('Date', TEMPLATENAME),
		),
		'desc' => __('Choose an option to order slides.', TEMPLATENAME),
	));

	ap_add_select(array(
		'name' => 'slider_sort_order',
		'title' => __('Sort type', TEMPLATENAME),
		'default' => 'ASC',
		'options' => array(
			'ASC' => __('Ascendent', TEMPLATENAME),
			'DESC' => __('Descendent', TEMPLATENAME),
		),
		'desc' => __('Disabled if "Order By" option is "Randomly"', TEMPLATENAME),
	));

	ap_add_checkbox(array(
		'name' => 'slider_caption',
		'title' => __('Captions', TEMPLATENAME),
		'default' => true,
		'desc' => __('Check this to display captions over the slides. (If choosen slider supports this option)', TEMPLATENAME),
	));

	ap_add_checkbox(array(
		'name' => 'slider_caption_title',
		'title' => __('Captions titles', TEMPLATENAME),
		'default' => true,
		'desc' => __('Check this to display slide title in captions.', TEMPLATENAME),
	));

	ap_add_checkbox(array(
		'name' => 'slider_caption_content',
		'title' => __('Captions content', TEMPLATENAME),
		'default' => true,
		'desc' => __('Check this to display slide content in captions.', TEMPLATENAME),
	));

	ap_add_checkbox(array(
		'name' => 'slider_caption_more',
		'title' => __('Captions "more" button?', TEMPLATENAME),
		'default' => true,
		'desc' => __('Check this to display "more" button.', TEMPLATENAME),
	));

	ap_add_input(array(
		'name' => 'slider_caption_more_text',
		'title' => __('"More" button text', TEMPLATENAME),
		'default' => __('Read more', TEMPLATENAME),
		'desc' => __('"More" buttons text for slides captions.', TEMPLATENAME)
	));

	ap_add_checkbox(array(
		'name' => 'slider_link',
		'title' => __('Use linked slides?', TEMPLATENAME),
		'default' => true,
		'desc' => __('Check this to make slider images linked. (If choosen slider supports this option)', TEMPLATENAME),
	));
	/*-------------------- Sliders Options Pages --------------------*/
	theme_slider_options();
	/*-------------------- Portfolio Page Options --------------------*/
	ap_add_section('portfolio', __('Portfolio & Gallery', TEMPLATENAME));
	ap_add_select(array(
		'name' => 'portfolio_layout',
		'title' => __('Portfolio page layout', TEMPLATENAME),
		'default' => 'portfolio2',
		'options' => array(
			'portfolio2' => __('1 columns', TEMPLATENAME),
			'portfolio3' => __('2 columns', TEMPLATENAME),
			'portfolio4' => __('3 columns', TEMPLATENAME),
		),
		'desc' => __('Choose layout type for Portfolio Page.', TEMPLATENAME),
	));
	ap_add_input(array(
		'name' => 'portfolio_rows',
		'title' => __('Number of lines (portfolio page)', TEMPLATENAME),
		'default' => '4',
		'desc' => __('Only regards for portfolio page', TEMPLATENAME),
		'class' => 'small-text',
	));
	ap_add_select(array(
		'name' => 'portfolio_bottom_sidebar',
		'title' => __('Portfolio bottom sidebar', TEMPLATENAME),
		'default' => 'disable',
		'options' => array('disable' => __('Disable', TEMPLATENAME)),
		'options_func' => 'get_registered_sidebars',
		'desc' => __('Choose your bottom sidebar for portfolio page.', TEMPLATENAME),
	));

	ap_add_input(array(
		'name' => 'portfolio_more_text',
		'title' => __('More button text', TEMPLATENAME),
		'default' => __('Read more', TEMPLATENAME),
		'desc' => __('Leave it blank if you do not want to display this button.', TEMPLATENAME),
	));

	ap_add_input(array(
		'name' => 'portfolio_target_text',
		'title' => __('Target button text', TEMPLATENAME),
		'default' => __('Visit website', TEMPLATENAME),
	));

	ap_add_checkbox(array(
		'name' => 'portfolio_show_date',
		'title' => __('Display a meta date information?', TEMPLATENAME),
		'default' => true,
		'desc' => __('Check this to display meta date information for portfolio single page.', TEMPLATENAME),
	));

	ap_add_checkbox(array(
		'name' => 'portfolio_show_clients',
		'title' => __('Display a clients meta information?', TEMPLATENAME),
		'default' => true,
		'desc' => __('Check this to display a post clients for portfolio single page.', TEMPLATENAME),
	));

	ap_add_checkbox(array(
		'name' => 'portfolio_show_division',
		'title' => __('Display a divisions meta information?', TEMPLATENAME),
		'default' => true,
		'desc' => __('Check this to display a post divisions for portfolio single page.', TEMPLATENAME),
	));

	ap_add_checkbox(array(
		'name' => 'portfolio_show_comments',
		'title' => __('Enable comments?', TEMPLATENAME),
		'default' => true,
		'desc' => __('Check this to enable a post comments for portfolio posts.', TEMPLATENAME),
	));

	ap_add_select(array(
		'name' => 'gallery_bottom_sidebar',
		'title' => __('Gallery bottom sidebar', TEMPLATENAME),
		'default' => 'disable',
		'options' => array('disable' => __('Disable', TEMPLATENAME)),
		'options_func' => 'get_registered_sidebars',
		'desc' => __('Choose bottom sidebar for gallery pages.', TEMPLATENAME),
	));

	ap_add_input(array(
		'name' => 'gallery_limit',
		'title' => __('Number of thumbnails for gallery page', TEMPLATENAME),
		'default' => '18',
		'desc' => __('Number of thumbtails to be displayed on the gallery page', TEMPLATENAME),
		'class' => 'small-text',
	));
	ap_add_select(array(
		'name' => 'lightbox_skin',
		'title' => __('LightBox skin', TEMPLATENAME),
		'default' => 'light_square',
		'options' => array(
			'dark_rounded' => __('Dark Rounded', TEMPLATENAME),
			'dark_square' => __('Dark Square', TEMPLATENAME),
			'facebook' => __('Facebook', TEMPLATENAME),
			'light_rounded' => __('Light Rounded', TEMPLATENAME),
			'light_square' => __('Light Square', TEMPLATENAME),
		),
		'desc' => __('Choose a skin for LightBox.', TEMPLATENAME),
	));
	/*-------------------- Blog Options --------------------*/
	ap_add_section('blog', __('Blog posts & Pages', TEMPLATENAME));

	ap_add_select(array(
		'name' => 'blog_side_sidebar',
		'title' => __('Blog side sidebar', TEMPLATENAME),
		'default' => 'disable',
		'options' => array('disable' => __('Disable', TEMPLATENAME)),
		'options_func' => 'get_registered_sidebars',
		'desc' => __('Choose side sidebar for blog pages.', TEMPLATENAME),
	));

	ap_add_select(array(
		'name' => 'blog_bottom_sidebar',
		'title' => __('Blog bottom sidebar', TEMPLATENAME),
		'default' => 'disable',
		'options' => array('disable' => __('Disable', TEMPLATENAME)),
		'options_func' => 'get_registered_sidebars',
		'desc' => __('Choose bottom sidebar for blog pages.', TEMPLATENAME),
	));

	ap_add_input(array(
		'name' => 'blog_more_text',
		'title' => __('More button text', TEMPLATENAME),
		'default' => __('Read more', TEMPLATENAME),
		'desc' => __('Leave it blank if you do not want to display this button.', TEMPLATENAME),
	));

	ap_add_input(array(
		'name' => 'searches_limit',
		'title' => __('Search posts limit', TEMPLATENAME),
		'default' => '10',
		'desc' => __('Type a number of posts to be displayed on search results page', TEMPLATENAME),
		'class' => 'small-text',
	));
	global $_theme_layouts;
	ap_add_select(array(
		'name' => 'default_blog_layout',
		'title' => __('Default layout for blog', TEMPLATENAME),
		'default' => 1,
		'options' => $_theme_layouts,
		'desc' => __('Select default layout for blog.', TEMPLATENAME),
	));
	ap_add_select(array(
		'name' => 'default_pages_layout',
		'title' => __('Default layout for pages', TEMPLATENAME),
		'default' => 3,
		'options' => $_theme_layouts,
		'desc' => __('Select default layout for pages.', TEMPLATENAME),
	));

	ap_add_checkbox(array(
		'name' => 'show_about_autor',
		'title' => __('Show about autor box?', TEMPLATENAME),
		'default' => true,
	));

	ap_add_select(array(
		'name' => 'page_404',
		'title' => __('Page of error 404', TEMPLATENAME),
		'default' => '',
		'options' => array('default' => __('Embedded 404 page', TEMPLATENAME)) + get_registered_pages(),
		'desc' => __('Select your 404 page.', TEMPLATENAME),
	));
	/*-------------------- SEO Options --------------------*/
	ap_add_section('google', __('Google Analytics', TEMPLATENAME));
	ap_add_checkbox(array(
		'name' => 'ga_use',
		'title' => __('Use Google Analytics', TEMPLATENAME),
		'default' => false,
		'desc' => __('Check this if you want to enable Google Analytics Service', TEMPLATENAME),
	));
	ap_add_textarea(array(
		'name' => 'ga_code',
		'title' => __('Google Analytics Code', TEMPLATENAME),
		'default' => "<script type=\"text/javascript\">\n\n  var _gaq = _gaq || [];\n  _gaq.push(['_setAccount', 'XX-XXXXXXXX-X']);\n  _gaq.push(['_trackPageview']);\n\n  (function() {\n	 var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;\n	 ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';\n	 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);\n  })();\n\n</script>",
		'desc' => sprintf(__('Paste your %sGoogle Analytics%s code here, it will get applied to each page.', TEMPLATENAME), '<a href="http://www.google.com/analytics/" target="_blank">', '</a>'),
		'class' => 'large-text code',
	));

	/*-------------------- Social Options --------------------*/
	ap_add_section('social', __('Social', TEMPLATENAME));
	global $_theme_social_links;
	foreach ($_theme_social_links as $key => $link) {
		ap_add_input(array(
			'name' => $key.'_social_link',
			'title' => '<b>'.ucfirst($link).'</b><img src="'.get_bloginfo('template_url')."/images/social/{$key}.png" .'">',
			'default' => '',
			'class' => 'large-text',
		));
	}
}
add_action('init', 'theme_options_pages');


function get_registered_pages() {
	$pages = get_pages();
	$out = array();
	foreach ($pages as $page)
		$out[$page->ID] = $page->post_title;
	return $out;
}

?>