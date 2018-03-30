<?php 
	$url = get_post_meta( $post->ID, '_ebor_the_client_url', true );
	$additional = get_post_meta( $post->ID, '_ebor_meta_repeat_group', true );
?>

<h4>Details</h4>
<div class="pad15"></div>

<ul class="cbp-l-project-details-list ">
	<?php
		  if( get_post_meta( $post->ID, '_ebor_the_client', true ) && get_option('portfolio_client', '1') == 1 ){
		  		echo '<li><strong>'.__('Client','flair').'</strong> '.get_post_meta( $post->ID, '_ebor_the_client', true ).'</li>';
		  }
		  if( get_post_meta( $post->ID, '_ebor_the_client_date', true ) && get_option('portfolio_date', '1') == 1 ){
		  		echo '<li><strong>'.__('Date','flair').'</strong> '.get_post_meta( $post->ID, '_ebor_the_client_date', true ).'</li>';
		  }
		  if( ebor_the_simple_terms() && get_option('portfolio_categories', '1') == 1 ){
		  		echo '<li><strong>'.__('Categories','flair').'</strong> '.ebor_the_simple_terms().'</li>';
		  }
		  if( $additional ){
		  	foreach( $additional as $index => $item ){
		  		echo '<li><strong>';
		  		if( isset ( $item['_ebor_the_additional_title'] ) )
		  			echo $item['_ebor_the_additional_title'];
		  		echo '</strong> ';
		  		if( isset ( $item['_ebor_the_additional_detail'] ) )
		  			echo $item['_ebor_the_additional_detail'];
		  		echo '</li>';
		  	}
		  }
	?>	
</ul>

<?php
	if( $url && get_option('portfolio_url', '1') == 1 )
		echo '<div class="pad25"></div><a href="'. esc_url( $url ) .'" class="btn" target="_blank">'. __('View Website','flair') .'</a><div class="pad25"></div>';