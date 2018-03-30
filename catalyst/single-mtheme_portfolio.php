<?php
/*
Catalyst Single Portfolio Page
*/
?>
 
<?php get_header(); ?>

<div class="page-contents-wrap float-left two-column">
<?php
get_template_part( 'loop', 'portfolio' );
?>
</div>
<?php get_template_part( 'sidebar', 'portfolio' ); ?>

<?php get_footer(); ?>