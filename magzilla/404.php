<?php 
/**
 * 404 error page
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/ 
global $ft_option, $fave_container;
?>

<?php get_header(); ?>

<div class="<?php echo $fave_container; ?>">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<main class="site-main" role="main">
				<div class="error-404-page text-center">
					<h1><?php echo esc_attr( $ft_option['error_title'] ); ?></h1>

					<p><?php echo esc_attr( $ft_option['error_des'] ); ?></p>
					
					<form class="form-inline" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<div class="form-group">
							<input type="text" name="s" id="s" class="form-control" placeholder="<?php _e("Search","magzilla"); ?>">
						</div>
						<button type="submit" class="btn btn-theme"><?php _e( 'Search', 'magzilla' ); ?></button>
					</form>

					<a class="btn btn-link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Go to homepage', 'magzilla' ); ?></a>
				</div><!-- 404-page text-center -->
			</main><!-- site-main -->
		</div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-12 -->
	</div><!-- .row -->
</div> 
	
<?php get_footer(); ?>