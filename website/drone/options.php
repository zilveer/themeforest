<?php










namespace Drone\Options;
use Drone\Func;
use Drone\Theme;









const INC_FILENAME = 'options.php';













abstract class Child
{

	

	




	private $parent;

	




	private $name;

	




	public $label = '';

	




	public $description = '';

	




	public $included = true;

	




	public $owner;

	




	public $owner_value = true;

	

	






	public function __construct($name)
	{
		$this->name = (string)$name;
	}

	

	







	public function __get($name)
	{

		switch ($name) {

			case 'root':
				return $this->parent !== null ? $this->parent->root : $this;

			case 'path':
				if ($this->parent !== null) {
					if ($this->parent->parent !== null) {
						return array_filter(array_merge($this->parent->path, array($this->name)));
					} else {
						return array($this->name);
					}
				} else {
					return array();
				}

			case 'input_name': 
			case 'attr_name':
				if ($this->parent !== null && ($pn = $this->parent->{$name}) != '') {
					return $this->name != '' ? ($name == 'attr_name' ? $pn.'_'.$this->name : "{$pn}[{$this->name}]") : $pn;
				} else {
					return $this->name;
				}

			case 'parent':
			case 'name':
				return $this->{$name};

		}

	}

	

	







	public function __set($name, $value)
	{
		switch ($name) {
			case 'parent':
				$this->parent = $value instanceof self ? $value : null;
				break;
		}
	}

	

	






	public function isGroup()
	{
		return false;
	}

	

	






	public function isOption()
	{
		return false;
	}

	

	






	public function isIncluded()
	{
		return $this->included && ($this->parent === null || $this->parent->isIncluded());
	}

	

	






	public function isVisible()
	{
		return $this->isIncluded() && ($this->owner === null || ($this->owner->isVisible() && count(array_intersect((array)$this->owner->value, (array)$this->owner_value)) > 0));
	}

	

	










	public function closestParent($class = 'Child')
	{
		if (!$class || $this->parent === null) {
			return null;
		}
		$_class = __NAMESPACE__.'\\'.$class;
		return $this->parent instanceof $_class ? $this->parent : $this->parent->closestParent($class);
	}

	

	






	public function reAssignOwner()
	{
		$root = $this->root;
		if ($this->owner !== null && $root->isGroup()) {
			$this->owner = $root->child($this->owner->path);
		}
		return $this->owner;
	}

}








abstract class Group extends Child
{

	

	




	const VERSION_KEY = '__version';

	

	




	protected $class;

	




	protected $childs = array();

	

	






	public function __construct($name)
	{
		parent::__construct($name);
		$this->class = get_class($this);
	}

	

	




	public function __clone()
	{
		foreach ($this->childs as $index => $child) {
			$this->childs[$index] = clone $child;
			$this->childs[$index]->parent = $this;
		}
	}

	

	







	public function addChild(\Drone\Options\Child $child, $subsequent = '')
	{
		$child->parent = $this;
		if ($subsequent !== '') {
			$this->childs = Func::arrayInsert($this->childs, array($child->name => $child), $subsequent);
		} else {
			$this->childs[$child->name] = $child;
		}
	}

	

	















	public function findChild($paths, $skip_if = null)
	{
		if ($skip_if && !is_callable($skip_if)) {
			switch ($skip_if) {
				case '__empty':      $skip_if = function($c) { return $c->isEmpty(); };    break;
				case '__default':    $skip_if = function($c) { return $c->isDefault(); };  break;
				case '__default_ns': $skip_if = function($c) { return $c->isDefault() || !is_singular(); };  break;
				case '__hidden':     $skip_if = function($c) { return !$c->isVisible(); }; break;
				case '__hidden_ns':  $skip_if = function($c) { return !$c->isVisible() || !is_singular(); }; break;
				default:             $skip_if = null;
			}
		}
		foreach ((array)$paths as $path) {
			$child = $this->child($path);
			if ($child !== null && !($child->isOption() && $skip_if && $skip_if($child))) {
				return $child;
			}
		}
	}

	

	






	public function deleteChild($path)
	{
		if (empty($path)) {
			return;
		}
		if (is_string($path)) {
			$path = explode('/', trim($path, '/'));
		}
		if (!is_array($path)) {
			return;
		}
		$name = array_shift($path);
		if (!isset($this->childs[$name])) {
			return;
		}
		$child = $this->childs[$name];
		if (empty($path) || $child->isOption()) {
			$this->childs[$name]->parent = null;
			unset($this->childs[$name]);
		} else {
			$child->deleteChild($path);
		}
	}

	

	







	public function child($path)
	{
		if (is_string($path)) {
			$path = explode('/', trim($path, '/'));
		}
		if (!is_array($path)) {
			return;
		}
		do {
			if (empty($path)) {
				return $this;
			} else {
				$name = trim((string)array_shift($path));
			}
		} while ($name == '');
		if (!isset($this->childs[$name])) {
			return;
		}
		$child = $this->childs[$name];
		if (empty($path) || $child->isOption()) {
			return $child;
		} else {
			return $child->child($path);
		}
	}

	

	







	public function childs($type = 'all')
	{
		if ($type == 'group' || $type == 'option') {
			$method = 'is'.ucfirst($type);
			return array_filter($this->childs, function($c) use ($method) { return call_user_func(array($c, $method)); });
		} else {
			return $this->childs;
		}
	}

	

	






	public function count()
	{
		return count($this->childs);
	}

	

	










	public function addGroup($name, $label = '', $description = '', $subsequent = '')
	{
		$group = new $this->class($name);
		$group->label       = $label;
		$group->description = $description;
		$this->addChild($group, $subsequent);
		return $group;
	}

	

	













	public function addOption($type, $name, $default, $label = '', $description = '', array $properties = array(), $subsequent = '')
	{
		$class = Option::getObjectClass($type);
		$option = new $class($name, $default, $properties);
		$option->label       = $label;
		$option->description = $description;
		$this->addChild($option, $subsequent);
		return $option;
	}

	

	



















	public function addEnabledOption($type, $name, $enabled, $default, $label, $enabled_caption, $description = '', array $properties = array(), $subsequent = '')
	{
		$properties = array_merge(array('indent' => true), $properties);
		$group = $this->addGroup($name, $label, '', $subsequent);
		$owner = $group->addOption('boolean', 'enabled', $enabled, '', '', array('caption' => $enabled_caption));
		$option = $group->addOption($type, $name, $default, '', $description, $properties);
		$option->owner = $owner;
		return $option;
	}

	

	








	public function value($path, $value = null)
	{
		$child = $this->child($path);
		if ($child === null || !$child->isOption()) {
			return;
		}
		if ($value === null) {
			return $child->value;
		} else {
			$child->value = $value;
		}
	}

	

	






	public function errorsCount()
	{
		$errors = 0;
		foreach ($this->childs as $child) {
			$errors += $child->isGroup() ? $child->errorsCount() : ($child->isIncluded() && $child->isError() ? 1 : 0);
		}
		return $errors;
	}

	

	






	public function isGroup()
	{
		return true;
	}

	

	






	public function isDefault()
	{
		foreach ($this->childs as $child) {
			if (!$child->isDefault()) {
				return false;
			}
		}
		return true;
	}

	

	





	public function reAssignOwner()
	{
		foreach ($this->childs as $child) {
			$child->reAssignOwner();
		}
		return parent::reAssignOwner();
	}

	

	






	public function deepClone()
	{
		$_this = clone $this;
		$_this->reAssignOwner();
		return $_this;
	}

	

	




	public function reset()
	{
		foreach ($this->childs as $child) {
			$child->reset();
		}
	}

	

	






	public function change($values)
	{
		if (!is_array($values)) {
			return;
		}
		foreach ($this->childs as $name => $child) {
			if (isset($values[$name]) && ($child->isOption() || is_array($values[$name]))) {
				$child->change($values[$name]);
			}
		}
	}

	

	







	public function sanitize($values)
	{
		$sanitized = array();
		if (is_array($values)) {
			foreach ($this->childs as $name => $child) {
				if (isset($values[$name]) && ($child->isOption() || is_array($values[$name]))) {
					$sanitized[$name] = $child->sanitize($values[$name]);
				}
			}
		}
		return $sanitized;
	}

	

	






	abstract public function html();


	

	






	public function styles()
	{
		$styles = '';
		foreach ($this->childs as $child) {
			$styles .= $child->styles();
		}
		return $styles;
	}

	

	






	public function scripts()
	{
		$scripts = '';
		foreach ($this->childs as $child) {
			$scripts .= $child->scripts();
		}
		return $scripts;
	}

	

	






	public function toArray()
	{
		$haystack = array();
		foreach ($this->childs as $name => $child) {
			$haystack[$name] = $child->isGroup() ? $child->toArray() : $child->value;
		}
		if ($this->parent === null) {
			$haystack[self::VERSION_KEY] = array(
				\Drone\VERSION,
				Theme::getInstance()->base_theme->version
			);
		}
		return $haystack;
	}

	

	











	public function fromArray(&$haystack, $compatybility_callback = null, array $compatybility_params = array())
	{

		
		if (!is_array($haystack)) {
			$this->reset();
			return false;
		}

		
		if (empty($haystack)) {
			$this->reset();
			return true;
		}

		
		if ($this->parent === null && is_callable($compatybility_callback)) {

			
			$version = array(1, 1);
			if (isset($haystack[self::VERSION_KEY])) {
				if (is_array($haystack[self::VERSION_KEY])) {
					if (count($haystack[self::VERSION_KEY]) == 2) {
						$version = $haystack[self::VERSION_KEY];
					}
				} else {
					$version[1] = $haystack[self::VERSION_KEY];
				}
			}

			
			$rm = new \ReflectionMethod($compatybility_callback[0], $compatybility_callback[1]);

			
			if (strstr($rm->class, '\\', true) == strstr(__NAMESPACE__, '\\', true)) {
				$code_version = \Drone\VERSION;
				$version      = $version[0];
			} else {
				$code_version = Theme::getInstance()->base_theme->version;
				$version      = $version[1];
			}

			
			if (version_compare($version, $code_version) < 0) {
				call_user_func_array($compatybility_callback, array_merge(array(&$haystack, $version), $compatybility_params));
			}

		}

		
		foreach ($this->childs as $name => $child) {
			if (!isset($haystack[$name])) {
				$child->reset();
			} else if ($child->isGroup()) {
				$child->fromArray($haystack[$name]);
			} else {
				$child->value = $haystack[$name];
			}
		}

		return true;

	}

}








abstract class Option extends Child
{

	

	




	protected $default;

	




	private $value;

	






	public $error_value;

	




	public $indent = false;

	




	public $tag;

	






	public $on_change;

	






	public $on_sanitize;

	






	public $on_html;

	

	






	protected function _get()
	{
		return $this->value;
	}

	

	







	protected function _set($value)
	{
		$this->value = $value;
	}

	

	







	abstract protected function _sanitize($value);

	

	






	abstract protected function _html();

	

	







	protected function _styles($instance_num)
	{
		return '';
	}

	

	







	protected function _scripts($instance_num)
	{
		return '';
	}

	

	








	public function __construct($name, $default, array $properties = array())
	{

		parent::__construct($name);

		
		$this->default = $default;

		foreach (array_intersect_key($properties, Func::objectGetVars($this)) as $name => $value) {
			$this->{$name} = $value;
		}

		







		$this->reset();

	}

	

	







	public function __get($name)
	{
		switch ($name) {
			case 'value':
				return $this->_get();
			default:
				if (isset($this->{$name})) {
					return $this->{$name};
				}
		}
		return parent::__get($name);
	}

	

	







	public function __set($name, $value)
	{
		parent::__set($name, $value);
		switch ($name) {
			case 'value':
				$this->_set($this->sanitize($value));
				break;
		}
	}

	

	







