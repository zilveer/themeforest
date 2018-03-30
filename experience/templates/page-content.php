<?php
/**
 * Page Content
 *
 * Template containing the content for the page.php template file.
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/
 
// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options(); ?>

<?php // Add section pagination attribute (used by JS to detect if pagination is enabled)
if ( get_post_meta( $post->ID, 'experience_section_pagination', true ) == 'on' ) {
	$section_pagination_attr = 'data-section-pagination="true"';
} else {
	$section_pagination_attr = '';
} ?>

<!-- BEGIN .section-wrapper -->
<div <?php post_class( 'section-wrapper' );?> <?php echo $section_pagination_attr; ?>>
	
	<?php // The page header area
	get_template_part( 'templates/page-header' ); ?>

	<?php // There is post content to display
	if ( !empty( $post->post_content ) ) { ?>	
		
		<!-- BEGIN .section-content-wrapper -->
		<div class="section-content-wrapper">
		
			<?php // Set page content padding and width if not using VC
			$the_content = get_the_content();	
			
			if ( 
				!function_exists( 'vc_asset_url' )
				|| strpos( $the_content, '[vc_row' ) === false
			) {
				$content_before = '<div class="row-container padding-h padding-v site-width"><div class="col-padding-adjustment">';
				$content_after = '</div></div>';
			} else {
				$content_before = '';
				$content_after = '';				
			} ?>
			
			<!-- BEGIN .section-content -->
			<div class="section-content">
				
				<!-- BEGIN .post-content -->
				<div class="post-content clearfix">
					
					<?php echo $content_before; ?>
					
						<?php the_content(); ?>
						
						<?php wp_link_pages( array(
							'before'		=> '<div class="wp-link-pages">',
							'after'			=> '</div>',
							'separator'     => '<span class="pagination-separator"></span>',
							'link_before'   => '<span class="pagination-button">',
							'link_after'    => '</span>',
						) ); ?>
				
					<?php echo $content_after; ?>
					
				</div>
				<!-- END .post-content -->
			
			</div>
			<!-- END .section-content -->
			
			<!-- comments -->
		
		</div>
		<!-- END .section-content-wrapper -->
		
		<?php comments_template(); ?>
	
	<?php } ?>

</div>
<!-- END .section-wrapper -->