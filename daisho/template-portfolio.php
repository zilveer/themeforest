<?php
/* Template Name: Portfolio Thumbnail Grid */ 

get_header();

// Data of this page
$id = $wp_query->queried_object->ID;
$main_portfolio_page = get_option( 'flow_portfolio_page' );
if(is_singular('portfolio') && ($parent_page = get_post_meta($id, 'portfolio_back_button', true)) && !empty($parent_page) && ($parent_page != 'none')){
	$welcome_text = get_post_meta($parent_page, 'page_portfolio_welcome_text', true);
	$id_to_use = $parent_page;
}else if(is_singular('portfolio') && $main_portfolio_page != ''){
	$welcome_text = get_post_meta($main_portfolio_page, 'page_portfolio_welcome_text', true);
	$id_to_use = $main_portfolio_page;
}else if(is_page_template('template-portfolio.php')){
	$welcome_text = get_post_meta($id, 'page_portfolio_welcome_text', true);
	$id_to_use = $id;
}else{
	$welcome_text = false;
	$id_to_use = false;
}

if ( ! post_password_required( $id_to_use ) ) {
	
	// Welcome text
	if ( $welcome_text ) { 
		echo '<div class="welcome-text">' . do_shortcode( wp_kses_post( wp_unslash( $welcome_text ) ) ) . '</div>';
	}
	
	// Page content (optional)
	if ( $id_to_use ) {
		$page_data = get_page( $id_to_use );
		$page_content = $page_data->post_content;
		$page_content_trimmed = trim( $page_data->post_content );
		if ( ! empty( $page_content_trimmed ) ) {
			echo '<div class="site-content clearfix">' . apply_filters( 'the_content', $page_content ) . '</div>';
		}
	}

	// Portfolio grid
	get_template_part( 'project', 'container' );
	get_template_part( 'project', 'loop' );

} else {
	echo '<header class="page-header">';
	echo '</header>';
	echo '<div class="site-content clearfix" role="main">';
	echo apply_filters( 'the_content', get_the_content() );
	echo '</div>';
	get_template_part( 'project', 'container' );
}

get_footer();
