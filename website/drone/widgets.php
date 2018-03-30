<?php










namespace Drone\Widgets;
use Drone\Func;
use Drone\HTML;
use Drone\Options;
use Drone\Theme;









const INC_FILENAME = 'widgets.php';










class Widget extends \WP_Widget
{

	

	





	const LABEL_SEPARATOR = '|';

	

	




	private $_options;

	




	private $_id;

	

	






	protected function onSetupOptions(\Drone\Options\Group\Widget $options) { }

	

	







	public function onOptionsCompatybility(array &$data, $version) { }

	

	







	protected function onWidget(array $args, \Drone\HTML &$html) { }

	

	







	protected function getOptions($data = null)
	{

		
		$options = new Options\Group\Widget(str_replace('[#]', '', $this->get_field_name('#')));
		$this->onSetupOptions($options);
		\Drone\do_action('widget_'.str_replace('-', '_', $this->_id).'_on_setup_options', $options, $this);

		
		if (is_int($data)) {
			$settings = $this->get_settings();
			if (isset($settings[$data])) {
				$data = $settings[$data];
			}
		}
		if (is_array($data)) {
			$options->fromArray($data, array($this, 'onOptionsCompatybility'));
		}

		return $options;

	}

	

	




















	public function __construct($label, $description = '', $class = '', $width = null)
	{

		
		$this->_id = Func::stringID(
			str_replace(
				array(__CLASS__, Theme::getInstance()->class.'\Widgets\Widget', Theme::getInstance()->class.'Widget', Theme::getInstance()->class),
				'', get_class($this)
			)
		);

		
		parent::__construct(
			\Drone\apply_filters('widget_id_base', Theme::getInstance()->theme->id.'-'.$this->_id, $this->_id),
			Theme::getInstance()->theme->name.' '.self::LABEL_SEPARATOR.' '.$label,
			array('description' => $description, 'classname' => $class ? $class : 'widget-'.$this->_id),
			array('width' => $width)
		);

	}

	

	







	public function __get($name)
	{
		switch ($name) {
			case '_id':
				return $this->{$name};
		}
	}

	

	








	public function wo_($name, $skip_if = null)
	{
		return $this->_options->findChild($name, $skip_if);
	}

	

	









	public function wo($name, $skip_if = null, $fallback = null)
	{
		$child = $this->wo_($name, $skip_if);
		return $child !== null && $child->isOption() ? $child->value : $fallback;
	}

	

	





	public function form($instance)
	{
		echo HTML::div()
			->class('drone-widget-options')
			->add($this->getOptions($instance)->html());
	}

	

	





	public function update($new_instance, $old_instance)
	{
		$options = $this->getOptions($old_instance);
		$options->change($new_instance);
		return $options->toArray();
	}

	

	




	public function widget($args, $instance)
	{

		
		$this->_options = $this->getOptions($instance);

		
		$html = HTML::make();
		$this->onWidget((array)$args, $html);

		if (!$html->tag && $html->count() == 0) {
			return;
		}

		
		$html = \Drone\apply_filters('widget_'.str_replace('-', '_', $this->_id).'_widget', $html, $this, $args);

		
		$output = HTML::make()->add($args['before_widget']);
		if ($title = $this->wo('title')) {
			$output->add(
				$args['before_title'],
				\apply_filters('widget_title', $title, $instance, $this->id_base),
				$args['after_title']
			);
		}
		$output->add($html, $args['after_widget']);

		
		$output = \Drone\apply_filters('widget_'.str_replace('-', '_', $this->_id).'_output', $output, $this, $args);

		
		echo $output;

	}

}



namespace Drone\Widgets\Widget;
use Drone\Widgets\Widget;
use Drone\Func;
use Drone\HTML;
use Drone\Theme;








class UnwrappedText extends Widget
{

	

	





