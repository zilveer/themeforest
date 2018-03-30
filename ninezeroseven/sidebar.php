<?php
/************************************************************************
* Sidebar File
*************************************************************************/
?>

<div class="side-bar">

    <?php 
      if( is_active_sidebar( apply_filters( 'wbc907_custom_sidebars' , 'sidebar-1' ) ) ){
          dynamic_sidebar( apply_filters( 'wbc907_custom_sidebars' , 'sidebar-1' ) );
      }else{
      ?>
      <div class="widget widget_categories">
            <h4 class="widget-title">
              <?php esc_html_e( 'Categories', 'ninezeroseven' ); ?>
            </h4>

            <ul class="categories">
              <?php wp_list_categories( 'title_li=' ); ?>
            </ul>
          </div>


          <div class="widget">
            <h4 class="widget-title">
            <?php esc_html_e( 'Meta', 'ninezeroseven' ); ?>
            </h4>

            <ul>
              <?php wp_register(); ?>
              <li><?php wp_loginout(); ?></li>
              <?php wp_meta(); ?>
            </ul>
          </div>

          <div class="widget">
            <h4 class="widget-title">
              <?php esc_html_e( 'Archives', 'ninezeroseven' ); ?>
            </h4>

            <ul>
              <?php wp_get_archives(); ?>
            </ul>
          </div>

          <div class="widget widget_pages">
            <h4 class="widget-title">
              <?php esc_html_e( 'Pages', 'ninezeroseven' ); ?>
            </h4>

            <ul>
              <?php wp_list_pages( 'sort_column=menu_order&title_li=' ); ?>
            </ul>

          </div>


      <?php } ?>

</div>