	public static function getObjectClass($type)
	{

		static $cache = array();
		if (isset($cache[$type])) {
			return $cache[$type];
		}

		$_type = Func::stringPascalCase($type);

		if (!(
			class_exists($class = '\\'.\Drone\Theme::getInstance()->class.'\Options\Option\\'.$_type) || 
			class_exists($class = __CLASS__.'\\'.$_type) || 
			class_exists($class = $_type) 
		)) {
			throw new \Exception("Option {$type} type doesn't exists.");
		}

		$cache[$type] = $class;
		return $class;

	}

	

	








	public function getCSSClass($class = __CLASS__, $suffix = '')
	{
		
		if (preg_match('/^(?P<class>[A-Z].+)\\\\Options\\\\Option\\\\(?P<name>[A-Z].+)$/', $class, $matches)) { 
			return Func::stringID("{$matches['class']}-option-{$matches['name']}-{$suffix}");
		} else {
			return Func::stringID("{$class}-{$suffix}");
		}
	}

	

	






	public function isOption()
	{
		return true;
	}

	

	






	public function isEmpty()
	{
		$value = $this->_get();
		return empty($value);
	}

	

	






	public function isDefault()
	{
		return $this->_get() === $this->default;
	}

	

	






	public function isError()
	{
		if ($this->error_value === null) {
			return false;
		}
		if (is_callable($this->error_value)) {
			$error_value = call_user_func_array($this->error_value, array($this, $this->_get()));
			return is_bool($error_value) ? $error_value : $this->_get() === $error_value;
		}
		return $this->_get() === $this->error_value;
	}

	

	




	public function reset()
	{
		$this->_set($this->default);
	}

	

	






	public function change($value)
	{
		$old_value = $this->_get();
		$new_value = $this->sanitize($value);
		if ($old_value !== $new_value && is_callable($this->on_change)) {
			call_user_func_array($this->on_change, array($this, $old_value, &$new_value));
		}
		$this->_set($new_value);
	}

	

	







	public function sanitize($value)
	{
		$_value = $this->_sanitize($value);
		if (is_callable($this->on_sanitize)) {
			call_user_func_array($this->on_sanitize, array($this, $value, &$_value));
		}
		return $_value;
	}

	

	






	public function html()
	{

		
		$_html = $this->_html();

		
		if (is_callable($this->on_html)) {
			call_user_func_array($this->on_html, array($this, &$_html));
		}

		
		return $_html;

	}

	

	






	public function styles()
	{
		static $instance_num = 0;
		return $this->_styles($instance_num++);
	}

	

	






	public function scripts()
	{
		static $instance_num = 0;
		return $this->_scripts($instance_num++);
	}

	

	







	public function importFromArray(&$haystack)
	{

		if (!is_array($haystack)) {
			return false;
		}
		if (($input_name = strstr($this->input_name, '[')) === false) {
			return false;
		}

		foreach (explode('][', trim($input_name, '[]')) as $name) {
			if (!isset($haystack[$name])) {
				$this->reset();
				return true;
			}
			$haystack =& $haystack[$name];
		}

		$this->_set($this->sanitize($haystack));
		return true;

		








	}

}



namespace Drone\Options\Group;
use Drone\Options\Group;
use Drone\Func;
use Drone\HTML;
use Drone\Options\Option;








class Theme extends Group
{

	

	





	public function html()
	{

		
		if ($this->label) {
			$output = HTML::table()->class('form-table drone-group');
			$tbody  = $output->addNew('tbody');
		} else {
			$output = $tbody = HTML::make();
		}

		foreach ($this->childs as $child) {

			if (!$child->isIncluded()) {

				
				continue;

			} else if ($child->isGroup() && !$child->label) {

				
				$tbody->add($child->html());

			} else {

				
				$row = HTML::tr()->class('drone-row')->valign('top');
				if ($child->isOption() && $child->isError()) {
					$row->addClass('drone-error');
				}
				if ($child->isOption() && $child->indent) {
					$row->addClass('drone-indent');
				}

				
				if ($child->label) {
					$row
						->addNew('th')->class('drone-label')->scope('row')
						->addNew('label')->add($child->label);
				}

				
				$option = $row
					->addNew('td')->colspan(!$child->label ? 2 : null)
					->addNew('div')->class('drone-option');

				
				if ($child->owner instanceof Option) {
					$option->attr(array(
						'data-drone-owner'       => $child->owner->input_name,
						'data-drone-owner-value' => json_encode((array)$child->owner_value)
					));
				}

				
				$option->add($child->html());

				
				if ($child->description) {
					$option->addNew('p')->class('description drone-description')->add($child->description);
				}

				$tbody->add($row);

			}

		}

		return $output;

	}

}








class Sysinfo extends Theme
{

	

	const SLUG = 'sysinfo';

	

	protected $instance;
	protected $notices = array();
	protected $update;

	

	





	public function __construct()
	{

		parent::__construct(self::SLUG);

		$this->instance = \Drone\Theme::getInstance();
		$this->included = !$this->instance->reseller_mode;
		$this->label    = __('System', 'website');

		
		$this->addOption('codeline', 'purchase_code', '', __('Purchase code', 'website'), __('Purchase code is required for seamless theme updates.', 'website'), array(
			'error_value' => function($option, $value) {
				return !preg_match('/^[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}$/i', $value);
			},
			'max_length'  => 36,
			'on_change'   => function() {
				\Drone\Theme::getInstance()->deleteTransient('update', 'base_theme');
				delete_site_transient('update_themes');
			},
			'on_sanitize' => function($option, $original_value, &$value) {
				if (strlen($value) < $option->max_length && preg_match('/^([a-f0-9]{8})-?([a-f0-9]{4})-?([a-f0-9]{4})-?([a-f0-9]{4})-?([a-f0-9]{12})$/i', $value, $matches)) {
					$value = implode('-', array_slice($matches, 1));
				}
			},
			'included'    => apply_filters('enable_update', true) && !is_multisite()
		));
		$this->addOption('boolean', 'debug_mode', $this->instance->debug_mode, __('Debug mode', 'website'), '', array('caption' => __('Debug mode', 'website')));
		$this->addOption('hidden', 'activation_time', time(), '', '', array('included' => false));

		
		if (is_admin()) {

			if (current_user_can('update_themes') && ($update_themes = get_site_transient('update_themes')) !== false) {
				$template = get_option('template');
				if (isset($update_themes->response[$template])) {
					$this->update = $update_themes->response[$template];
				}
			}

			$this->notices = array(
				'outdated_php'      => version_compare(PHP_VERSION, date('Y') >= 2017 ? '5.5' : '5.4') < 0,
				'version_corrupted' => $this->instance->base_theme->id != Func::stringID($this->instance->class) || !preg_match('/^[0-9]+\.[0-9]+(\.[0-9]+)?(-(alpha|beta|rc)(-?[\.0-9]+)?)?$/i', $this->instance->base_theme->version),
				'update_available'  => $this->update !== null
			);

		}

		

	}

	

	





	public function errorsCount()
	{
		return parent::errorsCount() + array_sum(array_map('intval', $this->notices));
	}

	

	





	public function html()
	{
		ob_start();
		require $this->instance->drone_dir.'/tpl/sysinfo.php';
		return HTML::make()->add(ob_get_clean(), parent::html());
	}

}








class Post extends Theme
{

	

	public $context  = 'advanced'; 
	public $priority = 'default';  

	

	





	public function addGroup($name, $label = '', $description = '', $context = 'advanced', $priority = 'default', $subsequent = '')
	{
		$group = parent::addGroup($name, $label, $description, $subsequent);
		$group->context  = $context;
		$group->priority = $priority;
		return $group;
	}

}








class Widget extends Group
{

	

	





	public function change($values)
	{
		parent::change($values);
		if (function_exists('icl_register_string')) {
			foreach ($this->childs as $name => $child) {
				if ($child->isOption() && $child instanceof Option\iI18n && $name != 'title') {
					icl_register_string(\Drone\Theme::getInstance()->theme->name, $child->input_name, $child->value);
				}
			}
		}
	}

	

	





	public function html()
	{

		$output = HTML::make();

		if ($styles = $this->styles()) {
			$output->addNew('style')->add($styles);
		}
		if ($scripts = $this->scripts()) {
			$output->addNew('script')->add($scripts);
		}

		foreach ($this->childs as $name => $child) {

			if (!$child->isIncluded()) {

				
				continue;

			} else if ($child->isGroup()) {

				
				$output->add($child->html());

			} else {

				
				$row = HTML::div()->class('drone-row');
				if ($child->indent) {
					$row->addClass('drone-indent');
				}

				
				if ($child->label) {
					$row->addNew('label')->class('drone-label')->add($child->label.':');
				}

				
				$option = $row->addNew('div')->class('drone-option');

				
				if ($child->owner instanceof Option) {
					$option->attr(array(
						'data-drone-owner'       => $child->owner->input_name,
						'data-drone-owner-value' => json_encode((array)$child->owner_value)
					));
				}

				
				$option->add($child->html());

				
				if ($child->description) {
					$option->addNew('p')->class('description drone-description')->add($child->description);
				}

				$output->add($row);

			}
		}

		return $output;

	}

}








class Shortcode extends Group
{

	

	





	public function html()
	{
		throw new \Exception('Not supported.');
	}

	

	






	public function getDefaults()
	{
		$defaults = array();
		foreach ($this->childs as $name => $child) {
			if ($child->isGroup()) {
				foreach ($child->getDefaults() as $key => $default) {
					$defaults[$name.'_'.$key] = $default;
				}
			} else {
				$defaults[$name] = $child->default;
			}
		}
		return $defaults;
	}

	

	





	public function toArray()
	{
		$haystack = array();
		foreach ($this->childs as $name => $child) {
			if ($child->isGroup()) {
				foreach ($child->toArray() as $key => $value) {
					$haystack[$name.'_'.$key] = $value;
				}
			} else {
				$haystack[$name] = $child->value;
			}
		}
		return $haystack;
	}

	

	





	public function fromArray(&$haystack, $compatybility_callback = null, array $compatybility_params = array())
	{

		$_haystack = $haystack;

		if (is_array($_haystack)) {
			foreach ($this->childs as $name => $child) {
				if (!$child->isGroup()) {
					continue;
				}
				foreach ($_haystack as $key => $value) {
					if (strpos($key, $name.'_') === 0) {
						$_haystack[$name][substr($key, strlen($name)+1)] = $value;
						unset($_haystack[$key]);
					}
				}
			}
		}

		return parent::fromArray($_haystack, $compatybility_callback, $compatybility_params);

	}

	

	






	public function tinyMCEControls()
	{
		$controls = array();
		foreach ($this->childs() as $child) {
			if ($child->isGroup()) {
				$controls[] = array(
					'type'    => 'fieldset',
					'label'   => $child->label,
					'classes' => 'drone-wp-skin-fix',
					'items'   => $child->tinyMCEControls()
				);
			} else if ($child instanceof Option\iShortcode) {
				$controls[] = $child->tinyMCEControl();
			}
		}
		return $controls;
	}

	

	






	public function vcControls()
	{
		$controls = array();
		foreach ($this->childs() as $child) {
			if ($child->isGroup()) {
				$controls = array_merge($controls, $child->vcControls());
			} else if ($child instanceof Option\iShortcode) {
				$control = $child->vcControl();
				if (($parent = $child->parent) !== null && $parent->label) {
					$control['group'] = $parent->label;
				}
				$controls[] = $control;
			}
		}
		return $controls;
	}

}








class Gallery extends Shortcode
{

	

	





