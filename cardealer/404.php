<?php if (!defined('ABSPATH')) exit(); ?>
<?php get_header(); ?>

<!-- - - - - - - - - - - - 404  - - - - - - - - - - - - - - -->	

<div class="error-404">

    <img src="<?php echo esc_url( TMM_THEME_URI . '/images/mac.png' ) ?>" alt="404" />

    <div class="e404">

        <h1>404</h1>

        <div class="title-error"><?php _e('Page Not Found', 'cardealer'); ?></div>

        <p><?php _e('Sorry, the page you requested may have been moved or deleted', 'cardealer'); ?></p>
        <a href="<?php echo esc_url( home_url('/') ) ?>" class="button orange"><?php _e('Get me back to homepage!', 'cardealer'); ?></a>

    </div><!--/ .e404-->

</div><!--/ .error404-->

<!-- - - - - - - - - - - end 404  - - - - - - - - - - - - - -->

<?php get_footer(); ?>
