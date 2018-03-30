<?php
$logo_file = get_theme_mod('logo_file');
$logo_width = get_theme_mod('logo_width');
$logo_height = get_theme_mod('logo_height');
$header_layout = get_theme_mod('header_layout') ? get_theme_mod('header_layout') : 1;
?>
<p itemtype="http://schema.org/Organization" itemscope="itemscope" class="title"><a href="<?php echo home_url(); ?>/" itemprop="url">
<?php if (!$logo_file) : ?>
    <?php bloginfo('name'); ?>   
<?php else : ?>
    <img src="<?php echo get_theme_mod( 'logo_file' ); ?>" 
    <?php if ($logo_width != '') : ?> width="<?php echo esc_attr(get_theme_mod( 'logo_width' ));?>"<?php endif; ?> 
    <?php if ($logo_height != '' ) : ?> height="<?php echo esc_attr(get_theme_mod( 'logo_height' ));?>"<?php endif; ?>
    alt="<?php bloginfo( 'name' ); ?>" itemprop="logo" />
<?php endif; ?>
</a> 
<?php if ($header_layout != 15) : ?>
	<span><?php bloginfo('description'); ?></span>
<?php endif; ?>
</p>