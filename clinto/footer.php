<?php

	$background_src = Array();

	// get the image background
	if ( function_exists( 'ot_get_option' ) and ot_get_option( 'home_slides', true ) ) :
		$the_query = new WP_Query(array(
			'cat'  => ot_get_option( 'home_slides_category', '' ) , 
			'posts_per_page' => 1,
			'offset'         => 0
		));

		$count = 1;

		if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
			 	if ( has_post_thumbnail() ) { // the current post has a thumbnail
					$background_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '', false, '' );
				}
			endwhile; 
		endif;

	endif;
	
	if ( empty ( $background_src[0]) ) 
		$background_src[0] = '';

?>
<footer style="background-image: url(<?php echo $background_src[0] ?>)">
	<div class="subfooter">
		<div class="container">
			<ul id="sponsor" class="elastislide-list">
			    <?php
					if (function_exists('ot_get_option')) {
						/* get the sponsor array */
						$sponsors = ot_get_option('sponsor', array());
						if (!empty($sponsors)) {
							foreach ($sponsors as $sponsor) {
								echo '<li><a href="' . $sponsor['sponsor_url'] . '"><img src="' . $sponsor['sponsor_logo'] . '" alt="' . $sponsor['title'] . '" /></a></li>';
							}
						}
					}
				?>
			</ul>
		</div>
	</div>
	<div class="wrapper">
		<div class="container">
			<div class="row-fluid">
				<div class="span3">
					<?php if( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-1' ) ) : ?>
					<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="brand">
						<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
					</a><br/><br/>
					<h3>Clinto <small>HTML5 Responsive Wordpress Theme</small></h3><br/>
					<p class="theme-description">This theme is designed to represent a festival or a event website. Equipped with emotional aspect and with calendar managements.</p>
				<?php endif; ?>
				</div>
				<div class="span3">
					<?php if( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-2' ) ) ?>
				</div>
				<div class="span3">
					<?php if( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-3' ) ) ?>
				</div>
				<div class="span3">
					<?php if( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-4' ) ) ?>
				</div>
			</div>
			<div class="closing">
				<!-- Copyright -->
				<p class="copyright">
					&copy; <?php echo date( "Y" ); ?> Copyright <?php bloginfo( 'name' ); ?>. <?php _e( 'Powered by', 'spritz' ); ?>
					<a href="http://wordpress.org" title="WordPress">WordPress</a> &amp; <i class="icon-heart"></i> <a href="http://androiditalia.it" title="Clinto, a HTML5, responsive, Bootstrapped Wordpress theme, designed for festival and events web sites.">Clinto</a>.
				</p>
				<!-- /Copyright -->
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>