<?php

/*
 * AIT WordPress Theme Framework
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

/**
 * Posts Element
 */
class AitFeaturedItemsElement extends AitElement
{
	public function getHtmlClasses($asString = true)
	{
		$classes = parent::getHtmlClasses(false);
		$classes[] = 'elm-item-organizer-main';

		return $asString ? implode(' ', $classes) : $classes;
	}
}
