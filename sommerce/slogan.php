		<?php 
		    global $post;
		    
		    $post_id = isset( $post->ID ) ? $post->ID : 0;
		    
		    if ( get_post_type() == 'product' )
		        $post_id = get_option('woocommerce_shop_page_id');
		    
            $title =    get_post_meta( $post_id, '_slogan_page', true );
            $subtitle = get_post_meta( $post_id, '_subslogan_page', true );
            if ( ! empty( $title ) ) : 
        ?>
        <div id="slogan" class="inner">
            <?php yiw_string_( '<h1>', $title, '</h1>' ); ?>
            <?php yiw_string_( '<h3>', $subtitle, '</h3>' ); ?>
        </div>
        <?php endif ?>