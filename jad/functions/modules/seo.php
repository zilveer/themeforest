<?php

class SG_SEO_Module extends SG_Module {

	const moduleName = 'SEO';

	protected static $instance;
	protected static $_vars = NULL;
	protected static $_params = array();
	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'title' => array(
				'name' => __('Title', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'help' => __('If left blank, the title will be set by default', SG_TDN),
			),
			'description' => array(
				'name' => __('Description', SG_TDN),
				'type' => 'text',
				'default' => '',
				'help' => __('Appears in the issuance of search engines after the link. Will be displayed the beginning of the text on the page if left blank', SG_TDN),
			),
			'keywords_type' => array(
				'name' => __('Keywords Type', SG_TDN),
				'type' => 'radio',
				'options' => array(
					'post_tags' => __('Post Tags', SG_TDN),
					'self_keywords' => __('Self Keywords', SG_TDN),
					'all' => __('Tags and Keywords', SG_TDN),
				),
				'default' => 'post_tags',
				'show' => self::SHOW_NONE,
				'help' => __('For portfolio and posts. It takes automatically from the tags if post tags selected. You can also append your keywords additionally', SG_TDN),
			),
			'keywords_sep' => array(
				'name' => __('Keywords Separator', SG_TDN),
				'type' => 'radio2',
				'options' => array(
					', ' => '[, ]',
					',' => '[,]',
					' ' => '[ ]',
				),
				'default' => array(
					'value' => ', ',
					'custom' => NULL,
				),
				'show' => self::SHOW_GLOBAL,
				'help' => __('Separator for generated keywords', SG_TDN),
			),
			'keywords' => array(
				'name' => __('Keywords', SG_TDN),
				'type' => 'text',
				'default' => '',
				'help' => __('Search engines find a site by keywords', SG_TDN),
			),
		);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SG_SEO_Module;
		}
		return self::$instance;
	}

	public function inited()
	{
		return !is_null(self::$_vars);
	}

	public function initVars($uniq, $params, $defaults, $global, $post_id)
	{
		self::$_vars = self::_initVars(self::moduleName, $uniq, self::$_params, self::$_fields, $params, $defaults, $global, $post_id);
		return TRUE;
	}

	public function setVars($uniq, $post_data, $post_id = NULL)
	{
		return self::_setVars(self::moduleName, $uniq, self::$_fields, $post_data, $post_id);
	}

	public function resetVars($uniq, $post_id = NULL)
	{
		return self::_resetVars(self::moduleName, $uniq, $post_id);
	}

	public function getMenuItem()
	{
		return __('SEO', SG_TDN);
	}

	public function getAdminContent($uniq, $params, $defaults, $global = NULL, $post_id = NULL)
	{
		$c = self::_getAdminContent(self::moduleName, $uniq, self::$_params, self::$_fields, self::$_description, $params, $defaults, $global, $post_id);

		$c .= '<script type="text/javascript">';
		$c .= '
//<![CDATA[
jQuery(document).ready(function($){
	function ' . $uniq . '_set_keywords_type(){
		var cd = $("input[name=' . $uniq . 'SEO_keywords_type]:checked");
		if (cd.val() == "post_tags" || cd.attr("rel") == "post_tags") {
			$("textarea[name=' . $uniq . 'SEO_keywords]").parent().parent().hide();
		} else {
			$("textarea[name=' . $uniq . 'SEO_keywords]").parent().parent().show();
		}
	}

	' . $uniq . '_set_keywords_type();

	$("input[name=' . $uniq . 'SEO_keywords_type]").change(' . $uniq . '_set_keywords_type);
});
//]]>
			';
		$c .= '</script>';

		return $c;
	}

	public function setPostTags($pt)
	{
		if (!empty($pt)) {
			self::$_vars['post_tags'] = $pt;
		}
	}

	public function eTitle()
	{
		if (!empty(self::$_vars['title']) AND self::$_vars['title'] != self::USE_NONE) {
			echo '<title>' . __(self::$_vars['title']) . '</title>';
			return TRUE;
		}

		return FALSE;
	}

	public function eMeta()
	{
		if (!empty(self::$_vars['description']) AND self::$_vars['description'] != self::USE_NONE) {
			echo '<meta content="' . __(self::$_vars['description']) . '" name="description">';
		}

		if (!isset(self::$_vars['post_tags']) OR self::$_vars['keywords_type'] == 'self_keywords') {
			if (self::$_vars['keywords'] != self::USE_NONE) $keywords = self::$_vars['keywords'];
		} else {
			$tags = self::$_vars['post_tags'];
			$sep = self::$_vars['keywords_sep']['value'];
			$sep = ($sep == self::USE_CUSTOM) ? self::$_vars['keywords_sep']['custom'] : $sep;

			if (self::$_vars['keywords_type'] == 'all' AND !empty(self::$_vars['keywords'])) {
				$tags[] = self::$_vars['keywords'];
			}

			$keywords = implode($sep, $tags);
		}

		if (!empty($keywords)) {
			echo '<meta content="' . __($keywords) . '" name="keywords">';
		}
	}

}