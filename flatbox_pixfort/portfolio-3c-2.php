<?php
/**
 *	Template Name: Portfolio Page 3c2
 *
 *	The template for displaying potfolio items
 */

get_header();
the_post();
$portfolio_grid_no = 4;
$show_details_outside = 1;
$enable_infinitescroll = $smof_data['portfolio_infinitescroll'];
$subtitle = rwmb_meta("subtitle");
$folio_category = rwmb_meta("project-category"); ?>


</section>
	<div class="flat_pagetop">
		<section id="content" class="container">


		<div class="grid12 col">
<?php 
	if (!empty($folio_category) && $folio_category != 0 ) {
		$categories = get_categories(array(
			'child_of' => 'project-category',
			'hide_empty' => 1
		));
	} else {
//		$categories = get_categories();
		$categories = get_terms("project-category");
	}
	$count = count($categories); ?>
			<h1 class="page-title<?php if ( $count>1 ) echo " left"; ?>"><?php the_title(); ?></h1>

<?php 	if ( $count>1 ) : ?>
			<div class="subtitle">
				<p class="filter isotope-filter">
					<a href="#" data-value="all" class="active"><?php _e( 'All', 'flatbox' ); ?></a>
<?php foreach ($categories as $key => $value) : ?>
					<a href="#" data-value="category-<?php echo $value->slug; ?>"><?php echo $value->name; ?></a>
<?php endforeach; ?>
				</p>
			</div>
			<div class="clear"></div>
<?php 	endif; ?>

		</div>


</section>
	</div>
		<section id="content" class="container">


		<div class="grid12 col">
			<?php echo do_shortcode( get_the_content() ); ?>

		</div>
<?php
$page_no = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
	'post_type' => array('portfolio','portfolio-items'),
	'post_status' => 'publish',
	'orderby' => 'menu_order date',
	'paged' => $page_no
);
if (!empty($folio_category) && $folio_category != 0 ) {
	$args['cat'] = $folio_category;
}
query_posts($args);
if (have_posts()) : ?>
		<div class="clear"></div>

	
		<div class="isotope <?php if ($enable_infinitescroll) echo 'infinitescroll '; ?>clearfix">

	
<?php while(have_posts()) :
		the_post();
		$categories = get_the_terms ($post->id, 'project-category');
		$filter = '';
		
		if (is_array($categories)){
		foreach ($categories as $category_value) {
			$filter .= 'category-' . $category_value->slug . ' ';
		}}
		$filter = trim($filter);
		if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
			$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
			// $thumb_image_url = aq_resize( $full_image_url, 480, 320, true );
		$thumb_image_url = aq_resize( $full_image_url, 960, 500, true );
		else :
			$full_image_url = get_template_directory_uri().'/img/940x480.gif';
			$thumb_image_url = get_template_directory_uri().'/img/480x250.gif';
		endif; ?>




<?php if ($show_details_outside) : ?>

			<div class="grid<?php echo $portfolio_grid_no; ?> col isotope-item" data-id="item<?php the_id(); ?>" data-type="<?php echo $filter; ?>">
				<div class="thumb blog_item">
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
					<div class="info pattern">
						<a href="<?php the_permalink(); ?>" class="button-link"></a>
					</div>
				</div>
				<div class="blog_post blog_item">				
					<h5 class="normal_title normal_title_inside"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<div class="metablog">
					<p class="btitledate"><span class="firasdate"><span class="icon-date"></span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span></p>
				<?php if( function_exists('zilla_likes') ) {?>
				<span class="firasdate zlike">
					<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
				</span>
				<?php }?>

				</div>
				<div class="clearfix"></div>
				<div class="btitletext small_text3 small_text3_inside"><?php the_excerpt(); ?></div>
			</div>
			</div>

<?php else: ?>

				<!-- 	<p><?php echo $portfolio_grid_no; ?></p> -->
				
					<div class="grid<?php echo $portfolio_grid_no; ?> col isotope-item" data-id="item<?php the_id(); ?>" data-type="<?php echo $filter; ?>">
	            	<ul class="grid ngrid<?php echo $portfolio_grid_no; ?> cs-style-3" id="firas" >
					<li>
						<figure>
							<img src="<?php echo $thumb_image_url; ?>" href="<?php echo $full_image_url; ?>" alt="img04">
							<figcaption>
								<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
								<span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span>
								<!-- <a href="<?php the_permalink(); ?>" class="car_more">More</a> -->
								<a href="<?php echo $full_image_url; ?>" class="fullsize car_fullport"></a>
								<?php if( function_exists('zilla_likes') ) {?>
							<div href="<?php the_permalink(); ?>" class="car_like2"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></div>				
								<?php }?>

							</figcaption>
						</figure>
					</li>
					</ul>
					</div>
				


<?php endif; ?>



<?php endwhile; ?>




		</div>
		<div class="clear"></div>










		<?php pagination_links(); ?>
<?php
	else:
		get_template_part( 'noresult' );
	endif; ?>

<?php get_footer(); ?>