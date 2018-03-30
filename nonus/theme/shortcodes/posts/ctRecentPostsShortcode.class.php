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

		$headerHtml = $header ? ('<h4>' . $header . '</h4>') : '';
		$html = '';
		if($widgetmode == 'true'){
			foreach ($recentposts as $p) {
				$html .= '<li>
			                    <span class="title"><a href="' . get_permalink($p) . '">' . $p->post_title . '</a></span>
			                    <span class="date">' . get_the_time('M d, Y', $p) . '</span>
			                </li>';
			}

			return do_shortcode('<div class="latest-posts-widget widget">
						            ' . $headerHtml . '
						            <ul class="latest-posts latest-posts-widget">
						            ' . $html .
									'</ul>
					            </div>');
		}else{
			foreach ($recentposts as $p) {
				$html .= '<li class="row-fluid">
			                    <span class="date span2">' . get_the_time('M d, Y', $p) . '</span>
			                    <a href="' . get_permalink($p) . '" class="title post-title span10">' . $p->post_title . '</a>
			                </li>';
			}

			return do_shortcode($headerHtml .
								'<div class="row-fluid">
								<div class="blog-big-list">
						            <ul'.$this->buildContainerAttributes(array('class'=>array('latest-posts','span12')),$atts).'>
						            ' . $html .
									'</ul>
									</div>
					            </div>');
		}
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
			'widgetmode' => array('default' => 'false', 'type' => false),
			'header' => array('label' => __("header text", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'limit' => array('label' => __('limit', 'ct_theme'), 'default' => 2, 'type' => 'input'),
		));
		return $atts;
	}
}

new ctRecentPostsShortcode();