<?php
/**
 * Social buttons shortcode
 */
class ctSocialButtonsShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Social buttons';
	}

	/**
	 * Registers scripts
	 */

	public function enqueueScripts() {
		wp_register_script('twitter', 'http://platform.twitter.com/widgets.js');
		wp_register_script('google-plus', 'https://apis.google.com/js/plusone.js', array(), false, true); //in footer - IE bug

		wp_enqueue_script('twitter');
		wp_enqueue_script('google-plus');
	}


	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'social_buttons';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		return '<div class="patBright nomrg">
		    <div class="row-fluid">
		        <div class="span12">

		        <hr class="mini">

		        <div class="row-fluid">
                    <div class="span12 doCenter">
			            <div class="socContainer">
			                <a href="http://twitter.com/share?url=' . $url . '" class="btn vorange vlarge vtweet"><i></i>TWEET</a>
			                <span class="bubble left">' . $this->getTweetsCount($url) . '</span>
			            </div>

			            <div class="socContainer socMid">
			                <a href="http://www.facebook.com/plugins/like.php?href=' . $url . '&amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=like&amp;colorscheme=light" class="btn vorange vlarge vlike"><i></i>LIKE</a>
			                <span class="bubble left">' . $this->getLikesCount($url) . '</span>
			            </div>

			            <div class="socContainer">
			                <a href="#" class="btn vorange vlarge">+1
				                 <div class="g-plusone-wrapper">
				                    <div class="g-plusone" data-annotation="none" data-href="' . $url . '" data-size="standard">&nbsp;</div>
				                </div>
			                </a>
			                <span class="bubble left">' . $this->getGooglePlusesCount($url) . '</span>
			            </div>
		            </div>
		        </div>
		         <!-- / row-fluid -->

		         <hr class="mini">
		        </div>

		    </div>
		</div>';
	}

	/**
	 * tweets count
	 * @param $url
	 * @return int
	 */
	protected function getTweetsCount($url) {
		$twitterEndpoint = "http://urls.api.twitter.com/1/urls/count.json?url=%s";
		$feed = wp_remote_get(sprintf($twitterEndpoint, $url));
		$fileData = wp_remote_retrieve_body($feed);
		$json = json_decode($fileData, true);
		unset($fileData); // free memory
		return isset($json['count']) ? $json['count'] : 0;
	}

	/**
	 * likes count
	 * @param $url
	 * @return int
	 */
	protected function getLikesCount($url) {
		$feed = wp_remote_get("http://api.facebook.com/restserver.php?method=links.getStats&urls=" . $url);
		$xml = wp_remote_retrieve_body($feed);
		$xml = simplexml_load_string($xml);
		return isset($xml->link_stat->like_count) && $xml->link_stat->like_count ? $xml->link_stat->like_count : 0;
	}

	/**
	 * g+ count
	 * @param $url
	 * @return int
	 */
	protected function getGooglePlusesCount($url) {
		$feed = wp_remote_post("https://clients6.google.com/rpc", array('headers' => array('content-type' => 'application/json'), 'body' => '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]'));
		$curl_results = wp_remote_retrieve_body($feed);
		$json = json_decode($curl_results, true);
		return isset($json[0]['result']['metadata']['globalCounts']['count']) ? intval($json[0]['result']['metadata']['globalCounts']['count']) : 0;
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'url' => array('label' => __("url",'ct_theme'), 'default' => '', 'type' => 'input'),
		);
	}
}

new ctSocialButtonsShortcode();