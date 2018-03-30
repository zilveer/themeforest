<?php

/* portfolio fetching */
function retro_portfolio_get() {
		
	check_ajax_referer( 'retro-home-query', 'referer' );
	
	$id = (int) $_POST['id'];
	
	$retro_portfolio_query = array( 
		'post_type' => 'portfolio-' . $id,
		'tags-' . $id => sanitize_title( $_POST[ 'slug' ] ),
		'posts_per_page' => op_theme_opt( 'portfolio-number' )
	);
	
	$retro_portfolio_query = new WP_Query( $retro_portfolio_query );
	
	if ( $retro_portfolio_query->have_posts() ) {
		while ( $retro_portfolio_query->have_posts() ) {
			$retro_portfolio_query->the_post();		
			get_template_part( 'part', 'item' );
		}	
	}

	wp_reset_postdata();

	die();

}

add_action( 'wp_ajax_retro_portfolio_filter', 'retro_portfolio_get' );
add_action( 'wp_ajax_nopriv_retro_portfolio_filter', 'retro_portfolio_get' );

/* retro mail form */
function retro_mail_send() {

	check_ajax_referer( 'retro-mail-send', 'referer' );
	
	$headers = array();
	$message = null;
	$result = __( 'Please, fill all required fields correctly.', 'openframe' );

	$to = ( $i = op_theme_opt( 'send-to' ) ) ? sanitize_email( $i ) : get_option( 'admin_email' );
	$subject = strip_tags( $_POST['subject'] );
	$from = sanitize_email( $_POST['email'] );
	$name = strip_tags( $_POST['name'] );
	$lemessage = strip_tags( $_POST['message'] );
	$human = $_POST['human'];

	if ( op_theme_opt( 'human-off' ) ) {		

		if ( ! $name || ! is_email( $from ) || ! $lemessage ) {
			die( $result );
		}	

	} else {

		if ( ! $name || ! is_email( $from ) || ! $lemessage || $human != 5  ) {
			die( $result );
		}	

	}
	
	$message = __( 'New message from:', 'openframe' ) . ' ' . esc_attr( $name ) . ' (' . $from . ')';
	$message .= "\n";		
	$message .= '------';	
	$message .= "\n\n";	
	$message .= $lemessage;
	$message .= "\n\n";
	$message .= '------';
	$message .= "\n";		
	$message .= __( 'This message has been sent from:', 'openframe' ) . ' ' . get_bloginfo( 'name' ) . ' (' . home_url('/') . ')';	
	
	$headers[] = 'From: ' . $name . ' <' . $from . '>';
	$headers[] = 'Reply-To: ' . $from;
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-Type: text/plain; charset=UTF-8';

	if ( wp_mail( $to, $subject, $message, $headers ) )
		$result = __('Message received! Thanks.', 'openframe');
	
	die( $result );

}

add_action( 'wp_ajax_retro_mail_send', 'retro_mail_send' );
add_action( 'wp_ajax_nopriv_retro_mail_send', 'retro_mail_send' );

?>