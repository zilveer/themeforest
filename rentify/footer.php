<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage simple builder
 * @since 1.0
 */
?>





<?php $rentify_option_data = rentify_option_data(); ?>

<!-- Start Footer Switch -->

<?php if($rentify_option_data['sb-footer-switch']){?>

<!-- Start sb Multifooter -->

<!-- Start Footer 1 -->
<?php if(isset($rentify_option_data['sb-multi-footer-image'])&&($rentify_option_data['sb-multi-footer-image']==1)){?>
  <!-- uou block 4c -->
  <div class="uou-block-4c">
    <div class="container">

  <?php if($rentify_option_data['sb-footer-menu-switch']){?>
      <?php get_template_part( 'templates/footer', 'menu' ); ?> 
  <?php } ?>
              <!-- Start right footer sidebar -->

    <?php   if($rentify_option_data['sb-down-footer-switch']){ ?>


            <?php

            if(is_active_sidebar('sb_footer_down_sidebar')):

              dynamic_sidebar('sb_footer_down_sidebar');

            endif;  
            
            ?>

    <?php } ?>

        <!-- End right footer sidebar -->
    </div>
  </div> <!-- end .uou-block-4c -->
  <!-- uou block 4c -->
<?php } ?> 
<!-- End Footer 1 -->


<!-- Start Footer 2 -->
<?php if(isset($rentify_option_data['sb-multi-footer-image'])&&($rentify_option_data['sb-multi-footer-image']==2)){?>
  <!-- uou block 4c -->
  <div class="uou-block-4c secondary">
    <div class="container">

  <?php if($rentify_option_data['sb-footer-menu-switch']){?>
      <?php get_template_part( 'templates/footer', 'menu' ); ?> 
  <?php } ?>      

              <!-- Start right footer sidebar -->

    <?php   if($rentify_option_data['sb-down-footer-switch']){ ?>


            <?php

            if(is_active_sidebar('sb_footer_down_sidebar')):

              dynamic_sidebar('sb_footer_down_sidebar');

            endif;  
            
            ?>

    <?php } ?>

        <!-- End right footer sidebar -->
    </div>
  </div> <!-- end .uou-block-4c -->
  <!-- uou block 4c -->
<?php } ?> 
<!-- End Footer 2 -->

<!-- Start Footer 3 -->
<?php if(isset($rentify_option_data['sb-multi-footer-image'])&&($rentify_option_data['sb-multi-footer-image']==3)){?>
  <!-- uou block 4c -->
  <div class="uou-block-4c">
    <div class="container">
      <div class="left-section">
  <?php if($rentify_option_data['sb-footer-menu-switch']){?>
      <?php get_template_part( 'templates/footer', 'menu' ); ?> 
  <?php } ?>

 

              <!-- Start right footer sidebar -->

    <?php   if($rentify_option_data['sb-down-footer-switch']){ ?>


            <?php

            if(is_active_sidebar('sb_footer_down_sidebar')):

              dynamic_sidebar('sb_footer_down_sidebar');

            endif;  
            
            ?>

    <?php } ?>        <!-- End right footer sidebar -->
    </div>
    
<!-- Start of social Profile -->

<?php if($rentify_option_data['sb-social-profile']){?>
  <div class="right-section">
    <?php if(isset($rentify_option_data['sb-social-profile-title'])&& !empty($rentify_option_data['sb-multi-footer-image'])){?>
      <h5><?php echo esc_attr($rentify_option_data['sb-social-profile-title']); ?></h5>
      <hr>
    <?php } ?>

  <ul class="social-icons">

        <?php if(isset($rentify_option_data['sb-facebook-profile']) && !empty($rentify_option_data['sb-facebook-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-facebook-profile']);?> "><i class="fa fa-facebook"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-twitter-profile']) && !empty($rentify_option_data['sb-twitter-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-twitter-profile']);?> "><i class="fa fa-twitter"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-google-profile']) && !empty($rentify_option_data['sb-google-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-google-profile']);?> "><i class="fa fa-google"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-linkedin-profile']) && !empty($rentify_option_data['sb-linkedin-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-linkedin-profile']);?> "><i class="fa fa-linkedin"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-pinterest-profile']) && !empty($rentify_option_data['sb-pinterest-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-pinterest-profile']);?> "><i class="fa fa-pinterest"></i></a></li>
        <?php endif; ?>

  </ul>
</div>

<?php }?>
<!-- end of social profile -->
    </div>
  </div> <!-- end .uou-block-4c -->
  <!-- uou block 4c -->
<?php } ?> 
<!-- End Footer 3 -->


