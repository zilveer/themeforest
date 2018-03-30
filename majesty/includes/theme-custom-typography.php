<?php
/*
 *	this function to out custom Typography CSS
 *	This file only load when you enable custom typography in theme option page
 */
function sama_output_custom_css_typography () {
	global $majesty_options;
	if( $majesty_options['enable_typography'] ) {
		$body_font_size 			= $majesty_options['body_font_size'];
		$body_line_height 			= $majesty_options['body_line_height'];
		$par_font_size 				= $majesty_options['par_font_size'];
		$par_line_height 			= $majesty_options['par_line_height'];
		$post_font_size 			= $majesty_options['post_font_size'];
		$post_line_height 			= $majesty_options['post_line_height'];		
		$member_font_size 			= $majesty_options['member_font_size'];
		$member_line_height 		= $majesty_options['member_line_height'];
		$product_font_size 			= $majesty_options['product_font_size'];
		$product_line_height 		= $majesty_options['product_line_height'];
		$custom_head_f_size 		= $majesty_options['custom_head_f_size'];
		$custom_head_f_height 		= $majesty_options['custom_head_f_height'];
		$title_head_f_size 			= $majesty_options['title_head_f_size'];
		$title_head_f_height 		= $majesty_options['title_head_f_height'];
		$h1_font_size 				= $majesty_options['h_1_size'];
		$h1_line_height 			= $majesty_options['h_1_lineheight'];
		$h2_font_size 				= $majesty_options['h_2_size'];
		$h2_line_height 			= $majesty_options['h_2_lineheight'];		
		$h3_font_size 				= $majesty_options['h_3_size'];
		$h3_line_height 			= $majesty_options['h_3_lineheight'];
		$h4_font_size 				= $majesty_options['h_4_size'];
		$h4_line_height 			= $majesty_options['h_4_lineheight'];
		$h5_font_size 				= $majesty_options['h_5_size'];
		$h5_line_height 			= $majesty_options['h_5_lineheight'];
		$h6_font_size 				= $majesty_options['h_6_size'];
		$h6_line_height 			= $majesty_options['h_6_lineheight'];
?>
<style type="text/css">
body{font-size: <?php echo absint( $body_font_size ); ?>px;line-height: <?php echo esc_attr( $body_line_height ); ?>;}
body p{font-size: <?php echo absint( $par_font_size ); ?>px;line-height: <?php echo esc_attr( $par_line_height ); ?>;}
.entery-content,.entery-content p{font-size: <?php echo absint( $post_font_size ); ?>px;line-height: <?php echo esc_attr( $post_line_height ); ?>;}
.member-content .entery-content p{font-size: <?php echo absint( $member_font_size ); ?>px;line-height: <?php echo esc_attr( $member_line_height ); ?>;}
.single-menu.desc-content p{font-size: <?php echo absint( $product_font_size ); ?>px;line-height: <?php echo esc_attr( $product_line_height ); ?>;}
h2.heading,.head_title h2{font-size: <?php echo absint( $custom_head_f_size ); ?>px;line-height: <?php echo esc_attr( $custom_head_f_height ); ?>;}
.entery-header h1,h1.entry-title,.blog_single .entery-header h1{font-size: <?php echo absint( $title_head_f_size ); ?>px;line-height: <?php echo esc_attr( $title_head_f_height ); ?>;}
h1{font-size: <?php echo absint( $h1_font_size ); ?>px;line-height: <?php echo esc_attr( $h1_line_height ); ?>;}
h2{font-size: <?php echo absint( $h2_font_size ); ?>px;line-height: <?php echo esc_attr( $h2_line_height ); ?>;}
h3{font-size: <?php echo absint( $h3_font_size ); ?>px;line-height: <?php echo esc_attr( $h3_line_height ); ?>;}
h4{font-size: <?php echo absint( $h4_font_size ); ?>px;line-height: <?php echo esc_attr( $h4_line_height ); ?>;}
h5{font-size: <?php echo absint( $h5_font_size ); ?>px;line-height: <?php echo esc_attr( $h5_line_height ); ?>;}
h6{font-size: <?php echo absint( $h6_font_size ); ?>px;line-height: <?php echo esc_attr( $h6_line_height ); ?>;}
</style>
<?php
	}
}
add_action( 'wp_head', 'sama_output_custom_css_typography', 10 );

?>