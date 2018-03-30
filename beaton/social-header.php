<?php
echo '
<div class="menu-social">';
if (of_get_option('facebook') != "") {
    echo '
	<a href="http://' . of_get_option('facebook') . '" target="_blank" class="header-facebook"></a>';
}
if (of_get_option('twitter') != "") {
    echo '
	<a href="http://' . of_get_option('twitter') . '" target="_blank" class="header-twitter"></a>';
}
if (of_get_option('vimeo') != "") {
    echo '
	<a href="http://' . of_get_option('vimeo') . '" target="_blank" class="header-vimeo"></a>';
}
if (of_get_option('youtube') != "") {
    echo '
	<a href="http://' . of_get_option('youtube') . '" target="_blank" class="header-youtube"></a>';
}
if (of_get_option('soundcloud') != "") {
    echo '
	<a href="http://' . of_get_option('soundcloud') . '" target="_blank" class="header-soundcloud"></a>';
}
if (of_get_option('flickr') != "") {
    echo '
	<a href="http://' . of_get_option('flickr') . '" target="_blank" class="header-flickr"></a>';
}
if (of_get_option('google') != "") {
    echo '
	<a href="http://' . of_get_option('google') . '" target="_blank" class="header-google"></a>';
}
if (of_get_option('linkedin') != "") {
    echo '
	<a href="http://' . of_get_option('linkedin') . '" target="_blank" class="header-linkedin"></a>';
}
echo '
</div><!-- end .footer-ls -->';
