<?php
/**
 * Author Box
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

$author_id    = get_the_author_meta( 'ID' );
$author_posts = esc_url( get_author_posts_url( $author_id ) );
?>
<!-- author box -->
<div class="sd-author-box clearfix">
	<?php
		if ( function_exists( 'get_avatar') ) :
			$autor_email = get_the_author_meta( 'email' );
	?>
			<div class="sd-author-photo">
				<?php echo get_avatar( $autor_email, '165' ); ?>
			</div>
	<?php endif; ?>
	<div class="sd-author-bio">
		<h4>
			<?php the_author_meta( 'display_name' ); ?> <br/>
		</h4>
		<ul>
			<?php if ( get_the_author_meta( 'user_url' ) != '' ) { ?>
				<li class="sd-author-website">
					<a class="sd-bg-trans sd-link-trans" href="<?php the_author_meta( 'user_url' ); ?>" target="_blank" title="<?php _e( 'Website', 'sd-framework' ); ?>">
						<i class="fa fa-link"></i>
					</a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'facebook' ) != '' ) { ?>
			<li class="sd-author-facebook"><a class="sd-link-trans" href="<?php the_author_meta( 'facebook' ); ?>" target="_blank" title="<?php _e( 'Facebook', 'sd-framework' ); ?>"><i class="fa fa-facebook"></i></a></li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'twitter' ) != '' ) { ?>
			<li class="sd-author-twitter"><a class="sd-link-trans" href="<?php the_author_meta( 'twitter' ); ?>" target="_blank" title="<?php _e( 'Twitter', 'sd-framework' ); ?>"><i class="fa fa-twitter"></i></a></li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'googleplus' ) != '' ) { ?>
			<li class="sd-author-googleplus"><a class="sd-link-trans" href="<?php the_author_meta( 'googleplus' ); ?>" target="_blank" title="<?php _e( 'Google Plus', 'sd-framework' ); ?>"><i class="fa fa-google-plus"></i> </a></li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'linkedin' ) != '' ) { ?>
			<li class="sd-author-linkedin"><a class="sd-link-trans" href="<?php the_author_meta( 'linkedin' ); ?>" target="_blank" title="<?php _e( 'Linked In', 'sd-framework' ); ?>"><i class="fa fa-linkedin"></i></a></li>
			<?php } ?>
			<?php $author_id = get_the_author_meta( 'ID' ); ?>
			<li class="sd-author-rss"><a class="sd-link-trans" href="<?php echo get_author_feed_link( $author_id ); ?>" title="<?php _e( 'RSS', 'sd-framework' ); ?>"><i class="fa fa-rss"></i></a> </li>
		</ul>
		<p>
			<?php the_author_meta( 'description' ) ?>
		</p>
		<a class="sd-more sd-author-posts" href="<?php echo $author_posts; ?>" title="<?php _e( 'All posts by author', 'sd-framework' ); ?>"><?php _e( 'VIEW ALL POSTS', 'sd-framework' ); ?></a>
	</div>
</div>
