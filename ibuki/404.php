<?php get_header(); ?>
<?php
$options_ibuki = get_option('ibuki');

$error_image = null;
$error_class = null;
if( !empty($options_ibuki['error-custom-settings']) && $options_ibuki['error-custom-settings'] == 1) {
    $error_class = 'imagize';
    $error_image = ' style="background-image: url('.$options_ibuki['error-custom-image']['url'].'); background-size: cover; background-repeat: no-repeat; background-position: center center;"';
} else {
    $error_class = 'titlize';
    $error_image = '';
}
?>
<div id="content">
    <section id="error">        
        <div class="full-container <?php echo $error_class; ?>"<?php echo $error_image; ?>>
<?php if( !empty($options_ibuki['error-custom-settings']) && $options_ibuki['error-custom-settings'] == 1) { echo '<span class="overlay-bg"></span>'; } ?>
            <div class="box-overlay-error <?php echo $error_class; ?>">
                <div class="content-title centerize">
                    <h2 class="error-title"><?php echo __('404', AZ_THEME_NAME); ?></h2>
                    <span class="line"></span>
                    <h3 class="error-caption"><a href="<?php echo home_url(); ?>" class="back-home" title="<?php bloginfo('name'); ?>"><?php echo __('Back to Home', AZ_THEME_NAME); ?></a></h3>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>