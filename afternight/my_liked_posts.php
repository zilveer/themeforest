<?php 
/*
Template Name: My liked posts
*/ 

get_header(); ?>


<?php
    $post_id = $post -> ID;
?>

<section id="main">
    
    <?php echo get_my_search_form(); ?>

    <div class="main-container">
        <div class="row cat-title">
            <div class="twelve columns">
                <h2><span><?php the_title(); ?></span></h2>
            </div>             
        </div>
        <div class="row">
            
            <div class="twelve columns" id="primary">
                <div id="content" role="main">
                    
                    <?php
                        global $wp_query;
                        $uid = get_current_user_id();
                        $voted_posts = get_user_meta( $uid, ZIP_NAME.'_voted_posts',true );                
                    ?>
                    <div class="blog ">

                        <?php 

                            if(is_array($voted_posts) && sizeof($voted_posts)){

                                if ((int) get_query_var('paged') > 0) {
                                    $paged = get_query_var('paged');
                                } else {
                                    if ((int) get_query_var('page') > 0) {
                                        $paged = get_query_var('page');
                                    } else {
                                        $paged = 1;
                                    }
                                }

                                $wp_query = new WP_Query( array( 'post_type' => array( 'post', 'page','portfolio','testimonial','banner','box','team'),     
                                                                'post_status' => 'publish' , 
                                                                'post__in' => $voted_posts, 
                                                                'fp_type' => 'like', 
                                                                'paged' => $paged  ) );
        
                                
                                /* content */
                                $resizer = new LBPageResizer('page');
                                $resizer -> render_frontend();
        
                            }else{

                                echo '<p class="content-title ">'.__('Nothing found.','cosmotheme').'</p>';
                            }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>
<?php get_footer(); ?>
