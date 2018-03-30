<?php get_header(); ?>
<?php
$portfolio_style= get_post_meta($post->ID, MTHEME . '_portfolio_style', true);
$portfolio_category= get_post_meta($post->ID, MTHEME . '_portfolio_category', true);
$portfolio_link= get_post_meta($post->ID, MTHEME . '_portfolio_link', true);

$portfolio_perpage="6";
$count=0;
$columns=4;

$portfolio_cat= get_term_by ( 'name', $portfolio_category,'types' );
$portfolio_cat_slug=$portfolio_cat -> slug;
$portfolio_cat_ID=$portfolio_cat -> term_id;

$portfolio_category=$portfolio_cat_slug;

require ( MTHEME_INCLUDES . 'portfolio/portfolio-common-types.php' );
?>
<?php get_footer(); ?>