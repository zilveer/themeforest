<?php

global $zorka_data;
$on_front = get_option('show_on_front');
$page_on_front = get_option('page_on_front');

$cat = get_queried_object();

if ($cat && property_exists($cat, 'term_id')) {
    $page_title_background_arr = get_tax_meta($cat, 'zorka_custom_page_title_background');
    if (is_array($page_title_background_arr)) {
        $page_title_background = $page_title_background_arr['url'];
    }
}

if (empty($page_title_background)) {
    $page_title_background = $zorka_data['page-title-background'];
}

if (!have_posts()) {
    $page_title = esc_html__("Nothing Found",'zorka');
}elseif (is_home()) {
    if ($on_front=='posts' || ($on_front == 'page' && ($page_on_front==0 || get_queried_object_id() == get_post(get_option('page_for_posts'))->ID) ) ) {
        $page_title = esc_html__("Blog",'zorka');
    } else {
        $page_title = '';
    }
} elseif (is_category()) {
    $page_title =  single_cat_title('',false);
    $page_sub_title = strip_tags( category_description());
} elseif (is_tag()) {
    $page_title = single_tag_title(__("Tags: ",'zorka'),false);
} elseif (is_author()){
    $page_title = sprintf(__('Author: %s','zorka'),get_the_author());
} elseif (is_day()) {
    $page_title = sprintf(__('Daily Archives: %s','zorka'),get_the_date());
} elseif (is_month()){
    $page_title = sprintf(__('Monthly Archives: %s','zorka'),get_the_date(_x('F Y','monthly archives date format','zorka')));
} elseif (is_year()) {
    $page_title = sprintf(__('Yearly Archives: %s','zorka'),get_the_date(_x('Y','yearly archives date format','zorka')));
} elseif (is_search()) {
    $page_title = sprintf(__('Search Results for: %s','zorka'),get_search_query());
} elseif (is_tax( 'post_format', 'post-format-aside' )) {
    $page_title = esc_html__('Asides','zorka');
} elseif (is_tax( 'post_format', 'post-format-gallery' )){
    $page_title = esc_html__('Galleries','zorka');
} elseif (is_tax( 'post_format', 'post-format-image' )) {
    $page_title =  esc_html__('Images','zorka');
} elseif (is_tax( 'post_format', 'post-format-video' )) {
    $page_title =  esc_html__('Videos','zorka');
} elseif (is_tax( 'post_format', 'post-format-quote' )) {
    $page_title =  esc_html__('Quotes','zorka');
}elseif (is_tax( 'post_format', 'post-format-link' )) {
    $page_title =  esc_html__('Links','zorka');
} elseif (is_tax( 'post_format', 'post-format-status' )) {
    $page_title =  esc_html__('Statuses','zorka');
} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
    $page_title =  esc_html__('Audios','zorka');
} elseif (is_tax( 'post_format', 'post-format-chat' )) {
    $page_title = esc_html__("Chats",'zorka');
}  else {
  $page_title = esc_html__("Archives",'zorka');
}

$class = array();

$class[] = 'page-title-wrapper page-title-archive-wrapper';
//$class[] = 'border-bottom';


$header_layout = get_post_meta(get_the_ID(),'header-layout',true);
if (!isset($header_layout) || $header_layout == 'none' || $header_layout == '') {
    $header_layout =  $zorka_data['header-layout'];
}
if($header_layout == '4' || $header_layout =='8'){
    $class[]='dark';
}
$custom_style = '';
if (!empty($page_title_background)) {
    $class[]='dark';
    $class[]='page-title-image';
    $custom_style = 'style="background-image: url('.$page_title_background.');"';
}


$class_name = join(' ',$class);
if (empty($page_title)) return;
?>

<section class="<?php echo esc_attr($class_name) ?>" <?php echo wp_kses_post($custom_style); ?>>
    <div class="page-title-inner">
        <div class="container">
            <h1><?php echo esc_html($page_title);?></h1>
            <?php if (!empty($page_sub_title)) : ?>
                <span><?php echo esc_html($page_sub_title);?></span>
            <?php endif; ?>
        </div>
    </div>
</section>



