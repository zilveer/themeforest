<?php global $jaw_data; ?>
<?php $id = rand(0, 1000); ?>
<?php
if (jaw_template_get_var('animate', 'no-animate') == 'animate') {
    ?>
    <script>
        jQuery(document).ready(function() {
            jQuery('#icon-<?php echo $id; ?>').jawScroolAnimation({animation: "<?php echo jaw_template_get_var('animate_style', 'slide'); ?>",
                animationSpeed: <?php echo jaw_template_get_var('animate_duration', '800'); ?>,
                animationDirection: "<?php echo jaw_template_get_var('animate_direction', 'left'); ?>",
                animationEasing: "<?php echo jaw_template_get_var('animate_easing', 'swing'); ?>"});
        });
    </script>
    <?php
}

$socials = jaw_template_get_var('social');

$icons = array(
    'facebook' => 'icon-facebook4',
    'twitter' => 'icon-twitter3',
    'google' => 'icon-google-plus4',
    'youtube' => 'icon-youtube',
    'vimeo' => 'icon-vimeo3',
    'flickr' => 'icon-flickr4',
    'linkedin' => 'icon-linkedin',
    'pinterest' => 'icon-pinterest',
    'instagram' => 'icon-instagram',
    'rss' => 'icon-feed4'
);
?>
<span  id="icon-<?php echo $id; ?>" class="<?php echo jaw_template_get_var('animate', 'no-animate'); ?>">
    <span  class="el-social-icons"  style="     font-size: <?php echo jaw_template_get_var('size'); ?>px; color:<?php echo jaw_template_get_var('color', '#666666'); ?>">
        <?php foreach ((array) $socials as $name => $link) { ?>
                <a href="<?php echo $link; ?>" target="<?php echo jaw_template_get_var('target', '_self'); ?>" class="<?php echo $name; ?>" style="color: <?php echo jaw_template_get_var('color', '#666666'); ?>"><i class="<?php echo $icons[$name]; ?>"></i></a>
            <?php } ?>
    </span>
</span>