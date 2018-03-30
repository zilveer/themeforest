            <?php 
            global $wp_query;
            $post_id = yiw_post_id();
            if( get_post_meta( $post_id, '_slogan_page', true ) ): ?>
            <div id="slogan">
                <h2><?php echo get_post_meta( $post_id, '_slogan_page', true ); ?></h2>
                <h3><?php echo get_post_meta( $post_id, '_subslogan_page', true ); ?></h3>
            </div>
            <?php endif ?>