<?php global $VAN;?>
<?php if(!isset($VAN['hide_foot']) || $VAN['hide_foot']==1):?>
<footer id="footer">
 <div class="wrapper">
      <div class="footer-l">
        <?php echo $VAN['copyright'];?>
        <?php if($VAN['theme_credit']==1):?><br/>Designed by <a href="http://www.themevan.com" target="_blank" title="Premium WordPress Themes">ThemeVan</a><?php endif;?>
      </div>
      <div class="footer-r menu">        
        <?php wp_nav_menu(array(
				  'theme_location' => 'footer_navi',
				  'echo' => true,
				  'fallback'=>false,
                  'depth' => 1 ) );
		 ?>
        
      </div>
 </div>
</footer>
<?php endif;?>

<?php if(!isset($VAN['hide_backtoTop']) || $VAN['hide_backtoTop']==1):?>
<a href="#top" id="backtoTop"></a>
<?php endif;?>

<?php if ( class_exists( 'woocommerce' ) ):?>
<!--Side Tools-->
<div id="side_tools">
  <a href="<?php echo home_url().'?page_id='.get_option('woocommerce_cart_page_id')?>" class="cart_btn"><i class="fa fa-shopping-cart"></i></a>
  <a href="<?php echo home_url().'?page_id='.get_option('woocommerce_myaccount_page_id')?>" class="<?php if(!is_user_logged_in()){echo 'user_btn';}else{echo 'user_btn_logged';}?>"><i class="fa fa-user"></i></a>
 
</div>
<?php endif;?>

<?php wp_footer();?>
</body>
</html>