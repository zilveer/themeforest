<div class="social-icon clearfix">
    <ul class="doc-social-nav">
        <?php
        global $post;

        $twitter_url = get_post_meta($post->ID, 'twitter_link', true);
        if (!empty($twitter_url)) {
            echo '<li class ="twitter-icon" ><a target="_blank" href="' . $twitter_url . '"><i class="fa fa-twitter"></i></a></li>';
        }

        $facebook_url = get_post_meta($post->ID, 'facebook_link', true);
        if (!empty($facebook_url)) {
            echo '<li class ="facebook-icon" ><a target="_blank" href="' . $facebook_url . '"><i class="fa fa-facebook"></i></a></li>';
        }

        $linkedin_url = get_post_meta($post->ID, 'linkedin_link', true);
        if (!empty($linkedin_url)) {
            echo '<li class ="linkedin-icon" ><a target="_blank" href="' . $linkedin_url . '"><i class="fa fa-linkedin"></i></a></li>';
        }

        $skype_username = get_post_meta($post->ID, 'skype_username', true);
        if (!empty($skype_username)) {
            echo '<li class ="skype-icon" ><a target="_blank" href="skype:' . $skype_username . '?add"><i class="fa fa-skype"></i></a></li>';
        }
        ?>
    </ul>
</div>