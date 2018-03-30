<?php 
global $VAN;
get_header();
?>

<div id="container">
    <?php 
	  van_check_menu();
	  get_template_part('content','pages');
	  wp_reset_query();
	  get_template_part('content','contact');
	?> 
    
</div>
<?php get_footer();?>