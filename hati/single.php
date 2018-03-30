<?php get_header(); if (have_posts()) the_post(); ?>
  
<?php get_template_part( 'tile', 'entry' ) ?>

<?php get_footer() ?>