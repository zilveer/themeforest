
<?php
/*
Template Name: Page with both sidebars
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('templates/header/top','page'); ?>

<section id="layout">
    <div class="row">

        <div class="blog-section sidebar-both dfd-equal-height-children">
            <section id="main-content" role="main" class="six columns dfd-eq-height">

                <?php get_template_part('templates/content', 'page'); ?>

            </section>
            <?php get_template_part('templates/sidebar', 'left'); ?>
        </div>

        <?php  get_template_part('templates/sidebar', 'right'); ?>

    </div>
</section>