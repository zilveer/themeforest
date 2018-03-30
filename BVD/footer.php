<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<div class="column" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5><div class="hr"></div>',
    ));
?>
<div id="footer">
  <div class="center" id="top_light5">
  <ul>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
  <li> <div class="column">
      <h5>latest blog entries</h5>
      <div class="hr"></div>
      <?php
            query_posts('showposts=3');
            if ( have_posts() ) : while ( have_posts() ) : the_post();
            // substr($post->post_content, 0, 20);
            ?>
      <p class="date">
        <?php the_time('d.m'); ?>
      </p>
      <h6><a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
        </a></h6>
      <p class="lead"><?php echo substr($post->post_content, 0, 100); ?></p>
      <?php endwhile; else: ?>
      <p>No recent posts</p>
      <?php endif; wp_reset_query(); ?>
    </div>
    <div class="column">
      <?php if (function_exists('get_recent_comments')): ?>
      <h5>recent comments</h5>
      <div class="hr"></div>
      <div class="recent_comment">
        <ul>
          <?php get_recent_comments(); ?>
        </ul>
      </div>
      <?php endif; ?>
    </div>
    <div class="column">
      <h5>adverstising</h5>
      <div class="hr"></div>
      <a class="ad_odd" href="#"> <img width="86" height="86" class="stroke" src="<?php bloginfo('stylesheet_directory'); ?>/images/ad1.jpg" alt="advertising" /> </a> <a class="ad" href="#"> <img width="86" height="86" class="stroke" src="<?php bloginfo('stylesheet_directory'); ?>/images/ad2.jpg" alt="advertising" /> </a> <a class="ad_odd" href="#"> <img width="86" height="86" class="stroke" src="<?php bloginfo('stylesheet_directory'); ?>/images/ad3.jpg" alt="advertising" /> </a> <a class="ad" href="#"> <img width="86" height="86" class="stroke" src="<?php bloginfo('stylesheet_directory'); ?>/images/ad4.jpg" alt="advertising" /> </a> </div>
    <div class="column_odd">
      <h5>twitter stuff</h5>
      <div class="hr"></div>
      <div id="tweeter">
        <?php twitter_messages("prashnt"); ?>
        <a class="follow" href="#">Follow us on Twitter</a> </div>
    </div></li>
    <?php endif; ?>
  </div>
  </ul>
  
</div>
<div id="footer_nav">
  <div class="center"> <a class="footer_logo" href="#">BVD</a>
    <p>Copyright 2009. All rights reserved. Valid (X)HTML / CSS.</p>
    <ul>
      <li><a href="<?php echo get_option('siteurl'); ?>/">home</a></li>
      <?php wp_list_pages('title_li=&depth=1'); ?>
    </ul>
  </div>
</div>
<?php wp_footer(); ?>
</body><!--END BODY -->
</html>
