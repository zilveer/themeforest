<?php
/**
 * The template for displaying Category pages for custom post type team-member 
 * 
 * https://wordpress.org/plugins/our-team-by-woothemes/
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 * @package WordPress
 * @subpackage Majesty
 * @since Majesty 1.0
 */
 
get_header(); ?>  

<section class="inner-team text-center padding-100">
	<div class="container">
		<div class="row">
			<main id="main" class="site-main">
				
				<?php if ( have_posts() ) : ?>
				
					<?php while ( have_posts() ) : the_post(); ?>
					
						<div itemscope itemtype="http://schema.org/Person" class="col-md-4 col-sm-6 col-st-6 item">
							<div class="overlay_content clearfix">
								<div class="overlay_item">
									<?php 
										if ( has_post_thumbnail() ) {
											the_post_thumbnail('img-thumb-554', array('class'=>'img-responsive'));
										}
										
										$role 			= get_post_meta( get_the_ID(), '_byline', true);
										$email			= get_post_meta( get_the_ID(), '_contact_email', true);
										$facebook_url 	= get_post_meta( get_the_ID(), '_facebook', true);
										$gplus_url  	= get_post_meta( get_the_ID(), '_googleplus', true);
										$linkedin_url  	= get_post_meta( get_the_ID(), '_linkedin', true);
										$twitter_url  	= '';
										if( get_post_meta( get_the_ID(), '_twitter', true) ) {
											$twitter_url  = esc_url ( 'https://twitter.com/'. get_post_meta( get_the_ID(), '_twitter', true) );
										}
										
										global $majesty_options ;
										$display_email = $majesty_options['display_email_at_team_archive'];
									?>
									<div class="overlay">
										<div class="icons">
											<?php if ( ! empty( $facebook_url ) ) { ?>
												<a href="<?php echo esc_url( $facebook_url ); ?>" title="<?php esc_html_e('Facebook', 'theme-majesty'); ?>"><i class="fa fa-facebook"></i></a>
											<?php } ?>
											<?php if ( ! empty ( $twitter_url ) ) { ?>
												<a href="<?php echo esc_url( $twitter_url ); ?>" title="<?php esc_html_e('Twitter', 'theme-majesty'); ?>"><i class="fa fa-twitter"></i></a>
											<?php } ?>
											<?php if ( ! empty ( $linkedin_url ) ) { ?>
												<a href="<?php echo esc_url( $linkedin_url ); ?>" title="<?php esc_html_e('Linkedin', 'theme-majesty'); ?>"><i class="fa fa-linkedin"></i></a>
											<?php } ?>
											<?php if ( ! empty ( $gplus_url ) ) { ?>
												<a href="<?php echo esc_url( $gplus_url ); ?>" title="<?php esc_html_e('Google Plus', 'theme-majesty'); ?>"><i class="fa fa-google-plus"></i></a>
											<?php } ?>
											<?php if ( ! empty ( $email ) && $display_email ) { ?>
												<a href="mailto:<?php echo antispambot( sanitize_email($email),0 ); ?>" title="<?php esc_html_e('Email', 'theme-majesty'); ?>"><i class="fa fa-envelope-o"></i></a>
											<?php } ?>

											<a class="close-overlay hidden">x</a>
										</div>
									</div>
									<div class="desc">
										<h2 itemprop="name"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
										<?php
											if( $role ) {
												echo '<p itemprop="jobTitle">'. esc_attr( $role ) .'</p>';
											}
										?>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
					<?php sama_paging_nav(); ?>
				
				<?php 
					else :
						get_template_part( 'content', 'none' );
					endif;
				?>
			</main>
		</div>
	</div>
</section> 
<?php get_footer(); ?>