<div class="qodef-popup-holder">
    <div class="qodef-popup-shader"></div>
    <div class="qodef-popup-table">
        <div class="qodef-popup-table-cell">
            <div class="qodef-popup-inner">
                <div class="qodef-popup-top">
                    <a class="qodef-popup-close" href="javascript:void(0)">
                        <span class="icon_close"></span>
                    </a>
                    <div class="qodef-popup-content-container">
                        <div class="qodef-popup-title">
                            <h3><?php echo esc_html($title); ?></h3>
                        </div>
                        <div class="qodef-popup-subtitle">
                            <?php echo esc_html($subtitle); ?>
                        </div>
                    </div>
                </div>
                <div class="qodef-popup-bottom">
                    <?php echo do_shortcode('[contact-form-7 id="' . $contact_form .'" html_class="'. $contact_form_style .'"]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
