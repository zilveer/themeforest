<?php
/**
 * Gallery archive header
 * This is applied to gallery categories and single posts
 * Note: tpl-gallery-*.php and other gallery templates do not use this
 */
 
get_header();

?>

<?php if ( risen_gallery_header_image( true ) ) : // show title and breadcrumb path over header image if provided ?>
<header id="page-header">
	<?php risen_gallery_header_image(); // show featured image from page using Gallery template if Theme Options allows ?>
	<h1>
		<?php
		$gallery_page_id = risen_option( 'gallery_page_id' );
		$gallery_page = get_page( $gallery_page_id );
		if ( ! empty( $gallery_page->post_title ) ) : // use title from page using Gallery template
		?>
		<?php echo $gallery_page->post_title; ?>
		<?php endif; ?>
	</h1>
	<?php risen_breadcrumbs(); ?>
</header>
<?php else : // show breadcrumbs if no header image provided ?>
<?php risen_breadcrumbs(); ?>
<?php endif; ?>