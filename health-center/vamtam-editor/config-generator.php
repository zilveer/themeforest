<?php

/**
 * Vamtam Editor Shortcode Options Editor
 *
 * @package wpv
 */

/**
 * class WPV_Editor_Shortcode_Config
 */
class WPV_Editor_Shortcode_Config {

	/**
	 * Initialize the generator
	 * @param array $config generator options
	 */
	public function __construct($config) {
		$this->config = $config;
	}

	/**
	 * Reinitialize the generator
	 * @param array $config generator options
	 */
	public static function setConfig($config) {
		return new self($config);
	}

	/**
	 * Single row template
	 * @param  string $template template name
	 * @param  array  $value    option row config
	 */
	public function tpl($template, $value) {
		extract($value);
		if(!isset($desc))
			$desc = '';
		
		if(!isset($default))
			$default = null;
		
		if(!isset($class))
			$class = '';

		include WPV_ADMIN_HELPERS . "config_generator/$template.php";
	}

	/**
	 * Renders the shortcode editor
	 */
	public function render() {
?>
		<div class="wpv-config-group metabox">
			<div class="wpv-config-row shortcode-title">
				<h3><?php echo $this->config['name'] ?></h3>
				<div class="action-buttons">
					<a class="wpv-cancel-element" href="#"><?php _e('Cancel', 'health-center') ?></a>
					<a class="wpv-save-element button-primary" href="#"><?php _e('Save Element', 'health-center') ?></a>
				</div>
			</div>
			
			<?php foreach($this->config['options'] as $option) $this->tpl($option['type'], $option) ?>
			
			<div class="wpv-config-row last-row">
				<a class="wpv-cancel-element" href="#"><?php _e('Cancel', 'health-center') ?></a>
				<a class="wpv-save-element button-primary" href="#"><?php _e('Save Element', 'health-center') ?></a>
			</div>
		</div>
<?php
	}
}