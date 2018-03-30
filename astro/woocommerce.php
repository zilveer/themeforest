<?php 
  get_header();
  //GET THE DEFAULT SIDEBAR VALUE
  if (isset($prk_astro_options['woo_sidebar_display']))
    $show_sidebar=$prk_astro_options['woo_sidebar_display'];
  else
    $show_sidebar="1";
  if (isset($_GET["sidebar"]) && $_GET["sidebar"]=="y") {
    $show_sidebar="1";
  }
  if (isset($_GET["sidebar"]) && $_GET["sidebar"]=="n") {
    $show_sidebar="no";
  }
?> 
<div id="centered_block" class="prk_inner_block columns centered main_no_sections">
<div id="main_block" class="row prk-woocommerce page-<?php echo get_the_ID(); ?>">
    <div id="headings_wrap" data-img="no" class="bd_headings_text_shadow zero_color">
      <div class="prk_inner_block centered twelve columns">
          <div class="single_page_title twelve columns">
            <div class="prk_titlify_father">
            <h1 class="header_font">
                <?php echo get_the_title(woocommerce_get_page_id('shop')); ?>                      
            </h1>
          </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    <div id="content">
        <div id="main" role="main" class="main_no_sections prk_normal_page">
          <?php
            if ($show_sidebar=="1")
            {
              echo '<div class="twelve columns sidebarized">';  
              echo '<div class="woo_columns">';
                woocommerce_content();
              echo '<div class="clearfix"></div></div></div>';
              ?>
                <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?> inside prk-woo-sidebar" role="complementary">
                  <div class="simple_line show_later"></div>
                  <div class="clearfix"></div>
                    <?php
                      if (function_exists('dynamic_sidebar') && dynamic_sidebar('prk-woo-sidebar')) :
                      else : 
                        ?>
                        <!-- THIS CONTENT WILL BE DISPLAYED IF THERE ARE NO WIDGETS -->
                        <div id="no-widgets">
                            <p>
                                <strong>NO WIDGETS YET</strong><br>
                            </p>
                        </div>
                        <?php 
                      endif; 
                    ?>
                  <div id="half_helper" class="clearfix"></div>
                </aside>
                <?php
            }
            else
            {
              echo '<div class="twelve columns unsidebarized">';
              echo '<div class="woo_columns">';
                woocommerce_content();
              echo '</div></div>';
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
</div>
<?php get_footer(); ?>