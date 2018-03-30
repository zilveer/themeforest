<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Unicase
 * @since 1.0.0
 */

get_header(); ?>

<main class="site-content"> 
	<div class="container">
        <div class="row">
        <div class="col-md-10 center-block">	
			<section class="message-404 text-center"> 
				<header> 
					<h2 class="title"><?php esc_html_e( '404', 'unicase' ); ?></h2> 
					<p class="subtitle"><?php esc_html_e( 'We are sorry, the page you&#39;ve requested is not available', 'unicase' ); ?></p>

					<?php get_search_form(); ?>

					<a class="return-home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="icon fa fa-home"></i> <?php echo esc_html__( 'Go to Home Page', 'unicase' ); ?></a>
				</header> 
			</section> 
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>