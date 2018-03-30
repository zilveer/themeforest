<?php

get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		//get all the page meta data (settings) needed (function located in unctions/meta.php)
		$pexeto_page = array(
			'slider' => 'none',
			'layout' => 'right',
			'sidebar' => 'default',
			'show_title'=>'on'
			);

		//include the before content template
		locate_template( array( 'includes/html-before-content.php' ), true, true );
	}
}
?>
<div class="content-box">
<?php
//display the page content
woocommerce_content();
wp_link_pages();

//print sharing
echo pexeto_get_share_btns_html( $post->ID, 'page' );

?>
<div class="clear"></div>
</div>
<?php

if ( pexeto_option( 'page_comments' ) ) {
	//include the comments template
	comments_template();
}


//include the after content template
locate_template( array( 'includes/html-after-content.php' ), true, true );

get_footer();
?>
