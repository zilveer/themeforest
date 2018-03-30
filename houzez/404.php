<?php 
/**
 * 404 error page
 *
 * @package Houzez
 * @since 	Houzez 1.0
**/
global $houzez_local;
$title_404 = houzez_option('404-title');
$title_des = houzez_option('404-des');
?>

<?php get_header(); ?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<main class="site-main" role="main">
			<div class="error-404-page text-center">
				<h1><?php echo esc_attr( $title_404 ); ?></h1>

				<p><?php echo wp_kses_post( $title_des ); ?></p>
				
				<a class="btn btn-link" href="<?php echo esc_url( site_url() ); ?>"><?php echo $houzez_local['404_page'];?></a>
			</div><!-- 404-page text-center -->
		</main><!-- site-main -->
	</div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-12 -->
</div><!-- .row --> 
	
<?php get_footer(); ?>