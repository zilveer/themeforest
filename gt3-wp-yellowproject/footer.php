<div class="pre_footer">
    <div class="container">
        <aside id="footer_bar" class="row">
            <?php get_sidebar('footer'); ?>
        </aside>
    </div>
</div>

<footer>
    <div class="footer_wrapper container">
        <a href="<?php echo get_site_url(); ?>" class="logo">
            <img src="<?php the_theme_option("logo_footer"); ?>" alt="" class="logo_def" width="<?php the_theme_option("footer_logo_standart_width"); ?>" height="<?php the_theme_option("footer_logo_standart_height"); ?>">
            <img src="<?php the_theme_option("footer_logo_retina"); ?>" alt="" class="logo_retina" width="<?php the_theme_option("footer_logo_standart_width"); ?>" height="<?php the_theme_option("footer_logo_standart_height"); ?>">
        </a>
        <div class="copyright">
            <?php
            if (get_theme_option("translator_status") == "enable") {
                the_theme_option("copyright");
            } else {
                _e('&copy; 2020 Companyname Wordpress Business Theme. All Rights Reserved.','theme_localization');
            }
            ?>
        </div>
        <nav>
            <?php wp_nav_menu(array('theme_location' => 'footer_menu', 'menu_class' => 'menu', 'depth' => '1')); ?>
        </nav>
        <div class="footer_tools">
            <ul class="footer_socials main_socials">
                <?php echo socsm("social_facebook", $class = "ico_social-facebook", $title = "Facebook"); ?>
                <?php echo socsm("social_vimeo", $class = "ico_social-vimeo", $title = "Vimeo"); ?>
                <?php echo socsm("social_tumblr", $class = "ico_social-tumbler", $title = "Tumblr"); ?>
                <?php echo socsm("social_twitter", $class = "ico_social-twitter", $title = "Twitter"); ?>
                <?php echo socsm("social_delicious", $class = "ico_social-delicious", $title = "Delicious"); ?>
                <?php echo socsm("social_flickr", $class = "ico_social-flickr", $title = "Flickr"); ?>
                <?php echo socsm("social_pinterest", $class = "ico_social-pinterest", $title = "Pinterest"); ?>
                <?php echo socsm("social_dribbble", $class = "ico_social-dribbble", $title = "Dribbble"); ?>
                <?php echo socsm("social_linked_in", $class = "ico_social-linked_in", $title = "LinkedIn"); ?>
                <?php echo socsm("social_youtube", $class = "ico_social-youtube", $title = "YouTube"); ?>
                <?php echo socsm("social_gplus", $class = "ico_social-gplus", $title = "Google Plus"); ?>
                <?php echo socsm("social_instagram", $class = "ico_social-instagram", $title = "Instagram"); ?>
            </ul>
            <div class="footer_search">
                <?php get_search_form(); ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>