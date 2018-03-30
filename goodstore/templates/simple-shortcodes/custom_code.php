<?php global $jaw_data; ?>

<?php echo do_shortcode(jaw_template_get_var('html_code')); ?>
<?php if (jaw_template_get_var('js_code', '') != '') { ?>
    <script>
        jQuery(document).ready(function() {
            <?php echo do_shortcode(jaw_template_get_var('js_code')); ?>
        })
    </script>
<?php } ?>
