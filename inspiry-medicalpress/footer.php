<footer id="main-footer" class="site-footer clearfix">
    <div class="container">
        <div class="row">

            <div class=" <?php bc('3', '3', '6', ''); ?> ">
                <?php dynamic_sidebar('footer-1st-column'); ?>
            </div>

            <div class=" <?php bc('3', '3', '6', ''); ?> ">
                <?php dynamic_sidebar('footer-2nd-column'); ?>
            </div>

            <div class="clearfix visible-sm"></div>

            <div class=" <?php bc('3', '3', '6', ''); ?> ">
                <?php dynamic_sidebar('footer-3rd-column'); ?>
            </div>

            <div class=" <?php bc('3', '3', '6', ''); ?> ">
                <?php dynamic_sidebar('footer-4th-column'); ?>
            </div>

            <div class="<?php bc_all('12'); ?> ">
                <div class="footer-bottom animated fadeInDown clearfix">
                    <div class="row">
                        <?php
                        global $theme_options;
                        if (!empty($theme_options['footer_copyright'])) {
                            ?>
                            <div class="<?php bc('7','7','7','12'); ?>">
                                <p><?php echo $theme_options['footer_copyright'] ?></p>
                            </div>
                        <?php
                        }

                        if (!empty($theme_options['display_footer_social_icons'])) {
                            ?>
                            <div class="<?php bc('5','5','5','12'); ?> clearfix">
                                <ul class="footer-social-nav">
                                    <?php
                                    if (!empty($theme_options['twitter_url'])) {
                                        echo '<li><a target="_blank" href="' . $theme_options['twitter_url'] . '"><i class="fa fa-twitter"></i></a></li>';
                                    }

                                    if (!empty($theme_options['facebook_url'])) {
                                        echo '<li><a target="_blank" href="' . $theme_options['facebook_url'] . '"><i class="fa fa-facebook"></i></a></li>';
                                    }

                                    if (!empty($theme_options['google_url'])) {
                                        echo '<li><a target="_blank" href="' . $theme_options['google_url'] . '"><i class="fa fa-google-plus"></i></a></li>';
                                    }

                                    if (!empty($theme_options['linkedin_url'])) {
                                        echo '<li><a target="_blank" href="' . $theme_options['linkedin_url'] . '"><i class="fa fa-linkedin"></i></a></li>';
                                    }

                                    if (!empty($theme_options['instagram_url'])) {
                                        echo '<li><a target="_blank" href="' . $theme_options['instagram_url'] . '"><i class="fa fa-instagram"></i></a></li>';
                                    }

                                    if (!empty($theme_options['youtube_url'])) {
                                        echo '<li><a target="_blank" href="' . $theme_options['youtube_url'] . '"><i class="fa fa-youtube"></i></a></li>';
                                    }

                                    if (!empty($theme_options['skype_username'])) {
                                        echo '<li><a target="_blank" href="skype:' . $theme_options['skype_username'] . '?add"><i class="fa fa-skype"></i></a></li>';
                                    }

                                    if (!empty($theme_options['rss_url'])) {
                                        echo '<li><a target="_blank" href="' . $theme_options['rss_url'] . '"><i class="fa fa-rss"></i></a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="#top" id="scroll-top"></a>
<?php wp_footer(); ?>
</body>
</html>