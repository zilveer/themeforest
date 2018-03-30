<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/3/2015
 * Time: 9:16 AM
 */
global $g5plus_options;
$prefix = 'g5plus_';
$show_page_title = $g5plus_options['show_archive_title'];


$on_front = get_option('show_on_front');
$page_sub_title = strip_tags(term_description());
$page_title = '';
if (!have_posts()) {
    $page_title = esc_html__("Nothing Found", 'g5plus-handmade');
} elseif (is_home()) {
    if (($on_front == 'page' && get_queried_object_id() == get_post(get_option('page_for_posts'))->ID) || ($on_front == 'posts')) {
        $page_title = esc_html__("Blog", 'g5plus-handmade');
    } else {
        $page_title = '';
    }
} elseif (is_category()) {
    $page_title = single_cat_title('', false);
} elseif (is_tag()) {
    $page_title = single_tag_title(esc_html__("Tags: ", 'g5plus-handmade'), false);
} elseif (is_author()) {
    $page_title = sprintf(esc_html__('Author: %s', 'g5plus-handmade'), get_the_author());
} elseif (is_day()) {
    $page_title = sprintf(esc_html__('Daily Archives: %s', 'g5plus-handmade'), get_the_date());
} elseif (is_month()) {
    $page_title = sprintf(esc_html__('Monthly Archives: %s', 'g5plus-handmade'), get_the_date(_x('F Y', 'monthly archives date format', 'g5plus-handmade')));
} elseif (is_year()) {
    $page_title = sprintf(esc_html__('Yearly Archives: %s', 'g5plus-handmade'), get_the_date(_x('Y', 'yearly archives date format', 'g5plus-handmade')));
} elseif (is_search()) {
    $page_title = sprintf(esc_html__('Search Results for: %s', 'g5plus-handmade'), get_search_query());
} elseif (is_tax('post_format', 'post-format-aside')) {
    $page_title = esc_html__('Asides', 'g5plus-handmade');
} elseif (is_tax('post_format', 'post-format-gallery')) {
    $page_title = esc_html__('Galleries', 'g5plus-handmade');
} elseif (is_tax('post_format', 'post-format-image')) {
    $page_title = esc_html__('Images', 'g5plus-handmade');
} elseif (is_tax('post_format', 'post-format-video')) {
    $page_title = esc_html__('Videos', 'g5plus-handmade');
} elseif (is_tax('post_format', 'post-format-quote')) {
    $page_title = esc_html__('Quotes', 'g5plus-handmade');
} elseif (is_tax('post_format', 'post-format-link')) {
    $page_title = esc_html__('Links', 'g5plus-handmade');
} elseif (is_tax('post_format', 'post-format-status')) {
    $page_title = esc_html__('Statuses', 'g5plus-handmade');
} elseif (is_tax('post_format', 'post-format-audio')) {
    $page_title = esc_html__('Audios', 'g5plus-handmade');
} elseif (is_tax('post_format', 'post-format-chat')) {
    $page_title = esc_html__("Chats", 'g5plus-handmade');
} else {
    $page_title = esc_html__("Archives", 'g5plus-handmade');
}


//archive
$page_title_bg_image = '';
$page_title_height = '';
$cat = get_queried_object();
if ($cat && property_exists( $cat, 'term_id' )) {
    $page_title_bg_image = get_tax_meta($cat,$prefix.'page_title_background');
    $page_title_height = get_tax_meta($cat,$prefix.'page_title_height');
}


if(!$page_title_bg_image || ($page_title_bg_image === '')) {
    $page_title_bg_image = $g5plus_options['archive_title_bg_image'];
}


if (isset($page_title_bg_image) && isset($page_title_bg_image['url'])) {
    $page_title_bg_image_url = $page_title_bg_image['url'];
}

$breadcrumbs_in_page_title = isset($_GET['breadcrumbs']) ? $_GET['breadcrumbs'] : '';
if (!in_array($breadcrumbs_in_page_title, array('1','0'))) {
    $breadcrumbs_in_page_title = $g5plus_options['breadcrumbs_in_archive_title'];
}




$page_title_warp_class = array();
$page_title_warp_class[] = 'page-title-wrap archive-title-height';

$custom_styles = array();

if ($page_title_bg_image_url != '') {
    $page_title_warp_class[] = 'page-title-wrap-bg';
    $custom_styles[] = 'background-image: url(' . $page_title_bg_image_url . ');';
}

if ( ($page_title_height != '') && ($page_title_height > 0)) {
    $custom_styles[] = 'height:' . $page_title_height . 'px';
}



$custom_style= '';
if ($custom_styles) {
    $custom_style = 'style="'. join(';',$custom_styles).'"';
}


$page_title_parallax = $g5plus_options['archive_title_parallax'];

if (!empty($page_title_bg_image_url) && ($page_title_parallax == '1')) {
    $custom_style.= ' data-stellar-background-ratio="0.5"';
    $page_title_warp_class[] = 'page-title-parallax';
}

$page_title_text_align = $g5plus_options['archive_title_text_align'];
if (!isset($page_title_text_align) || empty($page_title_text_align)) {
    $page_title_text_align = 'left';
}

$page_title_warp_class[] = 'page-title-' . $page_title_text_align;


$section_page_title_class = array('section-page-title archive-title-margin');
$page_title_layout = $g5plus_options['archive_title_layout'];
if (in_array($page_title_layout,array('container','container-fluid'))) {
    $section_page_title_class[] = $page_title_layout;
}


?>

<?php if (($show_page_title == 1) || ($breadcrumbs_in_page_title == 1)) : ?>
    <div class="<?php echo join(' ',$section_page_title_class) ?>">
        <?php if ($show_page_title == 1) : ?>
            <section class="<?php echo join(' ',$page_title_warp_class); ?>" <?php echo wp_kses_post($custom_style); ?>>
                <div class="page-title-overlay"></div>
                <div class="container">
                    <div class="page-title-inner block-center">
                        <div class="block-center-inner">
                            <h1><?php echo esc_html($page_title); ?></h1>
                            <?php if ($page_sub_title != '') : ?>
                                <span class="page-sub-title"><?php echo esc_html($page_sub_title) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <?php if($breadcrumbs_in_page_title == 1) : ?>
            <section class="breadcrumb-wrap">
                <div class="container">
                    <?php g5plus_the_breadcrumb(); ?>
                </div>
            </section>
        <?php endif; ?>
    </div>
<?php endif; ?>


