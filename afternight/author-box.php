<?php
    if( !isset( $post ) ){
        return '';
    }
    if((post::show_meta_author_box($post) ) || is_author() ){
		$show_author = true;
	}else{
		$show_author = false;
	}

    if( ( is_single () || is_author() || is_page() ) &&  $show_author   ){ 
?>
        <aside id="archives-3" class="widget">
            <h4 class="widget-title">
                <?php _e( 'By' , 'cosmotheme' )?>
                <span class="vcard">
                    <a class="url fn n" href="<?php echo get_author_posts_url( $post-> post_author ) ?>" title="<?php echo esc_attr( get_the_author_meta( 'display_name' , $post-> post_author ) ); ?>" rel="me">
                        <?php echo get_the_author_meta( 'display_name' , $post-> post_author ); ?>
                    </a>
                </span>
            </h4>
            <div class="box-author clearfix">
                <p>
                    <a href="<?php echo get_author_posts_url( $post -> post_author) ?>"><?php echo cosmo_avatar( $post -> post_author , $size = '60', $default = DEFAULT_AVATAR );  ?></a>
                    <?php
                        $author_bio = get_the_author_meta( 'description' , $post -> post_author );

                        if( $author_bio != '' ){
                            echo '<span class="author-page">' . $author_bio . '</span>';
                        }
                    ?>
                </p>
            </div>
        </aside>
<?php
    }
?>