	protected function onSetupOptions(\Drone\Options\Group\Widget $options)
	{
		$options->addOption('text', 'title', '', __('Title', 'website'));
		$options->addOption('code', 'text', '', __('Text', 'website'), '', array('on_html' => function($option, &$html) {
			$html->css('height', '25em');
		}));
		$options->addOption('boolean', 'paragraphs', false, '', '', array('caption' => __('Automatically add paragraphs', 'website')));
		$options->addOption('boolean', 'shortcodes', false, '', '', array('caption' => __('Allow shortcodes', 'website')));
	}

	

	





	protected function onWidget(array $args, \Drone\HTML &$html)
	{
		$text = $this->wo_('text')->translate();
		if ($this->wo('paragraphs')) {
			$text = wpautop($text);
		}
		if ($this->wo('shortcodes')) {
			if ($this->wo('paragraphs')) {
				$text = shortcode_unautop($text);
			}
			$text = do_shortcode($text);
		}
		$html->add($text);
	}

	

	





	public function __construct()
	{
		parent::__construct(__('Unwrapped text', 'website'), __('For pure HTML code.', 'website'), '', 600);
	}

}








class Page extends Widget
{

	

	





	protected function onSetupOptions(\Drone\Options\Group\Widget $options)
	{
		$options->addOption('text', 'title', '', __('Title', 'website'));
		$options->addOption('post', 'id', 0, __('Page', 'website'), '', array('required' => false, 'options' => function() {
			return Func::wpPagesList();
		}));
	}

	

	





	public function onOptionsCompatybility(array &$data, $version)
	{
		if (version_compare($version, '5.2.6') < 0) {
			if (isset($data['page'])) {
				$data['id'] = $data['page'];
			}
		}
	}

	

	





	protected function onWidget(array $args, \Drone\HTML &$html)
	{
		if (function_exists('is_bbpress') && is_bbpress()) { 
			bbp_restore_all_filters('the_content');
		}
		$html->add($this->wo_('id')->getContent());
	}

	

	





	public function __construct()
	{
		parent::__construct(__('Page', 'website'), __('Displays content of a specified page.', 'website'));
	}

}








class Contact extends Widget
{

	

	





	protected function onSetupOptions(\Drone\Options\Group\Widget $options)
	{
		$options->addOption('text', 'title', '', __('Title', 'website'));
		$options->addOption('memo', 'description', '', __('Description', 'website'));
	}

	

	





	protected function onWidget(array $args, \Drone\HTML &$html)
	{
		if ($this->wo('description')) {
			$html->add(wpautop($this->wo_('description')->translate()));
		}
		$html->add(Theme::getContactForm('widget-'.$args['id']));
	}

	

	





	public function __construct()
	{
		parent::__construct(__('Contact form', 'website'), __('Displays contact form, which can be configured in Theme Options.', 'website'));
	}

}








class PostsList extends Widget
{

	

	





	protected function onSetupOptions(\Drone\Options\Group\Widget $options)
	{
		$_this = $this; 
		$options->addOption('text', 'title', '', __('Title', 'website'));
		$options->addOption('select', 'category', 0, __('Category', 'website'), '', array('options' => function() use ($_this) {
			return array(
				0         => '('.__('All', 'website').')',
				'current' => '('.__('Current', 'website').')'
			) + Func::wpTermsList('category', array('hide_empty' => false));
		}));
		$options->addOption('select', 'format', 0, __('Format', 'website'), '', array('options' => function() use ($_this) {
			return array(
				''         => '('.__('All', 'website').')',
				'current'  => '('.__('Current', 'website').')',
				'standard' => __('Standard', 'website')
			) + Func::arrayKeysMap(function($s) {
				return str_replace('post-format-', '', $s);
			}, Func::wpTermsList('post_format', array('hide_empty' => false), 'slug'));
		}));
		$options->addOption('select', 'orderby', 'date', __('Sort by', 'website'), '', array('options' => array(
			'title'         => __('Title', 'website'),
			'date'          => __('Date', 'website'),
			'modified'      => __('Modified date', 'website'),
			'comment_count' => __('Comment count', 'website'),
			'rand'          => __('Random order', 'website')
		)));
		$options->addOption('select', 'order', 'desc', __('Sort order', 'website'), '', array('options' => array(
			'asc'  => __('Ascending', 'website'),
			'desc' => __('Descending', 'website')
		)));
		$options->addOption('number', 'count', 5, __('Posts count', 'website'), '', array('min' => 1, 'max' => 50));
		$options->addOption('number', 'limit', 10, __('Post title words limit', 'website'), '', array('min' => 1));
		$options->addOption('boolean', 'author', false, '', '', array('caption' => __('Show post author', 'website')));
		$options->addOption('boolean', 'comments', false, '', '', array('caption' => __('Show comments count', 'website')));
		$options->addOption('boolean', 'exclude_previous', false, '', '', array('caption' => __('Exclude already displayed posts', 'website')));
	}

	

	





