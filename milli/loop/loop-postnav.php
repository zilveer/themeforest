<?php 
	global $post;
	
	/*
	 * Check we're on a single post, or else, return
	 */
	if( !( is_single() ) )
		return;
		
	echo '<div class="clear"></div><div class="break-40"></div>';
	
	( get_option( 'show_on_front' ) == 'page' ) ? $url = get_permalink( get_option('page_for_posts' ) ) : $url = home_url();
	
	previous_post_link('%link', '<div class="prev postnav"><i class="fa fa-angle-left fa-2x"></i></div>' );
?>
	
	<a href="<?php echo $url; ?>" class="postnav up">
		<i class="fa fa-angle-up fa-2x"></i>
	</a>
	
<?php 
	next_post_link('%link', '<div class="next postnav"><i class="fa fa-angle-right fa-2x"></i></div>' );