	public function html()
	{

		$output = HTML::make();








		foreach ($this->childs as $name => $child) {

			if (!$child->isIncluded()) {

				
				continue;

			} else if ($child->isGroup()) {

				
				$output->add($child->html());

			} else {

				
				$row = HTML::label()->class('setting drone-row');
				if ($child->indent) {
					$row->addClass('drone-indent');
				}

				
				if ($child->label) {
					$row->addNew('span')->class('drone-label')->add($child->label);
				}

				
				$option = $row->addNew('div')->class('drone-option');

				
				if ($child->owner instanceof Option) {
					$option->attr(array(
						'data-drone-owner'       => $child->owner->input_name,
						'data-drone-owner-value' => json_encode((array)$child->owner_value)
					));
				}

				
				$option->add($child->html()->each(function(&$html) use ($child) {
					if (!$html instanceof HTML) {
						return;
					}
					if ($html->name !== null) {
						$html->data('setting', $child->attr_name);
					}
					if ($html->tag == 'input' && $html->type == 'number') {
						$html->type = 'text';
					}
				}));

				
				if ($child->description) {
					$option->addNew('p')->class('description drone-description')->add($child->description);
				}

				$output->add($row);

			}
		}

		return $output;

	}

}



namespace Drone\Options\Option;
use Drone\Options\Option;
use Drone\Func;
use Drone\HTML;
use Drone\Theme;








interface iShortcode
{

	

	






	public function tinyMCEControl();

	

	






	public function vcControl();

}








interface iI18n
{

	

	






	public function translate();

	

	







	public function translateWithContext($context);

}








interface iEncapsulated
{

	

	






	public function decapsulate();

}








abstract class Choice extends Option implements iShortcode
{

	

	public $options  = array(); 
	public $required = true;
	public $sanitize = true;

	

	





	protected function _sanitize($value)
	{
		$value = is_array($value) ? array_values($value) : (string)$value;
		if ($this->sanitize && (is_admin() || !is_callable($this->options))) {
			$options = $this->getOptions();
			if (is_array($value)) {
				$value = array_intersect($value, array_keys($options));
			} else if (!isset($options[$value])) {
				return $this->default;
			}
		}
		return $value;
	}

	

	






	protected function getOptions()
	{
		if (is_callable($this->options)) {
			if (($prototype_parent = $this->closestParent('Option\Prototype')) !== null) {
				$key = spl_object_hash($prototype_parent).'_'.$this->name;
			} else {
				$key = is_object($this->options) ? spl_object_hash($this->options) : (string)$this->options;
			}
			if (($options = wp_cache_get($key, __METHOD__)) === false) {
				$options = call_user_func_array($this->options, array($this));
				wp_cache_set($key, $options, __METHOD__);
			}
		} else {
			$options = $this->options;
		}
		if (!$this->required && !isset($options[$this->default])) {
			$options = array($this->default => '') + $options;
		}
		return $options;
	}

	

	










	public function value($name)
	{
		if (func_num_args() > 1) {
			$name = func_get_args();
		}
		return count(array_intersect((array)$this->value, (array)$name)) > 0;
	}

	

	






	public function values()
	{
		$value  = (array)$this->value;
		$values = array();
		foreach (array_keys($this->getOptions()) as $key) {
			$values[$key] = in_array($key, $value);
		}
		return $values;
	}

	

	





	public function tinyMCEControl()
	{
		$values = array();
		foreach ($this->getOptions() as $value => $label) {
			$values[] = array('text' => (string)$label, 'value' => (string)$value);
		}
		return array(
			'type'    => 'listbox',
			'name'    => $this->attr_name,
			'value'   => $this->default,
			'label'   => $this->label,
			'tooltip' => $this->description,
			'values'  => $values
		);
	}

	

	





	public function vcControl()
	{
		return array(
			'type'        => 'dropdown',
			'param_name'  => $this->attr_name,
			'std'         => $this->default,
			'value'       => array_flip($this->getOptions()),
			'admin_label' => true,
			'heading'     => $this->label,
			'description' => $this->description
		);
	}

}








abstract class Complex extends Option
{

	

	






	abstract protected function _options();

	

	





	protected function _get()
	{
		foreach ($this->default as $option => $default) {
			$value[$option] = isset($this->{$option}) ? $this->{$option}->value : $default;
		}
		return $value;
	}

	

	





	protected function _set($value)
	{
		foreach (array_keys($this->default) as $option) {
			if (isset($this->{$option})) {
				if (isset($value[$option])) {
					$this->{$option}->value = $value[$option];
				} else {
					$this->{$option}->reset();
				}
			}
		}
	}

	

	





	protected function _sanitize($value)
	{
		$_value = array();
		foreach ($this->default as $option => $default) {
			$_value[$option] = isset($this->{$option}) && isset($value[$option]) ? $this->{$option}->sanitize($value[$option]) : $default;
		}
		return $_value;
	}

	

	





	protected function _html()
	{
		if (($group = $this->closestParent('Group')) === null) {
			return;
		}
		$class = get_class($group);
		$group = new $class('');
		$group->parent = $this;
		$group->label  = '__';
		foreach (array_keys($this->default) as $option) {
			if (isset($this->{$option})) {
				$group->addChild(clone $this->{$option});
			}
		}
		return HTML::div()
			->addClass($this->getCSSClass(get_class($this)))
			->add($group->html());
	}

	

	


	protected function _styles($instance_num)
	{
		$styles = '';
		foreach (array_keys($this->default) as $option) {
			if (isset($this->{$option})) {
				$styles .= $this->{$option}->styles();
			}
		}
		return $styles;
	}

	

	


	protected function _scripts($instance_num)
	{
		$scripts = '';
		foreach (array_keys($this->default) as $option) {
			if (isset($this->{$option})) {
				$scripts .= $this->{$option}->scripts();
			}
		}
		return $scripts;
	}

	

	





	public function __construct($name, $default, array $properties = array())
	{
		parent::__construct($name, $default, $properties);
		foreach (array_intersect_key($this->_options(), $default) as $option_name => $option_type) {
			$option_class = Option::getObjectClass($option_type);
			$this->{$option_name} = new $option_class($option_name, $default[$option_name]);
			$this->{$option_name}->parent = $this;
		}
	}

	

	




	public function __clone()
	{
		foreach (array_keys($this->default) as $option) {
			if (isset($this->{$option})) {
				$this->{$option} = clone $this->{$option};
				$this->{$option}->parent = $this;
			}
		}
	}

	

	





	public function reset()
	{
		foreach (array_keys($this->default) as $option) {
			if (isset($this->{$option})) {
				$this->{$option}->reset();
			}
		}
	}

	

	






	public function option($name)
	{
		if (isset($this->default[$name], $this->{$name})) {
			return $this->{$name};
		}
	}

	

	







	public function value($name)
	{
		if (($option = $this->option($name)) !== null) {
			return $option->value;
		}
	}

	

	








	public function property($name)
	{
		_deprecated_function(__METHOD__, '5.6', __CLASS__.'::value');
		return $this->value($name);
	}

}








abstract class Prototype extends Option implements iEncapsulated
{

	

	protected $type       = 'text';
	protected $properties = array();
	protected $prototype;
	protected $options;

	

	





	protected function _get()
	{
		return array_map(function($option) { return $option->value; }, $this->options);
	}

	

	





	protected function _set($value)
	{
		$options = array();
		foreach ((array)$value as $index => $value) {
			$options[$index] = isset($this->options[$index]) ? $this->options[$index] : $this->newInstance($index);
			$options[$index]->value = $value;
		}
		$this->options = $options;
	}

	

	





	protected function _sanitize($value)
	{

		$value = empty($value) ? array() : (array)$value;

		
		unset($value['__n__']);

		
		foreach ($value as &$val) {
			$val = $this->prototype->sanitize($val);
		}
		unset($val);

		return $value;

	}

	

	





	protected function _styles($instance_num)
	{
		return $this->prototype->styles();
	}

	

	





	protected function _scripts($instance_num)
	{
		return $this->prototype->scripts();
	}

	

	





	public function __construct($name, $default, array $properties = array())
	{
		$this->setType(isset($properties['type']) ? $properties['type'] : $this->type, $default, $properties);
		parent::__construct($name, $default, $properties);
	}

	

	




	public function __clone()
	{
		$this->prototype = clone $this->prototype;
		$this->prototype->parent = $this;
		foreach ($this->options as $index => $option) {
			$this->options[$index] = clone $option;
			$this->options[$index]->parent = $this;
		}
	}

	

	





	public function isDefault()
	{
		return count($this->options) == 0;
	}

	

	





	public function reset()
	{
		$this->options = array();
	}

	

	







	protected function newInstance($name)
	{
		$class  = get_class($this->prototype);
		$option = new $class($name, $this->default, $this->properties);
		$option->parent = $this;
		return $option;
	}

	

	








	public function setType($type, $default, array $properties = array())
	{
		$class = Option::getObjectClass($type);
		$this->type       = $type;
		$this->default    = $default;
		$this->properties = $properties;
		$this->prototype  = new $class('__n__', $default, $properties);
		$this->prototype->parent = $this;
		$this->reset();
	}

	

	





	public function decapsulate()
	{
		return null;
	}

}








class Hidden extends Option
{

	

	





	protected function _sanitize($value)
	{
		return (string)$value;
	}

	

	





	protected function _html()
	{
		return HTML::makeInput('hidden', $this->input_name, $this->value)
			->addClass($this->getCSSClass(__CLASS__));
	}

	

	





	public function isVisible()
	{
		return false;
	}

}








class Text extends Option implements iShortcode, iI18n
{

	

	public $max_length    = false;
	public $password      = false;
	public $required      = false;
	public $trim          = true;
	public $allowed_chars = ''; 
	public $regexpr       = '';

	

	





	protected function _sanitize($value)
	{
		$value = (string)$value;
		if ($this->trim) {
			$value = trim($value);
		}
		if ($this->allowed_chars) {
			$value = preg_replace('/[^'.str_replace('/', '\/', $this->allowed_chars).']/', '', $value);
		}
		if ($this->max_length && is_int($this->max_length) && strlen($value) > $this->max_length) {
			$value = substr($value, 0, $this->max_length);
		}
		if ($this->required && !$value) {
			return $this->default;
		}
		if ($this->regexpr && !preg_match($this->regexpr, $value)) {
			return $this->default;
		}
		return $value;
	}

	

	





	protected function _html()
	{
		return HTML::makeInput($this->password ? 'password' : 'text', $this->input_name, $this->value)
			->addClass($this->getCSSClass(__CLASS__))
			->title(!$this->password && $this->default ? __('Default', 'website').': '.$this->default : null);
	}

	

	





	public function tinyMCEControl()
	{
		return array(
			'type'    => 'textbox',
			'name'    => $this->attr_name,
			'value'   => $this->default,
			'label'   => $this->label,
			'tooltip' => $this->description
		);
	}

	

	





	public function vcControl()
	{
		return array(
			'type'        => 'textfield',
			'param_name'  => $this->attr_name,
			'value'       => $this->default,
			'admin_label' => true,
			'heading'     => $this->label,
			'description' => $this->description
		);
	}

	

	





	public function translate()
	{
		return $this->translateWithContext($this->input_name);
	}

	

	





	public function translateWithContext($context)
	{
		if (function_exists('icl_t')) {
			return icl_t(Theme::getInstance()->theme->name, $context, $this->value);
		}
		return $this->value;
	}

}








class Codeline extends Text
{

	

	





	protected function _html()
	{
		return parent::_html()
			->addClass($this->getCSSClass(__CLASS__), 'code')
			->spellcheck('false');
	}

}








class Memo extends Text
{

	

	





	protected function _html()
	{
		return HTML::makeTextarea($this->input_name, $this->value)
			->addClass($this->getCSSClass(__CLASS__))
			->rows(10)
			->cols(40);
	}

}








class Editor extends Text
{

	

	public $media = true;
	public $rows  = 15;

	

	





	protected function _html()
	{
		return HTML::div()
			->addClass($this->getCSSClass(__CLASS__))
			->add(
				Func::functionGetOutputBuffer('wp_editor', $this->value, Func::stringID($this->input_name), array(
					'media_buttons' => $this->media,
					'textarea_name' => $this->input_name,
					'textarea_rows' => $this->rows
				))
			);
	}

}








