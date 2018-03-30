
    <?php global $themeum_options; ?>
    <?php if(is_active_sidebar('bottom')){ ?>
    <section id="bottom">
        <div class="container">
            <div class="bottom">
                <div class="row">
                    <?php dynamic_sidebar('bottom'); ?>
                </div>
            </div>
        </div>
    </section><!--/#footer-->
    <?php } ?>

    <footer id="footer">
        <div class="container">
            <div class="footer">
                <div class="copyright">
                    <div class="row">
                        <?php if (isset($themeum_options['copyright-en']) && $themeum_options['copyright-en']){?>
                            <div class="col-sm-12">
                                <?php if(isset($themeum_options['copyright-text'])) echo $themeum_options['copyright-text']; ?>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->
</div>
<?php if(isset($themeum['before_body']))  echo $themeum['before_body']; ?>
<?php if(isset($themeum_options['google-analytics'])) echo $themeum_options['google-analytics'];?>

<?php wp_footer(); ?>
</body>
</html>