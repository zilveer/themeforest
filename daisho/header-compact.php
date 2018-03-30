<?php
$portfolio_page = get_option( 'flow_portfolio_page' );
$back_link_class = 'back-link-external';
$back_link = home_url( '/' );
$show_header = false;

if ( is_singular( 'post' ) && get_option( 'page_for_posts' ) ) {
	$blog_page = get_option( 'page_for_posts' );
	$back_link = get_permalink( $blog_page );
}

if(is_singular('portfolio')){
	$show_header = true;
}

if ( is_singular( 'portfolio' ) && ( $portfolio_back_button = get_post_meta( $post->ID, 'portfolio_back_button', true ) ) && $portfolio_back_button != 'none' ) {
	$back_link = get_permalink( $portfolio_back_button );
	if ( ! in_array( strtolower( get_post_meta( $portfolio_back_button, '_wp_page_template', true ) ), array( 'template-portfolio.php' ) ) ) {
		$back_link_class = 'back-link-external';
	}
} else if ( is_singular( 'portfolio' ) && ! empty( $portfolio_page ) ) {
	$back_link = get_permalink( $portfolio_page );
}

if ( is_page_template( 'template-portfolio.php' ) ) {
	$back_link_class = '';
}
?>
<nav class="compact-nav <?php if($show_header){ echo 'compact-nav-visible'; } ?>" role="navigation">
	<div class="inner">
		<a class="back <?php echo $back_link_class; ?>" href="<?php echo $back_link; ?>">
			<div class="icon">
				 <svg version="1.1" class="compact-header-arrow-back-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19.201px" height="34.2px" viewBox="0 0 19.201 34.2" enable-background="new 0 0 19.201 34.2" xml:space="preserve">
					<polyline fill="none" points="17.101,2.1 2.1,17.1 17.101,32.1 "/>
				</svg>
			</div>
			<div class="label"><?php _e( 'Back', 'flowthemes' ); ?></div>
		</a>
		<div class="compact-search">
			<div class="label"><?php _e( 'Search', 'flowthemes' ); ?></div>
		</div>
		<?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'container_class' => 'compact-container', 'menu_class' => 'nav-menu compact-menu', 'fallback_cb' => false ) ); ?>
	</div>
</nav>

<div class="header-search">
	<?php get_search_form(); ?>
	<div class="search-message"><?php _e( 'Press Enter to Search', 'flowthemes' ); ?></div>
</div>