<?php

get_header();
the_post();
$return_page = (isset($smof_data['journal_page'])) ? $smof_data['journal_page'] : '';
if (!empty($return_page)) {
	$return_page = get_permalink( get_page_by_path($return_page) );
}
?>

	<section id="main">
		<div class="wrapper">
			<div class="<?php $allClasses = get_post_class(); if ( ! in_array('post',$allClasses)) echo 'post'; if ( ! in_array('sticky', $allClasses) && is_sticky()) echo ' sticky'; foreach ($allClasses as $class) { echo " " . $class; } ?>">
				<h3><?php the_title(); ?></h3>
<?php if (!empty($return_page)) : ?>
				<a href="<?php echo $return_page; ?>" class="all tooltip" title="<?php _e( 'View All Items', 'royalgold' ); ?>"></a>
<?php endif; ?>

				<div class="date"><?php echo the_time(get_option('date_format')); _e( ' at ', 'royalgold' ); echo the_time(get_option('time_format')); ?></div>
<?php if(!empty($smof_data['single_post_meta'])) : ?>
				<div class="meta clearfix">
					<p><span class="permalink"><?php _e( 'Posted', 'royalgold' ) ?></span> <?php _e( ' by ', 'royalgold' );
						the_author_posts_link();
						$categories = get_the_category();
						$separator = ', ';
						$output = '';
						if ($categories) {
							_e( ' in ', 'royalgold' );
							foreach($categories as $category) {
								$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" , 'royalgold' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
							}
							echo trim($output, $separator);
						}
					?></p>
<?php if ( comments_open() ) : ?>
					<p><span class="comments"><?php _e( 'Discussion ', 'royalgold' ) ?></span> <a href="<?php the_permalink() ?>#comment"><?php comments_number() ?></a></p>
<?php endif; ?>
<?php if (get_the_tags()) : ?>
					<p><?php the_tags('<span class="tags">' . __( 'Tags:', 'royalgold' ) . '</span> ') ?></p>
<?php endif; ?>
				</div>
<?php endif; // show meta data information ?>
				<div class="small">
					<?php
						the_content();
						wp_link_pages();
						if ( ! empty($smof_data['single_post_extra'])) {
							echo do_shortcode($smof_data['single_post_extra']);
						}
					?>
<?php if ( comments_open() ) : ?>
					<div class="sep"><span></span></div>
					<?php comments_template( '', true ); ?>
<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>