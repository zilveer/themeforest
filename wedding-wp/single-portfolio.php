<?php
get_header();
?>
<section class="works-item-dets-wrap">
<div class="container">

<div class="col-wks-1">
<?php if($webnus_options->webnus_portfolio_likebox_enable() == 1 ) { ?>
<div class="works-item-date-box">
 <?php the_time('d M Y'); ?>
</div>
<?php } ?>
</div>

<div class="col-wks-2 aligncenter"><h1 class="portfolio-item-title"><?php the_title(); ?></h1></div>

<div class="col-wks-3">
<?php if($webnus_options->webnus_portfolio_likebox_enable() == 1 ) { ?>
<div class="works-item-cat-box">
<span class="wrks-itm-cat"> <?php $terms = get_the_terms(get_the_id(), 'filter' );
	$terms_slug_str = '';
	
	if ($terms && ! is_wp_error($terms)) :
		$term_slugs_arr = array();
		foreach ($terms as $term) {
			$term_slugs_arr[] = '<a href="'. get_term_link($term, 'filter') .'">' . $term->name . '</a>';
		}
		$terms_slug_str = join( ", ", $term_slugs_arr);
	endif;
	echo $terms_slug_str; ?>
	</span>
	</div>
	<?php } ?>
</div>

</div>
</section>


<section id="main-content" class="container">
<!-- Start | Page Content -->

<?php 
echo '<div class="row-wrapper-x">';
		  if( have_posts() ): while( have_posts() ): the_post();
			the_content();
		  endwhile;
		  endif;
	echo '</div>';
if( '1' == $webnus_options->webnus_portfolio_recentworks_enable() )
	echo do_shortcode('[related_works count=7]');
?>

</section>
  <?php get_footer(); ?>