<!-- Start Footer 4 -->
<?php if(isset($rentify_option_data['sb-multi-footer-image'])&&($rentify_option_data['sb-multi-footer-image']==4)){?>
  <!-- uou block 4c -->
  <div class="uou-block-4c secondary">
    <div class="container">
      <div class="left-section">
  <?php if($rentify_option_data['sb-footer-menu-switch']){?>
      <?php get_template_part( 'templates/footer', 'menu' ); ?> 
  <?php } ?>

 

              <!-- Start right footer sidebar -->

    <?php   if($rentify_option_data['sb-down-footer-switch']){ ?>


            <?php

            if(is_active_sidebar('sb_footer_down_sidebar')):

              dynamic_sidebar('sb_footer_down_sidebar');

            endif;  
            
            ?>

    <?php } ?>
            <!-- End right footer sidebar -->
    </div>

<!-- Start sccial Profile -->

<?php if($rentify_option_data['sb-social-profile']){?>
  <div class="right-section">
    <?php if(isset($rentify_option_data['sb-social-profile-title'])&& !empty($rentify_option_data['sb-multi-footer-image'])){?>
      <h5><?php echo esc_attr($rentify_option_data['sb-social-profile-title']); ?></h5>
      <hr>
    <?php } ?>

  <ul class="social-icons">

        <?php if(isset($rentify_option_data['sb-facebook-profile']) && !empty($rentify_option_data['sb-facebook-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-facebook-profile']);?> "><i class="fa fa-facebook"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-twitter-profile']) && !empty($rentify_option_data['sb-twitter-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-twitter-profile']);?> "><i class="fa fa-twitter"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-google-profile']) && !empty($rentify_option_data['sb-google-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-google-profile']);?> "><i class="fa fa-google"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-linkedin-profile']) && !empty($rentify_option_data['sb-linkedin-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-linkedin-profile']);?> "><i class="fa fa-linkedin"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-pinterest-profile']) && !empty($rentify_option_data['sb-pinterest-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-pinterest-profile']);?> "><i class="fa fa-pinterest"></i></a></li>
        <?php endif; ?>

  </ul>
</div>

<?php }?>
<!-- end of social profile -->

    </div>
  </div> <!-- end .uou-block-4c -->
  <!-- uou block 4c -->
<?php } ?> 
<!-- End Footer 4 -->


<!-- Start Footer 5 -->
<?php if(isset($rentify_option_data['sb-multi-footer-image'])&&($rentify_option_data['sb-multi-footer-image']==5)){?>
  <!-- uou block 4c -->
  <div class="uou-block-4c">
    <div class="container">
      <div class="left-section">
  <?php if($rentify_option_data['sb-footer-menu-switch']){?>
      <?php get_template_part( 'templates/footer', 'menu' ); ?> 
  <?php } ?>

 

              <!-- Start right footer sidebar -->

    <?php   if($rentify_option_data['sb-down-footer-switch']){ ?>


            <?php

            if(is_active_sidebar('sb_footer_down_sidebar')):

              dynamic_sidebar('sb_footer_down_sidebar');

            endif;  
            
            ?>

    <?php } ?>
            <!-- End right footer sidebar -->
    </div>


<div class="right-section">
          <!-- Start right footer sidebar -->

    <?php   if($rentify_option_data['sb-right-footer-switch']){ ?>


            <?php

            if(is_active_sidebar('sb_footer_right_sidebar')):

              dynamic_sidebar('sb_footer_right_sidebar');

            endif;  
            
            ?>

    <?php } ?>

        <!-- End right footer sidebar -->
</div>

    </div>
  </div> <!-- end .uou-block-4c -->
  <!-- uou block 4c -->
<?php } ?> 
<!-- End Footer 5 -->



