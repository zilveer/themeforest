<?php
get_header();

get_template_part('template-parts/banner');
?>

<div class="clearfix">
    <div class="container">
        <div class="row">
            <div class="jumbotron text-center <?php bc('12', '12', '12', ''); ?>">
                <h1>4<span>0</span>4</h1>

                <div class="entry-content">
                    <p>
                        <?php _e('Look like something went wrong! The page you were looking for is not here', 'framework'); ?>
                    </p>

                    <p>
                        <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Visit Homepage','framework'); ?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
