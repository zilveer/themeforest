<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage boutique
 * @since boutique 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<!-- boutique template: content-page.php -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	if ( is_callable( 'boutique_page_metabox::get_page_style' ) && boutique_page_metabox::get_page_style( get_the_ID() ) == 4 ) {
		// hide the heading
	} else {
	    do_action( 'boutique_page_header_before' ); ?>
		<div class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div><!-- .entry-header -->
		<?php do_action( 'boutique_page_header_after' );
	} ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php $d = wp_link_pages( array( 'before' => '<nav class="dtbaker_pagination"><ul class="page-numbers">', 'after' => '</ul></nav>', 'link_before' => '<li><span>', 'link_after' => '</span></li>', 'echo' => 0 ) );
		$d = preg_replace( '#(<a[^>]*>)<li><span>#','<li>$1',$d );
		echo preg_replace( '#</span></li></a>#','</a></li>',$d );
		boutique_content_nav( 'nav-below' );
		comments_template( '', true );
		?>
	</div><!-- .entry-content2 -->

</div><!-- #post-<?php the_ID(); ?> -->
<?php
?>
