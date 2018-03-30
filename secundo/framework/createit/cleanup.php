<?php
/**
 * Fix shortcode <p> problem.
 * Cleans ONLY this themes shortcodes
 * @param $content
 * @return mixed
 */

function ct_shortcode_empty_paragraph_fix($content) {
	$themeShortcodes = ctShortcodeHandler::getInstance()->getShortcodeNames();

	$themeShortcodes = apply_filters('ct_shortcode.cleanup.shortcode_names',$themeShortcodes);

	// array of custom shortcodes requiring the fix
	$block = join("|", $themeShortcodes);
	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content);

	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep);

	return $rep;
}

add_filter('the_content', 'ct_shortcode_empty_paragraph_fix');