<!-- Start Footer 6 -->
<?php if(isset($rentify_option_data['sb-multi-footer-image'])&&($rentify_option_data['sb-multi-footer-image']==6)){?>
  <!-- uou block 4c -->
  <div class="uou-block-4c secondary">
    <div class="container">
      <div class="left-section">
  <?php if($rentify_option_data['sb-footer-menu-switch']){?>
      <?php get_template_part( 'templates/footer', 'menu' ); ?> 
  <?php } ?>

 

              <!-- Start right footer sidebar -->

    <?php   if($rentify_option_data['sb-down-footer-switch']){ ?>


            <?php

            if(is_active_sidebar('sb_footer_down_sidebar')):

              dynamic_sidebar('sb_footer_down_sidebar');

            endif;  
            
            ?>

    <?php } ?>
            <!-- End right footer sidebar -->
    </div>


<div class="right-section">
          <!-- Start right footer sidebar -->

    <?php   if($rentify_option_data['sb-right-footer-switch']){ ?>


            <?php

            if(is_active_sidebar('sb_footer_right_sidebar')):

              dynamic_sidebar('sb_footer_right_sidebar');

            endif;  
            
            ?>

    <?php } ?>

        <!-- End right footer sidebar -->
</div>

    </div>
  </div> <!-- end .uou-block-4c -->
  <!-- uou block 4c -->
<?php } ?> 
<!-- End Footer 6 -->


<!-- Start Footer 7 -->
<?php if(isset($rentify_option_data['sb-multi-footer-image'])&&($rentify_option_data['sb-multi-footer-image']==7)){?>
  <!-- uou block 4e -->
  <div class="uou-block-4e">
    <div class="container">
      <div class="row">

         <!-- Start left footer sidebar -->

    <?php   if($rentify_option_data['sb-left-footer-switch']){ ?>

            <?php

            if(is_active_sidebar('sb_footer_left_sidebar')):

              dynamic_sidebar('sb_footer_left_sidebar');

            endif;  
            
            ?>
    
    <?php } ?>

        <!-- End left footer sidebar  -->


        <!-- Start middle footer sidebar -->

    <?php   if($rentify_option_data['sb-middle-footer-switch']){ ?>

            <?php

            if(is_active_sidebar('sb_footer_middle_sidebar')):

              dynamic_sidebar('sb_footer_middle_sidebar');

            endif;  
            
            ?>

    <?php } ?>

        <!-- End middle footer sidebar -->

        <!-- Start footer extra middle sidebar -->

        <?php   if($rentify_option_data['sb-extra-middle-footer-switch']){ ?>

           <div class="col-md-6 col-sm-8">
            <div class="row">
               <?php

              if(is_active_sidebar('sb_footer_extra_middle_sidebar')):

                dynamic_sidebar('sb_footer_extra_middle_sidebar');

              endif;  
              
              ?>
            </div>
          </div>

        <?php } ?>

          <!-- End footer extra middle sidebar -->



        <!-- Start right footer sidebar -->

    <?php   if($rentify_option_data['sb-right-footer-switch']){ ?>


            <?php

            if(is_active_sidebar('sb_footer_right_sidebar')):

              dynamic_sidebar('sb_footer_right_sidebar');

            endif;  
            
            ?>

    <?php } ?>

        <!-- End right footer sidebar -->

      </div>
    </div>
  </div> <!-- end .uou-block-4e -->
  <?php } ?> 
<!-- End Footer 7 -->



