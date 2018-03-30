<?php
require_once CT_THEME_LIB_DIR . '/types/ctPortfolioTypeBase.class.php';

/**
 * Custom type - portfolio
 */

class ctPortfolioType extends ctPortfolioTypeBase {

	/**
	 * Adds meta box
	 */

	public function addMetaBox() {
		parent::addMetaBox();
		add_meta_box("portfolio-template-meta", __("Template settings", 'ct_theme'), array($this, "portfolioTemplateMeta"), "portfolio", "normal", "high");
	}

	/**
	 * Draw s portfolio meta
	 */

	public function portfolioMeta() {
		global $post;
		$custom = get_post_custom($post->ID);
		$client = isset($custom["client"][0]) ? $custom["client"][0] : "";
		$client_icon = isset($custom["client_icon"][0]) ? ($custom["client_icon"][0] ? $custom["client_icon"][0] : "batch user-2") : '';
		$date = isset($custom["date"][0]) ? $custom["date"][0] : "";
		$date_icon = isset($custom["date_icon"][0]) ? ($custom["date_icon"][0] ? $custom["date_icon"][0] : "icon-calendar") : "";
		$venue = isset($custom["venue"][0]) ? $custom["venue"][0] : "";
		$venue_icon = isset($custom["venue_icon"][0]) ? ($custom["venue_icon"][0] ? $custom["venue_icon"][0] : "icon-map-marker") : "";
		$external_url = isset($custom["external_url"][0]) ? $custom["external_url"][0] : "";
		$external_label = isset($custom["external_label"][0]) ? $custom["external_label"][0] : "";
		$video = isset($custom["video"][0]) ? $custom["video"][0] : "";
		$displayMethod = isset($custom['display_method'][0]) ? $custom['display_method'][0] : 'image';
		$revolution_slider = isset($custom['revolution_slider'][0]) ? $custom['revolution_slider'][0] : '';

		if ($supportsRevolutionSlider = function_exists('rev_slider_shortcode')) {
			global $wpdb;
			$slides = $wpdb->get_results("SELECT * FROM wp_revslider_sliders");
		}
		?>
		<p>
			<label for="client"><?php _e('Client', 'ct_theme')?>: </label>
			<input id="client" class="regular-text" name="client" value="<?php echo $client; ?>"/>
		<p class="howto"><?php _e("Information about client", 'ct_theme')?></p>
		<p>
			<label for="client_icon"><?php _e('Client icon', 'ct_theme')?>: </label>
			<input id="client_icon" class="regular-text" name="client_icon" value="<?php echo $client_icon; ?>"/>
			<?php $clientIcons = sprintf(__(" View %s and enter icon name ex. user", 'ct_theme'), '<a target="_blank" id="open_client_icon' . '" href="' . CT_THEME_ASSETS . '/shortcode/batch/index.html' . '">' . __('available icons', 'ct_theme') . '</a>')?>
		<p class="howto"><?php echo  __("Link to icon representation of the client field.", 'ct_theme') . $clientIcons?></p>

		<p>
			<label for="date"><?php _e('Date', 'ct_theme')?>: </label>
			<input id="date" class="regular-text" name="date" value="<?php echo $date; ?>"/>
		<p class="howto"><?php _e("Information about date", 'ct_theme')?></p>
		<p>
			<label for="date_icon"><?php _e('Date icon', 'ct_theme')?>: </label>
			<input id="date_icon" class="regular-text" name="date_icon" value="<?php echo $date_icon; ?>"/>
			<?php $dateIcons = sprintf(__(" View %s and enter icon name ex. user", 'ct_theme'), '<a target="_blank" id="open_date_icon' . '" href="' . CT_THEME_ASSETS . '/shortcode/batch/index.html' . '">' . __('available icons', 'ct_theme') . '</a>')?>
		<p class="howto"><?php echo __("Link to icon representation of the date field", 'ct_theme') . $dateIcons?></p>
		<p>
				<label for="venue"><?php _e('Venue', 'ct_theme')?>: </label>
				<input id="venue" class="regular-text" name="venue" value="<?php echo $venue; ?>"/>
			<p class="howto"><?php _e("Information about venue", 'ct_theme')?></p>
			<p>
				<label for="venue_icon"><?php _e('Venue icon', 'ct_theme')?>: </label>
				<input id="venue_icon" class="regular-text" name="venue_icon" value="<?php echo $venue_icon; ?>"/>
				<?php $venueIcons = sprintf(__(" View %s and enter icon name ex. user", 'ct_theme'), '<a target="_blank" id="open_venue_icon' . '" href="' . CT_THEME_ASSETS . '/shortcode/awesome/index.html' . '">' . __('available icons', 'ct_theme') . '</a>')?>
			<p class="howto"><?php echo __("Link to icon representation of the venue field", 'ct_theme') . $venueIcons?></p>
		<p>
			<label for="url">Url: </label>
			<input id="url" class="regular-text" name="external_url" value="<?php echo $external_url; ?>"/>
		</p>
		<p class="howto"><?php _e("Link to external site. Leave empty to hide button", 'ct_theme')?></p>
		<p>
			<label for="external_label">Url label: </label>
			<input id="external_label" class="regular-text" name="external_label" value="<?php echo $external_label; ?>"/>
		</p>
		<p class="howto"><?php _e("Label for the external url", 'ct_theme')?></p>
		<p>
			<label for="display_method"><?php _e('Show portfolio item as', 'ct_theme')?>: </label>
			<select class="ct-toggler" id="display_method" name="display_method">
				<option data-group=".display" value="image" <?php echo selected('image', $displayMethod)?>><?php _e("Featured image", 'ct_theme')?></option>
				<option data-group=".display" data-toggle="ct-toggable.gallery" value="gallery" <?php echo selected('gallery', $displayMethod)?>><?php _e("Gallery", 'ct_theme')?></option>
				<option data-group=".display" data-toggle="ct-toggable.video" value="video" <?php echo selected('video', $displayMethod)?>><?php _e("Video", 'ct_theme')?></option>
				<?php if ($supportsRevolutionSlider): ?>
					<option data-group=".display" data-toggle="ct-toggable.revolution-slider" value="revolution-slider" <?php echo selected('revolution-slider', $displayMethod)?>><?php _e("Revolution slider gallery", 'ct_theme')?></option>
				<?php endif;?>
			</select>
		</p>
		<p class="ct-toggable video display">
			<label for="video"><?php _e('Video url', 'ct_theme')?>: </label>
			<input id="video" class="regular-text" name="video" value="<?php echo $video; ?>"/>
		</p>
		<?php if ($supportsRevolutionSlider): ?>
			<p class="ct-toggable revolution-slider display">
				<label for="revolutionSlider"><?php _e('Revolution slider', 'ct_theme')?>: </label>

				<select id="revolutionSlider" name="revolution_slider">
					<?php foreach ($slides as $slide): ?>
						<option <?php echo selected($slide->alias, $revolution_slider)?> value="<?php echo $slide->alias ?>"><?php echo $slide->title?></option>
					<?php endforeach;?>
				</select>
			</p>
		<?php endif; ?>
	<?php
	}

