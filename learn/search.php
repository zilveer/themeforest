<?php

get_header();

?>

<?php 
    // search only posts
    global $wp_query;
    $args = array_merge( $wp_query->query, array( 'post_type' => 'post' ) );
    query_posts( $args ); 
?>

<section id="main_content">

    <div class="container">

        <?php learn_breadcrumbs(); ?>

        <div class="row">

            <aside class="col-md-4">
                <?php get_sidebar();?>
            </aside>

            <div class="col-md-8">

                <?php 
                
                    if(have_posts()) : 
                        $args = array(    
                            'paged' => $paged,
                            'post_type' => 'post',
                            );
                    $wp_query = new WP_Query($args);
                    while ($wp_query -> have_posts()): $wp_query -> the_post();                       

                    get_template_part( 'content', get_post_format() ) ;

                    endwhile;?>

                    <?php else: ?>

                    <h3><?php esc_html_e('Nothing Found Here!', 'learn'); ?></h3>

                <?php endif ?>
                <div class="text-center">
                    <ul class="pagination">
                        <?php echo learn_pagination(); ?>
                    </ul>
                </div>

            </div>

        </div>

    </div>

</section>

<?php get_footer(); ?>