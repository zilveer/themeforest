
<?php
/*
Template Name: Page with left sidebar
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('templates/header/top','page'); ?>

<section id="layout">
    <div class="row">

        <div class="blog-section sidebar-left dfd-equal-height-children">
            <section id="main-content" role="main" class="nine columns dfd-eq-height">

                <?php get_template_part('templates/content', 'page'); ?>

            </section>
            <?php get_template_part('templates/sidebar', 'left'); ?>
        </div>

    </div>
</section>