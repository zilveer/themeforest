<?php
if (!defined('ABSPATH')) exit;

$donate_button_url_type = (TMM::get_option('donate_button_url_type') === null || TMM::get_option('donate_button_url_type') === '0') ? 'link' : 'page';

$args = array(
	'sort_order' => 'ASC',
	'sort_column' => 'post_title',
	'hierarchical' => 0,
	'parent' => -1,
	'post_type' => 'page',
	'post_status' => 'publish'
);
$pages = get_pages($args);
$pages_list = array();

if ($pages) {

	foreach ( $pages as $item ) {
		$pages_list[$item->ID] = $item->post_title;
	}

}
?>

<h4 class="option-title"><?php _e('Donate Button Url', 'diplomat'); ?></h4>

<div class="option option-radio">
	
	<div class="controls">
		<input id="donate_link" type="radio" class="showhide" data-show-hide="donate_link" name="donate_button_url_type" value="0" <?php checked($donate_button_url_type, 'link'); ?> />
		<label for="donate_link"><span></span><?php _e('Custom link', 'diplomat'); ?></label>&nbsp; &nbsp;
		<input id="donate_page" type="radio" class="showhide" data-show-hide="donate_page" name="donate_button_url_type" value="1" <?php checked($donate_button_url_type, 'page'); ?> />
		<label for="donate_page"><span></span><?php _e('Select donate page', 'diplomat'); ?></label>
	</div><!--/ .controls-->
	
	<div class="explain"></div>
	
</div><!--/ .option-->	

<ul class="show-hide-items">

	<li class="donate_link" <?php echo ($donate_button_url_type === 'link' ? "" : 'style="display:none;"'); ?>>
		
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'title' => '',
			'type' => 'text',
			'default_value' => '',
			'description' => __('Input donate page url', 'diplomat'),
			'id' => 'donate_link',
			'name' => 'donate_button_custom_link',
		));
		?>

	</li>
	<li class="donate_page" <?php echo($donate_button_url_type === 'page' ? "" : 'style="display:none;"') ?>>
		
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'title' => '',
			'type' => 'select',
			'default_value' => 0,
			'values' => $pages_list,
			'description' => __('Select donate page', 'diplomat'),
			'id' => 'donate_page',
			'name' => 'donate_button_page',
		));
		?>
		
	</li>
</ul>
