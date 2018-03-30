<?php get_header() ?>

<?php
wp_reset_postdata();

global $porto_settings, $porto_layou;

$options = array();
$options['themeConfig'] = true;
$options['lg'] = $porto_settings['member-related-cols'];
if ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar')
    $options['lg']--;
if ($options['lg'] < 2)
    $options['lg'] = 2;
$options['md'] = $porto_settings['member-related-cols'] - 1;
if ($options['md'] < 2)
    $options['md'] = 2;
$options['sm'] = $porto_settings['member-related-cols'] - 2;
if ($options['sm'] < 1)
    $options['sm'] = 1;
$options = json_encode($options);
?>

    <div id="content" role="main" class="<?php if ($porto_layout === 'wide-left-sidebar' || $porto_layout === 'wide-right-sidebar') echo 'm-t-lg m-b-xl m-r-md m-l-md' ?>">

        <?php if (have_posts()) : the_post(); ?>

            <?php get_template_part('content', 'member'); ?>

            <?php if ($porto_layout === 'widewidth') echo '<div class="container m-b-xl">' ?>

            <?php get_template_part('content', 'member-portfolios'); ?>

            <?php if (class_exists('WooCommerce')) get_template_part('content', 'member-products'); ?>

            <?php get_template_part('content', 'member-posts'); ?>

            <?php
            if ($porto_settings['member-related']) :
                $related_members = porto_get_related_members($post->ID);
                if ($related_members->have_posts()) : ?>
                    <div class="related-members">
                        <h4 class="sub-title"><?php echo __('Related <strong>Members</strong>', 'porto'); ?></h4>
                        <div class="row">
                            <div class="member-carousel porto-carousel owl-carousel show-nav-title" data-plugin-options="<?php echo esc_attr($options) ?>">
                                <?php
                                while ($related_members->have_posts()) {
                                    $related_members->the_post();

                                    get_template_part('content', 'member-item');
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endif;
            endif;

            if ($porto_layout === 'widewidth') echo '</div>';

        endif; ?>

    </div>

<?php get_footer() ?>