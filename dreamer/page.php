<?php get_header();  global $smof_data; ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <!-- Parallax One - Content -->
    <div class="parallax-six page-background">
        <style>
        .page-background {
            background:#000 url(<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); echo $url = $thumb['0']; ?>) 50% 0 no-repeat fixed;
            background-size: cover;
            margin-top:40px !important;
        }
        </style>
        <div class="quote6-pattern" id="parallax-six"></div>
        <div class="row">
            <div class="twelve columns parallax-container">
                <h1 class="parallax-title"><?php the_title(); ?></h1>
                <?php if (isset($smof_data['parallax_six_icon']) && !empty($smof_data['parallax_six_icon'])): ?>
                    <div class="parallax-divider">
                    <div class="parallax-divider-left"></div>
                    <img src="<?php echo $smof_data['parallax_six_icon']; ?>" alt="<?php the_title(); ?>">
                    <div class="parallax-divider-right"></div>
                    </div>
                <?php endif ?>
                <h2 class="parallax-subtitle"><?php bloginfo('name'); ?></h2>
            </div>
        </div>
    </div>

    <div style="padding-bottom: 20px;" class="page-container pattern-1" id="about-us">
        <div class="row page-content-new">
            <div style="margin-top: 60px;" class="twelve columns page-content">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div>
            <div class="twelve columns about mobile-three-one">
                <div class="about-us-text"><?php the_content(); ?></div>
            </div>
        </div>
        <?php if (comments_open()){ ?>
        <div class="row">
            <?php disqus_embed('dreameravathemes'); ?>
        </div>
        <?php } ?>
    </div>
    <?php endwhile; ?>
    <?php else : ?>
    <?php endif; ?>

	<?php wp_reset_query(); ?>

<?php get_footer(); ?>
