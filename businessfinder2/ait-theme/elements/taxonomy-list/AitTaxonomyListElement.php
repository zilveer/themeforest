<?php


class AitTaxonomyListElement extends AitElement
{
	public function getHtmlClasses($asString = true)
	{
		$classes = parent::getHtmlClasses(false);
		$classes[] = 'elm-item-organizer-main';

		if($this->option('layout') == 'icon'){
			$classes[] = 'layout-icon';
		}

		return $asString ? implode(' ', $classes) : $classes;
	}
}
