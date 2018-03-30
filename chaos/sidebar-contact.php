<?php
/**
 * The sidebar for contact page
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Road_Themes
 * @since Road Themes 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar-contact' ) ) : ?>
<div id="secondary" class="col-xs-12 col-md-5 sidebar-contact">
	<?php dynamic_sidebar( 'sidebar-contact' ); ?>
</div>
<?php endif; ?>