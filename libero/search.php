<?php $sidebar = libero_mikado_sidebar_layout(); ?>
<?php get_header(); ?>
<?php
global $wp_query;

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

if(libero_mikado_options()->getOptionValue('blog_page_range') != ""){
    $blog_page_range = esc_attr(libero_mikado_options()->getOptionValue('blog_page_range'));
} else{
    $blog_page_range = $wp_query->max_num_pages;
}
?>
<?php libero_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>
    <div class="mkd-container">
        <?php do_action('libero_mikado_after_container_open'); ?>
        <div class="mkd-container-inner clearfix">
            <div class="mkd-container">
                <?php do_action('libero_mikado_after_container_open'); ?>
                <div class="mkd-container-inner" >
                    <div class="mkd-blog-holder mkd-blog-type-standard">
                        <?php if(have_posts()) : while ( have_posts() ) : the_post();
								libero_mikado_get_post_format_html('standard');
                        endwhile; ?>
                            <?php
                            if(libero_mikado_options()->getOptionValue('pagination') == 'yes') {
                                libero_mikado_pagination($wp_query->max_num_pages, $blog_page_range, $paged);
                            }
                            ?>
                        <?php else: ?>
                            <div class="entry">
                                <p><?php esc_html_e('No posts were found.', 'libero'); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php do_action('libero_mikado_before_container_close'); ?>
                </div>
            </div>
        </div>
        <?php do_action('libero_mikado_before_container_close'); ?>
    </div>
<?php get_footer(); ?>