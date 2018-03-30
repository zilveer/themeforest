<?php

global $post_meta_data;

$show_similer = houzez_option( 'houzez_similer_properties' );
$similer_type = houzez_option( 'houzez_similer_properties_type' );
$similer_view = houzez_option( 'houzez_similer_properties_view' );
$similer_count = houzez_option( 'houzez_similer_properties_count' );
$terms = get_the_terms( get_the_ID() , $similer_type, 'string' );
$term_ids = wp_list_pluck( $terms,'term_id' );

if ( $show_similer ) : ?>
<div class="property-similer">
<div class="detail-title">
	<h2 class="title-left"><?php esc_html_e( 'Similer Properties', 'houzez' ); ?></h2>
</div>
<?php

	$second_query = array(
	  'post_type' => 'property',
	  'tax_query' => array(
		array(
			'taxonomy' => $similer_type,
			'field' => 'id',
			'terms' => $term_ids,
			'operator'=> 'IN' //Or 'AND' or 'NOT IN'
		 )),
	  'posts_per_page' => $similer_count,
	  'ignore_sticky_posts' => 1,
	  'orderby' => 'rand',
	  'post__not_in'=>array( get_the_ID() )
	);

	$wp_query = new WP_Query( $second_query );

	if ($wp_query->have_posts()) : ?>
		<div class="property-listing <?php echo esc_attr($similer_view); ?>">
			<div class="row">

				<?php
				while ($wp_query->have_posts()) : $wp_query->the_post();

					get_template_part('template-parts/property-for-listing');

				endwhile;
				?>

			</div>
		</div>
		<?php
	endif;
	wp_reset_query(); ?>
		<hr>
		</div>
<?php endif; ?>