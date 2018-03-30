<?php
/**
 * Page related template tags and functions
 *
 * @package mediacenter
 */

/**
 * Displays Page Header
 *
 * @return void
 */
if( ! function_exists( 'mc_display_page_header' ) ) {
	function mc_display_page_header() {

		global $mc_page_metabox;

		$should_hide_title = false;

		if( method_exists( $mc_page_metabox, 'get_the_value' ) ) {
			
			$page_title 		= $mc_page_metabox->get_the_value( 'page_title' );
			$page_subtitle 		= $mc_page_metabox->get_the_value( 'page_subtitle' );
			$should_hide_title 	= $mc_page_metabox->get_the_value( 'hide_title' ) === '1';
		}

		if( empty( $page_title ) ) {
			$page_title = get_the_title();
		}

		if( ! apply_filters( 'mc_should_hide_page_title', $should_hide_title ) ) {
		?>
		<div class="section section-page-title inner-xs">
			<div class="page-header">
				<h2 class="page-title" itemprop="name"><?php echo $page_title;?></h2>
				<?php if( ! empty( $page_subtitle ) ) : ?>
				<p class="page-subtitle"><?php echo $page_subtitle; ?></p>
				<?php endif; ?>
			</div>
		</div>
		<?php
		}
	}
}

/**
 * Display the post content with a link to the single post
 * 
 * @return void
 */
if ( ! function_exists( 'mc_page_content' ) ) {
	function mc_page_content() {
		?>
		<div class="entry-content inner-bottom-sm" itemprop="mainContentOfPage">
			<?php the_content(); ?>
        	<?php 
        		wp_link_pages( array( 
        			'before' 		=> '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'mediacenter' ) . '</span>', 
        			'after' 		=> '</div>', 
        			'link_before' 	=> '<span>', 
        			'link_after' 	=> '</span>' 
    			) ); 

    			mc_display_comments();
			?>

		</div><!-- .entry-content -->
		<?php
	}
}