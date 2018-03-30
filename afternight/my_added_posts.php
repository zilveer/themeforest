<?php 
/*
Template Name: My added posts
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
            
            <div class="twelve columns my_added_posts" id="primary">
                <div id="content" role="main">
                    
                    <?php
                        global $wp_query;
                        
                        define( 'IS_MY_ADDED_POSTS'      , true );
                        $uid = get_current_user_id();
                                   
                    ?>
                    <div class="blog ">

                        <?php 

                            
                            if(isset($wp_query->posts) && count($wp_query->posts)){   
                             
                                if ((int) get_query_var('paged') > 0) {
                                    $paged = get_query_var('paged');
                                } else {
                                    if ((int) get_query_var('page') > 0) {
                                        $paged = get_query_var('page');
                                    } else {
                                        $paged = 1;
                                    }
                                }

                                $wp_query = new WP_Query(array('post_status' => 'any', 'post_type' => array( 'post', 'portfolio'), 'paged' => $paged, 'author' => $uid  ));
        
                          
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