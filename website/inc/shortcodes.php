<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      5.0
 */

// -----------------------------------------------------------------------------

namespace Website\Shortcodes\Shortcode;
use \Drone\Shortcodes\Shortcode;
use \Drone\Func;
use \Drone\HTML;

// -----------------------------------------------------------------------------

if (!defined('ABSPATH')) {
	exit;
}

// -----------------------------------------------------------------------------

/**
 * Caption
 *
 * @since 5.0
 */
class Caption extends \Drone\Shortcodes\Shortcode\Caption
{

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{

		// Figure
		$html = HTML::figure()
			->id($this->so('id', '__empty'))
			->addClass($this->so('align'), 'full-width-mobile');

		// Classes
		$class = preg_match('/class="([^"]*)"/i', $content, $m) ? $m[1] : '';

		if (preg_match('/\bborder-(none|thin|thick)\b/i', $class, $m)) {
			if ($m[1] != 'none') {
				$html->addClass($m[1]);
			}
			$class = str_replace($m[0], '', $class);
		} else {
			$html->addClass(\Website::to('appearance/image/border'));
		}

		// Content
		$content = preg_replace('/class="[^"]*"/i', 'class="'.$class.'"', $content);

		if (\Website::to('appearance/image/fancybox') && preg_match('/href=["\'][^"\']+\.(jpe?g|png|gif|bmp)["\']/i', $content)) {
			$content = str_replace('<a ', sprintf('<a class="fancybox" title="%s" rel="post-%d" ', esc_attr($this->so('caption')), get_the_ID()), $content);
		}

		$html->add(trim($content));

		// Caption
		if ($this->so('caption')) {
			$html->addNew('figcaption')->add($this->so('caption'));
		}

	}

}

// -----------------------------------------------------------------------------

/**
 * Gallery
 *
 * @since 5.0
 */
class Gallery extends \Drone\Shortcodes\Shortcode\Gallery
{

	// -------------------------------------------------------------------------

	protected $instance_id = 0;

	// -------------------------------------------------------------------------

	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		parent::onSetupOptions($options);
		$options->addOption('boolean', 'captions', true, __('Captions', 'website'));
		$options->addOption('select', 'border', 'inherit', __('Border style', 'website'), '', array('options' => array(
			'inherit' => __('Inherit', 'website'),
			''        => __('None', 'website'),
			'thin'    => __('Thin', 'website'),
			'thick'   => __('Thick', 'website')
		)));
	}

	// -------------------------------------------------------------------------

	public function onOptionsCompatybility(array &$data)
	{
		if (isset($data['use_wp_thumbs']) && Func::stringToBool($data['use_wp_thumbs'])) {
			$data['size'] = 'thumbnail';
		}
	}

	// -------------------------------------------------------------------------

	protected function getAttachmentLinkURI(\WP_Post $attachment)
	{
		if ($attachment->post_content && preg_match('#((https?://|mailto:).+)(\b|["\'])#i', $attachment->post_content, $matches)) {
			return $matches[1];
		}
		return parent::getAttachmentLinkURI($attachment);
	}

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{

		$html = HTML::div()
			->id('gallery-'.(++$this->instance_id))
			->class('columns gallery gallery-'.$this->instance_id);

		foreach ($this->getAttachments() as $i => $attachment) {

			// Column
			$column = $html->addNew('div')
				->class('column col-1-'.$this->so('columns'));
			if ($i % $this->so('columns') == 0) {
				$column->addClass('row-clear');
			}

			// Figure
			$figure = $column->addNew('figure')
				->class("attachment-{$attachment->ID} aligncenter full-width-mobile {$this->so('border', '__default', \Website::to('appearance/image/border'))}");

			// URL
			if ($url = $this->getAttachmentLinkURI($attachment)) {
				$a = $figure->addNew('a')
					->title($attachment->post_excerpt)
					->rel('gallery-'.$this->instance_id)
					->href($url)
					->add(wp_get_attachment_image($attachment->ID, $this->so('size')));
				if (\Website::to('appearance/image/fancybox') && $this->so('link') == 'file') {
					$a->addClass('fancybox');
				}
			} else {
				$figure
					->add(wp_get_attachment_image($attachment->ID, $this->so('size')));
			}

			// Caption
			if ($this->so('captions') && trim($attachment->post_excerpt)) {
				$figure->addNew('figcaption')
					->add(wptexturize($attachment->post_excerpt));
			}

		}

	}

}

// -----------------------------------------------------------------------------

/**
 * Hr
 *
 * @since 1.0
 */
class Hr extends Shortcode
{

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$html = HTML::hr();
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Horizontal line', 'website'), array(
			'self_closing' => true
		));
	}

}

