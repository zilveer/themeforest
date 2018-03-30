<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>
<!-- - - - - - - - - - - - Entry - - - - - - - - - - - - - - -->

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php
        the_content();        
        tmm_link_pages();
        ?>

		<div class="clear"></div>

		<?php      
		
		tmm_layout_content(get_the_ID(), 'default');

    endwhile;

endif;
?>
<!-- - - - - - - - - - - - end Entry - - - - - - - - - - - - - - -->

<?php get_footer(); ?>

