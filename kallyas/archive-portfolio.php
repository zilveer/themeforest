<?php if(! defined('ABSPATH')){ return; }
/**
 * Template layout for PORTFOLIO ARCHIVES
 * @package  Kallyas
 * @author   Team Hogash
 */
	get_header();

	//** Put the header with title and breadcrumb
	$title = is_tax() ? get_the_archive_title() : __( 'Portfolio','zn_framework');
	WpkPageHelper::zn_get_subheader( array( 'title' => $title ) );

?>
<section id="content" class="site-content"  about="archive-portfolio">
	<div class="container">
		<div id="mainbody" <?php echo WpkPageHelper::zn_schema_markup('main'); ?>>
			<?php
				/*
				 * These templates will be used if not overridden by elements in Page Builder
				 */
				$portfolio_style = zget_option( 'portfolio_style', 'portfolio_options', false, 'portfolio_sortable' );
				// Portfolio Sortable
				get_template_part( 'inc/loop', $portfolio_style );
			?>
		</div><!-- end #mainbody.row -->
	</div><!-- end .container -->
</section><!-- end #content -->

<?php get_footer(); ?>
