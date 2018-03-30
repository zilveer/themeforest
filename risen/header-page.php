<?php
/**
 * Page Header
 * This is applied to pages (page.php) and those using page templates (tpl-*.php)
 * It allows for use of the Page Header Override meta box option
 * It makes $content title available to page templates
 * $content_title has current page's title if no header image or if page override header image used and current page's title set to show beneath header 
 */

global $content_title; // make $content_title available to page templates
 
// Main header 
get_header();

// Title from this page
$content_title = get_the_title( $post->ID );

// Header from another page (set with Page Header Override meta box)
$header_override_page_id = get_post_meta( $post->ID, '_risen_page_header_page_id', true );
$header_override_show_title = get_post_meta( $post->ID, '_risen_page_header_show_title', true );
if ( ! empty( $header_override_page_id ) // page was set for override
	 && $header_override_page_id != $post->ID  // page chosen is not same as self
	 && has_post_thumbnail( $header_override_page_id ) // page has featured image
) {

	// Get override page data
	$header_override_page = get_page( $header_override_page_id );
	
	// Change title and image to use those from override page
	$header_title = $header_override_page->post_title;
	$header_image = get_the_post_thumbnail( $header_override_page->ID, 'risen-header', array ( 'class' => 'page-header-image', 'title' => '' ) );
	
	// If this page's title not set to show below header override, blank it
	if ( empty( $header_override_show_title ) ) {
		$content_title = '';
	}
	
}

// Header from this page
else {

	$header_title = $content_title;
	$header_image = get_the_post_thumbnail( $post->ID, 'risen-header', array ( 'class' => 'page-header-image', 'title' => '' ) );

	// If has header image, do not repeat title beneath header
	if ( $header_image ) {
		$content_title = '';
	}
	
}

?>

<?php if ( $header_image ) : // show title and breadcrumb path over header image if provided ?>
<header id="page-header">
	<?php echo $header_image; ?>
	<?php if ( $header_title ) : ?>
	<h1><?php echo $header_title; ?></h1>
	<?php endif; ?>
	<?php risen_breadcrumbs(); ?>
</header>
<?php else : // show breadcrumbs if no header image provided ?>
<?php risen_breadcrumbs(); ?>
<?php endif; ?>