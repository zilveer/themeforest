<?php
global $mk_options;
if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
   
    <div class="news-post-heading clearfix">
        <ul class="news-single-social">
            <li><a onClick="window.print()" href="#"><?php esc_html_e( 'Print', 'mk_framework' ); ?></a></li>
            <li><a href="mailto:?subject=<?php the_title_attribute(); ?>&body=<?php echo esc_attr(get_the_excerpt()); ?>"><?php esc_html_e( 'Email', 'mk_framework' ); ?></a></li>
        </ul>
        <div class="single-news-meta">
            <div class="news-single-categories"><?php echo implode(', ', mk_get_custom_tax(get_the_id(), 'news')); ?></div>
            <time class="news-single-date" datetime="<?php the_date('Y-m-d') ?>">
                <a href="<?php echo get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ) ?>"><?php echo get_the_date() ?></a>
            </time>
        </div>
    </div>

    <?php
    if ( $mk_options['news_disable_featured_image'] == 'true' ) {
        mk_get_view('global', 'featured-image', false, ['post_type'=> 'news', 'width' => mk_count_content_width(), 'height' => $mk_options['news_featured_image_height']]);
    }
    ?>
    
    <div class="news-post-content" itemprop="mainContentOfPage">
        <?php the_content();?>
    </div>

<?php endwhile; ?>