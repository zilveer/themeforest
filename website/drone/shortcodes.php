<?php










namespace Drone\Shortcodes;
use Drone\Func;
use Drone\HTML;
use Drone\Options;
use Drone\Theme;









const INC_FILENAME = 'shortcodes.php';














abstract class Shortcode
{

	

	





	const VISIBILITY_NONE = 0;

	





	const VISIBILITY_TINYMCE = 1;

	





	const VISIBILITY_VC = 2;

	





	const VISIBILITY_ALL = 3;

	

	





	private static $instances = array();

	





	private static $call_stack = array();

	

	





	private $options;

	





	private $tag;

	





	private $label;

	





	private $self_closing = false;

	





	private $parent;

	





	private $visibility = self::VISIBILITY_ALL;

	

	






	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options) { }

	

	






	public function onOptionsCompatybility(array &$data) { }

	

	








	abstract protected function onShortcode($content, $code, \Drone\HTML &$html);

	

	




	protected function register()
	{
		add_shortcode($this->tag, array($this, 'shortcode'));
	}

	

	




	protected function unregister()
	{
		remove_shortcode($this->tag);
	}

	

	






	protected function newOptionsGroupInstance()
	{
		return new Options\Group\Shortcode('');
	}

	

	







	protected function getOptions(array $data = null) 
	{

		
		$options = $this->newOptionsGroupInstance();
		$this->onSetupOptions($options);
		\Drone\do_action('shortcode_'.$this->tag.'_on_setup_options', $options, $this);

		
		if ($data !== null) {
			$options->fromArray($data, array($this, 'onOptionsCompatybility'));
			if (has_filter('shortcode_atts_'.$this->tag)) {
				$options->fromArray(apply_filters('shortcode_atts_'.$this->tag, $options->toArray(), $options->getDefaults(), $data));
			}
		}

		return $options;

	}

	

	








	public function __construct($label, $params = array())
	{

		
		$this->label = $label;

		foreach (array_intersect_key($params, array_flip(array('tag', 'self_closing', 'parent', 'visibility'))) as $name => $value) { 
			$this->{$name} = $value;
		}

		
		if ($this->tag === null) {
			$class = explode('\\', get_class($this));
			$this->tag = Func::stringID(array_pop($class), '_');
		}

		
		if ($this->parent !== null && !($this->parent instanceof self)) {
			$this->parent = self::getInstance($params['parent']);
		}

		self::$instances[$this->tag] = $this;

		$this->register();

	}

	

	




	public function __destruct()
	{
		if (isset(self::$instances[$this->tag])) {
			$this->unregister();
			unset(self::$instances[$this->tag]);
		}
	}

	

	







	public function __get($name)
	{
		switch ($name) {
			case 'tag':
			case 'label':
			case 'self_closing':
			case 'parent':
			case 'visibility':
				return $this->{$name};
			case 'options':
				return $this->getOptions();
		}
	}

	

	








	public function so_($name, $skip_if = null)
	{
		return $this->options->findChild($name, $skip_if);
	}

	

	









	public function so($name, $skip_if = null, $fallback = null)
	{
		$child = $this->so_($name, $skip_if);
		return $child !== null && $child->isOption() ? $child->value : $fallback;
	}

	

	









	public function shortcode($atts, $content = null, $code = '')
	{

		
		$atts = $atts ? (array)$atts : array();
		$this->options = $this->getOptions($atts);

		
		self::$call_stack[] = $this->tag;

		
		$html = HTML::make();
		$this->onShortcode($content, $code, $html);

		
		$html = \Drone\apply_filters('shortcode_'.$this->tag.'_shortcode', $html, $this, $atts, $content, $code);

		
		array_pop(self::$call_stack);

		
		return $html->toHTML();

	}

	

	






	public function tinyMCEData()
	{
		$options = $this->getOptions();
		return array(
			'tag'          => $this->tag,
			'self_closing' => $this->self_closing,
			'label'        => $this->label,
			'controls'     => $options->tinyMCEControls()
		);
	}

	

	






	public function vcData()
	{
		$options = $this->getOptions();
		$data = array(
			'base'     => $this->tag,
			'name'     => $this->label,
			'category' => Theme::getInstance()->theme->name,
			'icon'     => 'mce-i-drone-'.str_replace('_', '-', $this->tag),
			'params'   => $options->vcControls()
		);
		if (!$this->self_closing) {
			$data['params'][] = array(
				'type'       => 'textarea_html',
				'holder'     => 'div',
				'param_name' => 'content',
				'value'      => '',
				'heading'    => __('Content', 'website')
			);
		}
		return $data;
	}

	

	







	public static function getInstance($tag)
	{
		if (isset(self::$instances[$tag])) {
			return self::$instances[$tag];
		}
	}

	

	






	public static function getInstances()
	{
		return self::$instances;
	}

	

	







	public static function inShortcode($tag)
	{
		return array_search($tag, self::$call_stack) !== false;
	}

	

	




	public static function __actionBeforeWPTinyMCE()
	{
		$scripts = '';
		foreach (self::getInstances() as $shortcode) {
			if ($shortcode->visibility & self::VISIBILITY_TINYMCE) {
				$scripts .= $shortcode->getOptions()->scripts();
			}
		}
		if ($scripts) {
			echo "<script>{$scripts}</script>\n";
		}
	}

	

	




	public static function __actionVCBeforeInit()
	{
		foreach (self::getInstances() as $shortcode) {
			if ($shortcode->visibility & self::VISIBILITY_VC) {
				vc_map($shortcode->vcData());
			}
		}
	}

	

	







	public static function __filterTinyMCEBeforeInit($init_array)
	{
		$data = array();
		foreach (self::getInstances() as $shortcode) {
			if ($shortcode->visibility & self::VISIBILITY_TINYMCE) {
				$data[] = $shortcode->tinyMCEData();
			}
		}
		$init_array['drone_shortcodes_data'] = json_encode($data);
		return $init_array;
	}

}