<!-- Start Footer 8 -->
<?php if(isset($rentify_option_data['sb-multi-footer-image'])&&($rentify_option_data['sb-multi-footer-image']==8)){?>
  <!-- uou block 4e -->
  <div class="uou-block-4e secondary">
    <div class="container">
      <div class="row">

         <!-- Start left footer sidebar -->

    <?php   if($rentify_option_data['sb-left-footer-switch']){ ?>

            <?php

            if(is_active_sidebar('sb_footer_left_sidebar')):

              dynamic_sidebar('sb_footer_left_sidebar');

            endif;  
            
            ?>
    
    <?php } ?>

        <!-- End left footer sidebar  -->


        <!-- Start middle footer sidebar -->

    <?php   if($rentify_option_data['sb-middle-footer-switch']){ ?>

            <?php

            if(is_active_sidebar('sb_footer_middle_sidebar')):

              dynamic_sidebar('sb_footer_middle_sidebar');

            endif;  
            
            ?>

    <?php } ?>

        <!-- End middle footer sidebar -->

    
        <!-- Start footer extra middle sidebar -->

        <?php   if($rentify_option_data['sb-extra-middle-footer-switch']){ ?>

           <div class="col-md-6 col-sm-8">
            <div class="row">
               <?php

              if(is_active_sidebar('sb_footer_extra_middle_sidebar')):

                dynamic_sidebar('sb_footer_extra_middle_sidebar');

              endif;  
              
              ?>
            </div>
          </div>

        <?php } ?>

          <!-- End footer extra middle sidebar -->


        <!-- Start right footer sidebar -->

    <?php   if($rentify_option_data['sb-right-footer-switch']){ ?>


            <?php

            if(is_active_sidebar('sb_footer_right_sidebar')):

              dynamic_sidebar('sb_footer_right_sidebar');

            endif;  
            
            ?>

    <?php } ?>

        <!-- End right footer sidebar -->

      </div>
    </div>
  </div> <!-- end .uou-block-4e -->
  <?php } ?> 
<!-- End Footer 8 -->

<!-- End of Multifooter -->

<?php } ?> 
<!-- End Footer Switch -->





<!-- Start Footer Switch -->

