<?php get_header(); ?>
<?php
    $template = 'portfolio_tag';
?>
<section id="main">

    <?php echo get_my_search_form(); ?>

    <div class="main-container">    
        <div class="row">
            <div class="twelve columns cat-title">
                <?php
                    if( have_posts () ){
                ?>
                        <h2 >
                            <span>
                            <?php _e( 'Tags archives' , 'cosmotheme' ); echo ': ';  echo  urldecode(get_query_var('portfolio-tag')); ?>
                            </span>
                        </h2>
                <?php
                    }else{
                        ?><h2><?php _e( 'Sorry, no posts found' , 'cosmotheme' ); ?></h2><?php
                    }
                ?>
            
            </div>
        </div>
        <?php
            $layout = new LBSidebarResizer( 'portfolio_tag' );
            $layout -> render_frontend();
        ?>
    </div>
</section>
<?php get_footer(); ?>