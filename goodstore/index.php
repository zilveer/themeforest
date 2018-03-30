<?php  get_header(); ?>

<!-- Row for main content area -->
<?php
$content_width = jwLayout::content_width();

echo '<div id="content" class="' . implode(' ', $content_width) . ' ' . jwLayout::content_layout() . '">';
?>


    <?php  get_template_part('loop'); ?>

    <?php /* Display navigation to next/previous pages when applicable */ ?>
    <?php //echo jwRender::pagination(jwOpt::get_option('blog_pagination', 'number')); ?>

</div><!-- End Content row -->



<?php get_sidebar(); ?>

<?php get_footer(); ?>
