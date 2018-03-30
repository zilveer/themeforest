<?php get_header(); ?>

    <!--Main begin-->
<div id="main" class="round_8 clearfix row">
<?php if (have_posts()) while (have_posts()) :
    the_post(); ?>

    <?php
    $image1 = get_post_meta(get_the_ID(), 'pkb_upload_image', true);
    $image2 = get_post_meta(get_the_ID(), 'pkb_upload_image2', true);
    $image3 = get_post_meta(get_the_ID(), 'pkb_upload_image3', true);
    $image4 = get_post_meta(get_the_ID(), 'pkb_upload_image4', true);
    $image5 = get_post_meta(get_the_ID(), 'pkb_upload_image5', true);
    $image6 = get_post_meta(get_the_ID(), 'pkb_upload_image6', true);
    $image7 = get_post_meta(get_the_ID(), 'pkb_upload_image7', true);
    $image8 = get_post_meta(get_the_ID(), 'pkb_upload_image8', true);
    ?>

    <!-- Content begin-->
    <div id="content" class="large-12 columns">

    <!--Breadcrumbs begin-->
    <?php if (function_exists('pkb_breadcrumbs')) {
    pkb_breadcrumbs();
} ?>
    <!--Breadcrumbs end-->

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <h1 class="replace"><?php the_title(); ?></h1>
        </header>
        <!-- .entry-header -->

        <div class="entry-content row">

            <div class="gallery-image columns large-9">
                <?php
                $video_url = get_post_meta(get_the_ID(), 'pkb_video_url', true);
                $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'gallery-single-image', false, '');
                if ($video_url != '') : ?>
                    <div class="flex-video"><?php pkb_video(get_the_ID()); ?></div>
                <?php else: ?>
                    <div id="image_slideshow" class="flexslider clearfix">
                        <ul class="slides">

                            <?php if ($thumb_url != '') : ?>
                                <li><img src="<?php echo $thumb_url[0]; ?>" alt="<?php the_title(); ?>"></li>
                            <?php endif; ?>

                            <?php if ($image1 != '') : ?>
                                <li><img src="<?php echo $image1; ?>" alt="image 1"></li>
                            <?php endif; ?>

                            <?php if ($image2 != '') : ?>
                                <li><img src="<?php echo $image2; ?>" alt="image 2"></li>
                            <?php endif; ?>

                            <?php if ($image3 != '') : ?>
                                <li><img src="<?php echo $image3; ?>" alt="image 3"></li>
                            <?php endif; ?>

                            <?php if ($image4 != '') : ?>
                                <li><img src="<?php echo $image4; ?>" alt="image 4"></li>
                            <?php endif; ?>

                            <?php if ($image5 != '') : ?>
                                <li><img src="<?php echo $image5; ?>" alt="image 5"></li>
                            <?php endif; ?>

                            <?php if ($image6 != '') : ?>
                                <li><img src="<?php echo $image6; ?>" alt="image 6"></li>
                            <?php endif; ?>

							<?php if ($image7 != '') : ?>
								<li><img src="<?php echo $image7; ?>" alt="image 7"></li>
							<?php endif; ?>

							<?php if ($image8 != '') : ?>
								<li><img src="<?php echo $image8; ?>" alt="image 8"></li>
							<?php endif; ?>
                        </ul>

                    </div>

                <?php endif; ?>

            </div>
            <!-- end gallery image -->

            <div class="gallery-content columns large-3">
                <?php the_content(); ?>
                <hr/>
                <div class="entry-meta">
                    <?php echo get_the_term_list($post->ID, 'media-type', '<ul class="side-nav gallery-cat"><li>', '</li><li>', '</li></ul>'); ?>
                    <?php if (function_exists('pkb_addthis')) pkb_addthis(); ?>
                </div>
                <!-- .entry-meta -->
            </div>
        </div>
        <!-- .entry-content -->

    </article><!-- #post-<?php the_ID(); ?> -->

<?php endwhile; // end of the loop. ?>
    </div>
    <!-- Content end-->

<?php get_footer(); ?>