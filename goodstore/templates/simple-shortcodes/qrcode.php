<?php global $jaw_data; ?>

<?php $class = rand(0, 1000); ?>
<div id="qrcode-<?php echo $class; ?>">
    <div class="qr-symbol">
    </div>
    <div class="clear"></div>

    <script>
        jQuery(document).ready(function(){

            jQuery('#qrcode-<?php echo $class; ?> .qr-symbol').qrcode({
                render: 'canvas',
                size: <?php echo jaw_template_get_var('size'); ?>,
                text: '<?php echo do_shortcode(jaw_template_get_var('qrcode')); ?>'
            });
        });
    </script>
</div>