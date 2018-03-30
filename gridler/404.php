<?php
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");
?>
<?php get_header(); ?>

<!--BEGIN #page-->

  <!--BEGIN #content-wrap-->
  <div id="content-wrap" class="sidebar-Off"> 
    <!--BEGIN #content-->
    <section id="content" class="error404">
    <div class="post">
      <h2 class="entry-title">
        <?php _e('Error 404 Not Found', 'framework'); ?>
      </h2>
      <p>
        <?php _e('Oops. The page cannot be found.', 'framework'); ?>
      </p>
      <p>
        <?php _e('Please check your URL or use the search form below.', 'framework'); ?>
      </p>
      <?php get_search_form();?>
      </div>
      <!--END #content--> 
    </section>
    <!--END #content-wrap--> 
  </div>
  <div class="clear"></div>
<?php get_footer(); ?>