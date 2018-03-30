<?php
  $rentify_option_data = rentify_option_data(); 
  if(isset($rentify_option_data['rentify-general-banner'])){
    $background_image = $rentify_option_data['rentify-general-banner']['url'];  
  }

  if(isset($rentify_option_data['rentify-general-banner-color'])){
    $background_color = $rentify_option_data['rentify-general-banner-color']['color'];  
  }

?> 

<div class="uou-block-3c secondary" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image);}?>);background-size:cover;">
  <div class="container">
    <h1><?php the_title(); ?></h1>
    <ul class="breadcrumbs">
      <!-- <li> -->
        <?php 
            if (function_exists("the_breadcrumb")) {
              the_breadcrumb();
            } 
        ?>  
      <!-- </li> -->
    </ul>
  </div>
</div> <!-- end .uou-block-3b -->