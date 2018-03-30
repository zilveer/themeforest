<?php if (!defined('ABSPATH')) exit(); ?>
<?php get_header(); ?>
<?php $GLOBALS['tmm_car_listing_layout_switcher'] = 1; ?>
<?php get_template_part('content', 'header'); ?>
<?php get_template_part('content', 'car'); ?>
<?php get_template_part('content', 'pagenavi'); ?>
<?php get_footer(); ?>