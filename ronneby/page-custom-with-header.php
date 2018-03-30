<?php
/*
Template Name: For Page builder + Header
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<?php get_template_part('templates/header/top', 'page'); ?>

<section id="layout" class="no-title">


        <?php get_template_part('templates/content', 'page'); ?>


</section>
