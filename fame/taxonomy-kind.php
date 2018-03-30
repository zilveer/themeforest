<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

//Here we inform template that we want to print out genre
define('A13_GENRE_TEMPLATE', true);
get_template_part( 'galleries-list' );