<footer>
  <div class='container widget-container'>
    <div class='four columns'><?php bfi_dynamic_sidebar(BFISidebarFooter1Model::ID); ?></div>
    <div class='four columns'><?php bfi_dynamic_sidebar(BFISidebarFooter2Model::ID); ?></div>
    <div class='four columns'><?php bfi_dynamic_sidebar(BFISidebarFooter3Model::ID); ?></div>
    <div class='four columns'><?php bfi_dynamic_sidebar(BFISidebarFooter4Model::ID); ?></div>
  </div>
  <div class='container copyrighttext'>
    <div class='sixteen columns'>
      <span class='social'>
        <?php 
            for ($i = 1; $i <= 10; $i++) {
                $type = bfi_get_option("social$i");
                $link = bfi_get_option("sociallink$i");
                $tip  = bfi_get_option("socialtip$i");
                
                if ($type != "none" && $link != "") {
                    echo do_shortcode("[social tip='$tip' size='small' type='$type' href='$link' data-x='10' data-y='-2' data-my='bottom left' data-at='top left']");
                }
            }
        ?>
      </span>
      <small>
        <?php echo 
            bfi_get_option('footer_copyright');
        ?>
      </small>
    </div>
  </div>
</footer>
<div class='bgGradient'></div>
<?php 
    global $pagemedia;
    if ($pagemedia) {
        echo $pagemedia->getHeader();
    }
?>
<script>
  //<![CDATA[
    jQuery(document).ready(function($){
        <?php
        if (bfi_get_option("style_background") == "upload" && bfi_get_option("style_background_type") == "stretch" && bfi_get_option("style_background_image")) {
            if (bfi_get_option("style_background_image")) {
            $f = "";
            for ($i = 0; $i < bfi_get_option("style_background_blur"); $i++) { 
                $f .= $f == "" ? "" : "|"; 
                $f .= "8";
            }
            ?>
            if ($.backstretch != undefined) {
                $.backstretch("<?php echo bfi_get_option("style_background_image") ?>", {speed: 150});
            }
            <?php 
            } 
        } ?>
    
        bfi.lang.loadingNext = "<?php _e("Loading next items", BFI_I18NDOMAIN) ?>";
        bfi.lang.noMoreItems = "<?php _e("No more items to load", BFI_I18NDOMAIN) ?>";
        bfi.lang.tweet = "<?php _e("Tweet", BFI_I18NDOMAIN) ?>";
        bfi.lang.like = "<?php _e("Like", BFI_I18NDOMAIN) ?>";
        bfi.lang.plusOne = "<?php _e("+1", BFI_I18NDOMAIN) ?>";;
        bfi.lang.pin = "<?php _e("Pin", BFI_I18NDOMAIN) ?>";
        bfi.rtl = <?php echo is_rtl() ? "true" : "false" ?>;
    
        bfi.init();
    });
  //]]>
</script>
<?php 
    wp_footer();
?>
</body>
</html>
