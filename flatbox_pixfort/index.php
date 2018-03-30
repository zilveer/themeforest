<?php get_header(); ?>

<?php
if (is_home()) :

// check if search page should be shown
if (strpos($_SERVER['REQUEST_URI'],'?s=') !== false) : ?>

</section>
	<div class="flat_pagetop">
		<section class="container">

		<div class="grid12 col">
			<h3><?php _e( 'Search throughout the website', 'flatbox' ); ?></h3>
			

		</div>

</section>
	</div>
		<section class="container">

		<div class="grid12 col">
			<p></p>
			<?php get_search_form(); ?>

		</div>


<?php
else :


	// general category, tag, date, author and search listing
	$title = __( 'Recent Posts', 'flatbox' );
	if (is_search()) $title = sprintf( __( 'Search results for &#8216;%s&#8217;', 'flatbox' ), esc_attr( get_search_query() ) );
	elseif( is_category() ) $title = sprintf( __( 'Archive for the &#8216;%s&#8217; Category', 'flatbox' ), single_cat_title( '', FALSE ) );
	elseif( is_tag() ) $title = sprintf( __( 'Posts tagged &#8216;%s&#8217;', 'flatbox' ), single_tag_title( '', FALSE ) );
	elseif( is_day() ) $title = sprintf( __( 'Archive for %s', 'flatbox' ), get_the_time('F jS, Y') );
	elseif( is_month() ) $title = sprintf( __( 'Archive for %s', 'flatbox' ), get_the_time('F, Y') );
	elseif( is_year() ) $title = sprintf( __( 'Archive for %s', 'flatbox' ), get_the_time('Y') );
	elseif( is_author() ) $title = __( 'Author Archive', 'flatbox' );
	elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) $title = __( 'Blog Archives', 'flatbox' );
	elseif ( has_post_format('image') ) $title = __( 'Images', 'flatbox' );
	elseif ( has_post_format('video') ) $title = __( 'Videos', 'flatbox' ); ?>

</section>
	<div class="flat_pagetop">
		<section class="container">

		<div class="grid12 col">
			<h1 class="page-title left"><?php echo $title; ?></h1>
			<div class="subtitle">
				<p class="small gray"><?php echo pagination_pages() ?></p>
			</div>
		</div>


</section>
	</div>
		<section class="container">

		<div class="sep  col"></div>
<?php
if (have_posts()) :
	while(have_posts()) :
		the_post();
		if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
			$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
			$thumb_image_url = aq_resize( $full_image_url, 480, 320, true );
		else :
			$thumb_image_url = get_template_directory_uri().'/img/480x320.gif';
		endif; ?>
		<div id="post-<?php the_ID(); ?>" class="grid2 col">
			<div class="thumb<?php echo $smof_data['css3_animation_class']; $allClasses = get_post_class(); foreach ($allClasses as $class) { echo " " . $class; } ?>">
				<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
				<div class="info pattern">
					<a href="<?php the_permalink(); ?>" class="button-link"></a>
				</div>
			</div>
		</div>
		<div class="grid10 col">
			<h5 class="half-bottom"><a  class="bold_title2" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			<div class="metablog">
					<p class="btitledate"><span class="firasdate"><span class="icon-date"></span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span></p>
				<?php if( function_exists('zilla_likes') ) {?>
				<span class="firasdate zlike">
					<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
				</span>
				<?php }?>

			</div>
			<div class="clearfix"></div>
			<div class="small_text"><?php the_excerpt(); ?></div>
		</div>
		<div class="sep sep-small col"></div>
<?php endwhile; ?>

		<?php pagination_links(); ?>
<?php
	else:
		get_template_part( 'noresult' );
	endif; 	endif; 

else: //is_home()

	// general category, tag, date, author and search listing
	$title = __( 'Results', 'flatbox' );
	if (is_search()) $title = sprintf( __( 'Search results for &#8216;%s&#8217;', 'flatbox' ), esc_attr( get_search_query() ) );
	elseif( is_category() ) $title = sprintf( __( 'Archive for the &#8216;%s&#8217; Category', 'flatbox' ), single_cat_title( '', FALSE ) );
	elseif( is_tag() ) $title = sprintf( __( 'Posts tagged &#8216;%s&#8217;', 'flatbox' ), single_tag_title( '', FALSE ) );
	elseif( is_day() ) $title = sprintf( __( 'Archive for %s', 'flatbox' ), get_the_time('F jS, Y') );
	elseif( is_month() ) $title = sprintf( __( 'Archive for %s', 'flatbox' ), get_the_time('F, Y') );
	elseif( is_year() ) $title = sprintf( __( 'Archive for %s', 'flatbox' ), get_the_time('Y') );
	elseif( is_author() ) $title = __( 'Author Archive', 'flatbox' );
	elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) $title = __( 'Blog Archives', 'flatbox' );
	elseif ( has_post_format('image') ) $title = __( 'Images', 'flatbox' );
	elseif ( has_post_format('video') ) $title = __( 'Videos', 'flatbox' ); ?>

</section>
	<div class="flat_pagetop">
		<section class="container">

		<div class="grid12 col">
			<h1 class="page-title left"><?php echo $title; ?></h1>
			<div class="subtitle">
				<p class="small gray"><?php echo pagination_pages() ?></p>
			</div>
		</div>


</section>
	</div>
		<section class="container">

		<div class="sep  col"></div>
<?php
if (have_posts()) :
	while(have_posts()) :
		the_post();
		if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
			$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
			$thumb_image_url = aq_resize( $full_image_url, 480, 320, true );
		else :
			$thumb_image_url = get_template_directory_uri().'/img/480x320.gif';
		endif; ?>
		<div id="post-<?php the_ID(); ?>" class="grid2 col">
			<div class="thumb<?php echo $smof_data['css3_animation_class']; $allClasses = get_post_class(); foreach ($allClasses as $class) { echo " " . $class; } ?>">
				<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
				<div class="info pattern">
					<a href="<?php the_permalink(); ?>" class="button-link"></a>
				</div>
			</div>
		</div>
		<div class="grid10 col">
			<h5 class="half-bottom"><a  class="bold_title2" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			<div class="metablog">
					<p class="btitledate"><span class="firasdate"><span class="icon-date"></span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span></p>
				<?php if( function_exists('zilla_likes') ) {?>
				<span class="firasdate zlike">
					<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
				</span>
				<?php }?>

			</div>
			<div class="clearfix"></div>
			<div class="small_text"><?php the_excerpt(); ?></div>
		</div>
		<div class="sep sep-small col"></div>
<?php endwhile; ?>

		<?php pagination_links(); ?>
<?php
	else:
		get_template_part( 'noresult' );
	endif; ?>
<?php endif; //is_home() ?>

<?php get_footer(); ?>