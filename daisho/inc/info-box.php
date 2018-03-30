<?php
function flow_info_box(){
	$info_box_page_id = get_option('info_box');
		if($info_box_page_id){
			$page_data = get_page($info_box_page_id); ?>
			<div class="info-box">
				<div class="info-box-inner clearfix">
					<?php echo do_shortcode( wp_kses_post( $page_data->post_content ) ); ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/header-arrow.png" class="header-arrow" alt="" />
					<!-- <svg version="1.1" class="compact-header-arrow-back-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="34px" height="19px" viewBox="0 0 34 19" enable-background="new 0 0 34 19" xml:space="preserve">
						<polyline fill="none" points="31,16.5 17,2.5 3,16.5 "/>
					</svg> -->
				</div>
			</div>
	<?php }
}
add_action('wp_footer', 'flow_info_box');

function flow_info_box_scripts() {
	wp_enqueue_script( 'flow-info-box-script', get_template_directory_uri() . '/js/info-box.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'flow_info_box_scripts' );
