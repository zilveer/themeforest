<?php if(is_page_template('blog.php')): ?>

<div class="center_left">
  <div id="center_left_top" class="center_left_top">
    <h3 class="blog">The Blog</h3>
    <ul id="left_nav">
      <?php wp_list_categories('title_li='); ?>
    </ul>
  </div>
  <div class="subscribe">Subscribe</div>
  <p><a rel="nofollow" href="<?php bloginfo('rss_url'); ?>"><?php _e("RSS Feed", 'bvd'); ?></a> <br />
  <a href="http://feedburner.google.com/fb/a/mailverify?uri=Bvdtheme&amp;loc=en_US">Email Updates</a></p>
 <p><a href="http://feeds.feedburner.com/Bvdtheme"><img src="http://feeds.feedburner.com/~fc/Bvdtheme?bg=FF9900&amp;fg=444444&amp;anim=0" height="26" width="88" style="border:0" alt="" /></a></p>
  <div class="img_holder">
  <ul> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Post') ) : ?>
    <?php endif; ?></ul> 
    </div>
</div>
<!-- end center_left-->
<?php elseif (is_single()||is_archive()): ?>
<div class="center_left">
  <div id="center_left_top" class="center_left_top">
    <h3 class="blog">The Blog</h3>
    <ul id="left_nav">
      <?php wp_list_categories('title_li=&current_category=0'); ?>
    </ul>
  </div>
  <div class="subscribe">Subscribe</div>
  <p><a rel="nofollow" href="<?php bloginfo('rss_url'); ?>"><?php _e("RSS Feed", 'bvd'); ?></a><br />
    <a href="http://feedburner.google.com/fb/a/mailverify?uri=Bvdtheme&amp;loc=en_US">Email Updates</a></p>
  <p><a href="http://feeds.feedburner.com/Bvdtheme"><img src="http://feeds.feedburner.com/~fc/Bvdtheme?bg=FF9900&amp;fg=444444&amp;anim=0" height="26" width="88" style="border:0" alt="" /></a></p>
  <div class="img_holder">
    <ul> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Post') ) : ?>
    <?php endif; ?></ul> 
     </div>
</div>
<?php elseif (is_page_template('portfolio.php')): ?>
<div class="center_left">
  <div id="center_left_top" class="center_left_top">
    <h3 class="categories">The Categories</h3>
    <ul id="left_nav">
      <?php wp_list_categories('title_li=&current_category=0'); ?>
    </ul>
  </div>
  <div class="subscribe">Subscribe</div>
  <p><a rel="nofollow" href="<?php bloginfo('rss_url'); ?>"><?php _e("RSS Feed", 'bvd'); ?></a><br />
    <a href="http://feedburner.google.com/fb/a/mailverify?uri=Bvdtheme&amp;loc=en_US">Email Updates</a></p>
  <p><a href="http://feeds.feedburner.com/Bvdtheme"><img src="http://feeds.feedburner.com/~fc/Bvdtheme?bg=FF9900&amp;fg=444444&amp;anim=0" height="26" width="88" style="border:0" alt="" /></a></p>
  <div class="img_holder">
    <ul> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Post') ) : ?>
    <?php endif; ?></ul> 
     </div>
</div>

<?php elseif(is_page_template('contact.php')): ?>
<div class="center_left">
  <div class="center_left_top">
    <h3 class="office_europe">Office Europe</h3>
    <p class="office"> <b>Phone:</b><br />
      +4568 65 9 66<br />
      <b>Fax:</b><br />
      +4568 95 6 5<br />
      <b>Email:</b> adress@adress.com </p>
    <div class="spacer"></div>
    <h3 class="office_asia">Office Asia</h3>
    <p class="office"> <b>Phone:</b><br />
      +4568 65 9 66<br />
      <b>Fax:</b><br />
      +4568 95 6 5<br />
      <b>Email:</b> adress@adress.com </p>
  </div>
  <div class="subscribe"> Something about our<br />
    <a href="#">web design</a> </div>
  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris eget dolor. </p>
  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris eget dolor. </p>
  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris eget dolor. </p>
<ul> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Page') ) : ?>
    <?php endif; ?></ul> 
</div>
<!-- end center_left-->
<?php else: ?>
<div class="center_left">
  <div id="center_left_top" class="center_left_top">
    <h3>Free call</h3>
    <span>0800 658 9544</span>
    <ul id="left_nav">
      <?php
// If CHILD_OF is not NULL, then this page has a parent
// Therefore, list siblings i.e. subpages of this page's parent
 
if($post->post_parent){
  wp_list_pages('title_li=&child_of='.$post->post_parent); 
    }
// If CHILD_OF is zero, this is a top level page, so list subpages only.
else{
 wp_list_pages('title_li=&child_of='.$post->ID); 
    }
?>
    </ul>
  </div>
  <ul class="listing">
    <li>Design</li>
    <li>(x)HTML/CSS</li>
    <li>JavaScript</li>
    <li>Custom CMS (BVD)</li>
  </ul>
  <ul class="listing">
    <li>Project managment</li>
    <li>Hosting</li>
    <li>Support</li>
  </ul><br />
<ul> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Page') ) : ?>
    <?php endif; ?></ul> 
</div>
<!-- end center_left-->
<?php endif; ?>
