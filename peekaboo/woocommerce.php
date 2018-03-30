<?php
/*
Template Name: Woocommerce
*/

get_header(); ?>

    <!--Main begin-->
<div id="main" class="round_8 clearfix row" role="main">


    <!-- Breadcrumb begin -->
    <div class="pad-left-10">
        <?php if (function_exists('pkb_breadcrumbs')) pkb_breadcrumbs(); ?>
    </div>
    <!-- Breadcrumb end -->

    <!-- Content begin -->
    <div class="full">
   <?php woocommerce_content(); ?>
    </div>
    <!-- Content end -->
   


<?php get_footer(); ?>

