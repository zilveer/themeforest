<?php
/*
Template Name: Posts grid 2 columns + left sidebar(Deprecated)
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<?php get_template_part('templates/header/top', 'page'); ?>

<section id="layout" class="blog-page dfd-equal-height-children">

	<?php get_template_part('templates/portfolio/template', 'top'); ?>

    <div class="row">
		<?php get_template_part('templates/sidebar', 'left'); ?>
        <div class="nine columns dfd-eq-height">

            <?php

            if (is_front_page()) {
                $page = get_query_var('page');
                $paged = ($page) ? $page : 1;
            } else {
                $page = get_query_var('paged');
                $paged = ($page) ? $page : 1;
            }

            $number_per_page = get_post_meta($post->ID, 'blog_number_to_display', true);
            $number_per_page = ($number_per_page) ? $number_per_page : '12';


            $selected_custom_categories = wp_get_object_terms($post->ID, 'category');
            if (!empty($selected_custom_categories)) {
                if (!is_wp_error($selected_custom_categories)) {
                    foreach ($selected_custom_categories as $term) {
                        $blog_cut_array[] = $term->term_id;
                    }
                }
            }

            $blog_custom_categories = (get_post_meta(get_the_ID(), 'blog_sort_category', true)) ? $blog_cut_array : '';

            if ($blog_custom_categories) {
                $blog_custom_categories = implode(",", $blog_custom_categories);
            }


            $args = array('post_type' => 'post',
                'posts_per_page' => $number_per_page,
                'paged' => $paged,
                'cat' => $blog_custom_categories
            );

			$save_image_ratio = !!get_post_meta($post->ID, 'save_image_ratio', true);

            $wp_query = new WP_Query($args);
			
            if (!have_posts()) :

				get_template_part('templates/post-nothins', 'found');

			endif; ?>

            <div id="grid-posts" class="col-2 and-side grid-left-sidebar">

                <?php while (have_posts()) : the_post();


                    get_template_part('templates/loop', 'grid');

                endwhile; ?>

            </div>

            <?php if ($wp_query->max_num_pages > 1) : ?>

                <nav class="page-nav">

                    <?php echo dfd_kadabra_pagination(); ?>

                </nav>

            <?php endif; ?>

            <?php wp_reset_postdata(); ?>

        </div>
    </div>
</section>
