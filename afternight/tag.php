<?php get_header(); ?>
<?php
    $template = 'tag';
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
                                <?php _e( 'Tags archives' , 'cosmotheme' ); echo ': ';  single_tag_title(); ?>
                            </span>
                        </h2>
                <?php
                    }else{
                        ?><h2><span><?php _e( 'Sorry, no posts found' , 'cosmotheme' ); ?></span></h2><?php
                    }
                ?>
            </div>
        </div>
        <?php
            $layout = new LBSidebarResizer( 'tag' );
            $layout -> render_frontend();
        ?>
    </div>
</section>
<?php get_footer(); ?>