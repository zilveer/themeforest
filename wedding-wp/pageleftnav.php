<?php

/*

Template Name: Left Navigation Page

*/
get_header();

GLOBAL $webnus_options;

$last_time = get_the_time(' F Y');
GLOBAL $webnus_options;

?>
<section id="headline">
    <div class="container">
      <h3><?php the_title(); ?></h3>
    </div>
  </section>
<section class="container" >
<!-- Start Page Content -->
<hr class="vertical-space">
<section class="col-md-8 col-md-offset-1 rgt-cntt" id="side-content">
<article>
<?php 
		  if( have_posts() ): while( have_posts() ): the_post();
			the_content(); 
		  endwhile;
		  endif;
?>
</article>
</section>
<section class="col-md-3" id="side-nav">
	<ul>
	<?php 
	if(has_nav_menu('leftnav-menu')){
			$menuParameters = array(
				'theme_location'=>'leftnav-menu',
				'container'       => false,
				'echo'            => false,
				'items_wrap'      => '%3$s',
				'after'      => '',
				'depth'           => 0,
			);

	echo wp_nav_menu( $menuParameters );
	}
	
	?>
	</ul>
</section>	
<hr class="vertical-space3">
</section><!-- container -->
<?php get_footer(); ?>