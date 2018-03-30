<?php 
	global $post; 
	$url = get_post_meta( $post->ID, '_ebor_client_url', true );
?>

<div data-toggle="tooltip" data-placement="top" title="<?php the_title(); ?>" data-original-title="<?php the_title(); ?>">
	<?php
		if( $url )
			echo '<a href="'. esc_url( $url ) .'" target="_blank">';
			
		the_post_thumbnail('full', array('class' => 'image-xxs mb-xs-8 fade-1-4'));
		
		if( $url ) 
			echo '</a>';
	?>
</div>