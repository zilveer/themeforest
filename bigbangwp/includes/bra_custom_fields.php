<?php
add_action( 'init', 'create_custom_fields' );
function create_custom_fields() {
	
$all_portfolios = get_terms('portfolio_category');
$count = count($all_portfolios);
if ( $count > 0 ){
 foreach ( $all_portfolios as $term ) {
   $all_portfolio_terms[$term->term_id] = $term->name;                   
 }
}          

	


$all_categories = get_terms( 'category'); //get_all_category_ids();
foreach ($all_categories as $category) {
	$all_category_ids[] = $category->term_id;
}
$no_of_categories = count($all_category_ids);  

$all_page_names = all_names("page");
$all_page_titles = all_titles("page");
$all_page_ids = all_IDs("page");
$no_of_pages = count($all_page_ids);

$all_post_names = all_names("post");
$all_post_titles = all_titles("post");
$all_post_ids = all_IDs("post");
$no_of_posts = count($all_post_ids);

$categories_array = array(); // "id" => "name"
$pages_array = array(); // "id" => "title"

for ($i = 0 ; $i < $no_of_pages ; $i++) {
	$pages_array[$all_page_ids[$i]] = $all_page_titles[$i];
}

foreach ($all_category_ids as $cat_id) {
	$categories_array[$cat_id] = get_cat_name($cat_id);	
}


if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_page',
		'title' => 'Page',
		'fields' => array (
			array (
				'key' => 'field_5440f5c2bef44',
				'label' => 'Centered title at the top of the page',
				'name' => BRANKIC_VAR_PREFIX . 'centered_title',
				'type' => 'text',
				'instructions' => 'Alternate title (if you want to have different one than a page name)',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5440f5ffb3d1e',
				'label' => 'Select Blog Category',
				'name' => BRANKIC_VAR_PREFIX . 'select_blog_category',
				'type' => 'select',
				'instructions' => 'If selected, Blog page template will be used',
				'choices' => $categories_array,
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5440f633694de',
				'label' => 'Hide title from the begining of this page',
				'name' => BRANKIC_VAR_PREFIX . 'hide_title',
				'type' => 'select',
				'instructions' => '',
				'choices' => array (
					'no' => 'No',
					'yes' => 'Yes',
				),
				'default_value' => 'no',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5440f65eb739a',
				'label' => 'Choose background image from Featured / Extra Images',
				'name' => BRANKIC_VAR_PREFIX . 'background_image',
				'type' => 'select',
				'instructions' => '',
				'choices' => array (
					'' => '',
					'featured' => 'Featured',
					'extra-image-1' => 'Extra Image 1',
					'extra-image-2' => 'Extra Image 2',
					'extra-image-3' => 'Extra Image 3',
					'extra-image-4' => 'Extra Image 4',
					'extra-image-5' => 'Extra Image 5',
					'extra-image-6' => 'Extra Image 6',
					'extra-image-7' => 'Extra Image 7',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5440f6971a433',
				'label' => 'Tile background image. If No is selected, image will be stretched.',
				'name' => BRANKIC_VAR_PREFIX . 'tile_background',
				'type' => 'select',
				'choices' => array (
					'no' => 'No',
					'yes' => 'Yes',
				),
				'default_value' => 'no',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_page-portfolio',
		'title' => 'Page Portfolio',
		'fields' => array (
			array (
				'key' => 'field_5440f2f02537e',
				'label' => 'Text next to page title',
				'name' => BRANKIC_VAR_PREFIX . 'subtitle',
				'type' => 'text',
				'instructions' => 'Additional description next the title',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'portfolio_item',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_post-page',
		'title' => 'Post Page',
		'fields' => array (
			array (
				'key' => 'field_5440f334fa0ca',
				'label' => 'Select Sidebar',
				'name' => BRANKIC_VAR_PREFIX . 'select_sidebar',
				'type' => 'select',
				'instructions' => 'Select sidebar for this post/page only. If empty, default one wil be used',
				'choices' => array (
					'' => 'No sidebar',
					'default' => 'Default',
					"optional_1" => "Optional 1",
					"optional_2" => "Optional 2",
					"optional_3" => "Optional 3",
				),
				'default_value' => 'Default',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5440f3c6c6ba3',
				'label' => 'Hide featured image',
				'name' => BRANKIC_VAR_PREFIX . 'hide_featured_image',
				'type' => 'select',
				'instructions' => 'Hide featured image above the post content',
				'choices' => array (
					'yes' => 'Yes',
					'no' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_post-page-portfolio',
		'title' => 'Post Page Portfolio',
		'fields' => array (
			array (
				'key' => 'field_5440ef38a7314',
				'label' => 'Add class \'title\' to all headings',
				'name' => BRANKIC_VAR_PREFIX . 'add_class_title',
				'type' => 'select',
				'choices' => array (
					'yes' => 'Yes',
					'no' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'portfolio_item',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_post-portfolio',
		'title' => 'Post Portfolio',
		'fields' => array (
			array (
				'key' => 'field_5440f26cdaa76',
				'label' => 'Video URL',
				'name' => BRANKIC_VAR_PREFIX . 'video_link',
				'type' => 'text',
				'instructions' => 'You Tube, Vimeo, SWF, mov (check the <a href=\'http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/\'>prettyPhoto demo source</a>)',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5440f44748154',
				'label' => 'Additional HTML (Portfolio format only)',
				'name' => BRANKIC_VAR_PREFIX . 'additional_html',
				'type' => 'textarea',
				'instructions' => 'Perfect for embeds, or iFrames on portfolio single page below the sliders',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'none',
			),
			array (
				'key' => 'field_5440f4a597bc1',
				'label' => 'Disable Slider (Portfolio format only)',
				'name' => BRANKIC_VAR_PREFIX . 'disable_slider',
				'type' => 'select',
				'instructions' => 'Show all images at once (not in slider)',
				'choices' => array (
					'no' => 'No',
					'yes' => 'Yes',
					'' => '',
				),
				'default_value' => 'no',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5440f4e43430a',
				'label' => 'Twin slides (Portfolio format only)',
				'name' => BRANKIC_VAR_PREFIX . 'twin_slides',
				'type' => 'select',
				'instructions' => 'If you have even number of Extra images portrait oriented this option is useful',
				'choices' => array (
					'no' => 'No',
					'yes' => 'Yes',
				),
				'default_value' => 'no',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5440f576a66b2',
				'label' => 'Select parent page for this item (Portfolio format only)',
				'name' => BRANKIC_VAR_PREFIX . 'parent',
				'type' => 'select',
				'instructions' => 'This is where you\'ll be sent when you click on ALL icon',
				'choices' => $pages_array,
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'portfolio_item',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
}

}

?>