class Code extends Memo
{

	

	





	protected function _html()
	{
		return parent::_html()
			->addClass($this->getCSSClass(__CLASS__), 'code')
			->spellcheck('false');
	}

}








class Number extends Option implements iShortcode
{

	

	public $required = true;
	public $min      = false;
	public $max      = false;
	public $step     = 1;
	public $float    = false;
	public $unit     = '';

	

	





	protected function _sanitize($value)
	{
		if (!$this->required && $value === '') {
			return $value;
		}
		if (!is_int($value) && (!$this->float || !is_float($value))) {
			$value = (string)$value;
			$value = str_replace(',', '.', $value);
			$value = preg_replace('/[^-\.0-9]/', '', $value);
			if (is_numeric($value)) {
				$value = $this->float ? floatval($value) : intval($value);
			} else {
				return $this->default;
			}
		}
		if ($this->min !== false) {
			$value = max($value, $this->min);
		}
		if ($this->max !== false) {
			$value = min($value, $this->max);
		}
		return $value;
	}

	

	





	protected function _html()
	{
		$input = HTML::makeInput('number', $this->input_name, $this->value)
			->addClass($this->getCSSClass(__CLASS__), 'code')
			->title($this->default ? __('Default', 'website').': '.$this->default.$this->unit : null);
		if (is_numeric($this->min)) {
			$input->min = $this->min;
		}
		if (is_numeric($this->max)) {
			$input->max = $this->max;
		}
		$input->step = $this->float ? 'any' : $this->step;
		if ($this->unit) {
			$input = HTML::make()->add(
				$input, ' ',
				HTML::span($this->unit)
			);
		}
		return $input;
	}

	

	





	public function tinyMCEControl()
	{
		$control = array(
			'type'    => 'textbox',
			'name'    => $this->attr_name,
			'value'   => (string)$this->default,
			'tooltip' => $this->description,
			'classes' => $this->getCSSClass(__CLASS__)
		);
		if (!$this->float && is_numeric($this->min) && is_numeric($this->max)) {
			$control['maxLength'] = max(strlen($this->min), strlen($this->max));
		}
		return array(
			'type'   => 'panel',
			'layout' => 'flex',
			'label'  => $this->label,
			'items'  => array($control, array(
				'type'    => 'label',
				'text'    => (string)$this->unit,
				'classes' => $this->getCSSClass(__CLASS__, 'unit')
			))
		);
	}

	

	





	public function vcControl()
	{
		return array(
			'type'        => 'textfield',
			'param_name'  => $this->attr_name,
			'value'       => $this->default,
			'admin_label' => true,
			'heading'     => $this->label,
			'description' => $this->description
		);
	}

}








class Boolean extends Option implements iShortcode
{

	

	const TRUE_VALUE = 'on';

	

	public $caption  = '';
	public $disabled = false;

	

	





	protected function _sanitize($value)
	{
		$value = is_string($value) ? Func::stringToBool($value) : (bool)$value;
		if ($this->disabled) {
			return $this->default;
		}
		return $value;
	}

	

	





	protected function _html()
	{
		$checkbox = HTML::makeCheckboxSingle($this->input_name, $this->caption, $this->value)
			->addClass($this->getCSSClass(__CLASS__));
		if ($this->disabled) {
			$checkbox->child(0)->child(1)->disabled = true;
			if ($this->value) {
				$checkbox->child(0)->child(0)->value = self::TRUE_VALUE;
			}
		}
		return $checkbox;
	}

	

	






	public function toString()
	{
		return Func::boolToString($this->value);
	}

	

	





	public function tinyMCEControl()
	{
		return array(
			'type'    => 'checkbox',
			'name'    => $this->attr_name,
			'checked' => $this->default,
			'label'   => $this->label,
			'tooltip' => $this->description,
			'text'    => $this->caption
		);
	}

	

	





	public function vcControl()
	{
		return array(
			'type'        => 'checkbox',
			'param_name'  => $this->attr_name,
			'std'         => Func::boolToString($this->default),
			'value'       => array($this->caption => 'true'),
			'admin_label' => true,
			'heading'     => $this->label,
			'description' => $this->description
		);
	}

}








class Select extends Choice
{

	

	public $groups   = array();
	public $multiple = false;

	

	





	protected function _sanitize($value)
	{
		if ($this->multiple) {
			if (empty($value)) {
				$value = array();
			} else if (is_string($value) && strpos($value, ',') !== false) {
				$value = array_map('trim', explode(',', $value));
			}
		} else {
			if (is_array($value) && isset($value[0])) {
				$value = $value[0];
			}
		}
		return parent::_sanitize($value);
	}

	

	





	protected function _html()
	{

		$options = $this->getOptions();
		$select  = HTML::makeSelect($this->input_name, $this->value, $options, $this->groups, $this->multiple);

		if ($this->multiple) {
			$select->child(1)->addClass($this->getCSSClass(__CLASS__));
		} else {
			$select->addClass($this->getCSSClass(__CLASS__));
			if (isset($options[$this->default]) && $options[$this->default]) {
				$select->title = __('Default', 'website').': '.$options[$this->default];
			}
		}

		return $select;

	}


	

	





	protected function getOptions()
	{

		$_options = parent::getOptions();

		if (count($_options) == count($_options, COUNT_RECURSIVE)) {
			return $_options;
		}

		$options = array();
		foreach ($_options as $value => $label) {
			if (is_array($label)) {
				$options += $label;
				$groups[$value] = array_keys($label);
				unset($_options[$value]);
			}
		}
		$options += $_options;

		if (isset($groups)) {
			$this->groups = $groups;
		}

		return $options;

	}

	

	





	public function tinyMCEControl()
	{
		if (!$this->multiple) {
			return parent::tinyMCEControl();
		}
		throw new \Exception('Not supported.');

	}

	

	





	public function vcControl()
	{
		if (!$this->multiple) {
			return parent::vcControl();
		}
		throw new \Exception('Not supported.');
	}

}








class Group extends Select
{

	

	public $style    = 'vertical';
	public $sortable = false;
	public $disabled = array();

	

	





	protected function _sanitize($value)
	{
		$value = parent::_sanitize($value);
		if ($this->multiple) {
 			foreach ($this->disabled as $disabled) {
				$key = array_search($disabled, $value);
				if (in_array($disabled, $this->default)) {
					if ($key === false) {
						$value[] = $disabled;
					}
				} else {
					if ($key !== false) {
						unset($value[$key]);
					}
				}
			}
			$value = array_values($value);
		} else {
			if ($value !== $this->default && (in_array($value, $this->disabled) || in_array($this->default, $this->disabled))) {
				return $this->default;
			}
		}
		return $value;
	}

	

	





	protected function _html()
	{
		if ($this->multiple) {
			$options = $this->getOptions();
			if ($this->sortable) {
				$checked_options = array();
				foreach ($this->value as $value) {
					if (isset($options[$value])) {
						$checked_options[$value] = $options[$value];
					}
				}
				$options = $checked_options + array_diff_key($options, $checked_options);
			}
			$group = HTML::makeCheckboxGroup($this->input_name, $this->value, $options, '');
		} else {
			$group = HTML::makeRadioGroup($this->input_name, $this->value, $this->getOptions(), '');
		}
		if (!empty($this->disabled)) {
			foreach ($group->childs() as $child) {
				if ($child instanceof HTML && $child->tag == 'label') {
					$input = $child->child(0);
					if (in_array($input->value, $this->disabled)) {
						$input->disabled = true;
						if ($input->checked) {
							$child->insert(HTML::makeInput('hidden', $input->name, $input->value)->id(null));
						}
					}
				}
			}
		}
		$group->addClass($this->getCSSClass(__CLASS__), $this->getCSSClass(__CLASS__, $this->style));
		if ($this->multiple && $this->sortable) {
			$group->addClass($this->getCSSClass(__CLASS__, 'sortable'));
		}
		return $group;
	}

	

	





	public function tinyMCEControl()
	{
		throw new \Exception('Not supported.');
		


















	}

	

	





	public function vcControl()
	{
		throw new \Exception('Not supported.');
	}

}








class Image extends Codeline
{

	

	public $title;
	public $filter = 'bmp|jpe?g|png|gif|ico';

	

	





	protected function _sanitize($value)
	{
		$value = parent::_sanitize($value);
		$filter = is_array($this->filter) ? implode('|', $this->filter) : $this->filter;
		if ($filter && !preg_match('/\.('.$filter.')$/i', parse_url($value, PHP_URL_PATH))) {
			return $this->default;
		}
		return $value;
	}

	

	





	protected function _html()
	{
		return HTML::div()
			->addClass($this->getCSSClass(__CLASS__))
			->data('title', $this->title ? $this->title : __('Select image', 'website'))
			->add(
				parent::_html(), ' ',
				HTML::a()->class('button select')->add(__('Select', 'website')), ' ',
				HTML::a()->class('button clear')->add(__('Clear', 'website'))
			);
	}

	

	






	public function getAttachmentID()
	{
		return $this->value ? Func::wpGetAttachmentID($this->value) : false;
	}

}








class Attachment extends Option
{

	

	public $title;
	public $type = 'image';

	

	





	protected function _sanitize($value)
	{
		if ($this->type == 'image' && is_string($value) && preg_match('/\.(bmp|jpe?g|png|gif|ico)$/i', parse_url($value, PHP_URL_PATH))) {
			return Func::wpGetAttachmentID($value) ?: 0;
		}
		$value = (int)$value;
		if ($value !== 0 && get_post($value) === null) {
			return $this->default;
		}
		return $value;
	}

	

	





	protected function _html()
	{
		return HTML::div()
			->addClass($this->getCSSClass(__CLASS__))
			->data('title', $this->title ? $this->title : sprintf(__('Select %s', 'website'), $this->type ? $this->type : __('file', 'website')))
			->data('type', $this->type)
			->add(
				HTML::makeInput('hidden', $this->input_name, $this->value),
				HTML::span($this->getTitle()), ' ',
				HTML::a()->class('button select')->add(__('Select', 'website')), ' ',
				HTML::a()->class('button clear')->add(__('Clear', 'website'))
			);
	}

	

	






	protected function getTitle()
	{
		return ($post = $this->post()) === null ? '&nbsp;' : "<code>{$post->post_mime_type}</code> {$post->post_title}";
	}

	

	






	public function post()
	{
		if ($this->value !== 0) {
			return get_post($this->value);
		}
	}

	

	







	public function uri($size = 'full')
	{
		if ($this->value !== 0 && ($image_src = wp_get_attachment_image_src($this->value, $size)) !== false) {
			return $image_src[0];
		} else {
			return '';
		}
	}

	

	







	public function size($size = 'full')
	{
		if ($this->value === 0 || $this->type != 'image' || ($image_src = wp_get_attachment_image_src($this->value, $size)) === false) {
			return false;
		}
		return array('width' => $image_src[1], 'height' => $image_src[2]);
	}

	

	








	public function image($size = 'full', array $attr = array())
	{
		if ($this->value === 0 || $this->type != 'image') {
			return '';
		}
		return wp_get_attachment_image($this->value, $size, false, $attr);
	}

}










class ImageSelect extends Choice
{

	

	





	public $font_path = '';

	







	public $style = 'default';

	

	





	protected function _sanitize($value)
	{
		$value = (string)$value;
		return parent::_sanitize($value);
	}

	

	





	protected function _html()
	{

		
		$html = HTML::div()->addClass($this->getCSSClass(__CLASS__));

		
		$html->add(HTML::makeInput('hidden', $this->input_name, $this->value));

		
		$html->add($this->getImageHTML($this->value)->class('current'));

		
		$options = $html->addNew('div')->addClass('options', $this->style);
		foreach (array_keys($this->getOptions()) as $value) {
			$options->add($this->getImageHTML($value));
		}

		return $html;

	}

	

	





