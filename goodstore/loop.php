<?php
global $wp_query, $jaw_data;
$old_query = $wp_query;
$type = jwOpt::get_option('boxes_type', 'mix');
$qs = array();

$qs['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;

$qs['category__in'] = jwOpt::get_option('blog_cat', '');

$qs['posts_per_page'] = jwOpt::get_option('blog_postscount', '6');
$qs['post_type'] = 'post';

$qs['order'] = jwOpt::get_option('blog_order', 'desc');
$qs['orderby'] = jwOpt::get_option('blog_orderby', 'date');
$qs['dateformat'] = jwOpt::get_option('element_blog_dateformat', 'F j, Y');

$blog_query = new WP_Query($qs);
$blog_query->type = $type;

$blog_query->letter_excerpt = jwOpt::get_option('letter_excerpt_blog', 300);
$blog_query->letter_excerpt_title = jwOpt::get_option('letter_title_blog', -1);
$blog_query->element_blog_dateformat = jwOpt::get_option('element_blog_dateformat', 'M j, Y');
$blog_query->pagination = jwOpt::get_option('blog_pagination', 'number');

$blog_query->blog_metadate = jwOpt::get_option('blog_metadate', '1');
$blog_query->blog_ratings = jwOpt::get_option('blog_ratings', '1');

$blog_query->blog_meta_type_icon = jwOpt::get_option('blog_meta_type_icon', '1');
$blog_query->blog_meta_author = jwOpt::get_option('blog_meta_author', '1');
$blog_query->blog_comments_count = jwOpt::get_option('blog_comments_count', '1');
$blog_query->blog_meta_category = jwOpt::get_option('blog_meta_category', '1');
$blog_query->box_size = jwLayout::parseColWidth();

$content_width = jwLayout::content_width();
?>

<div class="builder-section  <?php echo implode(' ', $content_width) . ' ' . jwLayout::content_layout(); ?>">
    <?php
    jaw_template_set_data($blog_query);
    echo jaw_get_template_part('blog');
    ?>
</div>

<?php
$wp_query = $old_query;

