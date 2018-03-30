<?php
/**
*Template Name: private content
*
* @author : VanThemes ( http://www.vanthemes.com )
* @license : GNU General Public License version 2.0
*/
get_header(); 

$van_page_type = van_page_type(); 
?>

<?php van_breadcrumb(); ?>

<div id="main-content"  class="<?php echo $van_page_type['type'] . ' ' . $van_page_type['container']; ?>">

	<div id="single-outer">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( array('content','post-inner') ); ?>>
						
						<div class="entry-container">

							<header id="entry-header">
								<h1 class="entry-title">
									<?php the_title(); ?>
								</h1><!-- .entry-title -->
							</header>

							<div class="entry-content">
								<?php
									if ( is_user_logged_in() ) :

										the_content();
										wp_link_pages(array('before' => '<p><strong>'.__( 'Pages:','van').'</strong> ', 'after' => '</p>'));									
										edit_post_link( __( '(Edit)', 'van' ), '<span class="edit-post">', '</span>' );
									else:?>
										<div id="loginform-container"  style="max-width: 300px;margin: 0 auto;">
											<p style=" text-align: center; "><?php _e("You Much Login to view this page", "van"); ?></p>
											<p class="error-message"></p>
											<?php
												 $args = array('redirect' =>  get_permalink(), 'label_username' => __( 'Username', 'van' ),'label_password' => __( 'Password', 'van' ),'label_remember' => __( 'Remember Me', 'van' ),'label_log_in' => __( 'Log In', 'van' ) );
												 wp_login_form( $args );
											?>
											<div class="clear"></div>
											<div class="login-helpers">
												<?php if ( get_option('users_can_register') ) : ?>
													<p><a href="<?php echo esc_url( home_url() ); ?>/wp-register.php"><?php _e( 'Register' , 'van' ) ?></a><p>
												<?php endif; ?>
												<p><a href="<?php echo esc_url( home_url() ); ?>/wp-login.php?action=lostpassword"><?php _e( 'Lost your password ?' , 'van' ) ?></a></p>
											</div>
										</div>
									<?php endif;?>


							</div><!-- .entry-content -->
							
						</div><!-- .entry-container -->

					</article>

				<?php endwhile; ?>

			<?php endif;  ?>
		<?php if ( is_user_logged_in() ) comments_template( '', true ); ?>

	</div> <!-- #single-outer -->

</div><!-- #main-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>