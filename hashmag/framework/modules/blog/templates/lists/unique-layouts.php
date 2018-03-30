<?php

$params = '';
$title = '';

if ($archive_type == 'category'){
	$posts_in_archive = $posts_in_category;
	$params .= ' category_id="'.$category_id.'"';
    $title = esc_html__('Archive','hashmag');
}
elseif($archive_type == 'author'){
	$posts_in_archive = '';
	$params .= ' author_id="'.$author_id.'"';
	$params .= ' title="'.$layout_title.'"';
    $title = esc_html__('Top Stories','hashmag');
}
elseif($archive_type == 'tag'){
	$posts_in_archive = '';
	$params .= ' tag_slug="'.$tag_slug.'"';
}

if($thumb_image_width != '' && $thumb_image_height != '') {
	$params .= ' thumb_image_size="custom_size"';
	$params .= ' thumb_image_width="'.$thumb_image_width.'"';
	$params .= ' thumb_image_height="'.$thumb_image_height.'"';
}

if(isset($title_length) && $title_length != ''){
    $params .= ' title_length="'.$title_length.'"';
}

if(isset($excerpt_length) && $excerpt_length != ''){
	$params .= ' excerpt_length="'.$excerpt_length.'"';
}

if (isset($title) && $title != '') {
    $params .= ' title="'.$title.'"';
}

if(isset($display_category) && $display_category != ''){
    $params .= ' display_category="'.$display_category.'"';
}


if ($template_type == "type_standard") {

    $sidebar_params = '';

    if($posts_in_archive > 8 || $posts_in_archive == ''){
        $per_page  = $posts_per_page !== 0 ? $posts_per_page : 8;
        $number_of_posts = $per_page;
        $params .= ' number_of_posts="'.$number_of_posts.'"';
    } else {
        $number_of_posts = $posts_in_archive;
        $params .= ' number_of_posts="'.$number_of_posts.'"';
    }

    $column_number = 1;
    $params .= ' column_number="'.$column_number.'"';

    $params .= ' title_tag="h2"';

    $display_pagination = 'yes';
    $params .= ' display_pagination="'.$display_pagination.'"';

    $params .= ' pagination_type="'.$pagination_type.'"';

    /* options for sidebar */

    $title = 'Popular';
    $sidebar_params = ' title="'.$title.'"';

    $number_of_posts = '4';
    $sidebar_params .= ' number_of_posts="'.$number_of_posts.'"';

    $column_number = 1;
    $sidebar_params .= ' column_number="'.$column_number.'"';

    $sidebar_params .= ' title_tag="h3"';

    $sidebar_params .= ' display_excerpt="no"';

    $sidebar_params .= ' sort="popular"';

    $sidebar_params .= ' thumb_image_size="custom_size"';

    $thumb_image_width = 303;
    $sidebar_params .= ' thumb_image_width="'.$thumb_image_width.'"';

    $thumb_image_height = 265;
    $sidebar_params .= ' thumb_image_height="'.$thumb_image_height.'"';

}
elseif ($template_type == "type1") {

	if($posts_in_archive > 8 || $posts_in_archive == ''){
        $per_page  = $posts_per_page !== 0 ? $posts_per_page : 8;
		$number_of_posts = $per_page;
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	} else {
		$number_of_posts = $posts_in_archive;
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	}

	$column_number = 1;
	$params .= ' column_number="'.$column_number.'"';

    $params .= ' title_tag="h2"';

	$display_pagination = 'yes';
	$params .= ' display_pagination="'.$display_pagination.'"';

	$params .= ' pagination_type="'.$pagination_type.'"';

	$extra_class_name = 'unique-category-template-one';
	$params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template_type == "type2") {

    $per_page  = $posts_per_page !== 0 ? $posts_per_page : 8;
    $params .= ' number_of_posts="'.$per_page.'"';

    $column_number = 1;
    $params .= ' column_number="'.$column_number.'"';

    $display_pagination = 'yes';
    $params .= ' display_pagination="'.$display_pagination.'"';

    $params .= ' pagination_type="'.$pagination_type.'"';

    $custom_thumb_image_width = $thumb_image_width != '' ? $thumb_image_width : 374;
    $params .= ' custom_thumb_image_width="'.$custom_thumb_image_width.'"';

    $custom_thumb_image_height = $thumb_image_height != '' ? $thumb_image_height : 233;
    $params .= ' custom_thumb_image_height="'.$custom_thumb_image_height.'"';

    $custom_thumb_image_width = $thumb_image_width != '' ? $thumb_image_width : 374;
    $params .= ' custom_thumb_image_width="'.$custom_thumb_image_width.'"';

    if(!isset($excerpt_length) || $excerpt_length == '') {
        $params .= ' excerpt_length="29"';
    }

    $extra_class_name = 'unique-category-template-two';
    $params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template_type == "type3") {

    if($posts_in_archive > 8 || $posts_in_archive == ''){
        $per_page  = $posts_per_page !== 0 ? $posts_per_page : 8;
        $number_of_posts = $per_page;
        $params .= ' number_of_posts="'.$number_of_posts.'"';
    } else {
        $number_of_posts = $posts_in_archive;
        $params .= ' number_of_posts="'.$number_of_posts.'"';
    }

    $column_number = 2;
    $params .= ' column_number="'.$column_number.'"';

    $display_pagination = 'yes';
    $params .= ' display_pagination="'.$display_pagination.'"';

    $params .= ' pagination_type="'.$pagination_type.'"';

    $extra_class_name = 'unique-category-template-three';
    $params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template_type == "type4") {

    if($posts_in_archive > 8 || $posts_in_archive == ''){
        $per_page  = $posts_per_page !== 0 ? $posts_per_page : 4;
        $number_of_posts = $per_page;
        $params .= ' number_of_posts="'.$number_of_posts.'"';
    } else {
        $number_of_posts = $posts_in_archive;
        $params .= ' number_of_posts="'.$number_of_posts.'"';
    }

    $column_number = 3;
    $params .= ' column_number="'.$column_number.'"';

    $display_pagination = 'yes';
    $params .= ' display_pagination="'.$display_pagination.'"';

    $params .= ' pagination_type="'.$pagination_type.'"';

    $extra_class_name = 'unique-category-template-one';
    $params .= ' extra_class_name="'.$extra_class_name.'"';

}

if ($template_type == 'type_standard') { ?>
    <div class="mkdf-unique-category-layout mkdf-two-columns clearfix">
        <div class="mkdf-two-columns-inner">
            <div class="mkdf-column">
                <div class="mkdf-column-inner">
                    <?php echo do_shortcode("[mkdf_post_layout_one $params]"); // XSS OK ?>
                </div>
            </div>
            <div class="mkdf-column">
                <div class="mkdf-column-inner">
                    <?php echo do_shortcode("[mkdf_post_layout_one $sidebar_params]"); // XSS OK ?>
                </div>
            </div>
        </div>
    </div>


<?php } else { ?>

<div class="mkdf-unique-category-layout clearfix">
	<?php
		switch ($template_type) {
			case 'type1':
				echo do_shortcode("[mkdf_post_layout_one $params]"); // XSS OK
			break;
			case 'type2':
				echo do_shortcode("[mkdf_post_layout_six $params]"); // XSS OK
			break;
			case 'type3':						
				echo do_shortcode("[mkdf_post_layout_one $params]"); // XSS OK
			break;
			case 'type4':						
				echo do_shortcode("[mkdf_post_layout_one $params]"); // XSS OK
			break;
		}
    ?>
</div>

<?php }