class Line extends Hr
{

	// -------------------------------------------------------------------------

	public function __construct()
	{
		Shortcode::__construct('', array(
			'self_closing' => true,
			'visibility'   => self::VISIBILITY_NONE
		));
	}

}

// -----------------------------------------------------------------------------

/**
 * Mark
 *
 * @since 5.0
 */
class Mark extends Shortcode
{

	// -------------------------------------------------------------------------

	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('select', 'color', '', __('Color', 'website'), '', array('options' => array(
			''       => __('Default', 'website'),
			'yellow' => __('Yellow', 'website')
		)));
	}

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$html = HTML::mark()
			->class($this->so('color'))
			->add(Func::wpShortcodeContent($content));
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Text mark', 'website'), array(
			'visibility' => self::VISIBILITY_TINYMCE
		));
	}

}

class Highlight extends Mark
{

	// -------------------------------------------------------------------------

	public function __construct()
	{
		Shortcode::__construct('', array(
			'visibility' => self::VISIBILITY_NONE
		));
	}

}

// -----------------------------------------------------------------------------

/**
 * Dropcap
 *
 * @since 5.0
 */
class Dc extends Shortcode
{

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$content = Func::wpShortcodeContent($content);
		$html = HTML::make()->add(
			HTML::span()->class('dropcap')->add($content[0]),
			substr($content, 1)
		);
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Dropcap', 'website'), array(
			'visibility' => self::VISIBILITY_TINYMCE
		));
	}

}

class Dropcap extends Dc
{

	// -------------------------------------------------------------------------

	public function __construct()
	{
		Shortcode::__construct('', array(
			'visibility' => self::VISIBILITY_NONE
		));
	}

}

// -----------------------------------------------------------------------------

/**
 * Tooltip
 *
 * @since 5.0
 */
class Tooltip extends Shortcode
{

	// -------------------------------------------------------------------------

	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('text', 'title', '', __('Title', 'website'));
		$options->addOption('select', 'gravity', 's', __('Tooltip position', 'website'), '', array('options' => array(
			'se' => __('Northwest', 'website'),
			's'  => __('North', 'website'),
			'sw' => __('Northeast', 'website'),
			'e'  => __('West', 'website'),
			'w'  => __('East', 'website'),
			'ne' => __('Southwest', 'website'),
			'n'  => __('South', 'website'),
			'nw' => __('Southeast', 'website')
		)));
		$options->addOption('boolean', 'fade', false, __('Fade', 'website'), '', array('caption' => __('Yes', 'website')));
	}

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$html = HTML::span()
			->class('tooltip')
			->title($this->so('title'))
			->data('gravity', $this->so('gravity'))
			->data('fade', $this->so_('fade')->toString())
			->add(Func::wpShortcodeContent($content));
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Tooltip', 'website'), array(
			'visibility' => self::VISIBILITY_TINYMCE
		));
	}

}

class Tip extends Tooltip
{

	// -------------------------------------------------------------------------

	public function __construct()
	{
		Shortcode::__construct('', array(
			'visibility' => self::VISIBILITY_NONE
		));
	}

}

// -----------------------------------------------------------------------------

/**
 * Quote
 *
 * @since 5.0
 */
class Quote extends Shortcode
{

	// -------------------------------------------------------------------------

	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('select', 'align', 'none', __('Align', 'website'), '', array('options' => array(
			'none'  => __('None', 'website'),
			'left'  => __('Left', 'website'),
			'right' => __('Right', 'website')
		)));
		$options->addOption('text', 'width', '100%', __('Width', 'website'), __('In pixels or percentages. E.g.: 200px, 50%.', 'website'), array('required' => true, 'regexpr' => '/^[0-9]+(px|%)$/i')); // todo: pole z wyborem unita jak bedzie
	}

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$html = HTML::blockquote()
			->class('align'.$this->so('align'))
			->css('width', $this->so('width'))
			->add(Func::wpShortcodeContent($content));
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Quote', 'website'));
	}

}

// -----------------------------------------------------------------------------

/**
 * Icon
 *
 * @since 5.0
 */
class Icon extends Shortcode
{

	// -------------------------------------------------------------------------

	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('image_select', 'name', 'check', __('Icon', 'website'), '', array('options' => function() {
			return
				\Drone\Options\Option\ImageSelect::dirToOptions('data/img/icons/16') +
				\Drone\Options\Option\ImageSelect::mediaToOptions(array(16, 32, 48, 64), 'png');
		}));
		$options->addOption('select', 'size', 'small', __('Size', 'website'), '', array('options' => array(
			'small' => __('Small', 'website'),
			'big'   => __('Big', 'website')
		)));
	}

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		if (!is_null($icon = $this->so_('name')->imageHTML('data/img/icons/'.($this->so('size') == 'small' ? 16 : 32)))) {
			$html = $icon;
		}
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Icon', 'website'), array(
			'self_closing' => true,
			'visibility'   => self::VISIBILITY_TINYMCE
		));
	}

}