namespace Drone\Shortcodes\Shortcode;
use Drone\Shortcodes\Shortcode;
use Drone\Func;
use Drone\HTML;
use Drone\Options;
use Drone\Theme;








abstract class Caption extends Shortcode
{

	

	





	protected function register()
	{
		add_filter('img_caption_shortcode', array($this, '__filterImgCaptionShortcode'), Theme::WP_FILTER_PRIORITY_DEFAULT, 3);
	}

	

	





	protected function unregister()
	{
		remove_filter('img_caption_shortcode', array($this, '__filterImgCaptionShortcode'), Theme::WP_FILTER_PRIORITY_DEFAULT);
	}

	

	






	protected function getID()
	{
		return preg_match('/^attachment_([0-9]+)$/i', $this->so('id'), $m) ? (int)$m[1] : false;
	}

	

	





	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('text', 'id', '');
		$options->addOption('select', 'align', 'alignnone', '', '', array('options' => array(
			'alignleft'   => __('Left', 'default'),
			'aligncenter' => __('Center', 'default'),
			'alignright'  => __('Right', 'default'),
			'alignnone'   => __('None', 'default')
		)));
		$options->addOption('number', 'width', '', '', '', array('required' => false));
		$options->addOption('text', 'caption', '');
	}

	

	





	public function __construct()
	{
		parent::__construct('', array(
			'tag'        => 'caption',
			'visibility' => self::VISIBILITY_NONE
		));
	}

	

	









	public function __filterImgCaptionShortcode($output, $atts, $content)
	{
		return $this->shortcode($atts, $content, $this->tag);
	}

}








abstract class Gallery extends Shortcode
{

	

	





	protected function register()
	{
		add_filter('post_gallery', array($this, '__filterPostGallery'), Theme::WP_FILTER_PRIORITY_DEFAULT, 2);
	}

	

	





	protected function unregister()
	{
		remove_filter('post_gallery', array($this, '__filterPostGallery'), Theme::WP_FILTER_PRIORITY_DEFAULT);
	}

	

	





	protected function newOptionsGroupInstance()
	{
		return new Options\Group\Gallery('');
	}

	

	






	protected function getAttachments()
	{
		$params = array(
			'numberposts'    => -1,
			'post_parent'    => $this->so('id'),
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'orderby'        => $this->so('orderby'),
			'order'          => $this->so('order')
		);
		if ($this->so('include')) {
			unset($params['post_parent']);
			$params['include'] = preg_replace('/[^0-9,]+/', '', $this->so('include'));
		} else if ($this->so('exclude')) {
			$params['exclude'] = preg_replace('/[^0-9,]+/', '', $this->so('exclude'));
		}
		return get_posts($params);
	}

	

	