	protected function onWidget(array $args, \Drone\HTML &$html)
	{

		
		$tax_query = array();
		switch ($this->wo('format')) {
			case '':
				break;
			case 'current':
				if ($term_id = Func::wpGetCurrentTermID('post_format')) {
					$tax_query[] = array(
						'taxonomy' => 'post_format',
						'field'    => 'term_id',
						'terms'    => array($term_id)
					);
				}
				break;
			case 'standard':
				$tax_query[] = array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => Func::wpTermsList('post_format', array('hide_empty' => false), 'term_id', 'slug'),
					'operator' => 'NOT IN'
				);
				break;
			default:
				$tax_query[] = array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => array('post-format-'.$this->wo('format'))
				);
		}

		
		$exclude = is_single() ? array(get_the_ID()) : array();
		if ($this->wo('exclude_previous')) {
			$exclude = array_merge($exclude, Theme::getInstance()->posts_stack);
		}

		
		$posts = get_posts(array(
			'category'         => $this->wo('category') === 'current' ? Func::wpGetCurrentTermID('category') : $this->wo('category'), 
			'tax_query'        => $tax_query,
			'numberposts'      => $this->wo('count'),
			'orderby'          => $this->wo('orderby'),
			'order'            => strtoupper($this->wo('order')),
			'exclude'          => array_unique($exclude),
			'suppress_filters' => false
		));
		if (count($posts) == 0) {
			return;
		}

		
		$html = HTML::ul();
		foreach ($posts as $post) {
			$li = HTML::li(
				HTML::a()
					->href(\apply_filters('the_permalink', get_permalink($post->ID)))
					->title($post->post_title)
					->add(wp_trim_words($post->post_title, $this->wo('limit')))
			);
			if ($this->wo('author')) {
				$author = get_userdata($post->post_author);
				$li->add(
					'&nbsp;',
					sprintf(__('by %s', 'website'), HTML::a()->href(get_author_posts_url($post->post_author))->title($author->display_name)->add($author->display_name)->toHTML())
				);
			}
			if ($this->wo('comments')) {
				$li->add(" ({$post->comment_count})");
			}
			$li = \Drone\apply_filters('widget_'.str_replace('-', '_', $this->_id).'_post', $li, $this, $post);
			$html->add($li);
		}

	}

	

	





	public function __construct()
	{
		parent::__construct(__('Posts list', 'website'), __('Displays list of posts by specific criteria (e.g.: newest posts, most commented, random posts, etc.).', 'website'));
	}

}








class Twitter extends Widget
{

	

	





	protected function onSetupOptions(\Drone\Options\Group\Widget $options)
	{
		$options->addOption('text', 'title', '',  __('Title', 'website'));
		$options->addOption('codeline', 'username', '', __('Username', 'website'), '', array(
			'on_sanitize' => function($option, $original_value, &$value) {
				if (preg_match('|^((https?://)?(www\.)?twitter\.com/(#!/)?)?(?P<username>.+?)/?$|i', $value, $matches)) {
					$value = $matches['username'];
				}
			}
		));
		$options->addOption('number', 'count', 5, __('Tweets count', 'website'), '', array('min' => 1, 'max' => 20));
		$options->addOption('interval', 'interval', array('quantity' => 30, 'unit' => 'm'), __('Update interval', 'website'), __('Tweets receiving interval.', 'website'), array('min' => '1m'));
		$options->addOption('boolean', 'include_retweets', true, '', '', array('caption' => __('Include retweets', 'website')));
		$options->addOption('boolean', 'exclude_replies', false, '', '', array('caption' => __('Exclude replies', 'website')));
		$oauth = $options->addGroup('oauth');
			$oauth->addOption('codeline', 'consumer_key', '', __('API key', 'website'));
			$oauth->addOption('codeline', 'consumer_secret', '', __('API secret', 'website'), '', array('password' => true));
			$oauth->addOption('codeline', 'access_token', '', __('Access token', 'website'));
			$oauth->addOption('codeline', 'access_token_secret', '', __('Access token secret', 'website'), '', array('password' => true));
	}

	

	





