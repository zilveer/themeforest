<?php
/**
 * Facebook feed shortcode
 */
abstract class ctFacebookFeedShortcodeBase extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'fb';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'fb';
	}

	/**
	 * returns the follow link
	 * @param $pageid
	 * @return string
	 */
	protected function getFollowLink($pageid) {
		return "http://www.facebook.com/" . $pageid;
	}

	/**
	 * gets twitter news
	 * @param $user
	 * @param $limit
	 * @return stdClass[]
	 */
	protected function getPosts($attributes) {
		extract($attributes);

		$feed = wp_remote_get('https://graph.facebook.com/' . $pageid . '/feed?access_token=' . $token);
		$xml = wp_remote_retrieve_body($feed);
		$json = json_decode($xml, true);
		$data = array();
		if (isset($json['data'])) {
			foreach ($json['data'] as $p) {
				if (!in_array($p['type'], array('status', 'photo', 'video')) || $limit <= 0) {
					continue;
				}
				//split user and post ID (userID_postID)
				$idArray = explode("_", $p['id']);

				$post = array();
				$post['author'] = $p['from'];
				$post['content'] = isset($p['message']) ? $p['message'] : '';

				if ($p['type'] == 'photo') {
					$post['image'] = $p['picture'];
				} elseif ($p['type'] == 'video') {
					$post['image'] = $p['picture'];
					$post['content'] .= "\n\n {$p['link']}";
				} else {
					$post['image'] = null;
				}

				$post['timestamp'] = strtotime($p['created_time']);
				$post['like_count'] = (isset($p['likes'])) ? $p['likes']['count'] : 0;
				$post['comment_count'] = (isset($p['comments'])) ? $p['comments']['count'] : 0;
				$post['link'] = "http://www.facebook.com/" . $pageid . "/posts/" . $idArray[1];

				if ($post['content'] || $post['image']) {
					$data[] = $post;
					$limit--;
				}
			}
		}

		return $data;
	}

	/**
	 * counts time ago
	 * @param $time
	 * @return string
	 */
	protected function ago($time) {
		$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		$lengths = array("60", "60", "24", "7", "4.35", "12", "10");

		$now = time();

		$difference = $now - $time;

		for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
			$difference /= $lengths[$j];
		}

		$difference = round($difference);

		if ($difference != 1) {
			$periods[$j] .= "s";
		}

		return $difference . " " . $periods[$j] . ' ' . esc_html__('ago', 'ct_theme');
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'pageid' => array('label' => esc_html__('Username', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => esc_html__("Page/user id", 'ct_theme')),
			'token' => array('label' => esc_html__('Numeric ID', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => esc_html__('Here you can generate your numeric id: ', 'ct_theme').'http://findmyfacebookid.com/'),
			'cover' => array('label' => esc_html__('Show cover?', 'ct_theme'), 'default' => 'false', 'type' => 'checkbox', 'help' => esc_html__('Show or hide the backround image', 'ct_theme')),
		);
	}
}