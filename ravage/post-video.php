<!--BEGIN .post-media -->
<div class="post-media icy_video">

    <?php 
        $embed = get_post_meta($post->ID, 'icy_video_embed_code', true);
        if( !empty( $embed ) ) {
            echo stripslashes(htmlspecialchars_decode($embed));
        } else {
            icy_video($post->ID, 750);
        }
    ?>
    
<!--END .post-media -->
</div>