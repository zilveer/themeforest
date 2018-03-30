<?php
/**
 * Faq shortcode
 */
class ctFaqShortcode extends ctShortcodeQueryable {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Faq';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'faq';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		$attributes = shortcode_atts($this->extractShortcodeAttributes($atts), $atts);
		extract($attributes);

		$catNamesArray = $cat_name ? explode(',', $cat_name) : array();
		$catNamesArray = array_combine($catNamesArray, $catNamesArray);

		$data = array();
		$faqs = $this->getCollection($attributes, array('post_type' => 'faq'));
		foreach ($faqs as $faq) {
			if ($cats = get_the_terms($faq->ID, 'faq_category')) {
				foreach ($cats as $cat) {
					if(isset($catNamesArray[$cat->slug])){
						$data[$cat->term_id]['cat'] = $cat->name;
						$data[$cat->term_id]['cat_slug'] = $cat->slug;
						$data[$cat->term_id]['posts'][] = $faq;
					}
				}
			}
		}

		$html = '';
		if($data){
			foreach($data as $catId => $details){
				$html .= '<div class="sectionFaq" id="q' . $catId . '">';
			    if(isset($details['posts']) && isset($details['cat'])){
					$html .= '<h3 class="std">' . $details['cat'] . '</h3>';
					foreach($details['posts'] as $faq){
						$html .= '<h4>' . $faq->post_title . '</h4>
				                    <p>
				                        ' . $faq->post_content . '
				                    </p>';
					}
			    }
				$html .= '</div>';
			}
		}

		return do_shortcode($html);
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		$atts = $this->getAttributesWithQuery(array(
			'limit' => array('label' => __('limit', 'ct_theme'), 'default' => -1, 'type' => 'input', 'help' => __("Number of faq elements", 'ct_theme')),
		));

		if (isset($atts['cat'])) {
			unset($atts['cat']);
		}
		return $atts;
	}
}

new ctFaqShortcode();