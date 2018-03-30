<?php
/*
Template Name: Posts with left aligned image(Deprecated)
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_ronneby;
get_template_part('templates/header/top', 'page');

$save_image_ratio = !!get_post_meta($post->ID, 'save_image_ratio', true);
?>
<section id="layout" class="blog-page dfd-equal-height-children">

	<?php get_template_part('templates/portfolio/template', 'top'); ?>

    <div class="row">

        <div class="blog-section sidebar-right post-format-left-image">
            <section id="main-content" role="main" class="nine columns dfd-eq-height">
	    <?php //get_template_part('templates/blog', 'top'); ?>

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


                $wp_query = new WP_Query($args);
				
				if (!have_posts()) :

					get_template_part('templates/post-nothins', 'found');

				endif; ?>

                <?php while (have_posts()) : the_post(); ?>

                    <article <?php post_class('module-eq-height'); ?>>

                        <div class="row some-aligned-post left-thumbed">
                            <div class="entry-media six columns">
								<div class="dfd-vertical-aligned">
									<?php

									switch(true) {
										case has_post_format('video'):
											get_template_part('templates/post', 'video');
											break;
										case has_post_format('audio'):
											get_template_part('templates/post', 'audio');
											break;
										case has_post_format('gallery'):
											get_template_part('templates/post', 'gallery');
											break;
										case has_post_format('quote'):
												get_template_part('templates/post', 'quote');
											break;
										default:
											get_template_part('templates/thumbnail/post');
									}

									?>
								</div>
                            </div>
                            <div class="six columns post-data">
								<div class="clearfix dfd-vertical-aligned">
									<div class="entry-meta-wrap">
										<?php if (isset($dfd_ronneby['post_header']) && $dfd_ronneby['post_header']) : ?>
											<div class="dfd-blog-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</div>
											<?php get_template_part('templates/entry-meta', 'post-bottom'); ?>
										<?php endif; ?>

									</div>
									<div class="entry-content">
										<?php $dfd_post_content = get_the_excerpt(); ?>
										<?php echo !empty($dfd_post_content) ? '<p>'.$dfd_post_content.'</p>' : ''; ?>
										<?php $read_more_style = (isset($dfd_ronneby['style_hover_read_more']) && !empty($dfd_ronneby['style_hover_read_more'])) ? $dfd_ronneby['style_hover_read_more'] : 'chaffle'; ?>
										<a href="<?php echo the_permalink(); ?>" title="<?php the_title(); ?>" class="more-button <?php echo esc_attr($read_more_style); ?> left" data-lang="en"><?php _e('Continue', 'dfd'); ?></a>
										<div class="entry-meta right">
											<?php get_template_part('templates/entry-meta/mini', 'comments'); ?>
										</div>
									</div>
								</div>
                            </div>
                        </div>
			
                    </article>

                <?php endwhile; ?>

                <?php if ($wp_query->max_num_pages > 1) : ?>

                    <nav class="page-nav">

                        <?php echo dfd_kadabra_pagination(); ?>

                    </nav>

                <?php endif; ?>

                <?php wp_reset_postdata(); ?>

            </section>

            <?php get_template_part('templates/sidebar', 'right'); ?>

        </div>

</section>