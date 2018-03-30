<div id="sharing" class="clearfix">
     <h3>Share this!</h3>
     <?php $title = str_replace(' ','%20',get_the_title()); ?>
     <a href="<?php bloginfo('rss2_url'); ?>" title="Subscribe to our RSS feed." target="_blank">
       <img src="<?php echo get_template_directory_uri(); ?>/images/social/feed.png" alt="Subscribe to our RSS feed." />
     </a>
    <a href="http://twitter.com/home/?status=<?php echo $title; ?>:<?php the_permalink(); ?>" title="Tweet this!" target="_blank">
     <img src="<?php echo get_template_directory_uri(); ?>/images/social/twitter.png" alt="Tweet this!" />
    </a>
     
    <a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;amp;title=<?php echo $title; ?>" title="StumbleUpon." target="_blank">
     <img src="<?php echo get_template_directory_uri(); ?>/images/social/stumbleupon.png" alt="StumbleUpon" />
    </a>
    <a href="http://www.reddit.com/submit?url=<?php the_permalink(); ?>&amp;amp;title=<?php echo $title; ?>" title="Vote on Reddit." target="_blank">
     <img src="<?php echo get_template_directory_uri(); ?>/images/social/reddit.png" alt="Reddit" />
    </a>   
    <a href="http://digg.com/submit?phase=2&amp;amp;url=<?php the_permalink(); ?>&amp;amp;title=<?php echo $title; ?>" title="Digg this!" target="_blank">
     <img src="<?php echo get_template_directory_uri(); ?>/images/social/digg.png" alt="Digg This!" />
    </a>
     
    <a href="http://del.icio.us/post?url=<?php the_permalink(); ?>&amp;amp;title=<?php echo $title; ?>" title="Bookmark on Delicious." target="_blank">
     <img src="<?php echo get_template_directory_uri(); ?>/images/social/delicious.png" alt="Bookmark on Delicious" />
    </a>
     
    <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;amp;t=<?php echo $title; ?>" title="Share on Facebook." target="_blank">
     <img src="<?php echo get_template_directory_uri(); ?>/images/social/facebook.png" alt="Share on Facebook" id="sharethis-last" />
    </a>    
</div>            