<?php if( bdayh_get_option( 'filter_home_page' ) ){ ?>

    <div class="blog-filter">
        <div>
            <div id="filters" class="filter">

                <?php $count_posts = wp_count_posts('post'); ?>

                <span class="active">
                    <a href="#" data-count="<?php echo $count_posts->publish; ?>" data-filter>
                        <?php echo bd_wplang( "show_all" ); ?>
                    </a>
                </span>
                <?php
                /*
                 * Filter Array
                 */
                $filter_array = array();
                $bd_categories = get_categories( array( 'taxonomy'=>'category' ) );

                foreach( $bd_categories as $category ) {
                    $filter_array[$category->slug] = $category->count;
                }

                global $paged, $wp_query, $wp;

                if  ( empty($paged) ) {
                    if ( !empty( $_GET['paged'] ) ) {
                        $paged = $_GET['paged'];
                    } elseif ( !empty($wp->matched_query) && $args = wp_parse_args($wp->matched_query) ) {
                        if ( !empty( $args['paged'] ) ) {
                            $paged = $args['paged'];
                        }
                    }

                    if ( !empty($paged) ){
                        $wp_query->set('paged', $paged);
                    }
                }

                $the_query = new WP_Query();
                if ( $paged == 0)
                    $paged = 1;

                $custom_count = ( $paged - 1) * $items_count;
                $the_query->query('post_type=post&showposts='. $items_count .'&offset=' . $custom_count);

                while( $the_query->have_posts() ) :

                    $the_query->the_post();
                    $post_id    = $the_query->post->ID;
                    $terms      = get_the_terms( $post_id, 'category' );

                    if ( $terms && ! is_wp_error( $terms ) ) {
                        foreach ( $terms as $term ){
                            $filter_array[$term->slug] = $term;
                        }
                    }
                endwhile;

                foreach ( $filter_array as $key => $value ){
                    if ( isset( $value->count ) ) {
                        echo '<span><a href="#" data-count="'. $value->count .'" data-filter=".'.$key.'">' . $value->name . '</a></span>';
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
            <div class="clear"></div>
        </div>
    </div><!-- Filter -->
<?php }
global $paged, $wp_query, $wp;

if  ( empty($paged) ) {
    if ( !empty( $_GET['paged'] ) ) {
        $paged = $_GET['paged'];
    } elseif ( !empty($wp->matched_query) && $args = wp_parse_args($wp->matched_query) ) {
        if ( !empty( $args['paged'] ) ) {
            $paged = $args['paged'];
        }
    }
    if ( !empty($paged) )
        $wp_query->set('paged', $paged);
}

$temp = $wp_query;
$wp_query= null;

$wp_query = new WP_Query();
$wp_query->query("post_type=post&paged=".$paged.'&showposts='.$items_count );

?>