	protected function getAttachmentLinkURI(\WP_Post $attachment)
	{
		switch ($this->so('link')) {
			case 'post':
				return get_attachment_link($attachment->ID);
			case 'file':
				if (($image_src = wp_get_attachment_image_src($attachment->ID, 'full')) !== false) {
					return $image_src[0];
				}
			default:
				return '';
		}
	}

	

	





	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('select', 'order', 'ASC', '', '', array('options' => array(
			'ASC'  => '',
			'DESC' => '',
		)));
		$options->addOption('text', 'orderby', 'menu_order ID');
		$options->addOption('number', 'id', ($post = get_post()) ? $post->ID : 0);
		$options->addOption('number', 'columns', 3, '', '', array('min' => 1, 'max' => 9));
		$options->addOption('select', 'size', 'thumbnail', __('Size', 'website'), '', array('options' => \apply_filters('image_size_names_choose', array(
			'thumbnail' => '',
			'medium'    => '',
			'large'     => '',
			'full'      => ''
		))));
		$options->addOption('text', 'ids', '');
		$options->addOption('text', 'include', '');
		$options->addOption('text', 'exclude', '');
		$options->addOption('select', 'link', 'post', '', '', array('options' => array(
			'post' => '',
			'file' => '',
			'none' => ''
		)));
		foreach ($options->childs() as $child) {
			$child->included = false;
		}
	}

	

	





	public function __construct()
	{
		parent::__construct('', array(
			'tag'          => 'gallery',
			'self_closing' => true,
			'visibility'   => self::VISIBILITY_NONE
		));
	}

	

	








	public function __filterPostGallery($output, $atts)
	{
		if (Theme::isPluginActive('jetpack') && ((isset($atts['type']) && $atts['type'] && $atts['type'] != 'default') || get_option('tiled_galleries'))) {
			return '';
		}
		return $this->shortcode($atts, null, $this->tag);
	}

}








class Search extends Shortcode
{

	

	





	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$html->add(get_search_form(false));
	}

	

	





	public function __construct()
	{
		parent::__construct(__('Search form', 'website'), array(
			'self_closing' => true
		));
	}

}








class Page extends Shortcode
{

	

	





	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('post', 'id', 0, __('Page', 'website'), '', array('required' => false, 'options' => function() {
			return Func::wpPagesList(array(), 'ID', 'post_title', function_exists('mb_convert_encoding') ? mb_convert_encoding('&mdash; ', 'UTF-8', 'HTML-ENTITIES') : '');
		}));
	}

	

	





	public function onOptionsCompatybility(array &$data)
	{
		if (isset($data['slug'])) {
			if (($page = get_page_by_path($data['slug'])) !== null) {
				$data['id'] = $page->ID;
			}
		}
	}

	

	





	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$html->add($this->so_('id')->getContent());
	}

	

	





	public function __construct()
	{
		parent::__construct(__('Page', 'website'), array(
			'self_closing' => true
		));
	}

}








class Contact extends Shortcode
{

	

	





	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$html->add(Theme::getContactForm('shortcode'));
	}

	

	





	public function __construct()
	{
		parent::__construct(__('Contact form', 'website'), array(
			'self_closing' => true
		));
	}

}








class Sidebar extends Shortcode
{

	

	





	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('select', 'id', 0, __('Sidebar', 'website'), '', array('required' => false, 'options' => function() {
			return array_map(function($s) { return $s['name']; }, $GLOBALS['wp_registered_sidebars']);
		}));
	}

	

	





	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		if ($this->so('id')) {
			$html->add(Func::functionGetOutputBuffer('dynamic_sidebar', $this->so('id')));
		}
	}

	

	





	public function __construct()
	{
		parent::__construct(__('Sidebar', 'website'), array(
			'self_closing' => true
		));
	}

}








class NoFormat extends Shortcode
{

	

	





	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('text', 'tag', 'pre', __('HTML tag', 'website'), '', array('required' => true));
		$options->addOption('text', 'class', '', __('CSS class', 'website'));
	}

	

	





	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{

		
		$content = trim(Func::wpShortcodeContent($content, false));
		if ($this->so('tag') == 'pre') {
			$content = preg_replace('#(^<p>|<br ?/?>|</p>$)#i', '', $content);
			$content = preg_replace('#(</p>\r?\n<p>|</p>\r?\n|\r?\n<p>)#i', "\n\n", $content);
		}
		$content = htmlspecialchars($content, defined('ENT_HTML5') ? ENT_COMPAT | ENT_HTML5 : ENT_COMPAT, get_bloginfo('charset'), false);

		
		$html = HTML::make($this->so('tag'))->add($content);
		if ($this->so('class')) {
			$html->class = $this->so('class');
		}

	}

	

	





	public function __construct()
	{
		parent::__construct(__('No format', 'website'), array(
			'visibility' => self::VISIBILITY_NONE
		));
	}

}