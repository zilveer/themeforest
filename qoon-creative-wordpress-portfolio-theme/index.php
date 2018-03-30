<?php get_header();
$oi_qoon_options = get_option('oi_qoon_options');
$pp = get_option('posts_per_page') ?>
<?php get_template_part( 'framework/blog-layout/blog', $oi_qoon_options['site-layout'] );?>
<?php get_footer(); ?>