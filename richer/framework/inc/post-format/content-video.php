<?php  
global $video_height, $video_width;
    if (get_post_meta( $post->ID, 'richer_embed', true ) != '') {
        if (get_post_meta( $post->ID, 'richer_source', true ) == 'vimeo') {  
            echo '<div class="post-video"><div><iframe src="//player.vimeo.com/video/'.get_post_meta( $post->ID, 'richer_embed', true ).'?title=0&amp;byline=0&amp;portrait=0" width="'.$video_width.'" height="'.$video_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';  
        }  
        else if (get_post_meta( $post->ID, 'richer_source', true ) == 'youtube') {  
            echo '<div class="post-video"><div><iframe width="'.$video_width.'" height="'.$video_height.'" src="//www.youtube.com/embed/'.get_post_meta( $post->ID, 'richer_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1" frameborder="0" allowfullscreen></iframe></div></div>';  
        }  
        else {  
            echo '<div class="post-video"><div>'.get_post_meta( $post->ID, 'richer_embed', true ).'</div></div>'; 
        }
    }  
?>

