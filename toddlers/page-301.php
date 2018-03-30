<?php
/*
	Template Name: 301 Page Redirect
	File Name: page-redirect-301.php

	Redirect a page using wp_redirect
	the status is 301, moved permanently

	Usage:
	Recreate a page at the old URL and
	write in the content of the page the URL
	of the new resource.

	Outcome:
	The resource will be permanently moved
	at the new URL, saving the SEO value.
*/
global $unf_options;
if ( have_posts() ) : while ( have_posts() ) : the_post();
	$redirect_301 = get_the_excerpt();
	if ( !$redirect_301 ) {
		print 'Please, provide the new URL of the resource, writing it into the <i>content</i> or <i>excerpt</i> field.';
	} else {
	if ( !preg_match( '/^http:\/\//', $redirect_301 ) ) $redirect_301 = 'http://' . $redirect_301;
		wp_redirect( $redirect_301, 301 ); exit;
	}
endwhile; endif;
?>