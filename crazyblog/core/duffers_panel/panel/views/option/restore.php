<?php
$setting = crazyblog_opt();
?>

<div class="vp-field">
    <div class="label">
        <label>
            <?php esc_html_e('Import Dummy Data', 'crazyblog') ?>
        </label>
        <div class="description">
            <p><?php esc_html_e('Demo settings will import "dummy data XML", "theme options", "widgets", "revolution slider" and "visual composer templates"', 'crazyblog') ?></p>
        </div>
    </div>
    <div class="field">
        <div class="input">
            <div id="one_click" class="import_buttons">
                <a id="install_button" class="sh_demo_settings_import vp-button button button-primary" href="javascript:void(0);" >
                    <?php esc_html_e('Import Demo Settings', 'crazyblog') ?>
                </a>
                <br>
                <select id="demos" class="custom-select">
                    <option value="cars"><?php esc_html_e('Cars', 'crazyblog');?></option>
                    <option value="cars1"><?php esc_html_e('Cars Blog', 'crazyblog');?></option>
                    <option value="crazyblog"><?php esc_html_e('Crazyblog', 'crazyblog');?></option>
                    <option value="creative"><?php esc_html_e('Creative', 'crazyblog');?></option>
                    <option value="fashion"><?php esc_html_e('Fashion', 'crazyblog');?></option>
                    <option value="magazine"><?php esc_html_e('Magazine', 'crazyblog');?></option>
                    <option value="personal-store"><?php esc_html_e('Personal Store', 'crazyblog');?></option>
                    <option value="recipes"><?php esc_html_e('Recipes', 'crazyblog');?></option>
                    <option value="travel"><?php esc_html_e('Travel', 'crazyblog');?></option>
                </select>
                <br>
                <p><?php esc_html_e('** Please make sure you have already make a backup data of your current settings. Once you click this button, your current settings will be gone', 'crazyblog'); ?></p>

            </div>
        </div>
    </div>
    <div class="overlay"></div>
    <div class="importer_result">
        <div class="importer_heading">
            <span>X</span>
            <h1><?php esc_html_e('Import Results', 'crazyblog') ?></h1>
        </div>
        <div class="result"></div>
    </div>

</div>


<?php 
    $custom_script = 'jQuery(document).ready(function ($) {
        $("#install_button").on("click", function () {
            var check = confirm("Are you sure installing demo data?  Please be aware that the demo data comprises a significant amount of content, and we suggest this demo data be installed in a local host ( ie home or work computer using wamp or mamp ) not in the online site.");
            if (check == false) {
                return false;
            }
            if (jQuery(this).hasClass("is_disabled")) {
                return false;
            }
            jQuery("#install_button").addClass("is_disabled");
            var loading = $("<span class=\"wobblebar\">Loading&#8230;</span>").insertAfter("#install_button");
            var data = "data=" + $("select#demos").val() + "&action=theme-install-demo-data";
            jQuery.ajax({
                type: "POST",
                url: ajaxurl,
                data: data,
                success: function (response) {
                    jQuery(".importer_result .result").html("").hide();
                    var height = jQuery("html").height();
                    jQuery(".overlay").css({
                        "background": "rgba(0,0,0,0.65)",
                        "position": "fixed",
                        "top": "0",
                        "left": "0",
                        "width": "100%",
                        "height": "100%",
                        "z-index": "9999999"
                    });
                    jQuery(".overlay").fadeIn(500, "swing");
                    jQuery(".importer_result").fadeIn(500, "swing");
                    jQuery(".importer_result .result").append(response);
                    jQuery(".importer_result .result").fadeIn(500, "swing");
                    loading.remove();
                    var done = jQuery("<span class=\"theme-install-done\">Done!</span>").insertAfter(".left_side");
                    setTimeout(function () {
                        jQuery(done).fadeOut(500, "swing");
                    }, 5000);
                },
            });
            return false;
        });

        jQuery(".importer_result span").click(function () {
            jQuery(".result").fadeOut(500, "swing");
            jQuery(".importer_result").fadeOut(500, "swing");
            jQuery(".overlay").fadeOut(500, "swing");
            jQuery("#install_button").removeClass("is_disabled");
        });
    });';
     wp_add_inline_script('vp-option', $custom_script);
?>


