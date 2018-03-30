<?php get_header(); ?>


<?php
	if ( blade_grve_visibility( 'search_page_custom_header_title' ) ) {
		blade_grve_print_header_title('search_page');
	} else {
		blade_grve_print_header_title();
	}

	$search_style = blade_grve_option( 'search_page_style', 'masonry' );
	if ( 'grid' == $search_style) {
		$search_style = 'fitRows';
	}
	$columns = blade_grve_option( 'search_page_columns', '3' );
	$columns_tablet_landscape  = blade_grve_option( 'search_page_columns_tablet_landscape', '3' );
	$columns_tablet_portrait  = blade_grve_option( 'search_page_columns_tablet_portrait', '2' );
	$columns_mobile  = blade_grve_option( 'search_page_columns_mobile', '1' );
	$search_mode = blade_grve_option( 'search_page_mode', 'shadow-mode' );

	$search_extra_classes = '';
	if ( 'shadow-mode' == $search_mode ) {
		$search_extra_classes .= ' grve-with-shadow';
	}
?>

<!-- CONTENT -->
<div id="grve-content" class="clearfix">
	<div class="grve-content-wrapper">
		<!-- MAIN CONTENT -->
		<div id="grve-main-content">
			<div class="grve-main-content-wrapper clearfix">

				<div class="grve-section" style="margin-bottom: 0px;">

					<div class="grve-container">
						<!-- ROW -->
						<div class="grve-row">

							<!-- COLUMN 1 -->
							<div class="grve-column-1">

								<div class="grve-blog grve-blog-columns grve-isotope grve-with-gap<?php echo esc_attr( $search_extra_classes ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" data-columns-tablet-landscape="<?php echo esc_attr( $columns_tablet_landscape ); ?>" data-columns-tablet-portrait="<?php echo esc_attr( $columns_tablet_portrait ); ?>" data-columns-mobile="<?php echo esc_attr( $columns_mobile ); ?>" data-layout="<?php echo esc_attr( $search_style ); ?>" data-spinner="no">

						<?php
							if ( have_posts() ) :
							$grve_post_items = $grve_page_items = $grve_portfolio_items = $grve_other_post_items = 0;
							$grve_has_post_items = $grve_has_page_items = $grve_has_portfolio_items = 0;

							while ( have_posts() ) : the_post();
								$post_type = get_post_type();
								switch( $post_type ) {
									case 'post':
										 $grve_post_items++;
										 $grve_has_post_items = 1;
									break;
									case 'page':
										 $grve_page_items++;
										 $grve_has_page_items = 1;
									break;
									case 'portfolio':
										 $grve_portfolio_items++;
										 $grve_has_portfolio_items = 1;
									break;
									default:
										$grve_other_post_items++;
									break;
								}
							endwhile;
							$grve_item_types = $grve_has_post_items + $grve_has_page_items + $grve_has_portfolio_items;

							if ( $grve_item_types > 1 ) {
						?>
						<div class="grve-filter grve-link-text grve-list-divider grve-align-left">
							<ul>
								<li data-filter="*" class="selected"><?php _e( "All", 'blade' ); ?></li>
								<?php if ( $grve_has_post_items ) { ?>
								<li data-filter=".post"><?php _e( "Post", 'blade' ); ?></li>
								<?php } ?>
								<?php if ( $grve_has_page_items ) { ?>
								<li data-filter=".page"><?php _e( "Page", 'blade' ); ?></li>
								<?php } ?>
								<?php if ( $grve_has_portfolio_items ) { ?>
								<li data-filter=".portfolio"><?php _e( "Portfolio", 'blade' ); ?></li>
								<?php } ?>
							</ul>
						</div>
						<?php
							}

						?>
									<div class="grve-isotope-container">
								<?php
									// Start the Loop.
									while ( have_posts() ) : the_post();
										//Get post template
										get_template_part( 'templates/search', 'masonry' );

									endwhile;
								?>
									</div>
						<?php
								// Previous/next post navigation.
								blade_grve_paginate_links();
							else :
								// If no content, include the "No posts found" template.
								get_template_part( 'content', 'none' );
							endif;
						?>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
		<!-- End Content -->
	</div>
</div>
<?php get_footer();

//Omit closing PHP tag to avoid accidental whitespace output errors.
