<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/1/2015
 * Time: 5:51 PM
 */
$g5plus_options = &G5Plus_Global::get_options();
$loading_animation = isset($g5plus_options['loading_animation']) ? $g5plus_options['loading_animation'] : '';

$logo_loading = isset($g5plus_options['loading_logo']) ? $g5plus_options['loading_logo'] : '';
if ($loading_animation == 'none' || empty($loading_animation)) {
    return;
}
?>
<div class="site-loading">
    <div class="block-center">
        <div class="block-center-inner">
            <?php if (is_array($logo_loading) && !empty($logo_loading) && isset($logo_loading['url']) && !empty($logo_loading['url'])) : ?>
                <img class="logo-loading" alt="<?php esc_html_e('Logo Loading','g5plus-academia') ?>" src="<?php echo esc_url($logo_loading['url']) ?>" width="<?php echo esc_attr($logo_loading['width']); ?>" height="<?php echo esc_attr($logo_loading['height']); ?>" />
            <?php endif; ?>

                <?php if ($loading_animation == 'cube') : ?>
                    <div class="sk-rotating-plane"></div>
                <?php endif; ?>

                <?php if ($loading_animation == 'double-bounce') : ?>
                    <div class="sk-double-bounce">
                        <div class="sk-child sk-double-bounce1"></div>
                        <div class="sk-child sk-double-bounce2"></div>
                    </div>
                <?php endif; ?>

                <?php if ($loading_animation == 'wave') : ?>
                    <div class="sk-wave">
                        <div class="sk-rect sk-rect1"></div>
                        <div class="sk-rect sk-rect2"></div>
                        <div class="sk-rect sk-rect3"></div>
                        <div class="sk-rect sk-rect4"></div>
                        <div class="sk-rect sk-rect5"></div>
                    </div>
                <?php endif; ?>

                <?php if ($loading_animation == 'pulse') : ?>
                    <div class="sk-spinner sk-spinner-pulse"></div>
                <?php endif; ?>

                <?php if ($loading_animation == 'chasing-dots') : ?>
                    <div class="sk-chasing-dots">
                        <div class="sk-child sk-dot1"></div>
                        <div class="sk-child sk-dot2"></div>
                    </div>
                <?php endif; ?>

                <?php if ($loading_animation == 'three-bounce') : ?>
                    <div class="sk-three-bounce">
                        <div class="sk-child sk-bounce1"></div>
                        <div class="sk-child sk-bounce2"></div>
                        <div class="sk-child sk-bounce3"></div>
                    </div>
                <?php endif; ?>

                <?php if ($loading_animation == 'circle') : ?>
                    <div class="sk-circle">
                        <div class="sk-circle1 sk-child"></div>
                        <div class="sk-circle2 sk-child"></div>
                        <div class="sk-circle3 sk-child"></div>
                        <div class="sk-circle4 sk-child"></div>
                        <div class="sk-circle5 sk-child"></div>
                        <div class="sk-circle6 sk-child"></div>
                        <div class="sk-circle7 sk-child"></div>
                        <div class="sk-circle8 sk-child"></div>
                        <div class="sk-circle9 sk-child"></div>
                        <div class="sk-circle10 sk-child"></div>
                        <div class="sk-circle11 sk-child"></div>
                        <div class="sk-circle12 sk-child"></div>
                    </div>
                <?php endif; ?>

                <?php if ($loading_animation == 'fading-circle') : ?>
                    <div class="sk-fading-circle">
                        <div class="sk-circle1 sk-circle"></div>
                        <div class="sk-circle2 sk-circle"></div>
                        <div class="sk-circle3 sk-circle"></div>
                        <div class="sk-circle4 sk-circle"></div>
                        <div class="sk-circle5 sk-circle"></div>
                        <div class="sk-circle6 sk-circle"></div>
                        <div class="sk-circle7 sk-circle"></div>
                        <div class="sk-circle8 sk-circle"></div>
                        <div class="sk-circle9 sk-circle"></div>
                        <div class="sk-circle10 sk-circle"></div>
                        <div class="sk-circle11 sk-circle"></div>
                        <div class="sk-circle12 sk-circle"></div>
                    </div>
                <?php endif; ?>

                <?php if ($loading_animation == 'folding-cube') : ?>
                    <div class="sk-folding-cube">
                        <div class="sk-cube1 sk-cube"></div>
                        <div class="sk-cube2 sk-cube"></div>
                        <div class="sk-cube4 sk-cube"></div>
                        <div class="sk-cube3 sk-cube"></div>
                    </div>
                <?php endif; ?>
        </div>
    </div>
</div>


