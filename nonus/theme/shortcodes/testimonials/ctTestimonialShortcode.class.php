<?php
/**
 * Testimonial shortcode
 */
class ctTestimonialShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Testimonial';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'testimonial';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$authorHtml = $author ? '<span class="name">' . $author . '</span>' : '';
		$positionHtml = $position ? '<span class="position">' . $position . '</span>' : '';
		return '<blockquote'.$this->buildContainerAttributes(array('class'=>array('testimonial')),$atts).'>
						' . $content . '
		                <span class="author">
		                    ' . $authorHtml . '
		                    ' . $positionHtml . '
		                </span>
                    </blockquote>';
	}

	/**
	 * Parent shortcode name
	 * @return null
	 */

	public function getParentShortcodeName() {
		return 'testimonials';
	}


	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'author' => array('label' => __('author', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Author", 'ct_theme')),
			'position' => array('label' => __('position', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Position", 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea")
		);
	}
}

new ctTestimonialShortcode();