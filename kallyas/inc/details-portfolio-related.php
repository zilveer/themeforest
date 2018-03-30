<?php if(! defined('ABSPATH')){ return; }

$show_related = zget_option('ports_show_related', 'portfolio_options', false, 'no') == 'yes';
if( $show_related ){

	// By default 3 items
	$items_per_page = apply_filters('zn_portfolio_related_items', 3);

	$tag_ids = wp_get_post_terms( zn_get_the_id(), 'portfolio_tags', array( 'fields' => 'ids' ) );

	if ( $tag_ids ) {
		$args = array(
			'post_type' => 'portfolio',
			'posts_per_page' =>  $items_per_page,
			'post__not_in'   => array( zn_get_the_id() ),
			'tax_query' => array (
				array(
					'taxonomy' => 'portfolio_tags',
					'field' => 'id',
					'terms' =>  $tag_ids,
					'operator' => 'IN'
				)
			)
		);

		$portfolio_items = get_posts( $args );
	}

	if (!empty($portfolio_items)) {
	global $colWidth,$zn_link_portfolio,$ports_num_columns,$extra_content;
	//Items per page
	$ports_num_columns = $items_per_page;
	$extra_content = ! empty( $zn_config['ports_extra_content'] ) ? $zn_config['ports_extra_content'] : zget_option( 'ports_extra_content', 'portfolio_options', false, 'no' );
	$colWidth = str_replace('.', '', 12 / intval($ports_num_columns));

	?>
	<!-- RELATED PROJECT -->
	<div class="row zn_portfolio_related">
		<div class="col-sm-12">
			<h2 class="zn_portfolio_related_title" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>><?php _e( 'Related Projects', 'zn_framework' ); ?></h2>
		</div>
		<div class="zn_portfolio_related_items_container">
			<?php
				foreach ( $portfolio_items as $post ) {
					setup_postdata($post);

					// Load the portfolio archive template
					get_template_part( 'inc/loop', 'portfolio_category_item' );

				}
			?>
		</div>
	</div>

	<?php }
}