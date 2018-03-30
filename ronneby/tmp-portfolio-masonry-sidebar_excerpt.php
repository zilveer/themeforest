<?php
/*
Template Name: Portfolio grid + right sidebar Excerpt(Deprecated)
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('templates/header/top', 'page'); ?>

<section id="layout" class="portfolio-page dfd-sidebar-right dfd-equal-height-children">
	
	<?php get_template_part('templates/portfolio/template', 'top'); ?>

    <div class="row">
        <div class="nine columns dfd-eq-height">
            <?php

            $folio_number    = get_post_meta($post->ID, 'folio_number_to_display', true);
            $number_per_page = ($folio_number) ? $folio_number : '16';

            $selected_custom_categories = wp_get_object_terms($post->ID, 'my-product_category');
            if (!empty($selected_custom_categories)) {
                if (!is_wp_error($selected_custom_categories)) {
                    foreach ($selected_custom_categories as $term) {
                        $blog_cut_array[] = $term->term_id;
                    }
                }
            }

            $folio_custom_categories = (get_post_meta(get_the_ID(), 'folio_sort_category', true)) ? $blog_cut_array : '';

            if ($folio_custom_categories) {
                $folio_custom_categories = implode(",", $folio_custom_categories);
            }

            if (is_front_page()) {
                $page = get_query_var('page');
                $paged = ($page) ? $page : 1;
            } else {
                $page = get_query_var('paged');
                $paged = ($page) ? $page : 1;
            }

			$folio_hover_style_option = get_post_meta($post->ID, 'folio_hover_style', true);
			
			$folio_hover_style = !empty($folio_hover_style_option) ? $folio_hover_style_option : 'portfolio-hover-style-1';

            ?>

            <div id="grid-folio" class="col-3 row with-excerpt">

                <?php

                if ($folio_custom_categories) {
                    $args = array(
                        'post_type' => 'my-product',
                        'posts_per_page' => $number_per_page,
                        'paged' => $paged,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'my-product_category',
                                'field' => 'id',
                                'terms' => $blog_cut_array,
                            )
                        )
                    );
                } else {
                    $args = array(
                        'post_type' => 'my-product',
                        'posts_per_page' => $number_per_page,
                        'paged' => $paged
                    );
                }

                $wp_query = new WP_Query($args);
				
                while ($wp_query->have_posts()) : $wp_query->the_post();

                    if (has_post_thumbnail()) {
                        $thumb = get_post_thumbnail_id();
                        $img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
                    } else {
                        $img_url = get_template_directory_uri() . '/img/no-image-large.jpg';
                    }
                    $article_image = dfd_aq_resize($img_url, 400, 999, false); //resize & crop img
					
					if(!$article_image) {
						$article_image = $img_url;
					}

                    ?>

                <article class="six columns project <?php echo esc_attr($folio_hover_style); ?>">
					<div class="cover">
						<div class="entry-thumb entry-thumb-small-cros">
							<img src="<?php echo esc_url($article_image); ?>" alt="<?php the_title(); ?>"/>
							<?php get_template_part('templates/portfolio/entry-hover'); ?>
						</div>

						<div class="feature-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>

						<?php get_template_part('templates/folio', 'terms'); ?>

						<div class="entry-content">
							<?php the_excerpt(); ?>
							<a href="<?php the_permalink(); ?>" class="more-button chaffle" title="" data-lang="en"><?php _e('More', 'dfd'); ?></a>
						</div>
                    </div>
                </article>

                <?php endwhile;?>

            </div>

            <?php if ($wp_query->max_num_pages > 1) : ?>

                <nav class="page-nav">

                    <?php echo dfd_kadabra_pagination(); ?>

                </nav>

            <?php endif; ?>

            <?php
            wp_reset_postdata();
            ?>

        </div>

        <?php get_template_part('templates/sidebar', 'right'); ?>

    </div>
</section>
