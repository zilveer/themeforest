<?php
/**
 * Accordion shortcode
 */
class ctAccordionShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Accordion';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'accordion';
	}


	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$id = rand(100, 1000);
		$headerHtml = $header ? ' <h4>' . $header . '</h4>' : '';
		$this->addInlineJS($this->getInlineJS($id));
		$cParams = array(
			'id'=>"accordion".$id,
			'class'=>array('accordion')
		);
		return do_shortcode($headerHtml . '<div'.$this->buildContainerAttributes($cParams,$atts).'>' . $content . '</div>');
	}

	/**
	 * returns inline JS
	 * @param $id
	 * @return string
	 */
	protected function getInlineJS($id){
		return 'jQuery(document).ready(function () {
				        jQuery(".accordion").on("show",function (e) {
				            jQuery(e.target).prev(".accordion-heading").find(".accordion-toggle").addClass("active");
				        }).on("hide",function (e) {
				                    jQuery(this).find(".accordion-toggle").not(jQuery(e.target)).removeClass("active");
				                }).each(function () {
				                    var $a = jQuery(this);
				                    $a.find("a.accordion-toggle").attr("data-parent", "#" + $a.attr("id"));
				        });
					});';

	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'header' => array('label' => __('header', 'ct_theme'),'default' => '', 'type' => 'input'),
		);
	}

	/**
	 * Child shortcode info
	 * @return array
	 */

	public function getChildShortcodeInfo() {
		return array('name' => 'accordion_item', 'min' => 1, 'max' => 20, 'default_qty' => 2);
	}
}

new ctAccordionShortcode();