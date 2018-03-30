<?php
$show_social = get_option('theme_show_social_menu');

if($show_social == 'true')
{
    $sl_facebook = get_option('theme_facebook_link');
    $sl_twitter = get_option('theme_twitter_link');
    $sl_linkedin = get_option('theme_linkedin_link');
    $sl_google = get_option('theme_google_link');
    $sl_instagram = get_option('theme_instagram_link');
    $sl_skype = get_option('theme_skype_username');
    $sl_youtube = get_option('theme_youtube_link');
    $sl_pinterest = get_option('theme_pinterest_link');
    $sl_rss = get_option('theme_rss_link');
    ?>
    <ul class="social_networks clearfix">
            <?php
            if(!empty( $sl_facebook )){
                ?>
                <li class="facebook">
                    <a target="_blank" href="<?php echo $sl_facebook; ?>"><i class="fa fa-facebook fa-lg"></i></a>
                </li>
                <?php
            }

            if(!empty( $sl_twitter )){
                ?>
                <li class="twitter">
                    <a target="_blank" href="<?php echo $sl_twitter; ?>"><i class="fa fa-twitter fa-lg"></i></a>
                </li>
                <?php
            }

            if(!empty( $sl_linkedin )){
                ?>
                <li class="linkedin">
                    <a target="_blank" href="<?php echo $sl_linkedin; ?>"><i class="fa fa-linkedin fa-lg"></i></a>
                </li>
                <?php
            }

            if(!empty( $sl_google )){
                ?>
                <li class="gplus">
                    <a target="_blank" href="<?php echo $sl_google; ?>"><i class="fa fa-google-plus fa-lg"></i></a>
                </li>
                <?php
            }

            if(!empty( $sl_instagram )){
                ?>
                <li class="instagram">
                    <a target="_blank" href="<?php echo $sl_instagram; ?>"> <i class="fa fa-instagram fa-lg"></i></a>
                </li>
                <?php
            }

            if(!empty( $sl_youtube )){
                ?>
                <li class="youtube">
                    <a target="_blank" href="<?php echo $sl_youtube; ?>"> <i class="fa fa-youtube-square fa-lg"></i></a>
                </li>
                <?php
            }

            if(!empty( $sl_skype )){
                ?>
                <li class="skype">
                    <a target="_blank" href="skype:<?php echo $sl_skype; ?>?add"> <i class="fa fa-skype fa-lg"></i></a>
                </li>
                <?php
            }

            if(!empty( $sl_pinterest )){
                ?>
                <li class="pinterest">
                    <a target="_blank" href="<?php echo $sl_pinterest; ?>"> <i class="fa fa-pinterest fa-lg"></i></a>
                </li>
                <?php
            }

            if(!empty( $sl_rss )){
                ?>
                <li class="rss">
                    <a target="_blank" href="<?php echo $sl_rss; ?>"> <i class="fa fa-rss fa-lg"></i></a>
                </li>
                <?php
            }
            ?>
    </ul>
    <?php
}
?>