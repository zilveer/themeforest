<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

/**
 * @var $instance
 * @var $before_widget
 * @var $after_widget
 * @var $title
 */

?>
<?php if ( ! empty( $instance ) ) :

    if(empty($instance['username'])) return;

    echo do_shortcode($before_widget);
    $connection = function_exists('fw_ext_social_twitter_get_connection') ? fw_ext_social_twitter_get_connection() : '';
    $tweets     = (!empty($connection)) ? $connection->get( "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $instance['username'] . "&count=" . $instance['number'] ) : '';
    ?>

    <div class="w-col w-col-4 col-footer">
        <?php if(!empty($instance['title'])):?>
            <div class="footer-tittle">
                <h6><?php echo esc_html($instance['title']);?></h6>
            </div>
        <?php endif; ?>

        <?php if(!empty($tweets)):?>
            <?php
                // Some reformatting
                $pattern = array(
                    '/[^(:\/\/)](www\.[^ \n\r]+)/',
                    '/(https?:\/\/[^ \n\r]+)/',
                    '/@(\w+)/',
                    '/^'.$instance['username'].':\s*/i'
                );
                $replace = array(
                    '<a style="text-decoration: none; color: #fff;" href="http://$1" rel="nofollow"  target="_blank">$1</a>',
                    '<a style="text-decoration: none; color: #fff;" href="$1" rel="nofollow" target="_blank">$1</a>',
                    '<a style="text-decoration: none; color: #fff;" href="http://twitter.com/$1" rel="nofollow"  target="_blank">@$1</a>'.
                    ''
                );

            ?>
            <div class="space x1">
                <div id="tweecool">
                    <ul class="w-list-unstyled">
                        <?php foreach($tweets as $tweet):?>
                            <li class="w-clearfix" style="margin-bottom: 27px;">
                                <a style=" float: left; margin-right: 20px;" href="<?php echo esc_url('https://twitter.com/'.$instance['username']);?>" target="_blank">
                                    <img src="<?php echo esc_url($tweet->user->profile_image_url);?>" alt="<?php echo esc_attr($instance['username']);?>"></a>
                                <div class="tweets_txt" style="overflow:hidden; color: #c9c9c9; line-height: 24px;">
                                    <?php echo preg_replace($pattern, $replace, $tweet->text);?>
                                <br />
                                <span style="color: #777; margin-top: 5px;">
                                    <?php echo date('F j, Y', strtotime($tweet->created_at)); ?>
                                </span>
                                </div>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>

        <?php endif; ?>
    </div>

    <?php echo do_shortcode($after_widget);
endif;