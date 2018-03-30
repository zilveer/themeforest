<?php
/*
    Template Name: Blog: Chequered
*/
?>
<?php get_header(); ?>
<?php suprema_qodef_get_title(); ?>
<?php get_template_part('slider'); ?>
    <div class="qodef-full-width">
        <div class="qodef-full-width-inner clearfix">
            <?php suprema_qodef_get_blog('chequered'); ?>
        </div>
    </div>
<?php get_footer(); ?>