// -----------------------------------------------------------------------------

/**
 * List
 *
 * @since 5.0
 */
class IconList extends Shortcode
{

	// -------------------------------------------------------------------------

	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('image_select', 'icon', 'check', __('Icon', 'website'), '', array('options' => function() {
			return \Drone\Options\Option\ImageSelect::dirToOptions('data/img/icons/16');
		}));
	}

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$html->add(preg_replace(
			'/^<ul>$/im',
			sprintf('<ul class="list %s">', $this->so('icon')),
			\Drone\Func::wpShortcodeContent($content)
		));
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('List', 'website'), array(
			'tag' => 'list'
		));
	}

}

// -----------------------------------------------------------------------------

/**
 * Button
 *
 * @since 5.0
 */
class Button extends Shortcode
{

	// -------------------------------------------------------------------------

	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('select', 'type', 'normal', __('Size', 'website'), '', array('options' => array(
			'tiny'   => __('Tiny', 'website'),
			'small'  => __('Small', 'website'),
			'normal' => __('Normal', 'website'),
			'big'    => __('Big', 'website')
		)));
		$options->addOption('image_select', 'icon', '', __('Icon', 'website'), __('Only for normal and big sizes.', 'website'), array('required' => false, 'options' => function() {
			return \Drone\Options\Option\ImageSelect::dirToOptions('data/img/icons/16');
		}));
		$options->addOption('text', 'url', '', __('Hyperlink', 'website'));
		$options->addOption('select', 'target', 'self', __('Target', 'website'), '', array('options' => array(
			'self'   => __('Self (current window)', 'website'),
			'parent' => __('Parent', 'website'),
			'top'    => __('Top', 'website'),
			'blank'  => __('Blank (new window)', 'website')
		)));
	}

	// -------------------------------------------------------------------------

	public function onOptionsCompatybility(array &$data)
	{
		if (isset($data['target'])) {
			$data['target'] = ltrim($data['target'], '_');
		}
	}

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$html = HTML::button()
			->class($this->so('type'))
			->add(Func::wpShortcodeContent($content, false));
		if ($this->so('icon') && ($this->so('type') == 'normal' || $this->so('type') == 'big')) {
			$size = $this->so('type') == 'normal' ? 16 : 32;
			if ($icon_uri = $this->so_('icon')->imageURI('data/img/icons/'.$size)) {
				$html
					->addClass('icon-'.$size)
					->insertNew('span')
						->css('background-image', 'url("'.$icon_uri.'")');
			}
		}
		if ($this->so('url')) {
			$html->data('href', $this->so('url'));
			$html->data('target', $this->so('target'));
		}
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Button', 'website'), array(
			'visibility' => self::VISIBILITY_TINYMCE
		));
	}

}

// -----------------------------------------------------------------------------

/**
 * Box
 *
 * @since 5.0
 */
class Box extends Shortcode
{

	// -------------------------------------------------------------------------

	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('select', 'color', 'blue', __('Color', 'website'), '', array('options' => array(
			'blue'   => __('Blue', 'website'),
			'green'  => __('Green', 'website'),
			'orange' => __('Orange', 'website'),
			'red'    => __('Red', 'website'),
			'gray'   => __('Gray', 'website')
		)));
		$options->addOption('image_select', 'icon', '', __('Icon', 'website'), '', array('required' => false, 'options' => function() {
			return \Drone\Options\Option\ImageSelect::dirToOptions('data/img/icons/16');
		}));
		$options->addOption('select', 'size', 'small', __('Size', 'website'), '', array('options' => array(
			'small' => __('Small', 'website'),
			'big'   => __('Big', 'website')
		)));
	}

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$html = HTML::div()
			->addClass('frame', $this->so('color'))
			->add(Func::wpShortcodeContent($content));
		if ($this->so('icon')) {
			$size = $this->so('size') == 'small' ? 16 : 32;
			if ($icon_uri = $this->so_('icon')->imageURI('data/img/icons/'.$size)) {
				$html->addClass('icon-'.$size);
				$html->css('background-image', 'url("'.$icon_uri.'")');
			}
		}
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Message box', 'website'));
	}

}

// -----------------------------------------------------------------------------

/**
 * Columns
 *
 * @since 5.0
 */
