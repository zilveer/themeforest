<?php

/*
 *  Template Name: 1 Column Services Template
 */

get_header();
get_template_part('template-parts/banner');
?>
<div class=" page-top clearfix">
    <div class="container">
        <div class="row">
            <div class="<?php bc_all('12'); ?>">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <nav class="bread-crumb">
                    <?php theme_breadcrumb(); ?>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="services-page clearfix">
    <div class="container">

        <div class="row">
            <div class="<?php bc_all('12'); ?>">
                <?php
                if (have_posts()):
                    while (have_posts()):
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(' clearfix'); ?>>
                            <div class="entry-content">
                                <?php
                                /* output page contents */
                                the_content();
                                ?>
                            </div>
                        </article>
                    <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>

        <?php
        global $paged, $theme_options;

        if( $theme_options['display_services_pagination'] ) {
            if (is_front_page()) {
                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            }

            $services_args = array(
                'post_type' => 'service',
                'posts_per_page' => 4,
                'paged' => $paged
            );
        } else {
            $services_args = array(
                'post_type' => 'service',
                'posts_per_page' => -1
            );
        }

        // The Query
        $services_query = new WP_Query($services_args);

        // The Loop
        if ($services_query->have_posts()) {
            while ($services_query->have_posts()) {
                $services_query->the_post();
                ?>
                <article <?php post_class('row one-col-service'); ?>>
                    <div class="<?php bc('6','7','12',''); ?>">
                        <?php inspiry_standard_thumbnail('services-one-col-thumb') ?>
                    </div>
                    <div class="<?php bc('6','5','12',''); ?>">
                        <div class="service-contents">
                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="entry-content">
                                <p><?php inspiry_excerpt(35); ?></p>
                            </div>
                            <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'framework'); ?></a>
                        </div>
                    </div>
                </article>
            <?php
            }
        } else {
            nothing_found(__('No Service found !', 'framework'));
        }

        if( $theme_options['display_services_pagination'] ) {
            inspiry_pagination($services_query);
        }

        /* Restore original Post Data */
        wp_reset_query();
        ?>
    </div>
</div>

<?php get_footer(); ?>
