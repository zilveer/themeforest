<div id="head" class="wrap group">
  
  <div class="one-fourth">
    
    <div id="logo">
      <?php
        $h1 =
          is_page_template('template-journal.php') ||
          is_page_template('template-homepage.php') ||
          is_page_template('template-homepage-6.php') ||
          is_page_template('template-portfolio.php');
      ?>
      
      <?php if ($h1) echo '<h1>' ?>
      
      <?php if ( $logo = Acorn::get( 'logo' ) ) : ?>
        <a href="<?php echo site_url() ?>"><img src="<?php echo $logo ?>" title="<?php bloginfo( 'name' ) ?>" alt="<?php wp_title( '|', true, 'right' ) ?><?php bloginfo( 'name' ) ?>"></a>
      <?php endif; ?>
      
      <?php if ($h1) echo '</h1>' ?>
    </div>
    <!-- /logo-->
    
    <select id="menu-list-mobile">
      <option value="">NAVIGATE&hellip;</option>
      <?php
        foreach ( AExtend::getMenuItems('menu-1','menu-2','menu-3') as $item )
          echo "<option value='{$item->url}'>{$item->title}</option>\n";
      ?>
    </select>
    <!-- /menu-list-mobile-->
  
  </div>
  <!-- /one-fourth column-->
  
  <div class="one-fourth immobile">
    <ol class="menu list">
      <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'container' => false, 'items_wrap' => '%3$s', 'fallback_cb' => false, 'depth' => 1 )); ?>
    </ol>
    <!-- /menu list-->
  </div>
  <!-- /one-fourth column-->
  
  <div class="one-fourth immobile">
    <ol class="menu list">
      <?php wp_nav_menu( array( 'theme_location' => 'menu-2', 'container' => false, 'items_wrap' => '%3$s', 'fallback_cb' => false, 'depth' => 1 )); ?>
    </ol>
    <!-- /menu list-->
  </div>
  <!-- /one-fourth column-->
  
  <div class="one-fourth last immobile">
    <ol class="menu list">
      <?php wp_nav_menu( array( 'theme_location' => 'menu-3', 'container' => false, 'items_wrap' => '%3$s', 'fallback_cb' => false, 'depth' => 1 )); ?>
    </ol>
    <!-- /menu list-->
  </div>
  <!-- /one-fourth last column-->
  
  <?php get_template_part( 'tile', 'head-info' ) ?>

</div>
<!-- /head-->