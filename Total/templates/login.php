<?php
/**
 * Template Name: Login
 *
 * @package Total WordPress Theme
 * @subpackage Templates
 * @version 3.3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?><?php wpex_schema_markup( 'html' ); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<!-- Begin Body -->
<body <?php body_class(); ?>>

	<div id="login-page-wrap" class="clr">

		<div id="login-page" class="clr container">

			<div id="login-page-logo" class="clr">

				<?php
				// Display post thumbnail
				if ( has_post_thumbnail() ) : ?>

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php the_post_thumbnail(); ?></a>

				<?php
				// If no thumbnail is set display text logo
				else : ?>

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>

				<?php endif; ?>

			</div><!-- #login-page-logo -->

			<div id="login-page-content" class="clr">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div><!-- #login-page-content -->

			<?php
			// Display form
			$wpex_login_args = apply_filters( 'wpex_login_page_template_args', array(
				'echo'           => true,
				'redirect'       => site_url( $_SERVER['REQUEST_URI'] ), 
				'form_id'        => 'login-template-form',
				'label_username' => esc_html__( 'Username', 'total' ),
				'label_password' => esc_html__( 'Password', 'total' ),
				'label_remember' => esc_html__( 'Remember Me', 'total' ),
				'label_log_in'   => esc_html__( 'Log In', 'total' ),
				'id_username'    => 'user_login',
				'id_password'    => 'user_pass',
				'id_remember'    => 'rememberme',
				'id_submit'      => 'wp-submit',
				'remember'       => true,
				'value_username' => NULL,
				'value_remember' => false
			) );
			wp_login_form( $wpex_login_args ); ?>

		</div><!-- #login-page -->

	</div><!-- #login-page-wrap -->

<?php wp_footer(); ?>

</body>
</html>