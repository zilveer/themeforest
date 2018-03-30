<?php 
	global $post; 
	$url = get_post_meta( $post->ID, '_ebor_client_url', true );
?>

<li>
    <?php 
    	if( $url )
    		echo '<a href="'. esc_url( $url ) .'" target="_blank">';
    			
    	the_post_thumbnail('full');
    	
    	if( $url ) 
    		echo '</a>'; 
    ?>
</li>