<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */

// -----------------------------------------------------------------------------

require_once get_template_directory().'/drone/drone.php'; // 5.6.7

// -----------------------------------------------------------------------------

class Website extends \Drone\Theme
{

	// -------------------------------------------------------------------------

	/**
	 * Item page URL
	 *
	 * @var string
	 */
	const ITEM_PAGE_URL = 'http://themeforest.net/item/website-responsive-wordpress-theme/1739143/?ref=kubasto';

	// -------------------------------------------------------------------------

	/**
	 * Available sidebars
	 *
	 * @var array
	 */
	private $sidebars_def;

	// -------------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @since 5.5
	 */
	protected function __construct()
	{
		parent::__construct();
		$this->theme->id_ = $this->theme->id; // backward compatybility (child themes)
	}

	// -------------------------------------------------------------------------

	/**
	 * Options setup
	 *
	 * @since 1.0
	 * @see \Drone\Theme::onSetupOptions()
	 *
	 * @param \Drone\Options\Group\Theme $theme_options
	 */
	protected function onSetupOptions(\Drone\Options\Group\Theme $theme_options)
	{

		// Appearance
		$appearance = $theme_options->addGroup('appearance', __('Appearance', 'website'));
			$appearance->addOption('group', 'scheme', 'bright', __('Color scheme', 'website'), '', array('options' => array(
				'bright' => __('Bright', 'website'),
				'dark'   => __('Dark', 'website')
			)));
			$appearance->addOption('color', 'color', '#089bc3', __('Leading color', 'website'));
			$background = $appearance->addGroup('background', __('Background', 'website'));
				$enabled = $background->addOption('boolean', 'enabled', false, '', '', array('caption' => __('Use custom background', 'website')));
				$background->addOption('background', 'settings', array('image' => '', 'color' => '#ffffff', 'alignment' => 'repeat', 'position' => 'center top', 'attachment' => 'scroll'), '', '', array('owner' => $enabled, 'indent' => true));
			$sidebar = $appearance->addGroup('sidebar', __('Sidebar', 'website'));
				$sidebar->addOption('group', 'position', 'right', __('Position', 'website'), '', array('options' => array(
					'left'  => __('Left', 'website'),
					'right' => __('Right', 'website')
				)));
				$sidebar->addOption('boolean', 'fancy_lists', true, '', '', array('caption' => __('Use fancy style for lists in widgets', 'website')));
				$sidebar->addOption('boolean', 'hide_mobile', false, '', '', array('caption' => __('Hide on mobile version', 'website')));
			$image = $appearance->addGroup('image', __('Images', 'website'));
				$image->addOption('select', 'border', 'thin', __('Border style', 'website'), '', array('options' => array(
					''      => __('None', 'website'),
					'thin'  => __('Thin', 'website'),
					'thick' => __('Thick', 'website')
				)));
				$image->addOption('boolean', 'fancybox', true, '', '', array('caption' => __('Open in Fancybox', 'website')));

		// Fonts
		$font = $theme_options->addGroup('font', __('Fonts', 'website'));
			$overall = $font->addGroup('overall', __('Overall', 'website'));
				$overall->addEnabledOption('font', 'body', false, array('family' => 'Arial, Helvetica, sans-serif', 'color' => '', 'size' => 12, 'line_height' => 22), __('Body', 'website'), __('Custom', 'website'), '',
					array('tag' => array('body'),  'line_height_unit' => 'px')
				);
			$header = $font->addGroup('header', __('Header', 'website'));
				$header->addEnabledOption('font', 'logo', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 51, 'styles' => array()), __('Logo', 'website'), __('Custom', 'website'), '',
					array('tag' => array('#header h1, #header h1 a'))
				);
				$header->addEnabledOption('font', 'tagline', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 22, 'line_height' => 100.0, 'styles' => array()), __('Tagline', 'website'), __('Custom', 'website'), '',
					array('tag' => array('#header h2'))
				);
			$nav = $font->addGroup('nav', __('Navigation', 'website'));
				$nav->addEnabledOption('font', 'top', false, array('family' => 'Arial, Helvetica, sans-serif', 'color' => '', 'size' => 13, 'styles' => array()), __('Top', 'website'), __('Custom', 'website'), '',
					array('tag' => array('#nav-top, #nav-top a, #top h1'))
				);
				$nav->addEnabledOption('font', 'main', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 21, 'styles' => array()), __('Main', 'website'), __('Custom', 'website'), '',
					array('tag' => array('#nav-main, #nav-main a'))
				);
			$front_page = $font->addGroup('front_page', __('Front page', 'website'));
				$front_page->addEnabledOption('font', 'box_title', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 38, 'line_height' => 100.0, 'styles' => array()), __('Notice box title', 'website'), __('Custom', 'website'), '',
					array('tag' => array('section.box h1', 0.89, 0.68, 0.53))
				);
				$front_page->addEnabledOption('font', 'columns_title', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 28, 'styles' => array()), __('Featured columns title', 'website'), __('Custom', 'website'), '',
					array('tag' => array('section.columns .column h1'))
				);
			$slider = $font->addGroup('slider', __('Slider', 'website'));
				$slider->addEnabledOption('font', 'caption', false, array('family' => 'Rokkitt', 'size' => 32, 'line_height' => 82.0, 'styles' => array()), __('On-slide text', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.flexslider .slides .caption', 0.88, 0.78, 0.72))
				);
				$slider->addEnabledOption('font', 'flex_caption', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 18, 'line_height' => 100.0, 'styles' => array()), __('Caption', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.flexslider .flex-caption'))
				);
				$slider->addEnabledOption('font', 'additional_banner_caption', false, array('family' => 'Rokkitt', 'size' => 21, 'line_height' => 90.0, 'styles' => array()), __('Additional banner caption', 'website'), __('Custom', 'website'), '',
					array('tag' => array('#banners .small .caption', 0.76))
				);
				$slider->addEnabledOption('font', 'description_title', false, array('family' => 'Rokkitt', 'size' => 31, 'line_height' => 100.0, 'styles' => array()), __('Description title', 'website'), __('Custom', 'website'), '',
					array('tag' => array('#banners article h1', 0.88, 0.81, 0.62))
				);
			$post = $font->addGroup('post', __('Post/page', 'website'));
				$post->addEnabledOption('font', 'title', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 38, 'styles' => array()), __('Title', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.post .title, .post .title a', 0.89, 0.68, 0.53))
				);
				$post->addEnabledOption('font', 'about', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 22, 'styles' => array()), __('Author name', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.post .about h1', 0.91, 0.82))
				);
				$post->addEnabledOption('font', 'meta', false, array('family' => 'Georgia, Serif', 'color' => '', 'size' => 11, 'styles' => array('italic')), __('Meta', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.post .meta li'))
				);
				$post->addEnabledOption('font', 'h1', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 38, 'line_height' => 100.0, 'styles' => array()), __('Headline 1', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.post .content h1', 0.89, 0.68, 0.53))
				);
				$post->addEnabledOption('font', 'h2', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 32, 'line_height' => 100.0, 'styles' => array()), __('Headline 2', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.post .content h2', 0.91, 0.69, 0.56))
				);
				$post->addEnabledOption('font', 'h3', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 28, 'line_height' => 100.0, 'styles' => array()), __('Headline 3', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.post .content h3', 0.89, 0.68, 0.64))
				);
				$post->addEnabledOption('font', 'h4', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 22, 'line_height' => 100.0, 'styles' => array()), __('Headline 4', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.post .content h4', 0.91, 0.81))
				);
				$post->addEnabledOption('font', 'h5', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 18, 'line_height' => 100.0, 'styles' => array()), __('Headline 5', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.post .content h5'))
				);
				$post->addEnabledOption('font', 'h6', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 18, 'line_height' => 100.0, 'styles' => array()), __('Headline 6', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.post .content h6'))
				);
				$post->addEnabledOption('font', 'quote', false, array('family' => 'Georgia, Serif', 'color' => '', 'size' => 19, 'line_height' => 137.0, 'styles' => array('italic')), __('Quote', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.post .content blockquote', 1, 0.84))
				);
				$post->addEnabledOption('font', 'dropcap', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 52, 'line_height' => 44, 'styles' => array()), __('Dropcap', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.post .content .dropcap'), 'line_height_unit' => 'px')
				);
			$misc = $font->addGroup('misc', __('Misc', 'website'));
				$misc->addEnabledOption('font', 'widget_title_aside', false, array('family' => 'Rokkitt', 'color' => '', 'size' => 28, 'line_height' => 100.0, 'styles' => array()), __('Sidebar widget title', 'website'), __('Custom', 'website'), '',
					array('tag' => array('#aside .widget h1'))
				);
				$misc->addEnabledOption('font', 'widget_title_bottom', false, array('family' => 'Arial, Helvetica, sans-serif', 'color' => '', 'size' => 11, 'line_height' => 20, 'styles' => array()), __('Footer widget title', 'website'), __('Custom', 'website'), '',
					array('tag' => array('#aside-bottom .widget h1'), 'line_height_unit' => 'px')
				);
				$misc->addEnabledOption('font', 'pagination', false, array('family' => 'Georgia, Serif', 'color' => '', 'size' => 20, 'styles' => array('italic')), __('Pagination', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.pagination, .pagination a'), 'line_height_unit' => 'px')
				);
				$misc->addEnabledOption('font', 'button_caption', false, array('family' => 'Rokkitt', 'styles' => array()), __('Button caption', 'website'), __('Custom', 'website'), '',
					array('tag' => array('input[type="submit"], button'))
				);
				$misc->addEnabledOption('font', 'other', false, array('family' => 'Rokkitt'), __('Other', 'website'), __('Custom', 'website'), '',
					array('tag' => array('.widget-tag-cloud .tagcloud, .widget-social li, .widget-info h1'))
				);

		// Header
		$header = $theme_options->addGroup('header', __('Header', 'website'));
			$logo = $header->addGroup('logo', __('Logo', 'website'));
				$logo->addOption('text', 'text', get_bloginfo('name'), __('Text', 'website'), __("It will be used if you don't select any logo image below.", 'website'));
				$logo->addOption('image', 'image', '', __('Image', 'website'), __("If you don't select any logo image, text logo above will be used.", 'website'));
				$logo->addOption('boolean', 'center', false, '', __('This option will hide tagline and banner.', 'website'), array('caption' => __('Align logo to the center', 'website')));
			$header->addOption('text', 'tagline', get_bloginfo('description'), __('Tagline', 'website'), sprintf(__('To place nonbreaking space between words, use the %s sign (without spaces).', 'website'), '<code>_</code>'));
			$ad = $header->addGroup('ad', __('Ad banner', 'website'));
				$enabled = $ad->addOption('boolean', 'enabled', false, '', '', array('caption' => __('Display ad banner', 'website')));
				$ad->addOption('image', 'image', '', __('Image', 'website'), '', array('owner' => $enabled));
				$ad->addOption('codeline', 'url', '', __('Target URL', 'website'), '', array('owner' => $enabled));
				$ad->addOption('code', 'code', '', __('Code', 'website'), __('If you paste any code, it will be used instead image and target URL from the fields above.', 'website'), array('owner' => $enabled));
				$ad->addOption('boolean', 'hide_mobile', false, '', __('Notice: hiding ad using this method may be against some ad-networks rules, so I recommend using this option only for self-controlled ad campaigns.', 'website'), array('caption' => __('Hide on mobile version', 'website'), 'owner' => $enabled));
			$header->addOption('number', 'height', 60, __('Height', 'website'), '', array('min' => self::to('header/ad/enabled') ? 60 : 20, 'max' => 300, 'unit' => 'px'), 'logo');

		$this->addThemeFeature('option-favicon', array('group' => $appearance, 'default' => sprintf('%s/data/img/favicon/%s.png', $this->template_uri, self::getLeadingLetter())));

		// Footer
		$footer = $theme_options->addGroup('footer', __('Footer', 'website'));
			$footer->addOption('group', 'visible', array('desktop', 'mobile'), __('Visible', 'website'), '', array('multiple' => true, 'options' => array(
				'desktop' => __('On desktop &amp; tablet devices', 'website'),
				'mobile'  => __('On mobile devices', 'website')
			)));
			$footer->addOption('boolean', 'fixed', false, __('Position', 'website'), '', array('caption' => __('Stick to bottom', 'website')));
			$footer->addOption('group', 'layout', 'sssx', __('Sidebar layout', 'website'), __('Fixed means, it has the same size as the main sidebar.', 'website'), array('options' => array(
				'sssx' => __('4 widgets (<code>small</code> + <code>small</code> + <code>small</code> + <code>fixed</code>)', 'website'),
				'smx'  => __('3 widgets (<code>small</code> + <code>medium</code> + <code>fixed</code>)', 'website'),
				'msx'  => __('3 widgets (<code>medium</code> + <code>small</code> + <code>fixed</code>)', 'website'),
				'lx'   => __('2 widgets (<code>large</code> + <code>fixed</code>)', 'website'),
				'f'    => __('1 widget (<code>full</code>)', 'website')
			)));
			$text = $footer->addGroup('text', __('End note', 'website'));
				$text->addOption('memo', 'left', sprintf(__('&copy; Copyright %s', 'website'), date('Y'))."\n".sprintf(__('%1$s by <a href="%3$s">%2$s</a>', 'website'), get_bloginfo('name'), wp_get_current_user()->display_name, esc_url(home_url('/'))), __('Left', 'website'), '', array('on_html' => function($option, &$html) { $html->css('height', 80); }));
				$text->addOption('memo', 'right', sprintf(__('powered by %s theme', 'website'), '<a href="'.self::ITEM_PAGE_URL.'">Website</a>'), __('Right', 'website'), '', array('on_html' => function($option, &$html) { $html->css('height', 80); }));

		// Navigation
		$nav = $theme_options->addGroup('nav', __('Navigation', 'website'));
			$top = $nav->addGroup('top', __('Top menu', 'website'));
				$top->addOption('group', 'visible', array('desktop', 'mobile'), __('Visible', 'website'), '', array('multiple' => true, 'options' => array(
					'desktop' => __('On desktop &amp; tablet devices', 'website'),
					'mobile'  => __('On mobile devices', 'website')
				)));
				$top->addOption('group', 'align', 'left', __('Align', 'website'), '', array('options' => array(
					'left'  => __('Left', 'website'),
					'right' => __('Right', 'website')
				)));
				$top->addOption('group', 'content', 'categories', __('Content', 'website'), __('Matters only if you do not select another in <code>Appearance/Menus</code>.', 'website'), array('options' => array(
					'pages'      => __('Pages', 'website'),
					'categories' => __('Categories', 'website')
				)));
				$top->addOption('boolean', 'fixed', false, '', '', array('caption' => __('Stick to top', 'website')));
			$main = $nav->addGroup('main', __('Main menu', 'website'));
				$main->addOption('group', 'visible', array('desktop', 'mobile'), __('Visible', 'website'), '', array('multiple' => true, 'options' => array(
					'desktop' => __('On desktop &amp; tablet devices', 'website'),
					'mobile'  => __('On mobile devices', 'website')
				)));
				$main->addOption('group', 'align', 'left', __('Align', 'website'), '', array('options' => array(
					'left'  => __('Left', 'website'),
					'right' => __('Right', 'website')
				)));
				$main->addOption('group', 'content', 'pages', __('Content', 'website'), __('Matters only if you do not select another in <code>Appearance/Menus</code>.', 'website'), array('options' => array(
					'pages'      => __('Pages', 'website'),
					'categories' => __('Categories', 'website')
				)));
			$breadcrumbs = $nav->addOption('conditional_tags', 'breadcrumbs', true, __('Breadcrumbs', 'website'), '', array('type' => 'boolean', 'caption' => __('Visible', 'website')));
			$breadcrumbs->included = self::isPluginActive('breadcrumb-navxt', 'breadcrumb-trail');

		// Sidebars
		$sidebar = $theme_options->addGroup('sidebar', __('Sidebars', 'website'));
			$sidebar->addOption('number', 'additional_count', 3, __('Available additional sidebars', 'website'), '', array('min' => 0, 'max' => 100));
			for ($i = 0; $i < self::to('sidebar/additional_count'); $i++) {
				$this->sidebars_def['additional-'.$i] = sprintf(__('Additional sidebar %d', 'website'), $i+1);
			}
			$sidebars_options = array(
				'' => __('None', 'website')
			)+$this->sidebars_def;
			$sidebars_post_options = array(
				'inherit' => __('Inherit', 'website'),
				''        => __('None', 'website')
			)+$this->sidebars_def;
			$sidebar->addOption('conditional_tags', 'conf', 'general', __('Configuration', 'website'), '', array('type' => 'select', 'options' => $sidebars_options));

		// Sliders
		$slider = $theme_options->addGroup('slider', __('Sliders', 'website'));
			$slider->addOption('conditional_tags', 'conf', '', __('Configuration', 'website'), '', array('type' => 'select', 'options' => function() {
				return
					array(
						'' => __('None', 'website')
					) +
					\Drone\Func::wpPostsList(array(
						'numberposts' => -1,
						'orderby'     => 'date',
						'order'       => 'DESC',
						'post_type'   => 'slider',
						'post_status' => 'any'
					));
			}));
			$prop = $slider->addGroup('prop', __('Properties', 'website'));
				$prop->addOption('group', 'animation', 'slide', __('Animation type', 'website'), '', array('options' => array(
					'slide' => __('Slide', 'website'),
					'fade'  => __('Fade', 'website')
				)));
// 				$prop->addOption('select', 'slide_direction', 'horizontal', __('Sliding direction', 'website'), '', array('options' => array(
// 					'horizontal' => __('Horizontal', 'website'),
// 					'vertical'   => __('Vertical', 'website')
// 				)));
				$prop->addOption('number', 'animation_duration', 600, __('Animation speed', 'website'), '', array('unit' => 'ms', 'min' => 0, 'max' => 10000));
				$prop->addOption('number', 'slideshow_speed', 7000, __('Exposure time', 'website'), '', array('unit' => 'ms', 'min' => 1000, 'max' => 60000));
				$prop->addOption('boolean', 'slideshow', false, '', '', array('caption' => __('Animate slider automatically', 'website')));
			$height = $slider->addGroup('height', __('Height', 'website'), sprintf(__('After changing any of these height values, you might need to <a href="%s">regenerate images</a> used in banners.', 'website'), 'http://wordpress.org/plugins/regenerate-thumbnails/'));
				$height->addOption('number', 'full', 285, __('Full width slider', 'website'), '', array('unit' => 'px', 'min' => 100, 'max' => 1000));
				$height->addOption('number', 'one_text', 285, __('Slider + text', 'website'), '', array('unit' => 'px', 'min' => 100, 'max' => 1000));

		// Front page
		$front_page = $theme_options->addGroup('front_page', __('Front page', 'website'));
			$area = $front_page->addGroup('area', __('Areas', 'website'));
				foreach (array('a', 'b') as $name) {
					$area->addOption('select', $name, '', sprintf(__('Area %s', 'website'), strtoupper($name)), '', array('options' => array(
						''        => __('None', 'website'),
						'box'     => __('Notice box', 'website'),
						'columns' => __('Featured columns', 'website')
					)));
				}
				foreach (array('c', 'd', 'e') as $name) {
					$area->addOption('select', $name, '', sprintf(__('Area %s', 'website'), strtoupper($name)), '', array('options' => array(
						''         => __('None', 'website'),
						'box'      => __('Notice box', 'website'),
						'featured' => __('Featured content', 'website'),
						'posts'    => __('Posts list', 'website'),
						'columns'  => __('Featured columns', 'website')
					)));
				}
				foreach (array('f', 'g') as $name) {
					$area->addOption('select', $name, '', sprintf(__('Area %s', 'website'), strtoupper($name)), '', array('options' => array(
						''        => __('None', 'website'),
						'box'     => __('Notice box', 'website'),
						'columns' => __('Featured columns', 'website')
					)));
				}
			$area->child('a')->on_html = function($option, &$html) {
				$html = \Drone\HTML::div()
					->css(array(
						'position' => 'relative',
						'float'    => 'left'
					))
					->add(
						$html,
						\Drone\HTML::img()
							->src(Website::getInstance()->template_uri.'/data/img/areas.png')
							->css(array(
								'padding-left' => 30,
								'position'     => 'absolute',
								'left'         => '100%',
								'top'          => 1
							))
					);
			};
			$box = $front_page->addGroup('box', __('Notice box', 'website'), __('If you change title or content of the box, it will be displayed again for all users, even if they closed it before.', 'website'));
				$box->addOption('text', 'title', '', __('Title', 'website'));
				$box->addOption('memo', 'text', '', __('Text', 'website'));
				$box->addOption('boolean', 'close', true, '', '', array('caption' => __('Allow users to close the box', 'website')));
			$featured = $front_page->addGroup('featured', __('Featured content', 'website'), __('You can select many posts and pages using CTRL key. From the selected group a number of them (set in the <code>Quantity</code> field) will be randomly selected to be displayed in the order specified by the <code>Sort by</code> selector.', 'website'));
				$featured->addOption('select', 'posts', array(), __('Posts', 'website'), '', array('options' => function() {
					return \Drone\Func::wpPostsList(array(
						'numberposts' => 50,
						'orderby'     => 'date',
						'order'       => 'DESC',
						'post_type'   => 'post',
						'status'      => 'publish'
					));
				}, 'multiple' => true, 'on_html' => function($option, &$html) {
					$html->child(1)->css('min-width', 300);
				}));
				$featured->addOption('select', 'pages', array(), __('Pages', 'website'), '', array('options' => function() {
					return \Drone\Func::wpPostsList(array(
						'numberposts' => 250,
						'orderby'     => 'date',
						'order'       => 'DESC',
						'post_type'   => 'page',
						'status'      => 'publish'
					));
				}, 'multiple' => true, 'on_html' => function($option, &$html) {
					$html->child(1)->css('min-width', 300);
				}));
				$featured->addOption('number', 'count', 1, __('Quantity', 'website'), '', array('min' => 1, 'max' => 10));
				$featured->addOption('select', 'orderby', 'date', __('Sort by', 'website'), '', array('options' => array(
					'title'         => __('Title', 'website'),
					'date'          => __('Date', 'website'),
					'modified'      => __('Modified date', 'website'),
					'comment_count' => __('Comment count', 'website'),
					'rand'          => __('Random order', 'website')
				)));
				$featured->addOption('select', 'order', 'desc', __('Sort order', 'website'), '', array('options' => array(
					'asc'  => __('Ascending', 'website'),
					'desc' => __('Descending', 'website')
				)));
			$posts = $front_page->addGroup('posts', __('Posts list', 'website'));
				$posts->addOption('number', 'count', 3, __('Quantity', 'website'), '', array('min' => 1, 'max' => 20));
				$posts->addOption('select', 'orderby', 'date', __('Sort by', 'website'), '', array('options' => array(
					'title'         => __('Title', 'website'),
					'date'          => __('Date', 'website'),
					'modified'      => __('Modified date', 'website'),
					'comment_count' => __('Comment count', 'website'),
					'rand'          => __('Random order', 'website')
				)));
				$posts->addOption('select', 'order', 'desc', __('Sort order', 'website'), '', array('options' => array(
					'asc'  => __('Ascending', 'website'),
					'desc' => __('Descending', 'website')
				)));
				$filter = $posts->addGroup('filter', __('Category filter', 'website'));
					$enabled = $filter->addOption('boolean', 'enabled', false, '', '', array('caption' => __('Show post only from selected categories:', 'website')));
					$filter->addOption('group', 'categories', array(), '', '', array('options' => function() {
						return \Drone\Func::wpTermsList('category');
					}, 'owner' => $enabled, 'indent' => true, 'multiple' => true));
				$posts->addOption('boolean', 'exclude_previous', false, '', '', array('caption' => __('Exclude already displayed posts', 'website')));
				$goto = $posts->addGroup('goto');
					$visible = $goto->addOption('boolean', 'visible', true, '', '', array('caption' => __('Display Go to blog link', 'website')));
					$goto->addOption('text', 'text', __('Go to blog', 'website'), __('Go to blog link text', 'website'), '', array('owner' => $visible, 'indent' => true));
			$columns = $front_page->addGroup('columns', __('Featured columns', 'website'));
				$count = $columns->addOption('select', 'count', 3, __('Number of columns', 'website'), '', array('options' => array(
					1 => __('One', 'website'),
					2 => __('Two', 'website'),
					3 => __('Three', 'website'),
					4 => __('Four', 'website')
				)));
				$column = $columns->addGroup('column');
					for ($i = 0; $i < 4; $i++) {
						$group = $column->addGroup($i, sprintf(__('Column %d', 'website'), $i+1));
							$group->owner = $count;
							$group->owner_value = array_map(function($i) { return (string)$i; }, range($i+1, 4));
							$group->addOption('image_select', 'icon', '', __('Icon', 'website'), '', array('required' => false, 'options' => function() {
								return
									\Drone\Options\Option\ImageSelect::dirToOptions('data/img/icons/32') +
									\Drone\Options\Option\ImageSelect::mediaToOptions(32, 'png');
							}));
							$group->addOption('text', 'title', '', __('Title', 'website'));
							$group->addOption('memo', 'text', '', __('Text', 'website'), '', array('on_html' => function($option, &$html) { $html->css(array('width' => 300, 'height' => 80)); }));
							$group->addOption('codeline', 'link', '', __('Read more link', 'website'));
							$group->addOption('text', 'more', __('More', 'website'), __('Read more word', 'website'));
					}
				$columns->addOption('boolean', 'hide_mobile', false, '', '', array('caption' => __('Hide on mobile version', 'website')));

		// Posts
		$post = $theme_options->addGroup('post', __('Posts', 'website'));
			$post->addOption('group', 'content', 'excerpt_content', __('Content on posts list', 'website'), __('Regular content means everything before the "Read more" tag.', 'website'), array('options' => array(
				'content'         => __('Regular content', 'website'),
				'excerpt_content' => __('Excerpt or regular content', 'website'),
				'excerpt'         => __('Excerpt', 'website'),
				''                => __('None', 'website')
			)));
			$readmore = $post->addOption('text', 'readmore', __('Read more', 'website'), __('Read more text', 'website'));
			$about = $post->addOption('boolean', 'about', false, __('Author details', 'website'), '', array('caption' => __('Show author details inside post', 'website')));
			$social = $post->addGroup('social', __('Social buttons', 'website'));
				foreach (array('list' => __('On posts list', 'website'), 'single' => __('Inside post', 'website')) as $name => $label) {
					$group = $social->addGroup($name, $label);
					$visible = $group->addOption('boolean', 'visible', $name == 'single', '', '', array('caption' => __('Visible', 'website')));
					$group->addOption('group', 'items', array('twitter', 'facebook', 'googleplus', 'pinterest', 'linkedin'), '', '', array('multiple' => true, 'options' => array(
						'twitter'    => __('Twitter', 'website'),
						'facebook'   => __('Facebook', 'website'),
						'googleplus' => __('Google+', 'website'),
						'pinterest'  => __('Pinterest', 'website'),
						'linkedin'   => __('LinkedIn', 'website')
					), 'owner' => $visible, 'indent' => true, 'sortable' => true));
				}
			$meta = $post->addGroup('meta', __('Meta elements', 'website'));
				foreach (array('list' => __('On posts list', 'website'), 'single' => __('Inside post', 'website')) as $name => $label) {
					$group = $meta->addGroup($name, $label);
					$visible = $group->addOption('boolean', 'visible', true, '', '', array('caption' => __('Visible', 'website')));
					$group->addOption('group', 'items', array('comments', 'author', 'date', 'category', 'link'), '', '', array('multiple' => true, 'options' => array(
						'comments'  => __('Number of comments', 'website'),
						'author'    => __('Author', 'website'),
						'date'      => __('Date', 'website'),
						'date_time' => __('Date &amp time', 'website'),
						'time_diff' => __('Relative time', 'website'),
						'category'  => __('Category', 'website'),
						'tags'      => __('Tags', 'website'),
						'link'      => __('Permalink', 'website'),
						'edit'      => __('Edit link (visible to editors only)', 'website')
					), 'owner' => $visible, 'indent' => true, 'sortable' => true));
				}
			$post->addOption('boolean', 'navigation', false, __('Navigation', 'website'), '', array('caption' => __('Show links to next and previous posts', 'website')));
			$post->addOption('boolean', 'comments', true, __('Comments', 'website'), '', array('caption' => __('Allow comments', 'website')));
			$post->addOption('select', 'pagination', 'numbers_navigation', __('Pagination', 'website'), '', array('options' => array(
				'numbers'            => __('Numbers', 'website'),
				'numbers_navigation' => __('Numbers + navigation', 'website')
			)));
			$post->addOption('select', 'comments_pagination', 'numbers_navigation', __('Comments pagination', 'website'), '', array('options' => array(
				'numbers'            => __('Numbers', 'website'),
				'numbers_navigation' => __('Numbers + navigation', 'website')
			)));

		// Format posts
		$format_post = $theme_options->addGroup('format_post', __('Format posts', 'website'));
			$default = $format_post->addGroup('default', __('Standard', 'website'));
				$featured = $default->addGroup('featured');
					$featured->addOption('group', 'visible', array('list'), __('Show featured image', 'website'), '', array('multiple' => true, 'options' => array(
						'list'   => __('On posts list', 'website'),
						'single' => __('Inside post', 'website')
					)));
					$featured->addOption('group', 'link', 'post', __('Featured image click action', 'website'), __('Click action refers to posts list only. Inside posts, clicked featured images always open in Fancybox window.', 'website'), array('options' => array(
						'post'     => __('Go to post', 'website'),
						'fancybox' => __('Open image in Fancybox', 'website')
					)));
				$content = $default->addGroup('content');
					$content->addOption('boolean', 'hide', false, '', '', array('caption' => __('Hide content on posts list', 'website')));
			$link = $format_post->addGroup('link', __('Link', 'website'));
				$title = $link->addGroup('title');
					$title->addOption('group', 'link', 'url', __('Post title click action', 'website'), __('This option refers to posts list only. Inside posts, clicked link always goes to specified URL.', 'website'), array('options' => array(
						'post' => __('Go to post', 'website'),
						'url'  => __('Go to URL specified in the post', 'website')
					)));
					$title->addOption('boolean', 'target_blank', false, __('Post title link behavior', 'website'), '', array('caption' => __('Open in new window', 'website')));
				$content = $link->addGroup('content');
					$content->addOption('boolean', 'hide', true, '', '', array('caption' => __('Hide content on posts list', 'website')));
			$image = $format_post->addGroup('image', __('Image', 'website'));
				$featured = $image->addGroup('featured');
					$featured->addOption('group', 'visible', array('list', 'single'), __('Show featured image', 'website'), '', array('multiple' => true, 'options' => array(
						'list'   => __('On posts list', 'website'),
						'single' => __('Inside post', 'website')
					)));
					$featured->addOption('group', 'link', 'fancybox', __('Featured image click action', 'website'), __('Click action refers to posts list only. Inside posts, clicked featured images always open in Fancybox window.', 'website'), array('options' => array(
						'post'     => __('Go to post', 'website'),
						'fancybox' => __('Open image in Fancybox', 'website')
					)));
				$content = $image->addGroup('content');
					$content->addOption('boolean', 'hide', false, '', '', array('caption' => __('Hide content on posts list', 'website')));
			$quote = $format_post->addGroup('quote', __('Quote', 'website'));
				$content = $quote->addGroup('content');
					$content->addOption('boolean', 'hide', true, '', '', array('caption' => __('Hide content on posts list', 'website')));
			$status = $format_post->addGroup('status', __('Status', 'website'));
				$content = $status->addGroup('content');
					$content->addOption('boolean', 'hide', true, '', '', array('caption' => __('Hide content on posts list', 'website')));
			$video = $format_post->addGroup('video', __('Video', 'website'));
				$player = $video->addGroup('player');
					$player->addOption('group', 'visible', array('list', 'single'), __('Show player', 'website'), '', array('multiple' => true, 'options' => array(
						'list'   => __('On posts list', 'website'),
						'single' => __('Inside post', 'website')
					)));
				$content = $video->addGroup('content');
					$content->addOption('boolean', 'hide', false, '', '', array('caption' => __('Hide content on posts list', 'website')));
			$audio = $format_post->addGroup('audio', __('Audio', 'website'));
				$player = $audio->addGroup('player');
					$player->addOption('group', 'visible', array('list', 'single'), __('Show player', 'website'), '', array('multiple' => true, 'options' => array(
						'list'   => __('On posts list', 'website'),
						'single' => __('Inside post', 'website')
					)));
				$content = $audio->addGroup('content');
					$content->addOption('boolean', 'hide', false, '', '', array('caption' => __('Hide content on posts list', 'website')));

		// Pages
		$page = $theme_options->addGroup('page', __('Pages', 'website'));
			$page->addOption('boolean', 'hide_title', false, __('Title', 'website'), '', array('caption' => __('Hide page title', 'website')));
			$about = $page->addOption('boolean', 'about', false, __('Author details', 'website'), '', array('caption' => __('Show author details', 'website')));
			$social = $page->addGroup('social', __('Social buttons', 'website'));
				$visible = $social->addOption('boolean', 'visible', true, '', '', array('caption' => __('Visible', 'website')));
				$social->addOption('group', 'items', array('twitter', 'facebook', 'googleplus', 'pinterest', 'linkedin'), '', '', array('multiple' => true, 'options' => array(
					'twitter'    => __('Twitter', 'website'),
					'facebook'   => __('Facebook', 'website'),
					'googleplus' => __('Google+', 'website'),
					'pinterest'  => __('Pinterest', 'website'),
					'linkedin'   => __('LinkedIn', 'website')
				), 'owner' => $visible, 'indent' => true, 'sortable' => true));
			$meta = $page->addGroup('meta', __('Meta elements', 'website'));
				$visible = $meta->addOption('boolean', 'visible', false, '', '', array('caption' => __('Visible', 'website')));
				$meta->addOption('group', 'items', array('comments', 'author', 'date', 'category', 'link'), '', '', array('multiple' => true, 'options' => array(
					'comments'  => __('Number of comments', 'website'),
					'author'    => __('Author', 'website'),
					'date'      => __('Date', 'website'),
					'date_time' => __('Date &amp time', 'website'),
					'time_diff' => __('Relative time', 'website'),
					'link'      => __('Permalink', 'website'),
					'edit'      => __('Edit link (visible to editors only)', 'website')
				), 'owner' => $visible, 'indent' => true, 'sortable' => true));
			$page->addOption('boolean', 'comments', true, __('Comments', 'website'), '', array('caption' => __('Allow comments', 'website')));
			$page->addOption('select', 'comments_pagination', 'numbers_navigation', __('Comments pagination', 'website'), '', array('options' => array(
				'numbers'            => __('Numbers', 'website'),
				'numbers_navigation' => __('Numbers + navigation', 'website')
			)));

		// Portfolios
		$portfolio = $theme_options->addGroup('portfolio', __('Portfolios', 'website'));
			$portfolio->addOption('codeline', 'slug', 'portfolio', __('Slug', 'website'), __('For the changes to take effect, go to Settings/Permalinks.', 'website'), array('required' => true, 'allowed_chars' => '-_a-zA-Z0-9'));
			$portfolio->addOption('boolean', 'hide_title', true, __('Title', 'website'), '', array('caption' => __('Hide portfolio title', 'website')));
			$portfolio->addOption('boolean', 'navigation', false, __('Navigation', 'website'), '', array('caption' => __('Show links to next and previous portfolios', 'website')));
			$portfolio->addOption('select', 'pagination', 'numbers_navigation', __('Pagination', 'website'), '', array('options' => array(
				'numbers'            => __('Numbers', 'website'),
				'numbers_navigation' => __('Numbers + navigation', 'website')
			)));

		// Portfolio items
		$portfolio_item = $theme_options->addGroup('portfolio-item', __('Portfolio items', 'website'));
			$portfolio_item->addOption('codeline', 'slug', 'portfolio-item', __('Slug', 'website'), __('For the changes to take effect, go to Settings/Permalinks.', 'website'), array('required' => true, 'allowed_chars' => '-_a-zA-Z0-9'));
			$portfolio_item->addOption('boolean', 'hide_title', false, __('Title', 'website'), '', array('caption' => __('Hide portfolio item title', 'website')));
			$portfolio_item->addOption('boolean', 'about', false, __('Author details', 'website'), '', array('caption' => __('Show author details', 'website')));
			$social = $portfolio_item->addGroup('social', __('Social buttons', 'website'));
				$visible = $social->addOption('boolean', 'visible', true, '', '', array('caption' => __('Visible', 'website')));
				$social->addOption('group', 'items', array('twitter', 'facebook', 'googleplus', 'pinterest', 'linkedin'), '', '', array('multiple' => true, 'options' => array(
					'twitter'    => __('Twitter', 'website'),
					'facebook'   => __('Facebook', 'website'),
					'googleplus' => __('Google+', 'website'),
					'pinterest'  => __('Pinterest', 'website'),
					'linkedin'   => __('LinkedIn', 'website')
				), 'owner' => $visible, 'indent' => true, 'sortable' => true));
			$meta = $portfolio_item->addGroup('meta', __('Meta elements', 'website'));
				$visible = $meta->addOption('boolean', 'visible', false, '', '', array('caption' => __('Visible', 'website')));
				$meta->addOption('group', 'items', array('comments', 'author', 'date', 'category', 'link'), '', '', array('multiple' => true, 'options' => array(
					'comments'  => __('Number of comments', 'website'),
					'author'    => __('Author', 'website'),
					'date'      => __('Date', 'website'),
					'date_time' => __('Date &amp time', 'website'),
					'time_diff' => __('Relative time', 'website'),
					'link'      => __('Permalink', 'website'),
					'edit'      => __('Edit link (visible to editors only)', 'website')
				), 'owner' => $visible, 'indent' => true, 'sortable' => true));
			$portfolio_item->addOption('boolean', 'comments', true, __('Comments', 'website'), '', array('caption' => __('Allow comments', 'website')));
			$portfolio_item->addOption('select', 'comments_pagination', 'numbers_navigation', __('Comments pagination', 'website'), '', array('options' => array(
				'numbers'            => __('Numbers', 'website'),
				'numbers_navigation' => __('Numbers + navigation', 'website')
			)));

		// Galleries
		$gallery = $theme_options->addGroup('gallery', __('Galleries', 'website'));
			$gallery->addOption('codeline', 'slug', 'gallery', __('Slug', 'website'), __('For the changes to take effect, go to Settings/Permalinks.', 'website'), array('required' => true, 'allowed_chars' => '-_a-zA-Z0-9'));
			$gallery->addOption('boolean', 'hide_title', true, __('Title', 'website'), '', array('caption' => __('Hide gallery title', 'website')));
			$gallery->addOption('boolean', 'navigation', false, __('Navigation', 'website'), '', array('caption' => __('Show links to next and previous galleries', 'website')));
			$gallery->addOption('select', 'pagination', 'numbers_navigation', __('Pagination', 'website'), '', array('options' => array(
				'numbers'            => __('Numbers', 'website'),
				'numbers_navigation' => __('Numbers + navigation', 'website')
			)));

		// Not found
		$not_found = $theme_options->addGroup('not_found', __('404 page', 'website'));
			$not_found->addOption('text', 'title', __('Sorry, but the page you requested could not be found.', 'website'), __('Title', 'website'));
			$not_found->addOption('editor', 'content', '', __('Content', 'website'));

		// Contact form
		$this->addThemeFeature('option-contact-form');

		// Advanced
		$advanced = $theme_options->addGroup('advanced', __('Advanced', 'website'));
			$this->addThemeFeature(array('option-custom-css', 'option-custom-js'), array('group' => $advanced));
			$advanced->addOption('boolean', 'scheme_switcher', false, __('Scheme switcher', 'website'), sprintf(__('Turns on scheme switcher using GET parameter. E.g. %s or %s.', 'website'), '<code>'.home_url('/').'?scheme=dark</code>', '<code>'.home_url('/').'?scheme=switch</code>'), array('caption' => __('Enabled', 'website')));

		// Other
		$other = $theme_options->addGroup('other', __('Other', 'website'));
			$this->addThemeFeature(array('option-tracking-code', 'option-feed-url', 'option-ogp'), array('group' => $other));
			$metro_ui_tile = $other->addGroup('metro_ui_tile', __('Windows 8 Metro UI tile', 'website'));
				$metro_ui_tile->addOption('image', 'image', '', __('Image', 'website'), __("Paste tile's URL or select/upload an image (144x144px 32bit png file). If you leave this field empty, default tile will be used.", 'website'));
				$metro_ui_tile->addOption('color', 'color', '', __('Background color', 'website'), '', array('required' => false, 'on_html' => function($option, &$html) {
					$html->css('width', 120)->placeholder(__('leading color', 'website'));
				}));
			$other->addOption('boolean', 'description', true, __('Site description', 'website'), '', array('caption' => sprintf(__('Add description meta tag to <code>%s</code> section', 'website'), '&lt;HEAD&gt;')));

		// ---------------------------------------------------------------------

		// Post options
		$post_options = $this->getPostOptions('post');

		// Options
		$options = $post_options->addGroup('options', __('Options', 'website'), __('Inherit means, it will take the option from Theme Options.', 'website'), 'side', 'low');
			$options->addOption('select', 'slider', 'inherit', __('Slider inside post', 'website'), '', array('options' => function() {
				return
					array(
						'inherit' => __('Inherit', 'website'),
						''        => __('None', 'website')
					) +
					\Drone\Func::wpPostsList(array(
						'numberposts' => -1,
						'orderby'     => 'date',
						'order'       => 'DESC',
						'post_type'   => 'slider',
						'status'      => 'any'
					));
			}));
			$options->addOption('select', 'sidebar', 'inherit', __('Sidebar inside post', 'website'), '', array('options' => $sidebars_post_options));
			foreach (array(
				'about'         => __('Author inside post', 'website'),
				'social_list'   => __('Social on posts list', 'website'),
				'social_single' => __('Social inside post', 'website'),
				'meta_list'     => __('Meta on posts list', 'website'),
				'meta_single'   => __('Meta inside post', 'website')
			) as $name => $label) {
				$options->addOption('select', $name, 'inherit', $label, '', array('options' => array(
					'inherit' => __('Inherit', 'website'),
					'on'      => __('Visible', 'website'),
					'off'     => __('Hidden', 'website')
				)));
			}

		// Layout
		$layout = $post_options->addGroup('layout', __('Layout', 'website'));
			$layout->addEnabledOption('background', 'background', false, self::to('appearance/background/settings'), __('Background', 'website'), __('Custom', 'website'));

		// Link
		$link = $post_options->addGroup('link', __('Link', 'website'), __('These fields impact only Link post format.', 'website'));
			$link->addOption('codeline', 'url', '', __('URL', 'website'));

		// Audio
		$audio = $post_options->addGroup('audio', __('Audio', 'website'), __('These fields impact only Audio post format.', 'website'));
			$audio->addOption('codeline', 'url', '', __('File URL', 'website'), sprintf(__('Supported formats: %s.', 'website'), '<code>mp3</code>, <code>wav</code>'));

		// Video
		$video = $post_options->addGroup('video', __('Video', 'website'), __('These fields impact only Video post format.', 'website'));
			$method = $video->addOption('group', 'method', 'embed', __('Method', 'website'), '', array('options' => array(
				'self'  => __('Self-hosted', 'website'),
				'embed' => __('Embedding code', 'website')
			)));
			$video->addOption('codeline', 'url', '', __('File URL', 'website'), sprintf(__('Supported formats: %s.', 'website'), '<code>mp4</code>, <code>ogg</code>, <code>flv</code>'), array('owner' => $method, 'owner_value' => 'self'));
			$video->addOption('number', 'ratio', 1.7778, __('Size ratio', 'website'), __('Divide width by height to specify correct number.', 'website'), array('owner' => $method, 'owner_value' => 'self', 'float' => true, 'min' => 0.1, 'max' => 10));
			$video->addOption('code', 'code', '', __('External video code', 'website'), '', array('owner' => $method, 'owner_value' => 'embed'));

		// ---------------------------------------------------------------------

		// Page options
		$page_options = $this->getPostOptions('page');

		// Options
		$options = $page_options->addGroup('options', __('Options', 'website'), __('Inherit means, it will take the option from Theme Options.', 'website'), 'side', 'low');
			$options->addOption('select', 'slider', 'inherit', __('Slider', 'website'), '', array('options' => function() {
				return
					array(
						'inherit' => __('Inherit', 'website'),
						''        => __('None', 'website')
					) +
					\Drone\Func::wpPostsList(array(
						'numberposts' => -1,
						'orderby'     => 'date',
						'order'       => 'DESC',
						'post_type'   => 'slider',
						'status'      => 'any'
					));
			}));
			$options->addOption('select', 'sidebar', 'inherit', __('Sidebar', 'website'), '', array('options' => $sidebars_post_options));
			$options->addOption('select', 'title', 'inherit', __('Hide title', 'website'), '', array('options' => array(
				'inherit' => __('Inherit', 'website'),
				'hide'    => __('Yes', 'website'),
				'show'    => __('No', 'website')
			)));
			foreach (array(
				'about'    => __('Author details', 'website'),
				'social'   => __('Social buttons', 'website'),
				'meta'     => __('Meta elements', 'website')
			) as $name => $label) {
				$options->addOption('select', $name, 'inherit', $label, '', array('options' => array(
					'inherit' => __('Inherit', 'website'),
					'on'      => __('Visible', 'website'),
					'off'     => __('Hidden', 'website')
				)));
			}

		// Layout
		$layout = $page_options->addGroup('layout', __('Layout', 'website'));
			$layout->addEnabledOption('background', 'background', false, self::to('appearance/background/settings'), __('Background', 'website'), __('Custom', 'website'));


		// ---------------------------------------------------------------------

		// Slider options
		$slider_options = $this->getPostOptions('slider');

		// Items
		$content = $slider_options->addGroup('content', __('Content', 'website'), '', 'normal');
			$content->addOption('group', 'items', array(), __('Slider items', 'website'), '', array('options' => function() {
				return \Drone\Func::wpPostsList(array(
					'numberposts' => -1,
					'orderby'     => 'date',
					'order'       => 'DESC',
					'post_type'   => 'slider-item',
					'status'      => 'any'
				));
			}, 'multiple' => true, 'sortable' => true));

		// Additional banner 1
		for ($i = 1; $i <= 2; $i++) {
			$group = $slider_options->addGroup('banner_'.$i, sprintf(__('Additional banner %s', 'website'), $i), __('It\'s displayed only if the &quot;slider + two banners&quot; type is used.', 'website'), 'normal');
				$group->addOption('attachment', 'image', 0, __('Image', 'website'));
				$caption = $group->addGroup('caption', __('Caption', 'website'));
					$caption->addOption('text', 'text', '');
					$caption->addOption('group', 'color', 'white', __('Color', 'website'), '', array('options' => array(
						'white' => __('White', 'website'),
						'black' => __('Black', 'website')
					)));
				$group->addOption('codeline', 'link', '', __('Link', 'website'));
		}

		// Options
		$options = $slider_options->addGroup('options', __('Options', 'website'), '', 'side');
			$options->addOption('select', 'type', '', __('Type', 'website'), '', array('options' => array(
				'full'     => __('Full width slider', 'website'),
				'one_two'  => __('Slider + two banners', 'website'),
				'one_text' => __('Slider + text', 'website')
			)));
			$options->addOption('select', 'orderby', 'post__in', __('Sort by', 'website'), '', array('options' => array(
				'title'    => __('Title', 'website'),
				'date'     => __('Date', 'website'),
				'modified' => __('Modified date', 'website'),
				'rand'     => __('Random order', 'website'),
				'post__in' => __('Manual order', 'website')
			)));
			$options->addOption('select', 'order', 'desc', __('Sort order', 'website'), '', array('options' => array(
				'asc'  => __('Ascending', 'website'),
				'desc' => __('Descending', 'website')
			)));

		// ---------------------------------------------------------------------

		// Slider item options
		$slider_item_options = $this->getPostOptions('slider-item');

		// Content
		$content = $slider_item_options->addGroup('content', __('Content', 'website'), '', 'normal');
			$text = $content->addGroup('text', __('On-slide text', 'website'));
				$text->addOption('memo', 'text', '');
				$text->addOption('color', 'color', '#ffffff', __('Color', 'website'), '', array('options' => array(
					'white' => __('White', 'website'),
					'black' => __('Black', 'website')
				)));
				$text->addOption('group', 'align', 'top', __('Position', 'website'), '', array('options' => array(
					'top'      => __('Top', 'website'),
					'vertical' => __('Middle', 'website'),
					'bottom'   => __('Bottom', 'website')
				)));
			$content->addOption('text', 'caption', '', __('Caption', 'website'));
			$link = $content->addGroup('link', __('Link', 'website'));
				$link->addOption('codeline', 'url', '');
				$link->addOption('boolean', 'new_window', false, '', '', array('caption' => __('Open in new browser\'s window', 'website')));

		// Video
		$video = $slider_item_options->addGroup('video', __('Video', 'website'), __("Notice: if you use video, the Content section won't be used.", 'website'));
			$video->addOption('code', 'code', '', __('External video code', 'website'));

		// Description
		$description = $slider_item_options->addGroup('description', __('Description', 'website'), __("It's displayed only if the &quot;slider + text&quot; type is used.", 'website'), 'normal');
			$description->addOption('text', 'title', '', __('Title', 'website'));
			$description->addOption('memo', 'text', '', __('Text', 'website'));
			$description->addOption('memo', 'tablet_text', '', __('Text for tablet version', 'website'), __('Due to the difference in space to use on desktop and tablet versions of the site, you can prepare a different text for each version. If you leave this field empty, the same text will be used in all site versions.', 'website'));
			$readmore = $description->addGroup('readmore', __('Read more', 'website'));
				$readmore->addOption('text', 'text', __('Read more', 'website'), __('Word', 'website'));
				$readmore->addOption('codeline', 'url', '', __('Link', 'website'));

		// ---------------------------------------------------------------------

		// Portfolio options
		$portfolio_options = $this->getPostOptions('portfolio');

		// Items
		$content = $portfolio_options->addGroup('content', __('Content', 'website'), '', 'normal');
			$content->addOption('group', 'items', array(), __('Portfolio items', 'website'), '', array('options' => function() {
				return \Drone\Func::wpPostsList(array(
					'numberposts' => -1,
					'orderby'     => 'date',
					'order'       => 'DESC',
					'post_type'   => 'portfolio-item',
					'status'      => 'any'
				));
			}, 'multiple' => true, 'sortable' => true));

		// Options
		$options = $portfolio_options->addGroup('options', __('Options', 'website'), '', 'side');
			$options->addOption('select', 'title', 'inherit', __('Hide title', 'website'), '', array('options' => array(
				'inherit' => __('Inherit', 'website'),
				'hide'    => __('Yes', 'website'),
				'show'    => __('No', 'website')
			)));
			$options->addOption('select', 'size', 'tiny', __('Items sizes', 'website'), '', array('options' => array(
				'big'    => __('Big', 'website'),
				'medium' => __('Medium', 'website'),
				'small'  => __('Small', 'website'),
				'tiny'   => __('Tiny', 'website')
			)));
			$options->addOption('select', 'orderby', 'post__in', __('Sort by', 'website'), '', array('options' => array(
				'title'         => __('Title', 'website'),
				'date'          => __('Date', 'website'),
				'modified'      => __('Modified date', 'website'),
				'comment_count' => __('Comment count', 'website'),
				'rand'          => __('Random order', 'website'),
				'post__in'      => __('Manual order', 'website')
			)));
			$options->addOption('select', 'order', 'desc', __('Sort order', 'website'), '', array('options' => array(
				'asc'  => __('Ascending', 'website'),
				'desc' => __('Descending', 'website')
			)));
			$options->addOption('select', 'filter', 'category', __('Filtering', 'website'), '', array('options' => array(
				''           => __('None', 'website'),
				'category'   => __('Category filter', 'website'),
				'tag'        => __('Tag filter', 'website')
			)));
			$pagination = $options->addOption('boolean', 'pagination', false, __('Page pagination', 'website'), '', array('caption' => __('Enabled', 'website')));
			$options->addOption('number', 'per_page', 12, __('Items per page', 'website'), '', array('owner' => $pagination, 'min' => 1, 'max' => 100));
			$options->addOption('group', 'content', array('title', 'excerpt', 'tags'), __('Content', 'website'), '', array('multiple' => true, 'options' => array(
				'title'   => __('Title', 'website'),
				'excerpt' => __('Excerpt', 'website'),
				'tags'    => __('Tags', 'website')
			)));

		// Layout
		$layout = $portfolio_options->addGroup('layout', __('Layout', 'website'));
			$layout->addEnabledOption('background', 'background', false, self::to('appearance/background/settings'), __('Background', 'website'), __('Custom', 'website'));


		// ---------------------------------------------------------------------

		// Portfolio item options
		$portfolio_item_options = $this->getPostOptions('portfolio-item');

		// Format
		$format = $portfolio_item_options->addGroup('format', __('Format', 'website'), '', 'side');
			$format->addOption('group', 'format', 'image', '', '', array('options' => array(
				''         => __('Standard', 'website'),
				'image'    => __('Image', 'website'),
				'gallery'  => __('Slider gallery', 'website'),
				'link'     => __('Link', 'website'),
				'video'    => __('Video', 'website')
			)));

		// Options
		$options = $portfolio_item_options->addGroup('options', __('Options', 'website'), __('Inherit means, it will take the option from Theme Options.', 'website'), 'side', 'low');
			$options->addOption('select', 'sidebar', 'inherit', __('Sidebar', 'website'), '', array('options' => $sidebars_post_options));
			$options->addOption('select', 'title', 'inherit', __('Hide title', 'website'), '', array('options' => array(
				'inherit' => __('Inherit', 'website'),
				'hide'    => __('Yes', 'website'),
				'show'    => __('No', 'website')
			)));
			foreach (array(
				'about'    => __('Author details', 'website'),
				'social'   => __('Social buttons', 'website'),
				'meta'     => __('Meta elements', 'website')
			) as $name => $label) {
				$options->addOption('select', $name, 'inherit', $label, '', array('options' => array(
					'inherit' => __('Inherit', 'website'),
					'on'      => __('Visible', 'website'),
					'off'     => __('Hidden', 'website')
				)));
			}

		// Layout
		$layout = $portfolio_item_options->addGroup('layout', __('Layout', 'website'));
			$layout->addEnabledOption('background', 'background', false, self::to('appearance/background/settings'), __('Background', 'website'), __('Custom', 'website'));


		// Link
		$link = $portfolio_item_options->addGroup('link', __('Link', 'website'), __('These fields impact only Link format.', 'website'));
			$link->addOption('codeline', 'url', '', __('URL', 'website'));

		// Video
		$video = $portfolio_item_options->addGroup('video', __('Video', 'website'), __('These fields impact only Video format.', 'website'));
			$method = $video->addOption('group', 'method', 'embed', __('Method', 'website'), '', array('options' => array(
				'self'  => __('Self-hosted', 'website'),
				'embed' => __('Embedding code', 'website')
			)));
			$video->addOption('codeline', 'url', '', __('File URL', 'website'), sprintf(__('Supported formats: %s.', 'website'), '<code>mp4</code>, <code>ogg</code>, <code>flv</code>'), array('owner' => $method, 'owner_value' => 'self'));
			$video->addOption('number', 'ratio', 1.7778, __('Size ratio', 'website'), __('Divide width by height to specify correct number.', 'website'), array('owner' => $method, 'owner_value' => 'self', 'float' => true, 'min' => 0.1, 'max' => 10));
			$video->addOption('code', 'code', '', __('External video code', 'website'), '', array('owner' => $method, 'owner_value' => 'embed'));

		// ---------------------------------------------------------------------

		// Gallery options
		$gallery_options = $this->getPostOptions('gallery');

		// Options
		$options = $gallery_options->addGroup('options', __('Options', 'website'), '', 'side');
			$options->addOption('select', 'title', 'inherit', __('Hide title', 'website'), '', array('options' => array(
				'inherit' => __('Inherit', 'website'),
				'hide'    => __('Yes', 'website'),
				'show'    => __('No', 'website')
			)));
			$options->addOption('select', 'size', 'tiny', __('Thumbnails sizes', 'website'), '', array('options' => array(
				'big'    => __('Big', 'website'),
				'medium' => __('Medium', 'website'),
				'small'  => __('Small', 'website'),
				'tiny'   => __('Tiny', 'website')
			)));
			$options->addOption('select', 'orderby', 'menu_order', __('Sort by', 'website'), '', array('options' => array(
				'title'      => __('Title', 'website'),
				'date'       => __('Date', 'website'),
				'rand'       => __('Random order', 'website'),
				'menu_order' => __('Custom order', 'website')
			)));
			$options->addOption('select', 'order', 'asc', __('Sort order', 'website'), '', array('options' => array(
				'asc'  => __('Ascending', 'website'),
				'desc' => __('Descending', 'website')
			)));
			$pagination = $options->addOption('boolean', 'pagination', true, __('Page pagination', 'website'), '', array('caption' => __('Enabled', 'website')));
			$options->addOption('number', 'per_page', 12, __('Thumbnails per page', 'website'), '', array('owner' => $pagination, 'min' => 1, 'max' => 100));

	}

	// -------------------------------------------------------------------------

	/**
	 * Theme options compatybility
	 *
	 * @since 1.2
	 * @see \Drone\Theme::onThemeOptionsCompatybility()
	 *
	 * @param  array  $data
	 * @param  string $version
	 */
	public function onThemeOptionsCompatybility(array &$data, $version)
	{

		// 1.2
		if (version_compare($version, '1.2') < 0) {
			if (isset($data['nav']['top']['visible'])) {
				$data['nav']['top']['visible'] = (bool)$data['nav']['top']['visible'] ? array('desktop', 'mobile') : array();
			}
			if (isset($data['nav']['main']['visible'])) {
				$data['nav']['main']['visible'] = (bool)$data['nav']['main']['visible'] ? array('desktop', 'mobile') : array();
			}
		}

		// 1.3
		if (version_compare($version, '1.3') < 0) {
			if (isset($data['header']['text']) && isset($data['header']['logo'])) {
				$data['header']['logo'] = array(
					'text'  => $data['header']['text'],
					'image' => $data['header']['logo']
				);
			}
			if (isset($data['nav']['breadcrumbs']) && is_array($data['nav']['breadcrumbs'])) {
				if (($key = array_search('single', $data['nav']['breadcrumbs'])) !== false) {
					$data['nav']['breadcrumbs'][$key] = 'singular[post]';
				}
			}
		}

		// 1.6
		if (version_compare($version, '1.6') < 0) {
			if (isset($data['nav']['breadcrumbs']) && is_array($data['nav']['breadcrumbs'])) {
				foreach (array('post', 'portfolio', 'portfolio-item', 'gallery') as $post_type) {
					if (($key = array_search("singular[{$post_type}]", $data['nav']['breadcrumbs'])) !== false) {
						$data['nav']['breadcrumbs'][$key] = "singular({$post_type})";
					}
				}
			}
			if (isset($data['sidebar']['conf']['single'])) {
				$data['sidebar']['conf']['singular(post)'] = $data['sidebar']['conf']['single'];
			}
			if (isset($data['slider']['conf']['single'])) {
				$data['slider']['conf']['singular(post)'] = $data['slider']['conf']['single'];
			}
		}

		// 2.0
		if (version_compare($version, '2.0') < 0) {
			if (isset($data['appearance']['background']['settings']['repeat'])) {
				$data['appearance']['background']['settings']['alignment'] = $data['appearance']['background']['settings']['repeat'];
			}
			if (isset($data['appearance']['background']['settings']['position_x']) && isset($data['appearance']['background']['settings']['position_y'])) {
				$data['appearance']['background']['settings']['position'] = $data['appearance']['background']['settings']['position_x'].' '.$data['appearance']['background']['settings']['position_y'];
			}
			if (isset($data['appearance']['font']['enabled']) && $data['appearance']['font']['enabled']) {
				if (isset($data['appearance']['font']['name']) && $data['appearance']['font']['name']) {
					$family = $data['appearance']['font']['name'];
				} else if (isset($data['appearance']['font']['custom_name']) && $data['appearance']['font']['custom_name']) {
					$family = $data['appearance']['font']['custom_name'];
				} else {
					$family = 'Rokkitt';
				}
			} else {
				$family = 'Times New Roman, Times, serif';
			}
			$data['font']['header']['logo']['family'] = $family;
			$data['font']['header']['tagline']['family'] = $family;
			$data['font']['nav']['main']['family'] = $family;
			$data['font']['front_page']['box_title']['family'] = $family;
			$data['font']['front_page']['columns_title']['family'] = $family;
			$data['font']['slider']['caption']['family'] = $family;
			$data['font']['slider']['flex_caption']['family'] = $family;
			$data['font']['slider']['additional_banner_caption']['family'] = $family;
			$data['font']['slider']['description_title']['family'] = $family;
			$data['font']['post']['title']['family'] = $family;
			$data['font']['post']['about']['family'] = $family;
			$data['font']['post']['dropcap']['family'] = $family;
			$data['font']['post']['h1']['family'] = $family;
			$data['font']['post']['h2']['family'] = $family;
			$data['font']['post']['h3']['family'] = $family;
			$data['font']['post']['h4']['family'] = $family;
			$data['font']['post']['h5']['family'] = $family;
			$data['font']['post']['h6']['family'] = $family;
			$data['font']['misc']['widget_title_aside']['family'] = $family;
			$data['font']['misc']['button_caption']['family'] = $family;
			$data['font']['misc']['other']['family'] = $family;
			if (isset($data['portfolio_item']['pagination'])) {
				$data['portfolio']['pagination'] = $data['portfolio_item']['pagination'];
			}
		}

		// 3.0
		if (version_compare($version, '3.0') < 0) {
			if (isset($data['appearance']['sidebar']) && is_string($data['appearance']['sidebar'])) {
				$data['appearance']['sidebar'] = array('position' => $data['appearance']['sidebar']);
			}
		}

		// 4.2
		if (version_compare($version, '4.2-beta-3') < 0) {
			if (isset($data['font']) && is_array($data['font'])) {
				foreach ($data['font'] as $group_name => $group_value) {
					if (!is_array($group_value)) {
						continue;
					}
					foreach ($group_value as $font_name => $font_value) {
						if (!isset($font_value['family'])) {
							continue;
						}
						$option = self::to_('font/'.$group_name.'/'.$font_name.'/'.$font_name);
						$enabled = is_null($option) || $option->default !== $font_value;
						$data['font'][$group_name][$font_name] = array('enabled' => $enabled, $font_name => $font_value);
					}
				}
			}
			for ($i = 0; $i < 4; $i++) {
				if (isset($data['front_page']['columns']['column'][$i]['icon'])) {
					$data['front_page']['columns']['column'][$i]['icon'] = preg_replace('/\.png$/', '', $data['front_page']['columns']['column'][$i]['icon']);
				}
			}
		}

		// 5.0
		if (version_compare($version, '5.0-beta-4') < 0) {
			$conditional_tags_update = function($key) {
				switch ($key) {
					case 'home,archive':             return 'blog';
					case 'singular(post)':           return 'post_type_post';
					case 'page':                     return 'post_type_page';
					case 'singular(portfolio-item)': return 'post_type_portfolio-item';
					default:                         return $key;
				}
			};
			if (isset($data['sidebar']['conf']) && is_array($data['sidebar']['conf'])) {
				$data['sidebar']['conf'] = \Drone\Func::arrayKeysMap($conditional_tags_update, $data['sidebar']['conf']);
				$data['sidebar']['conf'] = array_filter($data['sidebar']['conf'], function($value) { return $value != 'general'; });
			}
			if (isset($data['slider']['conf']) && is_array($data['slider']['conf'])) {
				$data['slider']['conf'] = \Drone\Func::arrayKeysMap($conditional_tags_update, $data['slider']['conf']);
				$data['slider']['conf'] = array_filter($data['slider']['conf'], function($value) { return $value; });
			}
		}

		// 5.8
		if (version_compare($version, '5.8-alpha-1') < 0) {
			$conditional_tags_update = function($key) {
				switch ($key) {
					case 'home,archive':             return 'blog';
					case 'singular(post)':           return 'post_type_post';
					case 'page':                     return 'post_type_page';
					case 'singular(portfolio)':      return 'post_type_portfolio';
					case 'singular(portfolio-item)': return 'post_type_portfolio-item';
					case 'singular(gallery)':        return 'post_type_gallery';
					default:                         return $key;
				}
			};
			if (isset($data['nav']['breadcrumbs']) && is_array($data['nav']['breadcrumbs'])) {
				$data['nav']['breadcrumbs'] = array_flip(array_map($conditional_tags_update, $data['nav']['breadcrumbs']));
				$data['nav']['breadcrumbs'] = array_map(function() { return true; }, $data['nav']['breadcrumbs']);
				$data['nav']['breadcrumbs']['default'] = false;
			}
		}

	}

	// -------------------------------------------------------------------------

	/**
	 * Post options compatybility
	 *
	 * @since 5.0
	 * @see \Drone\Theme::onPostOptionsCompatybility()
	 *
	 * @param  array  $data
	 * @param  string $version
	 */
	public function onPostOptionsCompatybility(array &$data, $version, $post_type)
	{

		// Slider
		if ($post_type == 'slider') {

			// 5.0
			if (version_compare($version, '5.0-beta-3') < 0) {
				for ($i = 1; $i <= 2; $i++) {
					if (isset($data['banner_'.$i]['image']) && $data['banner_'.$i]['image']) {
						$data['banner_'.$i]['image'] = (int)\Drone\Func::wpGetAttachmentID($data['banner_'.$i]['image']);
					}
					if (isset($data['banner_'.$i]['caption']) && is_string($data['banner_'.$i]['caption'])) {
						$data['banner_'.$i]['caption'] = array('text' => $data['banner_'.$i]['caption']);
					}
					if (isset($data['banner_'.$i]['color']) && is_array($data['banner_'.$i]['caption'])) {
						$data['banner_'.$i]['caption']['color'] = $data['banner_'.$i]['color'];
					}
				}
			}

		}

		// Slider item
		if ($post_type == 'slider-item') {

			// 5.0
			if (version_compare($version, '5.0-beta-3') < 0) {
				if (isset($data['content']['text']) && is_string($data['content']['text'])) {
					$data['content']['text'] = array('text' => $data['content']['text']);
				}
				if (is_array($data['content']['text'])) {
					if (isset($data['content']['color'])) {
						$data['content']['text']['color'] = str_replace(array('white', 'black'), array('#ffffff', '#000000'), $data['content']['color']);
					}
					if (isset($data['content']['align'])) {
						$data['content']['text']['align'] = $data['content']['align'];
					}
				}
				if (isset($data['content']['link']) && is_string($data['content']['link'])) {
					$data['content']['link'] = array('url' => $data['content']['link']);
				}
				if (isset($data['content']['target_blank']) && is_array($data['content']['link'])) {
					$data['content']['link']['new_window'] = $data['content']['target_blank'];
				}
				if (isset($data['description']['more'])) {
					$data['description']['readmore']['text'] = $data['description']['more'];
				}
				if (isset($data['description']['link'])) {
					$data['description']['readmore']['url'] = $data['description']['link'];
				}
			}

		}

	}

	// -------------------------------------------------------------------------

	/**
	 * Initialization
	 *
	 * @since 1.0
	 * @see \Drone\Theme::onLoad()
	 */
	protected function onLoad()
	{

		// Sidebars
		$this->sidebars_def = array(
			'general'         => __('General sidebar', 'website'),
			'front'           => __('Front page sidebar', 'website'),
			'blog'            => __('Blog page sidebar', 'website'),
			'search'          => __('Search results page sidebar', 'website'),
			'posts'           => __('Posts sidebar', 'website'),
			'pages'           => __('Pages sidebar', 'website'),
			'portfolio-items' => __('Portfolio items sidebar', 'website'),
			'404'             => __('Not found page (404) sidebar', 'website'),
		);

	}

	// -------------------------------------------------------------------------

	/**
	 * Theme setup
	 *
	 * @since 1.0
	 * @see \Drone\Theme::onSetupTheme()
	 */
	protected function onSetupTheme()
	{

		// Theme features
		$this->addThemeFeature(array(
			'x-ua-compatible',
			'nav-menu-current-item',
			'comment-form-fields-reverse-order',
			'force-img-caption-shortcode-filter',
			'social-media-api',
			'shortcode-contact',
			'shortcode-no-format'
		));

		// Editor style
		add_editor_style('data/css/wp/editor.css');

		// Menu
		register_nav_menus(array(
			'top-desktop'  => __('Top menu on desktop &amp; tablet devices', 'website'),
			'top-mobile'   => __('Top menu on mobile devices', 'website'),
			'main-desktop' => __('Main menu on desktop &amp; tablet devices', 'website'),
			'main-mobile'  => __('Main menu on mobile devices', 'website')
		));

		// Images
		add_theme_support('post-thumbnails');

		add_image_size('post-thumbnail', 188, 188, true);

		add_image_size('post-image',      650, 975);
		add_image_size('post-image-full', 890, 1335);

		add_image_size('item-big',    940, 1410);
		add_image_size('item-medium', 460, 690);
		add_image_size('item-small',  300, 450);
		add_image_size('item-tiny',   220, 330);

		add_image_size('banner-small',    300, 133, true);
		add_image_size('banner-one-two',  620, 285, true);
		add_image_size('banner-one-text', 620, self::to('slider/height/one_text'), true);
		add_image_size('banner-full',     940, self::to('slider/height/full'), true);

		add_image_size('banner-small-tablet',    220, 98, true);
		add_image_size('banner-one-two-tablet',  460, 211, true);
		add_image_size('banner-one-text-tablet', 460, round(self::to('slider/height/one_text')*(460/620)), true);
		add_image_size('banner-full-tablet',     700, round(self::to('slider/height/full')*(700/940)), true);

		add_image_size('banner-small-mobile',    146, 65, true);
		add_image_size('banner-one-two-mobile',  300, 138, true);
		add_image_size('banner-one-text-mobile', 300, round(self::to('slider/height/one_text')*(300/620)), true);
		add_image_size('banner-full-mobile',     300, round(self::to('slider/height/full')*(300/940)), true);

		// Post formats
		add_theme_support('post-formats', array('link', 'image', 'quote', 'status', 'video', 'audio'));

		// Classes
		\Drone\Options\Option\Font::$always_used = array('Rokkitt');

		// Breadcrumb trail
		add_theme_support('breadcrumb-trail');

		// Captcha
		if (self::isPluginActive('captcha')) {
			if (has_action('comment_form_after_fields', 'cptch_comment_form_wp3')) {
				remove_action('comment_form_after_fields', 'cptch_comment_form_wp3', 1);
				remove_action('comment_form_logged_in_after', 'cptch_comment_form_wp3', 1);
				add_filter('comment_form_field_comment', array($this, 'filterCaptchaCommentFormFieldComment'));
			}
		}

		// Illegal
		if (!is_admin() && self::isIllegal()) {
			self::to_('footer/text/right')->reset();
		}

	}

	// -------------------------------------------------------------------------

	/**
	 * Widgets setup
	 *
	 * @since 1.0
	 * @see \Drone\Theme::onWidgetsInit()
	 */
	protected function onWidgetsInit()
	{

		// Sidebars
		foreach ($this->sidebars_def as $name => $label) {
			register_sidebar(array(
				'name'          => $label,
				'id'            => 'sidebar-'.$name,
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget'  => '</li>',
				'before_title'  => '<h1>',
				'after_title'   => '</h1>'
			));
		}
		register_sidebar(array(
			'name'          => __('Footer sidebar', 'website'),
			'id'            => 'sidebar-bottom',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h1>',
			'after_title'   => '</h1>'
		));

		// Widgets
		$this->addThemeFeature(array(
			'widget-unwrapped-text',
			'widget-contact',
			'widget-posts-list',
			'widget-twitter',
			'widget-flickr',
			'widget-facebook-like-box'
		));

		// Other
		unregister_widget('WP_Widget_Search');
		unregister_widget('WP_Widget_Calendar');

	}

	// -------------------------------------------------------------------------

	/**
	 * Initialization
	 *
	 * @since 5.0
	 * @see \Drone\Theme::onInit()
	 */
	protected function onInit()
	{

		// Slider
		register_post_type('slider', array(
			'label'               => __('Sliders', 'website'),
			'description'         => __('Sliders', 'website'),
			'public'              => false,
			'show_ui'             => true,
			'supports'            => array('title', 'revisions'),
			'menu_icon'           => $this->template_uri.'/data/img/slider.png',
			'labels'              => array(
				'name'               => __('Sliders', 'website'),
				'singular_name'      => __('Slider', 'website'),
				'add_new'            => _x('Add New', 'Slider', 'website'),
				'all_items'          => __('All Sliders', 'website'),
				'add_new_item'       => __('Add New Slider', 'website'),
				'edit_item'          => __('Edit Slider', 'website'),
				'new_item'           => __('New Slider', 'website'),
				'view_item'          => __('View Slider', 'website'),
				'search_items'       => __('Search Sliders', 'website'),
				'not_found'          => __('No Sliders found', 'website'),
				'not_found_in_trash' => __('No Sliders found in Trash', 'website'),
				'menu_name'          => __('Sliders', 'website')
			)
		));
		register_post_type('slider-item', array(
			'label'               => __('Slider Items', 'website'),
			'description'         => __('Slider Items', 'website'),
			'public'              => false,
			'show_ui'             => true,
			'supports'            => array('title', 'thumbnail', 'revisions'),
			'menu_icon'           => $this->template_uri.'/data/img/slider-item.png',
			'labels'              => array(
				'name'               => __('Slider Items', 'website'),
				'singular_name'      => __('Slider Item', 'website'),
				'add_new'            => _x('Add New', 'Slider item', 'website'),
				'all_items'          => __('All Slider Items', 'website'),
				'add_new_item'       => __('Add New Slider Item', 'website'),
				'edit_item'          => __('Edit Slider Item', 'website'),
				'new_item'           => __('New Slider Item', 'website'),
				'view_item'          => __('View Slider Item', 'website'),
				'search_items'       => __('Search Slider Items', 'website'),
				'not_found'          => __('No Slider Items found', 'website'),
				'not_found_in_trash' => __('No Slider Items found in Trash', 'website'),
				'menu_name'          => __('Slider Items', 'website')
			)
		));

		// Portfolio
		register_post_type('portfolio', array(
			'label'               => __('Portfolios', 'website'),
			'description'         => __('Portfolios', 'website'),
			'public'              => true,
			'exclude_from_search' => true,
			'menu_icon'           => $this->template_uri.'/data/img/portfolio.png',
			'supports'            => array('title', 'editor', 'thumbnail', 'revisions'),
			'rewrite'             => array('slug' => self::to('portfolio/slug')),
			'labels'              => array(
				'name'               => __('Portfolios', 'website'),
				'singular_name'      => __('Portfolio', 'website'),
				'add_new'            => _x('Add New', 'Portfolio', 'website'),
				'all_items'          => __('All Portfolios', 'website'),
				'add_new_item'       => __('Add New Portfolio', 'website'),
				'edit_item'          => __('Edit Portfolio', 'website'),
				'new_item'           => __('New Portfolio', 'website'),
				'view_item'          => __('View Portfolio', 'website'),
				'search_items'       => __('Search Portfolios', 'website'),
				'not_found'          => __('No Portfolios found', 'website'),
				'not_found_in_trash' => __('No Portfolios found in Trash', 'website'),
				'menu_name'          => __('Portfolios', 'website')
			)
		));
		register_post_type('portfolio-item', array(
			'label'               => __('Portfolio Items', 'website'),
			'description'         => __('Portfolio Items', 'website'),
			'public'              => true,
			'menu_icon'           => $this->template_uri.'/data/img/portfolio-item.png',
			'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions'),
			'rewrite'             => array('slug' => self::to('portfolio-item/slug')),
			'labels'              => array(
				'name'               => __('Portfolio Items', 'website'),
				'singular_name'      => __('Portfolio Item', 'website'),
				'add_new'            => _x('Add New', 'Portfolio item', 'website'),
				'all_items'          => __('All Portfolio Items', 'website'),
				'add_new_item'       => __('Add New Portfolio Item', 'website'),
				'edit_item'          => __('Edit Portfolio Item', 'website'),
				'new_item'           => __('New Portfolio Item', 'website'),
				'view_item'          => __('View Portfolio Item', 'website'),
				'search_items'       => __('Search Portfolio Items', 'website'),
				'not_found'          => __('No Portfolio Items found', 'website'),
				'not_found_in_trash' => __('No Portfolio Items found in Trash', 'website'),
				'menu_name'          => __('Portfolio Items', 'website')
			)
		));
		register_taxonomy('portfolio-item-category', array('portfolio-item'), array(
			'label'             => __('Categories', 'website'),
			'show_in_nav_menus' => false,
			'hierarchical'      => true,
			'rewrite'           => array('slug' => self::to('portfolio-item/slug').'-category')
		));
		register_taxonomy('portfolio-item-tag', array('portfolio-item'), array(
			'label'             => __('Tags', 'website'),
			'show_in_nav_menus' => false,
			'hierarchical'      => false,
			'rewrite'           => array('slug' => self::to('portfolio-item/slug').'-tag')
		));

		// Gallery
 		register_post_type('gallery', array(
			'label'               => __('Galleries', 'website'),
			'description'         => __('Galleries', 'website'),
			'public'              => true,
			'exclude_from_search' => true,
			'menu_icon'           => $this->template_uri.'/data/img/gallery.png',
			'supports'            => array('title', 'editor', 'thumbnail', 'revisions'), // https://core.trac.wordpress.org/ticket/28219
			'rewrite'             => array('slug' => self::to('gallery/slug')),
			'labels'              => array(
				'name'               => __('Galleries', 'website'),
				'singular_name'      => __('Gallery', 'website'),
				'add_new'            => _x('Add New', 'Gallery', 'website'),
				'all_items'          => __('All Galleries', 'website'),
				'add_new_item'       => __('Add New Gallery', 'website'),
				'edit_item'          => __('Edit Gallery', 'website'),
				'new_item'           => __('New Gallery', 'website'),
				'view_item'          => __('View Gallery', 'website'),
				'search_items'       => __('Search Galleries', 'website'),
				'not_found'          => __('No Galleries found', 'website'),
				'not_found_in_trash' => __('No Galleries found in Trash', 'website'),
				'menu_name'          => __('Galleries', 'website')
			)
		));

	}

	// -------------------------------------------------------------------------

	/**
	 * wp action
	 *
	 * @internal action: wp
	 * @since 1.1
	 */
	public function actionWP()
	{
		if (self::to('advanced/scheme_switcher') && !is_admin()) {
			$cookie_name = "wordpress_{$this->theme->id}_scheme";
			if (isset($_GET['scheme'])) {
				if ($_GET['scheme'] == 'switch') {
					$scheme = !isset($_COOKIE[$cookie_name]) || $_COOKIE[$cookie_name] == 'bright' ? 'dark' : 'bright';
				} else {
					$scheme = $_GET['scheme'];
				}
			} else if (isset($_COOKIE[$cookie_name])) {
				$scheme = $_COOKIE[$cookie_name];
			} else {
				$scheme = '';
			}
			if ($scheme && in_array($scheme, array('bright', 'dark'))) {
				setcookie($cookie_name, $scheme, time() + ($scheme == self::to('appearance/scheme') ? -3600 : 30*86400), COOKIEPATH, COOKIE_DOMAIN); // 30d
				self::to_('appearance/scheme')->value = $scheme;
			}
		}
	}

	// -------------------------------------------------------------------------

	/**
	 * Styles and scripts
	 *
	 * @internal action: wp_enqueue_scripts
	 * @since 3.0
	 */
	public function actionWPEnqueueScripts()
	{

		// Minimize sufix
		$min_sufix = $this->debug_mode ? '' : '.min';

 		// Main style
		wp_enqueue_style('website-style', $this->template_uri."/data/css/style{$min_sufix}.css");

		// Color scheme styles
		wp_enqueue_style('website-scheme', $this->template_uri.'/data/css/'.self::to('appearance/scheme').$min_sufix.'.css');

		// Stylesheet
		wp_enqueue_style('website-stylesheet', get_stylesheet_uri());

		// 3rd part scripts
		wp_enqueue_script('website-imagesloaded', $this->template_uri.'/data/js/imagesloaded.min.js',      array(),         false, true);
		wp_enqueue_script('website-fancybox',     $this->template_uri.'/data/js/jquery.fancybox.min.js',   array('jquery'), false, true);
		wp_enqueue_script('website-flexslider',   $this->template_uri.'/data/js/jquery.flexslider.min.js', array('jquery'), false, true);
		wp_enqueue_script('website-masonry',      $this->template_uri.'/data/js/jquery.masonry.min.js',    array('jquery'), false, true);

		// Website scripts
		wp_enqueue_script('website-script', $this->template_uri."/data/js/website{$min_sufix}.js", array('jquery'), false, true);

		// Comment reply
		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}

		// Configuration
		$this->addDocumentScript(sprintf(
<<<'EOS'
			websiteConfig = {
				templatePath:    '%s',
				flexsliderOptions: %s
			};
EOS
			,
			$this->template_uri,
			json_encode(array_merge(\Drone\Func::arrayKeysToCamelCase(self::to_('slider/prop')->toArray()), array('pauseOnHover' => true)))
		));

		// Leading color
		$this->addDocumentStyle(sprintf(
<<<'EOS'
			button.tiny {
				background: %1$s;
			}
			mark, .post .content .tags a:hover, .items .item .tags a:hover, .filter a:hover, .filter a.active {
				background-color: %1$s;
			}
			a, .comments .comment cite a:hover, button:hover, .widget a:hover {
				border-color: %1$s;
			}
			input[type="submit"]:hover {
				border-color: %1$s !important;
			}
			a, #nav-top a:hover, #nav-main a:hover, #nav-main li.sub > a:hover:after, #bottom input[type="submit"]:hover, #footer a:hover, .breadcrumbs a:hover, .post .title a:hover, .comments .comment .meta a:hover, .comments .comment .meta cite a, .pagination a:hover {
				color: %1$s;
			}
			nav li.current > a, nav li.current > a:after, .widget a:hover {
				color: %1$s !important;
			}
EOS
			,
			self::to('appearance/color')
		));

		// Header height
		$this->addDocumentStyle(sprintf(
<<<'EOS'
			#header h1,
			#header h2,
			#header .ad {
				height: %1$dpx;
			}
			#header h1 img {
				max-height: %1$dpx;
			}
EOS
			, self::to('header/height')
		));

		// Custom background
		if (!is_null($background = self::io_('layout/background/background', 'appearance/background/settings', '__hidden_ns', '__hidden'))) {
			$this->addDocumentStyle(sprintf(
<<<'EOS'
				#main {
					%s
				}
				#nav-main li ul li {
					%s
				}
EOS
				,
				$background->css(),
				$background->value('alignment') == 'repeat' ? $background->css() : 'background: '.$background->value('color').';'
			));
		}

		// Fonts
		$css_media = array(
			'lte-tablet'  => '@media only screen and (max-width: 979px) { %s }',
			'lte-mobile'  => '@media only screen and (max-width: 739px) { %s }',
			'lte-mini'    => '@media only screen and (max-width: 319px) { %s }',
			'gte-desktop' => '@media only screen and (min-width: 980px) { %s }',
			'gte-tablet'  => '@media only screen and (min-width: 740px) { %s }',
			'gte-mobile'  => '@media only screen and (min-width: 320px) { %s }',
			'tablet'      => '@media only screen and (min-width: 740px) and (max-width: 979px) { %s }',
			'mobile'      => '@media only screen and (min-width: 320px) and (max-width: 739px) { %s }'
		);
		foreach (\Drone\Options\Option\Font::getInstances() as $font) {
			if ($font->isVisible() && !is_null($font->tag)) {
				$this->addDocumentStyle($font->css($font->tag[0]));
				foreach (array('tablet', 'mobile', 'mini') as $id => $media) {
					if (isset($font->tag[$id+1]) && $font->tag[$id+1] != 1) {
						$this->addDocumentStyle(sprintf($css_media['lte-'.$media], $font->tag[0].' { font-size: '.round($font->value('size')*$font->tag[$id+1]).'px; }'));
					}
				}
			}
		}

		// Slider height
		if (!self::to_('slider/height/full')->isDefault()) {
			$height = self::to('slider/height/full');
			$ratio  = $height / 940;
			$this->addDocumentStyle(sprintf(
<<<'EOS'
				#banners .banner.full {
					height: %dpx;
				}
				@media only screen and (max-width: 979px) {
					#banners .banner.full {
						height: %dpx;
					}
				}
				@media only screen and (max-width: 739px) {
					#banners .banner.full {
						height: %dpx;
					}
				}
				@media only screen and (max-width: 319px) {
					#banners .banner.full {
						height: %dpx;
					}
				}
