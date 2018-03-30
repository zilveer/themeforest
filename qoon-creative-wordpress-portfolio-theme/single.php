<?php get_header();
$oi_qoon_options = get_option('oi_qoon_options');?>
<?php get_template_part( 'framework/blog-layout/single', $oi_qoon_options['site-layout'] );?>
<?php get_footer(); ?>