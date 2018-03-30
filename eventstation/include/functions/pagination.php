<?php
/*------------- PAGINATION START -------------*/
function eventstation_pagination() {
	if( is_singular() )
		return;

	global $wp_query;

	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	if( $paged >= 1 )
		$links[] = $paged;

	if( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<ul class="eventstation-pagination">' . "\n";

	echo '<li class="eventstation-pagination-nav"><ul>';
		if( get_previous_posts_link() )
			printf( '<li class="left">' . get_previous_posts_link( '<span aria-hidden="true">&lt;</span>' ) . '</li>' );
		
		if( get_previous_posts_link() and get_next_posts_link() )
			echo '<li class="center"></li>';

		if( get_next_posts_link() )
			printf( '<li class="right">' . get_next_posts_link( '<span aria-hidden="true">&gt;</span>' ) . '</li>' );
	echo '</ul></li>';

	if( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if( ! in_array( 2, $links ) )
			echo '<li><a href="">&middot;&middot;&middot;</a></li>';
	}

	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	if( ! in_array( $max, $links ) ) {
		if( ! in_array( $max - 1, $links ) )
			echo '<li><a href="">&middot;&middot;&middot;</a></li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}
	
	echo '</ul>' . "\n";
}

add_filter('redirect_canonical','eventstation_disable_redirect_canonical');
function eventstation_disable_redirect_canonical($redirect_url) {if (is_paged() && is_singular()) $redirect_url = false; return $redirect_url; }
/*------------- PAGINATION END -------------*/

/*------------- SINGLE NAVIGATION START -------------*/
function eventstation_single_nav() {
	$eventstation_single_nav_prev = esc_html__( 'Previous Post', 'eventstation' );
	$eventstation_single_nav_next = esc_html__( 'Next Post', 'eventstation' );
	$prevPost = get_previous_post( false );
	$nextPost = get_next_post( false );
?>
	<div class="post-navigation">
		<nav>
			<ul>
				<?php if( !empty( $prevPost ) ) { ?>
					<li class="previous">
						<a href="<?php echo get_permalink( $prevPost->ID ); ?>" title="<?php the_title_attribute( array( 'post' => $prevPost->ID ) ); ?>"><span>&lt;</span> <?php echo esc_attr( $eventstation_single_nav_prev ); ?></a>
					</li>
				<?php } ?>
				<?php if( !empty( $nextPost ) ) { ?>
					<li class="next">
						<a href="<?php echo get_permalink( $nextPost->ID ); ?>" title="<?php the_title_attribute( array( 'post' => $nextPost->ID ) ); ?>"><?php echo esc_attr( $eventstation_single_nav_next ); ?> <span>&gt;</span></a>
					</li>
				<?php } ?>
			</ul>
		</nav>
	</div>
<?php
}
/*------------- SINGLE NAVIGATION END -------------*/