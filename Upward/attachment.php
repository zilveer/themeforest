<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	1 - ATTACHMENT

		1.1 - Attachment
			- Title
			- File
			- Content

*/

/*===============================================

	A T T A C H M E N T
	Display an attachment

===============================================*/

	get_header();

		?>

			<div id="content">
			
				<div id="content-layout">

					<div id="content-holder" class="sidebar-position-none">
		
						<div id="content-box">
				
							<div>

								<div>

									<?php
							
										if ( have_posts() ) :
				
											while ( have_posts() ) : the_post(); 
	

	
												/*-------------------------------------------
													1.1 - Attachment
												-------------------------------------------*/ ?>

												<article><?php



													/*--- Title -----------------------------*/

													echo '<h1>';

														the_title();

														edit_post_link( __( 'Edit', 'strictthemes' ), '<span class="f13 normal"> - ', '</span>' );

													echo '</h1>';



													/*--- File -----------------------------*/

													echo '<div id="attachment-data">';

														if ( wp_attachment_is_image() ) {
															echo wp_get_attachment_image( $post->ID, 'large', false,  array( 'class' => 'size-original wp-post-image' ) ); }
														
														else {
															echo '<a href="' . wp_get_attachment_url() . '">' . basename( get_permalink() ) . '</a>'; }

													echo '</div>';



													/*--- Content -----------------------------*/

													echo '<div id="content-data">'; the_content(); echo '</div>'; ?>



												</article>

												<div class="clear"><!-- --></div><?php

									

												/*-------------------------------------------
													2.3 - Pagination
												-------------------------------------------*/

												wp_link_pages( array( 'before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number' ) );
									


												/*-------------------------------------------
													2.4 - Comments
												-------------------------------------------*/

												if ( !isset( $st_Settings['page_comments'] ) || !empty( $st_Settings['page_comments'] ) && $st_Settings['page_comments'] == 'yes' ) {
													comments_template(); }

									
														
											endwhile;
				
										else :
				
											echo '<h1>404</h1><p>' . __( 'Sorry, no posts matched your criteria.', 'strictthemes' ) . '</p>';

										endif;
							
									?>

									<div class="clear"><!-- --></div>

								</div>

							</div>
					
						</div><!-- #content-box -->
			
						<div class="clear"><!-- --></div>

					</div><!-- #content-holder -->
		
				</div><!-- #content-layout -->
		
			</div><!-- #content -->
	
		<?php

	get_footer();

?>