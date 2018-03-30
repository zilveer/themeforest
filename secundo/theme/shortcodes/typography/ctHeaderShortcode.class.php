<?php
/**
 * Header shortcode
 */
class ctHeaderShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Header';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'header';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$sizeCls = $size == 'default' ? "" : $size;
		$colorCls = $color == 'default' ? "" : $color;
		$nomgrCls = $nomrg == "yes" ? "nomrg" : "";
		$italicCls = $italic == "yes" ? "vitalic" : "";

		if ($strong == "yes" && $content) {
			$headerParts = explode(' ', $content);
			$lastPart = array_pop($headerParts);
			$content = implode(" ", $headerParts) . ' <strong>' . $lastPart . '</strong>';
		}


		$lineCls = "";
		if ($line != "no") {
			$lineCls = $line;
			$content = "<span>" . $content . "</span>";
		}

		$cls = $sizeCls ? ($sizeCls . " ") : '';
		$cls .= $colorCls ? ($colorCls . " ") : '';
		$cls .= $lineCls ? ($lineCls . " ") : '';
		$cls .= $nomgrCls ? ($nomgrCls . " ") : '';
		$cls .= $italicCls ? ($italicCls . " ") : '';
		$cls .= $class;

		return do_shortcode('<h' . $type . ' class="' . $cls . '">' . $content . '</h' . $type . '>');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
			'type' => array('label' => __('type', 'ct_theme'), 'default' => '1', 'type' => 'select', 'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')),
			'size' => array('label' => __('size', 'ct_theme'), 'default' => 'default', 'type' => 'select', 'options' => array('vsmall' => __('small', 'ct_theme'), 'vmedium' => __('medium', 'ct_theme'), 'default' => __('default', 'ct_theme'), 'great' => __('great', 'ct_theme'), 'big' => __('big', 'ct_theme'))),
			'color' => array('label' => __('color', 'ct_theme'), 'default' => 'default', 'type' => 'select', 'options' => array('default' => __('default', 'ct_theme'), 'vgray' => __('gray', 'ct_theme'), 'vorange' => __('orange', 'ct_theme'), 'vbright' => __('white', 'ct_theme'), 'vdark' => __('dark', 'ct_theme'))),
			'line' => array('label' => __('line', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'options' => array('no' => __('no', 'ct_theme'), 'crossLine' => __('cross line', 'ct_theme'), 'twoLines' => __('two lines', 'ct_theme'), 'oneLine' => __('one line', 'ct_theme'))),
			'nomrg' => array('label' => __('no margin', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Reset margin properties?", 'ct_theme')),
			'italic' => array('label' => __('italic', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme'))),
			'strong' => array('label' => __('strong', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __('Highlight last word?', 'ct_theme')),
			'class' => array('label' => __("class", 'ct_theme'), 'default' => '', 'help' => __("Header class", 'ct_theme')),
		);
	}
}

new ctHeaderShortcode();