<!-- Footer -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="footer-content">
                        <i id="scroll-top" class="awe-icon fa fa-angle-double-up"></i>
                        <?php display_social_footer() ?>
                    <?php if(apply_filters('awe_remove_copyright', true)) : ?>
                        <p class="site-info">
                            <?php display_copyright(); ?>
                        </p>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>

<?php wp_footer();?>

</body>
</html>
