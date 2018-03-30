<?php if (is_single()): ?>
    <h1>oy</h1>
<?php endif ?>

<?php
    $newsstand_timeformat;
    $newsstand_timeformat = get_option('time_format');

    $newsstand_dateformat;
    $newsstand_dateformat = get_option('date_format');
?>

<?php
	$swp_what = get_post_meta( get_the_ID(), 'newsstand_swp_what', 1, true );
    $swp_cat = get_post_meta( get_the_ID(), 'newsstand_block_block29_category', 1, true );

    if ($swp_what=='latestvideos') {
        $args = array('post_type' => 'video', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ) );
    } elseif($swp_what=='latestposts') {
        $args = array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ));
    } elseif($swp_what=='fromcategory') {

        $categoryID = get_category($swp_cat);
        $nb_cat_color = Taxonomy_MetaData::get( 'category', $categoryID->cat_ID, 'newsstand_cat_color');
        $nb_cat_name = $categoryID->category_nicename;
        $cat_id = $categoryID->cat_ID;

        $args = array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ), 'cat'=>$cat_id);
    }

    $wp_query = new WP_Query( $args );
?>

<?php if ($swp_what=='latestvideos'): ?>
    <div class="col-title" style="border-color: #2dbda8;"><span style="background-color: #2dbda8;"><?php _e('Latest Videos', 'newsstand'); ?></span></div>
<?php endif ?>
<?php if ($swp_what=='latestposts'): ?>
    <div class="col-title" style="border-color: #2dbda8;"><span style="background-color: #2dbda8;"><?php _e('Latest Posts', 'newsstand'); ?></span></div>
<?php endif ?>
<?php if ($swp_what=='fromcategory'): ?>
    <div class="col-title" style="border-color: <?php echo esc_attr($nb_cat_color); ?>;"><span style="background-color: <?php echo esc_attr($nb_cat_color); ?>;"><?php echo esc_html($nb_cat_name); ?></span></div>
<?php endif ?>


<div class="news-post-list lightGallery-videos-2">

    <?php if ($wp_query->have_posts()): ?>
        <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

            <?php
                $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                $video_url = get_post_meta( get_the_ID(), 'newsstand_video_url', 1, true )
            ?>

            <div class="single">
                <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
                    <a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a>
                    <?php if ($swp_what=='latestvideos'): ?>
                        <a href="javascript:void(null);" class="play-video" data-src="<?php echo esc_url($video_url); ?>" data-thumb-src="<?php echo esc_url($thumb_url); ?>"></a>
                    <?php endif ?>
                </div>
                <div class="post-info">
                    <span><?php the_time($newsstand_dateformat); ?></span>
                    <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
                </div>
                <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                <p><?php echo newsstand_excerpt(90); ?></p>
            </div><!-- end of single -->

        <?php endwhile; ?>
    <?php endif ?>
</div>