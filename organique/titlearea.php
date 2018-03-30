<?php
/**
 * Main title area above the content
 *
 * @package Organique
 */

$subtitle = false;

if( is_home() || is_single() ) {
	$title    = get_theme_mod( 'blog_tagline' );
	if ( strlen( $subtitle ) < 1 ) {
		$subtitle = false;
	}
} else if ( is_page() ) {
	$title = get_the_title();
} else if ( is_category() ) {
	$title    = __( 'Category Archive For' , 'organique_wp' );
	$subtitle = '&quot;' . single_cat_title( '', false ) . '&quot;';
} else if ( is_tag() ) {
	$title    = __( 'Tag Archive For' , 'organique_wp' );
	$subtitle = '&quot;' . single_tag_title( '', false ) . '&quot;';
} else if ( is_search() ) {
	$title    = __( 'Search Results For' , 'organique_wp' );
	$subtitle = '&quot;' . get_search_query() . '&quot;';
} else {
	$title = strip_tags( get_the_title() );
}

?>

<div class="banners-big">
	<span class="banners-text"><?php echo lighted_title( $title ); ?>
	<?php
		if ( $subtitle ) {
			echo $subtitle;
		}
	?>
	</span>
</div>