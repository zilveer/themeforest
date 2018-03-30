<?php

/*
 *  Template Name: 4 Columns Services Template
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

        <div class="row ">
            <?php
            global $paged, $theme_options;
            //echo 'service pagination = ' . $theme_options['display_services_pagination'];
            if( $theme_options['display_services_pagination'] ){
                if (is_front_page()) {
                    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                }

                $services_args = array(
                    'post_type' => 'service',
                    'posts_per_page' => 8,
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
                $loop_counter = 0;
                while ($services_query->have_posts()) {
                    $services_query->the_post();
                    ?>
                    <div class="<?php bc('3','4','6',''); ?>">
                        <article <?php post_class('four-col-service') ?>>
                            <?php inspiry_standard_thumbnail('service-gallery-thumb') ?>
                            <div class="contents clearfix">
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            </div>
                        </article>
                    </div>
                    <?php
                    $loop_counter++;
                    if( ($loop_counter % 4) == 0 ){
                        ?>
                        <div class="visible-lg clearfix"></div>
                        <?php
                    } else if( ($loop_counter % 3) == 0 ){
                        ?>
                        <div class="visible-md clearfix"></div>
                        <?php
                    } else if( ($loop_counter % 2) == 0 ){
                        ?>
                        <div class="visible-sm clearfix"></div>
                        <?php
                    }
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
</div>
<?php get_footer(); ?>
