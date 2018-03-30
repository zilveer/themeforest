<?php get_header(); ?>

<?php get_template_part('page-parts/general-before-wrap'); ?>

<?php get_template_part( 'page-parts/page-title' ); ?>

<div class="main-content <?php echo Kleo::get_config('container_class'); ?>">

    <?php if ( have_posts() ) : ?>
        <ul class="kb-archive-listing">
        <?php while ( have_posts() ) : the_post(); ?>
            <li>
                <h2>
                    <i class="icon-newspaper"></i>
                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>
                </h2>
                <?php echo kleo_excerpt();?><br><br>
            </li>
        <?php endwhile; ?>
        </ul>
        <?php kleo_pagination( 'pagination pag-type-1' ); ?>

    <?php else: ?>
        <p><?php esc_html_e("No articles found.", "buddyapp"); ?></p>
    <?php endif; ?>

</div>

<?php get_template_part('page-parts/general-after-wrap'); ?>

<?php get_footer(); ?>