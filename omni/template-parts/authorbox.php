<?php
/**
 * Author Box
 *
 * Displays author box with author description and thumbnail on single posts
 *
 * @package    WordPress
 * @subpackage OneTouch theme, for WordPress
 * @since      OneTouch theme 1.9
 */

?>

<div class="about-author authorbox">

	<div class="comment-image">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
	</div>
	<div class="comment-content">
		<article class="author-description">
			<h4 class="author-title"><?php the_author_posts_link(); ?></h4>
			<p><?php the_author_meta( 'description' ); ?></p>
		</article>

		<div class="share-post">
			<div class="author-social">
				<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
					<a data-tooltip="tooltip" data-placement="bottom" title="Twitter"
					   href="<?php the_author_meta( 'twitter' ); ?>"><i class="fa fa-twitter"></i></a>
				<?php endif; ?>
				<?php if ( get_the_author_meta( 'facebook' ) ) : ?>
					<a href="<?php the_author_meta( 'facebook' ) ?>" data-tooltip="tooltip" data-placement="bottom"
					   title="Facebook"><i class="fa fa-facebook"></i></a>
				<?php endif; ?>
				<?php if ( get_the_author_meta( 'instagram' ) ) : ?>
					<a href="<?php the_author_meta( 'instagram' ) ?>" data-tooltip="tooltip" data-placement="bottom"
					   title="Instagram"><i class="fa fa-instagram"></i></a>
				<?php endif; ?>
				<?php if ( get_the_author_meta( 'googleplus' ) ) : ?>
					<a href="<?php the_author_meta( 'googleplus' ) ?>" data-tooltip="tooltip" data-placement="bottom"
					   title="Google Plus"><i class="fa fa-google-plus"></i></a>
				<?php endif; ?>
				<?php if ( get_the_author_meta( 'pinterest' ) ) : ?>
					<a href="<?php the_author_meta( 'pinterest' ) ?>" data-tooltip="tooltip" data-placement="bottom"
					   title="Pinterest"><i class="fa fa-pinterest"></i></a>
				<?php endif; ?>
				<?php if ( get_the_author_meta( 'linkedin' ) ) : ?>
					<a href="<?php the_author_meta( 'linkedin' ) ?>" data-tooltip="tooltip" data-placement="bottom"
					   title="Linkedin"><i class="fa fa-linkedin"></i></a>
				<?php endif; ?>
			</div>
		</div>
	</div>

</div>
<!-- End authorbox. -->
