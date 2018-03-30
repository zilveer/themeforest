<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      3.0
 */

// -----------------------------------------------------------------------------

namespace Website\Options\Option;
use \Drone\HTML;

// -----------------------------------------------------------------------------

if (!defined('ABSPATH')) {
	exit;
}

// -----------------------------------------------------------------------------

class SocialMedia extends \Drone\Options\Option\Complex
{

	// -------------------------------------------------------------------------

	protected $icon;
	protected $title;
	protected $url;

	// -------------------------------------------------------------------------

	protected function _options()
	{
		return array(
			'icon'  => 'image_select',
			'title' => 'text',
			'url'   => 'codeline'
		);
	}

	// -------------------------------------------------------------------------

	protected function _html()
	{
		$html = HTML::div()->class($this->getCSSClass(__CLASS__));
		$html->add(
			$this->icon->html(),
			HTML::div()->css('margin', '0 0 22px 73px')->add(
				$this->title->html()
			),
			$this->url->html()
		);
		return $html;
	}

	// -------------------------------------------------------------------------

	public function __construct($name, $default, $properties = array())
	{

		parent::__construct($name, $default, $properties);

		$this->icon->options  = function() {
			return
				\Drone\Options\Option\ImageSelect::dirToOptions('data/img/bright/social') +
				\Drone\Options\Option\ImageSelect::mediaToOptions(32, 'png');
		};
		$this->icon->required = false;
		$this->icon->on_html  = function($option, $html) { $html->css('float', 'left'); };

		$this->url->on_html = function($option, $html) { $html->css('margin-bottom', 3); };

	}

}