<?php get_header(); ?>
<?php
    $template = 'search';
?>

<section id="main">
    
    <?php echo get_my_search_form(); ?>

    <div class="main-container">    
        <div class="row">
            <div class="twelve columns cat-title">
                <?php
                    if( have_posts () ){
                ?>
                        <h2>
                            <span>
                            <?php _e( 'Search results: ' , 'cosmotheme' );  ?>
                            </span>
                        </h2>
                <?php
                    }else{
                        ?><h2 ><span><?php _e( 'Sorry, no posts found' , 'cosmotheme' ); ?></h2></span><?php
                    }
                ?> 
            </div>
        </div>
        <?php
            $layout = new LBSidebarResizer( 'search' );
            $layout -> render_frontend();
        ?>
    </div>  
</section>
<?php get_footer(); ?>