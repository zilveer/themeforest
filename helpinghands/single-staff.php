<?php
/**
 * Theme Single Staff
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

get_header();
?>
<div class="container sd-single-staff-page">
	<div class="row">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="col-md-8">
				<article id="post-<?php the_ID(); ?>" <?php post_class('sd-single-staff clearfix'); ?>> 
					<?php
						$position = rwmb_meta( 'sd_staff_position' );
						$email = sanitize_email( rwmb_meta( 'sd_staff_email' ) );
						$phone = rwmb_meta( 'sd_staff_phone' );
						$facebook = rwmb_meta( 'sd_staff_facebook' );
						$twitter = rwmb_meta( 'sd_staff_twitter' );
						$linkedin = rwmb_meta( 'sd_staff_linkedin' );
						$googleplus = rwmb_meta( 'sd_staff_googleplus' );
						$skype = rwmb_meta( 'sd_staff_skype' );
						$website = rwmb_meta( 'sd_staff_website' );
					?>
					<h2 class="sd-entry-title"><?php the_title(); ?></h2>
					<h4><strong><?php echo $position; ?></strong></h4>
						<?php the_content(); ?>
					<?php if ( !empty( $email ) ) : ?>
						<span class="sd-email"><i class="fa fa-envelope-o"></i> <a href="mailto:<?php echo antispambot( $email, 1 ); ?>" title="E-Mail"><?php echo antispambot( $email ); ?></a></span>
					<?php endif; ?>
					<?php if ( !empty( $phone ) ) : ?>
						<span class="sd-phone"><i class="fa fa-phone"></i> <?php echo $phone; ?></span>
					<?php endif; ?>
					<?php if ( !empty( $facebook ) || !empty( $twitter ) || !empty( $linkedin ) || !empty( $googleplus ) || !empty( $skype ) || !empty( $website ) ) : ?>
						<ul class="sd-staff-icons clearfix">
							<?php if ( !empty( $facebook ) ) : ?>
								<li><a href="<?php echo esc_url( $facebook ); ?>" title="Facebook"><i class="fa fa-facebook"></i></a></li>
							<?php endif; ?>
							<?php if ( !empty( $twitter ) ) : ?>
								<li><a href="https://twitter.com/<?php echo esc_attr( $twitter ); ?>" title="Twitter"><i class="fa fa-twitter"></i></a></li>
							<?php endif; ?>
							<?php if ( !empty( $linkedin ) ) : ?>
								<li><a href="<?php echo esc_url( $linkedin ); ?>" title="Linked In"><i class="fa fa-linkedin"></i></a></li>
							<?php endif; ?>
							<?php if ( !empty( $googleplus ) ) : ?>
								<li><a href="<?php echo esc_url( $googleplus ); ?>" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
							<?php endif; ?>
							<?php if ( !empty( $skype ) ) : ?>
								<li><a href="skype:<?php echo esc_attr( $skype ); ?>" title="Skype"><i class="fa fa-skype"></i></a></li>
							<?php endif; ?>
							<?php if ( !empty( $website ) ) : ?>
								<li><a href="<?php echo esc_url( $website ); ?>" title="Website"><i class="fa fa-link"></i></a></li>
							<?php endif; ?>
						</ul>
						<?php endif; ?>
				</article>
			</div>
			<div class="col-md-4 sd-staff-single-img">
				<?php if ( has_post_thumbnail() ) : ?>
					<figure>
						<?php the_post_thumbnail( 'sd-portfolio-thumbs' ); ?>
					</figure>
				<?php endif; ?>
			</div>
		<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria', 'sd-framework') ?>.</p>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>