class Columns extends Shortcode
{

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$html = HTML::div()
			->class('columns')
			->add(Func::wpShortcodeContent($content));
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Columns', 'website'), array(
			'visibility' => self::VISIBILITY_NONE
		));
	}

}

class Cols extends Columns
{

	// -------------------------------------------------------------------------

	public function __construct()
	{
		Shortcode::__construct('', array(
			'visibility' => self::VISIBILITY_NONE
		));
	}

}

// -----------------------------------------------------------------------------

/**
 * Column
 *
 * @since 5.0
 */
class Column extends Shortcode
{

	// -------------------------------------------------------------------------

	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('text', 'width', '1/2', __('Width', 'website'), __('In fraction format.', 'website'), array('on_sanitize' => function($option, $original_value, &$value) {
			$value = str_replace(' ', '', $value);
			if (!preg_match('#^(?P<span>[0-9]+)/(?P<total>[0-9]+)$#', $value, $m) || ($m['total'] > 10 || $m['span'] > $m['total'])) {
				$value = $option->default;
			}
		}));
	}

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		list($span, $total) = explode('/', $this->so('width'));
		$html = HTML::div()
			->addClass('column', "col-{$span}-{$total}")
			->add(Func::wpShortcodeContent($content));
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Column', 'website'), array(
			'parent'     => 'columns',
			'visibility' => self::VISIBILITY_TINYMCE
		));
	}

}

class Col extends Column
{

	// -------------------------------------------------------------------------

	public function __construct()
	{
		Shortcode::__construct('', array(
			'parent'     => 'cols',
			'visibility' => self::VISIBILITY_NONE
		));
	}

}

// -----------------------------------------------------------------------------

/**
 * Tabs
 *
 * @since 5.0
 */
class Tabs extends Shortcode
{

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$html = HTML::div()
			->class('tabs')
			->add(Func::wpShortcodeContent($content));
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Tabs', 'website'), array(
			'visibility' => self::VISIBILITY_NONE
		));
	}

}

// -----------------------------------------------------------------------------

/**
 * Tab
 *
 * @since 5.0
 */
class Tab extends Shortcode
{

	// -------------------------------------------------------------------------

	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('text', 'label', '', __('Label', 'website'));
		$options->addOption('boolean', 'active', false, __('Active', 'website'), '', array('caption' => __('Yes', 'website')));
	}

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$html = HTML::div()
			->class('clear')
			->data('label', $this->so('label'))
			->add(Func::wpShortcodeContent($content));
		if ($this->so('active')) {
			$html->data('active', 'true');
		}
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Tab', 'website'), array(
			'parent'     => 'tabs',
			'visibility' => self::VISIBILITY_TINYMCE
		));
	}

}

// -----------------------------------------------------------------------------

/**
 * Media
 *
 * @since 5.0
 */
class Media extends Shortcode
{

	// -------------------------------------------------------------------------

	protected function onSetupOptions(\Drone\Options\Group\Shortcode $options)
	{
		$options->addOption('select', 'version', 'all', __('Type', 'website'), '', array('options' => array(
			'all'        => __('All', 'website'),
			'desktop'    => __('Desktop only', 'website'),
			'tablet'     => __('Tablet only', 'website'),
			'mobile'     => __('Mobile only', 'website'),
			'mini'       => __('Mini only', 'website'),
			'lte-tablet' => __('<= Tablet', 'website'),
			'lte-mobile' => __('<= Mobile', 'website'),
			'gte-tablet' => __('>= Tablet', 'website'),
			'gte-mobile' => __('>= Mobile', 'website')
		)));
		$options->addOption('boolean', 'visible', true, __('Visible', 'website'), '', array('caption' => __('Yes', 'website')));
		$options->addOption('select', 'type', 'block', __('Element type', 'website'), '', array('options' => array(
			'block'  => __('Block', 'website'),
			'inline' => __('Inline', 'website')
		)));
	}

	// -------------------------------------------------------------------------

	public function onOptionsCompatybility(array &$data)
	{
		if (isset($data['version'])) {
			switch ($data['version']) {
				case 'lte-mini':    $data['version'] = 'mini';    break;
				case 'gte-desktop': $data['version'] = 'desktop'; break;
			}
		}
	}

	// -------------------------------------------------------------------------

	protected function onShortcode($content, $code, \Drone\HTML &$html)
	{
		$html = HTML::make($this->so('type') == 'block' ? 'div' : 'span')
			->class($this->so('visible') ? $this->so('version') : 'hide-'.$this->so('version'))
			->add(Func::wpShortcodeContent($content));
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Media', 'website'));
	}

}