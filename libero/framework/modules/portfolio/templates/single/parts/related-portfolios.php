<?php
if(libero_mikado_options()->getOptionValue('portfolio_single_hide_related') !== 'yes') :
$query = libero_mikado_get_related_post_type(get_the_ID(), array('posts_per_page' => '4'));
$categories = wp_get_post_terms(get_the_ID(), 'portfolio-category');
$category_html = '<div class="mkd-ptf-category-holder">';
$k = 1;
foreach ($categories as $cat) {
    $category_html .= '<span>'.$cat->name.'</span>';
    if (count($categories) != $k) {
        $category_html .= ' | ';
    }
    $k++;
}
$category_html .= '</div>';

if(is_object($query)) { ?>
<div class="mkd-related-projects">
    <h4><?php esc_html_e('Related Projects','libero'); ?></h4>
    <div class="mkd-portfolio-list-holder-outer mkd-ptf-standard mkd-ptf-four-columns">
        <div class="mkd-portfolio-list-holder clearfix">
            <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

                <article class="mkd-portfolio-item mix">
                    <div class = "mkd-item-image-holder">
                        <a href="<?php echo esc_url(get_permalink()); ?>">
                            <?php
                            echo get_the_post_thumbnail(get_the_ID(),'libero_mikado_portrait');
                            ?>
                        </a>
                    </div>
                    <div class="mkd-item-text-holder">
                        <h4 class="mkd-item-title">
                            <a href="<?php echo esc_url(get_permalink()) ?>">
                            <?php echo esc_attr(get_the_title()); ?>
                            </a>
                        </h4>
                        <?php echo wp_kses_post($category_html); ?>
                    </div>
                </article>

            <?php
            endwhile;
            endif;
            wp_reset_postdata();
            ?>
            <div class="mkd-gap"></div>
            <div class="mkd-gap"></div>
            <div class="mkd-gap"></div>
            <div class="mkd-gap"></div>

        </div>
    </div>
</div>
<?php }
endif;
?>