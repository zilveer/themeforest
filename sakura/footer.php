  </div>
  
  <div id="aside">
  
  <?php get_sidebar(); ?>

  </div>
</div>


  <?php
   $options = get_option( 'sample_theme_options' );

   ob_start();
   get_sidebar('bottom-left');
   $b_left = ob_get_clean();

   ob_start();
   get_sidebar('bottom-center');
   $b_center = ob_get_clean();

   ob_start();
   get_sidebar('bottom-right');
   $b_right = ob_get_clean();

   $res = $b_left . $b_center . $b_right;

   if ( trim($res) && it_is_visible($options['show_footer'])) { ?> 
   <!-- <div class="rc_spread"></div>   -->

<div id="footer_shadow"></div>   
<div id="footer_bg"<?php if (!it_is_visible($options['show_footer'])) echo ' style="display: none;"' ?>> 
  <div id="footer_s">
     <div id="footer" class="spread">
        <div class="footer_cols">       
             <div class="left">
               <?php echo $b_left; ?>
             </div> 
             <div class="center"> 
               <?php echo $b_center; ?>
             </div> 
             <div class="right"> 
               <?php echo $b_right; ?>
             </div> 
         </div>
     </div>
  </div>
</div> 
  <?php } ?>

<div id="bottom"> 
  <div> 
   <span>&copy; Copyright <?php $s=2010; echo $s; if (date('Y')!=$s) echo '-'.date('Y'); ?> <?php bloginfo( 'name' ); ?>. All rights reserved. Created by Dream-Theme &mdash; <a target="_blank" href="http://dream-theme.com/">premium wordpress themes</a>. Proudly powered by <a href="http://wordpress.org/">WordPress</a>.</span>
   <ul>
      <?php $options = get_option( 'sample_theme_options' );  ?>
      
      <?php if (!empty($options['facebook'])) { ?><li><a href="<?php echo $options['facebook']; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/social_ico_fb.png" width="14" height="14" alt=""></a></li><?php } ?>
      
      <?php if (!empty($options['flickr'])) { ?><li><a href="<?php echo $options['flickr']; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/social_ico_fl.png" width="14" height="14" alt=""></a></li><?php } ?>
      
      <?php if (!empty($options['lastfm'])) { ?><li><a href="<?php echo $options['lastfm']; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/social_ico_lf.png" width="14" height="14" alt=""></a></li><?php } ?>
      
      <?php if (!empty($options['rss'])) { ?><li><a href="<?php echo $options['rss']; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/social_ico_rss.png" width="14" height="14" alt=""></a></li><?php } ?>
      
      <?php if (!empty($options['twitter'])) { ?><li><a href="<?php echo $options['twitter']; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/social_ico_tw.png" width="14" height="14" alt=""></a></li><?php } ?>
   </ul>
  </div> 
</div> 

<?php include dirname(__FILE__).'/demo.php'; ?>

</div>

<?php

	wp_footer();
?>
</body>
</html>
