<?php

/*
 * AIT WordPress Theme Framework
 *
 * Copyright (c) 2015, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

/**
 * Events-pro Element
 */
class AitEventsProElement extends AitElement
{
	public function getHtmlClasses($asString = true)
	{
		$classes = parent::getHtmlClasses(false);
		$classes[] = 'elm-item-organizer-main';

		return $asString ? implode(' ', $classes) : $classes;
	}
}
