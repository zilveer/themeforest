<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_template_part('templates/header/top', 'page'); ?>

<section id="layout" class="blog-page dfd-equal-height-children">
    <div class="row">

        <?php
        set_layout('pages');

        get_template_part('templates/content', 'page');

        set_layout('pages', false);

        ?>
    </div>
</section>