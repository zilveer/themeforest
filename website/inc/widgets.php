<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */

// -----------------------------------------------------------------------------

namespace Website\Widgets\Widget;
use \Drone\Widgets\Widget;
use \Drone\HTML;

// -----------------------------------------------------------------------------

if (!defined('ABSPATH')) {
	exit;
}

// -----------------------------------------------------------------------------

class Search extends Widget
{

	// -------------------------------------------------------------------------

	protected function onWidget(array $args, \Drone\HTML &$html)
	{
		$html = HTML::form()->action(home_url('/'))->method('get')->add(
			HTML::input()->type('submit')->value(''),
			HTML::div()->class('input')->add(
				HTML::input()->name('s')->type('text')->placeholder(__('search', 'website'))->value(get_search_query())
			)
		);
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Search', 'website'), __('A search form for your site.', 'website'));
	}

}

// -----------------------------------------------------------------------------

class Social extends Widget
{

	// -------------------------------------------------------------------------

	protected function onSetupOptions(\Drone\Options\Group\Widget $options)
	{
		$options->addOption('select', 'type', 'vertical', __('Type', 'website'), '', array('options' => array(
			'vertical'   => __('Vertical', 'website'),
			'horizontal' => __('Horizontal', 'website')
		)));
		$options->addOption('collection', 'icons', array('icon' => '', 'title' => '', 'url' => 'http://'), __('Icons', 'website'), '', array('type' => 'social_media'));
		$options->addOption('boolean', 'target_blank', false, '', '', array('caption' => __('Open links in new window', 'website')));
	}

	// -------------------------------------------------------------------------

	public function onOptionsCompatybility(array &$data, $version)
	{

		if (version_compare($version, '3.0') < 0) {
			$data['icons'] = array();
			for ($i = 0; $i <= 99; $i++) {
				if (isset($data["slot_{$i}_icon"]) && isset($data["slot_{$i}_title"]) && isset($data["slot_{$i}_url"])) {
					if ($data["slot_{$i}_icon"] || $data["slot_{$i}_title"] || $data["slot_{$i}_url"]) {
						$data['icons'][] = array(
							'icon'  => $data["slot_{$i}_icon"],
							'title' => $data["slot_{$i}_title"],
							'url'   => $data["slot_{$i}_url"]
						);
					} else {
						$data['icons'][] = array(
							'icon'  => '_',
							'title' => '',
							'url'   => ''
						);
					}
				}
			}
			while (count($data['icons']) > 0 && $data['icons'][count($data['icons'])-1]['icon'] == '_') {
				unset($data['icons'][count($data['icons'])-1]);
			}
		}

		if (version_compare($version, '4.2-beta-2') < 0) {
			if (isset($data['icons']) && is_array($data['icons'])) {
				$i = 0;
				while (isset($data['icons'][$i]['icon'])) {
					if ($data['icons'][$i]['icon'] == '_') {
						$data['icons'][$i]['icon'] = '';
					} else {
						$data['icons'][$i]['icon'] = preg_replace('/\.png$/', '', $data['icons'][$i]['icon']);
					}
					$i++;
				}
			}
		}

	}

	// -------------------------------------------------------------------------

	protected function onWidget(array $args, \Drone\HTML &$html)
	{

		$scheme = \Website::to('appearance/scheme');
		if ($args['id'] == 'sidebar-bottom') {
			$scheme = $scheme == 'bright' ? 'dark' : 'bright';
		}

		$html = HTML::ul()->class($this->wo('type'));
		foreach ($this->wo_('icons')->options as $option) {

			if ($option->value('icon') && (!$option->value('url') || (!$option->value('title') && $this->wo('type') == 'vertical'))) {
				continue;
			}

			$li = $html->addNew('li');
			if ($option->value('icon')) {
				if ($src = $option->option('icon')->imageURI("data/img/{$scheme}/social")) {
					$a = $li->addNew('a')
						->href($option->value('url'))
						->title($option->value('title'))
						->css('background-image', 'url("'.$src.'")')
						->add($option->value('title'));
					if ($this->wo('target_blank')) {
						$a->target = 'blank';
					}
				}
			}

		}

	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Social media', 'website'), __('Social media icons.', 'website'));
	}

}

// -----------------------------------------------------------------------------

class Info extends Widget
{

	// -------------------------------------------------------------------------

	protected function onSetupOptions(\Drone\Options\Group\Widget $options)
	{
		$options->addOption('text', 'title', get_bloginfo('name'), __('Site title', 'website'));
		$options->addOption('text', 'tagline', get_bloginfo('description'), __('Tagline', 'website'));
	}

	// -------------------------------------------------------------------------

	protected function onWidget(array $args, \Drone\HTML &$html)
	{
		$html = HTML::hgroup()->add(
			HTML::h1()->add($this->wo('title')),
			HTML::h2()->add($this->wo_('tagline')->translate())
		);
		$this->wo_('title')->value = '';
	}

	// -------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct(__('Site info', 'website'), __('Website title and tagline.', 'website'));
	}

}