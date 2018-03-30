<div class="breadcumbs">
    <div class="head_breadcumb">
		<div class="banner-breadcumb">
			<div class="container">
			  <?php 
				if( is_home() ) {
					echo '<h1 class="page-title">'. esc_html__( 'Blog', 'theme-majesty') .'</h1>';
				} elseif( is_search() ) {
				?>
					<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'theme-majesty' ), get_search_query() ); ?></h1>
				<?php
					
				} elseif( is_single() ) {
					
				} elseif( function_exists('is_shop') && is_shop() ) {
					echo '<h1 class="page-title">'. esc_html__( 'Shop', 'theme-majesty') .'</h1>';
				} elseif( function_exists('is_product_category') && is_product_category() ) {
					echo '<h1 class="page-title">'. esc_html__( 'Shop Category', 'theme-majesty') .'&#160;'. esc_attr(single_term_title('', false)) .'</h1>';
				} elseif( function_exists('is_product_tag') && is_product_tag() ) {
					echo '<h1 class="page-title">'. esc_html__( 'Shop Tag', 'theme-majesty') .'</h1>';
				} elseif ( is_post_type_archive( 'team-member' ) ) {
					echo '<h1 class="page-title">'. esc_html__( 'Team Members', 'theme-majesty') .'</h1>';
				} elseif( is_page() ){
					if( ( function_exists('is_account_page') && is_account_page() ) || ( function_exists('is_checkout') && is_checkout() ) ) {
						if ( have_posts() ) :		
							while ( have_posts() ) : the_post();	
								echo '<h1 class="page-title">'. esc_attr(the_title('','', false)) .'</h1>';
							endwhile;
							
						endif;
						wp_reset_postdata();
					} else {
						echo '<h1 class="page-title">'. esc_attr(the_title('','', false)) .'</h1>';
					}
						
				} else {
					the_archive_title('<h1 class="page-title">', '</h1>');
				}
				
				sama_get_theme_breadcrumb();
				?>
            </div>
          </div>
    </div>
</div>