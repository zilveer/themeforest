<?php
    $particle_enabled = get_theme_mod('enable_particle_background', plsh_gs('enable_particle_background'));
    if($particle_enabled === true)
    {
        echo '<div id="particles"></div>';
    }
?>

<?php
    if(
        (is_single() && get_post_type() == 'post')
        &&
        plsh_gs('show_post_read_progress') == 'on')
    {
        ?> <div class="read-progress"><span style="width: 40%;"></span></div> <?php
    }    
?>
<?php get_template_part('theme/templates/trending-news'); ?>

<!-- Header -->
<header class="container header">
    
    <?php if(plsh_gs('use_image_logo') == 'on') { ?>
        <div class="logo-image">
            <a href="<?php echo home_url('/'); ?>"><img src="<?php echo esc_url(plsh_gs('logo_image')); ?>" alt="<?php esc_attr(plsh_gs('logo_image_alt')); ?>"></a>
        </div>
    <?php } else { ?>
        <div class="logo-text">
            <h2><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h2>
            <p><?php bloginfo('description'); ?></p>
        </div>
    <?php } ?>
    
    <?php echo $banner = plsh_get_banner_by_location('header_ad'); ?>
</header>

<?php get_template_part('theme/templates/menu'); ?>