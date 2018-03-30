<div id="mobile-bar">
	<a class="menu-trigger" href="#"></a>
	<h1 class="mob-title">
		<?php
			if ( is_home() or is_front_page() ) :
				$title       = get_bloginfo( 'name', 'display' );
				$description = get_bloginfo( 'description', 'display' );
				if ( ! empty( $description ) ) {
					$title .= ' | ' . $description;
				}
				echo $title;
			elseif ( is_page() ) :
				single_post_title();
			elseif ( is_category()):
				single_term_title();
			elseif ( is_month()):
				single_month_title();
			elseif ( is_search() ):
				_e('Search Results', 'ci_theme');
			elseif ( is_404() ):
				_e('Oops! 404', 'ci_theme');
			elseif ( is_single() ) :
				single_post_title();
			endif;
		?>
	</h1>
</div>