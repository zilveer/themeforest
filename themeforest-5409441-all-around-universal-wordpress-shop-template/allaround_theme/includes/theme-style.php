<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

function allaround_insert_head_styles() {
	global $allaround_data;
	$pie = get_template_directory_uri() . '/PIE/PIE.htc';
	?>
	<style type="text/css">
	<?php
		if ( false === ( $insert_google = get_transient( 'google_fonts' ) ) ) { allaround_checkfonts($allaround_data); $insert_google = get_transient( 'google_fonts' ); }
		if ( false === ( $insert_fonts = get_transient( 'insert_fonts' ) ) ) { allaround_checkfonts($allaround_data); $insert_fonts = get_transient( 'insert_fonts' ); }
		echo $insert_google;
		echo $insert_fonts;
		
		if( $allaround_data['custom_color'] != '' ) :
			if ( false === ( $insert_colors = get_transient( 'insert_colors' ) ) ) { allaround_checkcolors($allaround_data); $insert_colors = get_transient( 'insert_colors' ); }
			if ( false === ( $insert_images = get_transient( 'insert_images' ) ) ) { allaround_checkimages($allaround_data); $insert_images = get_transient( 'insert_colors' ); }
			echo $insert_colors;
			echo $insert_images;
		endif;
	
		if( $allaround_data['custom-css'] != '' ) :
			echo $allaround_data['custom-css'];
		endif;
		printf('.header_wrap, .image_wrapper, .content_image, .header_menu ul ul li, .image_socials a img, .no-sidebar .image_more_info, .image_more_info, .image_more_info img, .latest_news, .date_wrapper, .latest_news_related_single_post, #ui-carousel-next, #ui-carousel-prev, #rcarousel2-next, #rcarousel2-prev, .date_bubble_holder .date, .date_bubble_holder .comments, .blog_post.blog2.blog3 .date_bubble_holder .comments, .about_the_author_image, #submit, .blog_post_comments .comment_image_wrapper img, .blog_post_comments .comment_image_wrapper .img_border, .no-sidebar .column-1-3.about_us .circle_block_wrapper, .no-sidebar .column-1-3.about_us .circle_block, .column-1-3.about_us .circle_block_wrapper, .column-1-3.about_us .circle_block, .circle_block_wrapper.dashed .small_circle, .circle_block.dashed, .about_linked_circles .central_circle, .products_sidebar li div.dot, .products_wrapper span.price, .no-sidebar .col-1-4_img, .no-sidebar .products2_column .image_wrapper, .col-1-4_img, .products2_column .image_wrapper, .image_wrapper.zoom div.zoom_wrap, .sidebar_wrapper.product_page .small_images_wrapper .image_wrapper, .gallery img, .input_title, .input_field, .submit_button, .textarea_title, .textarea_field, .acc-arrow, .alert_box, .testimonials img, .testimonials .img_border, .testimonials .img_border_featured, .woocommerce table.cart td.actions .button.alt, .woocommerce-page table.cart td.actions .button.alt, .woocommerce .cart .button, .woocommerce-page .cart .button, .woocommerce .cart input.button, .woocommerce-page .cart input.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce a.button, .woocommerce-page a.button, .woocommerce .cart-collaterals .shipping_calculator .button, .woocommerce-page .cart-collaterals .shipping_calculator .button, .woocommerce ul.product_list_widget li img, #searchform label, #searchform input[type="text"], #searchform input[type="submit"], .woocommerce a.edit, .woocommerce #commentform label, .woocommerce #commentform input, .woocommerce #commentform p.comment-form-comment textarea#commen, .woocommerce #commentform p.comment-form-comment label, .woocommerce #commentform .form-submit input#submit, .woocommerce-page form.login, .woocommerce-page form.login .form-row input.input-text, .woocommerce-page form.login .form-row label, .woocommerce form .form-row label[for="password_1"], .woocommerce form .form-row label[for="password_2"], .woocommerce form .form-row input.input-text#password_1, .woocommerce form .form-row input.input-text#password_2, .woocommerce form .form-row label[for="user_login"], .woocommerce form .form-row label[for="password_2"], .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span.current, nav li a, .circle_slider_thumb, .circle_slider_thumb img
		{behavior: url(%1$s);zoom:1;}
		.circle_slider_thumb img{position:relative;}', $pie);
	/* .pagination */?>
	</style>
	<?php 
}
add_action( 'wp_head', 'allaround_insert_head_styles' );
?>