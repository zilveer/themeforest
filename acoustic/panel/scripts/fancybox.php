<?php
//
// Code for fancybox.
// All the theme needs to do is call add_fancybox_support() after the bootstrap.
//
if ( !function_exists( 'add_fancybox_support' ) ):
function add_fancybox_support() {
	if ( is_admin() ) {
		return;
	}

	add_action( 'init', 'ci_enqueue_fancybox' );
	add_action( 'wp_footer', 'ci_print_fancybox_selectors', 20 );

	add_filter( 'the_content', 'ci_fancyboxrel', 12 );
	add_filter( 'get_comment_text', 'ci_fancyboxrel' );
	add_filter( 'wp_get_attachment_link', 'ci_fancyboxrel' );
}
endif;

if ( !function_exists( 'remove_fancybox_support' ) ):
function remove_fancybox_support() {
	remove_action( 'init', 'ci_enqueue_fancybox' );
	remove_action( 'wp_footer', 'ci_print_fancybox_selectors', 20 );

	remove_filter( 'the_content', 'ci_fancyboxrel', 12 );
	remove_filter( 'get_comment_text', 'ci_fancyboxrel' );
	remove_filter( 'wp_get_attachment_link', 'ci_fancyboxrel' );
}
endif;

if ( !function_exists( 'ci_fancyboxrel' ) ):
function ci_fancyboxrel( $content ) {
	$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";

	$replacement = '<a$1href=$2$3.$4$5 rel="fancybox[' . get_the_ID() . ']"$6>$7</a>';

	$content = preg_replace( $pattern, $replacement, $content );

	return $content;
}
endif;

if ( !function_exists( 'ci_enqueue_fancybox' ) ):
function ci_enqueue_fancybox() {
	wp_enqueue_script( 'fancybox', get_child_or_parent_file_uri( '/panel/scripts/fancybox-2.1.5/jquery.fancybox.pack.js' ), array( 'jquery' ), '2.1.5', true );
	wp_enqueue_style( 'fancybox', get_child_or_parent_file_uri( '/panel/scripts/fancybox-2.1.5/jquery.fancybox.css' ), array(), '2.1.5' );
}
endif;

if ( !function_exists( 'ci_print_fancybox_selectors' ) ):
function ci_print_fancybox_selectors() {
	?>
	<script type='text/javascript'>
		jQuery( document ).ready( function( $ ) {
			$( ".fancybox, a[rel^='fancybox[']" ).fancybox( {
				fitToView : true,
				padding   : 0,
				nextEffect: 'fade',
				prevEffect: 'fade'
			} );
		} );
	</script>
	<?php
}
endif;