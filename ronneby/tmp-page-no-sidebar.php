
<?php
/*
Template Name: Page without sidebars
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('templates/header/top','page'); ?>

<section id="layout">
    <div class="row">

            <section id="main-content" role="main" class="twelve columns">

                <?php get_template_part('templates/content', 'page'); ?>

            </section>

    </div>
</section>