	protected function _styles($instance_num)
	{

		static $fonts = array();

		if (($family = $this->getFontFamily()) === false || in_array($family, $fonts)) {
			return '';
		}

		$fonts[] = $family;
		$font_pi = pathinfo($this->font_path);

		$style = Func::cssFontFace(
			Theme::getInstance()->template_dir.'/'.$font_pi['dirname'],
			Theme::getInstance()->template_uri.'/'.$font_pi['dirname'],
			$font_pi['filename'],
			$family
		).
<<<"EOS"
			i[class^="mce-i-{$family}-"],
			i[class*=" mce-i-{$family}-"] {
				font-family: {$family};
			}
EOS
		;

		foreach ($this->getOptions() as $value => $image_path) {
			if (is_int($image_path)) {
				$style .= sprintf('.mce-i-%s-%s:before { content: "\\%x"; }', $family, $value, $image_path);
			}
		}

		return $style;

	}

	

	






	protected function getFontFamily()
	{
		if (!$this->font_path) {
			return false;
		}
		return 'font-'.hash('crc32', $this->getCSSClass(__CLASS__).$this->font_path);
	}

	

	







	protected function getImageHTML($value = '')
	{
		$options = $this->getOptions();
		if ($value == '') { 
			$values     = array_values($options);
			$image_path = $values[count($values)-1];
		} else {
			$image_path = $options[$value];
		}
		$html = HTML::a()->data('value', $value);
		if (is_int($image_path) && ($family = $this->getFontFamily()) !== false) {
			$html->addnew('i')->class("mce-i-{$family}-{$value}");
			
		} else {
			$html->addNew('img')->src($image_path)->alt($value);
		}
		return $html;
	}

	

	










	public function imageURI($path, $ext = 'png', $prefix = '', $size = 'full')
	{
		if (!$this->value) {
			return '';
		}
		if (is_numeric($this->value)) {
			return ($image_src = wp_get_attachment_image_src($this->value, $size)) !== false ? $image_src[0] : '';
		} else {
			$path = "/{$path}/{$prefix}{$this->value}.{$ext}";
			return file_exists(Theme::getInstance()->template_dir.$path) ? Theme::getInstance()->template_uri.$path : '';
		}
	}

	

	










	public function imageHTML($path, $ext = 'png', $prefix = '', $size = 'full')
	{
		if (!$this->value) {
			return;
		}
		$image = HTML::img();
		if (is_numeric($this->value)) {
			if (($image_src = wp_get_attachment_image_src($this->value, $size)) === false) {
				return;
			}
			list($image->src, $image->width, $image->height) = $image_src;
			$image->alt = pathinfo($image_src[0], PATHINFO_FILENAME);
		} else {
			$path = "/{$path}/{$prefix}{$this->value}.{$ext}";
			if (!file_exists(Theme::getInstance()->template_dir.$path)) {
				return;
			}
			if (($is = getimagesize(Theme::getInstance()->template_dir.$path)) !== false) {
				list($image->width, $image->height) = $is;
			}
			$image->src = Theme::getInstance()->template_uri.$path;
			$image->alt = $this->value;
		}
		return $image;
	}

	

	












	public static function dirToOptions($path, $filter = array('png', 'jpg', 'jpeg', 'gif'), $prefix = '')
	{
		$_filter = is_array($filter) ? implode(',', $filter) : $filter;
		if (($options = wp_cache_get($path.$_filter.$prefix, __METHOD__)) !== false) {
			return $options;
		}
		$options = Func::filesList(Theme::getInstance()->template_dir.'/'.$path, $filter, function(&$i, &$bn, $pi) use ($path, $prefix) {
			$i  = $prefix.$pi['filename'];
			$bn = Theme::getInstance()->template_uri.'/'.$path.'/'.$bn;
		});
		wp_cache_set($path.$_filter.$prefix, $options, __METHOD__);
		return $options;
	}

	

	











	public static function mediaToOptions($size, $format = '')
	{
		$size  = array_map('intval', (array)$size);
		$_size = implode(',', $size);
		if (($options = wp_cache_get($_size.$format, __METHOD__)) !== false) {
			return $options;
		}
		$attachments = get_posts(array(
			'numberposts'    => -1,
			'post_type'      => 'attachment',
			'post_mime_type' => rtrim('image/'.$format, '/'),
			'post_status'    => 'any',
			'post_parent'    => null
		));
		$options = array();
		foreach ($attachments as $attachment) {
			list($src, $width, $height) = wp_get_attachment_image_src($attachment->ID, 'full');
			foreach ($size as $_size) {
				if ($width == $_size && $height == $_size) {
					$options[$attachment->ID] = $src;
					break;
				}
			}
		}
		wp_cache_set($_size.$format, $options, __METHOD__);
		return $options;
	}

	

	












	public static function cssToOptions($path, $class_prefix = 'icon-', $prefix = '')
	{
		if (($options = wp_cache_get($path.$class_prefix.$prefix, __METHOD__)) !== false) {
			return $options;
		}
		$template_dir_path = Theme::getInstance()->template_dir.'/'.$path;
		$options = array();
		if (file_exists($template_dir_path) && ($css = @file_get_contents($template_dir_path)) !== false) {
			if (preg_match_all(
				
				'/\.'.preg_quote($class_prefix, '/').'(?P<name>[-_a-z0-9]+)[\s\.:][^\{\}]*\{[^\}]*content *: *(?P<q>["\'])(?P<code>(?:(?=\\\.)..|(?:(?!\2).))+)\2[^\}]*\}/is', 
				$css, $matches, PREG_SET_ORDER
			)) {
				foreach ($matches as $match) {
					$code = preg_replace('/^\\\/', '', $match['code']);
					$options[$prefix.$match['name']] = strlen($code) == 1 ? ord($code) : (int)hexdec($code);
				}
			}
		}
		wp_cache_set($path.$class_prefix.$prefix, $options, __METHOD__);
		return $options;
	}

	

	











	public static function jsonToOptions($path, $prefix = '')
	{
		if (($options = wp_cache_get($path.$prefix, __METHOD__)) !== false) {
			return $options;
		}
		$template_dir_path = Theme::getInstance()->template_dir.'/'.$path;
		$options = array();
		if (file_exists($template_dir_path)) {
			if (($json = @file_get_contents($template_dir_path)) !== false && ($config = json_decode($json)) !== null) {
				if (isset($config->glyphs) && is_array($config->glyphs)) {
					foreach ($config->glyphs as $glyph) {
						if (isset($glyph->css, $glyph->code)) {
							$options[$prefix.$glyph->css] = (int)$glyph->code;
						}
					}
				}
			}
		}
		wp_cache_set($path.$prefix, $options, __METHOD__);
		return $options;
	}

	

	





	public function tinyMCEControl()
	{
		$control = parent::tinyMCEControl();
		$family  = $this->getFontFamily();
		foreach ($control['values'] as &$value) {
			if (is_numeric($value['text'])) {
				if ($family !== false) {
					$value['icon'] = $family.'-'.$value['value'];
				}
				$value['text'] = $value['value'];
			} else {
				$value['icon']  = 'null';
				$value['image'] = $value['text'];
				$value['text']  = is_numeric($value['value']) ? pathinfo($value['text'], PATHINFO_FILENAME) : $value['value'];
			}
		}
		unset($value);
		return $control;
	}

	

	





	public function vcControl()
	{
		$control = parent::vcControl();
		$control['value'] = array();
		foreach ($this->getOptions() as $value => $label) {
			if (is_numeric($label)) {
				$control['value'][$value] = $value;
			} else {
				$control['value'][$value] = is_numeric($value) ? pathinfo($label, PATHINFO_FILENAME) : $value;
			}
		}
		return $control;
	}

}








class Post extends Select
{

	

	





	protected function _sanitize($value)
	{
		$value = parent::_sanitize($value);
		if ($this->multiple) {
			$value = array_filter(array_map('intval', $value), function($i) { return $i > 0; });
		} else {
			$value = (int)$value;
			if ($value <= 0) {
				return $this->default;
			}
		}
		return $value;
	}

	

	





	protected function _html()
	{
		if ($this->multiple) {
			parent::_html();
		}
		$admin_url = esc_url(add_query_arg(array('post' => '%id%', 'action' => 'edit'), admin_url('post.php')));
		return HTML::div()
			->addClass($this->getCSSClass(__CLASS__))
			->add(
				parent::_html(), '<br />',
				HTML::a()
					->data('admin-url', $admin_url)
					->href($this->value > 0 ? str_replace('%id%', $this->value, $admin_url) : '')
					->add(__('Edit', 'website'), ' &rarr;')
			);
	}

	

	






	public function getContent()
	{
		if (!$this->multiple && $this->value > 0 && ($post = get_post($this->value)) !== null) {
			return Func::wpProcessContent($post->post_content);
		}
	}

}








class Color extends Option implements iShortcode
{

	

	public $required    = true;
	public $placeholder = '';

	

	





	protected function _sanitize($value)
	{
		if (!$this->required && $value === '') {
			return $value;
		}
		if (($dec = Func::cssColorToDec($value)) === false) {
			return $this->default;
		}
		return Func::cssDecToColor(array_slice($dec, 0, 3));;
	}

	

	





	protected function _html()
	{
		return HTML::makeInput('text', $this->input_name, $this->value)
			->addClass($this->getCSSClass(__CLASS__), 'code')
			->data('settings', array(
				'required'          => $this->required,
				'hash'              => true,
				'pickerBorderColor' => '#ccc',
				'pickerInsetColor'  => '#dfdfdf',
				'pickerFaceColor'   => '#f7f7f7'
			))
			->title($this->default ? __('Default', 'website').': '.strtoupper($this->default) : null)
			->placeholder($this->placeholder);
	}

	

	


	public function isDefault()
	{
		return strtoupper($this->value) === strtoupper($this->default);
	}

	

	





	public function tinyMCEControl()
	{
		return array(
			'type'    => 'textbox',
			'name'    => $this->attr_name,
			'value'   => $this->default,
			'label'   => $this->label,
			'tooltip' => $this->description,
			'classes' => $this->getCSSClass(__CLASS__)
		);
	}

	

	





	public function vcControl()
	{
		return array(
			'type'        => 'colorpicker',
			'param_name'  => $this->attr_name,
			'value'       => $this->default,
			'admin_label' => true,
			'heading'     => $this->label,
			'description' => $this->description
		);
	}

}








class Collection extends Prototype
{

	

	public $trim_default = true;
	public $sortable     = true;
	public $unique_index = false;
	public $index_prefix = '';

	

	





	protected function _sanitize($value)
	{

		$value = parent::_sanitize($value);

		
		if ($this->trim_default && count($value) > 0) {
			$keys = array_keys($value);
			$i = 0;
			while (isset($value[$keys[$i]]) && $value[$keys[$i]] === $this->default) {
				unset($value[$keys[$i++]]);
			}
			$i = count($keys)-1;
			while (isset($value[$keys[$i]]) && $value[$keys[$i]] === $this->default) {
				unset($value[$keys[$i--]]);
			}
		}

		
		if (!$this->unique_index) {
			$value = array_values($value);
		}

		return $value;

	}

	

	





	protected function _html()
	{

		$html = HTML::div()
			->class($this->getCSSClass(__CLASS__))
			->data('sortable', Func::boolToString($this->sortable))
			->data('index-prefix', $this->index_prefix);

		
		$ol = $html->addNew('ol')->class('items');
		foreach ($this->options as $option) {
			$ol->addNew('li')->add(
				HTML::div($option->html()),
				HTML::a()->class('button delete')->add(__('Delete', 'website'))
			);
		}

		
		$html->addNew('div')
			->class('prototype')
			->add(
				HTML::div($this->prototype->html()),
				HTML::a()->class('button delete')->add(__('Delete', 'website'))
			);

		
		$html->addNew('div')
			->class('controls')
			->addNew('a')->class('button add')->add(__('Add new', 'website'));

		return $html;

	}

	

	







