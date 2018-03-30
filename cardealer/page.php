<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>

<!-- - - - - - - - - - - - Entry - - - - - - - - - - - - - - -->

<?php
if (have_posts()) : while (have_posts()) : the_post();

		get_template_part('content', 'header');
        the_content();
		tmm_link_pages();
		tmm_layout_content(get_the_ID());

    endwhile;
endif;
?>

<!-- - - - - - - - - - - - end Entry - - - - - - - - - - - - - - -->

<?php get_footer(); ?>

