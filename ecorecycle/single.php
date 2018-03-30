<?php get_header(); ?>
<?php		

  if (get_post_type( get_the_id()) != $pmc_data['port_slug']) {
      get_template_part('single_default');
	} else {
      get_template_part('single_portfolio');
	}
?>
<?php get_footer(); ?>