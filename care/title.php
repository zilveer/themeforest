<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Template part: page title & before content area
*	--------------------------------------------------------------------- 
*/
?>

<?php 
if ( is_404() || !is_search() && get_post_type( get_the_ID() ) == 'portfolio' ) : // 404 error & portfolio post header
	// empty
elseif ( is_page() || is_single() ) :  // Page & Single post header options  ?>
	
	<?php if ( wp_kses_post(get_post_meta( get_the_ID(), 'pre_content_activation', true ) != 'off' )) : ?>

		<div class="pre-content" <?php if ( wp_kses_post(get_post_meta( get_the_ID(), 'pre_content_height', true )) ) { echo 'style="height:'. esc_html(get_post_meta( get_the_ID(), 'pre_content_height', true )) .'"'; } ?>>
		
			<?php if ( wp_kses_post(get_post_meta( get_the_ID(), 'rev_on_off', true )) != 'off' && wp_kses_post(get_post_meta( get_the_ID(), 'rev_slider_header', true )) != '' ) : ?>
				<div class="pre-content-slider"><?php putRevSlider( get_post_meta( get_the_ID(), 'rev_slider_header', true ) ); ?></div>
			<?php endif; ?>		
			
			<?php if ( wp_kses_post(get_post_meta( get_the_ID(), 'pre_content_html', true )) ) : ?>
				<div class="pre-content-html"><?php echo do_shortcode( get_post_meta( get_the_ID(), 'pre_content_html', true ) ); ?></div>
			<?php endif; ?>
			
		</div><!-- .pre-content -->
		
	<?php endif; ?>

	<?php if ( wp_kses_post(get_post_meta( get_the_ID(), 'page_title', true )) != 'off' ) : ?>
		<div class="page-header">
			<div class="row-inner">
				<h1 class="page-title"><?php the_title(); ?></h1><?php if( ot_get_option('breadcrumb') != 'off' ) { mnky_breadcrumb(); } ?>
			</div>	
		</div><!-- .page-header -->
	<?php endif; ?>
	
<?php else : // If not page ?>
	
	<?php if ( is_home() ) : // If is blog ?>
		<?php if( ot_get_option('blog_custom_header') != '' ) : ?>
			<div class="pre-content">
				<div class="pre-content-html"><?php echo do_shortcode( ot_get_option('blog_custom_header') ); ?></div>
			</div><!-- .pre-content -->
		<?php endif; ?>
		
		<?php if( ot_get_option('blog_title', 'on') != 'off' ) : ?>
			<div class="page-header">
				<div class="row-inner">
					<h1 class="page-title">
						<?php if ( is_front_page() ) {
							bloginfo('name');
						} else {
							global $wp_query;						
							$home_page = get_page( $wp_query->get_queried_object_id() );
							echo get_the_title( $home_page->ID );
						} ?>
					</h1>
					<?php if( ot_get_option('breadcrumb') != 'off' ) { mnky_breadcrumb(); } ?>
				</div><!-- .row-inner -->	
			</div><!-- .page-header -->
		<?php endif; ?>
					
	<?php elseif ( class_exists( 'Woocommerce' ) && is_woocommerce() ) : // If is WooComerce product page ?>	
		<?php if( ot_get_option('woo_custom_header') != '' ) : ?>
			<div class="pre-content">
				<div class="pre-content-html"><?php echo do_shortcode( ot_get_option('woo_custom_header') ); ?></div>
			</div><!-- .pre-content -->
		<?php endif; ?>
		
		<?php if( ot_get_option('woo_title', 'on') != 'off' ) : ?>
			<div class="page-header">
				<div class="row-inner">
					<h1 class="page-title">
						<?php echo woocommerce_page_title(); ?>
					</h1>
					<?php if( ot_get_option('breadcrumb') != 'off' ) { mnky_breadcrumb(); } ?>
				</div><!-- .row-inner -->	
			</div><!-- .page-header -->
		<?php endif; ?>
						
	<?php else : // If not blog ?>	
	
		<div class="page-header">
			<div class="row-inner">
				<h1 class="page-title">
				
					<?php 
					if ( is_front_page() ) : // Home title
						bloginfo('name');
						
					elseif ( is_search() ) : // Search title
						printf( __( 'Search Results for: %s', 'care' ), '<span>' . get_search_query() . '</span>' );
						
					elseif ( is_category() || is_tax() ) : // Category & taxanomy title
						echo single_cat_title( '', false );
						
					elseif ( is_tag() ) : // Tag title
						echo single_tag_title( '', false );
						
					elseif ( is_archive() ) : // Archive title
						if ( is_day() ) :
							echo get_the_date();
						elseif ( is_month() ) :
							echo get_the_date( 'F Y' ); 
						elseif ( is_year() ) :
							echo get_the_date( 'Y' );
						elseif ( is_author() ) :
							echo get_the_author();
						else :
							_e( 'Archives', 'care' );
						endif; 
							
					endif; ?>
				
				</h1>
				<?php if( ot_get_option('breadcrumb') != 'off' ) { mnky_breadcrumb(); } ?>
			</div><!-- .row-inner -->	
		</div><!-- .page-header -->
	<?php endif; ?>
<?php endif; ?>