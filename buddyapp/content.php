<?php
/**
 * The default template for displaying content
 *
 * Used for single posts display
 *
 * @package WordPress
 * @subpackage Next
 * @since 1.0
 */

$kleo_post_format = get_post_format();
?>

<div class="small-thumbs">
	<article id="post-<?php the_ID(); ?>" <?php post_class(array("clearfix")); ?>>

		<?php if ( sq_option( 'post_media_status', 1, true ) ) : ?>

		<div class="entry-image">
			<?php
			switch ( $kleo_post_format ) {

				case 'video' :
					$video = get_cfield( 'embed' );
					if ( !empty( $video ) ) {
						global $wp_embed;
						echo apply_filters( 'kleo_oembed_video', $video );
					}
					break;

				case 'gallery':

					$slides = get_cfield( 'slider' );

					if ( $slides ) {
						echo '<div class="fslider" data-arrows="false" data-lightbox="gallery">';
						echo '<div class="flexslider"> <div class="slider-wrap">';
						foreach( $slides as $slide ) {
							if ( $slide ) {
								$image = aq_resize( $slide, Kleo::get_config('post_gallery_img_width'), Kleo::get_config('post_gallery_img_height'), true, true, true );
								//small hack for non-hosted images
								if (! $image ) {
									$image = $slide;
								}
								echo '<div class="slide">' .
									'<a href="'. $slide .'" data-lightbox="gallery-item">
										<img class="image_fade" src="'.$image.'" alt="'. get_the_title() .'">'
									. '</a>' .
									'</div>';
							}
						}
						echo '</div></div>';
						echo '</div>';
					}


					break;

				case 'link':

					break;

				case 'quote':
					?>
					<blockquote>
						<?php the_content();?>
					</blockquote>
					<?php
					break;

				case 'status':
					?>
					<div class="panel panel-default">
						<div class="panel-body">
							<?php the_content();?>
						</div>
					</div>
					<?php
					break;

				case 'image':
				default:
					if ( kleo_get_post_thumbnail_url() != '' ) {

						$img_url = kleo_get_post_thumbnail_url();
						$image = aq_resize( $img_url, Kleo::get_config('post_gallery_img_width'), null, true, true, true );
						if( ! $image ) {
							$image = $img_url;
						}
						echo'<img class="image_fade" src="' . $image . '" alt="'. get_the_title() .'">';

					}

					break;

			}
			?>
		</div>

		<?php endif; ?>

		<div class="entry-c">

			<?php if ( ! is_single() ) : ?>

			<header class="entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			</header>

			<?php endif; ?>

			<?php kleo_entry_meta();?>

			<?php if ( ! in_array( $kleo_post_format, array('status', 'quote', ) ) ): ?>

				<div class="entry-content">

					<?php the_content( wp_kses_post( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'buddyapp' ) ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buddyapp' ), 'after' => '</div>' ) ); ?>

				</div><!--end entry-content-->

			<?php endif;?>

		</div>

	</article>
</div>