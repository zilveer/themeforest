<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package CookingPress
 */
?>

</div> <!-- eof: row -->
</div> <!-- eof: container -->

<footer role="contentinfo" class="mainfooter">
    <div class="container" id="footer-container">
        <div class="row" >
            <div class="col-md-4 columns">
             <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Left Column')) : endif; ?>
         </div>

         <div class="col-md-4 columns">
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Center Column')) : endif; ?>
        </div>

        <div class="col-md-4 columns">
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Right Column')) : endif; ?>
        </div>
    </div>
    <div class="row">
        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="site-info">
                <?php do_action( 'cookingpress_credits' ); ?>
                <?php $copyrights = ot_get_option('pp_copyrights' );
                if (function_exists('icl_register_string')) {
                    icl_register_string('Copyrights in footer','copyfooter', $copyrights);
                    echo icl_t('Copyrights in footer','copyfooter', $copyrights);
                } else {
                  echo $copyrights;
              } ?>


              <a href="#top" id="gototop"><?php _e( 'Go to top &uarr;', 'cookingpress' ); ?></a>
          </div><!-- .site-info -->
      </footer><!-- #colophon -->

      <?php wp_footer(); ?>
      <div> <!-- eof: row -->
      </div>
  </footer>


</body>
</html>