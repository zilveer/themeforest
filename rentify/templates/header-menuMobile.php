<!-- Start Nav -->
   <nav class="main-nav">
    <!-- <ul> -->
          

    <?php 

     $defaults = array(
      'theme_location'  => 'primary_navigation_right',
      'menu'            => '',
      'container'       => '',
      'container_class' => '',
      'container_id'    => '',
      'menu_class'      => '',
      'menu_id'         => '',
      'echo'            => true,      
     );

      
     wp_nav_menu( $defaults );


    ?>

    <!-- </ul> -->
   </nav>
   <!-- End Nav -->