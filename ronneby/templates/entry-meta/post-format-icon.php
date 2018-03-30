<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Post type Icon
 */
if (has_post_format('video')) {
	# Video
	echo '<i class="dfd-icon-play_film"></i>';
} elseif (has_post_format('audio')) {
	# Audio
	echo '<i class="dfd-icon-play2"></i>';
} elseif (has_post_format('gallery')) {
	# Gallery
	echo '<i class="dfd-icon-photos"></i>';	
} elseif (has_post_format('quote')) {
	# Quote
	echo '<i class="navicon-quote-left"></i>';	
} else {
	# Default
	echo '<i class="dfd-icon-document2"></i>';
}
