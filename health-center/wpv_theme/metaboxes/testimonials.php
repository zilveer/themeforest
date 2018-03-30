<?php
/**
 * Vamtam Post Options
 *
 * @package wpv
 * @subpackage health-center
 */

return array(

array(
	'name' => __('General', 'health-center'),
	'type' => 'separator',
),

array(
	"name" => __("Cite", 'health-center') ,
	"id" => "testimonial-author",
	"default" => "",
	"type" => "text",
) ,

array(
	"name" => __("Link", 'health-center') ,
	"id" => "testimonial-link",
	"default" => "",
	"type" => "text",
) ,

);
