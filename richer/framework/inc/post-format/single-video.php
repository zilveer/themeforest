<?php  
    if (get_post_meta( $post->ID, 'richer_source', true ) == 'vimeo') {  
        echo '<div class="post-video"><div><iframe src="http://player.vimeo.com/video/'.get_post_meta( $post->ID, 'richer_embed', true ).'?title=0&amp;byline=0&amp;portrait=0" width="960" height="540" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';  
    }  
    else if (get_post_meta( $post->ID, 'richer_source', true ) == 'youtube') {  
        echo '<div class="post-video"><div><iframe width="960" height="540" src="http://www.youtube.com/embed/'.get_post_meta( $post->ID, 'richer_embed', true ).'" frameborder="0" allowfullscreen></iframe></div></div>';  
    }  
    else {  
        echo '<div class="post-video"><div>'.get_post_meta( $post->ID, 'richer_embed', true ).'</div></div>'; 
    }  
?>	
	

