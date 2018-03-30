</div>
</div><!-- end #wrap -->

<!-- Footer -->
<div class="footer-bar"></div>
<div id="footer">
  <div class="footer-row clearfix">
			
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
  </div><!-- end .footer-row clearfix -->			
</div><!-- end #footer -->

<?php
if (of_get_option('social_logo', '1') == '1') {
echo '
<div class="footer-ls">
<div id="footer-ls-col">';

if (of_get_option('facebook') != "") {
echo '<a href="'.of_get_option('facebook').'" target="_blank"><div class="facebook"></div></a>';
}
if (of_get_option('lastfm') != "") {
echo '<a href="'.of_get_option('lastfm').'" target="_blank"><div class="lastfm"></div></a>';
}
if (of_get_option('mixcloud') != "") {
echo '<a href="'.of_get_option('mixcloud').'" target="_blank"><div class="mixcloud"></div></a>';
}
if (of_get_option('soundcloud') != "") {
echo '<a href="'.of_get_option('soundcloud').'" target="_blank"><div class="soundcloud"></div></a>';
}
if (of_get_option('twitter') != "") {
echo '<a href="'.of_get_option('twitter').'" target="_blank"><div class="twitter"></div></a>';
}
if (of_get_option('vimeo') != "") {
echo '<a href="'.of_get_option('vimeo').'" target="_blank"><div class="vimeo"></div></a>';
}
if (of_get_option('beatport') != "") {
echo '<a href="'.of_get_option('beatport').'" target="_blank"><div class="beatport"></div></a>';
}
if (of_get_option('youtube') != "") {
echo '<a href="'.of_get_option('youtube').'" target="_blank"><div class="youtube"></div></a>';
}
if (of_get_option('myspace') != "") {
echo '<a href="'.of_get_option('myspace').'" target="_blank"><div class="myspace"></div></a>';
}
if (of_get_option('amazon') != "") {
echo '<a href="'.of_get_option('amazon').'" target="_blank"><div class="amazon"></div></a>';
}
if (of_get_option('resident') != "") {
echo '<a href="'.of_get_option('resident').'" target="_blank"><div class="resident"></div></a>';
}
if (of_get_option('pinterest') != "") {
echo '<a href="'.of_get_option('pinterest').'" target="_blank"><div class="pinterest"></div></a>';
}
if (of_get_option('flickr') != "") {
echo '<a href="'.of_get_option('flickr').'" target="_blank"><div class="flickr"></div></a>';
}
if (of_get_option('digg') != "") {
echo '<a href="'.of_get_option('digg').'" target="_blank"><div class="digg"></div></a>';
}
if (of_get_option('vk') != "") {
echo '<a href="'.of_get_option('vk').'" target="_blank"><div class="vk"></div></a>';
}
if (of_get_option('google') != "") {
echo '<a href="'.of_get_option('google').'" target="_blank"><div class="google"></div></a>';
}
if (of_get_option('instagram') != "") {
echo '<a href="'.of_get_option('instagram').'" target="_blank"><div class="instagram"></div></a>';
}
if (of_get_option('tumblr') != "") {
echo '<a href="'.of_get_option('tumblr').'" target="_blank"><div class="tumblr"></div></a>';
}
echo '
</div>
</div>
';
}
?>


<div id="footer-bottom"> 
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
    _e('All Rights Reserved.', 'gxg_textdomain');
?>

<?php
}
?>
    </div><!-- end .footer-bottom-copyright -->
<?php
if (of_get_option('social_footer', '1') == '1') {
?>
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
if (of_get_option('vk') != "") {
?>
            <li class="vk footer-social"><a href="<?php
    echo of_get_option('vk');
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
if (of_get_option('mixcloud') != "") {
?>
            <li class="mixcloud footer-social"><a href="<?php
    echo of_get_option('mixcloud');
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
if (of_get_option('resident') != "") {
?>
            <li class="resident footer-social"><a href="<?php
    echo of_get_option('resident');
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
<?php
}
?>	
  </div><!-- end .footer-row -->
</div><!-- end .footer-bottom -->

<?php 
if(of_get_option('analytics_code')!="") {
echo '
<!-- Google analytics -->
';
echo of_get_option('analytics_code');
}
?>


<?php  echo ' '. get_template_part( 'scriptjs' ) . ''; ?>

<?php  echo ' '. get_template_part( 'prettyPhotojs' ) . ''; ?>

<?php wp_footer(); ?>

</body>
</html>