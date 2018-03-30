<?php 
	global $majesty_options;
	$css= '';
	if( $majesty_options['logo_position'] == 'center' ) {
		$css = ' empty-space-large';
	}
?>
<section class="banner dark">
    <div id="custom-background-parallax">
		<?php if( $majesty_options['head_parallax'] == 'yes' ) { ?>
		<div class="bcg page-with-custom-background"
                data-center="background-position: 50% 0px;"
                data-bottom-top="background-position: 50% 100px;"
                data-top-bottom="background-position: 50% -100px;"
                data-anchor-target="#custom-background-parallax">
		<?php } else { ?>
			<div class="page-with-custom-background">
		<?php } ?>
			<div class="bg-transparent transparent-bg-3">
				<div class="banner-content">
					<div class="container" >
						<div class="slider-content">
							<div class="empty-space<?php echo esc_attr($css); ?>"></div>
							<?php
								if( $majesty_options['head_display_icon'] == 'yes' ) {
									if( $majesty_options['head_icon_css'] != 'icon-home-ico' ) {
										echo '<i class="'. esc_attr( $majesty_options['head_icon_css'] ) .'"></i>';
									} else {
										echo '<i class="icon-home-ico"></i>';
									}
								}
							?>
							
							<?php 
								if( is_home() ) {
									echo '<h1 class="page-title">'. esc_html__( 'Blog', 'theme-majesty') .'</h1>';
								} elseif( is_search() ) {
								?>
									<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'theme-majesty' ), get_search_query() ); ?></h1>
								<?php
								}  elseif ( is_singular('product') ) {
									echo '<h3 class="page-title">'. esc_html__( 'Shop', 'theme-majesty') .'</h3>';
								} elseif ( is_singular('team-member') ) {
									echo '<h3 class="page-title">'. esc_attr( get_the_title( get_the_ID() ) ) .'</h3>';
								} elseif( is_singular('post') ) {
									echo '<h3 class="page-title">'. esc_html__( 'Blog', 'theme-majesty') .'</h3>';
								} elseif( is_single() ) {
									
								} elseif( is_category() ) {
									echo '<h1 class="page-title">'. esc_attr( single_term_title('', false) ) .'</h1>';
									$majesty_options['head_sub_title'] = esc_html__('Blog Category', 'theme-majesty');
								} elseif( is_tag() ) {
									echo '<h1 class="page-title">'. esc_attr( single_term_title('', false) ) .'</h1>';
									$majesty_options['head_sub_title'] = esc_html__('Blog Tag', 'theme-majesty');
								} elseif( is_author() ) {
									$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
									echo '<h1 class="page-title">'. esc_attr( $curauth->display_name ) .'</h1>';
									$majesty_options['head_sub_title'] = esc_html__('Blog Author', 'theme-majesty');
								} elseif( function_exists('is_shop') && is_shop() ) {
									echo '<h1 class="page-title">'. esc_html__( 'Shop', 'theme-majesty') .'</h1>';
								} elseif( function_exists('is_product_category') && is_product_category() ) {
									echo '<h1 class="page-title">'. esc_attr( single_term_title('', false) ) .'</h1>';
									$majesty_options['head_sub_title'] = esc_html__('Shop Category', 'theme-majesty');
								} elseif( function_exists('is_product_tag') && is_product_tag() ) {
									echo '<h1 class="page-title">'. esc_attr( single_term_title('', false) ) .'</h1>';
									$majesty_options['head_sub_title'] = esc_html__('Shop Tag', 'theme-majesty');
								} elseif ( is_post_type_archive( 'team-member' ) ) {
									echo '<h1 class="page-title">'. esc_html__( 'Team Members', 'theme-majesty') .'</h1>';
								} elseif( is_tax('team-member-category') ) {
									echo '<h1 class="page-title">'. esc_attr( single_term_title('', false) ) .'</h1>';
									$majesty_options['head_sub_title'] = esc_html__('Team Members', 'theme-majesty');
								} elseif( is_page() ){
									if( ( function_exists('is_account_page') && is_account_page() ) || ( function_exists('is_checkout') && is_checkout() ) ) {
											if ( have_posts() ) :
												while ( have_posts() ) : the_post();
													echo '<h1 class="page-title">'. esc_attr(the_title('','', false)) .'</h1>';
												endwhile;
												wp_reset_postdata();
											endif;
									} else {
										echo '<h1 class="page-title">'. esc_attr(the_title('','', false)) .'</h1>';
									}
									
								} else {
									the_archive_title( '<h1 class="page-title">', '</h1>' );
								}
							?>
							<?php if( ! empty( $majesty_options['head_sub_title'] ) ) { ?>
								<p><?php echo esc_attr( $majesty_options['head_sub_title'] ); ?></p>
							<?php }
								sama_get_theme_breadcrumb();
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>