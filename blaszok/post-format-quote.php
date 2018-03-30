<?php
/**
 * The Standard post header base for MPC Themes
 *
 * Displays the thumbnail for posts in the Standard post format.
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 */

$quote = get_field('mpc_quote_text');
$author = get_field('mpc_quote_author');

echo '<blockquote class="mpc-vc-quote">';
	echo '<p><span class="mpc-vc-quote-left">&ldquo;</span>';
		echo $quote;
	echo '<span class="mpc-vc-quote-right">&rdquo;</span></p>';
	if ($author)
		echo '<cite>' . $author . '</cite>';
echo '</blockquote>';