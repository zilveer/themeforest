<?php
require_once CT_THEME_LIB_DIR.'/widgets/ctWidget.class.php';
/**
 * Widget created based on shortcode
 * @author alex
 */

abstract class ctShortcodeWidget extends ctWidget {

	/**
	 * @var ctShortcode
	 */
	protected $shortcode;

	/**
	 * @var ctShortcode
	 */

	protected $childShortcode;

	/**
	 * Returns shortcode class
	 * @return mixed
	 */

	abstract protected function getShortcodeName();


	/**
	 * @param bool $id_base
	 * @param string $name
	 * @param array $widget_options
	 * @param array $control_options
	 */
	function __construct($id_base = false, $name, $widget_options = array(), $control_options = array()) {
		parent::__construct($id_base, $name, $widget_options, $control_options);

		$this->initialize();
	}

	/**
	 * Initialize widget
	 */

	protected function initialize() {
		$name = $this->getShortcodeName();

		//find shortcode
		if (!$this->shortcode = ctShortcodeHandler::getInstance()->getShortcode($name)) {
			throw new InvalidArgumentException("Cannot find shortcode " . $name);
		}
		//maybe child?
		$this->childShortcode = $this->shortcode->getChildShortcode();
	}

	/**
	 * Buils shortcode items
	 * @param $e
	 * @return string
	 */
	protected function buildParams($e) {
		$str = '';
		if(!is_array($e)){
			return $str;
		}
		foreach ($e as $name => $key) {
            if($name!='content'){
                $str .= ' ' . $name . '="' . addslashes($key) . '"';
            }
		}
		return $str;
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	function widget($args, $instance) {

		$shortcode = '';
		if ($this->childShortcode) {
			$shortcode .= '[' . $this->shortcode->getShortcodeName();

			if (isset($instance['parent'])) {
				$shortcode .= ' ' . $this->buildParams($instance['parent']);
			}

			$shortcode .= ']';
		}


		$s = $this->childShortcode ? $this->childShortcode : $this->shortcode;

		if (isset($instance['parent'])) {
			unset($instance['parent']);
		}

		if (!$this->childShortcode) {
			$instance = array('child' => $instance);
		}

		foreach ($instance['child'] as $e) {

			$c = isset($e['content']) ? $e['content'] : null;


			$shortcode .= '[' . $s->getShortcodeName() . $this->buildParams($e) . ']';

			if ($c !== null) {
				$shortcode .= $c . '[/' . $s->getShortcodeName() . ']';
			}
		}

		if ($this->childShortcode) {
			$shortcode .= '[/' . $this->shortcode->getShortcodeName() . ']';
		}
		echo $args['before_widget'];
		echo do_shortcode($shortcode);
		echo $args['after_widget'];
	}


	/**
	 * Simple update
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */

	function update($new_instance, $old_instance) {
		$new_instance = array_merge($new_instance, $this->getDefaultAttributes());

		if (!$this->childShortcode) {
			return array('child' => $new_instance, 'parent' => array());
		}

		if (!isset($new_instance['child'])) {
			$new_instance['child'] = array();
		}

		$parent = array();
		if (isset($new_instance['parent'])) {
			//parent info
			$p = $new_instance['parent'];
			unset($new_instance['parent']);

			$parent = array();
			foreach ($p as $name => $values) {
				$parent[$name] = array_pop($values);
			}
		}

		//translate instance
		$keys = array_keys($new_instance);

		$normalized = array();
		foreach ($keys as $field) {
			foreach ($new_instance[$field] as $x => $value) {
				$normalized[$x + 1][$field] = $value;
			}
		}

		return array('child' => $normalized, 'parent' => $parent);
	}

	/**
	 * Returns default attributes - they are removed from view and injected by default
	 * @return array
	 */
	protected function getDefaultAttributes() {
		return array('widgetmode' => "true");
	}

	/**
	 * Renders form
	 * @param array $instance
	 * @return string|void
	 */
	function form($instance) {

		if (!isset($instance['child'])) {
			$instance['child'] = array();
		}

		if (!$this->childShortcode) {
			$this->renderShortcodeForm(array($this->shortcode), $instance);
		} else {
			$shortcodes = array();
			$childInfo = $this->shortcode->getChildShortcodeInfo();
			$max = count($instance['child']);
			if (!$max) {
				$max = isset($childInfo['default_qty']) ? $childInfo['default_qty'] : 1;
			}

			for ($x = 0; $x < $max; $x++) {
				$shortcodes[] = $this->childShortcode;
			}
			$this->renderShortcodeForm($shortcodes, $instance);
		}
	}

	/**
	 * Render shortcode form
	 * @param ctShortcode[] $shortcodes
	 * @param array $instance
	 * @return void
	 */
	protected function renderShortcodeForm($shortcodes, $instance) {
		$preffix = $this->childShortcode ? '[]' : '';

		$d = new ctShortcodeDecorator($shortcodes, false, $this->childShortcode);
		$d->setSchemaFormat('widget-' . $this->id_base . '[' . $this->number . ']' . '%parent%[%name%]' . $preffix);
		$d->setDefaultValues($instance['child']);
		$d->setBannedAttributes($this->getDefaultAttributes());
		$d->setInputSubstitutes(array('image' => 'input'));

		if ($this->shortcode && $this->childShortcode) {
			$d->setParentShortcode($this->shortcode);
			$d->setParentDefaultValues(isset($instance['parent']) ? $instance['parent'] : array());
		}
		echo $d;
	}
}
