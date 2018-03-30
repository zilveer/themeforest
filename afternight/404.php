<?php get_header(); ?>
<section id="main">

    <?php echo get_my_search_form(); ?>

    <div class="main-container">
        <div class="row">
            <div class="twelve columns cat-title">
                <h2 ><span><?php _e( 'Error 404, page, post or resource can not be found' , 'cosmotheme' ); ?></span></h2>
            </div>
        </div>

        <?php
            function show_404( $sender ){
                get_template_part( 'loop' , '404' );
            }
            $layout = new LBSidebarResizer( '404' );
            $layout -> render_frontend( 'show_404' );
        ?>
    </div>
</section>
<?php get_footer(); ?>