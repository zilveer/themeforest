<?php
/**
 * @package WordPress
 * @subpackage Fast_Blog_Theme
 * @since Fast Blog 1.0
 */
?>

<div class="wrap">

	<!-- Header -->
	<h2><?php _e('Fast Blog Options', 'fastblog'); ?></h2>
	<?php if (!FASTBLOG_TUMBLOG): ?>
		<div id="message" class="error"><p><?php _e("<strong>WooTumblog</strong> plugin is not active, so Fast Blog theme's features are limited.", 'fastblog'); ?></p></div>
	<?php endif; ?>
	<?php if (isset($_GET['settings-updated']) && ($_GET['settings-updated'] == 'true')): ?>
		<div id="message" class="updated"><p><?php _e('Settings saved.', 'fastblog'); ?></p></div>
	<?php endif; ?>
	<!-- // Header -->

	<!-- Update -->
	<?php tb_options_update(FASTBLOG_UPDATE_URL, fastblog_get_option('_update_data'), 'fastblog_theme_update', 'fastblog'); ?>
	<!-- // Update -->

	<form method="post" action="options.php">

		<?php settings_fields('fastblog_options'); ?>

		<!-- Appearance options -->
		<?php
			tb_options_open_section(__('Appearance', 'fastblog'));
			foreach (tb_get_directory(get_template_directory().'/schemes') as $filename) {
				$schemes[$filename] = str_replace(array('_', '-'), array(' ', ' + '), ucfirst($filename));
			}
			tb_options_field(__('Color scheme', 'fastblog'), '', 'select', 'fastblog[scheme]', fastblog_get_option('scheme'), $schemes);
			tb_options_field(__('Favicon path', 'fastblog'), '', 'input_code', 'fastblog[favicon]', fastblog_get_option('favicon'), '('.__('empty = default', 'fastblog').')');
			tb_options_field(__('Sidebar position', 'fastblog'), '', 'radio_group', 'fastblog[sidebar]', fastblog_get_option('sidebar'), array(
				'left'  => __('Left', 'fastblog'),
				'right' => __('Right', 'fastblog')
			));
			tb_options_close_section();
		?>
		<!-- // Appearance options -->

		<!-- Header options -->
		<?php
			tb_options_open_section(__('Header', 'fastblog'));
			tb_options_open_field(__('Height', 'fastblog'));
			tb_options_input_number('fastblog[header][height]', fastblog_get_option('header/height'), '', 3); echo ' px';
			tb_options_description('('.__('default', 'fastblog').' = 65px)');
			tb_options_close_field();
			tb_options_open_field(__('Logo text or image path', 'fastblog'));
			tb_options_input_code('fastblog[header][logo][logo]', fastblog_get_option('header/logo/logo'), '('.__('empty = default', 'fastblog').')');
			tb_options_checkbox('fastblog[header][logo][center]', fastblog_get_option('header/logo/center'), __('Center logo', 'fastblog'));
			tb_options_close_field();
			tb_options_field(__('Tagline', 'fastblog'), '', 'checkbox', "fastblog[tagline]", fastblog_get_option('tagline'), __('Show tagline', 'fastblog'));
			tb_options_field(__('Contact information', 'fastblog'), '', 'textarea_code', 'fastblog[header][contact]', fastblog_get_option('header/contact'));
			tb_options_close_section();
		?>
		<!-- // Header options -->

		<!-- Menu options -->
		<?php
			tb_options_open_section(__('Menu', 'fastblog'));
			$menu_content_array = array(
				''           => __('None', 'fastblog'),
				'pages'      => __('Pages', 'fastblog'),
				'categories' => __('Categories', 'fastblog')
			);
			if (FASTBLOG_TUMBLOG && FASTBLOG_TUMBLOG_CONTENT_TAXONOMY) {
				$menu_content_array['tumblog'] = __('Tumblogs', 'fastblog');
			}
			foreach (array(
				'main'   => __('Main navigation menu content', 'fastblog'),
				'footer' => __('Footer navigation menu content', 'fastblog')
			) as $menu => $label) {
				$_menu_content_array = $menu == 'main' ? array_slice($menu_content_array, 1, null, true) : $menu_content_array;
				tb_options_field($label, __('Matters only if you do not select another in <code>Appearance/Menus</code>.', 'fastblog'), 'radio_group', "fastblog[menu][content][{$menu}]", fastblog_get_option('menu/content/'.$menu), $_menu_content_array);
			}
			tb_options_field(__('Search', 'fastblog'), '', 'checkbox', "fastblog[search]", fastblog_get_option('search'), __('Display search form in the main navigation menu', 'fastblog'));
			tb_options_close_section();
		?>
		<!-- // Menu options -->

		<!-- Content options -->
		<?php
			tb_options_open_section(__('Content', 'fastblog'));
			tb_options_open_field(__('Images', 'fastblog'));
			tb_options_checkbox("fastblog[fancybox][enabled]", fastblog_get_option('fancybox/enabled'), __('Use Fancybox to show images', 'fastblog'));
			echo '<div class="indent-1">';
			tb_options_checkbox("fastblog[fancybox][show_title]", fastblog_get_option('fancybox/show_title'), __('Display image title', 'fastblog'));
			echo '</div>';
			tb_options_close_field();
			tb_options_close_section();
		?>
		<!-- // Content options -->

		<!-- Post options -->
		<?php
			tb_options_open_section(__('Post', 'fastblog'));
			tb_options_open_field(__('Settings', 'fastblog'));
			tb_options_checkbox("fastblog[post][hide_title]", fastblog_get_option('post/hide_title'), __("Don't display post titles on post pages", 'fastblog'));
			tb_options_checkbox("fastblog[post][about]", fastblog_get_option('post/about'), __('Show author details below posts', 'fastblog'));
			tb_options_close_field();
			tb_options_field(__('Post meta', 'fastblog'), '', 'checkbox_group', "fastblog[post][meta]", fastblog_get_option('post/meta'), array(
				'date'       => __('Date', 'fastblog'),
				'category'   => __('Post category', 'fastblog'),
				'tags'       => __('Tags (inside post only)', 'fastblog'),
				'comments'   => __('Comments number', 'fastblog'),
				'author'     => __('Author', 'fastblog'),
				'short_url'  => __('Short URL', 'fastblog'),
				'admin_edit' => __('Admin edit link', 'fastblog')
			));
			tb_options_field(__('Short URL', 'fastblog'), '', 'checkbox', "fastblog[post][disable_short_url]", fastblog_get_option('post/disable_short_url'), __("Don't create short URLs if showing them is turned off", 'fastblog'));
			tb_options_close_section();
		?>
		<!-- // Post options -->

		<!-- Page options -->
		<?php
			tb_options_open_section(__('Page', 'fastblog'));
			tb_options_field(__('Settings', 'fastblog'), '', 'checkbox', "fastblog[page][hide_title]", fastblog_get_option('page/hide_title'), __("Don't display page titles on pages", 'fastblog'));
			tb_options_field(__('Page meta', 'fastblog'), '', 'checkbox_group', "fastblog[page][meta]", fastblog_get_option('page/meta'), array(
				'date'       => __('Modification date', 'fastblog'),
				'comments'   => __('Comments number', 'fastblog'),
				'admin_edit' => __('Admin edit link', 'fastblog')
			));
			tb_options_close_section();
		?>
		<!-- // Page options -->

		<!-- Typography options -->
		<?php
			tb_options_open_section(__('Typography', 'fastblog'));
			$fonts = array('' => '('.__('None', 'fastblog').')');
			foreach (tb_get_directory( get_template_directory().'/js/fonts') as $filename) {
				if ($fontfamily = tb_cufon_font_get_name(get_template_directory().'/js/fonts/'.$filename)) {
					$fonts[$filename.'|'.$fontfamily] = $fontfamily;
				}
			}
			tb_options_open_field(__('Fonts', 'fastblog'));
			$typografy_fonts_captions = array(
				'logo'         => __('Logo', 'fastblog'),
				'tagline'      => __('Tagline', 'fastblog'),
				'menu'         => __('Menu', 'fastblog'),
				'post_title'   => __('Post/page title', 'fastblog'),
				'widget_title' => __('Widget title', 'fastblog'),
				'headlines'    => __('Headlines', 'fastblog'),
				'shortcode'    => __('Cufon shortcode', 'fastblog'),
				'other'        => __('Other elements', 'fastblog'),
				'custom'       => __('Custom elements', 'fastblog')
			);
			echo '<table class="clear">';
			foreach (fastblog_get_option('typography/fonts') as $element => $font) {
				echo '<tr><td>'.$typografy_fonts_captions[$element].'</td><td>';
				tb_options_select("fastblog[typography][fonts][{$element}]", $font, $fonts);
				echo '</td></tr>';
			}
			echo '</table>';
			tb_options_description(__('If you use more than one version of the Myriad font, select the biggest version you need for all of them.', 'fastblog'));
			tb_options_close_field();
			tb_options_field(__('Custom elements CSS selector(s)', 'fastblog'), '', 'input_code', 'fastblog[typography][custom_selector]', fastblog_get_option('typography/custom_selector'));
			tb_options_close_section();
		?>
		<!-- // Typography options -->

		<!-- Contact form options -->
		<?php
			tb_options_open_section(__('Contact form', 'fastblog'));
			tb_options_field(__('Recipient e-mail address', 'fastblog'), '', 'input_code', 'fastblog[contact_form][email]', fastblog_get_option('contact_form/email'));
			tb_options_open_field(__('E-mail subject', 'fastblog'));
			tb_options_input('fastblog[contact_form][subject]', fastblog_get_option('contact_form/subject'));
			echo '<table class="clear">';
			foreach (array(
				'blogname' => __('Blog name', 'fastblog'),
				'blogurl'  => __('Blog URL', 'fastblog'),
				'name'     => __('Name field', 'fastblog'),
				'email'    => __('E-mail field', 'fastblog'),
				'subject'  => __('Subject field', 'fastblog')
			) as $variable => $label) {
				?>
				<tr>
					<td><span class="description"><code>%<?php echo $variable; ?>%</code></span></td>
					<td><span class="description"><?php echo $label; ?></span></td>
				</tr>
				<?php
			}
			echo '</table>';
			tb_options_close_field();
			tb_options_field(__('Settings', 'fastblog'), '', 'checkbox', 'fastblog[contact_form][from_header]', fastblog_get_option('contact_form/from_header'), __('Override <code>From</code> header with <code>Name</code> field', 'fastblog'));
			tb_options_close_section();
		?>
		<!-- // Contact form options -->

		<!-- Advanced options -->
		<?php
			tb_options_open_section(__('Advanced', 'fastblog'));
			tb_options_field(__('Custom CSS code', 'fastblog'), '', 'textarea_code', 'fastblog[custom_css]', fastblog_get_option('custom_css'));
			tb_options_field(__('Custom JavaScript code', 'fastblog'), '', 'textarea_code', 'fastblog[custom_js]', fastblog_get_option('custom_js'));
			tb_options_field(__('Bit.ly login', 'fastblog'), '', 'input_code', 'fastblog[bitly][login]', fastblog_get_option('bitly/login'), '('.__('empty = default built-in', 'fastblog').')');
			tb_options_field(__('Bit.ly API key', 'fastblog'), '', 'input_code', 'fastblog[bitly][api_key]', fastblog_get_option('bitly/api_key'), '('.__('empty = default built-in', 'fastblog').')');
			tb_options_close_section();
		?>
		<!-- // Advanced options -->

		<!-- Other options -->
		<?php
			tb_options_open_section(__('Other', 'fastblog'));
			tb_options_field(__('Footer text', 'fastblog'), '', 'input_code', 'fastblog[footer]', fastblog_get_option('footer'), '('.__('empty = auto', 'fastblog').')');
			tb_options_field(__('Alternative feed URL', 'fastblog'), __('E.g. FeedBurner.', 'fastblog'), 'input_code', 'fastblog[feed]', fastblog_get_option('feed'));
			tb_options_field(__('Google Analytics code', 'fastblog'), __('Or another tracking code.', 'fastblog'), 'textarea_code', 'fastblog[analytics]', fastblog_get_option('analytics'));
			tb_options_close_section();
		?>
		<!-- // Other options -->

		<!-- Submit -->
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes', 'fastblog'); ?>" />
		</p>
		<!-- // Submit -->

		<!-- Fixed submit -->
		<div class="submit-fixed">
			<input type="button" class="button-secondary button-tab" value="<?php _e('Expand all', 'fastblog'); ?>" />
			<input type="button" class="button-secondary button-tab" value="<?php _e('Collapse all', 'fastblog'); ?>" />
			<input type="submit" class="button-primary" value="<?php _e('Save Changes', 'fastblog'); ?>" />
		</div>
		<!-- // Fixed submit -->

	</form>

</div>