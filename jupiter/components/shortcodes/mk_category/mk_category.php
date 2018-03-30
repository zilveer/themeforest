<?php

global $mk_options;
$path = pathinfo(__FILE__) ['dirname'];

include ($path . '/config.php');

$html = file_get_contents($path . '/template.php');
$html = phpQuery::newDocument($html);
$id = Mk_Static_Files::shortcode_id();

$container = pq('.mk-category-loop');
$container->attr('id', 'mk-category-loop-' . $id);
$container->addClass($title_hover.'-title-effect');
$container->addClass($image_hover.'-image-effect');
$container->addClass($layout_style.'-layout');
$container->addClass('mk--row');
$container->addClass($el_class);

// Classes for js traversing
if($layout_style == 'masonry') {
    $container->addClass('js-masonry');
    $container->find('.mk-loop-item')->addClass('js-masonry-item');
}

$item = $container->find('.mk-loop-item')->remove();
$grid_width = $mk_options['grid_width'];



/*
* Converts slugs to term Ids
*
*/
if(!function_exists('get_terms_by_slug')) {
    function get_terms_by_slug($slugs, $taxonomy)
    {
        $terms = explode(',', $slugs);
        foreach ($terms as $term) {
            $term = get_term_by('slug', $term, $taxonomy );
            $term_ids[] = $term->term_id;
        }
        return $term_ids;
    }
}


switch ($feed) {
    case 'post':
        $categories = get_categories(array(
            'include' => $specific_categories_post
        ));

        break;

    case 'portfolio':
        $categories = get_terms('portfolio_category', array(
            'include' => get_terms_by_slug($specific_categories_other, 'portfolio_category')
        ));
        break;

    case 'news':
        $categories = get_terms('news_category', array(
            'include' => get_terms_by_slug($specific_categories_other, 'news_category')
        ));
        break;

    case 'product':
        $categories = get_terms('product_cat', array(
            'include' => get_terms_by_slug($specific_categories_other, 'product_cat')
        ));
        break;
}

switch ($columns) {
    case 4:
            $column_class = 'mk--col mk--col--3-12';
            $image_width = round($grid_width/4) - 28;
        break;
    case 3:
            $column_class = 'mk--col mk--col--4-12';
            $image_width = round($grid_width/3) - 33;
        break;
    case 2:
            $column_class = 'mk--col mk--col--1-2';
            $image_width = round($grid_width/2) - 38;
        break;

    default:
            $column_class = 'mk--col mk--col--1-2';
            $image_width = round($grid_width/2) - 38;
        break;
}


foreach ($categories as $category) {
    $each_item = $item->clone();
    $item_holder = $each_item->find('.item-holder');
    $item_caption = $item_holder->find('figcaption');
    $category_link = get_category_link( $category->term_id );
    //$each_item->find('.view-more')->attr('href', '#!'); //TODO : add links once styling is finished

    $each_item->addClass($column_class);

    if($feed == 'product') {
    	$image_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
    } else {
    	$image_id = is_array(get_tax_meta($category->term_id, 'mk_image_field_id')) ? get_tax_meta($category->term_id, 'mk_image_field_id') ['id'] : false;
    }


    $image_src = Mk_Image_Resize::resize_by_id($image_id, $image_size, $image_width, $row_height, $crop = true, $dummy = true);

    $each_item->find('.item-thumbnail')->attr('src', $image_src);

    //Adding html elements according to style
    if($title_hover == 'none' || $title_hover == 'simple' || $title_hover == 'framed') {
        $item_caption->append('<div class="caption"></div>')
                     ->find('.caption')
                     ->append('<div class="centered"></div>')
                     ->find('.centered')
                     ->append('<span class="item-title"></span>')
                     ->find('.item-title')
                     ->html($category->name);

        if($description == 'true') {
            if ($category->description) {
                //$each_item->find('.item-desc')->html($category->description);
                $item_caption->find('.centered')
                             ->append('<span class="item-desc"></span>')
                             ->find('.item-desc')
                             ->html($category->description);
            }
        }

        $item_caption->append('<a class="view-more"></a>')
                    ->find('.view-more')
                    ->attr('href', esc_url( $category_link ) );

    }else if ($title_hover == 'modern' || $title_hover == 'editorial') {
        $item_caption->append('<span class="item-title"></span>')
                     ->find('.item-title')
                     ->html($category->name);

        if($description == 'true') {
            if ($category->description) {
                $item_caption->append('<span class="item-desc"></span>')
                             ->find('.item-desc')
                             ->html($category->description);
            }
        }

        $item_caption->append('<a class="view-more"></a>')
                     ->find('.view-more')
                     ->attr('href', esc_url( $category_link ) );
    }
    $item_caption->append('<div class="item-overlay"></div>');
    $each_item->appendTo($container);
}
/**
 * Custom CSS Output
 * ==================================================================================
 */

Mk_Static_Files::addCSS('
    #mk-category-loop-'.$id.' .mk-loop-item {
        padding-left: '.($gutter / 2).'px;
        padding-right: '.($gutter / 2).'px;
        padding-bottom: '.$gutter.'px;
    }
    #mk-category-loop-'.$id.' .mk-loop-item .item-holder .item-title,
    #mk-category-loop-'.$id.' .mk-loop-item .item-holder .item-desc{
        color: '.$text_color.';
    }
    #mk-category-loop-'.$id.' .mk-loop-item .item-holder figcaption .item-overlay {
        background-color: '.$overlay_color.';
    }
', $id);
if ($title_hover == 'editorial' ) {
    Mk_Static_Files::addCSS('
        #mk-category-loop-'.$id.' .mk-loop-item .item-holder .item-title::after{
            background-color: '.$text_color.';
        }
    ', $id);
}else if ($title_hover == 'framed' ) {
    Mk_Static_Files::addCSS('
        #mk-category-loop-'.$id.' .mk-loop-item .item-holder figcaption::before{
            border-color: '.$text_color.';
        }
    ', $id);
}

// if($image_hover == 'gradient' || $image_hover == 'zoom' || $image_hover == 'slide' || $image_hover == 'blur' ) {
//     Mk_Static_Files::addCSS('
//         #mk-category-loop-'.$id.' .mk-loop-item .item-holder {
//             background-color: '.$overlay_color.';
//         }
//     ');
// }

print $html;