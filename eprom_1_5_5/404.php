<?php global $r_option; ?>

<?php get_header(); ?>

<section id="main-content" class="container clearfix">
    <!-- 404 content -->
    <section class="content content-404">
        <article>
            <div id="error-404">
                <span data-number="404">404</span>
            </div>
                <h1 class="large-heading text-center"><?php _e('Page not found.', SHORT_NAME)?></h1>
                <h2 class="light-heading text-center"><?php _e('Please check that there isn’t a typo in your URL.', SHORT_NAME)?></h2>
        </article>
    </section>
    <!-- /404 content -->
</section>
<?php get_footer(); ?>