<?php

get_header();

GLOBAL $webnus_options;
?>
<section id="headline">
<div class="container">
  <h3><?php $terms = get_the_terms(get_the_id(), 'filter' );
	//var_dump($terms);
	if ($terms && ! is_wp_error($terms)) :
		$term_slugs_arr = array();
		foreach ($terms as $term) {
			$term_slugs_arr[] = $term->name;
		}
		$terms_slug_str = join( ", ", $term_slugs_arr);
	endif;
	echo $terms_slug_str; 
	
	
	?></h3>
</div>
</section>
<section class="container portfolio-archive-w" >
<hr class="vertical-space1">

<div class="portfolio">
<?php

if (have_posts()) : while (have_posts()) : the_post();

?>
  <figure class="portfolio-item">
	<div class="img-item"> <a href="<?php $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
					$large_image = $large_image[0]; echo $large_image; ?>" class="prettyPhoto" > <?php get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'portfolio_full' ) ); ?><span class="zoomex">&nbsp;</span></a> </div>
	<figcaption><h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h4>
	<p><?php echo get_the_date('d M Y');?> - <?php $terms = get_the_terms(get_the_id(), 'filter' );
	//var_dump($terms);
	if ($terms && ! is_wp_error($terms)) :
		$term_slugs_arr = array();
		foreach ($terms as $term) {
			$term_slugs_arr[] = '<a href="'. get_term_link($term, 'filter') .'">' . $term->name . '</a>';
		}
		$terms_slug_str = join( ", ", $term_slugs_arr);
	endif;
	echo $terms_slug_str; 
	
	
	?></p></figcaption>
  </figure>
  <!-- end-portfolio-item-->
<?php
			endwhile;
			endif;
		
?>
</div>
<!-- end-portfolio -->

<hr class="vertical-space2">

</section>
  <!-- container -->

 <?php 
get_footer();
?>