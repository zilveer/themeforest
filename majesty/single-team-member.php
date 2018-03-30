<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage majesty
 * @since majesty 1.0
 */
 
get_header(); ?>

	<section class="team-single padding-100">	
		<div class="container">
			<div class="row">
				<?php
					$post_layout = get_post_meta( get_the_ID(), '_sama_post_layout', true );
					$css = 'col-md-9';
					if ( $post_layout == 'leftsidebar' ) {
						get_sidebar();
					}
					if ( $post_layout == 'fullwidth' ) {
						$css = '';
					}
				?>
				<main id="main" class="site-main">
					<div itemscope itemtype="http://schema.org/Person" class="blog-main-content <?php echo esc_attr( $css ); ?>">
						<?php 
							if ( have_posts() ) :
								while ( have_posts() ) : the_post();
								
								$role 			= get_post_meta( get_the_ID(), '_byline', true);
								$email			= get_post_meta( get_the_ID(), '_contact_email', true);
								$facebook_url 	= get_post_meta( get_the_ID(), '_facebook', true);
								$gplus_url  	= get_post_meta( get_the_ID(), '_googleplus', true);
								$linkedin_url  	= get_post_meta( get_the_ID(), '_linkedin', true);
								$tel			= get_post_meta( get_the_ID(), '_tel', true);
								$twitter_url  	= '';
								if( get_post_meta( get_the_ID(), '_twitter', true) ) {
									$twitter_url  = esc_url ( 'https://twitter.com/'. get_post_meta( get_the_ID(), '_twitter', true) );
								}
						?>
									<?php if ( has_post_thumbnail() ) { ?>
										<div itemprop="image" class="col-md-5 col-sm-6 member-photo">
											<?php the_post_thumbnail('majesty-thumb-450', array('class'=>'img-responsive')); ?>
										</div>
									<?php } ?>
									
									<div class="col-md-7 col-sm-6 member-content">
										<header class="entery-header">
											<h1 itemprop="name"><?php the_title(); ?></h1>
										</header>
										<?php
											if( $role ) {
												echo '<h4 class="jobtitle" itemprop="jobTitle">'. esc_attr( $role ) .'</h4>';
											}
										?>
										<div itemprop="description" class="entery-content">
											
											<?php 
												the_content();
												
												wp_link_pages( array(
													'before'      => '<div class="page-links"><strong class="page-links-title">' . esc_html__( 'Pages:', 'theme-majesty' ) . '</strong>',
													'after'       => '</div>',
													'link_before' => '<span>',
													'link_after'  => '</span>',
												));
											?>
										</div>
										
										<div class="contact mt50">
											<h3><?php esc_html_e('Connect With Me', 'theme-majesty'); ?></h3>
											<ul class="social mt20">
												<?php if ( ! empty( $facebook_url ) ) { ?>
													<li itemprop="contactPoint"><a href="<?php echo esc_url( $facebook_url ); ?>" data-toggle="tooltip" data-original-title="<?php esc_html_e('Facebook', 'theme-majesty'); ?>"><i class="fa fa-facebook"></i></a></li>
												<?php } ?>
												<?php if ( ! empty ( $twitter_url ) ) { ?>
													<li itemprop="contactPoint"><a href="<?php echo esc_url( $twitter_url ); ?>" data-toggle="tooltip" data-original-title="<?php esc_html_e('Twitter', 'theme-majesty'); ?>"><i class="fa fa-twitter"></i></a></li>
												<?php } ?>
												<?php if ( ! empty ( $linkedin_url ) ) { ?>
													<li itemprop="contactPoint"><a href="<?php echo esc_url( $linkedin_url ); ?>" data-toggle="tooltip" data-original-title="<?php esc_html_e('Linkedin', 'theme-majesty'); ?>"><i class="fa fa-linkedin"></i></a></li>
												<?php } ?>
												<?php if ( ! empty ( $gplus_url ) ) { ?>
													<li itemprop="contactPoint"><a href="<?php echo esc_url( $gplus_url ); ?>" data-toggle="tooltip" data-original-title="<?php esc_html_e('Google Plus', 'theme-majesty'); ?>"><i class="fa fa-google-plus"></i></a></li>
												<?php } ?>
												<?php if ( ! empty ( $email ) ) { ?>
													<li itemprop="email"><a href="mailto:<?php echo antispambot( sanitize_email($email),0 ); ?>" data-toggle="tooltip" data-original-title="<?php echo esc_html__('Email:', 'theme-majesty') .' '. antispambot( sanitize_email($email),0 ); ?>"><i class="fa fa-envelope-o"></i></a></li>
												<?php } ?>
												<?php if ( ! empty ( $tel ) ) { ?>
													<li itemprop="telephone"><span data-toggle="tooltip" data-original-title="<?php echo esc_html__('Tel:', 'theme-majesty'). ' '. esc_attr( $tel ); ?>"><i class="fa fa-phone"></i></span></li>
												<?php } ?>
											</ul>
										</div>
										<!-- ends of contact -->
									</div>
								
						<?php								
								endwhile;
								
							else :
							
								get_template_part( 'content', 'none' );
							
							endif;
						?>
					</div>
				</main>
				
				<?php
					if ( $post_layout == 'rightsidebar' || $post_layout == '2sidebar' || empty( $post_layout ) ) {
						get_sidebar();
					}
				?>
			</div>
		</div>
	</section>
	<?php get_template_part('tpl/related-team-members'); ?>
	<!-- # Content End #  -->
<?php get_footer(); ?>