<?php
if (!defined('ABSPATH')) exit();

include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_general/tab_general.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_header/tab_header.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_search/tab_search.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_styling/tab_styling.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_blog/tab_blog.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_gallery/tab_gallery.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_contact_forms/tab_contact_forms.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_custom_sidebars/tab_custom_sidebars.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_seo/tab_seo.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_api/tab_api.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_footer/tab_footer.php';

if (class_exists('TMM_Portfolio')) {
	include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_portfolio/tab_portfolio.php';
}

if (class_exists('TMM_Mail_Subscription')) {
	include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_mail_subscription/tab_mail_subscription.php';
}

/* modules and plugins can add custom tab to Theme Options */
do_action('tmm_add_theme_options_tab');
?>

<script type="text/javascript">var tmm_options_reset_array = [];</script>

<form id="theme_options" name="theme_options" method="post" style="display: none;">
	<section class="admin-container clearfix">

		<header id="title-bar" class="clearfix">

			<a href="#" class="admin-logo">
				<img src="<?php echo esc_url(TMM_THEME_URI); ?>/admin/theme_options/images/admin-logo.png" alt="" />
			</a>
			<span class="fw-version">framework v.<?php echo TMM_FRAMEWORK_VERSION ?></span>

		</header><!--/ #title-bar-->

		<section class="set-holder clearfix">

			<ul class="support-links">
				<li><a class="support-docs" href="<?php echo esc_url(TMM_THEME_LINK); ?>" target="_blank"><?php esc_html_e('View Theme Docs', 'diplomat'); ?></a></li>
				<li><a class="support-forum" href="<?php echo esc_url(TMM_THEME_FORUM_LINK); ?>" target="_blank"><?php esc_html_e('Visit Forum', 'diplomat'); ?></a></li>
			</ul><!--/ .support-links-->

			<div class="button-options">
				<a href="#" class="admin-button button-yellow button_reset_options"><?php esc_html_e('Reset All Options', 'diplomat'); ?></a>
				<a href="#" class="admin-button button-yellow button_save_options"><?php esc_html_e('Save All Changes', 'diplomat'); ?></a>
			</div><!--/ .button-options-->

		</section><!--/ .set-holder-->

		<div class="framework-container clearfix">

			<aside id="admin-aside">

				<ul class="admin-nav">

					<?php foreach (TMM_OptionsHelper::$sections as $section_key => $section){ ?>

						<?php if (!empty($section['child_sections'])){ ?>

							<li>
								<?php if ($section['show_general_page']): ?>
									<a class="<?php echo esc_attr($section['css_class']); ?>" href="#<?php echo $section_key; ?>">
										<i class="dashicons <?php echo esc_attr($section['menu_icon']); ?>"></i>
										<?php echo esc_html($section['name']); ?>
									</a>
								<?php else: ?>

									<?php
									reset($section['child_sections']);
									$first_child_section_key = key($section['child_sections']);
									?>
									<a class="<?php echo esc_attr($section['css_class']); ?>" href="#<?php echo $first_child_section_key; ?>">
										<i class="dashicons <?php echo esc_attr($section['menu_icon']); ?>"></i>
										<?php echo esc_html($section['name']); ?>
									</a>

								<?php endif; ?>

									<ul>
										<?php if ($section['show_general_page']): ?>
											<li><a href="#<?php echo $section_key; ?>"><?php esc_html_e('General', 'diplomat'); ?></a></li>
										<?php endif; ?>

										<?php foreach ($section['child_sections'] as $child_section_key => $child_section) : ?>
											<li><a href="#<?php echo $child_section_key; ?>"><?php echo esc_html($child_section['name']); ?></a></li>
										<?php endforeach; ?>
									</ul>

							</li>

						<?php } else{ ?>

							<li>
								<a class="<?php echo esc_attr($section['css_class']); ?>" href="#<?php echo $section_key; ?>">
									<i class="dashicons <?php echo esc_attr($section['menu_icon']); ?>"></i>
									<?php echo esc_html($section['name']); ?>
								</a>
							</li>

						<?php } ?>

					<?php } ?>

				</ul><!--/ .admin-nav-->

			</aside><!--/ #admin-aside-->

			<section id="options-framework" class="clearfix">

				<?php foreach (TMM_OptionsHelper::$sections as $section_key => $section) : ?>
					<?php if ($section['show_general_page']): ?>
						<div id="<?php echo esc_attr($section_key); ?>" class="section-tab">
							<h1 class="section-tab-title"><?php echo esc_html($section['name']); ?></h1>


							<?php foreach ($section['content'] as $item_key => $item) : ?>

								<div class="section">

									<?php if (!empty($item['title']) && $item['type'] != 'checkbox'): ?>
										<h2 class="section-title"><?php echo esc_html($item['title']); ?></h2>
									<?php endif; ?>

									<?php
									if (($item['type'] == 'items_block')) {
										foreach ($item['items'] as $block_item_key => $block_item) {
											tmm_print_options_item($block_item_key, $block_item);
										}
									} else {
										tmm_print_options_item($item_key, $item);
									}
									?>

								</div><!--/ .section-->

							<?php endforeach; ?>

						</div><!--/ .section-tab-->
					<?php endif; ?>

					<?php if (!empty($section['child_sections'])): ?>
						<?php foreach ($section['child_sections'] as $child_section_key => $child_section) : ?>
							<div id="<?php echo esc_attr($child_section_key); ?>" class="section-tab">

								<h1 class="section-tab-title"><?php echo esc_html($child_section['name']); ?></h1>

								<?php foreach ($child_section['sections'] as $item_key => $item) : ?>

									<div class="section">

										<?php if (!empty($item['title']) && $item['type'] != 'checkbox'): ?>
											<h2 class="section-title"><?php echo esc_html($item['title']); ?></h2>
										<?php endif; ?>

										<?php
										if (($item['type'] == 'items_block')) {
											foreach ($item['items'] as $block_item_key => $block_item) {
												tmm_print_options_item($block_item_key, $block_item);
											}
										} else {
											tmm_print_options_item($item_key, $item);
										}
										?>

									</div><!--/ .section-->

								<?php endforeach; ?>

							</div>
						<?php endforeach; ?>
					<?php endif; ?>

				<?php endforeach; ?>


				<div class="admin-group-button clearfix">
					<a class="admin-button button-yellow align-left button_reset_options" href="#"><?php esc_html_e('Reset All Options', 'diplomat'); ?></a>
					<a class="admin-button button-yellow align-right button_save_options" href="#"><?php esc_html_e('Save All Changes', 'diplomat'); ?></a>
				</div>

			</section><!--/ #admin-content-->

		</div>

	</section><!--/ .admin-container-->