	protected function onWidget(array $args, \Drone\HTML &$html)
	{

		
		if (!$this->wo('username')) {
			return;
		}

		
		$options = array(
			'username'         => $this->wo('username'),
			'count'            => $this->wo('count'),
			'interval'         => $this->wo_('interval')->seconds(),
			'include_retweets' => $this->wo('include_retweets'),
			'exclude_replies'  => $this->wo('exclude_replies'),
			'oauth'            => $this->wo_('oauth')->toArray()
		);

		$tweets = Theme::getInstance()->getTransient(
			'twitter_'.crc32(serialize($options)),
			function(&$expiration, $outdated_value) use ($options) {
				$expiration = $options['interval'];
				$value = Func::twitterGetTweets(
					$options['oauth'],
					$options['username'],
					$options['include_retweets'],
					$options['exclude_replies'],
					$options['count']
				);
				if ($value === false) {
					return $outdated_value;
				}
				return $value;
			}
		);

		if ($tweets === false) {
			return;
		}

		
		$html = HTML::ul();
		foreach ($tweets as $tweet) {
			$li = HTML::li(
				$tweet['html'],
				HTML::br(),
				HTML::small(
					HTML::a()
						->href($tweet['url'])
						->add(sprintf(__('%s ago', 'website'), human_time_diff($tweet['date'])))
				)
			);
			$li = \Drone\apply_filters('widget_'.str_replace('-', '_', $this->_id).'_tweet', $li, $this, $tweet);
			$html->add($li);
		}

	}

	

	





	protected function getOptions($data = null)
	{
		$options = parent::getOptions($data);
		if ($data !== null && $options->isDefault()) {
			foreach ($this->get_settings() as $settings) {
				if (isset($settings['oauth']['consumer_key'])        && $settings['oauth']['consumer_key'] &&
					isset($settings['oauth']['consumer_secret'])     && $settings['oauth']['consumer_secret'] &&
					isset($settings['oauth']['access_token'])        && $settings['oauth']['access_token'] &&
					isset($settings['oauth']['access_token_secret']) && $settings['oauth']['access_token_secret']) {
					$options->child('oauth')->fromArray($settings['oauth']);
					break;
				}
			}
		}
		return $options;
	}

	

	





	public function __construct()
	{
		parent::__construct(__('Twitter', 'website'), __('Twitter stream.', 'website'));
	}

}








class Flickr extends Widget
{

	

	





	protected function onSetupOptions(\Drone\Options\Group\Widget $options)
	{
		$options->addOption('text', 'title', '',  __('Title', 'website'));
		$options->addOption('codeline', 'username', '', __('Username', 'website'), __('Screen name from Flickr account settings.', 'website'));
		$options->addOption('number', 'count', 4, __('Photos count', 'website'), '', array('min' => 1, 'max' => 50));
		$options->addOption('interval', 'interval', array('quantity' => 30, 'unit' => 'm'), __('Update interval', 'website'), __('Photos receiving interval.', 'website'), array('min' => '1m'));
		$options->addOption('select', 'url', 'image', 'Action after clickng on a photo', '', array('options' => array(
			'flickr' => __('Open Flickr page with the photo', 'website'),
			'image'  => __('Open bigger version of the photo', 'website')
		)));
		$options->addOption('codeline', 'api_key', '', __('API Key', 'website'), __('Optional (use only if you want to use your key).', 'website'));
	}

	

	





