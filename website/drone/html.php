<?php










namespace Drone;








class HTML
{

	

	





	protected $tag;

	





	protected $attrs  = array();

	





	protected $childs = array();

	

	






	public function __construct($tag = null)
	{
		$this->tag = is_string($tag) && $tag ? strtolower($tag) : null;
	}

	

	








	public static function __callstatic($name, $args)
	{
		$html = new self($name);
		return $html->add($args);
	}

	

	







	public function __get($name)
	{
		if ($name == 'tag') {
			return $this->tag;
		} else {
			return isset($this->attrs[$name]) ? $this->attrs[$name] : null;
		}
	}

	

	







	public function __set($name, $value)
	{
		$this->attr($name, $value);
	}

	

	








	public function __call($name, $args)
	{
		return $this->attr($name, count($args) > 0 ? $args[0] : true);
	}

	

	






	public function __toString()
	{
		return $this->toHTML();
	}

	

	








	public function attr($name, $value = true)
	{
		if (is_array($name)) {
			foreach ($name as $name => $value) {
				$this->attr($name, $value);
			}
		} else {
			$name = strtolower((string)$name);
			if ($name == 'tag') {
				if (is_string($value)) {
					$this->tag = strtolower($value);
				}
			} else if ($value === null || $value === false) {
				unset($this->attrs[$name]);
			} else {
				$this->attrs[$name] = $value;
			}
		}
		return $this;
	}

	

	








	public function data($name, $value = true)
	{
		if (is_array($name)) {
			foreach ($name as $name => $value) {
				$this->data($name, $value);
			}
		} else {
			$this->attr('data-'.$name, $value);
		}
		return $this;
	}

	

	








	public function css($property, $value = false)
	{

		if (is_array($property)) {

			foreach ($property as $property => $value) {
				$this->css($property, $value);
			}

		} else if (is_string($value) || is_int($value) || is_float($value) || $value === null) {

			
			if ((is_int($value) || (is_string($value) && ctype_digit($value))) && (int)$value != 0 && preg_match('/^(
				border(-(left|right|top|bottom))?-width|
				font-size|
				left|right|top|bottom|
				(margin|padding)(-(left|right|top|bottom))?|
				((min|max)-)?(width|height)
			)$/ix', $property)) {
				$value .= 'px';
			}

			
			$style = $value !== null ? "{$property}: {$value};" : '';
			if (!isset($this->attrs['style'])) {
				$this->attrs['style'] = '';
			}
			$this->attrs['style'] = preg_replace(
				'/(?<![-\w])'.preg_quote($property, '/').' *:[^;]*;/i',
				$style, $this->attrs['style'], -1, $count
			);
			if ($style && $count == 0) {
				$this->attrs['style'] = ltrim($this->attrs['style'].' '.$style);
			}

		}

		return $this;

	}

	

	







	public function add($content)
	{
		if (func_num_args() > 1) {
			$content = func_get_args();
		}
		if (!is_array($content)) {
			$content = array($content); 
		}
		foreach ($content as $content) {
			if (!in_array($content, array(null, false, ''), true)) {
				$this->childs[] = $content instanceof self ? $content : (string)$content;
			}
		}
		return $this;
	}

	

	







	public function addNew($tag = null)
	{
		$html = new self($tag);
		$this->add($html);
		return $html;
	}

	

	







	protected function addFromHTML($html)
	{
		if (preg_match('#<\s*/?\s*[a-z0-9]+[^<>]*>#is', $html)) {
			return $this->addNew()->fromHTML($html);
		} else {
			return $this->add($html);
		}
	}

	

	








	public function insert($content, $position = 0)
	{
		if ($position >= count($this->childs)) {
			return $this->add($content);
		}
		if (!is_array($content)) {
			$content = array($content);
		}
		$_content = array();
		foreach ($content as $content) {
			if (!in_array($content, array(null, false, ''), true)) {
				$_content[] = $content instanceof self ? $content : (string)$content;
			}
		}
		array_splice($this->childs, $position, 0, $_content);
		return $this;
	}

	

	








	public function insertNew($tag = null, $position = 0)
	{
		$html = new self($tag);
		$this->insert($html, $position);
		return $html;
	}

	

	







	public function wrap($tag = null)
	{
		$_this = clone $this;
		$this->reset()->clear()->add($_this)->tag = $tag;
		return $_this;
	}

	

	







	public function delete($child)
	{
		if (is_int($child)) {
			unset($this->childs[$child]);
		} else if (($key = array_search($child, $this->childs, true)) !== false) {
			unset($this->childs[$key]);
		}
		$this->childs = array_values($this->childs);
		return $this;
	}

	

	








	public function replace($child, $content)
	{
		if (is_int($child)) {
			if (isset($this->childs[$child])) {
				$this->childs[$child] = $content;
			}
		} else if (($key = array_search($child, $this->childs, true)) !== false) {
			$this->childs[$key] = $content;
		}
		return $this;
	}

	

	









