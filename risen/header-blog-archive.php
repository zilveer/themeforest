<?php
/**
 * Blog archive header
 * This is applied to blog categories, tags, date archives, speakers, search results and single posts
 * Note: tpl-blog.php does not use this
 */
 
get_header();

?>

<?php if ( risen_blog_header_image( true ) ) : // show title and breadcrumb path over header image if provided ?>
<header id="page-header">
	<?php risen_blog_header_image(); // show featured image from page using Blog template if Theme Options allows ?>
	<h1>
		<?php
		$tpl_page = risen_get_page_by_template( 'tpl-blog.php' );
		if ( ! empty( $tpl_page->post_title ) ) : // use title from page using Blog template
		?>
		<?php echo $tpl_page->post_title; ?>
		<?php else : // if not title found, simply show "Blog" ?>
		<?php _ex( 'Blog', 'blog header', 'risen' ); ?>
		<?php endif; ?>
	</h1>
	<?php risen_breadcrumbs(); ?>
</header>
<?php else : // show breadcrumbs if no header image provided ?>
<?php risen_breadcrumbs(); ?>
<?php endif; ?>