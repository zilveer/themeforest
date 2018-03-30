<?php

// Social Share
global $porto_settings;

if (!$porto_settings['share-enable'])
    return;

echo '<div class="share-links">';

$nofollow = '';
if ($porto_settings['share-nofollow'])
    $nofollow = ' rel="nofollow"';

$image = esc_url(wp_get_attachment_url( get_post_thumbnail_id() ));
$permalink = esc_url( apply_filters( 'the_permalink', get_permalink() ) );
$title = esc_attr(get_the_title());
if (porto_is_ajax() && isset($_GET['action'])) {
    $tooltip = ' data-tooltip';
} else {
    $tooltip = ' data-tooltip data-placement="bottom"';
}

$extra_attr = 'target="_blank" ' . $nofollow . $tooltip;

if ($porto_settings['share-facebook']) :
    ?><a href="http://www.facebook.com/sharer.php?m2w&amp;s=100&amp;p&#091;url&#093;=<?php echo $permalink ?>&amp;p&#091;images&#093;&#091;0&#093;=<?php echo $image ?>&amp;p&#091;title&#093;=<?php echo $title ?>" <?php echo $extra_attr ?> title="<?php echo __('Facebook', 'porto') ?>" class="share-facebook"><?php echo __('Facebook', 'porto') ?></a><?php
endif;

if ($porto_settings['share-twitter']) :
    ?><a href="https://twitter.com/intent/tweet?text=<?php echo $title ?>&amp;url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php echo __('Twitter', 'porto') ?>" class="share-twitter"><?php echo __('Twitter', 'porto') ?></a><?php
endif;

if ($porto_settings['share-linkedin']) :
    ?><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $permalink ?>&amp;title=<?php echo $title ?>" <?php echo $extra_attr ?> title="<?php echo __('LinkedIn', 'porto') ?>" class="share-linkedin"><?php echo __('LinkedIn', 'porto') ?></a><?php
endif;

if ($porto_settings['share-googleplus']) :
    ?><a href="https://plus.google.com/share?url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php echo __('Google +', 'porto') ?>" class="share-googleplus"><?php echo __('Google +', 'porto') ?></a><?php
endif;

if ($porto_settings['share-pinterest']) :
    ?><a href="https://pinterest.com/pin/create/button/?url=<?php echo $permalink ?>&amp;media=<?php echo $image ?>" <?php echo $extra_attr ?> title="<?php echo __('Pinterest', 'porto') ?>" class="share-pinterest"><?php echo __('Pinterest', 'porto') ?></a><?php
endif;

if ($porto_settings['share-email']) :
    ?><a href="mailto:?subject=<?php echo $title ?>&amp;body=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php echo __('Email', 'porto') ?>" class="share-email"><?php echo __('Email', 'porto') ?></a><?php
endif;

if ($porto_settings['share-vk']) :
    ?><a href="https://vk.com/share.php?url=<?php echo $permalink ?>&amp;title=<?php echo $title ?>&amp;image=<?php echo $image ?>&amp;noparse=true" <?php echo $extra_attr ?> title="<?php echo __('VK', 'porto') ?>" class="share-vk"><?php echo __('VK', 'porto') ?></a><?php
endif;

if ($porto_settings['share-xing']) :
    ?><a href="https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php echo __('Xing', 'porto') ?>" class="share-xing"><?php echo __('Xing', 'porto') ?></a><?php
endif;

if ($porto_settings['share-tumblr']) :
    ?><a href="http://www.tumblr.com/share/link?url=<?php echo $permalink ?>&amp;name=<?php echo urlencode($title) ?>&amp;description=<?php echo urlencode(get_the_excerpt()) ?>" <?php echo $extra_attr ?> title="<?php echo __('Tumblr', 'porto') ?>" class="share-tumblr"><?php echo __('Tumblr', 'porto') ?></a><?php
endif;

if ($porto_settings['share-reddit']) :
    ?><a href="http://www.reddit.com/submit?url=<?php echo $permalink ?>&amp;title=<?php echo $title ?>" <?php echo $extra_attr ?> title="<?php echo __('Reddit', 'porto') ?>" class="share-reddit"><?php echo __('Reddit', 'porto') ?></a><?php
endif;

if ($porto_settings['share-whatsapp']) :
    ?><a href="whatsapp://send?text=<?php echo $title ?>%20<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php echo __('WhatsApp', 'porto') ?>" class="share-whatsapp" style="display:none"><?php echo __('WhatsApp', 'porto') ?></a><?php
endif;

echo '</div>';