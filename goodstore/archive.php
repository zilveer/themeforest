<?php get_header(); ?>
<?php
global $wp_query;
?>
<!-- Row for main content area -->
<?php
$content_width = jwLayout::content_width();
echo '<div id="content" class="' . implode(' ', $content_width) . ' ' . jwLayout::content_layout() . ' builder-section archive-content ' . get_post_type() . '">';
?>
<div  class="row"> 

    <?php
    $wp_query->type = jwOpt::get_option('boxes_type', 'default');
    $wp_query->pagination = jwOpt::get_option('blog_pagination', 'number');
    
    $wp_query->letter_excerpt = jwOpt::get_option('letter_excerpt_blog', 300);
    $wp_query->letter_excerpt_title = jwOpt::get_option('letter_title_blog', -1);
    $wp_query->element_blog_dateformat = jwOpt::get_option('element_blog_dateformat', 'M j, Y');

    $wp_query->blog_metadate = jwOpt::get_option('blog_metadate', '1');
    $wp_query->blog_ratings = jwOpt::get_option('blog_ratings', '1');
    
    $wp_query->blog_meta_type_icon =  jwOpt::get_option('blog_meta_type_icon', '1');
    $wp_query->blog_meta_author =  jwOpt::get_option('blog_meta_author', '1');
    $wp_query->blog_comments_count =  jwOpt::get_option('blog_comments_count', '1');
    $wp_query->blog_meta_category =  jwOpt::get_option('blog_meta_category', '1');
    $wp_query->box_size = jwLayout::parseColWidth();

if (is_category()) {
        $cat = get_the_category();
        if(!empty($cat)){
        $sliderid = jwOpt::get_option('slider', 'off', 'category', $cat[0]->term_id);
        if ($sliderid != 'off' && strlen($sliderid) > 0) {

            echo '<div class="' . implode(' ', $content_width) . ' ">';
            echo '<div class="row">';
            echo '<div class="' . implode(' ', $content_width) . '">';
            echo do_shortcode('[rev_slider ' . $sliderid . ']');
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

        $cat_desc = category_description();
        if (strlen($cat_desc) > 0) {
            echo '<div class="' . implode(' ', $content_width) . ' builder-section">';
            echo '<div class="row">';
            echo '<div class="' . implode(' ', $content_width) . '">';
            ?>

            <?php echo do_shortcode($cat_desc); ?>

            <?php
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>

        <div class="<?php echo implode(' ', $content_width); ?>">
            <?php
            global $jaw_data;
            jaw_template_set_var('bar_type', jwOpt::get_option('blog_bar_type', 'big'));
            jaw_template_set_var('box_title', single_cat_title('', false));
            jaw_template_set_var('bar_sort', jwOpt::get_option('blog_show_sorting', '1'));
            echo jaw_get_template_part('section_bar', 'simple-shortcodes');
            ?>

        </div>


        <?php
        }
    } else if (is_tag()) {
        $cat_desc = tag_description();
        if (strlen($cat_desc) > 0) {
            echo '<div class="' . implode(' ', $content_width) . ' builder-section">';
            echo '<div class="row">';
            echo '<div class="' . implode(' ', $content_width) . ' ">';
            ?>

            <?php echo $cat_desc; ?>

            <?php
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>

        <div class="<?php echo implode(' ', $content_width); ?>  builder-section">
            <?php
            global $jaw_data;
            jaw_template_set_var('bar_type', jwOpt::get_option('blog_bar_type', 'big'));
            jaw_template_set_var('box_title', __('Tag','jawtemplates').': '. single_tag_title('', false));
            jaw_template_set_var('bar_sort', jwOpt::get_option('blog_show_sorting', '1'));
            echo jaw_get_template_part('section_bar', 'simple-shortcodes');
            ?>

        </div>
        <?php
    }
    echo '<div class="' . implode(' ', $content_width) . ' builder-section">';
    echo '<div class="row">';
    echo '<div class="' . implode(' ', $content_width) . '">';
    if (is_category() || is_tag() || is_date()) {
        jaw_template_set_data($wp_query);
        echo jaw_get_template_part('blog');
    } else if (taxonomy_exists('jaw-portfolio-category') && is_tax('jaw-portfolio-category')) {
        jaw_template_set_data($wp_query);
        echo jaw_get_template_part('portfolio', 'custom-posts');
    } else if (taxonomy_exists('jaw-team-category') && is_tax('jaw-team-category')) {
        jaw_template_set_data($wp_query);
        echo jaw_get_template_part('team', 'custom-posts');
    } else if (taxonomy_exists('jaw-testimonial-category') && is_tax('jaw-testimonial-category')) {
        jaw_template_set_data($wp_query);
        echo jaw_get_template_part('testimonial', 'custom-posts');
    } else if (taxonomy_exists('jaw-faq-category') && is_tax('jaw-faq-category')) {
        jaw_template_set_data($wp_query);
        jaw_template_set_var('box_size', jwLayout::parseColWidth());
        echo jaw_get_template_part('faq', 'custom-posts');
    } else {
        echo jaw_get_template_part('custom', 'custom-posts');
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
    ?>  
</div>



</div><!-- End Content row -->
<?php get_sidebar(); ?>

<?php get_footer(); 