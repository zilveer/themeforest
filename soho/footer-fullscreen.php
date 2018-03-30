    <footer class="main_footer">
	    <div class="copyright"><?php gt3_the_theme_option("copyright"); ?></div>
		<div class="phone phone_ipad"><?php gt3_the_theme_option("phone"); ?></div>
        <div class="socials">
			<?php echo gt3_show_social_icons(array(
                array(
                    "uniqid" => "social_facebook",
                    "class" => "ico_social_facebook",
                    "title" => "Facebook",
                    "target" => "_blank",
                ),					
                array(
                    "uniqid" => "social_pinterest",
                    "class" => "ico_social_pinterest",
                    "title" => "Pinterest",
                    "target" => "_blank",
                ),
                array(
                    "uniqid" => "social_twitter",
                    "class" => "ico_social_twitter",
                    "title" => "Twitter",
                    "target" => "_blank",
                ),
                array(
                    "uniqid" => "social_instagram",
                    "class" => "ico_social_instagram",
                    "title" => "Instagram",
                    "target" => "_blank",
                ),
                array(
                    "uniqid" => "social_tumblr",
                    "class" => "ico_social_tumblr",
                    "title" => "Tumblr",
                    "target" => "_blank",
                ),
                array(
                    "uniqid" => "social_flickr",
                    "class" => "ico_social_flickr",
                    "title" => "Flickr",
                    "target" => "_blank",
                ),
                array(
                    "uniqid" => "social_youtube",
                    "class" => "ico_social_youtube",
                    "title" => "Youtube",
                    "target" => "_blank",
                ),
                array(
                    "uniqid" => "social_dribbble",
                    "class" => "ico_social_dribbble",
                    "title" => "Dribbble",
                    "target" => "_blank",
                ),
                array(
                    "uniqid" => "social_gplus",
                    "class" => "ico_social_gplus",
                    "title" => "Google+",
                    "target" => "_blank",
                ),
                array(
                    "uniqid" => "social_vimeo",
                    "class" => "ico_social_vimeo",
                    "title" => "Vimeo",
                    "target" => "_blank",
                ),
                array(
                    "uniqid" => "social_delicious",
                    "class" => "ico_social_delicious",
                    "title" => "Delicious",
                    "target" => "_blank",
                ),
                array(
                    "uniqid" => "social_linked",
                    "class" => "ico_social_linked",
                    "title" => "Linked In",
                    "target" => "_blank",
                )
            ));
            ?>
        </div>
        <div class="phone"><?php gt3_the_theme_option("phone"); ?></div>        
        <div class="clear"></div>
    </footer>
	<?php
		gt3_the_pb_custom_bg_and_color(gt3_get_theme_pagebuilder(@get_the_ID()));
		gt3_the_theme_option("code_before_body"); wp_footer();
    ?>    
</body>
</html>