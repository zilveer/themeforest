<?php tfuse_header_content('content'); ?>
<?php tfuse_shortcode_content('after'); ?>

<footer>
    <div class="footer_top clearfix">
        <div class="container">
            <div class="row"><?php tfuse_footer(); ?></div>
        </div>
    </div>
    <div class="footer_bottom clearfix">
        <div class="container">
            <div class="copyright alignleft"><?php echo tfuse_options('custom_copyright'); ?></div>
            <div class="social alignright"><?php tfuse_footer_social(); ?></div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</div><!-- /.body_wrap -->
</body>
</html>