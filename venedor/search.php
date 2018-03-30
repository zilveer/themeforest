<?php get_header() ?>

<?php if ( have_posts() ) : ?>
    
    <?php
    global $venedor_settings;
    
    $post_layout = $venedor_settings['post-layout'];
    $blog_layout = $venedor_settings['blog-layout'];
    $blog_infinite = $venedor_settings['blog-infinite'];
    
    $post_layout = (isset($_GET['post-layout'])) ? $_GET['post-layout'] : $post_layout;
    $blog_layout = (isset($_GET['blog-layout'])) ? $_GET['blog-layout'] : $blog_layout;
    $blog_infinite = (isset($_GET['blog-infinite'])) ? $_GET['blog-infinite'] : $blog_infinite;
    
    $wrap_class = '';
    $post_class = '';
    switch ($post_layout) {
        case 'large-alt': $post_class = "large-alt"; break;
        case 'medium-alt': $post_class = "medium-alt"; break;
        case 'small-alt': $post_class = "small-alt"; break;
        case 'grid': $post_class = "grid-post"; $wrap_class = 'grid-layout row'; break;
        case 'timeline': $post_class = "timeline-post"; $wrap_class = 'timeline-layout'; break;
        default: $post_layout = "medium-alt"; $post_class = "medium-alt"; break;
    }

    ?>

    <div id="content" role="main" class="blog-page-content <?php if ($blog_infinite) echo 'infinite-content' ?>">
        <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'venedor' ), get_search_query() ); ?></h1>
        
        <?php if ($post_layout == 'timeline') : ?>
            <div class="timeline-icon"><span class="fa fa-comments-o"></span></div>
        <?php endif; ?>
        
        <div class="<?php if ($blog_infinite) echo 'posts-infinite' ?> posts-wrap <?php echo $wrap_class ?> clearfix">
            <?php if ($post_layout == 'timeline') : ?>
                <div class="timeline-content-gap"></div>
            <?php endif; ?>
            
            <?php
            $post_count = 1;
            $prev_post_timestamp = null;
            $prev_post_month = null;
            $first_timeline_loop = false;
            while (have_posts()) : the_post();
                $post_timestamp = strtotime($post->post_date);
                $post_month = date('n', $post_timestamp);
                $post_year = get_the_date('o');
                $current_date = get_the_date('o-n');
                $slideshow_type = get_post_meta($post->ID, 'slideshow_type', true);
                $classes = ' post-item';
                global $previousday; unset($previousday);
                ?>
                <?php if ($post_layout == 'timeline' && $prev_post_month != $post_month) : $post_count = 1; ?>
                    <div class="timeline-date"><h3 class="timeline-title"><?php echo get_the_date('F Y'); ?></h3></div>
                <?php endif; ?>
                
                <?php if ($post_layout == 'grid') : ?>
                <?php 
                if (($blog_layout == 'left-sidebar' || $blog_layout == 'right-sidebar'))
                    $classes .= ' col-md-6 col-sm-12';
                else
                    $classes .= ' col-md-4 col-sm-6 col-xs-12';
                ?>
                <?php endif; ?>
                
                <?php if ($post_layout == 'timeline') : ?>
                <?php
                if (($blog_layout == 'left-sidebar' || $blog_layout == 'right-sidebar'))
                    $classes .= ' col-md-6 col-sm-12'.($post_count % 2 == 1?' align-left':' align-right');
                else
                    $classes .= ' col-sm-6 col-xs-12'.($post_count % 2 == 1?' align-left':' align-right');
                ?>
                <?php endif; ?>
                
                <div id="post-<?php the_ID(); ?>" <?php post_class($post_class . $classes . ' clearfix'); ?>><div class="inner">
                    
                    <?php // Post Slideshow ?>
                    <?php if ($post_layout == 'large-alt' || $post_layout == 'grid' || $post_layout == 'timeline') get_template_part('slideshow'); ?>
                            
                    <div class="post-content-wrap">
                        
                        <?php if ($post_layout != 'timeline' && $post_layout != 'grid') : ?>
                        <div class="post-info <?php echo $venedor_settings['post-layout'] ?><?php if (!($slideshow_type == 'images' && has_post_thumbnail()) || ($slideshow_type == 'video' && get_post_meta($post->ID, 'video_code', true))) echo ' none-slideshow' ?>">
                            <a href="<?php the_permalink() ?>">
                                <div class="post-date">
                                    <span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span>
                                    <span class="post-date-month"><?php echo get_the_time('M', get_the_ID()); ?></span>
                                </div>
                            <?php 
                            $post_format = get_post_format();
                            if ($venedor_settings['post-format'] && $post_format) : 
                                if ($post_format == 'link') {
                                    $ext_link = get_post_meta($post->ID, 'external_url', true);
                                    if ($ext_link) : ?>
                                        </a><a href="<?php echo $ext_link ?>">
                                    <?php else :
                                        $post_format = '';
                                    endif;
                                }
                                if ($post_format) : ?>
                                    <div class="post-format <?php echo $post_format ?>">
                                        <span class="fa fa-<?php
                                            switch ($post_format) {
                                                case 'aside': echo 'file-text'; break;
                                                case 'gallery': echo 'camera-retro'; break;
                                                case 'link': echo 'link'; break;
                                                case 'image': echo 'picture-o'; break;
                                                case 'quote': echo 'quote-left'; break;
                                                case 'video': echo 'film'; break;
                                                case 'audio': echo 'music'; break;
                                                case 'chat': echo 'comments'; break;
                                            }
                                        ?>"></span>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <div class="post-content <?php echo $post_layout ?><?php if (!($slideshow_type == 'images' && has_post_thumbnail()) || ($slideshow_type == 'video' && get_post_meta($post->ID, 'video_code', true))) echo ' none-slideshow' ?>">
                        
                            <?php // Post Slideshow ?>
                            <?php if ($post_layout == 'medium-alt' || $post_layout == 'small-alt') get_template_part('slideshow'); ?>
                            
                            <?php if ($post_layout == 'small-alt' && (($slideshow_type == 'images' && has_post_thumbnail()) || ($slideshow_type == 'video' && get_post_meta($post->ID, 'video_code', true)))) : ?>
                            <div class="post-content-small">
                            <?php endif; ?>
                                
                                <?php if ($post_layout == 'timeline') : ?>
                                    <div class="timeline-circle"></div><div class="timeline-arrow"></div>
                                <?php endif; ?>
                                
                                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                
                                <div class="entry-meta">
                                    <?php if ($post_layout == 'timeline' || $post_layout == 'grid') : ?>
                                    <div class="meta-item meta-date"><div class="meta-inner"><span class="fa fa-calendar"></span> <?php the_date() ?> <?php the_time(); ?></div></div>
                                    <?php endif; ?>
                                    <div class="meta-item meta-author"><div class="meta-inner"><span class="fa fa-user"></span> <?php echo __('By', 'venedor'); ?> <?php the_author_posts_link(); ?></div></div>
                                    <div class="meta-item meta-comments"><div class="meta-inner"><span class="fa fa-comments"></span> <?php comments_popup_link(__('0 Comments', 'venedor'), __('1 Comment', 'venedor'), '% '.__('Comments', 'venedor')); ?></div></div>
                                    <div class="meta-item meta-cats"><div class="meta-inner"><span class="fa fa-folder-open"></span> <?php the_category(', '); ?></div></div>
                                </div>
                                            
                                <div class="entry-content">
                                    
                                <?php
                                if ($venedor_settings['blog-excerpt']) {
                                    echo venedor_excerpt( $venedor_settings['blog-excerpt-length'] );
                                } else {
                                    the_content('');
                                }
                                ?>
                            
                            <?php if ($post_layout == 'small-alt' && (($slideshow_type == 'images' && has_post_thumbnail()) || ($slideshow_type == 'video' && get_post_meta($post->ID, 'video_code', true)))) : ?>
                            </div>
                            <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                
                </div></div>
                
            <?php 
            $prev_post_timestamp = $post_timestamp;
            $prev_post_month = $post_month;
            $post_count++;   
            endwhile;    
            ?>
        </div>
        <?php venedor_pagination($pages = '', $range = 2); ?>
        <?php wp_reset_postdata(); ?>
    </div>

<?php else : ?>
    
    <div id="content" role="main">
        <h1 class="page-title"><?php _e( 'Nothing Found', 'venedor' ); ?></h1>
        
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
            
            <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'venedor' ), admin_url( 'post-new.php' ) ); ?></p>

        <?php elseif ( is_search() ) : ?>

            <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'venedor' ); ?></p>
        <?php get_search_form(); ?>

        <?php else : ?>

            <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'venedor' ); ?></p>
            <?php get_search_form(); ?>

        <?php endif; ?>
    </div>
    
<?php endif; ?>

<?php get_footer() ?>