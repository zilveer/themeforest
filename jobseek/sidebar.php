<?php if( is_page() ) {

	if ( is_active_sidebar( 'page' ) ) {
		dynamic_sidebar( 'page' );
	}

} else {

	if ( is_active_sidebar( 'blog' ) ) {
		dynamic_sidebar( 'blog' );
	}

} ?>