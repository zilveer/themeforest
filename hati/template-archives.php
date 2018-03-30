<?php

/* Template Name: Archives */

?>
<?php get_header(); if (have_posts()) the_post(); ?>


<div class="main wrap group post nopad">
  
  <div class="headings">
    <h1>
      <?php 
        if (is_search()) _e('Nothing Found', A_DOMAIN);
        else if (is_404()) _e('404 - Not Found', A_DOMAIN);
        else the_title();
      ?>
    </h1>
    <h4>
      <?php
        if (is_search()) _e('Sorry, no posts matched your criteria.', A_DOMAIN);
        else if (is_404()) _e('The page you\'re looking for isn\'t here anymore.', A_DOMAIN);
        else the_content();
      ?>
    </h4>
  </div>
  <!-- /headings-->
  
  <div class="clear"></div>
  <div class="one-fourth mobile-centred">
    <h3><?php _e('Archives by Subject', A_DOMAIN) ?></h3>
    <ol class="list">
      <?php wp_list_categories('title_li=') ?>
    </ol>
  </div>

  <div class="one-fourth mobile-centred">
    <h3><?php _e('Archives by Month', A_DOMAIN) ?></h3>
    <ol class="list">
      <?php wp_get_archives('type=monthly') ?>
    </ol>
  </div>

  <div class="one-half last mobile-centred">
    <h3><?php _e('Latest 15 Posts', A_DOMAIN) ?></h3>
    <ol class="list">
    <?php $p = $post; foreach(get_posts('numberposts=15&suppress_filters=0') as $post) : ?>
      <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
    <?php endforeach; $post = $p; ?>
    </ol>
  </div>

</div>
<!-- /main post-->

<?php get_footer() ?>