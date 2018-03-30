<?php
/*
* attachment.php to show WordPress Gallery attachments
*/
?>
<?php
get_header();

//grab custom page settings
global $ttso;
$ka_page_title_bar_select = $ttso->ka_page_title_bar_select;//@since 4.6
$show_page_title_bar      = $ttso->ka_tools_panel;//@since 4.6
$header_shadow_style      = $ttso->ka_header_shadow_style;//@since 4.8


//define new options for backward compatible
if ('' == $header_shadow_style): 'no-shadow' ==  $header_shadow_style; endif;
?>
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php truethemes_before_main_hook();// action hook ?>

<div id="main">
	<?php
    //header shadow style
    if (('no-shadow' != $header_shadow_style) && ('Full Width' != $ka_page_title_bar_select)) : ?>
    <div class="karma-header-shadow"></div><!-- END karma-header-shadow --> 
    <?php endif; //END header shadow style ?>

    <?php
    // full-width page title bar
    // @since 4.6
    if( ('Full Width' == $ka_page_title_bar_select) && ('true' == $show_page_title_bar) ):
    get_template_part('theme-template-part-tools-fullwidth','childtheme');
    endif;
    ?>
    
	<div class="main-area">
		<?php
        //page-title-bar (breadcrumbs, etc)
        if( ('Fixed Width' == $ka_page_title_bar_select) && ('true' == $show_page_title_bar) ):
        get_template_part('theme-template-part-tools','childtheme');
        endif; ?>

<main role="main" id="content" class="content_full_width image-attachment">

			<?php the_post(); ?>

						<div class="posted-by-text">
							<?php
/**							
								$metadata = wp_get_attachment_metadata();
								printf( __( 'Back to <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>, You can view the full size image at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a>', 'truethemes_localize' ),
									esc_attr( get_the_time() ),
									get_the_date(),
									esc_url( wp_get_attachment_url() ),
									$metadata['width'],
									$metadata['height'],
									esc_url( get_permalink( $post->post_parent ) ),
									get_the_title( $post->post_parent )
								);
								
**/								
							
							?>
						</div>

			<div id="nav-attachment">

				<span class="nav-previous"><?php previous_image_link( false, __( '&larr; Previous' , 'truethemes_localize' ) ); ?></span>
				<span class="nav-next"><?php next_image_link( false, __( 'Next &rarr;' , 'truethemes_localize' ) ); ?></span>
				
			</div>


					<div class="entry-content">

						<div class="entry-attachment">
							<div class="attachment">
<?php
	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
	 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
	 */
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	// If there is more than 1 attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// or, if there's only 1 image, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}
?>
								<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
								$attachment_size = "940";
								echo wp_get_attachment_image( $post->ID, array( $attachment_size, 1024 ) ); // filterable image width with 1024px limit for image height.
								?></a>

								<?php if ( ! empty( $post->post_excerpt ) ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div>
								<?php endif; ?>
							</div><!-- .attachment -->

						</div><!-- .entry-attachment -->

						<div class="entry-description">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'truethemes_localize' ) . '</span>', 'after' => '</div>' ) ); ?>
						</div><!-- .entry-description -->

					</div><!-- .entry-content -->


				


</main><!-- END main #content -->
</div><!-- END main-area -->

<?php get_footer(); ?>