	public function option($index)
	{
		if (isset($this->options[$index])) {
			return $this->options[$index];
		}
	}

	

	







	public function value($index)
	{
		if (($option = $this->option($index)) !== null) {
			return $option->value;
		}
	}

}








class ConditionalTags extends Prototype
{

	

	





	protected $option_cache = false;

	





	public $has_default = true;

	





	public $tags_filter;

	





	public $extended = false;

	

	





	protected function _sanitize($value)
	{

		$value = parent::_sanitize($value);

		
		foreach (array_keys($value) as $tag) {
			if (strpos($tag, '__') === 0) {
				unset($value[$tag]);
			}
		}

		
		foreach (array_keys($value) as $tag) {

			if ($tag == 'woocommerce_product') {
				$value['post_type_product'] = $value[$tag];
				unset($value[$tag]);
			}

			else if (strpos($tag, 'author_') === 0 && preg_match('/^author_(?P<id>[0-9]+)$/', $tag, $author)) {
				$value['author_post_'.$author['id']] = $value[$tag];
				unset($value[$tag]);
			}

		}

		
		if ($this->has_default && !isset($value['default'])) {
			$value['default'] = $this->default;
		}

		return $value;

	}

	

	





	protected function _html()
	{

		
		$tags = $this->extended ? self::getTagsListEx() : self::getTagsList();

		
		if ($this->tags_filter !== null) {
			foreach (array_keys($tags) as $tag) {
				if (
					(is_string($this->tags_filter) && !preg_match($this->tags_filter, $tag)) ||
					(is_callable($this->tags_filter) && !call_user_func($this->tags_filter, $tag))
				) {
					unset($tags[$tag]);
				}
			}
		}

		
 		foreach (array_keys(array_diff_key($this->options, $tags)) as $tag) {
			if ($this->has_default && $tag == 'default') {
				continue;
			}
			$tags[$tag] = array(
				'caption' => '~'.$tag,
				'group'   => __('Inactive', 'website')
			);
		}

		
		$options = array('' => __('Select condition...', 'website'));
		$groups  = array();
		foreach ($tags as $tag => $data) {
			$options[$tag] = $data['caption'];
			$groups[$data['group']][] = $tag;
		}

		
		$html = HTML::div()
			->class($this->getCSSClass(__CLASS__))
			->data('name', $this->input_name);

		
		$ul = $html->addNew('ul')
			->class('conditions');

		
		if ($this->has_default) {
			$ul->addNew('li')
				->class('default')
				->addNew('div')
					->add($this->options['default']->html());
		}

		
		foreach ($groups as $group_label => $group_tags) {
			foreach ($group_tags as $tag) {
				if (!isset($this->options[$tag])) {
					continue;
				}
				$ul->addNew('li')
					->add(
						HTML::a()->class('button delete')->add(__('Delete', 'website')),
						HTML::label(sprintf(
							__('On %s', 'website').':',
							HTML::span($tags[$tag]['caption'])->title($group_label).
							HTML::makeSelect(null, $tag, $options, $groups)->css('display', 'none')
						)),
						HTML::div($this->options[$tag]->html())
					);
			}
		}

		
		$html->addNew('div')
			->class('controls')
			->addNew('a')->class('button customize')->add(__('Customize on...', 'website'));

		
		$html->addNew('div')
			->class('prototype')
			->add(
				HTML::a()->class('button delete')->css('display', 'none')->add(__('Delete', 'website')),
				HTML::label(sprintf(
					__('On %s', 'website').':',
					HTML::span()->css('display', 'none').
					HTML::makeSelect(null, '', $options, $groups)
				)),
				HTML::div($this->prototype->html())
			);

		return $html;

	}

	

	





	public function isDefault()
	{
		if ($this->has_default) {
			return count($this->options) == 1 && isset($this->options['default']) && $this->options['default']->isDefault();
		} else {
			return count($this->options) == 0;
		}
	}

	

	





	public function reset()
	{
		if ($this->has_default) {
			$this->options = array('default' => isset($this->options['default']) ? $this->options['default'] : $this->newInstance('default'));
			$this->options['default']->reset();
		} else {
			$this->options = array();
		}
	}

	

	







	public function option($tag = null)
	{

		
		if ($tag !== null) {
			return isset($this->options[$tag]) ? $this->options[$tag] : null;
		}

		if ($this->option_cache === false) {

			
			$tags = array();
			foreach (array_keys($this->options) as $tag) {
				if (($_tag = self::getTag($tag)) !== false) {
					$tags[$tag] = $_tag;
				}
			}

			
			uksort($tags, function($a, $b) use ($tags) {
				$order = $tags[$a]['priority'] - $tags[$b]['priority'];
				if ($order == 0) {
					$order = strnatcmp($a, $b);
				}
				return $order;
			});

			
			$this->option_cache = isset($this->options['default']) ? $this->options['default'] : null;
			foreach ($tags as $tag => $tag_data) {
				if (call_user_func($tag_data['callback'])) {
					$this->option_cache = $this->options[$tag];
					break;
				}
			}

		}

		return $this->option_cache;

	}

	

	











	public function value($tag = null, $fallback = null)
	{
		if (($option = $this->option($tag)) !== null) {
			return $option->value;
		}
		switch ($fallback) {
			case '__default': return isset($this->options['default']) ? $this->options['default']->value : null;
			default:          return $fallback;
		}
	}

	

	





	public function decapsulate()
	{
		return $this->option();
	}

	

	






	public static function getTagsList()
	{

		static $tags;

		
		if (!isset($tags)) {
			$tags['front_page'] = array(
				'caption' => __('Front page', 'website'),
				'group'   => __('General', 'website')
			);
			$tags['blog'] = array(
				'caption' => __('Blog / archive', 'website'),
				'group'   => __('General', 'website')
			);
			$tags['author'] = array(
				'caption' => __('Author', 'website'),
				'group'   => __('General', 'website')
			);
			$tags['search'] = array(
				'caption' => __('Search', 'website'),
				'group'   => __('General', 'website')
			);
			$tags['404'] = array(
				'caption' => __('Not found page (404)', 'website'),
				'group'   => __('General', 'website')
			);
		}

		
		if (!isset($tags['bbpress']) && Theme::isPluginActive('bbpress')) {
			$tags['bbpress_forum'] = array(
				'caption' => __('Forum', 'website'),
				'group'   => __('General', 'website')
			);
			$tags['bbpress_topic'] = array(
				'caption' => __('Topic', 'website'),
				'group'   => __('General', 'website')
			);
			$tags['bbpress'] = array(
				'caption' => __('bbPress page', 'website'),
				'group'   => __('General', 'website')
			);
		}

		
		if (!isset($tags['woocommerce']) && Theme::isPluginActive('woocommerce')) {
			$tags['woocommerce_shop'] = array(
				'caption' => __('Shop', 'website'),
				'group'   => __('General', 'website')
			);
			$tags['woocommerce_cart'] = array(
				'caption' => __('Cart', 'website'),
				'group'   => __('General', 'website')
			);
			$tags['woocommerce_checkout'] = array(
				'caption' => __('Checkout', 'website'),
				'group'   => __('General', 'website')
			);
			$tags['woocommerce_order_received_page'] = array(
				'caption' => __('Order received page', 'website'),
				'group'   => __('General', 'website')
			);
			$tags['woocommerce_account_page'] = array(
				'caption' => __('My account page', 'website'),
				'group'   => __('General', 'website')
			);
			$tags['woocommerce'] = array(
				'caption' => __('WooCommerce page', 'website'),
				'group'   => __('General', 'website')
			);
		}

		
		foreach ($GLOBALS['wp_post_types'] as $post_type) {

			if (isset($tags['post_type_'.$post_type->name]) || !$post_type->public) {
				continue;
			}

			$tags['post_type_'.$post_type->name] = array(
				'caption' => $post_type->labels->singular_name,
				'group'   => __('Page types', 'website')
			);

			
			foreach ($GLOBALS['wp_taxonomies'] as $taxonomy) {

				if (!$taxonomy->public) {
					continue;
				}

				if ($taxonomy->object_type != $post_type->name && !in_array($post_type->name, $taxonomy->object_type)) {
					continue;
				}

				
				static $terms;
				if (!isset($terms)) {
					$terms = $GLOBALS['wpdb']->get_results(
						"SELECT taxonomy, t.term_id AS id, name FROM {$GLOBALS['wpdb']->terms} AS t INNER JOIN {$GLOBALS['wpdb']->term_taxonomy} AS tt ON t.term_id = tt.term_id ORDER BY t.name ASC"
					);
				}
				foreach ($terms as $term) {
					if ($term->taxonomy == $taxonomy->name) {
						$tags['term_'.$taxonomy->name.'_'.$term->id] = array(
							'caption' => $term->name,
							'group'   => sprintf('%s (%s)', ucfirst($taxonomy->labels->singular_name), $post_type->labels->singular_name)
						);
					}
				}

			}

			
			if ($post_type->name == 'post' || $post_type->name == 'page') {
				foreach (get_users(array(
					'fields' => array('ID', 'display_name'),
					'who'    => 'authors'
				)) as $user) {
					$tags['author_'.$post_type->name.'_'.$user->ID] = array(
						'caption' => $user->display_name,
						'group'   => sprintf('%s (%s)', __('Author', 'website'), $post_type->labels->singular_name)
					);
				}
			}

			
			if ($post_type->name == 'page') {
				$templates = Theme::getInstance()->theme->get_page_templates();
				asort($templates);
				foreach ($templates as $template => $caption) {
					$tags['template_'.preg_replace('/\.(php)$/i', '_\1', $template)] = array(
						'caption' => $caption,
						'group'   => sprintf('%s (%s)', __('Template', 'website'), $post_type->labels->singular_name)
					);
				}
			}

		}

		return $tags;

	}

	

	






	public static function getTagsListEx()
	{

		static $tags;

		
		if (!isset($tags)) {
			foreach ($GLOBALS['wp_post_types'] as $post_type) {
				if (!$post_type->public || $post_type->name == 'attachment') {
					continue;
				}
				if ($post_type->hierarchical) {
					$posts = Func::wpPagesList(array('post_type' => $post_type->name));
				} else {
					$posts = Func::wpPostsList(array('numberposts' => -1, 'post_type' => $post_type->name, 'orderby' => 'post_title', 'order' => 'ASC'));
				}
				$posts = array_map(function($s) { return Func::stringCut($s, 55); }, $posts);
				foreach ($posts as $id => $caption) {
					$tags['post_'.$id] = array(
						'caption' => $caption,
						'group'   => $post_type->labels->singular_name
					);
				}
			}
		}

		return self::getTagsList()+$tags;

	}

	

	







