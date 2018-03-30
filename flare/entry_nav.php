<?php
	$post_type = get_post_type();
		
	$href = '';
	$text = '';
	if ( 'post' === $post_type ) {			
		$index_page = intval( btp_theme_get_option_value( 'post_index_page' ) );
		/* WPML fallback */
	 	if ( function_exists( 'icl_object_id' ) ) {
    		$index = icl_object_id( $index, 'page', true );
  	 	}
		
		
		$home_page = intval( btp_theme_get_option_value( 'page_home_page' ) );
		if ( $index_page && $index_page !== $home_page ) {
			$href = get_permalink( $index_page );	
		} else {
			$href = home_url();
		}	
	} else {
		$href = get_post_type_archive_link( $post_type );
	}
	
	$post_type_obj = get_post_type_object( $post_type );
	$text = $post_type_obj->labels->all_items;
?>
<nav class="entry-nav">
	<ul>
		<li class="prev"><?php previous_post_link( '%link', '<span>%title</span>' ); ?></li>
		<li class="back">
			<a href="<?php echo esc_url( $href ); ?>">
				<span><?php echo esc_html( $text ); ?></span>
				<span class="helper-1"></span>
				<span class="helper-2"></span>
			</a>
		</li>
		<li class="next"><?php next_post_link( '%link', '<span>%title</span>' ); ?></li>
	</ul>
</nav>