	/**
	 * portfolio template settings
	 */

	public function portfolioTemplateMeta() {
		global $post;
		$custom = get_post_custom($post->ID);
		$title = isset($custom["show_title"][0]) ? $custom["show_title"][0] : "";
		$bread = isset($custom["show_breadcrumbs"][0]) ? $custom["show_breadcrumbs"][0] : "";
		$boxed = isset($custom["use_boxed"][0]) ? $custom["use_boxed"][0] : "";
		$slider = isset($custom["slider"][0]) ? $custom["slider"][0] : "";
		?>
    <p>
        <label for="show_title"><?php _e('Show title', 'ct_theme')?>: </label>
        <select id="show_title" name="show_title">
            <option value="global" <?php echo selected('global', $title)?>><?php _e("use global settings", 'ct_theme')?></option>
            <option value="yes" <?php echo selected('yes', $title)?>><?php _e("show title", 'ct_theme')?></option>
            <option value="no" <?php echo selected('no', $title)?>><?php _e("hide title", 'ct_theme')?></option>
        </select>
    </p>
    <p class="howto"><?php _e("Show page title?", 'ct_theme')?></p>

    <p>
        <label for="show_breadcrumbs"><?php _e('Show breadcrumbs', 'ct_theme')?>: </label>
        <select id="show_breadcrumbs" name="show_breadcrumbs">
            <option value="global" <?php echo selected('global', $bread)?>><?php _e("use global settings", 'ct_theme')?></option>
            <option value="yes" <?php echo selected('yes', $bread)?>><?php _e("show breadcrumbs", 'ct_theme')?></option>
            <option value="no" <?php echo selected('no', $bread)?>><?php _e("hide breadcrumbs", 'ct_theme')?></option>
        </select>
    </p>
    <p class="howto"><?php _e("Show breadcrumbs?", 'ct_theme')?></p>

    <p>
        <label for="use_boxed"><?php _e('Use boxed layout', 'ct_theme')?>: </label>
        <select id="use_boxed" name="use_boxed">
            <option value="global" <?php echo selected('global', $boxed)?>><?php _e("use global settings", 'ct_theme')?></option>
            <option value="yes" <?php echo selected('yes', $boxed)?>><?php _e("boxed layout", 'ct_theme')?></option>
            <option value="no" <?php echo selected('no', $boxed)?>><?php _e("full layout", 'ct_theme')?></option>
        </select>
    </p>
    <p class="howto"><?php _e("Use boxed or full layout template for this page?", 'ct_theme')?></p>

	<p>
        <label for="slider"><?php _e('Top slider', 'ct_theme')?>: </label>
        <textarea id="slider" class="regular-text" name="slider" cols="100" rows="10"><?php echo $slider; ?></textarea>
    </p>
    <p class="howto"><?php _e("Top slider code", 'ct_theme')?></p>
	<?php
	}


	public function saveDetails() {
		parent::saveDetails();
		global $post;

		$fields = array('client_icon', 'date', 'date_icon', 'venue', 'venue_icon', 'tools', 'tools_icon', 'external_label', 'show_title', 'show_breadcrumbs', 'use_boxed', 'slider');
		foreach ($fields as $field) {
			if (isset($_POST[$field])) {
				update_post_meta($post->ID, $field, $_POST[$field]);
			}
		}
	}
}

new ctPortfolioType();