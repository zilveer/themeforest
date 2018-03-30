
<?php
/*
Template Name: Page with right sidebar
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('templates/header/top','page'); ?>

<section id="layout">
    <div class="row">

        <div class="blog-section sidebar-right dfd-equal-height-children">
            <section id="main-content" role="main" class="nine columns dfd-eq-height">

                <?php get_template_part('templates/content', 'page'); ?>

            </section>
            <?php get_template_part('templates/sidebar', 'right'); ?>
        </div>

    </div>
</section>