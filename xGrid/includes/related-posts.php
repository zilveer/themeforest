<?php
global $post, $bd_data;
if( bdayh_get_option( 'article_related' ) ){

    $related_no = bdayh_get_option('article_related_numb') ? bdayh_get_option('article_related_numb') : 3;

    global $bd_count;
    $bd_count = 0;

    global $post;
    $orig_post = $post;

    $query_type = bdayh_get_option('related_query');
    if( $query_type == 'author' ){

        $args=array('post__not_in' => array($post->ID),'posts_per_page'=> $related_no , 'author'=> get_the_author_meta( 'ID' ), 'no_found_rows' => true, 'cache_results' => false, 'ignore_sticky_posts' => 1);

    } elseif( $query_type == 'tag' ) {

        $tags = wp_get_post_tags( $post->ID );
        $tags_ids = array();
        foreach($tags as $individual_tag) $tags_ids[] = $individual_tag->term_id;
        $args=array('post__not_in' => array($post->ID),'posts_per_page'=> $related_no , 'tag__in'=> $tags_ids, 'no_found_rows' => true, 'cache_results' => false, 'ignore_sticky_posts' => 1 );

    } else {

        $categories     = get_the_category( $post->ID );
        $category_ids   = array();
        foreach( $categories as $individual_category ) $category_ids[] = $individual_category->term_id;
        $args=array('post__not_in' => array( $post->ID ),'posts_per_page'=> $related_no , 'category__in'=> $category_ids, 'no_found_rows' => true, 'cache_results' => false, 'ignore_sticky_posts' => 1 );

    }
    $related_query = new wp_query( $args );
    update_post_thumbnail_cache( $related_query );
    if( $related_query->have_posts() ) :
        $count=0;
        ?>
        <div class="single-post-related">
            <div class="box-title">
                <h2>
                    <b><?php _e( 'Related Posts', 'bd' ) ?></b>
                    <div class="home-scroll-nav box-title-more">
                    <?php
                    if ( is_rtl() ) {
                        echo '<a class="prev related-re_scroll-prev" href="#"><i class="bdico dashicons-arrow-right-alt2"></i></a>'."\n". '<a class="nxt related-re_scroll-nxt" href="#"><i class="bdico dashicons-arrow-left-alt2"></i></a>'. "\n";
                    } else {
                        echo '<a class="prev related-re_scroll-prev" href="#"><i class="bdico dashicons-arrow-left-alt2"></i></a>'."\n". '<a class="nxt related-re_scroll-nxt" href="#"><i class="bdico dashicons-arrow-right-alt2"></i></a>'. "\n";
                    }
                    ?>
                    </div>
                </h2>
            </div>
            <section id="related-posts">
                <div class="related-re_scroll">
                    <?php while ( $related_query->have_posts() ) : $related_query->the_post(); $bd_count++;?>
                        <div id="post-<?php the_ID(); ?>" class="post-item <?php if( $bd_count == 3 ) { echo 'last-column'; $bd_count= 0; }?>" >
                            <?php bd_wp_thumb( '320', '220', '', 'ttip' ); ?>
                            <div class="post-caption">
                                <h3 class="post-title"><a href="<?php the_permalink()?>" title="<?php printf(__( '%s', 'bd' ), the_title_attribute( 'echo=0' )); ?>" rel="bookmark"><?php the_title(); ?></a></h3><!-- .post-title/-->
                                <div class="post-meta"><span class="meta-date"><?php echo "<span class='date'>"; the_time('F j, Y');  echo "</span>"; ?></span></div><!-- .post-meta/-->
                            </div><!-- .post-caption/-->
                        </div> <!-- .post -->
                    <?php endwhile;?>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){var e=jQuery(".related-re_scroll .post-item");for(var t=0;t<e.length;t+=3){e.slice(t,t+3).wrapAll('<div class="post-items"></div>');jQuery(".related-re_scroll .post-item").show()}jQuery(function(){jQuery(".related-re_scroll").cycle({fx:"fade",easing:"swing",timeout:5555,speed:600,slideExpr:".post-items",prev:".related-re_scroll-prev",next:".related-re_scroll-nxt",pause:false})})});
                    </script>
                </div><!-- #related-posts -->
                <div class="clear"></div>
            </section><!-- #related-posts -->
        </div><!-- .post-related -->
    <?php endif;
    wp_reset_postdata();
    $post = $orig_post;
    wp_reset_query();
}