	public static function getTag($tag)
	{

		
		if (strpos($tag, 'post_type_') === 0) {

			if (!post_type_exists($post_type = substr($tag, 10))) {
				return false;
			}
			return array(
				'callback' => function() use ($post_type) { return is_singular($post_type); },
				'priority' => 20
			);

		}

		
		else if (strpos($tag, 'post_') === 0) {

			$post = substr($tag, 5);
			return array(
				'callback' => function() use ($post) { return get_the_ID() == $post; },
				'priority' => 5
			);

		}

		
		else if (strpos($tag, 'author_') === 0) {

			if (!preg_match('/^author_(?P<post_type>.+)_(?P<id>[0-9]+)$/', $tag, $author)) {
				return false;
			}
			return array(
				'callback' => function() use ($author) {
					if (is_singular($author['post_type']) && ($post = get_post()) !== null) {
						return $post->post_author == $author['id'];
					} else if ($author['post_type'] == 'post') {
						return is_author($author);
					} else {
						return false;
					}
				},
				'priority' => 18
			);

		}

		
		else if (strpos($tag, 'template_') === 0) {

			$template = preg_replace('/_(php)$/i', '.\1', substr($tag, 9));
			return array(
				'callback' => function() use ($template) { return is_page_template($template); },
				'priority' => 15
			);

		}

		
		else if (strpos($tag, 'term_') === 0) {

			if (!preg_match('/^term_(?P<taxonomy>.+)_(?P<id>[0-9]+)$/', $tag, $term) || !taxonomy_exists($term['taxonomy'])) {
				return false;
			}
			return array(
				'callback' => function() use ($term) {
					if (is_singular()) {
						
						
						return has_term($term['id'], $term['taxonomy']); 
					}
					switch ($term['taxonomy']) {
						case 'category': return is_category($term['id']);
						case 'post_tag': return is_tag($term['id']);
						default:         return is_tax($term['taxonomy'], $term['id']);
					}
				},
				'priority' => $term['taxonomy'] == 'post_format' ? 17 : 15+(int)is_taxonomy_hierarchical($term['taxonomy'])
			);

		}

		else {

			
			switch ($tag) {
				case 'front_page':
					return array(
						'callback' => 'is_front_page',
						'priority' => 10
					);
				case 'blog':
					return array(
						'callback' => function() { return is_home() || is_archive(); },
						'priority' => 40
					);
				case 'author':
					return array(
						'callback' => 'is_author',
						'priority' => 30
					);
				case 'search':
					return array(
						'callback' => 'is_search',
						'priority' => 10
					);
				case '404':
					return array(
						'callback' => 'is_404',
						'priority' => 10
					);
			}

			
			if (Theme::isPluginActive('bbpress')) {
				switch ($tag) {
					case 'bbpress_forum':
						return array(
							'callback' => 'bbp_is_single_forum',
							'priority' => 10
						);
					case 'bbpress_topic':
						return array(
							'callback' => 'bbp_is_single_topic',
							'priority' => 10
						);
					case 'bbpress':
						return array(
							'callback' => 'is_bbpress',
							'priority' => 10
						);
				}
			}

			
			if (Theme::isPluginActive('woocommerce')) {
				switch ($tag) {





					case 'woocommerce_shop':
						return array(
							'callback' => function() { return is_shop() || is_product_taxonomy() || is_product(); },
							'priority' => 30
						);
					case 'woocommerce_cart':
						return array(
							'callback' => 'is_cart',
							'priority' => 10
						);
					case 'woocommerce_checkout':
						return array(
							'callback' => 'is_checkout',
							'priority' => 10
						);
					case 'woocommerce_order_received_page':
						return array(
							'callback' => 'is_order_received_page',
							'priority' => 9
						);
					case 'woocommerce_account_page':
						return array(
							'callback' => 'is_account_page',
							'priority' => 10
						);
					case 'woocommerce':
						return array(
							'callback' => function() { return is_shop() || is_product_taxonomy() || is_product() || is_cart() || is_checkout() || is_order_received_page() || is_account_page(); },
							'priority' => 40
						);
				}
			}

			return false;

		}

	}

	

	







	public static function is($tag)
	{
		if (($_tag = self::getTag($tag)) === false) {
			return false;
		}
		return call_user_func($_tag['callback']);
	}

}








class Size extends Complex
{

	

	protected $width;
	protected $height;
	public    $min   = false;
	public    $max   = false;
	public    $float = false;
	public    $unit  = 'px';

	

	





	protected function _options()
	{
		return array(
			'width' => 'number',
			'height'=> 'number'
		);
	}

	

	





	protected function _html()
	{
		$html = HTML::div()
			->class($this->getCSSClass(__CLASS__))
			->add(
				$this->width->html(), ' x ',
				$this->height->html()
			);
		if ($this->unit) {
			$html->add(' ', $this->unit);
		}
		return $html;
	}

	

	





	public function __construct($name, $default, array $properties = array())
	{

		parent::__construct($name, $default, $properties);

		
		$this->width->min   = $this->min;
		$this->width->max   = $this->max;
		$this->width->float = $this->float;

		
		$this->height->min   = $this->min;
		$this->height->max   = $this->max;
		$this->height->float = $this->float;

	}

}








class Interval extends Complex
{

	

	protected $quantity;
	protected $unit;
	public    $min   = false; 
	public    $max   = false; 

	

	





	protected function _options()
	{
		return array(
			'quantity' => 'number',
			'unit'     => 'select'
		);
	}

	

	





	protected function _sanitize($value)
	{
		if (is_int($value)) {
			$value = array('quantity' => $value);
		}
		$value = parent::_sanitize($value);
		if ($this->min !== false && self::toSeconds($value['quantity'], $value['unit']) < self::toSeconds($this->min)) { 
			$value = self::split($this->min);
		}
		if ($this->max !== false && self::toSeconds($value['quantity'], $value['unit']) > self::toSeconds($this->max)) {
			$value = self::split($this->max);
		}
		if ($value['quantity'] >= 7 && $value['unit'] != 'w') {
			$multiples = array(
				array('s', 60),
				array('m', 60),
				array('h', 24),
				array('d', 7),
				array('w', 0)
			);
			foreach ($multiples as $i => $multiple) {
				if ($value['unit'] == $multiple[0] && $multiple[1] > 0 && $value['quantity'] % $multiple[1] == 0) {
					$value['quantity'] /= $multiple[1];
					$value['unit'] = $multiples[$i+1][0];
				}
			}
		}
		return $value;
	}

	

	





	protected function _html()
	{
		$html = HTML::div()
			->class($this->getCSSClass(__CLASS__))
			->add(
				$this->quantity->html(), ' ',
				$this->unit->html()
			);
		return $html;
	}

	

	





	public function __construct($name, $default, array $properties = array())
	{

		parent::__construct($name, $default, $properties);

		
		$units = array(
			's' => __('sec.', 'website'),
			'm' => __('min.', 'website'),
			'h' => __('hour(s)', 'website'),
			'd' => __('day(s)', 'website'),
			'w' => __('week(s)', 'website')
		);
		if ($this->min !== false) {
			$interval = self::split($this->min);
			$min = array_search($interval['unit'], array_keys($units));
		} else {
			$min = 0;
		}
		if ($this->max !== false) {
			$interval = self::split($this->max);
			$max = array_search($interval['unit'], array_keys($units));
		} else {
			$max = count($units)-1;
		}
		$this->unit->options = array_slice($units, $min, $max-$min+1, true);

	}

	

	






	public function interval()
	{
		return $this->quantity->value.$this->unit->value;
	}

	

	






	public function seconds()
	{
		return self::toSeconds($this->quantity->value, $this->unit->value);
	}

	

	







	protected static function split($interval)
	{
		if (preg_match('/^([0-9]+)([smhdw])$/i', $interval, $m)) {
			return array('quantity' => (int)$m[1], 'unit' => strtolower($m[2]));
		} else {
			return array('quantity' => (int)$interval, 'unit' => 's');
		}
	}

	

	











	public static function toSeconds($quantity, $unit = null)
	{
		$factors = array(
			's' => 1,
			'm' => 60,
			'h' => 60*60,
			'd' => 24*60*60,
			'w' => 7*24*60*60
		);
		if ($unit === null) {
			list($quantity, $unit) = array_values(self::split($quantity));
		} else {
			$quantity = (int)$quantity;
			$unit = strtolower($unit);
		}
		return isset($factors[$unit]) ? $quantity*$factors[$unit] : $quantity;
	}

}








class RetinaImage extends Complex
{

	

	





	protected $x1;

	





	protected $x2;

	

	





	protected function _options()
	{
		return array(
			'x1' => 'attachment',
			'x2' => 'attachment'
		);
	}

	

	





	protected function _html()
	{
		$html = HTML::div()
			->class($this->getCSSClass(__CLASS__))
			->add($this->x1->html());
		if (isset($this->x2)) {
			$html->add($this->x2->html());
		}
		return $html;
	}

	

	





	public function __construct($name, $default, array $properties = array())
	{

		parent::__construct($name, $default, $properties);

		if (isset($this->x2)) {
			$this->x2->on_html = function($option, &$html) {
				$html->add(' @2x');
			};
		}

	}

	

	







	public function image(array $attr = array())
	{

		if ($this->x1->value === 0 || ($x1_image = wp_get_attachment_image_src($this->x1->value, 'full')) === false) {
			return '';
		}

		if (isset($this->x2) && ($x2_image = wp_get_attachment_image_src($this->x2->value, 'full')) !== false) {
			$attr['srcset'] = sprintf('%s %dw, %s %dw', $x1_image[0], $x1_image[1], $x2_image[0], $x2_image[1]);
			$attr['sizes']  = sprintf('(max-width: %1$dpx) 100vw, %1$dpx', $x1_image[1]);
		}

		return $this->x1->image('full', $attr);

	}

}








class Background extends Complex
{

	

	protected $image;
	protected $color;
	protected $alignment;
	protected $position;
	protected $attachment;

	





	public $image_size = 'full';

	

	





	protected function _options()
	{
		return array(
			'image'      => 'attachment',
			'color'      => 'color',
			'alignment'  => 'select',
			'position'   => 'select',
			'attachment' => 'select'
		);
	}

	

	





	protected function _html()
	{
		$html = HTML::div()
			->class($this->getCSSClass(__CLASS__))
			->add($this->image->html());
		if (isset($this->color) || isset($this->alignment) || isset($this->position) || isset($this->attachment)) {
			if (isset($this->color)) {
				$html->add($this->color->html(), ' ');
			}
			if (isset($this->alignment)) {
				$html->add($this->alignment->html(), ' ');
			}
			if (isset($this->position)) {
				$html->add($this->position->html(), ' ');
			}
			if (isset($this->attachment)) {
				$html->add($this->attachment->html());
			}
		}
		return $html;
	}

	

	





	public function __construct($name, $default, array $properties = array())
	{

		parent::__construct($name, $default, $properties);

		if (isset($this->alignment)) {
			$this->alignment->options = array(
				'no-repeat' => __('No repeat', 'website'),
				'repeat'    => __('Repeat', 'website'),
				'repeat-x'  => __('Repeat horizontally', 'website'),
				'repeat-y'  => __('Repeat vertically', 'website'),
				'cover'     => __('Fit (cover)', 'website'),
				'contain'   => __('Fit (contain) ', 'website'),
			);
		}

		if (isset($this->position)) {
			$this->position->options = array(
				'left top'      => __('Left top', 'website'),
				'left center'   => __('Left center', 'website'),
				'left bottom'   => __('Left bottom', 'website'),
				'center top'    => __('Center top', 'website'),
				'center center' => __('Center', 'website'),
				'center bottom' => __('Center bottom', 'website'),
				'right top'     => __('Right top', 'website'),
				'right center'  => __('Right center', 'website'),
				'right bottom'  => __('Right bottom', 'website')
			);
		}

		if (isset($this->attachment)) {
			$this->attachment->options = array(
				'scroll' => __('Scroll', 'website'),
				'fixed'  => __('Fixed', 'website')
			);
		}

	}

	

	







	public function css($selector = '')
	{

		
		$image = $this->image->uri(
			isset($this->alignment) && $this->alignment->value('cover', 'contain') ? $this->image_size : 'full'
		);

		
		if (isset($this->alignment)) {
			if (strpos($this->alignment->value, 'repeat') !== false) {
				$repeat = $this->alignment->value;
				$size   = 'auto';
			} else {
				$repeat = 'no-repeat';
				$size   = $this->alignment->value;
			}
		}

		if (isset($this->color, $this->alignment, $this->position, $this->attachment)) {

			
			$css = sprintf('background: %s %s %s %s/%s %s;',
				$image ? "url(\"{$image}\")" : '',
				$repeat,
				$this->color->value,
				$this->position->value,
				$size,
				$this->attachment->value
			);

		} else {

			
			$css = $image ? "background-image: url(\"{$image}\");" : '';

			
			if (isset($this->color)) {
				$css .= " background-color: {$this->color->value};";
			}

			
			if (isset($this->alignment)) {
				$css .= " background-repeat: {$repeat}; background-size: {$size};";
			}

			
			if (isset($this->position)) {
				$css .= " background-position: {$this->position->value};";
			}

			
			if (isset($this->attachment)) {
				$css .= " background-attachment: {$this->attachment->value};";
			}

		}

		return $selector ? "{$selector} { {$css} }" : $css;

	}

}








