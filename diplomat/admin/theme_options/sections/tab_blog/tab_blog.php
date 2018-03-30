<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
//$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';
//*************************************

$content = array(
	'block0' => array(
		'title' => '',
		'type' => 'items_block',
		'items' => array(
			'date_format' => array(
				'title' => __('Date format', 'diplomat'),
				'type' => 'select',
				'default_value' => TMM_OptionsHelper::get_default_value('date_format'),
				'values' => array(
					'd.m.Y' => date('d.m.y'),
					'm.d.Y' => date('m.d.y'),
					'j, n, Y' => date('j, n, Y'),
					'F j, Y' => date('F j, Y'),
					'Y-m-d' => date('Y-m-d'),
					'm/d/Y' => date('m/d/Y'),
					'd/m/Y' => date('d/m/Y'),
					'Y/m/d' => date('Y/m/d')

				),
				'description' => __('General website date format. Do not edit this field to use default theme date format.', 'diplomat'),
				'custom_html' => '',
				'is_reset' => true
			),
		)
	),
	'block1' => array(
		'title' => __('Listing Page', 'diplomat'),
		'type' => 'items_block',
		'items' => array(			
			'excerpt_symbols_count' => array(
				'title' => __('Excerpt Symbols Count', 'diplomat'),
				'type' => 'slider',
				'default_value' => TMM_OptionsHelper::get_default_value('excerpt_symbols_count'),
				'min' => 10,
				'max' => 900,
				'description' => __('This option will excerpt full article content with a necessary amount of symbols on the blog listing page.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_listing_show_all_metadata' => array(
				'title' => __('Show/Hide All Meta Info', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_listing_show_all_metadata'),
				'description' => __('If checked, all the meta info will disappear in articles such as date, author, tags etc. This option will owerride the next separate four options.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_listing_show_date' => array(
				'title' => __('Show/Hide Date Info', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_listing_show_date'),
				'description' => __('If checked, the date info will appear in articles.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_listing_show_author' => array(
				'title' => __('Show/Hide Author Info', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_listing_show_author'),
				'description' => __('If checked, the author info will appear in articles.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_listing_show_tags' => array(
				'title' => __('Show/Hide Tags Info', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_listing_show_tags'),
				'description' => __('If checked, the tags info will appear in articles.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_listing_show_category' => array(
				'title' => __('Show/Hide Category Info', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_listing_show_category'),
				'description' => __('If checked, the category info will appear in articles.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_listing_show_comments' => array(
				'title' => __('Show/Hide Comments Number', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_listing_show_comments'),
				'description' => __('If checked, the comments number will appear in articles.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_listing_show_likes' => array(
				'title' => __('Show/Hide Likes Number', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_listing_show_likes'),
				'description' => __('If checked, the likes number will appear in articles.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_listing_effect' => array(
				'title' => __('Effect for Appearing Post', 'diplomat'),
				'type' => 'select',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_listing_effect'),
				'values' => array(
					'none' => __('None', 'diplomat'),
					'elementFade' => __('Element Fade', 'diplomat'),
					'opacity' => __('Opacity', 'diplomat'),
					'opacity2xRun' => __('Opacity 2x Run', 'diplomat'),
					'scale' => __('Scale', 'diplomat'),
					'slideRight' => __('Slide Right', 'diplomat'),
					'slideLeft' => __('Slide Left', 'diplomat'),
					'slideDown' => __('Slide Down', 'diplomat'),
					'slideUp' => __('Slide Up', 'diplomat'),
					'slideUp2x' => __('Slide Up 2x', 'diplomat'),
					'extraRadius' => __('Extra Radius', 'diplomat')
				),
				'description' => __('Effect for Appearing Post.', 'diplomat'),
				'custom_html' => ''
			),
		)
	),
	'block2' => array(
		'title' => __('Single Page', 'diplomat'),
		'type' => 'items_block',
		'items' => array(
			'blog_single_show_bio' => array(
				'title' => __('Show/Hide Author Bio', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_single_show_bio'),
				'description' => __('If checked, author\'s bio box will appear at the end of each article.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_single_show_comments' => array(
				'title' => __('Show/Hide Comments', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_single_show_comments'),
				'description' => __('If checked, all the visitors will be allowed to post their comments to articles.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_single_show_fb_comments' => array(
				'title' => __('Show/Hide Facebook Comments', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_single_show_fb_comments'),
				'description' => __('If checked, all the visitors will be allowed to post their comments to articles with faceebok.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_single_show_social_share' => array(
				'title' => __('Show/Hide Social Share', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_single_show_social_share'),
				'description' => __('If checked, social share box will appear at the end of each article.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_single_show_posts_nav' => array(
				'title' => __('Show/Hide Posts Navigation', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_single_show_posts_nav'),
				'description' => __('If checked, posts navigation box will appear at the end of each article.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_single_show_related_posts' => array(
				'title' => __('Show/Hide Related Posts', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_single_show_related_posts'),
				'description' => __('If checked, related posts will appear at the end of each article.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_single_show_related_posts_with_image' => array(
				'title' => __('Show Related Posts Only With Images?', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_single_show_related_posts_with_image'),
				'description' => __('If checked, related posts will only be shown with featured images at the end of each article.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_single_show_all_metadata' => array(
				'title' => __('Show/Hide All Meta Info', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_single_show_all_metadata'),
				'description' => __('If checked, all the meta info will disappear under article title such as date, author, tags etc. This option will owerride the next separate four options.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_single_show_date' => array(
				'title' => __('Show/Hide Date Info', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_single_show_date'),
				'description' => __('If checked, the date info will appear under article title.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_single_show_author' => array(
				'title' => __('Show/Hide Author Info', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_single_show_author'),
				'description' => __('If checked, the author info will appear under article title.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_single_show_tags' => array(
				'title' => __('Show/Hide Tags Info', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_single_show_tags'),
				'description' => __('If checked, the tags info will appear under article title.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_single_show_category' => array(
				'title' => __('Show/Hide Category Info', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_single_show_category'),
				'description' => __('If checked, the category info will appear under article title.', 'diplomat'),
				'custom_html' => ''
			),
			'blog_single_show_likes' => array(
				'title' => __('Show/Hide Post Likes Number', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => TMM_OptionsHelper::get_default_value('blog_single_show_likes'),
				'description' => __('If checked, the post likes number will appear under article title.', 'diplomat'),
				'custom_html' => ''
			),
		)
	),
);




//*************************************
//*************************************
$sections = array(
	'name' => __('Blog/News', 'diplomat'),
	'css_class' => 'shortcut-blog',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
        'menu_icon' => 'dashicons-format-standard'    
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

