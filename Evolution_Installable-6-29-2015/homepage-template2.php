<?php /* Template Name: Homepage (with Portfolio) */ ?>

<?php get_header(); 
$alc_options = get_option('alc_general_settings'); 
$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
?>
<?php get_template_part('portfolio-template-4columns'); ?>

<?php get_footer(); ?>