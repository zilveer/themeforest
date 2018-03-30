<?php

class PeThemeSCManager {

	protected $master;
	protected $shortcodes;
	protected $reqFields;
	public $blockLevel = array();

	public function __construct(&$master) {
		$this->master =& $master;
		add_filter("the_content", array(&$this,"the_content_filter"));
	}

	public function add() {
		$shortcodes =& PeGlobal::$config["shortcodes"];

		if (is_array($shortcodes) && count($shortcodes) > 0) {
			foreach ($shortcodes as $shortcode) {
				$class = "PeThemeShortcode$shortcode";
				$sc = new $class($this);
				$trigger = $sc->trigger;
				add_shortcode($trigger,array($sc,"output"));					
				$this->shortcodes[$trigger] = $sc;
			}
		}

		add_action('wp_ajax_pe_theme_shortcode_manager', array(&$this, 'shortcode_manager'));		
	}

	public function run($content) {
		echo do_shortcode(apply_filters("the_content",$content));
	}


	public function the_content_filter($content) {

		if (count($this->blockLevel) === 0) return $content;

		$block = join("|",$this->blockLevel);

		// opening tag
		$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		
		// closing tag
		$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);

		/*
		  print_r($content);
		  print_r("------------------\n");
		  print_r($rep);
		*/

		return $rep;

	}

	public function admin() {
		// check if admin is needed
		if (!(current_user_can('edit_posts') || current_user_can('edit_pages'))) {
			return;
		}

		// Add only in Rich Editor mode
		if (get_user_option('rich_editing') == 'true') {
			add_filter("mce_external_plugins", array(&$this,"mce_external_plugins"));
			add_filter('mce_buttons',array(&$this,"mce_buttons"));

			// WP 3.9+ fix
			wp_enqueue_script( 'jquery-ui-dialog' );
			wp_enqueue_style( 'wp-jquery-ui-dialog' );

			// we create a null selectbox field here so that required css/js will be included in the page
			$field = new PeThemeFormElementSelect("","",$null);			
			$field->registerAssets();

			$seen = array();
			// now we do the same for each field type used in at least one shortcode
			foreach ($this->shortcodes as $sc) {
				// include shortcode assets
				$sc->registerAssets();

				// include fields assets
				if (isset($sc->fields)) {
					foreach ($sc->fields as $name => $data) {
						$class = "PeThemeFormElement".$data["type"];
						if (!isset($seen[$class])) {
							$seen[$class] = true;
							$field = new $class("shortcode",$name,$data);
							$field->registerAssets();
						}
					}
				}

			}


		}
	}

	public function mce_external_plugins($plugins) {
		$plugins['peThemeShortcodeManager'] = PE_THEME_URL .'/framework/js/admin/jquery.theme.shortcodes.js';
		return $plugins;
	}

	public function mce_buttons($buttons) {
		array_push($buttons, "separator", "peSCM");
		return $buttons;
	}

	
	protected function pre() {
		$html = <<< EOT
<div class="pe_theme">
	<div class="pe_theme_wrap">
		<!--info bar top-->
		<div class="contents clearfix">
			<div id="options_tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all clearfix">
EOT;

		return $html;
	}

	protected function post() {
		$buttonText = __("Insert Shortcode",'Pixelentity Theme/Plugin');
		$html = <<< EOT
<input id="peSCM_insert_" class="button save-options" type="submit" name="submit" value="{$buttonText}">
</div>
</div>				
</div>
</div>
EOT;

		return $html;
	}

	protected function buildScOptionList() {
		$options = array();

		foreach ($this->shortcodes as $name=>$sc) {
			$options[$sc->group][$sc->name] = $sc->trigger;  
		}

		return $options;

	}


	public function shortcode_manager() {
		$params = array(
						"label" => __("Shortcode",'Pixelentity Theme/Plugin'),
						"groups" => true,
						"options" => $this->buildScOptionList()
					   );

		$select = new PeThemeFormElementSelect("peSCM","select",$params);			

		echo $this->pre();
		$select->render();

		foreach ($this->shortcodes as $sc) {
			//echo "<div class=\"peThemeSC {$sc->trigger}\" id=\"{$sc->trigger}\">";
			echo "<div class=\"peThemeSC pe-shortcode-{$sc->trigger}\" id=\"{$sc->trigger}\">";
			$sc->render();
			echo "</div>";
		}


		echo $this->post();
		die();
	}
	
}

?>
