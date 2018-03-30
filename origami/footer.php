<?php
/**
 * @package WordPress
 * @subpackage Origami_Theme
 */
?>
  
  <?php 
	if ( get_option('themeteam_origami_twitter_message') ) {
		echo display_latest_tweets(''.get_option('themeteam_origami_twitter_message').''); 
	}
  ?>
  </div>
  <footer id="footer" class="clearfix">
    <div class="container_12 clearfix">
      <!-- footer 1 -->
      <div class="grid_3 first" id="widget-footer-links">
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Area 1 Widgets')) :?>

	  <?php endif ?>
      </div>
      <div class="grid_3" id="widget-footer-links">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Area 2 Widgets')) :?>

        <?php endif ?>
      </div>
      <div class="grid_3" id="custom-links">
          <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Area 3 Widgets')) :?>

        <?php endif ?>
      </div>
      <div class="grid_3" id="widget-footer-links">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Area 4 Widgets')) :?>

        <?php endif ?>
      </div>
    </div>
  </footer>
  <footer id="sub-footer" class="clearfix">
    <div class="container_12 clearfix">
      <div class="grid_12">
        <div class="left">
        	<?php if ( get_option('themeteam_origami_copyright') ) { ?>
          		&copy; <?php echo get_option('themeteam_origami_copyright'); ?> 
          	<?php } ?> 
        </div>
        <div class="right">
        	<?php if ( get_option('themeteam_origami_footer1_url') ) { ?>
        		<a href="<?php echo get_option('themeteam_origami_footer1_url'); ?>"><?php echo get_option('themeteam_origami_footer1_header') ?></a>
        	<?php } ?>  
        	<?php if ( get_option('themeteam_origami_footer2_url') ) { ?>
        		<a href="<?php echo get_option('themeteam_origami_footer2_url'); ?>"><?php echo get_option('themeteam_origami_footer2_header') ?></a>
        	<?php } ?> 
        </div>
      </div>
    </div>
  </footer>
</div>
<?php wp_footer(); ?>
<?php if(get_option("themeteam_origami_enable_cufon") == 'yes') { ?>
<script type="text/javascript"> Cufon.now(); </script>
<?php } ?>
<div id="toolbar" style="z-index:9999;">
  <div>
    <div class="trigger" id="show-toolbar"> show toolbar </div>
    <div class="trigger" id="hide-toolbar"> hide toolbar </div>
    <div class="toolbar-content">
      <dl>
        <dt>Background</dt>
        <dd>
          <div class="subtitle">1. Select Color</div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/js/toolbar/images/blue_sq.jpg);" onclick="changeCSS('blue.css')"></div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/js/toolbar/images/camel_sq.jpg);" onclick="changeCSS('camel.css')"></div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/js/toolbar/images/darkpurple_sq.jpg);" onclick="changeCSS('darkpurple.css')"></div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/js/toolbar/images/darkred_sq.jpg);" onclick="changeCSS('darkred.css')"></div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/js/toolbar/images/greymetal_sq.jpg);" onclick="changeCSS('greymetal.css')"></div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/js/toolbar/images/light_blue_sq.jpg);" onclick="changeCSS('lightblue.css')"></div>    
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/js/toolbar/images/ochre_sq.jpg);" onclick="changeCSS('ochre.css')"></div>     	
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/js/toolbar/images/green_sq.jpg);" onclick="changeCSS('green.css')"></div>     	
          <div class="divider">
            <!-- divider -->
          </div>
          <br/>
          <br/>    
          <div class="subtitle">2. Select Pattern Overlay</div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/images/bg/bg_checkerboard.png);" onclick="changeBGFull('bg_checkerboard.png','#444444')"></div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/images/bg/bg_film.png);" onclick="changeBGFull('bg_film.png','#444444')"></div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/images/bg/bg_fractures.png);" onclick="changeBGFull('bg_fractures.png','#444444')"></div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/images/bg/bg_tartan_bold.png);" onclick="changeBGFull('bg_tartan_bold.png','#444444')"></div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/images/bg/bg_tartan_light.png);" onclick="changeBGFull('bg_tartan_light.png','#444444')"></div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/images/bg/bg_vertical_waves.png);" onclick="changeBGFull('bg_vertical_waves.png','#444444')"></div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/images/bg/bg_wainscoating.png);" onclick="changeBGFull('bg_wainscoating.png','#444444')"></div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/images/bg/bg_wood_paneling.png);" onclick="changeBGFull('bg_wood_paneling.png','#444444')"></div>
          <div class="color" style="cursor:pointer;background-color:#eaeaea;background-image: url(http://origami.gothemeteam.com/wp-content/themes/origami/images/bg/bg_wood.png);" onclick="changeBGFull('bg_wood.png','#444444')"></div>
          <div class="divider">
            <!-- divider -->
          </div>
          <br/>
          <div class="subtitle">Wider Slider</div>
          <p>Be sure to check out our custom Theme Team Full Image Slider.</p>
          <br/>           
          <p><a href="http://origami.gothemeteam.com/features-page/homepage-slider-options/theme-team-full-image-slider" class="button small greymetal"><span><span>View</span></span></a></p>
        </dd>
      </dl>
    </div>
  </div>
</div>

</body>
</html>