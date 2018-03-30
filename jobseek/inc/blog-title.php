<?php if ( is_singular('job_listing') ) { ?>

	<section id="title"> 
		<div class="container">
			
			<?php $terms = get_the_terms( $post->ID, 'job_listing_category' );
									
			if ( $terms && ! is_wp_error( $terms ) ) {

				$jobcats = array();
			 	
				foreach ( $terms as $term ) {
					$term_link = get_term_link( $term );
					$jobcats[] = '<a href="' . $term_link . '">' . $term->name . '</a>';
				}
									
				$print_cats = join( " / ", $jobcats );

			 	echo $print_cats;

			} ?>

			<h1><?php the_title(); ?></h1>
			<span class="job-type <?php echo get_the_job_type() ? sanitize_title( get_the_job_type()->slug ) : ''; ?>"><?php the_job_type(); ?></span>

			<?php do_action('after_single_job_title'); ?>

		</div>
	</section><?php

} else if ( is_singular('resume') ) { ?>

	<section id="title">
		<div class="container">
			<?php the_title(); ?>
			<h1><?php the_candidate_title(); ?></h1>
			<?php the_candidate_location(); ?>
			<?php do_action('after_single_resume_title'); ?>
		</div>
	</section>


<?php } else if ( is_home() || is_single() ) {

	$blog_title_text = get_the_title( get_option('page_for_posts', true) );

	if( empty($blog_title_text) ) $blog_title = __('Blog', 'jobseek'); ?>

	<section id="title"><h1><?php echo esc_html($blog_title_text); ?></h1></section><?php

} else if ( is_search() ) { ?>

	<section id="title">
		<h1><?php _e('Search Results', 'jobseek'); ?> <?php printf( __( 'For: "%s"', 'jobseek' ), get_search_query() ); ?></h1>
	</section><?php

} else if ( is_tax('job_listing_category') || is_tax('job_listing_type') || is_tax('job_listing_tag') || is_tax('resume_category') || is_tax('resume_skill') ) {

	$taxonomy = get_taxonomy( get_queried_object()->taxonomy ); ?>

	<section id="title">
		<h1><?php single_term_title(); ?></h1>
	</section>
	
<?php } ?>