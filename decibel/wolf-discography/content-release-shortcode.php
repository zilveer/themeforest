<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$post_id   = get_the_ID();
$format     = get_post_format() ? get_post_format() : 'standard';
$thumb_size = wolf_get_image_size( '2x2' );
?>
<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'release-item-container' ) ); ?> data-post-id="<?php the_ID(); ?>">
		<figure class="effect-sadie">
			<?php the_post_thumbnail( $thumb_size ); ?>
			<figcaption>
				<div class="figcaption-inner table">
					<div class="table-cell" >
						<a href="<?php the_permalink(); ?>" class="mask-link"><?php _e( 'View Work', 'wolf' ); ?></a>
						<h2 class="work-title"><a class="entry-link" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<p class="entry-meta">
							<?php echo sanitize_text_field( strip_tags( get_the_term_list( $post_id, 'band', __( 'by ', 'wolf' ), ', ', '' ) ) ); ?>
						</p>
					</div>
				</div>
			</figcaption>
		</figure>
	</article>
<?php endif; ?>
