<?php

class BFIWidgetTwitterModel extends BFIWidgetModel implements iBFIWidget {
    
    // DO NOT USE __construct SINCE IT WILL CAUSE ERRORS
    function BFIWidgetTwitterModel() {
        $this->label = 'Twitter';
        $this->description = 'A list of latest Tweets';
        $this->args = array(
            'userid' => '',
            'num' => '1',
            'display_follow' => '1',
            'consumer_key' => '',
            'consumer_secret' => '',
            'access_token' => '',
            'access_token_secret' => '',
            );
        parent::__construct();
    }
    
    public function render($args) {
        $o = new BFITwitter(
            $args['userid'], 
            $args['consumer_key'],
            $args['consumer_secret'],
            $args['access_token'],
            $args['access_token_secret']
            );
        if ($args['display_follow']) echo $o->getFollowLink();
        $tweets = $o->getTweets($args['num']);
        if (count($tweets)) {
            echo "<ul class='bfi-twitter-widget'>";
            foreach ($tweets as $tweet) {
                echo "<li>{$tweet['text']}<br><small>{$tweet['age']}</small></li>";
            }
            echo "</ul>";
        }
    }
    
    public function displayForm($args) {
        ?>
        <p>
            * The Twitter API now requires authentication in order to get tweets.<br><br>You will need API keys and tokens in order to make this work. First sign up at <a href='https://dev.twitter.com/apps' target='_blank'>https://dev.twitter.com/apps</a> and register your website as an app. Afterwards, go to the <em>OAuth Tool</em> tab in the Twitter Dev site and to find your API keys and tokens.
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('consumer_key'); ?>"><?php _e('Consumer Key *', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" type="text" value="<?php echo $args['consumer_key']; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('consumer_secret'); ?>"><?php _e('Consumer Secret *', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" type="text" value="<?php echo $args['consumer_secret']; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('access_token'); ?>"><?php _e('Access Token *', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" type="text" value="<?php echo $args['access_token']; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('access_token_secret'); ?>"><?php _e('Access Token Secret *', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" type="text" value="<?php echo $args['access_token_secret']; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('userid'); ?>"><?php _e('Twitter Username', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('userid'); ?>" name="<?php echo $this->get_field_name('userid'); ?>" type="text" value="<?php echo $args['userid']; ?>" />
            </label>
        </p>
    
        <p>
            <label for="<?php echo $this->get_field_id('num'); ?>"><?php _e('Number of tweets to display', BFI_I18NDOMAIN) ?>:</label>
            <select name="<?php echo $this->get_field_name('num')?>">
                <option value="1" <?php echo $args['num'] == '1' ? 'selected' : ''?>>1</option>
                <option value="2" <?php echo $args['num'] == '2' ? 'selected' : ''?>>2</option>
                <option value="3" <?php echo $args['num'] == '3' ? 'selected' : ''?>>3</option>
                <option value="4" <?php echo $args['num'] == '4' ? 'selected' : ''?>>4</option>
                <option value="5" <?php echo $args['num'] == '5' ? 'selected' : ''?>>5</option>
                <option value="6" <?php echo $args['num'] == '6' ? 'selected' : ''?>>6</option>
                <option value="7" <?php echo $args['num'] == '7' ? 'selected' : ''?>>7</option>
                <option value="8" <?php echo $args['num'] == '8' ? 'selected' : ''?>>8</option>
                <option value="9" <?php echo $args['num'] == '9' ? 'selected' : ''?>>9</option>
                <option value="10" <?php echo $args['num'] == '10' ? 'selected' : ''?>>10</option>
            </select>
        </p>
    
        <p>
            <label for="<?php echo $this->get_field_id('display_follow'); ?>"><?php _e('Display follow link', BFI_I18NDOMAIN) ?>:</label>
            <select name="<?php echo $this->get_field_name('display_follow')?>">
                <option value="1" <?php echo $args['display_follow'] == '1' ? 'selected' : ''?>><?php _e('Show', BFI_I18NDOMAIN) ?></option>
                <option value="0" <?php echo $args['display_follow'] == '0' ? 'selected' : ''?>><?php _e('Hide', BFI_I18NDOMAIN) ?></option>
            </select>
        </p>
        <?php
    }
}