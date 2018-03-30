<?php
require_once('form-inputs.php');
wp_nonce_field( 'theme-post-meta-form', THEME_NAME_SEO . '_post_nonce' );
?>

<div id="px-container" class="post-meta">
    <div class="portfolio_form">
        <div id="px-main">

            <!-- Custom Part background _ Color-->
            <div class="section">
                <div class="section-head">
                    <div class="section-tooltip"><?php _e('Change Custom Part background color here', TEXTDOMAIN); ?></div>
                    <div class="label"><?php _e('Custom Part Background Color', TEXTDOMAIN); ?></div>
                </div>

                <?php ColorInput('custom_part_color'); ?>
            </div>
            <!-- Custom Part background _ Color -->

            <!--Custom Part Padding -->
            <div class="section">
                <div class="section-head">
                    <div class="section-tooltip">
                        <?php _e('Choose to have or not to have right and left padding in custom part , disabling the padding  is useful for making full width slider.', TEXTDOMAIN); ?>
                    </div>
                    <div class="label">
                        <?php _e('Custom Part Padding', TEXTDOMAIN); ?>
                    </div>
                </div>

                <?php SwitchInput('custom_part_paddig', 'Disabled', 'Enabled'); ?>

            </div>
            <!--Custom Part Padding End -->
            <!--Custom Part label -->
            <div class="section">
                <div class="section-head">
                    <div class="section-tooltip">
                        <?php _e('Choose to show or not to have title in custom part', TEXTDOMAIN); ?>
                    </div>
                    <div class="label">
                        <?php _e('Custom Part Title', TEXTDOMAIN); ?>
                    </div>
                </div>

                <?php SwitchInput('custom_part_title_show', "Don't show", 'Show'); ?>

            </div>
            <!--Custom Part label End -->


        </div>
    </div>
</div>
