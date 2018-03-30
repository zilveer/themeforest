<?php
require_once CT_THEME_LIB_DIR . '/shortcodes/socials/ctTwitterShortcodeBase.class.php';
/**
 * Twitter shortcode
 */
class ctTwitterShortcode extends ctTwitterShortcodeBase {

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		$attributes = shortcode_atts($this->extractShortcodeAttributes($atts), $atts);
		extract($attributes);

		$newwindow = $newwindow == 'false' || $newwindow == 'no' ? false : true;
		$html = '';
		$followLink = $this->getFollowLink($user);
		$tweets = $this->getTweets($attributes);

		$counter = 1;
		$class = 'span4 tweet';
		foreach ($tweets as $tweet) {
			$html .= $counter == 1 ? '<ul class="tweet_list row-fluid">' : '';
			$class .= $counter == 1 ? ' tweet_first' : '';
			$class .= $counter == 2 ? ' tweet_even' : ' tweet_odd';
			$html .= '<li class="' . $class . '">
						<span class="tweet_text">
							' . $tweet->content . '
						</span>
						<span class="tweet_time">
							' . $this->ago($tweet->updated) . '
						</span>
	                </li>';

			$html .= $counter == 3 ? '</ul>' : '';
			$counter++;
			$counter = ($counter < 4) ? $counter : 1;
		}
		if($counter != 1){
			$html .= '</ul>';
		}

		$linkPre = '';
		$linkPost = '';
		if ($button) {
			$linkPre = '<a' . ($newwindow ? ' target="_blank"' : '') . ' href="' . $followLink . '">';
			$linkPost = '</a>';
		}

		return do_shortcode('<div'.$this->buildContainerAttributes(array('class'=>array('container','tweets')),$atts).'>
                                    ' . $linkPre . '
						            <h3>
						                <i class="fa fa-twitter"><span class="hidden-text">Twitter</span></i>
						            </h3>
						             ' . $linkPost . '
									 ' . $html . '
						        </div>');
	}


	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		$args = array_merge(
			array(
				'widgetmode' => array('default' => 'false', 'type' => false),
			), parent::getAttributes());
		return $args;
	}
}

new ctTwitterShortcode();