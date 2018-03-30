<?php


class AitSearchFormElement extends AitElement
{

	public function setOptions($options){
		$this->options = $options;
		add_filter('body_class', array($this, 'bodyHtmlClass'), 10, 2);
	}

	public function bodyHtmlClass($classes){
		$options = $this->getOptions();
		$disabledCount = 0;

		if(filter_var($options['enableKeywordSearch'], FILTER_VALIDATE_BOOLEAN) === false){
			array_push($classes, 'search-form-input-keyword-disabled');
			$disabledCount++;
		}
		
		if(filter_var($options['enableCategorySearch'], FILTER_VALIDATE_BOOLEAN) === false){
			$disabledCount++;
		}
		
		if(filter_var($options['enableLocationSearch'], FILTER_VALIDATE_BOOLEAN) === false){
			$disabledCount++;
		}

		if(filter_var($options['enableRadiusSearch'], FILTER_VALIDATE_BOOLEAN) === false){
			array_push($classes, 'search-form-input-radius-disabled');
		}

		$disabledClasses = array(
			1 => 'search-form-input-one-disabled',
			2 => 'search-form-input-two-disabled',
			3 => 'search-form-input-three-disabled',
		);
		$class = isset($disabledClasses[$disabledCount]) ? $disabledClasses[$disabledCount] : '';
		array_push($classes, $class);

		return $classes;
	}

}
