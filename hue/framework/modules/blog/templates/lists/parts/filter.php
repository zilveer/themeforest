<?php
$filter = esc_attr(hue_mikado_options()->getOptionValue('masonry_filter'));

if($filter == 'yes') {
    $page_category = get_post_meta(hue_mikado_get_page_id(), "mkd_blog_category_meta", true);
    if(is_category()) {
        $page_category = get_query_var('cat');
    }
    if($page_category == "" && !is_category()) {
        $args       = array(
            'parent' => 0
        );
        $categories = get_categories($args);
    } else {
        $args       = array(
            'parent' => $page_category
        );
        $categories = get_categories($args);
    }
    if(count($categories) > 0) { ?>
        <div class="mkd-filter-blog-holder" style="padding: <?php echo esc_attr(hue_mikado_options()->getOptionValue('blog_filter_padding'));?>; margin: <?php echo esc_attr(hue_mikado_options()->getOptionValue('blog_filter_margin'));?>; text-align: <?php echo esc_attr(hue_mikado_options()->getOptionValue('blog_filter_position'));?>; color: <?php echo esc_attr(hue_mikado_options()->getOptionValue('blog_filter_text_color')); ?>; background-color: <?php echo hue_mikado_rgba_color(hue_mikado_options()->getOptionValue('blog_filter_background_color'), hue_mikado_options()->getOptionValue('blog_filter_background_transparency'));?>">
            <div class="mkd-filter-blog">
                <ul>
                    <li class="mkd-filter mkd-active" data-filter="*">
                        <span><?php esc_html_e('All', 'hue'); ?></span></li>
                    <?php foreach($categories as $category) { ?>
                        <li class="mkd-filter" data-filter="<?php echo ".category-".esc_attr($category->slug); ?>">
                            <span><?php echo esc_html($category->name); ?></span></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php }
}
?>
