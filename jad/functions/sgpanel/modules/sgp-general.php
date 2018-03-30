<?php

class SGP_General_Module extends SGP_Module {

	const moduleName = 'General';

	protected static $instance;
	protected static $_vars = NULL;
	protected static $_params = array();
	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'logo' => array(
				'name' => __('Logo', SG_TDN),
				'type' => 'logo',
				'default' => '',
				'help' => __('Upload a logo image. Default logo gets applied if the input field is left blank. Logo dimension: 1-262px x 1-100px is preferable', SG_TDN),
			),
			'favicon' => array(
				'name' => __('Favicon', SG_TDN),
				'type' => 'favicon',
				'default' => '',
				'help' => __('Upload the favicon image (16x16px is preferable)', SG_TDN),
			),
			'analytics_code' => array(
				'name' => __('Analytics code', SG_TDN),
				'type' => 'text',
				'default' => '',
				'help' => __('Enter your Google analytics tracking Code here. It will automatically be added to the themes footer so google can track your visitors behaviour', SG_TDN),
			),
			'portfolio_slug' => array(
				'name' => __('Portfolio Base', SG_TDN),
				'type' => 'input',
				'default' => 'portfolio',
				'help' => __('Slug for portfolio posts (if left blang it will be like "portfolio"', SG_TDN),
			),
			'portfolio_cslug' => array(
				'name' => __('Portfolio Category Base', SG_TDN),
				'type' => 'input',
				'default' => '',
				'help' => __('Slug for portfolio categories (if left blang it will be like "{Portfolio Base}-category")', SG_TDN),
			),
			'portfolio_tslug' => array(
				'name' => __('Portfolio Tag Base', SG_TDN),
				'type' => 'input',
				'default' => '',
				'help' => __('Slug for portfolio tags (if left blang it will be like "{Portfolio Base}-tag")', SG_TDN),
			),
			'tweet_consumer_key' => array(
				'name' => __('Twitter App Consumer Key', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'help' => __('Insert your Twitter App Consumer Key (If you use Twitter widget)', SG_TDN),
			),
			'tweet_consumer_secret' => array(
				'name' => __('Twitter App Consumer Secret', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'help' => __('Insert your Twitter App Consumer Secret (If you use Twitter widget)', SG_TDN),
			),
			'tweet_user_token' => array(
				'name' => __('Twitter App Access Token', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'help' => __('Insert your Twitter Twitter App Access Token (If you use Twitter widget)', SG_TDN),
			),
			'tweet_user_secret' => array(
				'name' => __('Twitter App Access Token Secret', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'help' => __('Insert your Twitter App Access Token Secret (If you use Twitter widget)', SG_TDN),
			),
		);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SGP_General_Module;
		}
		return self::$instance;
	}

	public function inited()
	{
		return !is_null(self::$_vars);
	}

	public function initVars($params, $defaults)
	{
		self::$_vars = self::_initVars(self::moduleName, self::$_params, self::$_fields, $params, $defaults);
		return TRUE;
	}

	public function setVars($post_data)
	{
		update_option(SG_SLUG . 'sgp-general-changed', TRUE);
		return self::_setVars(self::moduleName, self::$_fields, $post_data);
	}

	public function resetVars()
	{
		return self::_resetVars(self::moduleName);
	}

	protected function _getLogoField($uid, $params, $value, $default, $ug)
	{
		$btn_name = __('Get Logo', SG_TDN);
		$durl = get_template_directory_uri() . '/images/logo.png';

		if (empty($value)) {
			$img = '<img src="' . $durl . '" />';
			$clear = ' style="display: none;"';
		} else {
			$img = '<img src="' . $value . '" />';
			$clear = '';
		}

		$c = '<span class="sg-upload-btns">';
		$c .= '<input type="submit" value="' . __('Load Logo', SG_TDN) . '" class="button" id="' . $uid . '_load" name="' . $uid . '_load">';
		$c .= '&nbsp;<input type="submit" value="' . __('Clear Logo', SG_TDN) . '" class="button sg-photo-clear" id="' . $uid . '_clear" name="' . $uid . '_clear"' . $clear . '><br /><br />';
		$c .= '</span>';
		$c .= '<span id="' . $uid . '_img">' . $img . '</span>';

		$c .= SG_Form::hidden($uid, $value);

		$c .= '<script type="text/javascript">';
		$c .= '
//<![CDATA[
jQuery(document).ready(function($){
	if ($("input[name=' . $uid . ']").val() != "") {
		$("#' . $uid . '_clear").show();
	}
	$("#' . $uid . '_clear").click(function() {
		$("input[name=' . $uid . ']").val("");
		$("#' . $uid . '_img").html("<img src=\"' . $durl . '\" />");
		$("#' . $uid . '_clear").hide();
		return false;
	});
	$("#' . $uid . '_load").click(function() {
		window.sg_media_upload_btn_name = "' . $btn_name . '";
		window.send_to_editor = function(html) {
			var returned = $(html);
			var img = returned.attr("src") || returned.find("img").attr("src") || returned.attr("href");
			var width = returned.attr("width") || returned.find("img").attr("width");
			var height = returned.attr("height") || returned.find("img").attr("height");
			img = img.replace("-" + width + "x" + height + ".", ".");
			$("input[name=' . $uid . ']").val(img);
			$("#' . $uid . '_img").html("<img src=\"" + img + "\" />");
			$("#' . $uid . '_clear").show();
			tb_remove();
		}
		tb_show("Insert", "media-upload.php?post_id=0&custom-media-upload=LFI&type=image&TB_iframe=true");
		return false;
	});
});
//]]>
			';
		$c .= '</script>';

		return $c;
	}

	protected function _getFaviconField($uid, $params, $value, $default, $ug)
	{
		$btn_name = __('Get FavIcon', SG_TDN);

		if (empty($value)) {
			$img = '';
			$clear = ' style="display: none;"';
		} else {
			$img = '<img src="' . $value . '" />';
			$clear = '';
		}

		$c = '<span class="sg-upload-btns">';
		$c .= '<input type="submit" value="' . __('Load FavIcon', SG_TDN) . '" class="button" id="' . $uid . '_load" name="' . $uid . '_load">';
		$c .= '&nbsp;<input type="submit" value="' . __('Clear FavIcon', SG_TDN) . '" class="button sg-photo-clear" id="' . $uid . '_clear" name="' . $uid . '_clear"' . $clear . '><br /><br />';
		$c .= '</span>';
		$c .= '<span id="' . $uid . '_img">' . $img . '</span>';

		$c .= SG_Form::hidden($uid, $value);

		$c .= '<script type="text/javascript">';
		$c .= '
//<![CDATA[
jQuery(document).ready(function($){
	if ($("input[name=' . $uid . ']").val() != "") {
		$("#' . $uid . '_clear").show();
	}
	$("#' . $uid . '_clear").click(function() {
		$("input[name=' . $uid . ']").val("");
		$("#' . $uid . '_img").html("");
		$("#' . $uid . '_clear").hide();
		return false;
	});
	$("#' . $uid . '_load").click(function() {
		window.sg_media_upload_btn_name = "' . $btn_name . '";
		window.send_to_editor = function(html) {
			var returned = $(html);
			var img = returned.attr("src") || returned.find("img").attr("src") || returned.attr("href");
			$("input[name=' . $uid . ']").val(img);
			$("#' . $uid . '_img").html("<img src=\"" + img + "\" />");
			$("#' . $uid . '_clear").show();
			tb_remove();
		}
		tb_show("Insert", "media-upload.php?post_id=0&custom-media-upload=LFI&type=image&TB_iframe=true");
		return false;
	});
});
//]]>
			';
		$c .= '</script>';

		return $c;
	}

	public function getAdminContent($params, $defaults)
	{
		return self::_getAdminContent(self::moduleName, self::$_params, self::$_fields, self::$_description, $params, $defaults);
	}

	public function eFavIcon()
	{
		if (!empty(self::$_vars['favicon'])) {
			$path = str_replace(str_replace(array('www.', 'https://', 'http://'), '', site_url()), ABSPATH, str_replace(array('www.', 'https://', 'http://'), '', self::$_vars['favicon']));
			if (file_exists($path)) {
				$type = SG_File::mime($path);
				echo '<link rel="icon" type="' . $type . '" href="' . self::$_vars['favicon'] . '">';
				echo '<link rel="profile" href="http://gmpg.org/xfn/11" />';
			}
		}
	}

	public function getLogoURL()
	{
		if (empty(self::$_vars['logo'])) {
			return get_template_directory_uri() . '/images/logo.png';
		} else {
			return self::$_vars['logo'];
		}
	}

	public function eLogoURL()
	{
		echo $this->getLogoURL();
	}

	public function eAnalyticsCode()
	{
		echo self::$_vars['analytics_code'];
	}

	public function getPortfolioSlug()
	{
		$slug = (isset(self::$_vars['portfolio_slug'])) ? str_replace(' ', '-', trim(self::$_vars['portfolio_slug'])) : '';
		return (empty($slug)) ? 'portfolio' : $slug;
	}

	public function getPortfolioCSlug()
	{
		$slug = (isset(self::$_vars['portfolio_cslug'])) ? str_replace(' ', '-', trim(self::$_vars['portfolio_cslug'])) : '';
		return (empty($slug)) ? $this->getPortfolioSlug() . '-category' : $slug;
	}

	public function getPortfolioTSlug()
	{
		$slug = (isset(self::$_vars['portfolio_tslug'])) ? str_replace(' ', '-', trim(self::$_vars['portfolio_tslug'])) : '';
		return (empty($slug)) ? $this->getPortfolioSlug() . '-tag' : $slug;
	}

	public function getTweetConsumerKey()
	{
		return self::$_vars['tweet_consumer_key'];
	}

	public function getTweetConsumerSecret()
	{
		return self::$_vars['tweet_consumer_secret'];
	}

	public function getTweetUserToken()
	{
		return self::$_vars['tweet_user_token'];
	}

	public function getTweetUserSecret()
	{
		return self::$_vars['tweet_user_secret'];
	}

}