class Font extends Complex
{

	




















































	

	




	const GOOGLE_FONTS_UPDATE_INTERVAL = 30;

	

	




	protected static $instances = array();

	




	protected static $web_safe = array(
		'Arial, Helvetica, sans-serif'                     => 'Arial',
		'Arial Black, Gadget, sans-serif'                  => 'Arial Black',
		'Arial Narrow, sans-serif'                         => 'Arial Narrow',
		'Century Gothic, sans-serif'                       => 'Century Gothic',
		'Courier New, Courier, monospace'                  => 'Courier New',
		'Georgia, Serif'                                   => 'Georgia',
		'Helvetica, Arial, sans-serif'                     => 'Helvetica',
		'Impact, Charcoal, sans-serif'                     => 'Impact',
		'Lucida Console, Monaco, monospace'                => 'Lucida Console',
		'Lucida Sans Unicode, Lucida Grande, sans-serif'   => 'Lucida Sans Unicde',
		'Palatino Linotype, Book Antiqua, Palatino, serif' => 'Palatino Linotype',
		'Tahoma, Geneva, sans-serif'                       => 'Tahoma',
		'Times New Roman, Times, serif'                    => 'Times New Roman',
		'Trebuchet MS, Helvetica, sans-serif'              => 'Trebuchet MS',
		'Verdana, Geneva, sans-serif'                      => 'Verdana'
	);

	




	protected static $google_fonts = array();

	




	public static $fonts_path = 'fonts';

	




	public static $fonts_exts = array('eot', 'woff', 'ttf', 'svg');

	








	public static $always_used = array();

	

	protected $family;
	protected $color;
	protected $size;
	protected $line_height;
	protected $styles;
	public    $allow_web_safe        = true;
	public    $allow_google_fonts    = true;
	public    $allow_custom_fontface = true;
	public    $size_unit             = 'px';
	public    $line_height_unit      = '%';

	

	





	protected function _options()
	{
		return array(
			'family'      => 'select',
			'color'       => 'color',
			'size'        => 'number',
			'line_height' => 'number',
			'styles'      => 'group'
		);
	}

	

	





	protected function _html()
	{
		$html = HTML::div()->class($this->getCSSClass(__CLASS__));
		if (isset($this->family)) {
			$html->add($this->family->html());
		}
		if (isset($this->color)) {
			$html->add(' ', $this->color->html());
		}
		if (isset($this->size)) {
			$html->add(' ', $this->size->html());
		}
		if (isset($this->line_height)) {
			$html->add(isset($this->size) ? ' / ' : ' ', $this->line_height->html());
		}
		if (isset($this->styles)) {
			$html->add('<br />', $this->styles->html());
		}
		return $html;
	}

	

	





	protected function _scripts($instance_num)
	{

		if ($instance_num > 0) {
			return '';
		}

		
		self::initGoogleFonts();
		$google_fonts = self::$google_fonts !== false ? array_map(function($font) { return $font->family; }, self::$google_fonts) : array();

		
		$custom_fontface = Func::filesList(Theme::getInstance()->stylesheet_dir.'/'.self::$fonts_path, self::$fonts_exts, function(&$i, &$bn, $pi) {
			$i  = $pi['filename'];
			$bn = ucwords(Func::stringID(preg_replace('/webfont$/', '', $pi['filename']), ' '));
		});

		
		return
			'var web_safe = '.json_encode(self::$web_safe).'; '.
			'var google_fonts = '.json_encode($google_fonts).'; '.
			'var custom_fontface = '.json_encode($custom_fontface).';';

	}

	

	





	public function __construct($name, $default, array $properties = array())
	{

		parent::__construct($name, $default, $properties);
		self::$instances[] = $this;

		
		if (isset($this->family)) {
			$this->family->on_sanitize = function($option, $original_value, &$value) {
				$value = (string)$original_value;
			};
			$this->family->on_html = function($option, &$html) {
				$html->data('value', $option->value);
				$i = 0;
				foreach (array('web_safe', 'google_fonts', 'custom_fontface') as $type) {
					if ($option->parent->{'allow_'.$type}) {
						$html->child($i)->data('type', $type);
						$i++;
					}
				}
			};
			if ($this->allow_web_safe) {
				$this->family->groups[__('Classic web fonts', 'website')] = array();
			}
			if ($this->allow_google_fonts) {
				$this->family->groups[__('Google Fonts', 'website')] = array();
			}
			if ($this->allow_custom_fontface) {
				$this->family->groups[__('Custom font-face', 'website')] = array();
			}
		}

		
		if (isset($this->color)) {
			$this->color->required    = false;
			$this->color->placeholder = __('default', 'website');
		}

		
		if (isset($this->size)) {
			$this->size->unit = $this->size_unit;
			switch ($this->size_unit) {
				case 'px':
				case 'pt':
					$this->size->min = 0;
					$this->size->max = 100;
					break;
				case 'em':
					$this->size->float = true;
					$this->size->min   = 0;
					$this->size->max   = 10;
					break;
				case '%':
					$this->size->float = true;
					$this->size->min   = 0;
					$this->size->max   = 1000;
					break;
			}
		}

		
		if (isset($this->line_height)) {
			$this->line_height->unit = $this->line_height_unit;
			switch ($this->line_height_unit) {
				case 'px':
				case 'pt':
					$this->line_height->min = 0;
					$this->line_height->max = 100;
					break;
				case 'em':
				case '':
					$this->line_height->float = true;
					$this->line_height->min   = 0;
					$this->line_height->max   = 10;
					break;
				case '%':
					$this->line_height->float = true;
					$this->line_height->min   = 0;
					$this->line_height->max   = 1000;
					break;
			}
		}

		
		if (isset($this->styles)) {
			$this->styles->multiple = true;
			$this->styles->style    = 'horizontal';
			$this->styles->options  = array(
				'bold'      => __('Bold', 'website'),
				'italic'    => __('Italic', 'website'),
				'underline' => __('Underline', 'website')
			);
		}

	}

	

	





	public function __clone()
	{
		parent::__clone();
		self::$instances[] = $this;
	}

	

	




	public function __destruct()
	{
		if (($instance_key = array_search($this, self::$instances, true)) !== false) {
			unset(self::$instances[$instance_key]);
		}
	}

	

	







	public function css($selector = '')
	{

		if (isset($this->family)) {
			$family = preg_replace('/[-_a-z0-9]+( [-_a-z0-9]+)+/i', '"\0"', $this->family->value);
		}

		if (isset($this->family, $this->size, $this->line_height, $this->styles)) {

			
			$css = sprintf('font: %s%s%s %s%s/%s%s %s;',
				!$this->styles->value('bold') && !$this->styles->value('italic') ? ' normal' : '',
				$this->styles->value('bold')   ? ' bold'   : '',
				$this->styles->value('italic') ? ' italic' : '',
				$this->size->value,
				$this->size->unit,
				$this->line_height->value,
				$this->line_height->unit,
				$family
			);

		} else {

			$css = '';

			
			if (isset($this->family)) {
				$css .= "font-family: {$family};";
			}

			
			if (isset($this->size)) {
				$css .= " font-size: {$this->size->value}{$this->size_unit};";
			}

			
			if (isset($this->line_height)) {
				$css .= " line-height: {$this->line_height->value}{$this->line_height_unit};";
			}

			
			if (isset($this->styles)) { 
				$css .= sprintf(' font-weight: %s;', $this->styles->value('bold') ? 'bold' : 'normal');
				$css .= sprintf(' font-style: %s;', $this->styles->value('italic') ? 'italic' : 'normal');
			}

		}

		
		if (isset($this->styles)) { 
			$css .= sprintf(' text-decoration: %s;', $this->styles->value('underline') ? 'underline' : 'none');
		}

		
		if (isset($this->color) && $this->color->value) {
			$css .= " color: {$this->color->value};";
		}

		$css = trim($css);
		return $selector ? "{$selector} { {$css} }" : $css;

	}

	

	




	protected static function initGoogleFonts()
	{

		




		
		if (self::$google_fonts) {
			return;
		}

		
		self::$google_fonts = Theme::getInstance()->getTransient('google_fonts', function(&$expiration) {

			$expiration = Font::GOOGLE_FONTS_UPDATE_INTERVAL*DAY_IN_SECONDS;

			if (($google_fonts = Func::googleGetFonts(Func::GOOGLE_API_KEY)) !== false) {
				return $google_fonts;
			}

			return @unserialize(@file_get_contents(get_template_directory().'/'.\Drone\DIRECTORY.'/odd/google-fonts.dat'));

		});

		
		if (isset(self::$google_fonts[0]) && is_array(self::$google_fonts[0])) {
			Theme::getInstance()->deleteTransient('google_fonts');
			self::$google_fonts = array_map(function($font) { return (object)$font; }, self::$google_fonts);
		}

	}

	

	







	protected static function getGoogleFont($family)
	{
		self::initGoogleFonts();
		foreach (self::$google_fonts as $google_font) {
			if ($google_font->family == $family) {
				return $google_font;
			}
		}
		return false;
	}

	

	






	protected static function getUsedFonts()
	{

		
		$fonts = array();
		foreach (self::$instances as $instance) {
			if ($instance->isVisible() && ($family = $instance->value('family')) !== null) {
				$fonts[] = $family;
			}
		}

		
		$always_used = (array)self::$always_used;
		array_walk($always_used, function(&$value, $key) {
			if (is_string($key)) {
				$value = $key;
			}
		});

		return array_unique(array_merge($fonts, array_values($always_used)));

	}

	

	






	public static function getInstances()
	{
		return self::$instances;
	}

	

	




	public static function __actionWPEnqueueScripts()
	{

		$google_fonts = array();

		foreach (self::getUsedFonts() as $font) {

			
			if (isset(self::$web_safe[$font])) {
				continue;
			}

			
			else if (($google_font = self::getGoogleFont($font)) !== false) {

				$weights  = isset(self::$always_used[$font]) ? (array)self::$always_used[$font] : array(400, 700);
				$variants = array();
				foreach ($google_font->variants as $variant) {
					$variant = preg_replace('/^(regular|(italic))$/', '400\2', $variant);
					if (in_array(substr($variant, 0, 3), $weights)) {
						$variants[] = $variant;
					}
				}

				$google_fonts[] = sprintf('%s:%s:%s',
					urlencode($google_font->family),
					implode(',', $variants),
					implode(',', $google_font->subsets)
				);

			}

			
			else {

				Theme::getInstance()->addDocumentStyle(Func::cssFontFace(
					Theme::getInstance()->stylesheet_dir.'/'.self::$fonts_path,
					Theme::getInstance()->stylesheet_uri.'/'.self::$fonts_path,
					$font
				));

			}

		}

		
		
		if (count($google_fonts) > 0) {
			wp_enqueue_script(Theme::getInstance()->theme->id.'-webfont', '//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js', array(), '1.4.7');
			Theme::getInstance()->addDocumentScript(sprintf(
<<<'EOS'
				if (typeof WebFont != 'undefined') {
					WebFont.load({
						google: {families: %s},
						active: function() {
							if (document.createEvent) {
								var e = document.createEvent('HTMLEvents');
								e.initEvent('webfontactive', true, false);
								document.dispatchEvent(e);
							} else {
								document.documentElement['webfontactive']++;
							}
						}
					});
				}
EOS
			, json_encode($google_fonts)));
		}

	}

}