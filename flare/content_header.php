<?php
/**
 * The Template Part for displaying the header of the Content Theme Area.
 *
 * @package BTP_Flare_Theme
 */
?>
<?php
global $post;
$title = '';
$subtitle = '';
$elems = btp_elements_get();

if ( is_home() ) {	
	$id = btp_theme_get_option_value( 'post_index_page' );
	/* WPML fallback */
	if ( function_exists( 'icl_object_id' ) ) {
    	$id = icl_object_id( $id, 'page', true );
  	}
	
	$title = $elems[ 'title' ] ? get_the_title( $id ) : $title;
	$subtitle = wp_kses_data( btp_entry_get_option_value( $id, 'subtitle' ) );
} elseif( is_singular() ) {	
	$title = $elems[ 'title' ] ? the_title( '', '', false ) : $title;
	$subtitle = wp_kses_data( btp_entry_get_option_value( $post->ID, 'subtitle' ) );
} elseif ( is_post_type_archive() ) {
	$id = btp_get_post_type_index_page( get_post_type() );
	
	if ( $id ) {
		$title = $elems[ 'title' ] ? get_the_title( $id ) : $title;
		$subtitle = wp_kses_data( btp_entry_get_option_value( $id, 'subtitle' ) );
	} else {
		$title = post_type_archive_title( '', false );
	}	
	
	
} elseif ( is_category() ) {
	$title = sprintf( __( '%s', 'btp_theme' ), '<span>' . single_term_title( '', false ) . '</span>' );
	$subtitle = strip_tags( term_description() );
} elseif( is_tag() ) {
	$title = sprintf( __( 'Tag Archives: %s', 'btp_theme' ), '<span>' . single_term_title( '', false ) . '</span>' );
	$subtitle = strip_tags( term_description() );
} elseif( is_tax() ) {
	$title = single_term_title( '', false );
	$subtitle = strip_tags( term_description() );
} elseif ( is_year() ) {
	$title = get_the_date( 'Y' );
	$subtitle = __( 'Yearly Archives', 'btp_theme' );
} elseif ( is_month() ) {
	$title = get_the_date( 'F Y' );
	$subtitle = __( 'Monthly Archives', 'btp_theme' );
} elseif ( is_day() ) {
	$title = get_the_date();
	$subtitle = __( 'Daily Archives', 'btp_theme' );
} elseif ( is_author() ) {
	if	(	get_query_var('author_name' ) ) {
		$curauth = get_user_by( 'login', get_query_var('author_name') );
	} else {
		$curauth = get_userdata( get_query_var('author') );
	}
	if ( $curauth  ) {
		$title = $curauth->display_name;
	}
	$subtitle = __( 'Author Archives', 'btp_theme' );
} elseif ( is_search() ) {
    $title = __( 'Search Results', 'btp_theme' );
    $subtitle = sprintf( __( '"%s"', 'btp_theme' ), '<span>' . get_search_query() . '</span>' );

    $id = intval( btp_theme_get_option_value( 'page_search_page' ) );
    if ( $id ) {
        /* WPML fallback */
        if ( function_exists( 'icl_object_id' ) ) {
            $id = icl_object_id( $id, 'page', true );
        }

        /* TODO: how to get elems array?  */

        $title = $elems[ 'title' ] ? get_the_title( $id ) : $title;
        $subtitle = wp_kses_data( btp_entry_get_option_value( $id, 'subtitle' ) );
    }
} elseif ( is_404() ) {
	$title = __( 'Error 404', 'btp_theme' );
	$subtitle = __( 'This page was not found, page is missing or moved', 'btp_theme' );		
} else {
   $title = wp_title( ' - ', false, 'right' );
}

?>
<?php if( strlen( $title ) || strlen( $subtitle ) ): ?>
<header id="content-header">		
	<?php if ( strlen( $title ) ): ?>
		<h1 class="page-title"><?php echo $title; ?></h1>
	<?php endif; ?>			
	<?php 
		if ( strlen( $subtitle ) ) {
			echo do_shortcode('[subheading_3 class="page-subtitle"]' . $subtitle . '[/subheading_3]');	
		}
	?>
</header>
<?php endif; ?>