EOS
				,
				$height,
				round($ratio*700),
				round($ratio*300),
				round($ratio*220)
			));
		}

		if (!self::to_('slider/height/one_text')->isDefault()) {
			$height = self::to('slider/height/one_text');
			$ratio  = $height / 620;
			$this->addDocumentStyle(sprintf(
<<<'EOS'
				#banners .banner > .big {
					height: %dpx;
				}
				@media only screen and (max-width: 979px) {
					#banners .banner > .big {
						height: %dpx;
					}
				}
				@media only screen and (max-width: 739px) {
					#banners .banner > .big {
						height: %dpx;
					}
				}
				@media only screen and (max-width: 319px) {
					#banners .banner > .big {
						height: %dpx;
					}
				}
EOS
				,
				$height,
				round($ratio*460),
				round($ratio*300),
				round($ratio*220)
			));
		}

		// MediaElement.js progress bar color
		$this->addDocumentStyle(sprintf(
<<<'EOS'
			.mejs-container .mejs-controls .mejs-time-rail .mejs-time-current {
				background-color: %s;
			}
EOS
		, self::to('appearance/color')));

		// List widgets
		if (self::to('appearance/sidebar/fancy_lists') && (
				is_active_widget(false, false, 'pages') ||
				is_active_widget(false, false, 'archives') ||
				is_active_widget(false, false, 'categories') ||
				is_active_widget(false, false, 'recent-posts') ||
				is_active_widget(false, false, 'recent-comments') ||
				is_active_widget(false, false, 'meta') ||
				is_active_widget(false, false, 'nav_menu')
			)) {
			$this->addDocumentJQueryScript(
<<<'EOS'
				$('.widget_pages, .widget_archive, .widget_categories, .widget_recent_entries, .widget_recent_comments, .widget_meta, .widget_nav_menu')
					.find('ul:first')
					.addClass('fancy');
EOS
			);
		}

		// WPML
		if (defined('ICL_SITEPRESS_VERSION')) {
			define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
			$this->addDocumentJQueryScript("\$('#aside #lang_sel_list ul').addClass('fancy');");
		}

	}

	// -------------------------------------------------------------------------

	/**
	 * the_content_more_link filter
	 *
	 * @internal filter: the_content_more_link
	 * @since 1.0
	 *
	 * @param  string $more_link_html
	 * @return string
	 */
	public function filterTheContentMoreLink($more_link_html)
	{
		return str_replace('more-link', 'more more-link', $more_link_html);
	}

	// -------------------------------------------------------------------------

	/**
	 * excerpt_more filter
	 *
	 * @internal filter: excerpt_more
	 * @since 5.0.3
	 *
	 * @param  string $more_string
	 * @return string
	 */
	public function filterExcerptMore($more_string)
	{
		return str_replace(' [&hellip;]', sprintf(' <!-- more-link -->[&hellip;] <a href="%s" class="more more-link">%s</a>', get_permalink(), self::to('post/readmore')), $more_string);
	}

	// -------------------------------------------------------------------------

	/**
	 * dynamic_sidebar_params filter
	 *
	 * @internal filter: dynamic_sidebar_params
	 * @since 1.0
	 *
	 * @param array $params
	 */
	public function filterDynamicSidebarParams($params)
	{
		$params[0]['before_widget'] = preg_replace_callback('/widget[_a-z0-9]+/', function($m) { return $m[0].' '.str_replace('_', '-', $m[0]); }, $params[0]['before_widget']);
		if ($params[0]['id'] == 'sidebar-bottom') {
			static $column = 0;
			static $layout = null;
			if (!is_array($layout)) {
				$layout = str_split(self::to('footer/layout'), 1);
			}
			if (isset($layout[$column])) {
				switch ($layout[$column]) {
					case 's': $class = 'small';  break;
					case 'm': $class = 'medium'; break;
					case 'l': $class = 'large';  break;
					case 'f': $class = 'full';   break;
					case 'x': $class = 'fixed';  break;
					default:  $class = '';
				}
			} else {
				$class = 'none';
			}
			$params[0]['before_widget'] = str_replace('widget ', "widget {$class} ", $params[0]['before_widget']);
			$column++;
		}
		return $params;
	}

	// -------------------------------------------------------------------------

	/**
	 * the_password_form filter
	 *
	 * @internal filter: the_password_form
	 * @since 1.0
	 *
	 * @param  string $output
	 * @return string
	 */
	public function filterThePasswordForm($output)
	{

		global $post;

		return sprintf(

			'<form action="%1$s/%2$s" method="post">'.
				'<p>%4$s</p>'.
				'<p><input name="post_password" id="%3$s" type="password" size="20" placeholder="%5$s" /> <span class="lte-ie9">%5$s</span></p>'.
				'<p><input type="submit" name="submit" value="%6$s" /></p>'.
			'</form>',

			esc_url(get_option('siteurl')),
			'wp-login.php?action=postpass',
			'pwbox-'.(empty($post->ID) ? rand() : $post->ID),

			__('This content is password protected. To view it please enter your password below:', 'website'),
			esc_attr__('password', 'website'),
			esc_attr__('Submit', 'website')

		);

	}

	// -------------------------------------------------------------------------

	/**
	 * wp_video_extensions filter
	 *
	 * @internal filter: wp_video_extensions
	 * @since 4.0
	 *
	 * @param  array $exts
	 * @return array
	 */
	public function filterWPVideoExtensions($exts)
	{
		$exts[] = 'ogg';
		return $exts;
	}

	// -------------------------------------------------------------------------

	/**
	 * previous_post_link, next_post_link filter
	 *
	 * @internal filter: previous_post_link
	 * @internal filter: next_post_link
	 * @since 1.3
	 *
	 * @param  string $format
	 * @return string
	 */
	public function filterPreviousPostLink($format)
	{
		if (preg_match('/rel="(prev|next)"/', $format, $matches)) {
			$rel = $matches[1];
			return preg_replace_callback(
				'|^<a href="(?P<href>[^"]*)"[^>]*>(?P<title>.*?)</a>$|i',
				function($m) use ($rel) {
					return \Drone\HTML::a()->href($m['href'])->class($rel)->rel($rel)->add(
						\Drone\HTML::span()->class('hide-lte-tablet')->add(\Drone\Func::stringCut($m['title'], 32, '&hellip;', 2)),
						\Drone\HTML::span()->class('tablet')->add(\Drone\Func::stringCut($m['title'], 16, '&hellip;', 2))
					)->toHTML();
				},
				$format
			);
		} else {
			return $format;
		}
	}

	// -------------------------------------------------------------------------

	/**
	 * bbp_get_breadcrumb filter
	 *
	 * @internal filter: bbp_get_breadcrumb
	 * @since 3.0
	 *
	 * @param  string $trail
	 * @param  array  $crumbs
	 * @param  array  $r
	 * @return bool
	 */
	public function filterBBPGetBreadcrumb($trail, $crumbs, $r)
	{
		return !trim($r['sep']) ? $trail : '';
	}

	// -------------------------------------------------------------------------

	/**
	 * woocommerce_breadcrumb_defaults filter
	 *
	 * @internal filter: woocommerce_breadcrumb_defaults
	 *
	 * @param  array $args
	 * @return array
	 */
	public function filterWoocommerceBreadcrumbDefaults($args)
	{
		$args['delimiter']   = ' &rsaquo; ';
		$args['wrap_before'] = '<div class="breadcrumbs">';
		$args['wrap_after']  = '</div>';
		return $args;
	}

	// -------------------------------------------------------------------------

	/**
	 * comment_form_field_comment filter for Catpcha plugin
	 *
	 * @since 4.2.1
	 */
	public function filterCaptchaCommentFormFieldComment($comment_field)
	{
		$captcha = \Drone\Func::functionGetOutputBuffer('cptch_comment_form_wp3');
		$captcha = preg_replace('#<br( /)?>#', '', $captcha);
		return $comment_field.$captcha;
	}

	// -------------------------------------------------------------------------

	/**
	 * drone_contact_form_field filter
	 *
	 * @internal filter: drone_contact_form_field
	 * @since 5.2
	 *
	 * @param  \Drone\HTML $field
	 * @param  string      $name
	 * @param  bool        $required
	 * @param  string      $label
	 * @return \Drone\HTML
	 */
	public function filterContactFormField($field, $name, $required, $label)
	{
		$field = \Drone\HTML::p();
		switch ($name) {
			case 'message':
				$field->addNew('textarea')
					->name($name);
				break;
			case 'captcha':
				$field->add('%s');
				break;
			default:
				if ($required) {
					$label .= '*';
				}
				$field->add(
					\Drone\HTML::input()
						->type('text')
						->name($name)
						->placeholder($label),
					' ',
					\Drone\HTML::span()
						->class('lte-ie9')
						->add($label)
				);
		}
		return $field;
	}

	// -------------------------------------------------------------------------

	/**
	 * drone_contact_form_output filter
	 *
	 * @internal filter: drone_contact_form_output
	 * @since 5.2
	 *
	 * @param  \Drone\HTML $output
	 * @param  string      $context
	 * @return \Drone\HTML
	 */
	public function filterContactFormOutput($output, $context)
	{
		$scheme = self::to('appearance/scheme');
		$loader = $context == 'widget-sidebar-bottom' ? 'load-bottom' : 'load';
		$output->add(
			\Drone\HTML::p()->class('frame message'),
			\Drone\HTML::p()->add(
				\Drone\HTML::input()->type('submit')->value(__('Send', 'website')),
				\Drone\HTML::img()->class('load')->alt('loading')->width(16)->height(16)->src("{$this->template_uri}/data/img/{$scheme}/{$loader}.gif")
			)
		);
		return $output;
	}

	// -------------------------------------------------------------------------

	/**
	 * drone_widget_id_base filter
	 *
	 * @internal filter: drone_widget_id_base
	 * @since 5.0
	 *
	 * @param  string $id_base
	 * @param  string $id
	 * @return string
	 */
	public function filterWidgetIDBase($id_base, $id)
	{
		return preg_replace("/{$id}\$/", str_replace('-', '', $id), $id_base);
	}

	// -------------------------------------------------------------------------

	/**
	 * drone_widget_posts_list_widget filter
	 *
	 * @internal filter: drone_widget_posts_list_widget
	 * @since 5.0
	 *
	 * @param object $html
	 * @param object $widget
	 */
	public function filterWidgetPostsListWidget($html, $widget)
	{
		return $html->addClass('fancy');
	}

	// -------------------------------------------------------------------------

	/**
	 * drone_widget_flickr_photo filter
	 *
	 * @internal filter: drone_widget_flickr_photo
	 * @since 5.0
	 *
	 * @param object $li
	 * @param object $widget
	 * @param object $photo
	 */
	public function filterWidgetFlickrPhoto($li, $widget, $photo)
	{
		$a   = $li->child(0);
		$img = $a->child(0);
		if (self::to('appearance/image/fancybox') && $widget->wo('url') == 'image') {
			$a->addClass('fancybox');
		}
		$img->width = 41;
		$img->height = 41;
		return $li;
	}

	// -------------------------------------------------------------------------

	/**
	 * Get blog name leading letter
	 *
	 * @since 2.2
	 *
	 * @return string
	 */
	public static function getLeadingLetter()
	{
		$name = self::to('header/text').get_bloginfo('name');
		return preg_replace('/[^a-z]/', '', strtolower(substr($name, 0, 1)));
	}

	// -------------------------------------------------------------------------

	/**
	 * Navigation menu
	 *
	 * @since 1.2
	 *
	 * @param string $nav
	 */
	public static function navMenu($nav)
	{
		extract(self::to_('nav/'.$nav)->toArray());
		if (empty($visible)) {
			return;
		}
		$menu = \Drone\HTML::nav()->id('nav-'.$nav)->class($align.' clear');
		foreach ($visible as $device) {
			$class = sprintf('%slte-mobile', $device == 'desktop' ? 'hide-' : '');
			$nav_menu = wp_nav_menu(array(
				'theme_location' => "{$nav}-{$device}",
				'echo'           => false,
				'container'      => '',
				'menu_id'        => "nav-{$nav}-{$device}",
				'menu_class'     => $class,
				'fallback_cb'    => function() use ($class, $content) {
					return \Drone\HTML::ul()
						->class($class)
						->add(call_user_func('wp_list_'.$content, array('title_li' => '', 'depth' => 0, 'echo' => false)))
						->toHTML();
				}
			));
			$menu->add($nav_menu);
		}
		if (count($visible) == 1) {
			$menu->addClass($class);
		}
		echo $menu;
	}

	// -------------------------------------------------------------------------

	/**
	 * Comment template
	 *
	 * @since 1.0
	 *
	 * @param object $comment
	 * @param array  $args
	 * @param int    $depth
	 */
	public static function comment($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
		$comment_reply_args = array(
			'reply_text' => __('Reply', 'website'),
			'before'     => ' &bull; ',
			'depth'      => $depth
		);
		?>
		<article id="comment-<?php comment_ID(); ?>" <?php comment_class(array('comment', 'level-'.($depth-1))); ?>>
			<?php echo get_avatar($comment, 35); ?>
			<div class="meta">
				<cite><?php comment_author_link(); ?></cite>
				<div class="date">
					<time datetime="<?php printf('%sT%sZ', get_comment_date('Y-m-d'), get_comment_time('H:i')); ?>"><?php printf(__('%1$s at %2$s', 'website'), get_comment_date(), get_comment_time()); ?></time>
					<?php comment_reply_link(array_merge($args, $comment_reply_args)); ?>
					<?php edit_comment_link(__('Edit', 'website'), ' &bull; '); ?>
				</div>
			</div>
			<div class="content">
				<?php if ($comment->comment_approved == '0') : ?>
					<p><em><?php _e('Your comment is awaiting moderation.', 'website'); ?></em></p>
				<?php endif; ?>
				<?php comment_text(); ?>
			</div>
		</article>
		<?php
	}

	// -------------------------------------------------------------------------

	/**
	 * Get sidebar name
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	public static function getSidebarName()
	{
		if (is_singular()) {
			$sidebar = self::po('options/sidebar');
		}
		if (!isset($sidebar) || $sidebar == 'inherit') {
			$sidebar = self::to_('sidebar/conf')->value();
		}
		return $sidebar;
	}

	// -------------------------------------------------------------------------

	/**
	 * Get slider name
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	public static function getSliderName()
	{
		if (is_singular()) {
			$slider = self::po('options/slider');
		}
		if (!isset($slider) || $slider == 'inherit') {
			$slider = self::to_('slider/conf')->value();
		}
		return $slider;
	}

	// -------------------------------------------------------------------------

	/**
	 * Get content section class
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	public static function getContentClass()
	{
		if (self::getSidebarName()) {
			$GLOBALS['content_width'] = 650;
			return self::to('appearance/sidebar/position') == 'right' ? 'alpha' : 'beta';
		} else {
			$GLOBALS['content_width'] = 890;
			return '';
		}
	}

	// -------------------------------------------------------------------------

	/**
	 * Content section class
	 *
	 * @since 1.0
	 */
	public static function contentClass()
	{
		echo self::getContentClass();
	}

	// -------------------------------------------------------------------------

	/**
	 * Title
	 *
	 * @since 5.0
	 */
	public static function title()
	{
		$hide = self::io('options/title', get_post_type().'/hide_title');
		if (!is_search() && ($hide === true || $hide === 'hide')) {
			return;
		}
		$html = \Drone\HTML::h1()->class('title entry-title');
		if (is_singular()) {
			$html->add(get_the_title());
		} else if (is_search()) {
			$html->add(
				self::getPostMetaFormat('<a href="%link%" title="%title_esc%">%s</a>', preg_replace('/\b'.preg_quote(get_search_query(), '/').'\b/i', '<mark class="search">\0</mark>', get_the_title()))
			);
		} else {
			$html->add(self::getPostMetaFormat('<a href="%link%" title="%title_esc%">%title%</a>'));
		}
		echo $html;
	}

}

// -----------------------------------------------------------------------------

Website::getInstance();