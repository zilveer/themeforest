<?php
	$protocols = array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype');
	
	for( $i = 1; $i < 5; $i++ ){
		if( get_option("footer_social_url_$i") ) {
			echo '<li>
				      <a href="' . esc_url(get_option("footer_social_url_$i"), $protocols) . '" target="_blank">
					      <i class="' . get_option("footer_social_icon_$i") . '"></i>
				      </a>
				  </li>';
		}
	} 
?>