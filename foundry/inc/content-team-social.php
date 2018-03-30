<?php
	global $post;
	$icons = get_post_meta( $post->ID, '_ebor_team_social_icons', true );
?>

<?php if( is_array($icons) ) : ?>
	<ul class="social-icons text-center">
		<?php 
			foreach( $icons as $key => $icon ){
				if(!( isset( $icon['_ebor_social_icon_url'] ) ))
					continue;
					
				echo '<li><a href="'. $icon['_ebor_social_icon_url'] .'" target="_blank"><i class="icon '. $icon['_ebor_social_icon'] .'"></i></a></li>';
			}
		?>
	</ul>	
<?php endif; ?>