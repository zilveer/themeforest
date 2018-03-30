<?php
/**
 * The Template for displaying all single posts.
 *
 */

get_header();
$is_review = bucket::has_average_score();
?>

    <div class="container container--main" <?php echo $is_review ? 'itemscope itemtype="http://data-vocabulary.org/Review"' : ''; ?>>

    <div class="grid">

    <?php
    // let's get to know this post a little better
    $full_width_featured_image = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_full_width_featured_image', true);
    $disable_sidebar = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_disable_sidebar', true);

    // let's use what we know
    $the_content_width = $disable_sidebar == 'on' ? 'one-whole' : 'lap-and-up-two-thirds';
    $featured_image_width = $full_width_featured_image == 'on' || $disable_sidebar == 'on' ? 'one-whole' : 'lap-and-up-two-thirds';

    if ( wpgrade::option('title_position', 'below') == 'above' ) {
        echo '<div class="article_title--before grid__item  float--left '.$featured_image_width.'">';
        get_template_part('theme-partials/post-templates/single-title');
        echo '</div>';
    }

    get_template_part('theme-partials/post-templates/header-single', get_post_format()); ?>

    <article class="post-article  js-post-gallery  grid__item  main  float--left  <?php echo $the_content_width; ?>">
    <?php while (have_posts()): the_post();

    if ( wpgrade::option('title_position', 'below') == 'below' ) {
        get_template_part('theme-partials/post-templates/single-title');
    }

    if ( $is_review && get_field('placement') == ('before') ) { ?>
        <div class="score-box score-box--inside">
            <div class="score__average-wrapper">
                <div class="score__average <?php echo get_field('note') ? 'average--with-desc' : '' ?>">
                    <?php
                    echo '<div class="score__note" itemprop="rating" >'.bucket::get_average_score().'</div>';
                    if (get_field('note')) {
                        echo '<div class="score__desc">'.get_field('note').'</div>';
                    } ?>
                    <meta itemprop="worst" content = "1">
                    <meta itemprop="best" content = "10">
                </div>
            </div>
        </div>
    <?php } ?>

    <?php
    the_content();

    $args = array(
        'before' => "<ol class=\"nav pagination\"><!--",
        'after' => "\n--></ol>",
        'next_or_number' => 'next_and_number',
        'previouspagelink' => __('Previous', 'bucket'),
        'nextpagelink' => __('Next', 'bucket')
    );
    wp_link_pages( $args ); ?>

    <div class="grid"><!--
                    <?php if ( $is_review && get_field('placement') == ('after') ) :
        if(!get_field('enable_pros_cons_lists')) : ?>
                    --><div class="grid__item center-score">
            <?php else: ?>
            --><div class="grid__item lap-and-up-two-eighths">
                <?php endif; ?>
                <div class="score-box score-box--after">
                    <div class="score__average-wrapper">
                        <div class="score__average  <?php echo get_field('note') ? 'average--with-desc' : '' ?>">
                            <?php
                            echo '<div class="score__note" itemprop="rating">'.bucket::get_average_score().'</div>';
                            if (get_field('note')) {
                                echo '<div class="score__desc">'.get_field('note').'</div>';
                            }
                            ?>
                            <meta itemprop="worst" content = "1">
                            <meta itemprop="best" content = "10">
                        </div>
                    </div>
                </div>

            </div><!--
                    <?php endif;
            if (get_field('enable_pros_cons_lists')): ?>
                     --><div class="grid__item lap-and-up-six-eighths">
                <div class="grid">
                    <?php if (get_field('pros_list')): ?><!--
                                 --><div class="score__pros  grid__item  lap-and-up-one-half">
                        <div class="score__pros__title">
                            <h3 class="hN"><?php _e('Good Things', 'bucket'); ?></h3>
                        </div>
                        <ul class="score__pros__list">
                            <?php while(has_sub_fields('pros_list')): ?>
                                <li class="score_pro"><?php echo get_sub_field('pros_note'); ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </div><!--
                                <?php endif;
                    if (get_field('cons_list')): ?>
                                 --><div class="score__cons  grid__item  lap-and-up-one-half">
                        <div class="score__cons__title">
                            <h3 class="hN"><?php _e('Bad Things', 'bucket'); ?></h3>
                        </div>
                        <ul class="score__cons__list">
                            <?php while(has_sub_fields('cons_list')): ?>
                                <li class="score__con"><?php echo get_sub_field('cons_note'); ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div><!--
                    <?php endif; ?>
                --></div>

        <?php
        if (get_field('enable_review_score')):
            //don't show the breakdown if there is only one - it means the guy just wanted the average score
            if (get_field('score_breakdown') && count(get_field('score_breakdown')) > 1 ): ?>
                <h3><?php _e('The Breakdown', 'bucket'); ?></h3>
                <hr class="separator  separator--subsection">
                <?php while (has_sub_fields('score_breakdown')): ?>
                    <div class="review__score">
                        <div class="score__label"><?php echo get_sub_field('label'); ?></div>
                        <span class="score__badge  badge"><?php echo get_sub_field('score'); ?></span>
                        <div class="score__progressbar  progressbar">
                            <div class="progressbar__progress" style="width: <?php echo get_sub_field('score')*10; ?>%;"></div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <hr class="separator  separator--subsection">
            <?php endif;
        endif; ?>

        <div class="article__meta  article--single__meta">
            <?php
            if (get_field('credits')):
                while (has_sub_field('credits')): ?>
                    <div class="btn-list">
                        <div class="btn  btn--small  btn--secondary"><?php echo get_sub_field('name'); ?></div>
                        <a href="<?php echo get_sub_field('full_url'); ?>" class="btn  btn--small  btn--primary"><?php echo get_sub_field('label'); ?></a>
                    </div>
                <?php endwhile;
            endif;

            $categories = get_the_category();
            if ($categories): ?>
                <div class="btn-list">
                    <div class="btn  btn--small  btn--secondary"><?php _e('Categories', 'bucket') ?></div>
                    <?php
                    foreach ($categories as $category):
                        echo '<a class="btn  btn--small  btn--tertiary" href="'. get_category_link($category->term_id) .'" title="'. esc_attr(sprintf(__("View all posts in %s", 'bucket'), $category->name)) .'">'. $category->cat_name.'</a>';
                    endforeach; ?>
                </div>
            <?php endif;

            $tags = get_the_tags();
            if ($tags): ?>
                <div class="btn-list">
                    <div class="btn  btn--small  btn--secondary"><?php _e('Tagged', 'bucket') ?></div>
                    <?php
                    foreach ($tags as $tag):
                        echo '<a class="btn  btn--small  btn--tertiary" href="'. get_tag_link($tag->term_id) .'" title="'. esc_attr(sprintf(__("View all posts tagged %s", 'bucket'), $tag->name)) .'">'. $tag->name.'</a>';
                    endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
        $share_buttons_settings = wpgrade::option('share_buttons_settings');
        if ( ! empty( $share_buttons_settings ) && (wpgrade::option('blog_single_share_links_position', 'bottom') == 'bottom' || wpgrade::option('blog_single_share_links_position', 'bottom') == 'both') ) {
            get_template_part('theme-partials/post-templates/share-box');
        } ?>
        <?php if (wpgrade::option('blog_single_show_author_box')) get_template_part( 'author-bio' );

        $next_post = get_next_post();
        $prev_post = get_previous_post();
        if (!empty($prev_post) || !empty($next_post)): ?>

            <nav class="post-nav  grid"><!--
                    <?php if (!empty($prev_post) && !empty($next_post)): ?>
                    --><div class="post-nav-link  post-nav-link--prev  grid__item  one-whole  lap-and-up-one-half">
                    <a href="<?php echo get_permalink($prev_post->ID); ?>">
                                <span class="post-nav-link__label">
                                    <?php _e('Previous Article', 'bucket' ); ?>
                                </span>
                                <span class="post-nav-link__title">
                                    <h3 class="hN"><?php echo $prev_post->post_title; ?></h3>
                                </span>
                    </a>
                </div><!--
                    <?php elseif (empty($next_post) && !empty($prev_post)): ?>
                    --><div class="post-nav-link  post-nav-link--prev  grid__item  one-whole  lap-and-up-one-half">
                    <a href="<?php echo get_permalink($prev_post->ID); ?>">
                                <span class="post-nav-link__label">
                                    <?php _e('Previous Article', 'bucket' ); ?>
                                </span>
                                <span class="post-nav-link__title">
                                    <h3 class="hN"><?php echo $prev_post->post_title; ?></h3>
                                </span>
                    </a>
                </div><!--
                    --><div class="post-nav-link  post-nav-link--blank  grid__item  one-whole  lap-and-up-one-half">
                    &nbsp;
                </div><!--
                    <?php endif;

                if(!empty($prev_post) && !empty($next_post)) : ?>
                 --><div class="divider--pointer"></div><!--
                    <?php endif;

                if (!empty($next_post) && !empty($prev_post)): ?>
                 --><div class="post-nav-link  post-nav-link--next  grid__item  one-whole  lap-and-up-one-half">
                    <a href="<?php echo get_permalink($next_post->ID); ?>">
                                <span class="post-nav-link__label">
                                    <?php _e("Next Article", 'bucket'); ?>
                                </span>
                                <span class="post-nav-link__title">
                                    <h3 class="hN"><?php echo $next_post->post_title; ?></h3>
                                </span>
                    </a>
                </div><!--
                    <?php elseif (!empty($next_post) && empty($prev_post)): ?>
                    --><div class="post-nav-link  post-nav-link--blank  grid__item  one-whole  lap-and-up-one-half">
                    &nbsp;
                </div><!--
                 --><div class="post-nav-link  post-nav-link--next  grid__item  one-whole  lap-and-up-one-half">
                    <a href="<?php echo get_permalink($next_post->ID); ?>">
                                <span class="post-nav-link__label">
                                    <?php _e("Next Article", 'bucket'); ?>
                                </span>
                                <span class="post-nav-link__title">
                                    <h3 class="hN"><?php echo $next_post->post_title; ?></h3>
                                </span>
                    </a>
                </div><!--
                    <?php endif; ?>
                --></nav>

        <?php endif; ?>

        <hr class="separator  separator--section">

        <?php
        if ( function_exists('related_posts') ) {
            related_posts();
        }

        // If comments are open or we have at least one comment, load up the comment template
        if ( comments_open() || '0' != get_comments_number() )
            comments_template();

        endwhile; ?>
    </article><!--

        <?php if ($disable_sidebar != 'on'): ?>
         --><div class="grid__item  one-third  palm-one-whole  sidebar">
        <?php get_sidebar(); ?>
    </div>
    <?php else: // ugly ?>
        -->
    <?php endif; ?>

    </div>
    </div>

<?php get_footer(); ?>