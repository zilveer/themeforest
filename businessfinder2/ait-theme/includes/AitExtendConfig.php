<?php

/*
 * AIT WordPress Plugin
 *
 * Copyright (c) 2015, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

class AitExtendConfig
{


	public static function getOptions($element, $theme = '')
	{
		switch ($element) {
			case 'search-form':
				return self::getSearchFormOptions();
				break;
			case 'header-map':
				return self::getHeaderMapOptions();
			case 'sidebar-map':
				return self::getSidebarMapOptions();
			case 'packages':
				return self::getPackagesOptions();
			default:
				break;
		}
	}



	public static function getSearchFormOptions()
	{
		return array(
			'postType' => array(
				"label" => "Post Type",
				"type" => "select",
				"selected" => "events",
				"default" => array(
					"events" => 'Events',
					"items" => 'Items',
				),
				"basic" => true,
				"help" => 'Select post type for Search Form',
			)
		);
	}




	public static function getHeaderMapOptions()
	{
		return array(
			"defaultPostType" => array(
				"label" => "Default Post Type View",
				"type" => "select",
				"selected" => "event",
				"default" => array(
					"event" => 'Events',
					"item" => 'Items',
				),
				"basic" => true,
			),

		);
	}



	public static function getSidebarMapOptions()
	{
		return array(
			"category" => array(
				"label" => "Category",
				"type" => "categories",
				"taxonomy" => "ait-events-pro",
				"default" => "0",
				"basic" => true,
			),

		);
	}
	public static function getPackagesOptions()
	{
		return array(
			"maxEvents" => array(
				"label" => "Maximum Events",
				"type"  => "number",
				"less"  => false,
			),

		);
	}



	public static function getEventSliderOptions()
	{
		return	array(
			'eventSliderCategory' => array(
				'label'    => 'Category',
				'type'     => 'categories',
				'taxonomy' => 'ait-events-pro',
				'default'  => 0,
			),
			'eventSliderOrderBy' => array(
				'label'    => 'Order By',
				'type'     => 'select',
				'selected' => 'eventDate',
				'default'  => array(
					'eventDate' => 'Event Date',
					'date'      => 'Creation Date',
					'rand'      => 'Random',
				),
			),
			'eventSliderOrder' => array(
				'label'    => 'Order',
				'type'     => 'select',
				'selected' => 'ASC',
				'default'  => array(
					'ASC' => 'Ascending',
					'DESC' => 'Descending',
				),
				'help' => 'Select order of items listed on page',

			),
			'eventSliderCount' => array(
				'label'   => 'Count',
				'type'    => 'number',
				'default' => 20,
				'help'    => 'Number of items listed on page',
			),
		);
	}




	public static function getSectionIndex($options)
	{
		return max(array_keys($options)) + 1;
	}



	public static function getNeonSection($key, $title, $id='')
	{
		$nn = new NNeonEntity;
		$nn->value = 'section';
		$nn->attributes = array(
			'title' => $title,
			'id' => $id,
			'basic' => true
		);

		return array(
			$key => $nn
		);
		// return $nn;
	}


	public static function arrayInsert($array, $var, $position)
	{
	$array = array_slice($array, 0, $position, true) +
		$var +
		array_slice($array, $position, count($array) - count($var), true) ;
		return $array;
	}

}





