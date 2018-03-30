<?php
/**
 * Multimedia archive header
 * This is applied to multimedia categories, tags, date archives, speakers and single posts
 * Note: tpl-multimedia.php does not use this
 */
 
get_header();

?>

<?php if ( risen_multimedia_header_image( true ) ) : // show title and breadcrumb path over header image if provided ?>
<header id="page-header">
	<?php risen_multimedia_header_image(); // show featured image from page using Multimedia template if Theme Options allows ?>
	<h1>
		<?php
		$tpl_page = risen_get_page_by_template( 'tpl-multimedia.php' );
		if ( ! empty( $tpl_page->post_title ) ) : // use title from page using Multimedia template
		?>
		<?php echo $tpl_page->post_title; ?>
		<?php else : // if no title found, use plural word from multimedia Theme Options ?>
		<?php echo risen_option( 'multimedia_word_plural', 'risen' ); ?>
		<?php endif; ?>
	</h1>
	<?php risen_breadcrumbs(); ?>
</header>
<?php else : // show breadcrumbs if no header image provided ?>
<?php risen_breadcrumbs(); ?>
<?php endif; ?>