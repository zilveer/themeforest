<?php
echo '
<div class="footer-ls">
	<div id="footer-ls-col">';
if (of_get_option('facebook') != "") {
    echo '
		<a href="http://' . of_get_option('facebook') . '" target="_blank"><div class="facebook"></div></a>';
}
if (of_get_option('twitter') != "") {
    echo '
		<a href="http://' . of_get_option('twitter') . '" target="_blank"><div class="twitter"></div></a>';
}
if (of_get_option('vimeo') != "") {
    echo '
		<a href="http://' . of_get_option('vimeo') . '" target="_blank"><div class="vimeo"></div></a>';
}
if (of_get_option('youtube') != "") {
    echo '
		<a href="http://' . of_get_option('youtube') . '" target="_blank"><div class="youtube"></div></a>';
}
if (of_get_option('soundcloud') != "") {
    echo '
		<a href="http://' . of_get_option('soundcloud') . '" target="_blank"><div class="soundcloud"></div></a>';
}
if (of_get_option('flickr') != "") {
    echo '
		<a href="http://' . of_get_option('flickr') . '" target="_blank"><div class="flickr1"></div></a>';
}
if (of_get_option('google') != "") {
    echo '
		<a href="http://' . of_get_option('google') . '" target="_blank"><div class="google"></div></a>';
}
if (of_get_option('linkedin') != "") {
    echo '
		<a href="http://' . of_get_option('linkedin') . '" target="_blank"><div class="linkedin"></div></a>';
}
echo '
	</div><!-- end #footer-ls-col -->
</div><!-- end .footer-ls -->';
