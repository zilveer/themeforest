<?php

get_header();

?>

<?php ishyoboy_get_lead(ish_get_the_ID()); ?>

<!-- Content part section -->
    <section class="part-content">
    <div class="row">
        <div class="<?php echo ishyoboy_get_content_class(); ?>">
            <?php
            // Breadcrumbs display
            ishyoboy_show_breadcrumbs();
            ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
            <?php comments_template('', true); ?>
            <?php endwhile; else: ?>
            <p><?php _e('Sorry, no pages matched your criteria.', 'ishyoboy'); ?></p>
            <?php endif; ?>

        </div>

        <?php
        // SIDEBAR
        get_sidebar();
        ?>

    </div>
</section>
<!-- Content part section END -->

<!-- #content  END -->
<?php  get_footer(); ?>