<?php if($rentify_option_data['sb-bottom-switch']){?>

<!-- Multi Bottom Starts Here -->

<!-- Start Bottom 1 -->
<?php if(isset($rentify_option_data['sb-multi-bottom-image'])&&($rentify_option_data['sb-multi-bottom-image']==1)){?>
  <!-- uou block 4a -->
  <div class="uou-block-4a">
    <div class="container">
      <?php if($rentify_option_data['sb-show-footer-copyrights']){?>
      <p>
        <?php if(isset($rentify_option_data['sb-copyright-text'])&&!empty($rentify_option_data['sb-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-copyright-text']); ?> 
        <?php } ?> 
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>. 
        <?php if(isset($rentify_option_data['sb-after-copyright-text'])&&!empty($rentify_option_data['sb-after-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-after-copyright-text']); ?>
        <?php } ?>
      </p>
      <?php } ?>
    </div>
  </div> 
  <!-- end .uou-block-4a -->
    <?php } ?> 
<!-- End Bottom 1 -->


<!-- Start Bottom 2 -->
<?php if(isset($rentify_option_data['sb-multi-bottom-image'])&&($rentify_option_data['sb-multi-bottom-image']==2)){?>
  <!-- uou block 4a -->
  <div class="uou-block-4a secondary dark">
    <div class="container">
      <?php if($rentify_option_data['sb-show-footer-copyrights']){?>
      <p>
        <?php if(isset($rentify_option_data['sb-copyright-text'])&&!empty($rentify_option_data['sb-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-copyright-text']); ?> 
        <?php } ?> 
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>. 
        <?php if(isset($rentify_option_data['sb-after-copyright-text'])&&!empty($rentify_option_data['sb-after-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-after-copyright-text']); ?>
        <?php } ?>
      </p>
      <?php } ?>
    </div>
  </div> 
  <!-- end .uou-block-4a -->
    <?php } ?> 
<!-- End Bottom 2 -->


<!-- Start Bottom 3 -->
<?php if(isset($rentify_option_data['sb-multi-bottom-image'])&&($rentify_option_data['sb-multi-bottom-image']==3)){?>
  <!-- uou block 4a -->
  <div class="uou-block-4a">
    <div class="container">

    <!-- Start sccial Profile -->

    <?php if($rentify_option_data['sb-social-profile']){?>

      <ul class="social-icons">

        <?php if(isset($rentify_option_data['sb-facebook-profile']) && !empty($rentify_option_data['sb-facebook-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-facebook-profile']);?> "><i class="fa fa-facebook"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-twitter-profile']) && !empty($rentify_option_data['sb-twitter-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-twitter-profile']);?> "><i class="fa fa-twitter"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-google-profile']) && !empty($rentify_option_data['sb-google-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-google-profile']);?> "><i class="fa fa-google"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-linkedin-profile']) && !empty($rentify_option_data['sb-linkedin-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-linkedin-profile']);?> "><i class="fa fa-linkedin"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-pinterest-profile']) && !empty($rentify_option_data['sb-pinterest-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-pinterest-profile']);?> "><i class="fa fa-pinterest"></i></a></li>
        <?php endif; ?>

      </ul>

    <?php }?>
    <!-- end of social profile -->


      <?php if($rentify_option_data['sb-show-footer-copyrights']){?>
      <p>
        <?php if(isset($rentify_option_data['sb-copyright-text'])&&!empty($rentify_option_data['sb-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-copyright-text']); ?> 
        <?php } ?> 
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>. 
        <?php if(isset($rentify_option_data['sb-after-copyright-text'])&&!empty($rentify_option_data['sb-after-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-after-copyright-text']); ?>
        <?php } ?>
      </p>
      <?php } ?>
    </div>
  </div> 
  <!-- end .uou-block-4a -->
    <?php } ?> 
<!-- End Bottom 3 -->



<!-- Start Bottom 4 -->
<?php if(isset($rentify_option_data['sb-multi-bottom-image'])&&($rentify_option_data['sb-multi-bottom-image']==4)){?>
  <!-- uou block 4a -->
  <div class="uou-block-4a secondary dark">
    <div class="container">

    <!-- Start sccial Profile -->

    <?php if($rentify_option_data['sb-social-profile']){?>

      <ul class="social-icons">

        <?php if(isset($rentify_option_data['sb-facebook-profile']) && !empty($rentify_option_data['sb-facebook-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-facebook-profile']);?> "><i class="fa fa-facebook"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-twitter-profile']) && !empty($rentify_option_data['sb-twitter-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-twitter-profile']);?> "><i class="fa fa-twitter"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-google-profile']) && !empty($rentify_option_data['sb-google-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-google-profile']);?> "><i class="fa fa-google"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-linkedin-profile']) && !empty($rentify_option_data['sb-linkedin-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-linkedin-profile']);?> "><i class="fa fa-linkedin"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-pinterest-profile']) && !empty($rentify_option_data['sb-pinterest-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-pinterest-profile']);?> "><i class="fa fa-pinterest"></i></a></li>
        <?php endif; ?>

      </ul>

    <?php }?>
    <!-- end of social profile -->


      <?php if($rentify_option_data['sb-show-footer-copyrights']){?>
      <p>
        <?php if(isset($rentify_option_data['sb-copyright-text'])&&!empty($rentify_option_data['sb-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-copyright-text']); ?> 
        <?php } ?> 
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>. 
        <?php if(isset($rentify_option_data['sb-after-copyright-text'])&&!empty($rentify_option_data['sb-after-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-after-copyright-text']); ?>
        <?php } ?>
      </p>
      <?php } ?>
    </div>
  </div> 
  <!-- end .uou-block-4a -->
    <?php } ?> 
