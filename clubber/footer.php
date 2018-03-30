</div><!-- end #wrap -->

<!-- Footer -->
<div id="footer">
  <div class="footer-row fixed">
			
<?php
wz_setSection('zone-footer');
?>
    <div class="footer-col">
<?php
wz_setZone(220);
if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-left'));
?>
    
    </div><!-- end .footer-col -->
				
    <div class="footer-col">
<?php
wz_setZone(460);
if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-center-left'));
?>
    
    </div><!-- end .footer-col -->
				
    <div class="footer-col">
<?php
wz_setZone(460);
if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-center-right'));
?>
    
    </div><!-- end .footer-col -->
				
    <div class="footer-col">
<?php
wz_setZone(220);
if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-right'));
?>
    
    </div><!-- end .footer-col -->	
  </div><!-- end .footer-row fixed -->			
</div><!-- end #footer -->

<div class="footer-bottom"> 
  <div class="footer-row">
    <div class="footer-bottom-copyright">
<?php
if (get_option("bc_copyright") != '') {
    echo stripslashes(get_option("bc_copyright"));
} else {
?>
&copy;
<?php
    $the_year = date("Y");
    echo $the_year;
?>

<?php
    bloginfo('name');
?>. <?php
    _e('All Rights Reserved.', 'clubber');
?>

<?php
}
?>
    </div><!-- end .footer-bottom-copyright -->
    <div class="footer-bottom-social">
      <ul id="footer-social">
        
<?php
if (of_get_option('facebook') != "") {
?>
        <li class="facebook footer-social"><a href="<?php
    echo of_get_option('facebook', 'no entry');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('twitter') != "") {
?>
        <li class="twitter footer-social"><a href="<?php
    echo of_get_option('twitter');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('digg') != "") {
?>
        <li class="digg footer-social"><a href="<?php
    echo of_get_option('digg');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('youtube') != "") {
?>
        <li class="youtube footer-social"><a href="<?php
    echo of_get_option('youtube');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('vimeo') != "") {
?>
        <li class="vimeo footer-social"><a href="<?php
    echo of_get_option('vimeo');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('rss') != "") {
?>
        <li class="rss footer-social"><a href="<?php
    echo of_get_option('rss');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('flickr') != "") {
?>
        <li class="flickr1 footer-social"><a href="<?php
    echo of_get_option('flickr');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('lastfm') != "") {
?>
        <li class="lastfm footer-social"><a href="<?php
    echo of_get_option('lastfm');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('pinterest') != "") {
?>
        <li class="pinterest footer-social"><a href="<?php
    echo of_get_option('pinterest');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('soundcloud') != "") {
?>
        <li class="soundcloud footer-social"><a href="<?php
    echo of_get_option('soundcloud');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('mixcloud') != "") {
?>
        <li class="mixcloud footer-social"><a href="<?php
    echo of_get_option('mixcloud');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('google') != "") {
?>
        <li class="google footer-social"><a href="<?php
    echo of_get_option('google');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('vk') != "") {
?>
        <li class="vk footer-social"><a href="<?php
    echo of_get_option('vk');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('amazon') != "") {
?>
        <li class="amazon footer-social"><a href="<?php
    echo of_get_option('amazon');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('beatport') != "") {
?>
        <li class="beatport footer-social"><a href="<?php
    echo of_get_option('beatport');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('myspace') != "") {
?>
        <li class="myspace footer-social"><a href="<?php
    echo of_get_option('myspace');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('instagram') != "") {
?>
        <li class="instagram footer-social"><a href="<?php
    echo of_get_option('instagram');
?>" target="_blank"></a></li><?php
}
?>

<?php
if (of_get_option('tumblr') != "") {
?>
        <li class="tumblr footer-social"><a href="<?php
    echo of_get_option('tumblr');
?>" target="_blank"></a></li><?php
}
?>

      </ul>
    </div><!-- end .footer-bottom-social -->
  </div><!-- end .footer-row -->
</div><!-- end .footer-bottom -->


<?php  echo ' '. get_template_part( 'prettyPhotojs' ) . ''; ?>


<?php wp_footer(); ?>

</body>
</html>