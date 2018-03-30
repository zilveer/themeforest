<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php get_template_part('templates/header/top','forum'); ?>

<section id="layout" class="blog-page dfd-equal-height-children">
    <div class="row">

        <?php
        set_layout('pages');

        get_template_part('templates/content', 'page');

        set_layout('pages', false);

        ?>

    </div>
</section>