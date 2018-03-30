<div class="tt-share clearfix">
    <?php
        global $ttso, $post;
        $blog_retweet   = esc_attr( $ttso->st_blog_retweet );
        $blog_fb_like   = esc_attr( $ttso->st_blog_fb_like );
        $blog_pinterest = esc_attr( $ttso->st_blog_pinterest );

        if ( 'true' == $blog_retweet ) : ?>
            <span class="retweet-share">
                <a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-via="<?php esc_attr( bloginfo( 'name' ) ); ?>" data-text="<?php the_title_attribute(); ?>" data-related="<?php esc_attr( bloginfo( 'name' ) ); ?>" data-count="horizontal">Tweet</a>
            </span>
            <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
        <?php endif;

        if ( 'true' == $blog_fb_like ) : ?>
            <span class="facebook-share">
                <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&amp;layout=button_count&amp;show_faces=false&amp;&amp;action=like&amp;colorscheme=light"></iframe>
            </span>
        <?php endif;

        if ( 'true' == $blog_pinterest ) : ?>
            <span class="pinterest-share">
                <?php $pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                <a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&media=<?php echo $pinterestimage[0]; ?>&description=<?php the_title_attribute(); ?>" class="pin-it-button" count-layout="horizontal">Pin It</a>
            </span>
        <?php endif;
    ?>
</div><!-- end .tt-share -->