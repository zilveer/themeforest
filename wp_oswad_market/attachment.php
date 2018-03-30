<?php
/**
 * The template for displaying attachments.
 *
 * @package WordPress
 * @subpackage RoeDok
 * @since WD_Responsive
 */

get_header(); ?>

		<?php 
		$has_breadcrumb = true;
		if( $has_breadcrumb ){
			global $smof_data;
			$style = '';
			if( isset($smof_data['wd_bg_breadcrumbs']) && $smof_data['wd_bg_breadcrumbs'] != '' )
				$style = 'style="background: url('.$smof_data['wd_bg_breadcrumbs'].')"';
			echo '<div class="breadcrumb-title-wrapper"><div class="breadcrumb-title" '.$style.'>';
					wd_show_breadcrumbs();
			echo '</div></div>';
		}
		?>

		<div id="container" class="single-attachment">
			<div id="content" class="container" role="main">		
				<div id="main" class="col-sm-18">
					<div class="main-content">
						
						<div class="entry-content">

						
						<?php if ( have_posts() ){
							while ( have_posts() ) : the_post(); ?>
							<div id="post-<?php the_ID(); ?>" <?php post_class('single-attachment'); ?>>
								<div class="entry-meta">
									<?php
										printf( __( '<span class="%1$s"></span> %2$s', 'wpdance' ),
											'meta-prep meta-prep-author',
											sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
										get_author_posts_url( get_the_author_meta( 'ID' ) ),
										esc_attr( sprintf( __( 'View all posts by %s', 'wpdance' ), get_the_author() ) ),
										get_the_author()
												)
											);
									?>
												<span class="time"><?php the_time('h:i A - d M Y');?></span>
												<?php
													if ( wp_attachment_is_image() ) {
														echo ' <span class="meta-sep">|</span> ';
														$metadata = wp_get_attachment_metadata();
														printf( __( 'Full size is %s pixels', 'wpdance' ),
															sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
																wp_get_attachment_url(),
																esc_attr( __( 'Link to full-size image', 'wpdance' ) ),
																$metadata['width'],
																$metadata['height']
															)
														);
													}
												?>
												<?php edit_post_link( __( 'Edit', 'wpdance' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
								</div><!-- .entry-meta -->

								<div class="entry-details">
												<div class="entry-attachment">
						<?php if ( wp_attachment_is_image() ) :
							$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
							foreach ( $attachments as $k => $attachment ) {
								if ( $attachment->ID == $post->ID )
									break;
							}
							$k++;
							// If there is more than 1 image attachment in a gallery
							if ( count( $attachments ) > 1 ) {
								if ( isset( $attachments[ $k ] ) )
									// get the URL of the next image attachment
									$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
								else
									// or get the URL of the first image attachment
									$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
							} else {
								// or, if there's only 1 image attachment, get the URL of the image
								$next_attachment_url = wp_get_attachment_url();
							}
						?>
												<p class="attachment">
													<a href="<?php echo $next_attachment_url; ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
														$attachment_width  = apply_filters( 'wpdance_attachment_size', 900 );
														$attachment_height = apply_filters( 'wpdance_attachment_height', 900 );
														echo wp_get_attachment_image( $post->ID, array( $attachment_width, $attachment_height ) ); // filterable image width with, essentially, no limit for image height.
													?>
													</a>
												</p>

												<div id="nav-below" class="navigation">
													<span class="nav-previous"><?php previous_image_link( 'fullsize','Prev' ); ?></span>
													<span class="nav-next"><?php next_image_link( 'fullsize','Next' ); ?></span>
												</div>
						<?php else : ?>
												<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php the_title() ; ?></a>
						<?php endif; ?>
												</div><!-- .entry-attachment -->
												<div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>

						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wpdance' ) ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'wpdance' ), 'after' => '</div>' ) ); ?>
											</div><!-- .entry-content -->
											<div class="entry-utility">
												<?php edit_post_link( __( 'Edit', 'wpdance' ), ' <span class="edit-link">', '</span>' ); ?>
											</div><!-- .entry-utility -->

						</div>				
						<?php endwhile; // end of the loop. ?>
						<?php }?>
						
						
						
						</div>
					</div>
				</div><!-- end content -->
				
				<div id="right-sidebar" class="col-sm-6">
					<div class="right-sidebar-content">
					<?php
						if ( is_active_sidebar( 'primary-widget-area-right' ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( 'primary-widget-area-right' ); ?>
							</ul>
					<?php endif; ?>
					</div>
				</div><!-- end right sidebar -->
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>