<!-- End Bottom 4 -->



<!-- Start Bottom 5 -->
<?php if(isset($rentify_option_data['sb-multi-bottom-image'])&&($rentify_option_data['sb-multi-bottom-image']==5)){?>
  <!-- uou block 4a -->
  <div class="uou-block-4a">
    <div class="container">

      <ul class="links">
          <?php if(isset($rentify_option_data['sb-privacy'])&&!empty($rentify_option_data['sb-privacy'])) {?>
            <li><a href="http://<?php echo esc_url($rentify_option_data['sb-privacy']);?> ">Privacy Policy</a></li>
          <?php } ?>
          <?php if(isset($rentify_option_data['sb-condition'])&&!empty($rentify_option_data['sb-condition'])) {?>
            <li><a href="http://<?php echo esc_url($rentify_option_data['sb-condition']);?>">Terms &amp; Conditions</a></li>
          <?php } ?>      
      </ul>


      <?php if($rentify_option_data['sb-show-footer-copyrights']){?>
      <p>
        <?php if(isset($rentify_option_data['sb-copyright-text'])&&!empty($rentify_option_data['sb-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-copyright-text']); ?> 
        <?php } ?> 
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>. 
        <?php if(isset($rentify_option_data['sb-after-copyright-text'])&&!empty($rentify_option_data['sb-after-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-after-copyright-text']); ?>
        <?php } ?>
      </p>
      <?php } ?>
    </div>
  </div> 
  <!-- end .uou-block-4a -->
    <?php } ?> 
<!-- End Bottom 5-->



<!-- Start Bottom 6 -->
<?php if(isset($rentify_option_data['sb-multi-bottom-image'])&&($rentify_option_data['sb-multi-bottom-image']==6)){?>
  <!-- uou block 4a -->
  <div class="uou-block-4a secondary dark">
    <div class="container">

      <ul class="links">
          <?php if(isset($rentify_option_data['sb-privacy'])&&!empty($rentify_option_data['sb-privacy'])) {?>
            <li><a href="http://<?php echo esc_url($rentify_option_data['sb-privacy']);?> ">Privacy Policy</a></li>
          <?php } ?>
          <?php if(isset($rentify_option_data['sb-condition'])&&!empty($rentify_option_data['sb-condition'])) {?>
            <li><a href="http://<?php echo esc_url($rentify_option_data['sb-condition']);?>">Terms &amp; Conditions</a></li>
          <?php } ?>      
      </ul>


      <?php if($rentify_option_data['sb-show-footer-copyrights']){?>
      <p>
        <?php if(isset($rentify_option_data['sb-copyright-text'])&&!empty($rentify_option_data['sb-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-copyright-text']); ?> 
        <?php } ?> 
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>. 
        <?php if(isset($rentify_option_data['sb-after-copyright-text'])&&!empty($rentify_option_data['sb-after-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-after-copyright-text']); ?>
        <?php } ?>
      </p>
      <?php } ?>
    </div>
  </div> 
  <!-- end .uou-block-4a -->
    <?php } ?> 
<!-- End Bottom 6-->



