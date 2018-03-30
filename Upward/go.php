<?php

/*

	Template Name: Redirect

*/

	if ( $_SERVER['QUERY_STRING'] ) :
	
		header( 'Location:' . $_SERVER['QUERY_STRING'] );

	else :

		header( 'Location:' . '../../../' );

	endif;

?>