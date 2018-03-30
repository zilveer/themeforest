<?php
/*
Template Name: Testimonials Page
 */
get_header(); ?>

    <!--Main begin-->
<div id="main" class="round_8 clearfix row">
    <!--Breadcrumbs begin-->
    <div class="pad-left-10">
        <?php if (function_exists('pkb_breadcrumbs')) pkb_breadcrumbs(); ?>
    </div>
    <!--Breadcrumbs end-->

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <!--Page title begin-->
        <div class="large-12 columns">
            <div class="page_title round_6">
                <h1 class="replace"><?php the_title(); ?></h1>
            </div>
        </div>
        <!--Page title end-->

    <?php endwhile; endif; ?>
    <!-- Content begin-->
    <div id="content" class="large-8 columns">

        <div class="testimonial-container">
            <?php  $wp_query = new WP_Query(array('post_type' => 'testimonial', 'paged' => $paged));    ?>
            <?php /*?><?php custom_query_posts(); ?><?php */?>
            <?php if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                <div class="quote-post">
                    <a class="" href="<?php the_permalink() ?>">
                        <blockquote>
                            <?php the_content(); ?>
                        </blockquote>
                        <?php if (get_post_meta(get_the_ID(), 'pkb_author_name', true) || get_post_meta(get_the_ID(), 'pkb_author_title', true)): ?>
                            <p class="quote-author">
                                <?php if (get_post_meta(get_the_ID(), 'pkb_author_name', true)): ?>
                                    <?php echo get_post_meta(get_the_ID(), 'pkb_author_name', true); ?>
                                <?php endif; ?>
                                <?php if (get_post_meta(get_the_ID(), 'pkb_author_title', true)): ?>
                                    <span
                                        class="costumer-title"> - <?php echo get_post_meta(get_the_ID(), 'pkb_author_title', true); ?></span>
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endwhile; endif;?>
        </div>


        <!-- Pagination -->
        <?php if (function_exists("pkb_pagination")) { /* Display navigation to next/previous pages when applicable */
            pkb_pagination();
        } ?>

        <?php wp_reset_query(); ?>
    </div>
    <!-- Content end-->

    <!-- Sidebar begin-->
    <div id="sidebar" class="large-4 columns">
        <?php get_sidebar(); ?>
    </div>
    <!-- Sidebar end-->

<?php get_footer(); ?>