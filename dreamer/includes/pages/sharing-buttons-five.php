<div class="page-container pattern-1" id="about-us">
    <div class="row">
    
        <div class="twelve columns sharing-section">
            <h3 class="sharing-buttons"><?php global $smof_data; $dreamer_sharing_buttons_title = $smof_data['sharing_buttons_title']; echo $dreamer_sharing_buttons_title ?></h3>
        </div>
        
        <div class="twelve columns sharing-icons">
            <div class="facebook-share-button">
                <div class="facebook-share-button-over">Like It Now</div>
                <div class="facebook-share-button-inner">
                    <iframe src="//www.facebook.com/plugins/like.php?href=<?php global $smof_data; $dreamer_facebook_link_two = $smof_data['facebook_link_two']; echo $dreamer_facebook_link_two ?>&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:ntwo; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>
                </div>
            </div>
            <div class="twitter-tweet-button">
                <div class="twitter-tweet-button-over">Tweet It</div>
                <div class="twitter-tweet-button-inner">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php global $smof_data; $dreamer_twitter_link_two = $smof_data['twitter_link_two']; echo $dreamer_twitter_link_two ?>" data-via="<?php global $smof_data; $dreamer_twitter_user_two = $smof_data['twitter_user_two']; echo $dreamer_twitter_user_two ?>" data-related="<?php global $smof_data; $dreamer_twitter_user_two = $smof_data['twitter_user_two']; echo $dreamer_twitter_user_two ?>">Tweet</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>
            </div>
            <div class="linkedin-share-button">
                <div class="linkedin-share-button-over">Share It</div>
                <div class="linkedin-share-button-inner">
                    <script src="http://platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="<?php global $smof_data; $dreamer_linkedin_link_five = $smof_data['linkedin_link_five']; echo $dreamer_linkedin_link_two ?>" data-counter="right"></script>
                </div>
            </div>
        </div>
    </div>
</div>
<?php wp_reset_query(); ?>