	public function each($callback)
	{
		if (!is_callable($callback)) {
			return $this;
		}
		call_user_func_array($callback, array(&$this));
		foreach ($this->childs as &$child) {
			if ($child instanceof self) {
				$child->each($callback);
			} else {
				call_user_func_array($callback, array(&$child));
			}
		}
		unset($child);
		return $this;
	}

	

	






	public function reset()
	{
		$this->attrs = array();
		return $this;
	}

	

	






	public function clear()
	{
		$this->childs = array();
		return $this;
	}

	

	







	public function child($index)
	{
		return isset($this->childs[$index]) ? $this->childs[$index] : null;
	}

	

	






	public function childs()
	{
		return $this->childs;
	}

	

	






	public function count()
	{
		return count($this->childs);
	}

	

	






	public function isVoid()
	{
		return self::isVoidTag($this->tag);
	}

	

	







	public function addClass($class)
	{
		if (func_num_args() > 1) {
			$class = func_get_args();
		}
		if (is_array($class)) {
			array_map(array($this, __FUNCTION__), $class);
		} else if (is_string($class) && !$this->hasClass($class)) {
			if (!isset($this->attrs['class'])) {
				$this->attrs['class'] = '';
			}
			$this->attrs['class'] = ltrim($this->attrs['class'].' '.$class);
		}
		return $this;
	}

	

	







	public function removeClass($class)
	{
		if (func_num_args() > 1) {
			$class = func_get_args();
		}
		if (is_array($class)) {
			array_map(array($this, __FUNCTION__), $class);
		} else if (is_string($class) && $this->hasClass($class)) {
			$this->attrs['class'] = trim(str_ireplace(" {$class} ", ' ', " {$this->attrs['class']} "));
		}
		return $this;
	}

	

	







	public function hasClass($class)
	{
		if (!isset($this->attrs['class'])) {
			return false;
		}
		return stripos(" {$this->attrs['class']} ", " {$class} ") !== false;
	}

	

	






	public function toHTML()
	{

		$content = '';

		
		if (!$this->isVoid()) {
			foreach ($this->childs as $child) {
				$content .= (string)$child;
			}
		}

		
		if ($this->tag === null) {
			return $content;
		}

		
		switch ($this->tag) {
			case 'textarea':
				$content = esc_textarea($content);
				break;
		}

		
		$attrs = array();
		foreach ($this->attrs as $name => $value) {
			if ($value === null || $value === false) {
				continue;
			}
			if ($value === true) {
				$attrs[] = $name;
			} else {
				$value = is_array($value) ? json_encode($value) : (string)$value;
				if ($this->tag == 'input' && $this->type == 'text' && $name == 'value') {
					$value = str_replace('&', '&amp;', $value);
				}
				$value = in_array($name, array('href', 'src', 'action', 'itemtype')) ? esc_url($value) : esc_attr($value);
				$attrs[] = $name.'="'.$value.'"';
			}
		}
		$attrs = rtrim(' '.implode(' ', $attrs));

		
		if ($this->isVoid()) {
			return "<{$this->tag}{$attrs} />";
		} else {
			return "<{$this->tag}{$attrs}>{$content}</{$this->tag}>";
		}

	}

	

	







