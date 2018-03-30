<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    //social share icons
    $image = get_post_thumb($post->ID,0,0); 
?>
<?php if(df_option_compare('share_buttons','share_buttons',$post->ID)) { ?>
    <div class="post-share">
        <span class="share-text"><?php esc_html_e("Share this post:", THEME_NAME);?></span>
        <ul>
            <li>
                <a data-hashtags="" data-url="<?php echo esc_url(get_permalink());?>" data-via="<?php echo esc_attr(df_get_option(THEME_NAME.'_twitter_name'));?>" data-text="<?php esc_attr_e(get_the_title());?>" data-sharetip="<?php esc_html_e("Share on Twitter!", THEME_NAME);?>" href="#" class="twitter df-tweet">
                    <span class="socicon">a</span>
                </a>

            </li>
            <li>
                <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink());?>" data-url="<?php echo esc_url(get_permalink());?>" data-url="<?php echo esc_url(get_permalink());?>" data-sharetip="<?php esc_html_e("Share on Facebook!", THEME_NAME);?>" class="facebook df-share">
                    <span class="socicon">b</span>
                </a>

            </li>
            <li>
                <a data-sharetip="<?php esc_html_e("Share on Google+!", THEME_NAME);?>" href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink());?>" class="google df-pluss">
                    <span class="socicon">c</span>
                </a>

            </li>
            <li>
                <a data-sharetip="<?php esc_html_e("Share on Pinterest!", THEME_NAME);?>" href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url(get_permalink());?>&media=<?php echo esc_url($image['src']); ?>&description=<?php esc_attr_e(get_the_title()); ?>" data-url="<?php echo esc_url(get_permalink());?>" class="google df-pin">
                    <span class="socicon">d</span>
                </a>

            </li>
            <li>
                <a data-sharetip="<?php esc_html_e("Share on LinkedIn!", THEME_NAME);?>" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url(get_permalink());?>&title=<?php esc_attr_e(get_the_title());?>" data-url="<?php echo esc_url(get_permalink());?>" class="linkedin df-link">
                    <span class="socicon">j</span>
                </a>

            </li>
        </ul>
    </div>
<?php } ?>