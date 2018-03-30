<?php

global $edgtIconCollections;
//Masonry Gallery Metaboxes

//General settings for text, buttons, links
$edgtMasonryGalleryItemGeneral = new EdgeMetaBox("masonry_gallery", "Edge Masonry Gallery General");
$edgtFramework->edgtMetaBoxes->addMetaBox("masonry_gallery_item_general",$edgtMasonryGalleryItemGeneral);

	$edgt_masonry_gallery_item_text = new EdgeMetaField('text', 'edgt_masonry_gallery_item_text', '', 'Text', '');
	$edgtMasonryGalleryItemGeneral->addChild('edgt_masonry_gallery_item_text', $edgt_masonry_gallery_item_text);

	$edgt_masonry_gallery_item_link = new EdgeMetaField('text', 'edgt_masonry_gallery_item_link', '', 'Link', '');
	$edgtMasonryGalleryItemGeneral->addChild('edgt_masonry_gallery_item_link', $edgt_masonry_gallery_item_link);

	$edgt_masonry_gallery_item_link_target = new EdgeMetaField('select', 'edgt_masonry_gallery_item_link_target', '_self', 'Link target', '', array(
		'_self' => 'Self',
		'_blank' => 'Blank'
	));
	$edgtMasonryGalleryItemGeneral->addChild('edgt_masonry_gallery_item_link_target', $edgt_masonry_gallery_item_link_target);

	//Masonry Gallery Style - Size, Type
	$section_style_title = new EdgeTitle('section_style_title', 'Masonry Gallery Item Style');
	$edgtMasonryGalleryItemGeneral->addChild('section_style_title', $section_style_title);

	$edgt_masonry_gallery_item_size = new EdgeMetaField('select', 'edgt_masonry_gallery_item_size', 'square_small', 'Size', 'size', array(
		'square_small' => 'Square Small',
		'square_big' => 'Square Big',		
		'rectangle_portrait' => 'Rectangle Portrait',
		'rectangle_landscape' => 'Rectangle Landscape'
	));
	$edgtMasonryGalleryItemGeneral->addChild('edgt_masonry_gallery_item_size', $edgt_masonry_gallery_item_size);

	$edgt_masonry_gallery_item_type = new EdgeMetaField('select', 'edgt_masonry_gallery_item_type', 'with_button', 'Type', 'type', array(
		'with_button' => 'With Button',
		'with_icon' => 'With Icon',
		'standard' => 'Standard'
	),
	array(
		'dependence' => true,
		'hide' => array(
			'with_button' => '#edgtf_edgt_masonry_gallery_item_icon_type_container',
			'with_icon' => '#edgtf_edgt_masonry_gallery_item_button_type_container',
			'standard' => '#edgtf_edgt_masonry_gallery_item_button_type_container, #edgtf_edgt_masonry_gallery_item_icon_type_container'
		),
		'show' => array(
			'with_button' => '#edgtf_edgt_masonry_gallery_item_button_type_container',
			'with_icon' => '#edgtf_edgt_masonry_gallery_item_icon_type_container',
			'standard' => ''
		)
	));
	$edgtMasonryGalleryItemGeneral->addChild('edgt_masonry_gallery_item_type', $edgt_masonry_gallery_item_type);

	$edgt_masonry_gallery_item_button_type_container = new EdgeContainer('edgt_masonry_gallery_item_button_type_container', 'edgt_masonry_gallery_item_type', '', array('standard', 'with_icon'));
	$edgtMasonryGalleryItemGeneral->addChild('edgt_masonry_gallery_item_button_type_container', $edgt_masonry_gallery_item_button_type_container);

		$edgt_masonry_gallery_button_label = new EdgeMetaField('text', 'edgt_masonry_gallery_button_label', '', 'Button Label', '');
		$edgt_masonry_gallery_item_button_type_container->addChild('edgt_masonry_gallery_button_label', $edgt_masonry_gallery_button_label);

	$edgt_masonry_gallery_item_icon_type_container = new EdgeContainer('edgt_masonry_gallery_item_icon_type_container', 'edgt_masonry_gallery_item_type', '', array('standard', 'with_button'));
	$edgtMasonryGalleryItemGeneral->addChild('edgt_masonry_gallery_item_icon_type_container', $edgt_masonry_gallery_item_icon_type_container);
	//Icon Packages
	$edgt_masonry_gallery_item_icon_hide_array = array();
	$edgt_masonry_gallery_item_icon_show_array = array();

	if(is_array($edgtIconCollections->iconCollections) && count($edgtIconCollections->iconCollections)) {

		$edgt_masonry_gallery_item_icon_collection_params = $edgtIconCollections->getIconCollectionsParams();

		foreach ($edgtIconCollections->iconCollections as $dep_collection_key => $dep_collection_object) {

			$edgt_masonry_gallery_item_icon_hide_array[$dep_collection_key] = '';

			$edgt_masonry_gallery_item_icon_show_array[$dep_collection_key] = '#edgtf_edgt_masonry_gallery_item_with_icon_'.$dep_collection_object->param.'_container';

			foreach ($edgt_masonry_gallery_item_icon_collection_params as $edgt_masonry_gallery_item_icon_collection_param) {

				if($edgt_masonry_gallery_item_icon_collection_param !== $dep_collection_object->param) {
					$edgt_masonry_gallery_item_icon_hide_array[$dep_collection_key].= '#edgtf_edgt_masonry_gallery_item_with_icon_'.$edgt_masonry_gallery_item_icon_collection_param.'_container,';
				}

			}

			$edgt_masonry_gallery_item_icon_hide_array[$dep_collection_key] = rtrim($edgt_masonry_gallery_item_icon_hide_array[$dep_collection_key], ',');
		}

	}

	$edgt_masonry_gallery_item_with_icon_icon_pack = new EdgeMetaField(
		'select',
		'edgt_masonry_gallery_item_with_icon_icon_pack',
		'font_awesome',
		'Icon Package',
		'Choose Icon Package',
		$edgtIconCollections->getIconCollections(),
		array(
			'dependence' => true,
			'hide' => $edgt_masonry_gallery_item_icon_hide_array,
			'show' => $edgt_masonry_gallery_item_icon_show_array
		)
	);
	$edgt_masonry_gallery_item_icon_type_container->addChild('edgt_masonry_gallery_item_with_icon_icon_pack', $edgt_masonry_gallery_item_with_icon_icon_pack);

	if(is_array($edgtIconCollections->iconCollections) && count($edgtIconCollections->iconCollections)) {

		foreach ($edgtIconCollections->iconCollections as $collection_key => $collection_object) {
			$icons_array = $collection_object->getIconsArray();

			$icon_collections_keys = $edgtIconCollections->getIconCollectionsKeys();

			unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

			$edgt_masonry_gallery_item_icon_hide_values = $icon_collections_keys;

			$edgt_masonry_gallery_item_icon_pack_container = new EdgeContainer('edgt_masonry_gallery_item_with_icon_'.$collection_object->param.'_container', 'edgt_masonry_gallery_item_with_icon_icon_pack', '', $edgt_masonry_gallery_item_icon_hide_values);
			$edgt_masonry_gallery_item_icon_type_container->addChild('edgt_masonry_gallery_item_with_icon_'.$collection_object->param.'_container', $edgt_masonry_gallery_item_icon_pack_container);

			$edgt_masonry_gallery_item_with_icon_icon_type = new EdgeMetaField('select', 'edgt_masonry_gallery_item_with_icon_'.$collection_object->param, '', $collection_object->title, 'Icon Package', $icons_array);
			$edgt_masonry_gallery_item_icon_pack_container->addChild('edgt_masonry_gallery_item_with_icon_'.$collection_object->param, $edgt_masonry_gallery_item_with_icon_icon_type);

		}

	}