	public function fromHTML($html)
	{

		
		$this->reset()->clear()->tag = null;

		
		$nodes = preg_split('#(<\s*/?\s*[a-z0-9]+[^<>]*>)#is', $html, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

		
		$tag     = false;
		$content = '';
		$childs  = array();

		foreach ($nodes as $node) {

			
			if (preg_match('#^<\s*(?P<close>/?)\s*(?P<tag>[a-z0-9]+)#i', $node, $m)) {

				$m['tag'] = strtolower($m['tag']);

				
				if ($tag) {

					$content .= $node;

					
					if ($m['tag'] == $tag['name']) {

						
						if ($m['close']) {
							if (--$tag['depth'] == 0) { 
								$tag = false;
								$childs[] = $content;
								$content = '';
							}
						} else { 
							$tag['depth']++;
						}

					}

				}

				
				else {

					
					if (!$m['close']) {
						$childs[] = $content;
						$content = '';
						if (!self::isVoidTag($m['tag'])) { 
							$tag = array('name' => $m['tag'], 'depth' => 1);
						}
					}

					$content .= $node;

				}

			}

			
			else {
				$content .= $node;
			}

		}

		$childs[] = $content;

		
		$childs = array_values(array_filter($childs));

		
		if (!$childs) {
			return $this;
		}

		
		if (count($childs) > 1) {
			foreach ($childs as $child) {
				$this->addFromHTML($child);
			}
			return $this;
		}

		
		if (preg_match('#^<\s*(?P<tag>[a-z0-9]+)(?P<attrs>[^>]*)>((?P<childs>.*)<\s*/\s*\1\s*>)?$#is', $childs[0], $m)) {

			
			$this->attr('tag', $m['tag']);

			
			if (preg_match_all('/(?P<name>[a-z][-_a-z0-9]*)(=["\'](?P<value>[^"\']*)["\'])?/is', $m['attrs'], $attrs_m, PREG_SET_ORDER)) {
				foreach ($attrs_m as $attr) {
					$this->attr($attr['name'], isset($attr['value']) ? $attr['value'] : true);
				}
			}

			
			if (!empty($m['childs'])) {
				$this->addFromHTML($m['childs']);
			}

		} else {
			$this->add($childs[0]);
		}

		return $this;

	}

	

	







	public static function isVoidTag($tag)
	{
		return in_array(
			strtolower($tag),
			array('area', 'base', 'br', 'col', 'command', 'embed', 'hr', 'img', 'input', 'keygen', 'link', 'meta', 'param', 'source', 'track', 'wbr'),
			true
		);
	}

	

	







	public static function make($tag = null)
	{
		return new self($tag);
	}

	

	







	public static function makeFromHTML($html)
	{
		return self::make()->fromHTML($html);
	}

	

	









	public static function makeNamed($tag, $name, $id = null)
	{
		return self::$tag()->name($name)->id($id === null ? Func::stringID($name) : $id);
	}

	

	









	public static function makeInput($type, $name, $value = '')
	{
		return self::makeNamed('input', $name)->type($type)->value($value);
	}

	

	








	public static function makeTextarea($name, $value = '')
	{
		return self::makeNamed('textarea', $name)->add($value);
	}

	

	











	public static function makeSelect($name, $value = '', array $options = array(), array $groups = array(), $multiple = false)
	{
		$value  = array_map('strval', (array)$value);
		$select = self::makeNamed('select', $name);
		foreach ($groups as $group_label => $group_options) {
			$group = self::optgroup()->label($group_label);
			foreach ($group_options as $group_option_value) {
				if (isset($options[$group_option_value])) {
					$group->addNew('option')
						->value($group_option_value)
						->selected(in_array((string)$group_option_value, $value))
						->add($options[$group_option_value]);
					unset($options[$group_option_value]);
				}
			}
			$select->add($group);
		}
		foreach (array_reverse($options, true) as $option_value => $option_label) {
			$select->insertNew('option')
				->value($option_value)
				->selected(in_array((string)$option_value, $value))
				->add($option_label);
		}
		if ($multiple) {
			$select->name .= '[]';
			$select->multiple = true;
			$select->wrap();
			$select->insert(self::makeInput('hidden', $name)->id(null));
		}
		return $select;
	}

	

	









	public static function makeCheckboxSingle($name, $label, $checked = false)
	{
		$hidden = self::makeInput('hidden', $name)->id(null);
		$checkbox = self::makeNamed('input', $name)->type('checkbox')->checked($checked);
		$label = self::label()->for($checkbox->id)->add($hidden, $checkbox, ' ', $label);
		return self::fieldset()->add($label);
	}

	

	










	public static function makeCheckboxGroup($name, array $values = array(), array $options = array(), $separator = '<br />')
	{
		$alt = empty($values) || (key($values) === 0 && !is_bool(current($values)));
		$fieldset = self::fieldset();
		if ($alt) {
			$fieldset->add(self::makeInput('hidden', $name)->id(null));
		}
		foreach ($options as $option_name => $option_label) {
			$checkbox = self::input()
				->type('checkbox')
				->id(Func::stringID($name.'-'.$option_name));
			if ($alt) {
				$checkbox
					->name($name.'[]')
					->checked(in_array((string)$option_name, $values, true))
					->value($option_name);
			} else {
				$checkbox
					->name($name."[{$option_name}]")
					->checked(isset($values[$option_name]) && $values[$option_name]);
				$fieldset->add(self::makeInput('hidden', $checkbox->name)->id(null));
			}
			$label = self::label()
				->for($checkbox->id)
				->add($checkbox, ' ', $option_label);
			$fieldset->add($label, $separator);
		}
		return $fieldset;
	}

	

	










	public static function makeRadioGroup($name, $value = null, array $options = array(), $separator = '<br />')
	{
		$fieldset = self::fieldset();
		foreach ($options as $option_value => $option_label) {
			$radio = self::makeNamed('input', $name, Func::stringID($name.'-'.$option_value))
				->type('radio')
				->value($option_value)
				->checked($value == $option_value);
			$label = self::label()
				->for($radio->id)
				->add($radio, ' ', $option_label);
			$fieldset->add($label, $separator);
		}
		return $fieldset;
	}

	

	








	public static function makeSubmit($name, $label)
	{
		return self::makeNamed('input', $name)->type('submit')->value($label);
	}

	

	








	public static function makeLabel($for, $label)
	{
		return self::label()->for($for)->add($label);
	}

}