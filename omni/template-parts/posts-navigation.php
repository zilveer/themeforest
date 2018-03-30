<?php
/**
 * Template part for displaying section with previous / next posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package omni
 */

$prev_post = get_previous_post();
$next_post = get_next_post();
?>
<div class="posts-navigation">
	<div class="container-fluid nopadding">
		<div class="row nopadding">
			<div class="col-md-6 nopadding align-left">
				<?php if ( ! empty( $prev_post ) ) { ?>

					<?php if ( has_post_thumbnail( $prev_post->ID ) ) :

						$img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ), 'full' );
						$img_url = crum_theme_thumb( esc_url( $img_url[0] ), '556', '556', true, 't' );

						$thumbnail = '<a href="' . get_permalink( $prev_post->ID ) . '" class="thumbnail-image">';
						$thumbnail .= '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $prev_post->post_title ) . '" />';
						$thumbnail .= '</a>';

						echo $thumbnail; // WPCS: XSS OK.

					endif; ?>

					<div class="description">
						<div class="cell-view">
							<div class="width-wrapper">
								<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="small-button">
									<?php esc_html_e( 'Prev post', 'omni' ) ?>
								</a>
								<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="title">
									<?php echo esc_attr( $prev_post->post_title ); ?>
								</a>

								<div class="data">
									<?php omni_posted_on( $args = array( 'post_id' => $prev_post->ID, 'show_date' => true, 'show_comments' => true ) );  ?>
								</div>
								<div class="text">
									<?php echo omni_post_text( $prev_post->ID, 15 );  // WPCS: XSS OK. ?>
								</div>
							</div>
						</div>
					</div>

				<?php } ?>

			</div>
			<div class="col-md-6 nopadding align-right">

				<?php if ( ! empty( $next_post ) ) { ?>

					<?php if ( has_post_thumbnail( $next_post->ID ) ) :

						$img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'full' );
						$img_url = crum_theme_thumb( esc_url( $img_url[0] ), '556', '556', true, 't' );

						$thumbnail = '<a href="' . get_permalink( $next_post->ID ) . '" class="thumbnail-image">';
						$thumbnail .= '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $next_post->post_title ) . '" />';
						$thumbnail .= '</a>';

						echo $thumbnail; // WPCS: XSS OK.

					endif; ?>

					<div class="description">
						<div class="cell-view">
							<div class="width-wrapper">
								<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="small-button">
									<?php esc_html_e( 'Next post', 'omni' ) ?>
								</a>
								<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="title">
									<?php echo esc_attr( $next_post->post_title ); ?>
								</a>

								<div class="data">
									<?php omni_posted_on( $args = array( 'post_id' => $next_post->ID, 'show_date' => true, 'show_comments' => true ) );  ?>
								</div>
								<div class="text">
									<?php echo omni_post_text( $next_post->ID, 15 );  // WPCS: XSS OK. ?>
								</div>
							</div>
						</div>
					</div>

				<?php } ?>

			</div>
		</div>
	</div>
</div>

