<?php if($response->status) : ?>
    <?php if(is_array($response->data) && count($response->data)) : ?>
        <div class="mkd-twitter-slider clearfix<?php echo esc_attr($dark_nav)?>">
            <div class="mkd-twitter-slider-inner" <?php mkd_core_inline_style($tweet_styles); ?>>
                <?php foreach($response->data as $tweet) : ?>
                    <div class="item mkd-twitter-slider-item">
                        <?php echo MikadoTwitterApi::getInstance()->getHelper()->getTweetText($tweet); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

<?php else: ?>
    <?php echo esc_html($response->message); ?>
<?php endif; ?>
