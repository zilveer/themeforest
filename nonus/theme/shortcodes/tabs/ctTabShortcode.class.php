<?php
/**
 * Tab shortcode
 */
class ctTabShortcode extends ctShortcode {

	/**
	 * Tabs counter
	 * @var int
	 */

	protected static $counter = 0;

	/**
	 * @inheritdoc
	 */
	public function __construct() {
		parent::__construct();

		//connect for additional code
		//remember - method must be PUBLIC!
		$this->connectPreFilter('tabs', array($this, 'handlePreFilter'));
	}


	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Tab';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'tab';
	}


	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */
	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));
		$counter = ++self::$counter;

		//add for pre filter data. Adds any data to this shortcode type
		$this->setData($counter, '<li' . ($active == "yes" ? ' class="active"' : '') . '><a data-toggle="tab" href="#tab' . $counter . '">' . $title . '</a></li>');
		$cParams = array(
			'id'=>'tab'.self::$counter,
			'class'=>array('tab-pane','fade','in',$active=='yes' ? ' active' : ''),
		);
		return '<li'.$this->buildContainerAttributes($cParams,$atts).'>' . do_shortcode($content) . '</li>';
	}

	/**
	 * Adds content before filters
	 * @param string $content
	 * @return string
	 */
	public function handlePreFilter($content) {
		//here - add all available content
		foreach ($this->getAllData() as $data) {
			$content .= $data;
		}
		return $content;
	}

	/**
	 * Parent shortcode name
	 * @return null
	 */

	public function getParentShortcodeName() {
		return 'tabs';
	}


	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'title' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input'),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => 'textarea'),
			'active' => array('label' => __('is active', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')),),
		);
	}
}

new ctTabShortcode();