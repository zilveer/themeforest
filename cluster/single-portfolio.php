<?php get_header(); ?>

<!--BEGIN #primary .hfeed-->
<div id="primary" class="hfeed" role="main">

    <?php stag_post_before(); ?>
    <?php while ( have_posts() ) : the_post(); ?>

    <?php stag_post_before(); ?>
    <!--BEGIN .hentry-->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php stag_post_start(); ?>

    <?php
        $projectImagesArr = get_post_meta(get_the_ID(), '_stag_portfolio_images', true);
        $projectImages    = explode(',', $projectImagesArr);
        $projectDate      = get_post_meta(get_the_ID(), '_stag_portfolio_date', true);
        $projectUrl       = get_post_meta(get_the_ID(), '_stag_portfolio_url', true);
        $skill_terms      = get_the_terms(get_the_ID(), 'skill');
        $skills           = wp_list_pluck( $skill_terms, 'name' );

        if ( ! empty( $projectImagesArr ) && is_array( $projectImages ) ){
            echo '<div id="portfolio-slider-' . get_the_ID() . '" class="flexslider"><ul class="slides">';
            foreach ( $projectImages as $img ) {
                echo '<li><img src="' . esc_url( $img ) . '" alt=""></li>';
            }
            echo '</ul></div>';
        }

    ?>

    <?php if ( $skills || ! empty( $projectDate ) ): ?>
    <div class="portfolio-meta">
        <?php if ( ! empty( $projectDate ) ) : ?>
            <span><strong><?php _e('Project Date:', 'stag'); ?> </strong><?php echo date_i18n( 'F d, Y', strtotime( $projectDate ) ); ?></span>
        <?php endif; ?>

        <?php if ( is_array( $skills ) ) : ?>
            <span><strong><?php _e( 'Skills:', 'stag'); ?> </strong><?php echo implode( $skills, ', ' ); ?></span>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <h1 class="entry-title"><?php the_title(); ?></h1>

    <!-- BEGIN .entry-content -->
    <div class="entry-content">
        <?php
            the_content( __('Continue Reading', 'stag') );
            wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'stag').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));

            if ( ! empty($projectUrl)){
                if( get_post_meta( get_the_ID(), '_stag_portfolio_new_window', true ) === 'on'){
                    $newWindow = ' target="_blank"';
                }else{
                    $newWindow = '';
                }

                ?>

                <a href="<?php echo esc_url( $projectUrl ); ?>" class="button project-button"<?php echo $newWindow; ?>><?php _e('Go to Project', 'stag') ?></a>

                <?php
            }
        ?>
    <!-- END .entry-content -->
    </div>

    <?php stag_post_end(); ?>
    <!--END .hentry-->
    </article>
    <?php stag_post_after(); ?>

    <?php endwhile; ?>
    <?php stag_post_after(); ?>

<!--END #primary .hfeed-->
</div>

<nav class="navigation paging-navigation lr-navigation" role="navigation">
    <?php
    $prev = get_adjacent_post(false,'',false);
    $next = get_adjacent_post(false,'',true);
    ?>
    <div class="nav-links">
        <?php if( is_object($prev) && $prev->ID != get_the_ID()): ?>
        <div class="nav-previous">
            <a href="<?php echo get_permalink($prev->ID); ?>"><i class="icon icon-arrow-left"></i></a>
        </div>
        <?php endif; ?>

        <?php if( is_object($next) && $next->ID != get_the_ID()): ?>
        <div class="nav-next">
            <a href="<?php echo get_permalink($next->ID); ?>"><i class="icon icon-arrow-right"></i></a>
        </div>
        <?php endif; ?>
    </div>
</nav>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