<!-- Start Bottom 7 -->
<?php if(isset($rentify_option_data['sb-multi-bottom-image'])&&($rentify_option_data['sb-multi-bottom-image']==7)){?>
  <!-- uou block 4b -->
  <div class="uou-block-4b">
    <div class="container">

      <?php if($rentify_option_data['sb-show-footer-copyrights']){?>
      <p>
        <?php if(isset($rentify_option_data['sb-copyright-text'])&&!empty($rentify_option_data['sb-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-copyright-text']); ?> 
        <?php } ?> 
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>. 
        <?php if(isset($rentify_option_data['sb-after-copyright-text'])&&!empty($rentify_option_data['sb-after-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-after-copyright-text']); ?>
        <?php } ?>
      </p>
      <?php } ?>

      <?php if($rentify_option_data['sb-show-footer-credits']){?>
      <p class="secondary">Made with <i class="fa fa-heart"></i> by <a href="<?php echo esc_url(home_url('/')); ?>">UOU Apps</a>.</p>
      <?php } ?>
    <!-- Start sccial Profile -->

    <?php if($rentify_option_data['sb-social-profile']){?>

      <ul class="social-icons">

        <?php if(isset($rentify_option_data['sb-facebook-profile']) && !empty($rentify_option_data['sb-facebook-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-facebook-profile']);?> "><i class="fa fa-facebook"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-twitter-profile']) && !empty($rentify_option_data['sb-twitter-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-twitter-profile']);?> "><i class="fa fa-twitter"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-google-profile']) && !empty($rentify_option_data['sb-google-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-google-profile']);?> "><i class="fa fa-google"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-linkedin-profile']) && !empty($rentify_option_data['sb-linkedin-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-linkedin-profile']);?> "><i class="fa fa-linkedin"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-pinterest-profile']) && !empty($rentify_option_data['sb-pinterest-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-pinterest-profile']);?> "><i class="fa fa-pinterest"></i></a></li>
        <?php endif; ?>

      </ul>

    <?php }?>
    <!-- end of social profile -->

    </div>
  </div> 
  <!-- end .uou-block-4a -->
    <?php } ?> 
<!-- End Bottom 7 -->



<!-- Start Bottom 8-->
<?php if(isset($rentify_option_data['sb-multi-bottom-image'])&&($rentify_option_data['sb-multi-bottom-image']==8)){?>
  <!-- uou block 4b -->
  <div class="uou-block-4b secondary dark">
    <div class="container">

      <?php if($rentify_option_data['sb-show-footer-copyrights']){?>
      <p>
        <?php if(isset($rentify_option_data['sb-copyright-text'])&&!empty($rentify_option_data['sb-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-copyright-text']); ?> 
        <?php } ?> 
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>. 
        <?php if(isset($rentify_option_data['sb-after-copyright-text'])&&!empty($rentify_option_data['sb-after-copyright-text'])) {?>
        <?php echo esc_attr($rentify_option_data['sb-after-copyright-text']); ?>
        <?php } ?>
      </p>
      <?php } ?>

      <?php if($rentify_option_data['sb-show-footer-credits']){?>
      <p class="secondary">Made with <i class="fa fa-heart"></i> by <a href="<?php echo esc_url(home_url('/')); ?>">UOU Apps</a>.</p>
      <?php } ?>
    <!-- Start sccial Profile -->

    <?php if($rentify_option_data['sb-social-profile']){?>

      <ul class="social-icons">

        <?php if(isset($rentify_option_data['sb-facebook-profile']) && !empty($rentify_option_data['sb-facebook-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-facebook-profile']);?> "><i class="fa fa-facebook"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-twitter-profile']) && !empty($rentify_option_data['sb-twitter-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-twitter-profile']);?> "><i class="fa fa-twitter"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-google-profile']) && !empty($rentify_option_data['sb-google-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-google-profile']);?> "><i class="fa fa-google"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-linkedin-profile']) && !empty($rentify_option_data['sb-linkedin-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-linkedin-profile']);?> "><i class="fa fa-linkedin"></i></a></li>
        <?php endif; ?>

        <?php if(isset($rentify_option_data['sb-pinterest-profile']) && !empty($rentify_option_data['sb-pinterest-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($rentify_option_data['sb-pinterest-profile']);?> "><i class="fa fa-pinterest"></i></a></li>
        <?php endif; ?>

      </ul>

    <?php }?>
    <!-- end of social profile -->

    </div>
  </div> 
  <!-- end .uou-block-4a -->
    <?php } ?> 
<!-- End Bottom 8 -->

<?php } ?> 
<!-- End Bottom Switch -->

</div>

<?php wp_footer(); ?>   

</body>
</html>
