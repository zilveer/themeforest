<?php


$fb = layers_get_theme_mod("social-fb");
$tw = layers_get_theme_mod("social-tw");
$yt = layers_get_theme_mod("social-yt");

$pinterest = layers_get_theme_mod("social-pinterest");
$glplus = layers_get_theme_mod("social-glplus");
$linkin = layers_get_theme_mod("social-linkin");
$instagram = layers_get_theme_mod("social-instagram");
$tumblr = layers_get_theme_mod("social-tumblr");
$flickr = layers_get_theme_mod("social-flickr");
$reddit = layers_get_theme_mod("social-reddit");
?>

    <ul>
        <?php if (layers_get_theme_mod('header-show-contact')): ?>
            <li><i class="fa fa-phone"></i></li>
            <li class="phonedigits"><?php echo apply_filters('tl/wrap_nth_word', esc_html($phone)); ?></li>
        <?php endif; ?>
        <?php if (layers_get_theme_mod('header-show-socialicons')): ?>
            <?php if ($tw) : ?>
                <li class="hidden-sm hidden-xs"><a target="_blank" href="<?php echo esc_url($tw); ?>" title="Tweeter"><i class="icon-ti-twitter-alt"></i></a></li>
            <?php endif; ?>
            <?php if ($fb) : ?>
                <li class="hidden-sm hidden-xs"><a target="_blank" href="<?php echo esc_url($fb); ?>" title="Facebook"><i class="icon-ti-facebook"></i></a></li>
            <?php endif; ?>
            <?php if ($yt) : ?>
                <li class="hidden-sm hidden-xs"><a target="_blank" href="<?php echo esc_url($yt); ?>" title="Youtube"><i class="icon-ti-youtube"></i></a></li>
            <?php endif; ?>
            <?php if ($pinterest) : ?>
                <li class="hidden-sm hidden-xs"><a target="_blank" href="<?php echo esc_url($pinterest); ?>" title="Pinterest"><i class="icon-ti-pinterest-alt"></i></a></li>
            <?php endif; ?>
            <?php if ($glplus) : ?>
                <li class="hidden-sm hidden-xs"><a target="_blank" href="<?php echo esc_url($glplus); ?>" title="Google Plus"><i class="icon-ti-google"></i></a></li>
            <?php endif; ?>
            <?php if ($linkin) : ?>
                <li class="hidden-sm hidden-xs"><a target="_blank" href="<?php echo esc_url($linkin); ?>" title="LinkedIn"><i class="icon-ti-linkedin"></i></a></li>
            <?php endif; ?>
            <?php if ($instagram) : ?>
                <li class="hidden-sm hidden-xs"><a target="_blank" href="<?php echo esc_url($instagram); ?>" title="Instagram"><i class="icon-ti-instagram"></i></a></li>
            <?php endif; ?>
            <?php if ($tumblr) : ?>
                <li class="hidden-sm hidden-xs"><a target="_blank" href="<?php echo esc_url($tumblr); ?>" title="Tumblr"><i class="icon-ti-tumblr-alt"></i></a></li>
            <?php endif; ?>
            <?php if ($flickr) : ?>
                <li class="hidden-sm hidden-xs"><a target="_blank" href="<?php echo esc_url($flickr); ?>" title="Flickr"><i class="icon-ti-flickr-alt"></i></a></li>
            <?php endif; ?>
            <?php if ($reddit) : ?>
                <li class="hidden-sm hidden-xs"><a target="_blank" href="<?php echo esc_url($reddit); ?>" title="Reddit"><i class="icon-ti-reddit"></i></a></li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
    <?php if (layers_get_theme_mod('header-show-slogans')): ?>
    <div class="contact-slogan hidden-xs">
        <span><?php echo esc_html(Handyman\Front\tl_copt('contact-txt1')); ?></span> - <?php echo esc_html(Handyman\Front\tl_copt('contact-txt2')); ?>
    </div>
    <?php endif; ?>