</form>

<?php

function tmm_print_options_item($item_key, $item) {
	switch ($item['type']) {
		case 'textarea':
		case 'text':
		case 'google_font_select':
		case 'color':
		case 'upload':
		case 'checkbox':
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => $item_key,
				'title' => $item['title'],
				'type' => $item['type'],
				'default_value' => $item['default_value'],
                //'placeholder' => $item['placeholder'],
				'description' => $item['description'],
				'is_reset' => (isset($item['is_reset']) ? $item['is_reset'] : false),
				'css_class' => (isset($item['css_class']) ? $item['css_class'] : '')
			));
			break;
		case 'select':
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => $item_key,
				'title' => $item['title'],
				'type' => 'select',
				'default_value' => $item['default_value'],
				'values' => $item['values'],
				'description' => $item['description'],
				'is_reset' => (isset($item['is_reset']) ? $item['is_reset'] : false),
				'css_class' => (isset($item['css_class']) ? $item['css_class'] : '')
			));
			break;
		case 'slider':
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => $item_key,
				'title' => $item['title'],
				'type' => 'slider',
				'default_value' => $item['default_value'],
				'description' => $item['description'],
				'min' => $item['min'],
				'max' => $item['max'],
				'is_reset' => (isset($item['is_reset']) ? $item['is_reset'] : false),
				'css_class' => (isset($item['css_class']) ? $item['css_class'] : '')
			));
			break;
		default:
			break;
	}

	echo $item['custom_html'];
}
