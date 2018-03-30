<?php 
/**
 *  @package by Theme Record
*/
global $font_faces, $font_size, $font_weight;

$options = array(

	array('name' => __('Font Settings', 'TR'), 'type' => 'tab_page_title'),

	array('type' => 'tabs_head'),

	//Tab Title
	array('type' => 'tab_title_head'),
	array('name' => __('Font Family', 'TR'), 'slug' => 'family', 'class' => 'active', 'type' => 'tab'),
	array('name' => __('Font Size', 'TR'), 'slug' => 'size', 'type' => 'tab'),
	array('type' => 'tab_title_foot'),

	//Family
	array('slug' => 'family', 'type' => 'tab_content_head'),
	array(
			'name' => __('Body Family', 'TR'),
			'desc' => __('Select the family for the body basic font.', 'TR'),
			'id' => 'body_font_family',
			'std' => '',
			'options' => $font_faces,
			'type' => 'select'
	),
	array(
			'name' => __('Site Name Family', 'TR'),
			'desc' => __('Select the family for the site name font.', 'TR'),
			'id' => 'site_name_font_family',
			'std' => '',
			'options' => $font_faces,
			'type' => 'select'
	),
	array(
			'name' => __('Menu Family', 'TR'),
			'desc' => __('Select the family for the menu font.', 'TR'),
			'id' => 'menu_font_family',
			'std' => '',
			'options' => $font_faces,
			'type' => 'select'
	),
	array(
			'name' => __('Hgroup Family', 'TR'),
			'desc' => __('Select the family for the hgroup font.', 'TR'),
			'id' => 'hgroup_font_family',
			'std' => '',
			'options' => $font_faces,
			'type' => 'select'
	),
	array(
			'name' => __('Breadcrumbs Family', 'TR'),
			'desc' => __('Select the family for the breadcrumbs font.', 'TR'),
			'id' => 'breadcrumbs_font_family',
			'std' => '',
			'options' => $font_faces,
			'type' => 'select'
	),
	array(
			'name' => __('Page Header Family', 'TR'),
			'desc' => __('Select the family for the page header font.', 'TR'),
			'id' => 'page_header_font_family',
			'std' => '',
			'options' => $font_faces,
			'type' => 'select'
	),
	array(
			'name' => __('Meta Family', 'TR'),
			'desc' => __('Select the family for the meta font.', 'TR'),
			'id' => 'meta_font_family',
			'std' => '',
			'options' => $font_faces,
			'type' => 'select'
	),
	array(
			'name' => __('Slogan Family', 'TR'),
			'desc' => __('Select the family for the slogan font.', 'TR'),
			'id' => 'slogan_font_family',
			'std' => '',
			'options' => $font_faces,
			'type' => 'select'
	),
	array(
			'name' => __('Price Family', 'TR'),
			'desc' => __('Select the family for the price font.', 'TR'),
			'id' => 'price_font_family',
			'std' => '',
			'options' => $font_faces,
			'type' => 'select'
	),
	array(
			'name' => __('Read More Family', 'TR'),
			'desc' => __('Select the family for the read more font.', 'TR'),
			'id' => 'read_more_font_family',
			'std' => '',
			'options' => $font_faces,
			'type' => 'select'
	),
	array(
			'name' => __('Pagination Family', 'TR'),
			'desc' => __('Select the family for the pagination font.', 'TR'),
			'id' => 'pagination_font_family',
			'std' => '',
			'options' => $font_faces,
			'type' => 'select'
	),
	array(
			'name' => __('Form Family', 'TR'),
			'desc' => __('Select the family for the form font.', 'TR'),
			'id' => 'form_font_family',
			'std' => '',
			'options' => $font_faces,
			'type' => 'select'
	),
	array(
			'name' => __('Copyright Family', 'TR'),
			'desc' => __('Select the family for the copyright font.', 'TR'),
			'id' => 'copyright_font_family',
			'std' => '',
			'options' => $font_faces,
			'class' => 'no',
			'type' => 'select'
	),
	array('type' => 'tab_content_foot'),

	//Size
	array('slug' => 'size', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Body Size', 'TR'),
			'desc' => __('Select the size for the body font.', 'TR'),
			'id' => 'body_font_size',
			'std' => '13',
			'options' => $font_size,
			'type' => 'select'
	),
	array(
			'name' => __('Site Name Size', 'TR'),
			'desc' => __('Select the size for the site name font.', 'TR'),
			'id' => 'site_name_font_size',
			'std' => '42',
			'options' => $font_size,
			'type' => 'select'
	),
	array(
			'name' => __('Main Menu Size', 'TR'),
			'desc' => __('Select the size for the main menu font.', 'TR'),
			'id' => 'main_menu_font_size',
			'std' => '12',
			'options' => $font_size,
			'type' => 'select'
	),
	array(
			'name' => __('Sub Menu Size', 'TR'),
			'desc' => __('Select the size for the sub menu font.', 'TR'),
			'id' => 'sub_menu_font_size',
			'std' => '12',
			'options' => $font_size,
			'type' => 'select'
	),
	array(
			'name' => __('H1 Size', 'TR'),
			'desc' => __('Select the size for the h1 font.', 'TR'),
			'id' => 'h1_font_size',
			'std' => '24',
			'options' => $font_size,
			'type' => 'select'
	),
	array(
			'name' => __('H2 Size', 'TR'),
			'desc' => __('Select the size for the h2 font.', 'TR'),
			'id' => 'h2_font_size',
			'std' => '20',
			'options' => $font_size,
			'type' => 'select'
	),
	array(
			'name' => __('H3 Size', 'TR'),
			'desc' => __('Select the size for the h3 font.', 'TR'),
			'id' => 'h3_font_size',
			'std' => '16',
			'options' => $font_size,
			'type' => 'select'
	),
	array(
			'name' => __('H4 Size', 'TR'),
			'desc' => __('Select the size for the h4 font.', 'TR'),
			'id' => 'h4_font_size',
			'std' => '14',
			'options' => $font_size,
			'type' => 'select'
	),
	array(
			'name' => __('H5 Size', 'TR'),
			'desc' => __('Select the size for the h5 font.', 'TR'),
			'id' => 'h5_font_size',
			'std' => '12',
			'options' => $font_size,
			'type' => 'select'
	),
	array(
			'name' => __('H6 Size', 'TR'),
			'desc' => __('Select the size for the h6 font.', 'TR'),
			'id' => 'h6_font_size',
			'std' => '10',
			'options' => $font_size,
			'type' => 'select'
	),
	array(
			'name' => __('Slogan Size', 'TR'),
			'desc' => __('Select the size for the slogan font.', 'TR'),
			'id' => 'slogan_font_size',
			'std' => '22',
			'options' => $font_size,
			'type' => 'select'
	),
	array(
			'name' => __('Footer Menu Size', 'TR'),
			'desc' => __('Select the size for the footer menu font.', 'TR'),
			'id' => 'footer_menu_font_size',
			'std' => '12',
			'options' => $font_size,
			'type' => 'select'
	),
	array(
			'name' => __('Copyright Size', 'TR'),
			'desc' => __('Select the size for the copyright font.', 'TR'),
			'id' => 'copyright_font_size',
			'std' => '12',
			'options' => $font_size,
			'class' => 'no',
			'type' => 'select'
	),
	array('type' => 'tab_content_foot'),

	array('type' => 'tabs_foot')

);

return array('auto' => true, 'name' => 'fonts', 'options' => $options );

?>