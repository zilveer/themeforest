<?php
/**
 * Recent posts
 */
class ctRecentPostsShortcode extends ctShortcodeQueryable {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Recent posts';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'recent_posts';
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

		$recentposts = $this->getCollection($attributes);

		$html = '<div class="row-fluid">';
		$counter = 0;
		foreach ($recentposts as $p) {
			$counter++;
			$imgsrc = ct_get_feature_image_src($p->ID, 'thumbnail');
			$categories = ct_get_categories_string($p->ID, ',', 'category');

			$author = '';
			$authorlink = '';
			if($authors == 'yes'){
				$user = get_userdata($p->post_author);
				$author = $user->user_nicename;
				$authorlink = get_author_posts_url($user->ID);
			}

			$html .= ('[half_column]' . $this->embedShortcode('post_box', array(
				'title' => $p->post_title,
				'summary' => $p->post_excerpt,
				'link' => get_permalink($p),
				'imgsrc' => $imgsrc,
				'categories' => $categories,
				'author' => $author,
				'authorlink' => $authorlink,
			)) . '[/half_column]');
			if ($counter == 2) {
				$html .= '</div><div class="row-fluid">';
			}
		}
		$html .= '</div>';

		return do_shortcode($html);

	}

	/**
	 * Shortcode type
	 * @return string
	 */
	public function getShortcodeType() {
		return self::TYPE_SHORTCODE_SELF_CLOSING;
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		$atts = $this->getAttributesWithQuery(array(
			'limit' => array('label' => __('limit', 'ct_theme'), 'default' => 4, 'type' => 'input'),
			'authors' => array('label' => __('authors', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show author for each post?", 'ct_theme')),
		));
		return $atts;
	}
}

new ctRecentPostsShortcode();