<?php


class AitPostsElement extends AitElement
{
	public function getHtmlClasses($asString = true)
	{
		$classes = parent::getHtmlClasses(false);
		$classes[] = 'elm-item-organizer-main';

		return $asString ? implode(' ', $classes) : $classes;
	}
}