	protected function onWidget(array $args, \Drone\HTML &$html)
	{

		
		if (!$this->wo('username')) {
			return;
		}

		
		$options = array(
			'username' => $this->wo('username'),
			'count'    => $this->wo('count'),
			'interval' => $this->wo_('interval')->seconds(),
			'api_key'  => $this->wo('api_key', '__empty', Func::FLICKR_API_KEY)
		);

		$photos = Theme::getInstance()->getTransient(
			'flickr_'.crc32(serialize($options)),
			function(&$expiration, $outdated_value) use ($options) {
				$expiration = $options['interval'];
				if (
					($userdata = Func::flickrGetUserdata($options['api_key'], $options['username'])) === false ||
					($value = Func::flickrGetPhotos($options['api_key'], $userdata['id'], $options['count'])) === false
				) {
					return $outdated_value;
				}
				return $value;
			}
		);

		if ($photos === false) {
			return;
		}

		
		$html = HTML::ul();
		foreach ($photos as $photo) {
			$li = HTML::li();
			$li->addNew('a')
				->href($this->wo('url') == 'flickr' ? $photo['url'] : sprintf($photo['src'], 'b'))
				->title($photo['title'])
				->rel($this->id)
				->addNew('img')
					->src(sprintf($photo['src'], 's'))
					->alt($photo['title'])
					->width(75)
					->height(75);
			$li = \Drone\apply_filters('widget_'.str_replace('-', '_', $this->_id).'_photo', $li, $this, $photo);
			$html->add($li);
		}

	}

	

	





	public function __construct()
	{
		parent::__construct(__('Flickr', 'website'), __('Flickr photo stream.', 'website'));
	}

}








class FacebookPage extends Widget
{

	

	





	protected function onSetupOptions(\Drone\Options\Group\Widget $options)
	{
		$options->addOption('text', 'title', '',  __('Title', 'website'));
		$options->addOption('codeline', 'href', '', __('Facebook Page URL', 'website'), sprintf(__('E.g. %s', 'website'), '<code>http://www.facebook.com/platform</code>'), array('on_sanitize' => function($option, $original_value, &$value) {
			$value = preg_replace('/\?[^\?]*$/', '', $value);
		}));
		$options->addOption('boolean', 'small_header', false, '', '', array('caption' => __('Use small header', 'website')));
		$options->addOption('boolean', 'show_facepile', true, '', '', array('caption' => __('Show profile photos', 'website')));
		$show_posts = $options->addOption('boolean', 'show_posts', false, '', '', array('caption' => __('Show posts from the Page\'s timeline', 'website')));
		$options->addOption('number', 'height', 400, __('Height', 'website'), '', array('unit' => 'px', 'min' => 70, 'max' => 1000, 'owner' => $show_posts));
	}

	

	





	public function onOptionsCompatybility(array &$data, $version)
	{
		if (version_compare($version, '5.4.1') < 0) {
			if (isset($data['show_faces'])) {
				$data['show_facepile'] = $data['show_faces'];
			}
			if (isset($data['stream'])) {
				$data['show_posts'] = $data['stream'];
			}
		}
	}

	

	





	protected function onWidget(array $args, \Drone\HTML &$html)
	{

		
		wp_enqueue_script(Theme::getInstance()->theme->id.'-social-media-api');

		
		$html = \Drone\HTML::div();
		$fb_page = $html->addNew('div')
			->class('fb-page')
			->data('href', $this->wo('href'))
			->data('small-header', \Drone\Func::boolToString($this->wo('small_header')))
			->data('show-facepile', \Drone\Func::boolToString($this->wo('show_facepile')))
			->data('show-posts', \Drone\Func::boolToString($this->wo('show_posts')));
		if ($this->wo_('height')->isVisible()) {
			$html->css('height', $this->wo('height'));
			$fb_page->data('height', $this->wo('height'));
		}

	}

	

	





	public function __construct()
	{
		parent::__construct(__('Facebook Page', 'website'), __('Configurable Facebook widget.', 'website'));
	}

}









class FacebookLikeBox extends FacebookPage {}